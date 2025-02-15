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
        Schema::create('poin_platinum', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->char('kd_poinPlatinum', 15)->primary();
            $table->char('kd_member', 15);
            $table->integer('platinumAktif')->default(0);
            $table->integer('platinumPasif')->default(0);
            $table->foreign('kd_member')->references('kd_member')->on('member')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('poin_platinum');
    }
};
