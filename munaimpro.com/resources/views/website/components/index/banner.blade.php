{{-- Banner section --}}
<section id="home" class="banner_wrapper vertical_MK25_w_space pt-0">
    <div class="container">
        <div class="row">
            {{-- Social media links --}}
            <div class="col-lg-1 col-1 order-1 mb-5 banner_social_icon">
                <div class="row">
                    <div class="social_icon">
                        <div class="d-flex flex-column" id="heroSocialLinks">

                        </div>
                    </div>
                </div>
            </div>

            {{-- Hero content --}}
            <div class="col-lg-7 col-12 order-lg-1 order-3 mb-5 banner_content">
                <h5 class="text-uppercase" id="websiteHeroGreetings">Hi, I am</h5>
                <h2 class="text-uppercase" id="websiteHeroFullName">Muanim Khan</h2>
                <h3 id="websiteHeroDesignation">Backend Web Developer</h3>
                <p id="websiteHeroDescription">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Odio molestias non doloremque eveniet officiis voluptatem, excepturi, optio hic corporis provident iste doloribus cumque suscipit rem unde accusamus veniam maiores et?</p>
                <div class="mt-5">
                    <a class="btn primary-btn" href="{{ url('contact') }}">
                    Hire Me <i class="fa-solid fa-circle-arrow-right"></i>
                    </a>
                </div>
            </div>

            {{-- Hero image --}}
            <div class="col-lg-4 col-11 order-lg-2 order-2 mb-5">
                <div class="top-right-img text-center">
                    <img src="{{ asset('assets/website/images/me.png') }}" alt="hero image" class="img-fluid w-100" id="websiteHeroImage">
                </div>
            </div>
        </div>
    </div>
</section>