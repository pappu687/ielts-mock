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
        @include('layouts.components.main-header')
        <!-- End::main-header -->

        <!-- Start::main-sidebar -->
        @include('layouts.components.main-sidebar')
        <!-- End::main-sidebar -->

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

    <link
        href="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-2.3.4/b-3.2.5/b-colvis-3.2.5/b-html5-3.2.5/cc-1.1.0/date-1.6.0/fc-5.0.5/fh-4.0.3/kt-2.12.1/r-3.0.6/sc-2.4.3/sp-2.3.5/sr-1.4.2/datatables.min.css"
        rel="stylesheet" integrity="sha384-btiz0S5dn1vibXcziWDYlR1o7CtEqE1ofIMGfKmQwDtgPyvzU4hZKq112G2qkAjm"
        crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.23.0/sweetalert2.min.css"
        integrity="sha512-Ivy7sPrd6LPp20adiK3al16GBelPtqswhJnyXuha3kGtmQ1G2qWpjuipfVDaZUwH26b3RDe8x707asEpvxl7iA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script
        src="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-2.3.4/b-3.2.5/b-colvis-3.2.5/b-html5-3.2.5/cc-1.1.0/date-1.6.0/fc-5.0.5/fh-4.0.3/kt-2.12.1/r-3.0.6/sc-2.4.3/sp-2.3.5/sr-1.4.2/datatables.min.js"
        integrity="sha384-REMno7IyiqtAQsyEig3nd0I4db0frYjV2SOt2/htb3yQ09S1mB8Jfncx8ukgMZNz" crossorigin="anonymous">
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.23.0/sweetalert2.all.min.js"
        integrity="sha512-J+4Nt/+nieSNJjQGCPb8jKf5/wv31QiQM10bOotEHUKc9tB1Pn0gXQS6XXPtDoQhHHao5poTnSByMInzafUqzA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Sticky JS -->
    <script src="{{ asset('build/assets/sticky.js') }}"></script>

    <!-- App JS-->
    @vite('resources/js/app.js')

    @stack('scripts')
    @stack('footer-scripts')

</body>

</html>
