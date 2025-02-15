<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PoinSilver extends Model
{
    protected $table = 'poin_silver';
    protected $primaryKey = 'kd_poinSilver';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['kd_poinSilver', 'kd_member', 'silverAktif', 'silverPasif'];

    public function member()
    {
        return $this->belongsTo(Member::class, 'kd_member', 'kd_member');
    }
}
