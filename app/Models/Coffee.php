<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coffee extends Model
{
    use HasFactory;
    protected $fillable=[
        'name',
        'base_price',
        'image_url'

    ];

     // العلاقة مع عناصر الطلب
     public function orderItems()
     {
         return $this->hasMany(Order_Item::class);
     }


     public function stores(){
        return $this->belongsToMany(Store::class,'store__coffees');
     }
}
