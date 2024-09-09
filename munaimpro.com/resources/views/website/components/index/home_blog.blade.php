{{-- Blog section --}}
<section id="blog" class="blog_wrapper vertical_MK25_w_space">
    <div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-12 mb-5">
            <h2 class="section_MK25_first_title">BLOG</h2>
            <div class="section_MK25_subtitle">
                <h3>Latest Post</h3>
            </div>
        </div>

        <div id="websiteHomeBlog" class="row justify-content-center">
            
        </div>

        <div class="col-12 text-center">
            <a href="{{ url('blog') }}" class="btn">All Blog <i class="fa-regular fa-pen-to-square"></i></a>
        </div>
    </div>
    </div>
</section>


{{-- Front end script start --}}

<script>

    // Function for retrieve post information
    
    retrieveAllPostInfo();

    async function retrieveAllPostInfo(){

        try{
            // Getting blog section
            let blog = $('#blog');

            // Getting blog content
            let website_home_blog = $('#websiteHomeBlog');

            // Pssing data to controller and getting response
            showLoader();
            let response = await axios.post('/retrieveAllPostInfo');
            hideLoader();

            // Hiding blog section when empty
            if(response.data.data.length === 0){
                blog.addClass('d-none');
            }

            // Getting base URL of the system
            let baseUrl = "{{ url('/') }}";

            // Hiding testimonial section when empty
            if(response.data.data.length === 0){
                testimonial.addClass('d-none');
            }

            response.data.data.forEach(function(item, index){
                if(index < 3){
                    // Generating full path for the post thumbnail
                    let postThumbnailFullPath = baseUrl + '/storage/post_thumbnails/' + item['post_thumbnail'];

                    // Formatting the publish time
                    let publishTime = new Date(item['publish_time']);
                    let formattedPublishTime = publishTime.toLocaleDateString('en-US', {
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


                    let row = `<div class="col-lg-4 col-sm-12 col-md-6 mb-5">
                                <div class="card border-0 p-0">
                                    <div class="overflow-hidden" style="max-height: 215px;">
                                        <img src="${postThumbnailFullPath}" alt="Blog Image" class="img-fluid">
                                    </div>
                                    <div class="card-body">
                                        <h3 class="card-title">${item['post_heading']}</h3>
                                        <p class="blog_MK25_info">
                                            <i class="fas fa-user"></i><a class="ms-1" href="">${item.user['first_name']} ${item.user['last_name']}</a>
                                            <span class="mx-2 fw-bold">.</span>
                                            <i class="fa-solid fa-calendar-days"></i><span class="ms-1">${formattedPublishTime}</span>
                                        </p>
                                        <p class="card-text">
                                            ${shortenText(item['post_description'])}
                                        </p>
                                        <a href="blog/${item['post_slug']}" class="read_more_link">
                                            Read More <i class="fa-solid fa-circle-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>`
                    website_home_blog.append(row);
                }
            });
        } catch(e){
            console.error('Something went wrong', e);
        }
    }
</script>

{{-- Front end script end --}}