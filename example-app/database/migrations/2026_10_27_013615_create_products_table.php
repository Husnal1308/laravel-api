<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void //dijalankan saat migrate (membuat/mengubah)
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->integer('harga');
            $table->string('kategori');
            $table->timestamps(); //langsung buat kolom untuk nama database
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void // rollback
    {
        Schema::dropIfExists('products');
    }
};
