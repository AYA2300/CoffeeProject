<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coffee_country extends Model
{
    use HasFactory;
    protected $fillable=[
        'id',
        'name'
    ];


    public function types(){
        return $this->belongsToMany(Coffee_type::class,'type__countries');
    }

}
