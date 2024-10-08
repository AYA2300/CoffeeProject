<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barista extends Model
{
    use HasFactory;
    protected $fillable=[
        'name',
        'status',
        'experience_level',
        'store_id'

    ];

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    // العلاقة مع الطلبات
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
