<x-app-layout>
    <x-slot:page>Laporan Stok</x-slot:page>

    {{-- Page Title --}}
    <x-page-title>Laporan Stok</x-page-title>

    <div class="card">
        <div class="card-body">
            {{-- judul form --}}
            <x-form-title>
                <i class="ti ti-filter fs-5 me-2"></i> Filter Data Stok
            </x-form-title>

            {{-- form filter data --}}
            <form action="{{ route('laporan-stok.filter') }}" method="GET">
                <div class="row">
                    <div class="col-lg-6 col-xxl-4">
                        <label class="form-label">Stok <span class="text-danger">*</span></label>
                        <select name="stok" class="form-select select2-single @error('stok') is-invalid @enderror" autocomplete="off">
                            <option {{ old('stok', request('stok')) == 'Seluruh' ? 'selected' : '' }} value="Seluruh">Seluruh</option>
                            <option {{ old('stok', request('stok')) == 'Minimum' ? 'selected' : '' }} value="Minimum">Minimum</option>
                        </select>
                        
                        {{-- pesan error untuk stok --}}
                        @error('stok')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
        
                {{-- action buttons --}}
                <x-form-action-buttons>laporan-stok</x-form-action-buttons>
            </form>
        </div>
    </div>

    @if (request('stok'))
        <div class="card">
            <div class="card-body">
                <div class="d-sm-flex justify-content-between align-items-center mb-4">
                    <div class="d-flex align-items-center">
                        {{-- judul laporan --}}
                        <h6 class="report-title mb-0">
                            <i class="ti ti-file-text fs-5 align-text-top me-1"></i>
                            {{ request('stok') == 'Seluruh' 
                                ? 'Laporan Stok Seluruh Barang'
                                : 'Laporan Stok Barang yang Mencapai Batas Minimum' 
                            }}
                        </h6>
                    </div>

                    <div class="d-grid gap-2 mb-3 mb-sm-0">
                        {{-- button cetak laporan (export PDF) --}}
                        <a href="{{ route('laporan-stok.print', [request('stok')]) }}" target="_blank" class="btn btn-warning px-4">
                            <i class="ti ti-printer me-2"></i> Cetak
                        </a>
                    </div>
                </div>

                {{-- tabel tampil data --}}
                <div class="table-responsive border rounded mb-2">
                    <table class="table align-middle text-nowrap mb-0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>ID Barang</th>
                                <th>Nama Barang</th>
                                <!-- <th>Serial Number</th> -->
                                <th>Jenis Barang</th>
                                <th>Stok Masuk</th>
                                <th>Stok Keluar</th>
                                <th>Total Stok</th>
                                <th>Satuan</th>
                                <th>Lokasi Barang</th>
                            </tr>
                        </thead>
                        <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @forelse ($barang as $data)

                            {{-- jika data ada, tampilkan data --}}
                            <tr>
                                <td width="30">{{ $no++ }}</td>
                                <td width="80">{{ $data->id }}</td>
                                <td width="100">{{ $data->nama_barang }}</td>
                                <!-- <td width="100">
                                    @foreach($data->barang_masuk as $masuk)
                                        {{ $masuk->serial_number }}<br>
                                    @endforeach                                     -->
                                </td> 
                                <td width="180">{{ $data->jenis->nama_jenis }}</td>
                                <td width="100">
                                    {{ $data->barang_masuk->sum('jumlah_masuk') }}</td>
                                    <!-- @foreach($data-> barang_masuk as $masuk)
                                        {{ $masuk->jumlah_masuk }}<br>
                                    @endforeach                      -->
                                </td> 
                                <td width="100">
                                    {{ $data->barang_keluar->sum('jumlah_keluar') }}</td>
                                    <!-- @foreach($data->barang_keluar as $keluar)
                                        {{ $keluar->jumlah_keluar }}<br>
                                    @endforeach                                     -->
                                </td> 
                                <td width="100">{{ $data->stok }}</td>
                                <td width="120">{{ $data->satuan->nama_satuan }}</td>
                                <td width="100">{{ $data->lokasi_barang}}</td>                                 
                                </td> 
                            </tr>
                        @empty
                            {{-- jika data tidak ada, tampilkan pesan data tidak tersedia --}}
                            <tr>
                                <td colspan="6">
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
            </div>
        </div>
    @endif
</x-app-layout>
