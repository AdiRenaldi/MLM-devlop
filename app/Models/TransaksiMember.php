<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransaksiMember extends Model
{
    protected $table = 'transaksi_member';
    protected $primaryKey = 'kd_transaksiMember';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'kd_transaksiMember',
        'kd_gudangAwal',
        'kd_member',
        'kd_product',
        'qty',
        'carier',
        'harga_kargo',
        'status_pengiriman'
    ];

    public function gudangAwal()
    {
        return $this->belongsTo(Gudang::class, 'kd_gudangAwal', 'kd_gudang');
    }

    public function gudangTujuan()
    {
        return $this->belongsTo(Gudang::class, 'kd_gudangTujuan', 'kd_gudang');
    }

    public function product()
    {
        return $this->belongsTo(Products::class, 'kd_product', 'kd_product');
    }

    public function member()
    {
        return $this->belongsTo(Member::class, 'kd_member', 'kd_member');
    }
}
