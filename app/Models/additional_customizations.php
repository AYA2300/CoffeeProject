<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class additional_customizations extends Model
{
    use HasFactory;
    protected $fillable=[
        'order_item_id',
        'milk_type_id',
        'coffee_type_id',
        'additives',
        'syrup_id',
        'Roasting',
        'Grinding'
    ];

    public function orderItem()
    {
        return $this->belongsTo(Order_Item::class);
    }

    public function milkType()
    {
        return $this->belongsTo(Milk_Type::class);
    }

    public function sugarType()
    {
        return $this->belongsTo(Coffee_type::class);
    }

    public function additive()
    {
        return $this->belongsTo(Additives::class);
    }

    public function Syrup()
    {
        return $this->belongsTo(Syrup::class);
    }



}
