<div class="card card-body">
    <div class="row align-items-center">
        <div class="col-12">
            <div class="d-sm-flex align-items-center justify-space-between">
                {{-- Title --}}
                <h4 class="d-flex align-items-center mb-2 mb-sm-0 card-title">
                    {{ $slot }}
                </h4>
                {{-- Breadcrumbs --}}
                <nav style="--bs-breadcrumb-divider: '';" aria-label="breadcrumb" class="ms-auto">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item d-flex align-items-center">
                            <a class="text-muted text-decoration-none d-flex" href="#">
                                <i class="ti ti-home fs-5"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item ps-1">
                            <i class="ti ti-chevron-right align-middle op-7"></i>
                        </li>
                        <li class="breadcrumb-item ps-0" aria-current="page">
                            <span class="badge fw-medium bg-secondary-subtle text-secondary">
                                {{ $slot }}
                            </span>
                        </li>
                        @isset($breadcrumb)
                            <li class="breadcrumb-item ps-0">
                                <i class="ti ti-chevron-right align-middle op-7"></i>
                            </li>
                            <li class="breadcrumb-item ps-0" aria-current="page">
                                <span class="badge fw-medium bg-secondary-subtle text-secondary">
                                    {{ $breadcrumb }}
                                </span>
                            </li>
                        @endisset
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>