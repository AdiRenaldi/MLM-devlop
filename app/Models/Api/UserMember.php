<?php

namespace App\Models\Api;

use App\Models\Member;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class UserMember extends Authenticatable
{
    use HasApiTokens,Notifiable;

    protected $table = 'user_member';
    protected $primaryKey = 'kd_user_member';
    public $incrementing = false;
    protected $keyType = 'char';

    protected $fillable = [
        'kd_user_member',
        'kd_member',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

    public function member()
    {
        return $this->belongsTo(Member::class, 'kd_member', 'kd_member');
    }

    public function tokens()
    {
        return $this->morphMany(\Laravel\Sanctum\PersonalAccessToken::class, 'tokenable');
    }
}
