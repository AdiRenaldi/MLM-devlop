<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SaldoGudang extends Model
{
    protected $table = 'saldo_gudang';
    protected $primaryKey = 'kd_saldoGudang';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['kd_saldoGudang', 'kd_gudang', 'saldo', 'saldoInOut'];
}
