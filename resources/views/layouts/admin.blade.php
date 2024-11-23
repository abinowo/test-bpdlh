<!doctype html>
<!--
* Tabler - Premium and Open Source dashboard template with responsive and high quality UI.
* @version 1.0.0-beta20
* @link https://tabler.io
* Copyright 2018-2023 The Tabler Authors
* Copyright 2018-2023 codecalm.net Paweł Kuna
* Licensed under MIT (https://github.com/tabler/tabler/blob/master/LICENSE)
-->
<html lang="en">
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
        <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
        <title>Dashboard</title>
        <!-- CSS files -->
        <link href="{{ asset('themes/dist/css/tabler.min.css') }}?1692870487" rel="stylesheet"/>
        <link href="{{ asset('themes/dist/css/tabler-flags.min.css') }}?1692870487" rel="stylesheet"/>
        <link href="{{ asset('themes/dist/css/tabler-payments.min.css') }}?1692870487" rel="stylesheet"/>
        <link href="{{ asset('themes/dist/css/tabler-vendors.min.css') }}?1692870487" rel="stylesheet"/>
        <link href="{{ asset('themes/dist/css/demo.min.css') }}?1692870487" rel="stylesheet"/>
        <style>
            @import url('https://rsms.me/inter/inter.css');
            :root {
                --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
            }
            body {
                font-feature-settings: "cv03", "cv04", "cv11";
            }
            .nav-link.active {
                background-color: #0f1825;
            }
        </style>
        @livewireStyles
        @stack('styles')
    </head>
    <body>
        <script src="{{ asset('themes/dist/js/demo-theme.min.js') }}?1692870487"></script>
        <div class="page">
        <!-- Sidebar -->
        <aside class="navbar navbar-vertical navbar-expand-lg" data-bs-theme="dark">
            <div class="container-fluid">
            @include('partials.admin-navbar-mobile')
            @include('partials.admin-navbar')
            </div>
        </aside>
        <div class="page-wrapper">
            <!-- Page header -->
            <div class="d-none d-lg-block d-xl-block d-print-none">
                @include('partials.admin-navbar-top')
            </div>
            @if($useContentHeader ?? true)
            <div class="page-header d-print-none">
                @yield('content-header')
            </div>
            @endif
            <!-- Page body -->
            <div class="page-body">
            @yield('content')
            </div>
            <footer class="footer footer-transparent d-print-none"></footer>
        </div>
        </div>
        <!-- Libs JS -->
        <script src="{{ asset('themes/dist/libs/apexcharts/dist/apexcharts.min.js') }}?1692870487" defer></script>
        <script src="{{ asset('themes/dist/libs/jsvectormap/dist/js/jsvectormap.min.js') }}?1692870487" defer></script>
        <script src="{{ asset('themes/dist/libs/jsvectormap/dist/maps/world.js') }}?1692870487" defer></script>
        <script src="{{ asset('themes/dist/libs/jsvectormap/dist/maps/world-merc.js') }}?1692870487" defer></script>
        <!-- Tabler Core -->
        <script src="{{ asset('themes/dist/js/tabler.min.js') }}?1692870487" defer></script>
        <script src="{{ asset('themes/dist/js/demo.min.js') }}?1692870487" defer></script>
        @livewireScripts
        <script>
            window.Livewire.on('closeLwModal', () => {
                const truck_modal = document.querySelector('#lw-modal');
                const modal = bootstrap.Modal.getInstance(truck_modal);    
                modal.hide();
            });
        </script>
        @stack('scripts')
    </body>
</html>