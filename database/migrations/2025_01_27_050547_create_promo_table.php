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
        Schema::create('promo', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->char('kd_promo', 15)->primary();
            $table->string('nama_promo', 100);
            $table->string('gambar', 100);
            $table->enum('status', ['1', '0'])->default('0');
            $table->enum('type', ['1', '0'])->default('0');
            $table->text('deskripsi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promo');
    }
};
