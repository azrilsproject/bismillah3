<?php

namespace App\Http\Controllers;

use App\Models\BarangMasuk;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LaporanBarangMasukController extends Controller
{
    /**
     * filter
     */
    public function filter(Request $request): View   
    {
        // menampilkan data berdasarkan filter
        if ($request->has(['tgl_awal', 'tgl_akhir'])) {
            // validasi form
            $request->validate([
                'tgl_awal'  => 'required|date',
                'tgl_akhir' => 'required|date|after_or_equal:tgl_awal'
            ], [
                'tgl_awal.required'        => 'Tanggal awal tidak boleh kosong.',
                'tgl_awal.date'            => 'Tanggal awal harus berupa tanggal yang valid.',
                'tgl_akhir.required'       => 'Tanggal akhir tidak boleh kosong.',
                'tgl_akhir.date'           => 'Tanggal akhir harus berupa tanggal yang valid.',
                'tgl_akhir.after_or_equal' => 'Tanggal akhir harus berupa tanggal setelah atau sama dengan tanggal awal.'
            ]);

            // data filter
            $tglAwal  = $request->tgl_awal;
            $tglAkhir = $request->tgl_akhir;

            // menampilkan data berdasarkan filter tanggal
            $barangMasuk = BarangMasuk::join('barang', 'barang_masuk.barang_id', '=', 'barang.id')
                ->join('satuan', 'barang.satuan_id', '=', 'satuan.id')
                ->select('barang_masuk.*', 'barang.nama_barang', 'satuan.nama_satuan', 'barang_masuk.lokasi_penyimpanan', 'barang_masuk.serial_number')
                ->whereBetween('barang_masuk.tanggal', [$tglAwal, $tglAkhir])
                ->oldest()
                ->get();

            // tampilkan data ke view
            return view('laporan-barang-masuk.filter', compact('barangMasuk'));
        } 
        // menampilkan form filter data
        else {    
            // tampilkan data ke view
            return view('laporan-barang-masuk.filter');
        }
    }

    /**
     * print (PDF)
     */
    public function print(Request $request)
    {
        // data filter
        $tglAwal  = $request->tgl_awal;
        $tglAkhir = $request->tgl_akhir;

        // menampilkan data berdasarkan filter tanggal
        $barangMasuk = BarangMasuk::join('barang', 'barang_masuk.barang_id', '=', 'barang.id')
            ->join('satuan', 'barang.satuan_id', '=', 'satuan.id')
            ->select('barang_masuk.*', 'barang.nama_barang', 'satuan.nama_satuan', 'barang_masuk.lokasi_penyimpanan', 'barang_masuk.serial_number')
            ->whereBetween('barang_masuk.tanggal', [$tglAwal, $tglAkhir])
            ->oldest()
            ->get();

        // load view PDF
        $pdf = Pdf::loadview('laporan-barang-masuk.print', compact('barangMasuk'))->setPaper('a4', 'landscape');
        // tampilkan ke browser
        return $pdf->stream('Laporan-Barang-Masuk.pdf');
    }
}
