<x-app-layout>
    <x-slot:page>Tambah Data Barang</x-slot:page>

    {{-- Page Title --}}
    <x-page-title>
        Barang
        <x-slot:breadcrumb>Tambah</x-slot:breadcrumb>
    </x-page-title>

    <div class="card">
        <div class="card-body">
            {{-- judul form --}}
            <x-form-title>
                <i class="ti ti-pencil-plus fs-5 me-2"></i> Tambah Data Barang
            </x-form-title>
            
            {{-- form tambah data --}}
            <form action="{{ route('barang.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="row">
                    <div class="col-xl-7">
                        <div class="mb-3 pe-xl-3">
                            <label class="form-label">ID Barang <span class="text-danger">*</span></label>
                            <input type="text" name="id" class="form-control @error('id') is-invalid @enderror" value="{{ $idBarang }}" readonly>
                            
                            {{-- pesan error untuk id --}}
                            @error('id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3 pe-xl-3">
                            <label class="form-label">Nama Barang <span class="text-danger">*</span></label>
                            <input type="text" name="nama_barang" class="form-control @error('nama_barang') is-invalid @enderror" value="{{ old('nama_barang') }}" autocomplete="off">
                            
                            {{-- pesan error untuk nama barang --}}
                            @error('nama_barang')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3 pe-xl-3">
                            <label class="form-label">Jenis Barang <span class="text-danger">*</span></label>
                            <select name="jenis" class="form-select select2-single @error('jenis') is-invalid @enderror" autocomplete="off">
                                <option selected disabled value="">-- Pilih --</option>
                                @foreach ($jenis as $data)
                                    <option {{ old('jenis') == $data->id ? 'selected' : '' }} value="{{ $data->id }}">{{ $data->nama_jenis }}</option>
                                @endforeach
                            </select>
    
                            {{-- pesan error untuk jenis --}}
                            @error('jenis')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3 pe-xl-3">
                            <label class="form-label">Stok Minimum <span class="text-danger">*</span></label>
                            <input type="number" name="stok_minimum" class="form-control @error('stok_minimum') is-invalid @enderror" value="{{ old('stok_minimum') }}" autocomplete="off">
                            
                            {{-- pesan error untuk stok minimum --}}
                            @error('stok_minimum')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3 mb-xl-0 pe-xl-3">
                            <label class="form-label">Satuan <span class="text-danger">*</span></label>
                            <select name="satuan" class="form-select select2-single @error('satuan') is-invalid @enderror" autocomplete="off">
                                <option selected disabled value="">-- Pilih --</option>
                                @foreach ($satuan as $data)
                                    <option {{ old('satuan') == $data->id ? 'selected' : '' }} value="{{ $data->id }}">{{ $data->nama_satuan }}</option>
                                @endforeach
                            </select>
    
                            {{-- pesan error untuk satuan --}}
                            @error('satuan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <hr class="mt-4 mb-3">
                         <div class="mb-3">
                            <label class="form-label">Lokasi Barang <span class="text-danger">*</span></label>
                            <input type="text" name="lokasi_barang" class="form-control @error('nama_barang') is-invalid @enderror" value="{{ old('lokasi_barang') }}" autocomplete="off">
                            
                            {{-- pesan error untuk nama barang --}}
                            @error('nama_barang')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div> 
                        
                    </div>
                    <div class="col-xl-5">
                        <div class="ps-xl-3">
                            <label class="form-label">Foto Barang</label>
                            <input type="file" accept=".jpg, .jpeg, .png" name="foto" id="image" class="form-control @error('foto') is-invalid @enderror" autocomplete="off">
                            
                            {{-- pesan error untuk foto --}}
                            @error('foto')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
    
                            {{-- preview foto --}}
                            <div class="mt-4">
                                <img style="max-height:230px" id="imagePreview" src="{{ asset('images/no-image.svg') }}" class="img-thumbnail rounded-4 shadow-sm" alt="Image">
                            </div>
    
                            <div class="form-text text-primary mt-4 mb-0">
                                <div class="badge fw-medium bg-primary-subtle text-primary">Keterangan :</div>
                                <div>
                                    - Jenis file yang bisa diunggah adalah: jpg, jpeg, png. <br>
                                    - Ukuran file yang bisa diunggah maksimal 1 MB.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        
                {{-- action buttons --}}
                <x-form-action-buttons>barang</x-form-action-buttons>
            </form>
        </div>
    </div>
</x-app-layout>