<x-app-layout>
    <x-slot:page>Tentang Aplikasi</x-slot:page>

    <div class="card">
        <div class="card-body">
            <div class="py-3">
                <div class="d-flex align-items-start">
                    <div class="flex-shrink-0">
                        <i class="ti ti-hash text-hash align-text-top me-2"></i>
                    </div>
                    <div>
                        <h6 class="about-title mb-3">Copyright</h6>
                        <p>© <span id="year"></span> - 
                            <a href="#" target="_blank" class="text-brand fw-semibold text-decoration-none">
                                Code Null
                            </a>. All rights reserved.
                        </p>
                    </div>
                    
                    <script>
                        // Set tahun secara otomatis
                        (function() {
                            let yearElement = document.getElementById("year");
                            yearElement.textContent = new Date().getFullYear();
                    
                            // Membekukan elemen agar tidak bisa diubah
                            Object.defineProperty(yearElement, "textContent", { writable: false });
                    
                            // Mencegah inspeksi elemen
                            document.addEventListener("contextmenu", function (e) {
                                e.preventDefault();
                            });
                    
                            document.addEventListener("keydown", function (e) {
                                if (e.ctrlKey && (e.key === "u" || e.key === "s" || e.key === "i")) {
                                    e.preventDefault();
                                }
                            });
                        })();
                    </script>                    
                    
                </div>
            </div>

            <div class="py-3">
                <div class="d-flex align-items-start">
                    <div class="flex-shrink-0">
                        <i class="ti ti-hash text-hash align-text-top me-2"></i>
                    </div>
                    <div>
                        <h6 class="about-title mb-3">Permissions</h4>
                        <p><i class="ti ti-circle text-brand me-2"></i> Private use</p>
                        <p><i class="ti ti-circle text-brand me-2"></i> Modification</p>
                    </div>
                </div>
            </div>

            <div class="py-3">
                <div class="d-flex align-items-start">
                    <div class="flex-shrink-0">
                        <i class="ti ti-hash text-hash align-text-top me-2"></i>
                    </div>
                    <div>
                        <h6 class="about-title mb-3">Limitations</h6>
                        <p><i class="ti ti-circle text-brand me-2"></i> Commercial use</p>
                        <p><i class="ti ti-circle text-brand me-2"></i> Distribution</p>
                        <p><i class="ti ti-circle text-brand me-2"></i> Liability</p>
                        <p><i class="ti ti-circle text-brand me-2"></i> Warranty</p>
                    </div>
                </div>
            </div>

            <div class="py-3">
                <div class="d-flex align-items-start">
                    <div class="flex-shrink-0">
                        <i class="ti ti-hash text-hash align-text-top me-2"></i>
                    </div>
                    <div>
                        <h6 class="about-title mb-3">Requirements</h6>
                        <p><i class="ti ti-circle text-brand me-2"></i> Framework Laravel 11</p>
                        <p><i class="ti ti-circle text-brand me-2"></i> PHP 8.3.<small>x</small></p>
                        <p><i class="ti ti-circle text-brand me-2"></i> MySQL 8.0.<small>x</small></p>
                        <p><i class="ti ti-circle text-brand me-2"></i> Kaiadmin Lite Bootstrap Dashboard</p>
                        <p><i class="ti ti-circle text-brand me-2"></i> Bootstrap 5.3.<small>x</small></p>
                        <p><i class="ti ti-circle text-brand me-2"></i> jQuery v3.7.1</p>
                        <p><i class="ti ti-circle text-brand me-2"></i> Tabler Icons 3.6.0</p>
                        <p><i class="ti ti-circle text-brand me-2"></i> jQuery Scrollbar v0.2.11</p>
                        <p><i class="ti ti-circle text-brand me-2"></i> flatpickr v4.6.13</p>
                        <p><i class="ti ti-circle text-brand me-2"></i> Select2 4.1.0</p>
                        <p><i class="ti ti-circle text-brand me-2"></i> laravel-dompdf v2.2.0</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>