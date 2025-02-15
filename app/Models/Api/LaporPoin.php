<?php

namespace App\Models\Api;
use App\Models\Member;

use Illuminate\Database\Eloquent\Model;

class LaporPoin extends Model
{
    protected $table = 'lapor_poin';
    protected $primaryKey = 'kd_lapor_poin';
    public $incrementing = false;
    protected $keyType = 'char';


    protected $fillable = ['kd_lapor_poin', 'kd_member', 'type_poin', 'jumlah_poin', 'tanggal_transaksi', 'status', 'kd_upline', 'verifikasi_upline', 'kd_atasan', 'persetujuan_atasan'];

    public function member()
    {
        return $this->belongsTo(Member::class, 'kd_member', 'kd_member');
    }

    public function upline()
    {
        return $this->belongsTo(Member::class, 'kd_upline', 'kd_member');
    }

    public function atasan()
    {
        return $this->belongsTo(Member::class, 'kd_atasan', 'kd_member');
    }
}
