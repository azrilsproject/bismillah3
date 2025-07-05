<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LaporanStokController extends Controller
{
    /**
     * filter
     */
    public function filter(Request $request): View
    {
        // menampilkan data berdasarkan filter
        if ($request->has('stok')) {
            // validasi form
            $request->validate([
                'stok' => 'required|in:Seluruh,Minimum'
            ], [
                'stok.required' => 'Stok tidak boleh kosong.',
                'stok.in'       => 'Stok yang dipilih tidak valid.'
            ]);

            // data filter
            $stok = $request->stok;

            if ($stok == 'Seluruh') {
                // menampilkan data stok seluruh barang
                $barang = Barang::select('id', 'nama_barang', 'jenis_id', 'stok', 'satuan_id','lokasi_barang')
                ->with('jenis:id,nama_jenis', 'satuan:id,nama_satuan')
                ->orderBy('id', 'asc')
                ->get();
            } elseif ($stok == 'Minimum') {
                // menampilkan data stok barang telah mencapai batas minimum
                $barang = Barang::select('id', 'nama_barang', 'jenis_id', 'stok', 'stok_minimum', 'satuan_id','lokasi_barang')
                ->with('jenis:id,nama_jenis', 'satuan:id,nama_satuan')
                ->whereColumn('stok', '<=', 'stok_minimum')
                ->orderBy('id', 'asc')
                ->get();
            }

            // tampilkan data ke view
            return view('laporan-stok.filter', compact('barang'));
        } 
        // menampilkan form filter data
        else {    
            // tampilkan data ke view
            return view('laporan-stok.filter');
        }
    }

    /**
     * print (PDF)
     */
    public function print(Request $request)
    {
        // data filter
        $stok  = $request->stok;

        if ($stok == 'Seluruh') {
            // menampilkan data stok seluruh barang
            $barang = Barang::select('id', 'nama_barang', 'jenis_id', 'stok', 'satuan_id','lokasi_barang')
            ->with('jenis:id,nama_jenis', 'satuan:id,nama_satuan')
            ->orderBy('id', 'asc')
            ->get();
        } elseif ($stok == 'Minimum') {
            // menampilkan data stok barang telah mencapai batas minimum
            $barang = Barang::select('id', 'nama_barang', 'jenis_id', 'stok', 'stok_minimum', 'satuan_id','lokasi_barang')
            ->with('jenis:id,nama_jenis', 'satuan:id,nama_satuan')
            ->whereColumn('stok', '<=', 'stok_minimum')
            ->orderBy('id', 'asc')
            ->get();
        }

        // load view PDF
        $pdf = Pdf::loadview('laporan-stok.print', compact('barang'))->setPaper('a4', 'landscape');
        // tampilkan ke browser
        return $pdf->stream('Laporan-Stok-Barang.pdf');
    }
}
