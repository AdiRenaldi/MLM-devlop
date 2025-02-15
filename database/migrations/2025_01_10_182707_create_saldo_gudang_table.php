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
        Schema::create('saldo_gudang', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->char('kd_saldoGudang', 15)->primary();
            // $table->char('kd_gudang', 15);
            $table->decimal('saldo', 15, 2);
            $table->enum('saldoInOut', ['in', 'out'])->nullable();
            // $table->foreign('kd_gudang')->references('kd_gudang')->on('gudang')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('saldo_gudang');
    }
};
