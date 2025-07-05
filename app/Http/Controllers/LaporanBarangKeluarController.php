<?php

namespace App\Http\Controllers;

use App\Models\BarangKeluar;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LaporanBarangKeluarController extends Controller
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
            $barangKeluar = BarangKeluar::join('barang', 'barang_keluar.barang_id', '=', 'barang.id')
                ->join('satuan', 'barang.satuan_id', '=', 'satuan.id')
                ->select('barang_keluar.*', 'barang.nama_barang', 'satuan.nama_satuan')
                ->whereBetween('barang_keluar.tanggal', [$tglAwal, $tglAkhir])
                ->oldest()
                ->get();

            // tampilkan data ke view
            return view('laporan-barang-keluar.filter', compact('barangKeluar'));
        } 
        // menampilkan form filter data
        else {    
            // tampilkan data ke view
            return view('laporan-barang-keluar.filter');
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
        $barangKeluar = BarangKeluar::join('barang', 'barang_keluar.barang_id', '=', 'barang.id')
            ->join('satuan', 'barang.satuan_id', '=', 'satuan.id')
            ->select('barang_keluar.*', 'barang.nama_barang', 'satuan.nama_satuan')
            ->whereBetween('barang_keluar.tanggal', [$tglAwal, $tglAkhir])
            ->oldest()
            ->get();

        // load view PDF
        $pdf = Pdf::loadview('laporan-barang-keluar.print', compact('barangKeluar'))->setPaper('a4', 'landscape');
        // tampilkan ke browser
        return $pdf->stream('Laporan-Barang-Keluar.pdf');
    }
}
