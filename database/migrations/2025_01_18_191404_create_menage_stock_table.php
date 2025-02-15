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
        Schema::create('menage_stock', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->char('kd_menageStock', 15)->primary();
            $table->char('kd_gudangAwal', 15);
            $table->char('kd_gudangTujuan', 15);
            $table->char('kd_product', 15);
            $table->integer('qty');
            $table->string('carier');
            $table->decimal('harga_kargo', 15, 2);
            $table->string('status_pengiriman')->default('packing');
            $table->foreign('kd_gudangAwal')->references('kd_gudang')->on('gudang')->onDelete('cascade');
            $table->foreign('kd_gudangTujuan')->references('kd_gudang')->on('gudang')->onDelete('cascade');
            $table->foreign('kd_product')->references('kd_product')->on('products')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menage_stock');
    }
};
