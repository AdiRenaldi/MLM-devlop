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
        Schema::table('member', function (Blueprint $table) {
            $table->char('kd_atasan', 15)->nullable()->after('kd_upline');
            $table->foreign('kd_atasan')->references('kd_member')->on('member')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('member', function (Blueprint $table) {
            $table->dropForeign(['kd_atasan']);
            $table->dropColumn('kd_atasan');
        });
    }
};
