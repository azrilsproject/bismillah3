<div class="sidebar sidebar-style-2" data-background-color="white"">
    {{-- Sidebar Logo --}}
    <div class="sidebar-logo">
        {{-- Logo Header --}}
        <x-logo-header></x-logo-header>
    </div>
    
    {{-- Sidebar Menu --}}
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-secondary">
                <li class="nav-item">
                    <x-sidebar-link href="{{ route('dashboard.index') }}" :active="request()->routeIs('dashboard.index')">
                        <i class="ti ti-home-spark"></i>
                        <p>Dashboard</p>
                    </x-sidebar-link>
                </li>
                {{-- Menu untuk Admin Logistik --}}
                @if (auth()->user()->role === 'Admin Logistik')
                    <li class="nav-section">
                        <span class="sidebar-mini-icon">
                            <i class="ti ti-dots fs-5"></i>
                        </span>
                        <h4 class="text-section">Master</h4>
                    </li>
                    <li class="nav-item">
                        <x-sidebar-link href="{{ route('barang.index') }}" :active="request()->routeIs('barang.*')">
                            <i class="ti ti-box"></i>
                            <p>Barang</p>
                        </x-sidebar-link>
                    </li>
                    <li class="nav-item">
                        <x-sidebar-link href="{{ route('jenis.index') }}" :active="request()->routeIs('jenis.*')">
                            <i class="ti ti-category"></i>
                            <p>Jenis Barang</p>
                        </x-sidebar-link>
                    </li>
                    <li class="nav-item">
                        <x-sidebar-link href="{{ route('satuan.index') }}" :active="request()->routeIs('satuan.*')">
                            <i class="ti ti-folders"></i>
                            <p>Satuan</p>
                        </x-sidebar-link>
                    </li>

                    <li class="nav-section">
                        <span class="sidebar-mini-icon">
                            <i class="ti ti-dots fs-5"></i>
                        </span>
                        <h4 class="text-section">Transaksi</h4>
                    </li>
                    <li class="nav-item">
                        <x-sidebar-link href="{{ route('barang-masuk.index') }}" :active="request()->routeIs('barang-masuk.*')">
                            <i class="ti ti-package-import"></i>
                            <p>Barang Masuk</p>
                        </x-sidebar-link>
                    </li>
                    <li class="nav-item">
                        <x-sidebar-link href="{{ route('barang-keluar.index') }}" :active="request()->routeIs('barang-keluar.*')">
                            <i class="ti ti-package-export"></i>
                            <p>Barang Keluar</p>
                        </x-sidebar-link>
                    </li>

                    <li class="nav-section">
                        <span class="sidebar-mini-icon">
                            <i class="ti ti-dots fs-5"></i>
                        </span>
                        <h4 class="text-section">Laporan</h4>
                    </li>
                    <li class="nav-item">
                        <x-sidebar-link href="{{ route('laporan-stok.filter') }}" :active="request()->routeIs('laporan-stok.filter')">
                            <i class="ti ti-file-analytics"></i>
                            <p>Laporan Stok</p>
                        </x-sidebar-link>
                    </li>
                    <li class="nav-item">
                        <x-sidebar-link href="{{ route('laporan-barang-masuk.filter') }}" :active="request()->routeIs('laporan-barang-masuk.filter')">
                            <i class="ti ti-file-import"></i>
                            <p>Laporan Barang Masuk</p>
                        </x-sidebar-link>
                    </li>
                    <li class="nav-item">
                        <x-sidebar-link href="{{ route('laporan-barang-keluar.filter') }}" :active="request()->routeIs('laporan-barang-keluar.filter')">
                            <i class="ti ti-file-export"></i>
                            <p>Laporan Barang Keluar</p>
                        </x-sidebar-link>
                    </li>

                    <li class="nav-section">
                        <span class="sidebar-mini-icon">
                            <i class="ti ti-dots fs-5"></i>
                        </span>
                        <h4 class="text-section">Pengaturan</h4>
                    </li>
                    <li class="nav-item">
                        <x-sidebar-link href="{{ route('user.index') }}" :active="request()->routeIs('user.*')">
                            <i class="ti ti-user"></i>
                            <p>Manajemen User</p>
                        </x-sidebar-link>
                    </li>
                @endif

                {{-- Menu untuk Staff Logistik (Hanya Transaksi) --}}
                @if (auth()->user()->role === 'Staff Logistik')
                    <li class="nav-section">
                        <span class="sidebar-mini-icon">
                            <i class="ti ti-dots fs-5"></i>
                        </span>
                        <h4 class="text-section">Transaksi</h4>
                    </li>
                    <li class="nav-item">
                        <x-sidebar-link href="{{ route('barang-masuk.index') }}" :active="request()->routeIs('barang-masuk.*')">
                            <i class="ti ti-package-import"></i>
                            <p>Barang Masuk</p>
                        </x-sidebar-link>
                    </li>
                    <li class="nav-item">
                        <x-sidebar-link href="{{ route('barang-keluar.index') }}" :active="request()->routeIs('barang-keluar.*')">
                            <i class="ti ti-package-export"></i>
                            <p>Barang Keluar</p>
                        </x-sidebar-link>
                    </li>
                @endif

              {{-- Menu untuk Staff Logistik (Hanya Transaksi) --}}
                @if (auth()->user()->role === 'Manajer Logistik')
                    <li class="nav-section">
                        <span class="sidebar-mini-icon">
                            <i class="ti ti-dots fs-5"></i>
                        </span>
                        <h4 class="text-section">Master</h4>
                    </li>
                    <li class="nav-item">
                        <x-sidebar-link href="{{ route('barang.index') }}" :active="request()->routeIs('barang.*')">
                            <i class="ti ti-box"></i>
                            <p>Barang</p>
                        </x-sidebar-link>
                    </li>
                    <li class="nav-section">
                        <span class="sidebar-mini-icon">
                            <i class="ti ti-dots fs-5"></i>
                        </span>
                        <h4 class="text-section">Transaksi</h4>
                    </li>
                    <li class="nav-item">
                        <x-sidebar-link href="{{ route('barang-masuk.index') }}" :active="request()->routeIs('barang-masuk.*')">
                            <i class="ti ti-package-import"></i>
                            <p>Barang Masuk</p>
                        </x-sidebar-link>
                    </li>
                    <li class="nav-item">
                        <x-sidebar-link href="{{ route('barang-keluar.index') }}" :active="request()->routeIs('barang-keluar.*')">
                            <i class="ti ti-package-export"></i>
                            <p>Barang Keluar</p>
                        </x-sidebar-link>
                @endif
                {{-- Menu untuk Manajer (Hanya Laporan) --}}
                @if (auth()->user()->role === 'Manajer Logistik')
                    <li class="nav-section">
                        <span class="sidebar-mini-icon">
                            <i class="ti ti-dots fs-5"></i>
                        </span>
                        <h4 class="text-section">Laporan</h4>
                    </li>
                    <li class="nav-item">
                        <x-sidebar-link href="{{ route('laporan-stok.filter') }}" :active="request()->routeIs('laporan-stok.filter')">
                            <i class="ti ti-file-analytics"></i>
                            <p>Laporan Stok</p>
                        </x-sidebar-link>
                    </li>
                    <li class="nav-item">
                        <x-sidebar-link href="{{ route('laporan-barang-masuk.filter') }}" :active="request()->routeIs('laporan-barang-masuk.filter')">
                            <i class="ti ti-file-import"></i>
                            <p>Laporan Barang Masuk</p>
                        </x-sidebar-link>
                    </li>
                    <li class="nav-item">
                        <x-sidebar-link href="{{ route('laporan-barang-keluar.filter') }}" :active="request()->routeIs('laporan-barang-keluar.filter')">
                            <i class="ti ti-file-export"></i>
                            <p>Laporan Barang Keluar</p>
                        </x-sidebar-link>
                    </li>
                @endif

                <!-- {{-- tampilkan menu jika role = Admin Logistik atau Staff Logistik --}}
                @if (auth()->user()->role === 'Admin Logistik' || auth()->user()->role === 'Staff Logistik')
                    @if (auth()->user()->role === 'Admin Logistik')
                    <li class="nav-section">
                        <span class="sidebar-mini-icon">
                            <i class="ti ti-dots fs-5"></i>
                        </span>
                        <h4 class="text-section">Master</h4>
                    </li>
                    <li class="nav-item">
                        <x-sidebar-link href="{{ route('barang.index') }}" :active="request()->routeIs('barang.*')">
                            <i class="ti ti-box-multiple"></i>
                            <p>Barang</p>
                        </x-sidebar-link>
                    </li>
                    <li class="nav-item">
                        <x-sidebar-link href="{{ route('jenis.index') }}" :active="request()->routeIs('jenis.*')">
                            <i class="ti ti-category"></i>
                            <p>Jenis Barang</p>
                        </x-sidebar-link>
                    </li>
                    <li class="nav-item">
                        <x-sidebar-link href="{{ route('satuan.index') }}" :active="request()->routeIs('satuan.*')">
                            <i class="ti ti-folders"></i>
                            <p>Satuan</p>
                        </x-sidebar-link>
                    </li>
                @endif

                    <li class="nav-section">
                        <span class="sidebar-mini-icon">
                            <i class="ti ti-dots fs-5"></i>
                        </span>
                        <h4 class="text-section">Transaksi</h4>
                    </li>
                    <li class="nav-item">
                        <x-sidebar-link href="{{ route('barang-masuk.index') }}" :active="request()->routeIs('barang-masuk.*')">
                            <i class="ti ti-transfer-in"></i>
                            <p>Barang Masuk</p>
                        </x-sidebar-link>
                    </li>
                    <li class="nav-item">
                        <x-sidebar-link href="{{ route('barang-keluar.index') }}" :active="request()->routeIs('barang-keluar.*')">
                            <i class="ti ti-transfer-out"></i>
                            <p>Barang Keluar</p>
                        </x-sidebar-link>
                    </li>
                @endif
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="ti ti-dots fs-5"></i>
                    </span>
                    <h4 class="text-section">Laporan</h4>
                </li>
                <li class="nav-item">
                    <x-sidebar-link href="{{ route('laporan-stok.filter') }}" :active="request()->routeIs('laporan-stok.filter')">
                        <i class="ti ti-file-analytics"></i>
                        <p>Laporan Stok</p>
                    </x-sidebar-link>
                </li>
                <li class="nav-item">
                    <x-sidebar-link href="{{ route('laporan-barang-masuk.filter') }}" :active="request()->routeIs('laporan-barang-masuk.filter')">
                        <i class="ti ti-file-import"></i>
                        <p>Laporan Barang Masuk</p>
                    </x-sidebar-link>
                </li>
                <li class="nav-item">
                    <x-sidebar-link href="{{ route('laporan-barang-keluar.filter') }}" :active="request()->routeIs('laporan-barang-keluar.filter')">
                        <i class="ti ti-file-export"></i>
                        <p>Laporan Barang Keluar</p>
                    </x-sidebar-link>
                </li>

                {{-- tampilkan menu jika role = Admin Logistik --}}
                @if (auth()->user()->role === 'Admin Logistik')
                    <li class="nav-section">
                        <span class="sidebar-mini-icon">
                            <i class="ti ti-dots fs-5"></i>
                        </span>
                        <h4 class="text-section">Pengaturan</h4>
                    </li>
                    <li class="nav-item">
                        <x-sidebar-link href="{{ route('user.index') }}" :active="request()->routeIs('user.*')">
                            <i class="ti ti-user"></i>
                            <p>Manajemen User</p>
                        </x-sidebar-link>
                    </li>
                @endif -->

                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="ti ti-dots fs-5"></i>
                    </span>
                    <!-- <h4 class="text-section">Bantuan</h4>
                </li> -->
                <!-- <li class="nav-item">
                    <x-sidebar-link href="{{ route('tentang') }}" :active="request()->routeIs('tentang')">
                        <i class="ti ti-info-circle"></i>
                        <p>Tentang Aplikasi</p>
                    </x-sidebar-link>
                </li> -->
            </ul>
        </div>
    </div>
</div>