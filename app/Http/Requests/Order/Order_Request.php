<?php

namespace App\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;

class Order_Request extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
           'items'=>'required|array',
           'items*.order_id' => 'required|exists:orders,id',
           'items*.user_id' => 'required|exists:users,id',
           'items*.store_id'=>'required|exists:stores,id',
           'items*.coffee_id' => 'required|exists:coffees,id',
           'items*.quantity' => 'required|integer|min:1',
           'items*.volume_ml' => 'required|in:250,350,450',
           'items*.onsite_takeaway' => 'required|in:onsite,takeaway',
           'items*.total_amount' => 'required|string',
           'total_price'=>'required|string',
           'items*.customizations' => 'array',
           'prepare_by_time' => 'nullable',
           'prepare_time' => 'nullable|date_format:H:i',
           'items*.customizations*.order_item_id' => 'required|exists:order__items,id',
           'items*.customizations*.milk_type_id'=>'nullable|exists:milk_types,id',
           'items*.customizations*.coffee_type_id'=>'nullable|exists:coffee_types,id',
           'items*.customizations*.additive_id'=>'nullable|exists:additives,id',
           'items*.customizations*.syrup_id'=>'nullable|exists:syrups,id',
           'items*.customizations*.Roasting'=>'required|string',
           'items*.customizations*.Grinding'=>'required|string',





        ];
    }
}
