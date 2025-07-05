<x-app-layout>
    <x-slot:page>Satuan</x-slot:page>

    {{-- Page Title --}}
    <x-page-title>Satuan</x-page-title>

    <div class="card">
        <div class="card-body">
            {{-- menampilkan pesan berhasil --}}
            <x-alert></x-alert>

            {{-- menampilkan button tambah data dan form pencarian --}}
            <x-table-header>satuan</x-table-header>

            {{-- tabel tampil data --}}
            <div class="table-responsive border rounded mb-4">
                <table class="table align-middle text-nowrap mb-0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Satuan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse ($satuan as $data)
                        {{-- jika data ada, tampilkan data --}}
                        <tr>
                            <td width="30">{{ ++$i }}</td>
                            <td width="300">{{ $data->nama_satuan }}</td>
                            <td width="70">
                                {{-- button form ubah data --}}
                                <a href="{{ route('satuan.edit', $data->id) }}" class="btn btn-secondary btn-sm m-1" data-bs-tooltip="tooltip" data-bs-title="Ubah">
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
                            satuan
                            <x-slot:modalId>{{ $data->id }}</x-slot:modalId>
                            <x-slot:modalMessage>
                                Anda yakin ingin menghapus data satuan <span class="fw-bold">{{ $data->nama_satuan }}</span>?
                            </x-slot:modalMessage>
                        </x-modal-delete>
                    @empty
                        {{-- jika data tidak ada, tampilkan pesan data tidak tersedia --}}
                        <tr>
                            <td colspan="3">
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
            <div class="pagination-links">{{ $satuan->links() }}</div>
        </div>
    </div>
</x-app-layout>
