<!DOCTYPE html>
<html lang="en">
<head>
    {{-- Charset --}}
    <meta charset="utf-8">

    {{-- Viewport --}}
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    
    {{-- Title --}}
    <title>{{ ucwords($seoproperty->page_name) }} - Admin - {{ ucwords($seoproperty->site_title) }}</title>

    {{-- Meta Description --}}
    <meta name="description" content="{{ $seoproperty->site_description }}">

    {{-- Keywords --}}
    <meta name="keywords" content="{{ $seoproperty->site_keywords }}">

    {{-- Author --}}
    <meta name="author" content="{{ $seoproperty->author }}">

    {{-- Open Graph Meta Tags --}}
    <meta property="og:title" content="{{ $seoproperty->og_title }}">
    <meta property="og:description" content="{{ $seoproperty->og_description }}">
    <meta property="og:url" content="{{ $seoproperty->og_url }}">
    <meta property="og:image" content="{{ $seoproperty->og_image }}">
    <meta property="og:type" content="{{ $seoproperty->og_type }}">
    <meta property="og:site_name" content="{{ $seoproperty->og_site_name }}">

    {{-- Twitter Card Meta Tags --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Your Name - Web Developer">
    <meta name="twitter:description" content="Discover my web development projects and skills.">
    <meta name="twitter:image" content="https://www.yourwebsite.com/images/twitter-image.jpg">

    {{-- Robots --}}
    <meta name="robots" content="{{ $seoproperty->robots }}">

    {{-- Canonical URL --}}
    <link rel="canonical" href="{{ $seoproperty->canonical_url }}">

    {{-- Content Language --}}
    <meta http-equiv="Content-Language" content="en">

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

    {{-- Datatable CSS --}}
    <link rel="stylesheet" href="{{ asset('assets/css/dataTables.bootstrap4.min.css') }}">

    {{-- Fontawesome CSS --}}
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/all.min.css') }}">

    {{-- Custom CSS --}}
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    {{-- jQuery JS --}}
    <script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>

    {{-- Axios JS --}}
    <script src="{{ asset('assets/js/axios.min.js') }}"></script>
</head>
<body>
    {{-- Pre loader start --}}
    {{-- <div id="global-loader">
        <div class="whirly-loader"> </div>
    </div> --}}
    {{-- Pre loader end --}}

    {{-- Main body start --}}
    <div class="main-wrapper">

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
    </div>
    {{-- Main body end --}}



{{-- Script start --}}

{{-- Feather JS --}}
<script src="{{ asset('assets/js/feather.min.js') }}"></script>

{{-- Slimscroll JS --}}
<script src="{{ asset('assets/js/jquery.slimscroll.min.js') }}"></script>

{{-- Datatable JS --}}
<script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/js/dataTables.bootstrap4.min.js') }}"></script>

{{-- Bootstrap JS --}}
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>

{{-- Apex Chart JS --}}
<script src="{{ asset('assets/plugins/apexchart/apexcharts.min.js') }}"></script>
<script src="{{ asset('assets/plugins/apexchart/chart-data.js') }}"></script>

{{-- Custom JS --}}
<script src="{{ asset('assets/js/script.js') }}"></script>

{{-- Script end --}}
</body>
</html>