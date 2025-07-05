<div class="d-sm-flex flex-sm-row-reverse justify-content-between align-items-center mb-4">
    <div class="d-grid gap-2 mb-3 mb-sm-0">
        {{-- button form tambah data --}}
        <a href="{{ route($slot . '.create') }}" class="btn btn-secondary text-capitalize">
            <i class="ti ti-plus me-2"></i> Tambah {{ $tableTitle ?? $slot }}
        </a>
    </div>

    {{-- form pencarian --}}
    <form action="{{ route($slot . '.index') }}" method="GET" class="position-relative">
        <input type="text" name="search" class="form-control ps-5" value="{{ request('search') }}" placeholder="Cari {{ $tableTitle ?? $slot }} ..." autocomplete="off">
        <i class="ti ti-search position-absolute top-50 start-0 translate-middle-y fs-5 ms-3"></i>
    </form>
</div>