<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StokGudangCabang extends Model
{
    protected $table = 'stok_products_gudang_cabang';
    protected $primaryKey = 'kd_stokGudangCabang';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['kd_stokGudangCabang', 'kd_gudang', 'kd_stokGudangUtama', 'kd_product', 'jumlahStok', 'status', 'stokLokasi'];

    public function product()
    {
        return $this->belongsTo(Products::class, 'kd_product', 'kd_product');
    }

    public function gudang()
    {
        return $this->belongsTo(Gudang::class, 'kd_gudang', 'kd_gudang');
    }

    public function stokGudangUtama()   
    {
        return $this->belongsTo(StokGudangUtama::class, 'kd_stokGudangUtama', 'kd_stokGudangUtama');
    }
}
