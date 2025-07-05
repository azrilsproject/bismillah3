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
        Schema::create('barang', function (Blueprint $table) {
            $table->string('id', length: 5)->primary();
            $table->string('nama_barang', length: 100);
            $table->foreignId('jenis_id')->constrained('jenis')->onDelete('cascade');
            $table->integer('stok_minimum');
            $table->integer('stok')->default(0);
            $table->foreignId('satuan_id')->constrained('satuan')->onDelete('cascade');
            $table->string('lokasi_barang', length: 100);
            $table->foreignId('barang_masuk_id')->constrained('serial_number','lokasi_penyimpanan')->onDelete('cascade');
            $table->string('foto')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang');
    }
};
