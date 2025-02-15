<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Notifikasi extends Model
{
    protected $table = 'notifikasi';
    protected $primaryKey = 'kd_notifikasi';
    public $incrementing = false;
    protected $keyType = 'char';
    protected $fillable = [
        'kd_notifikasi',
        'pesan',
        'image',
        'tipe_notif',
        'waktu_eksekusi',
        'waktu_mulai',
        'waktu_selesai',
        'tipe_pengiriman',
    ];
    public $appends = ['image_url'];

    public function getImageUrlAttribute()
    {
        if ($this->image) {
            return Storage::url('images/member/' . $this->image);
        }
        return null;
    }

    public function notifikasiMember()
    {
        return $this->belongsToMany(Member::class, 'notifikasi_member', 'kd_notifikasi', 'kd_member')
                    ->withPivot('status')
                    ->withTimestamps();
    }
}
