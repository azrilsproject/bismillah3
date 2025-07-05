<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangMasuk;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BarangMasukController extends Controller
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
            $barangMasuk = BarangMasuk::join('barang', 'barang_masuk.barang_id', '=', 'barang.id')
                ->join('satuan', 'barang.satuan_id', '=', 'satuan.id')
                ->select('barang_masuk.*', 'barang.nama_barang', 'satuan.nama_satuan', 'barang_masuk.lokasi_penyimpanan', 'barang_masuk.serial_number')
                ->whereAny(['barang_masuk.barang_id', 'barang_masuk.jumlah_masuk', 'barang.nama_barang', 'satuan.nama_satuan'], 'LIKE', '%' . $search . '%')
                ->paginate($pagination)
                ->withQueryString();
        } else {
            // menampilkan semua data
            $barangMasuk = BarangMasuk::join('barang', 'barang_masuk.barang_id', '=', 'barang.id')
                ->join('satuan', 'barang.satuan_id', '=', 'satuan.id')
                ->select('barang_masuk.*', 'barang.nama_barang', 'satuan.nama_satuan', 'barang_masuk.lokasi_penyimpanan', 'barang_masuk.serial_number')
                ->latest()
                ->paginate($pagination);
        }

        // tampilkan data ke view
        return view('barang-masuk.index', compact('barangMasuk'))->with('i', ($request->input('page', 1) - 1) * $pagination);
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
        return view('barang-masuk.create', compact('barang'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        // validasi form
        $request->validate([
            'tanggal'      => 'required|date',
            'barang'       => 'required|exists:barang,id',
            'stok'         => 'required',
            'jumlah_masuk' => 'required',
            'total'        => 'required',
            'lokasi_penyimpanan' => 'required'


        ], [
            'tanggal.required'      => 'Tanggal tidak boleh kosong.',
            'tanggal.date'          => 'Tanggal harus berupa tanggal yang valid.',
            'barang.required'       => 'Barang tidak boleh kosong.',
            'barang.exists'         => 'Barang yang dipilih tidak valid.',
            'stok.required'         => 'Stok tidak boleh kosong.',
            'jumlah_masuk.required' => 'Jumlah masuk tidak boleh kosong.',
            'total.required'        => 'Total stok tidak boleh kosong.',
            'lokasi_penyimpanan.required' => 'Lokasi penyimpanan tidak boleh kosong.'
        ]);

        // simpan data
        BarangMasuk::create([
            'tanggal'      => $request->tanggal,
            'barang_id'    => $request->barang,
            'serial_number' => $request->serial_number,
            'jumlah_masuk' => $request->jumlah_masuk,
            'lokasi_penyimpanan' => $request->lokasi_penyimpanan
        ]);

        // redirect ke halaman index dan tampilkan pesan berhasil simpan data
        return redirect()->route('barang-masuk.index')->with('success', 'Data barang masuk berhasil disimpan.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): RedirectResponse
    {
        // dapatkan data berdasarakan "id"
        $barangMasuk = BarangMasuk::findOrFail($id);

        // hapus data
        $barangMasuk->delete();

        // redirect ke halaman index dan tampilkan pesan berhasil hapus data
        return redirect()->route('barang-masuk.index')->with('success', 'Data barang masuk berhasil dihapus.');
    }
}
