<!DOCTYPE html>
<html lang="en">
<head>
    {{-- Charset --}}
    <meta charset="utf-8">

    {{-- Viewport --}}
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    
    {{-- Title --}}
    @if ($routeName === '')
        <title>{{ $seoproperty->author }} - Personal Website</title>
    @elseif ($routeName === 'about')
        <title>About Me - {{ $seoproperty->author }}</title>
    @else
        <title>{{ ucwords($routeName) }} - {{ $seoproperty->author }}</title>
    @endif

    {{-- Meta Description --}}
    {{-- <meta name="description" content="{{ $seoproperty->site_description }}"> --}}

    {{-- Keywords --}}
    {{-- <meta name="keywords" content="{{ $seoproperty->site_keywords }}"> --}}

    {{-- Author --}}
    {{-- <meta name="author" content="{{ $seoproperty->author }}"> --}}

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

    {{-- FAVICON --}}
    <link rel="icon" type="image/png" href="{{ asset('assets/website/images/favicon.png') }}">

    {{-- Bootstrap 5 CSS CDN Link --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Fontawesome CSS CDN Link --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    {{-- Highlight JS CSS Link --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/styles/gradient-light.css">

    {{-- jQuery CDN Link --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    
    {{-- Axios JS --}}
    <script src="{{ asset('assets/js/axios.min.js') }}"></script>

    {{-- Owl Carousal CSS CDN Link --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw==" crossorigin="anonymous" referrerpolicy="no-referrer"/>

    {{-- Custom CSS Links --}}
    <link rel="stylesheet" href="{{ asset('assets/website/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/website/css/responsive-style.css') }}">

    {{-- Sweet alert JS --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script>
        // Pre Loader functionality
        function hideLoader(){
            $('.loader_bg').addClass('d-none');
        }

        function showLoader(){
            $('.loader_bg').removeClass('d-none');
        }
    </script>
</head>

<body data-bs-spy="scroll" data-bs-target=".navbar" data-bs-offset="90" data-bs-theme="dark">
    {{-- Pre loader --}}
    <div class="loader_bg">
        <div class="loader"></div>
    </div>

    {{-- Facebook page integration --}}
    <div id="fb-root"></div>

    {{-- Scroll To Top button --}}
    <div class="scroll_to_top fixed-bottom">
        <i class="fas fa-chevron-up"></i>
    </div>

    {{-- Body Theme button --}}
    <div class="body_theme">
      <i class="fas fa-moon"></i>
      <i class="fas fa-sun"></i>
    </div>

    {{-- Header section --}}
    @include('website.layouts.header.website_header')

    {{-- Page content --}}
    @yield('component')

    {{-- Footer section --}}
    @include('website.layouts.footer.website_footer')

{{-- Script start --}}

{{-- Bootstrap 5 JS CDN Links --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    
{{-- Facebook Page Integration JS Link --}}
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v19.0" nonce="yIa05hwk"></script>

{{-- Highlight JS Link --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/highlight.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/languages/go.min.js"></script>

{{-- jQuery CDN Link --}}
{{-- <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script> --}}

{{-- Axios JS --}}
{{-- <script src="{{ asset('assets/js/axios.min.js') }}"></script> --}}

{{-- Owl Carousal JS Link --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

{{-- Perticle JS Link --}}
<script src="http://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
<script src="{{ asset('assets/website/js/app.js') }}"></script>

{{-- Custom JS Link --}}
<script src="{{ asset('assets/website/js/main.js') }}"></script>

@stack('banner_about_section_script')

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
            timer: 60000,
            customClass: {
                popup: 'colored-toast'
            }
        });
    }
</script>

{{-- Script end --}}
</body>
</html>