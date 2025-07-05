<x-app-layout>
    <x-slot:page>Barang Masuk</x-slot:page>

    {{-- Page Title --}}
    <x-page-title>Barang Masuk</x-page-title>

    <div class="card">
        <div class="card-body">
            {{-- menampilkan pesan berhasil --}}
            <x-alert></x-alert>

            {{-- menampilkan button tambah data dan form pencarian --}}
            <x-table-header>
                barang-masuk
                <x-slot:tableTitle>Barang Masuk</x-slot:tableTitle>
            </x-table-header>

            {{-- tabel tampil data --}}
            <div class="table-responsive border rounded mb-4">
                <table class="table align-middle text-nowrap mb-0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>ID Barang</th>
                            <th>Nama Barang</th>
                            <th>SN</th>
                            <th>Jumlah Masuk</th>
                            <th>Satuan</th>
                            <th>Lokasi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse ($barangMasuk as $data)
                        {{-- jika data ada, tampilkan data --}}
                        <tr>
                            <td width="30">{{ ++$i }}</td>
                            <td width="100">{{ Carbon\Carbon::parse($data->tanggal)->translatedFormat('j F Y') }}</td>
                            <td width="80">{{ $data->barang_id }}</td>
                            <td width="100">{{ $data->nama_barang }}</td>
                            <td width="100">{{ $data->serial_number }}</td>
                            <td width="100">{{ $data->jumlah_masuk }}</td>
                            <td width="100">{{ $data->nama_satuan }}</td>
                            <td width="100">{{ $data->lokasi_penyimpanan }}</td>

                            <td width="30">
                                {{-- button modal hapus data --}}
                                <button type="button" class="btn btn-danger btn-sm m-1" data-bs-toggle="modal" data-bs-target="#modalHapus{{ $data->id }}" data-bs-tooltip="tooltip" data-bs-title="Hapus"> 
                                    <i class="ti ti-trash"></i>
                                </button>
                            </td>
                        </tr>

                        {{-- Modal hapus data --}}
                        <x-modal-delete>
                            barang-masuk
                            <x-slot:modalTitle>Barang Masuk</x-slot:modalTitle>
                            <x-slot:modalId>{{ $data->id }}</x-slot:modalId>
                            <x-slot:modalMessage>
                                <div class="alert alert-danger" role="alert">
                                    Anda yakin ingin menghapus data barang masuk?
                                </div>
                                <div class="border rounded p-4">
                                    <div>
                                        <div class="form-text mt-0">Tanggal</div>
                                        <div>{{ Carbon\Carbon::parse($data->tanggal)->translatedFormat('j F Y') }}</div>
                                    </div>
                                    <div>
                                        <div class="form-text">Barang</div>
                                        <div>{{ $data->barang_id }} - {{ $data->nama_barang }}</div>
                                    </div>
                                    <div>
                                        <div class="form-text">Jumlah Masuk</div>
                                        <div>{{ $data->jumlah_masuk }} {{ $data->nama_satuan }}</div>
                                    </div>
                                </div>
                            </x-slot:modalMessage>
                        </x-modal-delete>
                    @empty
                        {{-- jika data tidak ada, tampilkan pesan data tidak tersedia --}}
                        <tr>
                            <td colspan="7">
                                <div class="d-flex justify-content-center align-items-center">
                                    <i class="ti ti-info-circle fs-5 me-2"></i>
                                    <div>Tidak ada data tersedia.</div>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
            {{-- pagination --}}
            <div class="pagination-links">{{ $barangMasuk->links() }}</div>
        </div>
    </div>
</x-app-layout>
