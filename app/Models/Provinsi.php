<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Provinsi extends Model
{
    protected $table = 'provinsi';
    protected $fillable = ['nama'];

    /**
     * Relasi ke tabel members, dimana setiap provinsi dapat memiliki banyak member
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function member()
    {
        return $this->hasMany(Member::class, 'provinsi_id', 'id');
    }

    public function kabupaten()
    {
        return $this->hasMany(Kabupaten::class, 'provinsi_id', 'id');
    }

}
