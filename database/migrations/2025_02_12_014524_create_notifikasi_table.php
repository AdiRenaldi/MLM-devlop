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
        Schema::create('notifikasi', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->char('kd_notifikasi', 15)->primary();
            $table->text('pesan');
            $table->string('image')->nullable();
            $table->enum('tipe_notif', ['0', '1', '2']); // 0 = langsung, 1 = skejul, 2 = periode
            $table->dateTime('waktu_eksekusi')->nullable();
            $table->dateTime('waktu_mulai')->nullable();
            $table->dateTime('waktu_selesai')->nullable();
            $table->enum('tipe_pengiriman', ['0', '1', '2'])->nullable(); // 0 = perhari, 1 = perminggu, 2 = perbulan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifikasi');
    }
};
