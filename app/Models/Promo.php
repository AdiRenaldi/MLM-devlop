<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Promo extends Model
{
    protected $table = 'promo';
    protected $primaryKey = 'kd_promo';
    public $incrementing = false;
    protected $fillable = [
        'kd_promo',
        'nama_promo',
        'gambar',
        'status',
        'type',
        'deskripsi'
    ];
    protected $appends = ['image_url'];

    public function getImageUrlAttribute()
    {
        if ($this->gambar) {
            return Storage::url('images/promo/' . $this->gambar);
        }
        return null;
    }
}
