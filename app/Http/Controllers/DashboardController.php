<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangKeluar;
use App\Models\BarangMasuk;
use App\Models\Jenis;
use App\Models\Satuan;
use App\Models\User;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        // menampilkan jumlah data barang
        $totalBarang = Barang::count();
        // menampilkan jumlah data barang masuk
        $totalBarangMasuk = BarangMasuk::count();
        // menampilkan jumlah data barang keluar
        $totalBarangKeluar = BarangKeluar::count();
        // menampilkan jumlah data jenis barang
        $totalJenis = Jenis::count();
        // menampilkan jumlah data satuan
        $totalSatuan = Satuan::count();
        // menampilkan jumlah data user
        $totalUser = User::count();

        // menampilkan data stok barang telah mencapai batas minimum
        $barang = Barang::select('id', 'nama_barang', 'jenis_id', 'stok', 'stok_minimum', 'satuan_id')
            ->with('jenis:id,nama_jenis', 'satuan:id,nama_satuan')
            ->whereColumn('stok', '<=', 'stok_minimum')
            ->orderBy('id', 'asc')
            ->get();

        // tampilkan data ke view
        return view('dashboard.index', compact('totalBarang', 'totalBarangMasuk', 'totalBarangKeluar', 'totalJenis', 'totalSatuan', 'totalUser', 'barang'));
    }
}
