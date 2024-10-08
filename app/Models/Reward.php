<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reward extends Model
{
    use HasFactory;
    protected $fillable=[
        'name',
        'points_required',
        'valid_until'

    ];

      // العلاقة مع عمليات الاستبدال
      public function redemptions()
      {
          return $this->hasMany(Redeem_points::class);
      }

      public function users()
      {
          return $this->belongsToMany(User::class, 'user_rewards')->withPivot('points_redeemed', 'redeemed_at');
      }

}
