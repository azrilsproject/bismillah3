<?php

namespace App\Http\Controllers;

use App\Models\Jenis;
use App\Models\Barang;
use App\Models\Satuan;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class BarangController extends Controller
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
            $barang = Barang::select('id', 'nama_barang', 'jenis_id', 'stok', 'satuan_id','lokasi_barang')
                ->with('jenis:id,nama_jenis', 'satuan:id,nama_satuan')
                ->whereAny(['id', 'nama_barang', 'stok'], 'LIKE', '%' . $search . '%')
                ->orWhereHas('jenis', function ($query) use ($search) {
                    $query->where('nama_jenis', 'LIKE', '%' . $search . '%');
                })
                ->orWhereHas('satuan', function ($query) use ($search) {
                    $query->where('nama_satuan', 'LIKE', '%' . $search . '%');
                })
                ->paginate($pagination)
                ->withQueryString();
        } else {
            // menampilkan semua data
            $barang = Barang::select('id', 'nama_barang', 'jenis_id', 'stok', 'satuan_id','lokasi_barang')
                ->with('jenis:id,nama_jenis', 'satuan:id,nama_satuan')
                ->latest()
                ->paginate($pagination);
        }

        // tampilkan data ke view
        return view('barang.index', compact('barang'))->with('i', ($request->input('page', 1) - 1) * $pagination);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        // ambil data jenis barang
        $jenis = Jenis::select('id', 'nama_jenis')
            ->orderBy('nama_jenis', 'asc')
            ->get();
        // ambil data satuan
        $satuan = Satuan::select('id', 'nama_satuan')
            ->orderBy('nama_satuan', 'asc')
            ->get();

        // membuat "id" barang
        // menampilkan 4 digit terakhir dari "id" pada tabel "barang"
        $barang = Barang::select(DB::raw('RIGHT(id,4) as nomor'))
            ->orderBy('id', 'desc')
            ->first();

        // jika "id" belum ada
        if ($barang == null) {
            // tentukan "id" = 1
            $nomor = 1;
        } 
        // jika "id" sudah ada
        else {
            // tentukan "id" selanjutnya
            $nomor = $barang->nomor + 1;
        }
        
        // menambahkan karakter "B" diawal dan karakter "0" disebelah kiri nomor urut
        $idBarang = 'A' . Str::padLeft($nomor, 4, '0');

        // tampilkan form tambah data
        return view('barang.create', compact('jenis', 'satuan', 'idBarang'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        // validasi form
        $request->validate([
            'id'           => 'required',
            'nama_barang'  => 'required',
            'jenis'        => 'required|exists:jenis,id',
            'stok_minimum' => 'required',
            'satuan'       => 'required|exists:satuan,id',
            'lokasi_barang' => 'required',
            'foto'         => 'mimes:jpeg,jpg,png|max:1024'
        ], [
            'id.required'           => 'ID barang tidak boleh kosong.',
            'nama_barang.required'  => 'Nama barang tidak boleh kosong.',
            'jenis.required'        => 'Jenis barang tidak boleh kosong.',
            'jenis.exists'          => 'Jenis barang yang dipilih tidak valid.',
            'stok_minimum.required' => 'Stok minimum tidak boleh kosong.',
            'satuan.required'       => 'Satuan tidak boleh kosong.',
            'satuan.exists'         => 'Satuan yang dipilih tidak valid.',
            'lokasi_barang.required' => 'Lokasi barang tidak boleh kosong.',
            'foto.mimes'            => 'Foto barang harus berupa file dengan jenis: jpeg, jpg, png.',
            'foto.max'              => 'Foto barang tidak boleh lebih besar dari 1 MB.'
        ]);

        // jika "foto" diisi
        if ($request->hasFile('foto')) {
            // upload "foto"
            $foto = $request->file('foto');
            $foto->storeAs('public/barang', $foto->hashName());

            // simpan data
            Barang::create([
                'id'           => $request->id,
                'nama_barang'  => $request->nama_barang,
                'jenis_id'     => $request->jenis,
                'stok_minimum' => $request->stok_minimum,
                'satuan_id'    => $request->satuan,
                'lokasi_barang' => $request->lokasi_barang,
                'foto'         => $foto->hashName()
            ]);
        }
        // jika "foto" tidak diisi
        else {
            // simpan data
            Barang::create([
                'id'           => $request->id,
                'nama_barang'  => $request->nama_barang,
                'jenis_id'     => $request->jenis,
                'stok_minimum' => $request->stok_minimum,
                'satuan_id'    => $request->satuan,
                'lokasi_barang' => $request->lokasi_barang
            ]);
        }

        // redirect ke halaman index dan tampilkan pesan berhasil simpan data
        return redirect()->route('barang.index')->with('success', 'Data barang berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): View
    {
        // dapatkan data berdasarakan "id"
        $barang = Barang::findOrFail($id);

        // tampilkan form detail data
        return view('barang.show', compact('barang'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        // dapatkan data berdasarakan "id"
        $barang = Barang::findOrFail($id);
        // ambil data jenis barang
        $jenis = Jenis::select('id', 'nama_jenis')
            ->orderBy('nama_jenis', 'asc')
            ->get();
        // ambil data sn   
        // $masukbarang = MasukBarang::select('id', 'serial_number')
        //     ->orderBy('serial_number', 'asc')
        //     ->get();
        // ambil data satuan
        $satuan = Satuan::select('id', 'nama_satuan')
            ->orderBy('nama_satuan', 'asc')
            ->get();

        // tampilkan form ubah data
        return view('barang.edit', compact('barang', 'jenis', 'satuan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        // validasi form
        $request->validate([
            'id'           => 'required',
            'nama_barang'  => 'required',
            'jenis'        => 'required|exists:jenis,id',
            'stok_minimum' => 'required',
            'satuan'       => 'required|exists:satuan,id',
            'lokasi_barang' => 'required',
            'foto'         => 'mimes:jpeg,jpg,png|max:1024'
        ], [
            'id.required'           => 'ID barang tidak boleh kosong.',
            'nama_barang.required'  => 'Nama barang tidak boleh kosong.',
            'jenis.required'        => 'Jenis barang tidak boleh kosong.',
            'jenis.exists'          => 'Jenis barang yang dipilih tidak valid.',
            'stok_minimum.required' => 'Stok minimum tidak boleh kosong.',
            'satuan.required'       => 'Satuan tidak boleh kosong.',
            'lokasi_barang.required' => 'Lokasi barang tidak boleh kosong.',
            'satuan.exists'         => 'Satuan yang dipilih tidak valid.',
            'foto.mimes'            => 'Foto barang harus berupa file dengan jenis: jpeg, jpg, png.',
            'foto.max'              => 'Foto barang tidak boleh lebih besar dari 1 MB.'
        ]);

        // dapatkan data berdasarakan "id"
        $barang = Barang::findOrFail($id);

        // jika "foto" diubah
        if ($request->hasFile('foto')) {
            // upload "foto" baru
            $foto = $request->file('foto');
            $foto->storeAs('public/barang', $foto->hashName());

            // hapus "foto" lama
            Storage::delete('public/barang/' . $barang->foto);

            // ubah data
            $barang->update([
                'nama_barang'  => $request->nama_barang,
                // 'barang_masuk_id' => $request->serial_number,
                'jenis_id'     => $request->jenis,
                'stok_minimum' => $request->stok_minimum,
                'satuan_id'    => $request->satuan,
                'lokasi_barang' => $request->lokasi_barang,
                'foto'         => $foto->hashName()
            ]);
        }
        // jika "foto" tidak diubah
        else {
            // ubah data
            $barang->update([
                'nama_barang'  => $request->nama_barang,
                // 'barang_masuk_id' => $request->serial_number,
                'jenis_id'     => $request->jenis,
                'stok_minimum' => $request->stok_minimum,
                'satuan_id'    => $request->satuan,
                'lokasi_barang' => $request->lokasi_barang
            ]);
        }

        // redirect ke halaman index dan tampilkan pesan berhasil ubah data
        return redirect()->route('barang.index')->with('success', 'Data barang berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): RedirectResponse
    {
        // dapatkan data berdasarakan "id"
        $barang = Barang::findOrFail($id);

        // hapus "foto"
        Storage::delete('public/barang/' . $barang->foto);

        // hapus data
        $barang->delete();

        // redirect ke halaman index dan tampilkan pesan berhasil hapus data
        return redirect()->route('barang.index')->with('success', 'Data barang berhasil dihapus.');
    }
}
