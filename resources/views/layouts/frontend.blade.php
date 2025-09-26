<!DOCTYPE html>
<html lang="en" dir="ltr" data-nav-layout="vertical" data-theme-mode="light" data-header-styles="light"
    data-width="fullwidth" data-menu-styles="color" data-page-style="modern" loader="disable" data-vertical-style="overlay"
    data-header-position="fixed" style="--primary-rgb: 39, 64, 96;--secondary-rgb: 138, 48, 51">

<head>

    <!-- Meta Data -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="Description" content="Laravel Bootstrap Responsive Admin Web Dashboard Template">
    <meta name="Author" content="Spruko Technologies Private Limited">
    <meta name="keywords"
        content="laravel, laravel admin panel, laravel dashboard, bootstrap dashboard, bootstrap admin panel, vite laravel, admin dashboard, admin panel in laravel, admin dashboard ui, laravel admin, admin panel template, laravel framework, dashboard, admin dashboard template, laravel template.">

    <!-- Title-->
    <title>@yield('title', config('app.name'))</title>

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('build/assets/images/brand-logos/favicon.ico') }}" type="image/x-icon">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- Main Theme Js -->
    <script src="{{ asset('build/assets/main.js') }}"></script>

    <!-- ICONS CSS -->
    <link href="{{ asset('build/assets/icon-fonts/icons.css') }}" rel="stylesheet">

    @include('layouts.components.styles')

    <!-- APP CSS & APP SCSS -->
    @vite(['resources/sass/app.scss'])

    @yield('styles')

    @stack('header-scripts')

</head>

<body class="">


    <!-- Loader -->
    <!-- Loader -->

    <div class="page">

        <!-- Start::main-header -->
        @include('layouts.components.main-header-frontend')
        <!-- End::main-header -->        

        <!-- Start::app-content -->
        <div class="main-content app-content p-0">
            <div class="container-fluid page-container pt-2">
                @include('layouts.components.flash-messages')

                {{ $slot }}

            </div>
        </div>
        <!-- End::content  -->

        <!-- Start::main-footer -->
        @include('layouts.components.footer')
        <!-- End::main-footer -->

        <!-- Start::main-modal -->
        @include('layouts.components.modal')
        <!-- End::main-modal -->

        @yield('modals')

    </div>

    <!-- Scripts -->
    @include('layouts.components.scripts')

    <!-- Sticky JS -->
    <script src="{{ asset('build/assets/sticky.js') }}"></script>

    <!-- App JS-->
    @vite('resources/js/app.js')

    @stack('scripts')
    @stack('footer-scripts')

</body>

</html>
