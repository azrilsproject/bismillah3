<x-app-layout>
    <x-slot:page>Tambah Data Barang Masuk</x-slot:page>

    {{-- Page Title --}}
    <x-page-title>
        Barang Masuk
        <x-slot:breadcrumb>Tambah</x-slot:breadcrumb>
    </x-page-title>

    <div class="card">
        <div class="card-body">
            {{-- judul form --}}
            <x-form-title>
                <i class="ti ti-pencil-plus fs-5 me-2"></i> Tambah Data Barang Masuk
            </x-form-title>
            
            {{-- form tambah data --}}
            <form action="{{ route('barang-masuk.store') }}" method="POST">
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
                                    <option {{ old('barang') == $data->id ? 'selected' : '' }} value="{{ $data->id }}" data-stok="{{ $data->stok }}" data-satuan="{{ $data->satuan->nama_satuan }}">{{ $data->id }} - {{ $data->nama_barang }}</option>
                                @endforeach
                            </select>
    
                            {{-- pesan error untuk barang --}}
                            @error('barang')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <!-- <div class="col-xl-6">
                        <div class="mb-3"> -->
                        <div>                        
                            <label class="form-label">Serial Number <span class="text-danger">*</span></label>
                            <input type="text" id="serial_number" name="serial_number" class="form-control @error('serial_number') is-invalid @enderror" value="{{ old('serial_number') }}" autocomplete="off">
                            
                            {{-- pesan error untuk lokasi_penyimpanan --}}
                            @error('serial_number')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror                

                        <hr class="mt-4 mb-3">

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
                            <label class="form-label">Jumlah Masuk <span class="text-danger">*</span></label>
                            <input type="number" id="jumlah_masuk" name="jumlah_masuk" class="form-control @error('jumlah_masuk') is-invalid @enderror" value="{{ old('jumlah_masuk') }}" autocomplete="off">
                            
                            {{-- pesan error untuk jumlah masuk --}}
                            @error('jumlah_masuk')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        
                        <div>
                            <label class="form-label">Total Stok <span class="text-danger">*</span></label>
                            <input type="text" id="total" name="total" class="form-control @error('total') is-invalid @enderror" value="{{ old('total') }}" readonly>
                            
                            {{-- pesan error untuk total --}}
                            @error('total')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <hr class="mt-4 mb-3">
                         <div class="mb-3">
                            <label class="form-label">Lokasi Penyimpanan <span class="text-danger">*</span></label>
                            <input type="text" id="lokasi_penyimpanan" name="lokasi_penyimpanan" class="form-control @error('lokasi_penyimpanan') is-invalid @enderror" value="{{ old('lokasi_penyimpanan') }}" autocomplete="off">
                            
                            {{-- pesan error untuk lokasi_penyimpanan --}}
                            @error('lokasi_penyimpanan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
        
                {{-- action buttons --}}
                <x-form-action-buttons>barang-masuk</x-form-action-buttons>
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
                $('#jumlah_masuk').val('');
                $('#total').val(0);
                // set focus
                setTimeout(function() {
                    $('#jumlah_masuk').focus()
                }, 0);
            });

            // menghitung total
            $('#jumlah_masuk').keyup(function() {
                // mengambil data dari form entri
                var stok = $('#stok').val();
                var jumlah = $('#jumlah_masuk').val();

                // mengecek input data
                // jika data barang belum diisi
                if (stok == "") {
                    // reset input jumlah masuk
                    $('#jumlah_masuk').val('');
                    // total stok kosong
                    var total = "";
                }
                // jika jumlah masuk belum diisi
                else if (jumlah == "") {
                    // total stok kosong
                    var total = "";
                }
                // jika jumlah masuk diisi <= 0
                else if (jumlah <= 0) {
                    // reset input jumlah masuk
                    $('#jumlah_masuk').val('');
                    // total stok kosong
                    var total = "";
                }
                // jika data sudah diisi
                else {
                    // hitung total
                    var total = eval(stok) + eval(jumlah);
                }
                
                // tampilkan total
                $('#total').val(total);
            });
        });
    </script>
</x-app-layout>