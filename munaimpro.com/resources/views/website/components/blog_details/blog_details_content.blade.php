{{-- Blog details section start --}}
<section class="blog_details_wrapper vertical_MK25_w_space">
    <div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8 mb-5">
        <!-- Blog banner -->
        <div class="blog_banner">
            <img class="img-fluid" src="{{ asset('assets/website/images/blog/blogimg.jpeg') }}" alt="Blog Image">
        </div>

        <!-- Blog text -->
        <div class="blog_text">
            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Eaque rerum magnam enim distinctio quibusdam saepe. Assumenda omnis dolores officiis consectetur eveniet alias impedit laborum voluptatem natus facere quis esse saepe recusandae doloremque cumque necessitatibus sapiente cupiditate, animi vel eius. Eaque!</p>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Debitis eum cumque, expedita officia ea dicta eligendi accusantium odio quam amet vero quis commodi? Hic, nobis!</p>
            <pre style="tab-size: 4;">
            <code class="language-javascript">// Bad
                const x = getData();
                const y = processIt(x);
                
                // Good
                const userData = fetchUserInformation();
                const processedUser = generateUserReport(userData);
            </code>
            </pre>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Rem mollitia, exercitationem laudantium praesentium ullam doloremque illo molestias. Eos ratione aliquam maxime, architecto quasi autem? Culpa accusamus ipsa consectetur maiores voluptas.</p>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Est consequuntur eaque dignissimos architecto laudantium iste soluta, eos ratione quo tempore quam veniam nostrum aliquam modi nemo culpa animi ipsum minima facere eum! Tenetur, atque! Nesciunt facere voluptates eos tempora voluptate praesentium, mollitia repellendus maxime reiciendis ut dolorum, placeat dignissimos aliquid.</p>
        </div>

        <!-- Blog options -->
        <div class="blog_details_option">
            <div class="row">
            <div class="col-lg-6 mb-5 mb-lg-0">
                <a href="">
                <div class="blog_wrapper">
                    <h5 class="external_MK25_section_link fw-bold text-start">
                    <i class="fa-solid fa-circle-arrow-left me-1"></i>Previous post
                    </h5>
                    <div class="card card-sm border-0 p-0">
                    <div class="overflow-hidden blog_details_option_image">
                        <img src="{{ asset('assets/website/images/blog/blog.webp') }}" alt="Blog Image">
                    </div>
                    <div class="card-body">
                        <h6 class="card-title">Blog titile will be go here</h6>
                        <p class="blog_MK25_info">
                        <i class="fa-solid fa-calendar-days"></i><span class="ms-1">January 20, 2023</span>
                        </p>
                    </div>
                    </div>
                </div>
                </a>
            </div>

            <div class="col-lg-6">
                <a href="">
                <div class="blog_wrapper">
                    <h5 class="external_MK25_section_link fw-bold text-end">
                    Next post<i class="fa-solid fa-circle-arrow-right ms-1"></i>
                    </h5>
                    <div class="card card-sm border-0 p-0">
                    <div class="overflow-hidden blog_details_option_image">
                        <img src="{{ asset('assets/website/images/blog/blog.webp') }}" alt="Blog Image">
                    </div>
                    <div class="card-body">
                        <h6 class="card-title">Blog titile will be go here</h6>
                        <p class="blog_MK25_info">
                        <i class="fa-solid fa-calendar-days"></i><span class="ms-1">January 20, 2023</span>
                        </p>
                    </div>
                    </div>
                </div>
                </a>
            </div>
            </div>
        </div>

        <!-- Recent Blog -->
        <div class="recent_blog blog_wrapper">
            <div class="row justify-content-center">
            <div class="col-sm-12 mb-3">
                <div class="section_MK25_subtitle">
                <h3 class="text-center">Latest Post</h3>
                </div>
            </div>
    
            <!-- Blog 1 -->
            <div class="col-lg-6 col-sm-12 col-md-6 mb-5">
                <div class="card border-0 p-0">
                <div class="overflow-hidden">
                    <img src="{{ asset('assets/website/images/blog/blog.webp') }}" alt="Blog Image">
                </div>
                <div class="card-body">
                    <h3 class="card-title">Blog Title 1</h3>
                    <p class="blog_MK25_info">
                    <i class="fas fa-user"></i><a class="ms-1" href="">Munaim Khan</a>
                    <span class="mx-2 fw-bold">.</span>
                    <i class="fa-solid fa-calendar-days"></i><span class="ms-1">January 20, 2023</span>
                    </p>
                    <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus eget fermentum velit. Donec nec enim quis justo eleifend mattis.</p>
                    <a href="#" class="read_more_link">Read More <i class="fa-solid fa-circle-arrow-right"></i></a>
                </div>
                </div>
            </div>
    
            <!-- Blog 2 -->
            <div class="col-lg-6 col-sm-12 col-md-6 mb-5">
                <div class="card border-0 p-0">
                <div class="overflow-hidden">
                    <img src="{{ asset('assets/website/images/blog/blog.webp') }}" alt="Blog Image">
                </div>
                <div class="card-body">
                    <h3 class="card-title">Blog Title 2</h3>
                    <p class="blog_MK25_info">
                    <i class="fas fa-user"></i><a class="ms-1" href="">Munaim Khan</a>
                    <span class="mx-2 fw-bold">.</span>
                    <i class="fa-solid fa-calendar-days"></i><span class="ms-1">January 20, 2023</span>
                    </p>
                    <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus eget fermentum velit. Donec nec enim quis justo eleifend mattis.</p>
                    <a href="#" class="read_more_link">Read More <i class="fa-solid fa-circle-arrow-right"></i></a>
                </div>
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>
    </div>
</section>
{{-- Blog details end --}}