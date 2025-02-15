<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gudang extends Model
{
    protected $table = 'gudang';
    protected $primaryKey = 'kd_gudang';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['kd_gudang', 'nama_gudang', 'identitas', 'alamat', 'telepon', 'kecamatan', 'kabupaten', 'provinsi', 'kodepos', 'status'];

    public function stokGudangUtama()
    {
        return $this->hasMany(StokGudangUtama::class, 'kd_gudang', 'kd_gudang');
    }

    public function stokGudangCabang()
    {
        return $this->hasMany(StokGudangCabang::class, 'kd_gudang', 'kd_gudang');
    }
}
