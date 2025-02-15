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
        Schema::create('transaksi_member', function (Blueprint $table) {
            // $table->engine = 'InnoDB';
            $table->char('kd_transaksiMember', 15)->primary();
            $table->char('kd_gudangAwal', 15);
            $table->char('kd_member', 15);
            $table->char('kd_product', 15);
            $table->integer('qty');
            $table->string('carier');
            $table->decimal('harga_kargo', 15, 2);
            $table->string('status_pengiriman')->default('packing');
            $table->foreign('kd_gudangAwal')->references('kd_gudang')->on('gudang')->onDelete('cascade');
            $table->foreign('kd_member')->references('kd_member')->on('member')->onDelete('cascade');
            $table->foreign('kd_product')->references('kd_product')->on('products')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi_member');
    }
};
