<div class="modal fade" id="modalHapus{{ $modalId }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalDeleteLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title text-capitalize" id="exampleModalLabel">
                    <i class="ti ti-trash me-1"></i> Hapus Data {{ $modalTitle ?? $slot }}
                </h1>
            </div>
            <div class="modal-body">
                {{-- informasi data yang akan dihapus --}}
                <p class="mb-2">
                    {{ $modalMessage }}
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default px-4" data-bs-dismiss="modal">Batal</button>
                {{-- button hapus data --}}
                <form action="{{ route($slot . '.destroy', $modalId) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger"> Ya, Hapus! </button>
                </form>
            </div>
        </div>
    </div>
</div>