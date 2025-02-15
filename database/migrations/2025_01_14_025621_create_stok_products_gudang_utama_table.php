<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('stok_products_gudang_utama', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->char('kd_stokGudangUtama', 15)->primary();
            $table->char('kd_gudang', 15);
            $table->char('kd_product', 15);
            $table->dateTime('stokMasuk');
            $table->dateTime('masaExpire');
            $table->integer('jumlahStok');
            $table->string('stokLokasi')->nullable();
            $table->text('deskripsi')->nullable();
            $table->foreign('kd_product')->references('kd_product')->on('products')->onDelete('cascade');
            $table->foreign('kd_gudang')->references('kd_gudang')->on('gudang')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stok_products_gudang_utama');
    }
};
