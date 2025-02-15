<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ManageStok extends Model
{
    
    protected $table = 'menage_stock';
    protected $primaryKey = 'kd_menageStock';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'kd_menageStock',
        'kd_gudangAwal',
        'kd_gudangTujuan',
        'kd_product',
        'qty',
        'carier',
        'harga_kargo',
        'status_pengiriman',
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

}
