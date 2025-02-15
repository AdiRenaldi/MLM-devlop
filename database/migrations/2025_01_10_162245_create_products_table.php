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
        Schema::create('products', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->char('kd_product', 15)->primary();
            $table->string('namaProduk');
            $table->string('category');
            $table->decimal('harga', 15, 2);
            $table->enum('category_poin', ['platinum', 'silver'])->nullable();
            $table->enum('status', ['1', '0'])->default('1');
            $table->string('image');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
