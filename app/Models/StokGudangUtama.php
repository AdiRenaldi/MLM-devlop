<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StokGudangUtama extends Model
{
    protected $table = 'stok_products_gudang_utama';
    protected $primaryKey = 'kd_stokGudangUtama';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['kd_stokGudangUtama', 'kd_gudang', 'kd_product', 'stokMasuk', 'masaExpire', 'jumlahStok', 'stokLokasi', 'deskripsi'];

    public function product()
    {
        return $this->belongsTo(Products::class, 'kd_product', 'kd_product');
    }

    public function gudang()
    {
        return $this->belongsTo(Gudang::class, 'kd_gudang', 'kd_gudang');
    }

    public function stokGudangCabang()
    {
        return $this->hasMany(StokGudangCabang::class, 'kd_stokGudangUtama', 'kd_stokGudangUtama');
    }
}
