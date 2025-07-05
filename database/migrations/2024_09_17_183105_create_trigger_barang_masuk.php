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
        DB::unprepared('CREATE TRIGGER `stok_masuk` AFTER INSERT ON `barang_masuk` FOR EACH ROW 
            BEGIN
                UPDATE barang SET stok=stok+NEW.jumlah_masuk
                WHERE id=NEW.barang_id;
            END
        ');

        DB::unprepared('CREATE TRIGGER `hapus_stok_masuk` BEFORE DELETE ON `barang_masuk` FOR EACH ROW 
            BEGIN
                UPDATE barang SET stok=stok-OLD.jumlah_masuk 
                WHERE id=OLD.barang_id;
            END
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP TRIGGER `stok_masuk`');
        DB::unprepared('DROP TRIGGER `hapus_stok_masuk`');
    }
};
