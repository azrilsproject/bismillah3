<x-app-layout>
    <x-slot:page>Ubah Data User</x-slot:page>

    {{-- Page Title --}}
    <x-page-title>
        User
        <x-slot:breadcrumb>Ubah</x-slot:breadcrumb>
    </x-page-title>

    <div class="card">
        <div class="card-body">
            {{-- judul form --}}
            <x-form-title>
                <i class="ti ti-edit fs-5 me-2"></i> Ubah Data User
            </x-form-title>
            
            {{-- form ubah data --}}
            <form action="{{ route('user.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="row">
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label class="form-label">Nama User <span class="text-danger">*</span></label>
                            <input type="text" name="nama_user" class="form-control @error('nama_user') is-invalid @enderror" value="{{ old('nama_user', $user->nama_user) }}" autocomplete="off">
                            
                            {{-- pesan error untuk nama user --}}
                            @error('nama_user')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Username <span class="text-danger">*</span></label>
                            <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" value="{{ old('username', $user->username) }}" autocomplete="off">
                            
                            {{-- pesan error untuk username --}}
                            @error('username')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" autocomplete="off">
                            
                            {{-- pesan error untuk password --}}
                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div>
                            <label class="form-label">Role <span class="text-danger">*</span></label>
                            <select name="role" class="form-select select2-single @error('role') is-invalid @enderror" autocomplete="off">
                                <option disabled value="">-- Pilih --</option>
                                <option {{ old('role', $user->role) == 'Admin Logistik' ? 'selected' : '' }} value="Admin Logistik">Admin Logistik</option>
                                <option {{ old('role', $user->role) == 'Staff Logistik' ? 'selected' : '' }} value="Staff Logistik">Staff Logistik</option>
                                <option {{ old('role', $user->role) == 'Manajer Logistik' ? 'selected' : '' }} value="Manajer Logistik">Manajer Logistik</option>
                            </select>
    
                            {{-- pesan error untuk role --}}
                            @error('role')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
        
                {{-- action buttons --}}
                <x-form-action-buttons>user</x-form-action-buttons>
            </form>
        </div>
    </div>
</x-app-layout>