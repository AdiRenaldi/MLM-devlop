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
        Schema::create('member', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->char('kd_member', 15)->primary();
            $table->string('namaLengkap');
            $table->string('nohp')->unique();
            $table->string('nowhatsapp')->unique();
            $table->string('image')->nullable();
            $table->string('alamat');
            $table->integer('provinsi_id');
            $table->integer('kabupaten_id');
            $table->integer('kecamatan_id');
            $table->string('kodepos')->nullable();
            $table->enum('status', ['0', '1'])->default('1');
            $table->foreign('provinsi_id')->references('id')->on('provinsi')->onDelete('restrict');
            $table->foreign('kabupaten_id')->references('id')->on('kabupaten')->onDelete('restrict');
            $table->foreign('kecamatan_id')->references('id')->on('kecamatan')->onDelete('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('member');
    }
};
