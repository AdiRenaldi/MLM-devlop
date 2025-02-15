<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NotifikasiMember extends Model
{
    protected $table = 'notifikasi_member';
    protected $primaryKey = 'kd_notifikasi_member';
    public $incrementing = false;
    protected $keyType = 'char';
    protected $fillable = [
        'kd_notifikasi_member',
        'kd_notifikasi',
        'kd_member',
        'status',
        'sent_at'
    ];

    public function notifikasi()
    {
        return $this->belongsTo(Notifikasi::class);
    }

    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}
