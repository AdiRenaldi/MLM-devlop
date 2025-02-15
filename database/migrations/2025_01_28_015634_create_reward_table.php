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
        Schema::create('reward', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->char('kd_reward', 15)->primary();
            $table->string('nama');
            $table->integer('qty');
            $table->string('image');
            $table->dateTime('tanggalPembuatan');
            $table->dateTime('tanggalBerakhir');
            $table->integer('point_platinum')->nullable();
            $table->integer('point_silver')->nullable();
            $table->text('deskripsi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reward');
    }
};
