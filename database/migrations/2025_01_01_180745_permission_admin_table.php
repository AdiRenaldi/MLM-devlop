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
        Schema::create('permission_admin', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->char('kd_permission_admin', 15)->primary();
            $table->enum('tier', ['super_admin', 'admin_member', 'admin_gudang']);
            $table->text('permission');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permission_admin');
    }
};
