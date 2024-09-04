{{-- Blog details section start --}}
<section class="blog_details_wrapper vertical_MK25_w_space">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 mb-5">
                <!-- Blog banner -->
                <div class="blog_banner">
                    <img class="img-fluid" src="" alt="Blog Thumbnail" id="websiteBlogDetailsThumbnail">
                </div>

                <!-- Blog text -->
                <div class="blog_text" id="websiteBlogDetails">

                    {{-- Website blog details loaded here --}}

                </div>

                <input type="text" id="postInfoId">

                <!-- Blog options -->
                <div class="blog_details_option">
                    <div class="row">
                        {{-- Previous Blog --}}
                        <div class="col-lg-6 mb-5 mb-lg-0">
                            <a href="" id="websitePreviousBlogSlug">
                                <div class="blog_wrapper">
                                    <h5 class="external_MK25_section_link fw-bold text-start">
                                        <i class="fa-solid fa-circle-arrow-left me-1"></i>Previous post
                                    </h5>
                                    <div class="card card-sm border-0 p-0 d-none" id="websitePreviousBlogContent">
                                        <div class="overflow-hidden blog_details_option_image">
                                            <img src="" alt="Blog Thumbnail" id="websitePreviousBlogThumbnail">
                                        </div>
                                        <div class="card-body">
                                            <h6 class="card-title" id="websitePreviousBlogHeading"></h6>
                                            <p class="blog_MK25_info" id="websitePreviousBlogPublishTime">
                                                
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>

                        {{-- Next Blog --}}
                        <div class="col-lg-6">
                            <a href="" id="websiteNextBlogSlug">
                                <div class="blog_wrapper">
                                    <h5 class="external_MK25_section_link fw-bold text-end">
                                        Next post<i class="fa-solid fa-circle-arrow-right ms-1"></i>
                                    </h5>
                                    <div class="card card-sm border-0 p-0 d-none" id="websiteNextBlogContent">
                                        <div class="overflow-hidden blog_details_option_image">
                                            <img src="" alt="Blog Image" id="websiteNextBlogThumbnail">
                                        </div>
                                        <div class="card-body">
                                            <h6 class="card-title" id="websiteNextBlogHeading"></h6>
                                            <p class="blog_MK25_info" id="websiteNextBlogPublishTime">
                                                
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
                    <div class="row justify-content-center" id="websiteLatestBlog">
                        <div class="col-sm-12 mb-3">
                            <div class="section_MK25_subtitle">
                            <h3 class="text-center">Latest Post</h3>
                            </div>
                        </div>

                        {{-- Website latest blog loaded here --}}

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
{{-- Blog details end --}}


{{-- Front end script start --}}

