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
        Schema::create('lapor_poin', function (Blueprint $table) {
            $table->char('kd_lapor_poin', 15)->primary();
            $table->string('kd_member');
            $table->enum('type_poin', ['0', '1']);
            $table->integer('jumlah_poin');
            $table->date('tanggal_transaksi');
            $table->enum('status', ['0', '1', '2'])->default('0');
            $table->string('kd_upline');
            $table->enum('verifikasi_upline', ['0', '1', '2'])->default('0');
            $table->string('kd_atasan');
            $table->enum('persetujuan_atasan', ['0', '1', '2'])->default('0');
            $table->timestamps();

            $table->foreign('kd_member')->references('kd_member')->on('member')->onDelete('cascade');
            $table->foreign('kd_upline')->references('kd_member')->on('member')->onDelete('cascade');
            $table->foreign('kd_atasan')->references('kd_member')->on('member')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lapor_poin');
    }
};
