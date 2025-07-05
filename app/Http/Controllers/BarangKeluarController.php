<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangKeluar;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BarangKeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        // jumlah data yang ditampilkan per paginasi halaman
        $pagination = 10;
        // get data search
        $search = $request->search;

        if ($search) {
            // menampilkan pencarian data
            $barangKeluar = BarangKeluar::join('barang', 'barang_keluar.barang_id', '=', 'barang.id')
                ->join('satuan', 'barang.satuan_id', '=', 'satuan.id')
                ->select('barang_keluar.*', 'barang.nama_barang', 'satuan.nama_satuan', 'barang_masuk.lokasi_pengambilan', 'barang_keluar.penanggung_jawab')
                ->whereAny(['barang_keluar.barang_id', 'barang_keluar.jumlah_keluar', 'barang.nama_barang', 'satuan.nama_satuan'], 'LIKE', '%' . $search . '%')
                ->paginate($pagination)
                ->withQueryString();
        } else {
            // menampilkan semua data
            $barangKeluar = BarangKeluar::join('barang', 'barang_keluar.barang_id', '=', 'barang.id')
                ->join('satuan', 'barang.satuan_id', '=', 'satuan.id')
                ->select('barang_keluar.*', 'barang.nama_barang', 'satuan.nama_satuan', 'barang_keluar.lokasi_pengambilan', 'barang_keluar.penanggung_jawab')
                ->latest()
                ->paginate($pagination);
        }

        // tampilkan data ke view
        return view('barang-keluar.index', compact('barangKeluar'))->with('i', ($request->input('page', 1) - 1) * $pagination);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        // ambil data barang
        $barang = Barang::select('id', 'nama_barang', 'stok', 'satuan_id')
            ->with('satuan:id,nama_satuan')
            ->orderBy('id', 'asc')
            ->get();
        
        // tampilkan form tambah data
        return view('barang-keluar.create', compact('barang'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        // validasi form
        $request->validate([
            'tanggal'       => 'required|date',
            'barang'        => 'required|exists:barang,id',
            'stok'          => 'required',
            'jumlah_keluar' => 'required',
            'sisa'          => 'required',
            'lokasi_pengambilan' => 'required',
            'penanggung_jawab' => 'required'
        ], [
            'tanggal.required'       => 'Tanggal tidak boleh kosong.',
            'tanggal.date'           => 'Tanggal harus berupa tanggal yang valid.',
            'barang.required'        => 'Barang tidak boleh kosong.',
            'barang.exists'          => 'Barang yang dipilih tidak valid.',
            'stok.required'          => 'Stok tidak boleh kosong.',
            'jumlah_keluar.required' => 'Jumlah keluar tidak boleh kosong.',
            'sisa.required'          => 'Sisa stok tidak boleh kosong.',
            'lokasi_pengambilan' => 'Lokasi tidak boleh kosong',
            'penanggung_jawab.required' => 'Penanggung jawab tidak boleh kosong.'
        ]);

        // simpan data
        BarangKeluar::create([
            'tanggal'       => $request->tanggal,
            'barang_id'     => $request->barang,
            'sn'            => $request->sn,
            'jumlah_keluar' => $request->jumlah_keluar,
            'lokasi_pengambilan' => $request->lokasi_pengambilan,
            'penanggung_jawab' => $request->penanggung_jawab
        ]);

        // redirect ke halaman index dan tampilkan pesan berhasil simpan data
        return redirect()->route('barang-keluar.index')->with('success', 'Data barang keluar berhasil disimpan.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): RedirectResponse
    {
        // dapatkan data berdasarakan "id"
        $barangKeluar = BarangKeluar::findOrFail($id);

        // hapus data
        $barangKeluar->delete();

        // redirect ke halaman index dan tampilkan pesan berhasil hapus data
        return redirect()->route('barang-keluar.index')->with('success', 'Data barang keluar berhasil dihapus.');
    }
}
