<x-app-layout>
    <x-slot:page>Laporan Barang Masuk</x-slot:page>

    {{-- Page Title --}}
    <x-page-title>Laporan Barang Masuk</x-page-title>

    <div class="card">
        <div class="card-body">
            {{-- judul form --}}
            <x-form-title>
                <i class="ti ti-filter fs-5 me-2"></i> Filter Data Barang Masuk
            </x-form-title>

            {{-- form filter data --}}
            <form action="{{ route('laporan-barang-masuk.filter') }}" method="GET">
                <div class="row">
                    <div class="col-lg-3">
                        <label class="form-label">Tanggal Awal <span class="text-danger">*</span></label>
                        <input type="text" name="tgl_awal" class="form-control datepicker @error('tgl_awal') is-invalid @enderror" value="{{ old('tgl_awal', request('tgl_awal')) }}" autocomplete="off">
                        
                        {{-- pesan error untuk tgl_awal --}}
                        @error('tgl_awal')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="col-lg-3">
                        <label class="form-label">Tanggal Akhir <span class="text-danger">*</span></label>
                        <input type="text" name="tgl_akhir" class="form-control datepicker @error('tgl_akhir') is-invalid @enderror" value="{{ old('tgl_akhir', request('tgl_akhir')) }}" autocomplete="off">
                        
                        {{-- pesan error untuk tgl_akhir --}}
                        @error('tgl_akhir')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
        
                {{-- action buttons --}}
                <x-form-action-buttons>laporan-barang-masuk</x-form-action-buttons>
            </form>
        </div>
    </div>

    @if (request(['tgl_awal', 'tgl_akhir']))
        <div class="card">
            <div class="card-body">
                <div class="d-sm-flex justify-content-between align-items-center mb-4">
                    <div class="d-flex align-items-center">
                        {{-- judul laporan --}}
                        <h6 class="report-title mb-0">
                            <i class="ti ti-file-text fs-5 align-text-top me-1"></i> 
                            Laporan Data Barang Masuk Tanggal {{ Carbon\Carbon::parse(request('tgl_awal'))->translatedFormat('j F Y') }} s.d. {{ Carbon\Carbon::parse(request('tgl_akhir'))->translatedFormat('j F Y') }}
                        </h6>
                    </div>

                    <div class="d-grid gap-2 mb-3 mb-sm-0">
                        {{-- button cetak laporan (export PDF) --}}
                        <a href="{{ route('laporan-barang-masuk.print', [request('tgl_awal'), request('tgl_akhir')]) }}" target="_blank" class="btn btn-warning px-4">
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
                                <th>Tanggal</th>
                                <th>ID Barang</th>
                                <th>Nama Barang</th>
                                <th>Serial Number</th>
                                <th>Jumlah Masuk</th>
                                <th>Satuan</th>
                                <th>Lokasi</th>
                            </tr>
                        </thead>
                        <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @forelse ($barangMasuk as $data)
                            {{-- jika data ada, tampilkan data --}}
                            <tr>
                                <td width="30">{{ $no++ }}</td>
                                <td width="100">{{ Carbon\Carbon::parse($data->tanggal)->translatedFormat('j F Y') }}</td>
                                <td width="80">{{ $data->barang_id }}</td>
                                <td width="200">{{ $data->nama_barang }}</td>
                                <td width="100">{{ $data->serial_number }}</td>
                                <td width="100">{{ $data->jumlah_masuk }}</td>
                                <td width="120">{{ $data->nama_satuan }}</td>
                                <td width="120">{{ $data->lokasi_penyimpanan }}</td>


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
