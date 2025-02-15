<?php

namespace App\Models;

use App\Models\Api\LaporPoin;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Member extends Model
{
    protected $table = 'member';
    protected $primaryKey = 'kd_member';
    public $incrementing = false;
    protected $keyType = 'char';
    protected $fillable = [
        'kd_member',
        'kd_pangkat',
        'kd_upline',
        'kd_atasan',
        'namaLengkap',
        'nohp',
        'nowhatsapp',
        'image',
        'alamat',
        'provinsi_id',
        'kabupaten_id',
        'kecamatan_id',
        'kodepos',
    ];
    public $appends = ['image_url'];

    public function getImageUrlAttribute()
    {
        if ($this->image) {
            return Storage::url('images/member/' . $this->image);
        }
        return null;
    }

    protected $hidden = [
        'password',
    ];

    public function userMember()
    {
        return $this->hasOne(Api\UserMember::class, 'kd_member', 'kd_member');
    }


   // Relasi ke upline utama
    public function upline()
    {
        return $this->belongsTo(Member::class, 'kd_upline', 'kd_member');
    }

    public function downlines()
    {
        return $this->hasMany(Member::class, 'kd_upline', 'kd_member');
    }

    // Relasi ke Atasan
    public function atasan()
    {
        return $this->belongsTo(Member::class, 'kd_atasan', 'kd_member');
    }

    public function bawahans()
    {
        return $this->hasMany(Member::class, 'kd_atasan', 'kd_member');
    }

    // Relasi ke laporan poin yang dibuat oleh member ini
    public function laporPoin()
    {
        return $this->hasMany(LaporPoin::class, 'kd_member', 'kd_member');
    }



    public function transaksiMember()
    {
        return $this->hasMany(TransaksiMember::class, 'kd_member', 'kd_member');
    }

    public function poinPlatinum()
    {
        return $this->hasOne(PoinPlatinum::class, 'kd_member', 'kd_member');
    }

    public function poinSilver()
    {
        return $this->hasOne(PoinSilver::class, 'kd_member', 'kd_member');
    }

    public function rewards()
    {
        return $this->belongsToMany(Reward::class, 'reward_member', 'kd_member', 'kd_reward')
                    ->withPivot('kd_rewardMember');
    }

    public function pangkat()
    {
        return $this->belongsTo(Pangkat::class, 'kd_pangkat', 'kd_pangkat');
    }

    // events
    public function events()
    {
        return $this->belongsToMany(Event::class, 'undangan_events', 'kd_member', 'kd_event')
                    ->withPivot('nomor_kursi')
                    ->withTimestamps();
    }

    public function notifications()
    {
        return $this->belongsToMany(Notifikasi::class, 'notifikasi_member', 'kd_member', 'kd_notifikasi')
                    ->withPivot('status')
                    ->withTimestamps();
    }

    public function provinsi()
    {
        return $this->belongsTo(Provinsi::class, 'provinsi_id', 'id');
    }

    public function kabupaten()
    {
        return $this->belongsTo(Kabupaten::class, 'kabupaten_id', 'id');
    }

    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class, 'kecamatan_id', 'id');
    }
}
