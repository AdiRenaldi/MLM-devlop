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
        Schema::create('reward_member', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->char('kd_rewardMember', 15)->primary();
            $table->char('kd_reward', 15);
            $table->char('kd_member', 15);
            $table->foreign('kd_reward')->references('kd_reward')->on('reward')->onDelete('cascade');
            $table->foreign('kd_member')->references('kd_member')->on('member')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reward_member');
    }
};
