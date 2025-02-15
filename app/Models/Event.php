<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = "events";
    protected $primaryKey = 'kd_event';
    public $incrementing = false;
    protected $keyType = 'char';

    protected $fillable = [
        'kd_event', 'nama_event', 'tanggal_event', 'deskripsi'
    ];

    public function members()
    {
        return $this->belongsToMany(Member::class, 'undangan_events' , 'kd_event', 'kd_member')
                    ->withPivot('nomor_kursi')
                    ->withTimestamps();
    }
}
