<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::unprepared('CREATE TRIGGER `stok_keluar` AFTER INSERT ON `barang_keluar` FOR EACH ROW 
            BEGIN
                UPDATE barang SET stok=stok-NEW.jumlah_keluar
                WHERE id=NEW.barang_id;
            END
        ');

        DB::unprepared('CREATE TRIGGER `hapus_stok_keluar` BEFORE DELETE ON `barang_keluar` FOR EACH ROW 
            BEGIN
                UPDATE barang SET stok=stok+OLD.jumlah_keluar
                WHERE id=OLD.barang_id;
            END
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP TRIGGER `stok_keluar`');
        DB::unprepared('DROP TRIGGER `hapus_stok_keluar`');
    }
};
