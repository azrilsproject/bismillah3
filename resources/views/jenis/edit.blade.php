<x-app-layout>
    <x-slot:page>Ubah Data Jenis Barang</x-slot:page>

    {{-- Page Title --}}
    <x-page-title>
        Jenis Barang
        <x-slot:breadcrumb>Ubah</x-slot:breadcrumb>
    </x-page-title>

    <div class="card">
        <div class="card-body">
            {{-- judul form --}}
            <x-form-title>
                <i class="ti ti-edit fs-5 me-2"></i> Ubah Data Jenis Barang
            </x-form-title>
            
            {{-- form ubah data --}}
            <form action="{{ route('jenis.update', $jenis->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="row">
                    <div class="col-xl-6">
                        <label class="form-label">Jenis Barang <span class="text-danger">*</span></label>
                        <input type="text" name="jenis" class="form-control @error('jenis') is-invalid @enderror" value="{{ old('jenis', $jenis->nama_jenis) }}" autocomplete="off">
                        
                        {{-- pesan error untuk jenis --}}
                        @error('jenis')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
        
                {{-- action buttons --}}
                <x-form-action-buttons>jenis</x-form-action-buttons>
            </form>
        </div>
    </div>
</x-app-layout>