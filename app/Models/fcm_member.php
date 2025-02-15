<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class fcm_member extends Model
{
    protected $table = 'member_fcm_tokens';
    protected $primaryKey = 'kd_member_fcm_token';
    public $incrementing = false;
    protected $keyType = 'char';
    protected $fillable = [
        'kd_member_fcm_token',
        'kd_member',
        'fcm_token',
    ];
}
