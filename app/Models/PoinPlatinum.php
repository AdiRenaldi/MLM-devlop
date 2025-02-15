<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PoinPlatinum extends Model
{
    protected $table = 'poin_platinum';
    protected $primaryKey = 'kd_poinPlatinum';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['kd_poinPlatinum', 'kd_member', 'platinumAktif', 'platinumPasif'];

    public function member()
    {
        return $this->belongsTo(Member::class, 'kd_member', 'kd_member');
    }
}
