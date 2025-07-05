<x-app-layout>
    <x-slot:page>Tambah Data Satuan</x-slot:page>

    {{-- Page Title --}}
    <x-page-title>
        Satuan
        <x-slot:breadcrumb>Tambah</x-slot:breadcrumb>
    </x-page-title>

    <div class="card">
        <div class="card-body">
            {{-- judul form --}}
            <x-form-title>
                <i class="ti ti-pencil-plus fs-5 me-2"></i> Tambah Data Satuan
            </x-form-title>
            
            {{-- form tambah data --}}
            <form action="{{ route('satuan.store') }}" method="POST">
                @csrf
                
                <div class="row">
                    <div class="col-xl-6">
                        <label class="form-label">Satuan <span class="text-danger">*</span></label>
                        <input type="text" name="satuan" class="form-control @error('satuan') is-invalid @enderror" value="{{ old('satuan') }}" autocomplete="off">
                        
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