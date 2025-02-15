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
            $table->char('kd_upline', 15)->after('kd_pangkat');
            $table->foreign('kd_upline')->references('kd_member')->on('member')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('member', function (Blueprint $table) {
            $table->dropForeign(['kd_upline']);
            $table->dropColumn('kd_upline');
        });
    }
};
