<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    protected $fillable=[
        'order_id',
        'user_id',
        'rating',
        'comment'

    ];


        // العلاقة مع الطلب
        public function order()
        {
            return $this->belongsTo(Order::class);
        }


        public function user(){
            return $this->belongsTo(User::class);
        }


}
