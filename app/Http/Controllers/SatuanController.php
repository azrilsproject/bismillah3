<?php

namespace App\Http\Controllers;

use App\Models\Satuan;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class SatuanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        // jumlah data yang ditampilkan per paginasi halaman
        $pagination = 10;

        if ($request->search) {
            // menampilkan pencarian data
            $satuan = Satuan::select('id', 'nama_satuan')
                ->where('nama_satuan', 'LIKE', '%' . $request->search . '%')
                ->paginate($pagination)
                ->withQueryString();
        } else {
            // menampilkan semua data
            $satuan = Satuan::select('id', 'nama_satuan')
                ->latest()
                ->paginate($pagination);
        }

        // tampilkan data ke view
        return view('satuan.index', compact('satuan'))->with('i', ($request->input('page', 1) - 1) * $pagination);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        // tampilkan form tambah data
        return view('satuan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        // validasi form
        $request->validate([
            'satuan' => 'required|unique:satuan,nama_satuan'
        ], [
            'satuan.required' => 'Satuan tidak boleh kosong.',
            'satuan.unique'   => 'Satuan sudah ada.'
        ]);

        // simpan data
        Satuan::create([
            'nama_satuan' => $request->satuan
        ]);

        // redirect ke halaman index dan tampilkan pesan berhasil simpan data
        return redirect()->route('satuan.index')->with('success', 'Data satuan berhasil disimpan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        // dapatkan data berdasarakan "id"
        $satuan = Satuan::findOrFail($id);

        // tampilkan form ubah data
        return view('satuan.edit', compact('satuan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        // validasi form
        $request->validate([
            'satuan' => 'required|unique:satuan,nama_satuan,' . $id
        ], [
            'satuan.required' => 'Satuan tidak boleh kosong.',
            'satuan.unique'   => 'Satuan sudah ada.'
        ]);

        // dapatkan data berdasarakan "id"
        $satuan = Satuan::findOrFail($id);

        // ubah data
        $satuan->update([
            'nama_satuan' => $request->satuan
        ]);

        // redirect ke halaman index dan tampilkan pesan berhasil ubah data
        return redirect()->route('satuan.index')->with('success', 'Data satuan berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): RedirectResponse
    {
        // dapatkan data berdasarakan "id"
        $satuan = Satuan::findOrFail($id);

        // hapus data
        $satuan->delete();

        // redirect ke halaman index dan tampilkan pesan berhasil hapus data
        return redirect()->route('satuan.index')->with('success', 'Data satuan berhasil dihapus.');
    }
}
