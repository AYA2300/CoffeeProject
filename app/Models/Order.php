<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable=[
        'user_id',
        'store_id',
        'status',
        'total_price',
        'expected_time'



    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // العلاقة مع المتجر
    public function store()
    {
        return $this->belongsTo(Store::class);
    }



    // العلاقة مع عناصر الطلب (منتجات القهوة)
    public function items()
    {
        return $this->hasMany(Order_Item::class);
    }

    // العلاقة مع المراجعات
    public function review()
    {
        return $this->hasOne(Review::class);
    }



}
