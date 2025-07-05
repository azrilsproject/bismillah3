<x-app-layout>
    <x-slot:page>Barang</x-slot:page>

    {{-- Page Title --}}
    <x-page-title>Barang</x-page-title>

    <div class="card">
        <div class="card-body">
            {{-- menampilkan pesan berhasil --}}
            <x-alert></x-alert>

            {{-- menampilkan button tambah data dan form pencarian --}}
            <x-table-header>barang</x-table-header>

            {{-- tabel tampil data --}}
            <div class="table-responsive border rounded mb-4">
                <table class="table align-middle text-nowrap mb-0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ID Barang</th>
                            <th>Nama Barang</th>
                            <th>Jenis Barang</th>
                            <th>Stok</th>
                            <th>Satuan</th>
                            <th>Lokasi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse ($barang as $data)
                        {{-- jika data ada, tampilkan data --}}
                        <tr>
                            <td width="30">{{ ++$i }}</td>
                            <td width="80">{{ $data->id }}</td>
                            <td width="200">{{ $data->nama_barang }}</td>
                            <td width="180">{{ $data->jenis->nama_jenis }}</td>
                            <td width="100">{{ $data->stok }}</td>
                            <td width="120">{{ $data->satuan->nama_satuan }}</td>
                            <td width="100">{{ $data->lokasi_barang }}</td>
                            <td width="100">
                                {{-- button form detail data --}}
                                <a href="{{ route('barang.show', $data->id) }}" class="btn btn-warning btn-sm m-1" data-bs-tooltip="tooltip" data-bs-title="Detail">
                                    <i class="ti ti-list"></i>
                                </a>
                                {{-- button form ubah data --}}
                                <a href="{{ route('barang.edit', $data->id) }}" class="btn btn-secondary btn-sm m-1" data-bs-tooltip="tooltip" data-bs-title="Ubah">
                                    <i class="ti ti-edit"></i>
                                </a>
                                {{-- button modal hapus data --}}
                                <button type="button" class="btn btn-danger btn-sm m-1" data-bs-toggle="modal" data-bs-target="#modalHapus{{ $data->id }}" data-bs-tooltip="tooltip" data-bs-title="Hapus"> 
                                    <i class="ti ti-trash"></i>
                                </button>
                            </td>
                        </tr>

                        {{-- Modal hapus data --}}
                        <x-modal-delete>
                            barang
                            <x-slot:modalId>{{ $data->id }}</x-slot:modalId>
                            <x-slot:modalMessage>
                                Anda yakin ingin menghapus data barang <span class="fw-bold">{{ $data->id }} - {{ $data->nama_barang }}</span>?
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
            <div class="pagination-links">{{ $barang->links() }}</div>
        </div>
    </div>
</x-app-layout>
