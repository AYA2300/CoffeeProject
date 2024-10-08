<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'address',
        'latitude',
        'longitude'

    ];


        // العلاقة مع الطلبات
        public function orders()
        {
            return $this->hasMany(Order::class);
        }

        // العلاقة مع الباريستا
        public function baristas()
        {
            return $this->hasMany(Barista::class);
        }

        public function coffees(){
            return $this->belongsToMany(Coffee::class,'store__coffees');
         }




}
