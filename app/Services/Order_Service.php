<?php
namespace App\Services;

use App\Http\Traits\FileStorageTrait;
use App\Models\Additional_Customizations;
use App\Models\Order;
use App\Models\Order_Item;
use Illuminate\Support\Facades\Auth;

class Order_Service {
    use FileStorageTrait;

    /**
     * إضافة طلب جديد.
     *
     * @param array $input_data
     * @return array
     */
    public function add_order(array $input_data)
    {
        $user = Auth::user();

        if (!$user) {
            return $this->response('لست مسجل دخول', 404);

        }

        // إنشاء الطلب الرئيسي
        $order = $this->create_order($user->id, $user->store->id, $input_data['total_price']);

        // التحقق من وجود عناصر الطلب
        if (!isset($input_data['items']) || !is_array($input_data['items'])) {
            return $this->response('لا توجد عناصر في الطلب', 400);
        }

        // معالجة عناصر الطلب
        $items_with_customizations = $this->process_order_items($order->id, $input_data['items']);

        // رد النجاح مع التخصيصات
        return $this->response('تم إنشاء الطلب بنجاح', 200, [
            'order' => $order,
            'items' => $items_with_customizations,
        ]);
    }

    /**
     * إنشاء الطلب الرئيسي.
     *
     * @param int $user_id
     * @param int $store_id
     * @param string $total_price
     * @return Order
     */
    private function create_order($user_id, $store_id, $total_price)
    {
        return Order::create([
            'user_id' => $user_id,
            'store_id' => $store_id,
            'total_price' => $total_price
        ]);
    }

    /**
     * معالجة عناصر الطلب.
     *
     * @param int $order_id
     * @param array $items
     * @return array
     */
    private function process_order_items($order_id, array $items)
    {
        $items_with_customizations = []; // مصفوفة لتخزين العناصر مع التخصيصات

        foreach ($items as $item_data) {
            // إنشاء عنصر الطلب
            $order_item = $this->create_order_item($order_id, $item_data);

            // إضافة التخصيصات الإضافية
            if (isset($item_data['customizations'])) {
              //  dd($order_item['order_item']->id);
                $customizations = $this->add_customizations($order_item['order_item']->id, $item_data['customizations']);
                $items_with_customizations[] = [
                    'order_item' => $order_item,
                    'customizations' => $customizations
                ];
            } else {
                $items_with_customizations[] = [
                    'order_item' => $order_item,
                    'customizations' => null
                ];
            }
        }

        return $items_with_customizations; // إرجاع العناصر مع التخصيصات
    }

    /**
     * إنشاء عنصر طلب (Order Item).
     *
     * @param int $order_id
     * @param array $item_data
     * @return Order_Item
     */
    private function create_order_item($order_id, array $item_data)
    {
        // تحقق من إعداد الوقت
        $prepare_by_time = isset($item_data['prepare_by_time']) && $item_data['prepare_by_time'] == true;
        $prepare_time = $prepare_by_time ? $item_data['prepare_time'] : null;

        // إنشاء عنصر الطلب
        $order_item = Order_Item::create([
            'order_id' => $order_id,
            'coffee_id' => $item_data['coffee_id'],
            'quantity' => $item_data['quantity'],
            'volume_ml' => $item_data['volume_ml'],
            'onsite_takeaway' => $item_data['onsite_takeaway'],
            'total_amount' => $item_data['total_amount'],
            'prepare_by_time' => $prepare_by_time,
            'prepare_time' => $prepare_time,
        ]);

        // استرجاع اسم وسعر القهوة المرتبطة
        $coffee = $order_item->coffee; // استرجاع القهوة المرتبطة بالعلاقة

        return [
            'order_item' => $order_item,

        ];
    }