<script>

    // Function for retrieve post details
    retrievePostInfoBySlug();

    async function retrievePostInfoBySlug(){

        try{
            // Extracting post slug from URL
            const slug = window.location.pathname.split('/').pop();

            // Pssing slug to controller and getting response
            showLoader();
            let response = await axios.get(`/retrievePostInfoBySlug/${slug}`);
            hideLoader();

            // Formatting the publish time
            let publishTime = new Date(response.data.data[0]['publish_time']);
            let formattedPublishTime = publishTime.toLocaleDateString('en-US', {
                year: 'numeric',
                month: 'long',
                day: 'numeric',
            });

            if(response.data['status'] === 'success'){
                // Generating full path for the post thumbnail
                let postThumbnailFullPath = "{{ url('/') }}" + '/storage/post_thumbnails/' + response.data.data[0]['post_thumbnail'];
            
                // Assigning retrieved values
                $('#websiteBlogHeading').html(response.data.data[0]['post_heading']);
                $('#websiteBlogUser').html('<i class="fas fa-user"></i> '+response.data.data[0]['user']['first_name']+' '+response.data.data[0]['user']['last_name']);
                $('#websiteBlogPublishDate').html('<i class="fa-solid fa-calendar-days"></i> '+formattedPublishTime);
                $('#websiteBlogDetailsThumbnail').attr('src', postThumbnailFullPath);
                $('#websiteBlogDetails').html(response.data.data[0]['post_description']);
                $('#postInfoId').val(response.data.data[0]['id']);

                // Function for retrieve previous post details
                retrievePreviousPostInfoById();

                // Function for retrieve next post details
                retrieveNextPostInfoById();
            } else{
                displayToast('error', response.data['message']);
            }
        } catch(e){
            console.error('Something went wrong', e);
        }
    }


    // Function for retrieve previous post details

    async function retrievePreviousPostInfoById(){

        try{
            // Extracting post slug from URL
            let post_info_id = $('#postInfoId').val();
            
            // Pssing slug to controller and getting response
            showLoader();
            let response = await axios.get('../retrievePreviousPostInfoById', {
                params: {
                    post_info_id: post_info_id
                }
            });
            hideLoader();
            
            if(response.data.data){
                // Formatting the publish time
                let previousPostpublishTime = new Date(response.data.data.publish_time);
                let formattedPreviousPostPublishTime = previousPostpublishTime.toLocaleDateString('en-US', {
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric',
                });

                if(response.data['status'] === 'success'){
                    // Showing previous post item
                    $('#websitePreviousBlogContent').removeClass('d-none');

                    // Generating full path for the previous post thumbnail
                    let previousPostThumbnailFullPath = "{{ url('/') }}" + '/storage/post_thumbnails/' + response.data.data.post_thumbnail;
            
                    // Assigning retrieved values
                    $('#websitePreviousBlogHeading').html(response.data.data.post_heading);
                    $('#websitePreviousBlogSlug').attr('href', '/blog/' + response.data.data.post_slug);
                    $('#websitePreviousBlogPublishTime').html('<i class="fa-solid fa-calendar-days"></i> '+formattedPreviousPostPublishTime);
                    $('#websitePreviousBlogThumbnail').attr('src', previousPostThumbnailFullPath);
                    
                } else{
                    displayToast('error', response.data['message']);
                }
            }
        } catch(e){
            console.error('Something went wrong', e);
        }
    }


    // Function for retrieve next post details

    async function retrieveNextPostInfoById(){

        try{
            // Extracting post slug from URL
            let next_post_info_id = $('#postInfoId').val();
            
            // Pssing slug to controller and getting response
            showLoader();
            let response = await axios.get('../retrieveNextPostInfoById', {
                params: {
                    post_info_id: next_post_info_id
                }
            });
            hideLoader();

            if(response.data.data){
                // Formatting the publish time
                let nextPostpublishTime = new Date(response.data.data.publish_time);
                let formattedNextPostPublishTime = nextPostpublishTime.toLocaleDateString('en-US', {
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric',
                });

                if(response.data['status'] === 'success'){
                    // Showing next post item
                    $('#websiteNextBlogContent').removeClass('d-none');

                    // Generating full path for the next post thumbnail
                    let nextPostThumbnailFullPath = "{{ url('/') }}" + '/storage/post_thumbnails/' + response.data.data.post_thumbnail;
            
                    // Assigning retrieved values
                    $('#websiteNextBlogHeading').html(response.data.data.post_heading);
                    $('#websiteNextBlogSlug').attr('href', '/blog/' + response.data.data.post_slug);
                    $('#websiteNextBlogPublishTime').html('<i class="fa-solid fa-calendar-days"></i> '+formattedNextPostPublishTime);
                    $('#websiteNextBlogThumbnail').attr('src', nextPostThumbnailFullPath);
                } else{
                    displayToast('error', response.data['message']);
                }
            }
        } catch(e){
            console.error('Something went wrong', e);
        }
    }


    // Function for retrieve latest post information
    
    retrieveLatestPostInfo();

    async function retrieveLatestPostInfo(){

        try{
            // Getting testimonial content
            let website_latest_blog = $('#websiteLatestBlog');

            // Pssing data to controller and getting response
            showLoader();
            let response = await axios.get('/retrieveLatestPostInfo');
            hideLoader();
            
            response.data.data.forEach(function(item, index){
                // Generating full path for the post thumbnail
                let latestPostThumbnailFullPath = "{{ url('/') }}" + '/storage/post_thumbnails/' + item.post_thumbnail;

                // Formatting the publish time
                let websiteLatestBlogPublishTime = new Date(item.publish_time);
                let formattedLatestBlogPublishTime = websiteLatestBlogPublishTime.toLocaleDateString('en-US', {
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric',
                });

                // Limit the post description
                function shortenText(text, length = 100, suffix = '...') {
                    // Create a temporary DOM element to strip HTML tags
                    let tempElement = $('<p>').html(text);
                    let strippedText = tempElement.text();

                    if (strippedText.length > length) {
                        // Find the last space within the limit
                        let cutOffIndex = strippedText.lastIndexOf(' ', length);

                        if (cutOffIndex === -1) {
                            // If no space is found within the limit, cut at the exact length
                            cutOffIndex = length;
                        }

                        return strippedText.substring(0, cutOffIndex) + suffix;
                    }

                    return strippedText;
                }

                let row = `<div class="col-lg-6 col-sm-12 col-md-6 mb-5">
                            <div class="card border-0 p-0">
                                <div class="overflow-hidden" style="max-height: 215px;">
                                    <img src="${latestPostThumbnailFullPath}" alt="Blog Image" class="img-fluid">
                                </div>
                                <div class="card-body">
                                    <h3 class="card-title">${item.post_heading}</h3>
                                    <p class="blog_MK25_info">
                                        <i class="fas fa-user"></i><a class="ms-1" href="">${item.user.first_name} ${item.user.last_name}</a>
                                        <span class="mx-2 fw-bold">.</span>
                                        <i class="fa-solid fa-calendar-days"></i><span class="ms-1">${formattedLatestBlogPublishTime}</span>
                                    </p>
                                    <p class="card-text">
                                        ${shortenText(item.post_description)}
                                    </p>
                                    <a href="blog_details/${item.post_slug}" class="read_more_link">
                                        Read More <i class="fa-solid fa-circle-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>`
                website_latest_blog.append(row);
            });
        } catch(e){
            console.error('Something went wrong', e);
        }
    }
    
</script>

{{-- Front end script end --}}