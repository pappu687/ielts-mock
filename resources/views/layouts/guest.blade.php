<!DOCTYPE html>
<html lang="en" dir="ltr" data-nav-layout="vertical" data-theme-mode="light" data-header-styles="transparent"
    data-width="fullwidth" data-menu-styles="transparent" data-page-style="flat" data-toggled="close"
    data-vertical-style="doublemenu" data-toggled="double-menu-open" style="--primary-rgb: 114, 9, 183" loader="true">

<head>

    <!-- Meta Data -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="Description" content="Laravel Bootstrap Responsive Admin Web Dashboard Template">
    <meta name="Author" content="Spruko Technologies Private Limited">
    <meta name="keywords"
        content="">

    <!-- Title-->
    <title> Vyzor Starterkit - Laravel Bootstrap 5 Premium Admin & Dashboard Template </title>

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('build/assets/images/brand-logos/favicon.ico') }}" type="image/x-icon">

    <!-- Main Theme Js -->
    <script src="{{ asset('build/assets/main.js') }}"></script>

    <!-- ICONS CSS -->
    <link href="{{ asset('build/assets/icon-fonts/icons.css') }}" rel="stylesheet">

    @include('layouts.components.styles')

    <!-- APP CSS & APP SCSS -->
    @vite(['resources/sass/app.scss'])

    @yield('styles')

</head>

<body class="">
    
    <div class="page">

        <!-- Start::main-header -->        
        <!-- End::main-header -->

        <!-- Start::main-sidebar -->        
        <!-- End::main-sidebar -->

        <!-- Start::app-content -->
        
            <div class="container-fluid">

                {{ $slot }}

            </div>
        
        <!-- End::content  -->

        <!-- Start::main-footer -->        
        <!-- End::main-footer -->

        <!-- Start::main-modal -->
        @include('layouts.components.modal')
        <!-- End::main-modal -->

        @yield('modals')

    </div>

    <!-- Scripts -->
    @include('layouts.components.scripts')

    <!-- Sticky JS -->


    <!-- Custom-Switcher JS -->

    <!-- App JS-->    

    <!-- End Scripts -->

</body>

</html>