    /**
     * إضافة التخصيصات الإضافية (Customizations) لكل عنصر.
     *
     * @param int $order_item_id
     * @param array $customizations
     * @return array
     */
    private function add_customizations($order_item_id, array $customizations)
    {
        // إعداد بيانات التخصيص
        $customizationData = [
            'order_item_id' => $order_item_id,
            'milk_type_id' => is_array($customizations['milk_type_id']) ? json_encode($customizations['milk_type_id']) : ($customizations['milk_type_id'] ?? null),
            'coffee_type_id' => is_array($customizations['coffee_type_id']) ? json_encode($customizations['coffee_type_id']) : ($customizations['coffee_type_id'] ?? null),
            'additives' => is_array($customizations['additive_id']) ? json_encode($customizations['additive_id']) : null, // تخزين الـ additives كمصفوفة JSON
            'syrup_id' => is_array($customizations['syrup_id']) ? json_encode($customizations['syrup_id']) : ($customizations['syrup_id'] ?? null),
            'roasting' => $customizations['roasting'] ?? null,
            'grinding' => $customizations['grinding'] ?? null,
            'created_at' => now(),
            'updated_at' => now(),
        ];

        // إدخال التخصيص في قاعدة البيانات
        Additional_Customizations::create($customizationData);

        return $customizationData; // إرجاع نجاح العملية
    }




    /**
     * إنشاء استجابة (Response).
     *
     * @param string $msg
     * @param int $status_code
     * @param array|null $data
     * @return array
     */
    private function response($msg, $status_code, $data = null)
    {
        return [
            'msg' => $msg,
            'status_code' => $status_code,
            'data' => $data
        ];
    }


   /**
 * عرض الطلبات الخاصة بالمستخدم.
 *
 * @return array
 */
public function get_Orders()
{
    // الحصول على المستخدم الحالي
    $user = Auth::user();

    if (!$user) {
       return $this->response('لست مسجل دخول','401');
    }

    // استرجاع جميع الطلبات التي تكون في حالة ongoing
    $orders = Order::with('items')
        ->where('user_id', $user->id)
        ->whereIn('status', ['Processing', 'pending']) // الطلبات المستمرة
        ->get();

        $pastOrders = Order::with('items')
        ->where('user_id', $user->id)
        ->whereIn('status', ['Completed', 'Cancelled']) // الطلبات القديمة
        ->get();

    if ($orders->isEmpty() && $pastOrders->isEmpty()) {
        return $this->response('لا يوجد طلبات', '404');
    }





    // تنسيق الطلبات
    $formattedOrders = $orders->map(function ($order) {
        return [
            'id' => $order->id,
            'total_price' => $order->total_price,
            'items' => $order->items->map(function ($item) {
              //  dd($item->prepare_time );

                return [
                    'coffee_name' => $item->coffee->name,
                    'quantity' => $item->quantity,
                    'total_amount' => $item->total_amount,
                    'image_url' => $item->coffee->image_url,
                    'base_price'=> $item->coffee->base_price

                ];
            }),
            'order_date' => $order->created_at->format('d M | H:i'),
            'expected_time' => ($order->prepare_by_time)
            ? $order->prepare_time->format('H:i')
            : $order->created_at->addMinutes(10)->format('H:i'),

            'location' => $order->store->address, // الموقع الجغرافي
        ];
    });


    $formattedPastOrders = $pastOrders->map(function ($order) {
        return [
            'id' => $order->id,
            'total_price' => $order->total_price,
            'items' => $order->items->map(function ($item) {
                return [
                    'coffee_name' => $item->coffee->name,
                    'quantity' => $item->quantity,
                    'total_amount' => $item->total_amount,
                    'image_url' => $item->coffee->image_url,
                    'base_price'=> $item->coffee->base_price
                ];
            }),
            'order_date' => $order->created_at->format('d M | H:i'),
            'location' => $order->store->address,
            'status' => $order->status, // حالة الطلب
        ];
    });

    return $this->response('your ongoing orders', 200,[
        'data' => [
        'ongoing_orders' => $formattedOrders,
        'Hestory'=> $formattedPastOrders
    ],]);



}




}
