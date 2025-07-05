<x-app-layout>
    <x-slot:page>Tambah Data Barang Keluar</x-slot:page>

    {{-- Page Title --}}
    <x-page-title>
        Barang Keluar
        <x-slot:breadcrumb>Tambah</x-slot:breadcrumb>
    </x-page-title>

    <div class="card">
        <div class="card-body">
            {{-- judul form --}}
            <x-form-title>
                <i class="ti ti-pencil-plus fs-5 me-2"></i> Tambah Data Barang Keluar
            </x-form-title>
            
            {{-- form tambah data --}}
            <form action="{{ route('barang-keluar.store') }}" method="POST">
                @csrf
                
                <div class="row">
                    <div class="col-xl-6">
                        <div class="mb-3">
                            <label class="form-label">Tanggal <span class="text-danger">*</span></label>
                            <input type="text" name="tanggal" class="form-control datepicker @error('tanggal') is-invalid @enderror" value="{{ old('tanggal') }}" autocomplete="off">
                            
                            {{-- pesan error untuk tanggal --}}
                            @error('tanggal')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <hr class="mt-4 mb-3">

                        <div class="mb-3">
                            <label class="form-label">Barang <span class="text-danger">*</span></label>
                            <select id="barang" name="barang" class="form-select select2-single @error('barang') is-invalid @enderror" autocomplete="off">
                                <option selected disabled value="">-- Pilih --</option>
                                @foreach ($barang as $data)
                                    <option {{ old('gabungan') == $data->id ? 'selected' : '' }} 
                                        value="{{ $data->id }}" 
                                        data-stok="{{ $data->stok }}" 
                                        data-satuan="{{ $data->satuan->nama_satuan }}">{{ $data->id }} - {{ $data->nama_barang }}</option>
                                @endforeach
                            </select>
    
                            {{-- pesan error untuk barang --}}
                            @error('barang')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                       <hr class="mt-4 mb-3">

                        <div class="mb-3">
                            <label class="form-label">Serial Number <span class="text-danger">*</span></label>
                            <input type="text" id="sn" name="sn" class="form-control @error('sn') is-invalid @enderror" value="{{ old('sn') }}" autocomplete="off">
                            
                            {{-- pesan error untuk jumlah keluar --}}
                            @error('sn')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Stok <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="text" id="stok" name="stok" class="form-control @error('stok') is-invalid @enderror" value="{{ old('stok') }}" readonly>
                                <span class="input-group-text">
                                    <input type="text" id="satuan" name="satuan" class="input-group-text-input" value="{{ old('satuan') }}" readonly>
                                </span>

                                {{-- pesan error untuk stok --}}
                                @error('stok')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <hr class="mt-4 mb-3">

                        <div class="mb-3">
                            <label class="form-label">Jumlah Keluar <span class="text-danger">*</span></label>
                            <input type="number" id="jumlah_keluar" name="jumlah_keluar" class="form-control @error('jumlah_keluar') is-invalid @enderror" value="{{ old('jumlah_keluar') }}" autocomplete="off">
                            
                            {{-- pesan error untuk jumlah keluar --}}
                            @error('jumlah_keluar')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div>
                            <label class="form-label">Sisa Stok <span class="text-danger">*</span></label>
                            <input type="text" id="sisa" name="sisa" class="form-control @error('sisa') is-invalid @enderror" value="{{ old('sisa') }}" readonly>
                            
                            {{-- pesan error untuk sisa --}}
                            @error('sisa')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                       <hr class="mt-4 mb-3">

                        <div class="mb-3">
                            <label class="form-label">Lokasi Pengambilan <span class="text-danger">*</span></label>
                            <input type="text" id="lokasi_pengambilan" name="lokasi_pengambilan" class="form-control @error('lokasi_pengambilan') is-invalid @enderror" value="{{ old('lokasi_pengambilan') }}" autocomplete="off">
                            
                            {{-- pesan error untuk jumlah keluar --}}
                            @error('lokasi_pengambilan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>                        
                       <hr class="mt-4 mb-3">

                        <div class="mb-3">
                            <label class="form-label">Nama Penanggung Jawab <span class="text-danger">*</span></label>
                            <input type="text" id="penanggung_jawab" name="penanggung_jawab" class="form-control @error('penanggung_jawab') is-invalid @enderror" value="{{ old('penanggung_jawab') }}" autocomplete="off">
                            
                            {{-- pesan error untuk jumlah keluar --}}
                            @error('jumlah_keluar')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
        
                {{-- action buttons --}}
                <x-form-action-buttons>barang-keluar</x-form-action-buttons>
            </form>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            // Menampilkan data barang dari select box ke textfield
            $('#barang').change(function() {
                // mengambil data dari selected option
                var stok = $(this).children('option:selected').data('stok');
                var satuan = $(this).children('option:selected').data('satuan');

                // tampilkan data
                $('#stok').val(stok);
                $('#satuan').val(satuan);
                // reset data
                $('#jumlah_keluar').val('');
                $('#sisa').val(0);
                // set focus
                setTimeout(function() {
                    $('#jumlah_keluar').focus()
                }, 0);
            });

            // menghitung sisa
            $('#jumlah_keluar').keyup(function() {
                // mengambil data dari form entri
                var stok = $('#stok').val();
                var jumlah = $('#jumlah_keluar').val();

                // mengecek input data
                // jika data barang belum diisi
                if (stok == "") {
                    // reset input jumlah keluar
                    $('#jumlah_keluar').val('');
                    // sisa stok kosong
                    var sisa = "";
                }
                // jika jumlah keluar belum diisi
                else if (jumlah == "") {
                    // sisa stok kosong
                    var sisa = "";
                }
                // jika jumlah keluar diisi <= 0
                else if (jumlah <= 0) {
                    // reset input jumlah keluar
                    $('#jumlah_keluar').val('');
                    // sisa stok kosong
                    var sisa = "";
                }
                // jika jumlah keluar lebih dari stok
                else if (eval(jumlah) > eval(stok)) {
                    // reset input jumlah keluar
                    $('#jumlah_keluar').val('');
                    // sisa stok kosong
                    var sisa = "";
                }
                // jika data sudah diisi
                else {
                    // hitung sisa
                    var sisa = eval(stok) - eval(jumlah);
                }
                
                // tampilkan sisa
                $('#sisa').val(sisa);
            });
        });
    </script>
</x-app-layout>