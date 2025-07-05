<x-app-layout>
    <x-slot:page>Detail Data Barang</x-slot:page>

    {{-- Page Title --}}
    <x-page-title>
        Barang
        <x-slot:breadcrumb>Detail</x-slot:breadcrumb>
    </x-page-title>

    <div class="card">
        <div class="card-body">
            {{-- judul form --}}
            <x-form-title>
                <i class="ti ti-list fs-5 me-2"></i> Detail Data Barang
            </x-form-title>

            {{-- tampilkan detail data --}}
            <div class="table-responsive border rounded mb-4">
                <table class="table align-middle text-nowrap mb-0">
                    <tr>
                        <td width="150">ID Barang</td>
                        <td width="10">:</td>
                        <td>{{ $barang->id }}</td>
                    </tr>
                    <tr>
                        <td width="150">Nama Barang</td>
                        <td width="10">:</td>
                        <td>{{ $barang->nama_barang }}</td>
                    </tr>
                    <tr>
                        <td width="150">Jenis Barang</td>
                        <td width="10">:</td>
                        <td>{{ $barang->jenis->nama_jenis }}</td>
                    </tr>
                    <tr>
                        <td width="150">Stok Minimum</td>
                        <td width="10">:</td>
                        <td>{{ $barang->stok_minimum }}</td>
                    </tr>
                    <tr>
                        <td width="150">Stok</td>
                        <td width="10">:</td>
                        <td>{{ $barang->stok }}</td>
                    </tr>
                    <tr>
                        <td width="150">Satuan</td>
                        <td width="10">:</td>
                        <td>{{ $barang->satuan->nama_satuan }}</td>
                    </tr>
                    <tr>
                        <td width="150">Lokasi</td>
                        <td width="10">:</td>
                        <td>{{ $barang->lokasi_barang }}</td>
                    </tr>
                    <tr>
                        <td width="150">Foto Barang</td>
                        <td width="10">:</td>
                        <td>
                            @if (is_null($barang->foto))
                                <img style="max-height:230px" src="{{ asset('images/no-image.svg') }}" class="img-thumbnail rounded-4 shadow-sm" alt="Image">
                            @else
                                <img style="max-height:230px" src="{{ asset('/storage/barang/'.$barang->foto) }}" class="img-thumbnail rounded-4 shadow-sm" alt="Image">
                            @endif
                        </td>
                    </tr>
                </table>
            </div>

            {{-- action buttons --}}
            <x-form-action-buttons>barang</x-form-action-buttons>
        </div>
    </div>
</x-app-layout>