<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserReward extends Model
{
    use HasFactory;
    protected $fillable = [
    'user_id',
    'reward_id',
     'points_redeemed',
     'redeemed_at'];



    // العلاقة مع المستخدم
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // العلاقة مع المكافأة
    public function reward()
    {
        return $this->belongsTo(Reward::class);
    }
}
