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
        Schema::create('member_fcm_tokens', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->char('kd_fcm_tokens', 15)->primary();
            $table->char('kd_member', 15);
            $table->foreign('kd_member')->references('kd_member')->on('member')->onDelete('cascade');
            $table->string('fcm_token')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('member_fcm_tokens');
    }
};
