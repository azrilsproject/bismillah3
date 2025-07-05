<x-app-layout>
    <x-slot:page>Barang Keluar</x-slot:page>

    {{-- Page Title --}}
    <x-page-title>Barang Keluar</x-page-title>

    <div class="card">
        <div class="card-body">
            {{-- menampilkan pesan berhasil --}}
            <x-alert></x-alert>

            {{-- menampilkan button tambah data dan form pencarian --}}
            <x-table-header>
                barang-keluar
                <x-slot:tableTitle>Barang Keluar</x-slot:tableTitle>
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
                            <th>Jumlah Keluar</th>
                            <th>Satuan</th>
                            <th>Lokasi Barang</th>
                            <th>Penanggung Jawab</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse ($barangKeluar as $data)
                        {{-- jika data ada, tampilkan data --}}
                        <tr>
                            <td width="30">{{ ++$i }}</td>
                            <td width="100">{{ Carbon\Carbon::parse($data->tanggal)->translatedFormat('j F Y') }}</td>
                            <td width="80">{{ $data->barang_id }}</td>
                            <td width="80">{{ $data->nama_barang }}</td>
                            <td width="80">{{ $data->sn }}</td>
                            <td width="30">{{ $data->jumlah_keluar }}</td>
                            <td width="30">{{ $data->nama_satuan }}</td>
                            <td width="100">{{ $data->lokasi_pengambilan }}</td>                                 
                            <td width="100">{{ $data->penanggung_jawab }}</td>

                            <td width="30">
                                {{-- button modal hapus data --}}
                                <button type="button" class="btn btn-danger btn-sm m-1" data-bs-toggle="modal" data-bs-target="#modalHapus{{ $data->id }}" data-bs-tooltip="tooltip" data-bs-title="Hapus"> 
                                    <i class="ti ti-trash"></i>
                                </button>
                            </td>
                        </tr>

                        {{-- Modal hapus data --}}
                        <x-modal-delete>
                            barang-keluar
                            <x-slot:modalTitle>Barang Keluar</x-slot:modalTitle>
                            <x-slot:modalId>{{ $data->id }}</x-slot:modalId>
                            <x-slot:modalMessage>
                                <div class="alert alert-danger" role="alert">
                                    Anda yakin ingin menghapus data barang keluar?
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
                                        <div class="form-text">Jumlah Keluar</div>
                                        <div>{{ $data->jumlah_keluar }} {{ $data->nama_satuan }}</div>
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
            <div class="pagination-links">{{ $barangKeluar->links() }}</div>
        </div>
    </div>
</x-app-layout>
