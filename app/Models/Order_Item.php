<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_Item extends Model
{
    use HasFactory;
    protected $fillable=[
        'order_id',
        'coffee_id',
        'quantity',
        'volume_ml',
        'prepare_by_time',
        'prepare_time',
        'ristretto',
        'onsite_takeaway',
        'total_amount',





    ];

        // العلاقة مع الطلب
        public function order()
        {
            return $this->belongsTo(Order::class,'order_id');
        }

        // العلاقة مع القهوة
        public function coffee()
        {
            return $this->belongsTo(Coffee::class);
        }

        public function customizations()
{
    return $this->hasOne(Additional_Customizations::class,'order_item_id');
}





}
