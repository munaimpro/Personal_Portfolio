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
    @elseif (!empty($heading))
        <title>{{ ucwords($heading) }} - {{ $seoproperty->author }}</title>
    @elseif (!empty($id))
        <title>Project Details - {{ $seoproperty->author }}</title>
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
    // Function for checking authenticated user
    checkAuth();

    function getCookie(name){
        let cookieArr = document.cookie.split(';');
        for (let i = 0; i < cookieArr.length; i++) {
            let cookiePair = cookieArr[i].split('=');
            if (name === cookiePair[0].trim()) {
                return decodeURIComponent(cookiePair[1]);
            }
        }
        return null;
    }

    function checkAuth(){
        const token = getCookie('SigninToken');
        
        if (token){
            $('#userAuthenticationButton').html(`<i class="fas fa-gauge"></i> Dashboard`);
            $('#userAuthenticationButton').attr('href', 'Admin/dashboard');
        }
    }



    // Function for toast message common features
    function displayToast(icon, title){
        Swal.fire({
            toast: true,
            position: 'bottom',
            icon: icon,
            title: title,
            showConfirmButton: false,
            timer: 3000,
            customClass: {
                popup: 'colored-toast'
            }
        });
    }


    // Function for retrieve about information
    retrieveAboutInfo();

    async function retrieveAboutInfo(){
        showLoader();
        let response = await axios.get('/retrieveAboutInfo');
        hideLoader();

        if(response.data['status'] === 'success'){
            // Getting base URL of the system
            let baseUrl = "{{ url('/') }}";
            
            // Generating full path for the hero image
            let heroImageFullPath = baseUrl + '/storage/website_pictures/hero/' + response.data.data['hero_image'];

            // Generating full path for the about image
            let aboutImageFullPath = baseUrl + '/storage/website_pictures/about/' + response.data.data['about_image'];

            // Generating full path for the resume link
            let resumeFullPath = baseUrl + '/storage/resume/' + response.data.data['resume_link'];

            // Hero section informations - Home page
            $('#websiteHeroGreetings').html(response.data.data['greetings']);
            $('#websiteHeroFullName').html(response.data.data['full_name']);
            $('#websiteHeroDesignation').html(response.data.data['designation']);
            $('#websiteHeroDescription').html(response.data.data['hero_description']);
            $('#websiteHeroImage').attr('src', heroImageFullPath);

            // About section informations - Home page
            $('#websiteAboutFullName').html("I am "+response.data.data['full_name']);
            $('#websiteAboutDesignation').html(response.data.data['designation']);
            $('#websiteAboutDescription').html(response.data.data['about_description']);
            $('#websiteAboutImage').attr('src', aboutImageFullPath);
            $('#resumeDownloadButton').attr('href', resumeFullPath);

            // Skill section informations - Home page
            $('#websiteSkillDescription').html(response.data.data['skill_description']);

            // Contact section informations - Home page
            $('#websiteHomeContactPhone').html(response.data.data['phone']);
            $('#websiteHomeContactEmail').html(response.data.data['email']);
            $('#websiteHomeContactLocation').html(response.data.data['location']);

            // Contact section informations - About page
            $('#websiteAboutContactPhone').html(response.data.data['phone']);
            $('#websiteAboutContactEmail').html(response.data.data['email']);
            $('#websiteAboutContactLocation').html(response.data.data['location']);

            // Contact section informations - Contact page
            $('#websiteContactPagePhone').html(response.data.data['phone']);
            $('#websiteContactPageEmail').html(response.data.data['email']);
            $('#websiteContactPageLocation').html(response.data.data['location']);

            // Footer section informations
            $('#websiteFooterFullName').html(response.data.data['full_name']);
            $('#websiteFooterDesignation').html(response.data.data['designation']);
            $('#websiteCopyright').html(`&copy; ${response.data.data['copyright']} ${new Date().getFullYear()} | Developed by <a href="/" target="_blank" rel="noopener noreferrer">${response.data.data['full_name']}</a>`);

        } else{
            displayToast('error', response.data['message']);
        }
    }


    // Function for retrieve portfolio details

    async function retrievePortfolioInfoById(portfolio_info_id){
        // Setting the portfolio id to the local storage for use
        localStorage.setItem('portfolio_info_id', portfolio_info_id);

        try {
            // Redirecting to portfolio details page
            window.location = 'portfolio/details';

            // Getting the portfolio id from the local storage
            let portfolioInfoId = localStorage.getItem('portfolio_info_id');

            if(portfolioInfoId){
                // Sending id to controller and getting response
                showLoader();
                let response = await axios.post('../retrievePortfolioInfoById', { portfolio_info_id: portfolioInfoId });
                hideLoader();

                console.log(portfolioInfoId);

                if (response.data['status'] === 'success'){
                    // Generating full path for the project thumbnail
                    let projectThumbnailFullPath = "{{ url('/') }}" + '/storage/portfolio/thumbnails/' + response.data.data['project_thumbnail'];
                
                    // Assigning retrieved values
                    $('#websiteProjectTitle').html(response.data.data['project_title']);
                    $('#websiteProjectType').html(response.data.data['project_type']);
                    $('#websiteProjectDuration').html(response.data.data['project_starting_date'] - response.data.data['project_ending_date']);
                    // $('#websiteProjectThumbnail')[0].src = projectThumbnailFullPath;
                    getUiImagePreview(JSON.parse(response.data.data['project_ui_image']));
                    $('#websiteProjectCategory').html(response.data.data.service['service_name']);
                    $('websiteProjectDescription').html(response.data.data['project_description']);
                    $('#websiteProjectUrl').attr('href', ' <i class="fas fa-external-link"></i> '+response.data.data['project_url']);
                    $('#websiteProjectTechnology').html(response.data.data['core_technology']);
                } else{
                    displayToast('error', response.data['message']);
                }
            } else{
                console.error('No portfolio ID found in localStorage');
            }
        } catch (e){
            console.error('Something went wrong', e);
        }
    }

    
    // Function for UI image preview

    function getUiImagePreview(uiImages){
        const carouselContainer = $('#websiteProjectUIImages');

        // Clear any existing items in the carousel
        carouselContainer.html('');

        uiImages.forEach((image, index) => {
            // Create carousel item div
            const itemDiv = document.createElement('div');
            itemDiv.classList.add('item');

            // Create img element for the UI image
            const img = document.createElement('img');
            img.src = `{{ url('/') }}/storage/portfolio/ui_images/${image}`;
            img.alt = "UI Image";

            // Append the image inside the carousel item div
            itemDiv.append(img);

            // Append the carousel item div to the owl-carousel container
            carouselContainer.append(itemDiv);
        });

        // Reinitialize the Owl Carousel after adding new items
        $('.owl-carousel').trigger('destroy.owl.carousel'); // Destroy the current instance
        $('.owl-carousel').owlCarousel({
            loop: true,
            margin: 10,
            nav: true,
            items: 1
        });
    }


    // Function to retrieve social media information

    $(document).ready(function(){
        retrieveAllSocialMediaInfo();
    });

    async function retrieveAllSocialMediaInfo(){
        try{
            // Hero section social media div
            let hero_social_media_link = $('#heroSocialLinks');

            // Contact section social media div
            let contact_social_media_link = $('#contactSocialLinks');

            // About page social media div
            let about_social_media_link = $('#aboutSocialLinks');

            // Footer section social media div
            let footer_social_media_link = $('#footerSocialLinks');

            // Passing data to the controller and getting response
            let response = await axios.get('/retrieveAllSocialMediaInfo');

            // Process each social media item
            response.data.data.forEach(function(item){

                // Parse social_media_placement if it's a string representing a JSON array
                let placements = [];

                try{
                    placements = item['social_media_placement'] ? JSON.parse(item['social_media_placement']) : [];
                } catch(e){
                    console.error('Error parsing social_media_placement:', e);
                }

                // Handle hero placement
                if(placements.includes('hero')){
                    let row = `<div class="d-flex align-items-center mb-3">
                                <a target="_blank" href="${item['social_media_link']}">
                                    <div class="social_MK25_icon rounded-circle justify-content-center align-items-center">
                                        ${item['social_media_icon']}
                                    </div>
                                </a>
                            </div>`;
                    hero_social_media_link.append(row);
                }

                // Handle contact placement
                if(placements.includes('contact')){
                    let row = `<div class="d-flex align-items-center me-3">
                                <a target="_blank" href="${item['social_media_link']}">
                                    <div class="social_MK25_icon rounded-circle justify-content-center align-items-center">
                                        ${item['social_media_icon']}
                                    </div>
                                </a>
                            </div>`;
                    contact_social_media_link.append(row);
                    $('#contactWidgetTitle').removeClass('d-none');
                }

                // Handle footer placement
                if(placements.includes('footer')){
                    let row = `<div class="d-flex align-items-center me-3">
                                <a target="_blank" href="${item['social_media_link']}">
                                    <div class="social_MK25_icon rounded-circle justify-content-center align-items-center">
                                        ${item['social_media_icon']}
                                    </div>
                                </a>
                            </div>`;
                    footer_social_media_link.append(row);
                }

                // Load all social media to about page
                let row = `<div class="col-lg-6 col-md-6 col-sm-12 social_MK25_items">
                                <a href="${item['social_media_link']}">
                                    <div class="social_MK25_item me-1 row align-items-center">
                                        <div class="col-3 outer_changeable_icon fa-2x">
                                            ${item['social_media_icon']}
                                        </div>
                                        <div class="col-9 outer_changeable_text">
                                            <p class="m-0">${item['social_media_title']}</p>
                                        </div>
                                    </div>
                                </a>
                            </div>`;    
                about_social_media_link.append(row);
            });
        } catch(e){
            console.error('Something went wrong:', e);
        }
    }


    // Function to retrieve social media information
    
    trackVisitorInformation();

    async function trackVisitorInformation(){
        try {
            // Capture screen resolution
            let screenResolution = `${window.screen.width}x${window.screen.height}`;

            // Send the request when the page is loaded
            let response = await axios.post('/trackVisitorInformation', {
                visitor_screen_resolution: screenResolution,
            });

            console.log(response.data.message);

        } catch(e) {
            console.error('Something went wrong:', e);
        }
    }
</script>

{{-- Script end --}}
</body>
</html>