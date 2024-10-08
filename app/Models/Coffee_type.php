<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coffee_type extends Model
{
    use HasFactory;
    protected $fillable=[
        'id',
        'name'
    ];

    public function countries(){
        return $this->belongsToMany(Coffee_country::class,'type__countries');
    }

}
