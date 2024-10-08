<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Additives extends Model
{
    use HasFactory;
    protected $fillable=[
        'name'
    ];

    // public function additional_customizations()
    // {
    //     return $this->belongsTo(additional_customizations::class);
    // }

}
