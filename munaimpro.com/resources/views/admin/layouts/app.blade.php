<!DOCTYPE html>
<html lang="en">
<head>
    {{-- Charset --}}
    <meta charset="utf-8">

    {{-- Viewport --}}
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    
    {{-- Title --}}
    <title>{{ ucwords($routeName) }} - Admin - {{ ucwords('munaimpro') }}</title>

    {{-- Meta Description --}}
    {{-- <meta name="description" content="{{ $seoproperty->site_description }}"> --}}

    {{-- Keywords --}}
    {{-- <meta name="keywords" content="{{ $seoproperty->site_keywords }}"> --}}

    {{-- Author --}}
    <meta name="author" content="Munaim Khan">

    {{-- Open Graph Meta Tags --}}
    {{-- <meta property="og:title" content="{{ $seoproperty->og_title }}">
    <meta property="og:description" content="{{ $seoproperty->og_description }}">
    <meta property="og:url" content="{{ $seoproperty->og_url }}">
    <meta property="og:image" content="{{ $seoproperty->og_image }}">
    <meta property="og:type" content="{{ $seoproperty->og_type }}">
    <meta property="og:site_name" content="{{ $seoproperty->og_site_name }}"> --}}

    {{-- Twitter Card Meta Tags --}}
    {{-- <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Your Name - Web Developer">
    <meta name="twitter:description" content="Discover my web development projects and skills.">
    <meta name="twitter:image" content="https://www.yourwebsite.com/images/twitter-image.jpg"> --}}

    {{-- Robots --}}
    {{-- <meta name="robots" content="{{ $seoproperty->robots }}"> --}}

    {{-- Canonical URL --}}
    {{-- <link rel="canonical" href="{{ $seoproperty->canonical_url }}"> --}}

    {{-- Content Security Policy --}}
    {{-- <meta http-equiv="Content-Security-Policy" content="default-src 'self'; img-src 'self'; script-src 'self' https://cdn.jsdelivr.net 'unsafe-inline'; style-src 'self' 'unsafe-inline';"> --}}

    {{-- Content Language --}}
    <meta http-equiv="Content-Language" content="en">

    {{-- Application Name --}}
    <meta name="application-name" content="Munaim">

    {{-- Theme Color --}}
    <meta name="theme-color" content="#ffffff">

    {{-- Google Site Verification --}}
    <meta name="google-site-verification" content="your_verification_token_here">

    {{-- Cache Control --}}
    <meta http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate">

    {{-- Referrer Policy --}}
    <meta name="referrer" content="no-referrer-when-downgrade">

    {{-- X-UA-Compatible --}}
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    {{-- Favicon --}}
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/img/favicon.jpg') }}">

    {{-- Sweet alert JS --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    {{-- Bootstrap CSS --}}
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">

    {{-- Animate CSS --}}
    <link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}">
    
    {{-- Select 2 CSS --}}
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">

    {{-- Datatable CSS --}}
    <link rel="stylesheet" href="{{ asset('assets/css/dataTables.bootstrap4.min.css') }}">

    {{-- Fontawesome CSS --}}
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/all.min.css') }}">
    
    {{-- Leaflet CSS --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />

    {{-- Custom CSS --}}
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    {{-- jQuery JS --}}
    <script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>

    {{-- Datatable JS --}}
    <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/dataTables.bootstrap4.min.js') }}"></script>

    {{-- Axios JS --}}
    <script src="{{ asset('assets/js/axios.min.js') }}"></script>

    {{-- Leaflet JS --}}
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-ajax/dist/leaflet.ajax.min.js"></script>

    {{-- Chart JS --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2"></script>

    {{-- Pre loader Configuration --}}
    <script>
        function showLoader(){
            $('#global-loader').removeClass('d-none');
        }

        function hideLoader(){
            $('#global-loader').addClass('d-none');
        }
    </script>

    {{-- Leaflet Map style --}}
    <style>
        #map {
            height: 500px;
            width: 100%;
        }
    </style>
</head>
<body>
    {{-- Pre loader start --}}
    <div id="global-loader">
        <div class="whirly-loader"> </div>
    </div>
    {{-- Pre loader end --}}

    {{-- Main body start --}}
    <div class="main-wrapper">
        @if ($routeName != '{token}')
            {{-- Header start --}}
            @include('admin.layouts.header.admin_header')
            {{-- Header end --}}

            {{-- Sidebar start --}}
            @include('admin.layouts.sidebar.admin_sidebar')
            {{-- Sidebar end --}}

            {{-- Page content start --}}
            <div class="page-wrapper">
                <div class="content">

                    @yield('content')
                
                </div>
            </div>
            {{-- Page content end --}}
        @else
            {{-- Page content start --}}
            <div class="page-wrapper" style="margin: auto 100px">
                <div class="content">

                    @yield('content')
                
                </div>
            </div>
            {{-- Page content end --}}
        @endif
    </div>
    {{-- Main body end --}}



{{-- Script start --}}

{{-- Feather JS --}}
<script src="{{ asset('assets/js/feather.min.js') }}"></script>

{{-- Slimscroll JS --}}
<script src="{{ asset('assets/js/jquery.slimscroll.min.js') }}"></script>
    
{{-- Select 2 JS --}}
<script src="{{ asset('assets/plugins/select2/js/select2.min.js') }}"></script>

{{-- Datatable JS --}}
{{-- <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/js/dataTables.bootstrap4.min.js') }}"></script> --}}

{{-- Bootstrap JS --}}
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>

{{-- Apex Chart JS --}}
<script src="{{ asset('assets/plugins/apexchart/apexcharts.min.js') }}"></script>
<script src="{{ asset('assets/plugins/apexchart/chart-data.js') }}"></script>

{{-- TinyMCE Editor JS --}}
<script src="{{ asset('assets/js/tinymce/tinymce.min.js') }}"></script>

{{-- Custom JS --}}
<script src="{{ asset('assets/js/script.js') }}"></script>

<script>
    // Function for toast message common features
    function displayToast(icon, title){
        Swal.fire({
            toast: true,
            position: 'top-end',
            icon: icon,
            iconColor: 'white',
            title: title,
            showConfirmButton: false,
            timer: 3000,
            customClass: {
                popup: 'colored-toast'
            }
        });
    }
</script>

{{-- Script end --}}
</body>
</html>