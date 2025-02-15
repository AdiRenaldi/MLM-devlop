<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Reward extends Model
{
    protected $table = 'reward';
    protected $primaryKey = 'kd_reward';
    public $incrementing = false;
    protected $keyType = 'char';
    protected $fillable = ['kd_reward', 'nama', 'qty', 'image', 'tanggalPembuatan', 'tanggalBerakhir', 'point_platinum', 'point_silver', 'deskripsi'];
    protected $appends = ['image_url'];

    public function getImageUrlAttribute()
    {
        if ($this->image) {
            return Storage::url('images/reward/' . $this->image);
        }
        return null;
    }

    public function reward()
    {
        return $this->belongsToMany(Member::class);
    }

    public function members()
    {
        return $this->belongsToMany(Member::class, 'reward_member', 'kd_reward', 'kd_member')
                    ->withPivot('kd_rewardMember');
    }
}
