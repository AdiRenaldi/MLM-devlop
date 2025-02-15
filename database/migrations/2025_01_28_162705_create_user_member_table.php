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
        Schema::create('user_member', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->char('kd_user_member', 15)->primary();
            $table->char('kd_member', 15)->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->foreign('kd_member')->references('kd_member')->on('member')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_member');
    }
};
