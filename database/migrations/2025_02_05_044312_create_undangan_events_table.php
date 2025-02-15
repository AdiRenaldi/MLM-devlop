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
        Schema::create('undangan_events', function (Blueprint $table) {
            $table->id();
            $table->char('kd_event', 15);
            $table->char('kd_member', 15);
            $table->string('nomor_kursi')->nullable();
            $table->foreign('kd_event')->references('kd_event')->on('events')->onDelete('cascade');
            $table->foreign('kd_member')->references('kd_member')->on('member')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('undangan_events');
    }
};
