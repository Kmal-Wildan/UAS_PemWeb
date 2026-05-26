<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('barangs', function (Blueprint $table) {
            $table->id();
            $table->string('kode_barang', 50)->unique();
            $table->string('nama_barang');
            $table->string('kategori', 100);
            $table->unsignedInteger('stok')->default(0);
            $table->decimal('harga', 15, 2)->default(0);
            $table->timestamps();

            $table->index('nama_barang');
            $table->index('kategori');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('barangs');
    }
};
