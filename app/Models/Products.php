<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Products extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'kd_product';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['kd_product', 'namaProduk', 'harga', 'category', 'status', 'category_poin', 'image', 'deskripsi'];
    
    protected $appends = ['image_url'];

    public function stokGudangUtama()
    {
        return $this->hasMany(StokGudangUtama::class, 'kd_product', 'kd_product');
    }

    public function getImageUrlAttribute()
    {
        if ($this->image) {
            return Storage::url('images/products/' . $this->image);
        }
        return null;
    }
}
