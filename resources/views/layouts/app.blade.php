<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="{{ config('app.name') }}">
    <meta name="author" content="{{ config('app.author') }}">

    {{-- Title --}}
    <title>{{ $page }} - {{ config('app.name') }}</title>

    {{-- Favicon icon --}}
    <link rel="shortcut icon" href="{{ asset('images/favicon1.ico') }}" type="image/x-icon">

    {{-- Bootstrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    {{-- tabler icons CSS --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css" />
    {{-- Font --}}
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    {{-- jquery scrollbar CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/jquery.scrollbar@0.2.11/jquery.scrollbar.min.css" rel="stylesheet">
    {{-- Flatpickr CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/flatpickr@4.6.13/dist/flatpickr.min.css" rel="stylesheet">
    {{-- Select2 CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    {{-- Template CSS --}}
    <link rel="stylesheet" href="{{ asset('css/template/kaiadmin.min.css') }}">
    {{-- Custom Style CSS --}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    {{-- jQuery Core --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</head>

<body>
    <div class="wrapper">
        {{-- Sidebar --}}
        @include('layouts.sidebar')

        {{-- Main --}}
        <div class="main-panel">
            {{-- Main Header --}}
            <div class="main-header">
                {{-- Main Header Logo --}}
                <div class="main-header-logo">
                    {{-- Logo Header --}}
                    <x-logo-header></x-logo-header>
                </div>
                
                {{-- Navbar Header --}}
                @include('layouts.navbar-header')
            </div>

            {{-- Main Content --}}
            <div class="container">
                <div class="page-inner">
                    {{-- Content --}}
                    {{ $slot }}
                </div>
            </div>

            {{-- Footer --}}
            <footer class="footer">
                <div class="container-fluid">
                    {{-- link --}}
                    <nav class="pull-left">
                        <ul class="nav">
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    ARSLogistik
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    Terms & Conditions
                                </a>
                            </li>
                        </ul>
                    </nav>
                    {{-- copyright --}}
                    <div class="copyright ms-auto">
                        &copy; <span id="year"></span> - 
                        <a href="#" target="_blank" class="text-brand fw-semibold">
                            ARSLogistik
                        </a>. All rights reserved.
                    </div>
                    
                    <script>
                        document.getElementById("year").textContent = new Date().getFullYear();
                    </script>
                    
                </div>
            </footer>
        </div>

        {{-- Modal logout --}}
        <x-modal-logout></x-modal-logout>
    </div>

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    {{-- jQuery Scrollbar --}}
    <script src="https://cdn.jsdelivr.net/npm/jquery.scrollbar@0.2.11/jquery.scrollbar.min.js"></script>
    {{-- Flatpickr JS --}}
    <script src="https://cdn.jsdelivr.net/npm/flatpickr@4.6.13/dist/flatpickr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr@4.6.13/dist/l10n/id.js"></script>
    {{-- Select2 JS --}}
	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    {{-- Template JS --}}
    <script src="{{ asset('js/template/kaiadmin.min.js') }}"></script>

    {{-- Custom Scripts --}}
    <script src="{{ asset('js/plugins.js') }}"></script>
    <script src="{{ asset('js/image-preview.js') }}"></script>
</body>

</html>