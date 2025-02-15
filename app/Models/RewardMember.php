<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RewardMember extends Model
{
    protected $table = 'reward_member';
    protected $primaryKey = 'kd_rewardMember';
    public $incrementing = false;
    protected $keyType = 'char';

    protected $fillable = [
        'kd_rewardMember',
        'kd_reward',
        'kd_member',
    ];

    public function reward()
    {
        return $this->belongsTo(Reward::class, 'kd_reward');
    }

    public function member()
    {
        return $this->belongsTo(Member::class, 'kd_member');
    }
}
