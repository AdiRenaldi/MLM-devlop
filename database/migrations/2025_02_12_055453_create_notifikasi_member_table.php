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
        Schema::create('notifikasi_member', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->char('kd_notifikasi_member', 15)->primary();
            $table->char('kd_notifikasi', 15);
            $table->char('kd_member', 15);
            $table->boolean('status')->default(false);
            $table->dateTime('sent_at')->nullable();
            $table->foreign('kd_notifikasi')->references('kd_notifikasi')->on('notifikasi')->onDelete('cascade');
            $table->foreign('kd_member')->references('kd_member')->on('member')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifikasi_member');
    }
};
