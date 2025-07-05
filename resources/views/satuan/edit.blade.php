<x-app-layout>
    <x-slot:page>Ubah Data Satuan</x-slot:page>

    {{-- Page Title --}}
    <x-page-title>
        Satuan
        <x-slot:breadcrumb>Ubah</x-slot:breadcrumb>
    </x-page-title>

    <div class="card">
        <div class="card-body">
            {{-- judul form --}}
            <x-form-title>
                <i class="ti ti-edit fs-5 me-2"></i> Ubah Data Satuan
            </x-form-title>
            
            {{-- form ubah data --}}
            <form action="{{ route('satuan.update', $satuan->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="row">
                    <div class="col-xl-6">
                        <label class="form-label">Satuan <span class="text-danger">*</span></label>
                        <input type="text" name="satuan" class="form-control @error('satuan') is-invalid @enderror" value="{{ old('satuan', $satuan->nama_satuan) }}" autocomplete="off">
                        
                        {{-- pesan error untuk satuan --}}
                        @error('satuan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
        
                {{-- action buttons --}}
                <x-form-action-buttons>satuan</x-form-action-buttons>
            </form>
        </div>
    </div>
</x-app-layout>