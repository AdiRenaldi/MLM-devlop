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
            $table->char('kd_pangkat', 15)->after('kd_member');
            $table->foreign('kd_pangkat')->references('kd_pangkat')->on('pangkat')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('member', function (Blueprint $table) {
            $table->dropForeign(['kd_pangkat']);
            $table->dropColumn('kd_pangkat');
        });
    }
};
