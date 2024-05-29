{{-- Header start --}}
<!DOCTYPE html>
<html lang="en">
<head>
    {{-- Charset --}}
    <meta charset="UTF-8">

    {{-- Viewport --}}
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

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

    {{-- Fontawesome CSS --}}
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/all.min.css') }}">

    {{-- Custom CSS --}}
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>

<body class="account-page">
    {{-- Pre loader start --}}
    <div id="global-loader" class="d-none">
        <div class="whirly-loader"> </div>
    </div>
    {{-- Pre loader end --}}

<div class="main-wrapper">
    <div class="account-content">
        <div class="login-wrapper">
            <div class="login-content">
                <div class="login-userset ">
                    <div class="login-logo">
                        <img src="{{ asset('assets/img/logo.png') }}" alt="img">
                    </div>
                    <div class="login-userheading">
                        <h3>Verify OTP code</h3>
                        <h4>Enter your 4 digit OTP code here</h4>
                    </div>
{{-- Header end --}}