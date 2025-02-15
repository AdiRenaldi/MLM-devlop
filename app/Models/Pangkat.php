<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pangkat extends Model
{
    protected $table = "pangkat";
    protected $primaryKey = "kd_pangkat";
    public $incrementing = false;
    protected $keyType = "char";

    public $fillable = ["kd_pangkat", "nama_pangkat"];

    public function member()
    {
        return $this->hasOne(Member::class, 'kd_pangkat', 'kd_pangkat');
    }
}
