{{-- Blog section start --}}
<section id="blog" class="blog_wrapper vertical_MK25_w_space">
    <div class="container">
        <div class="row justify-content-center" id="websiteAllBlog">
            {{-- Website all blog loaded here --}}
        </div>

        <div class="col-12 text-center pagination justify-content-center">
            <button class="btn" id="loadMoreButton">
                <span id="loadMoreButtonText">Load More <i class="fas fa-chevron-down"></i>
                </span>
                <div id="loadMoreButtonSpinner" class="spinner-border text-light d-none" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </button>
        </div>
    </div>
</section>
{{-- Blog section end --}}


{{-- Front end script start --}}

<script>
        
    // Set initial counter and limit
    let offset = 0;
    const limit = 3;

    // Function for retrieve post information
    
    retrieveAllPostInfo();

    async function retrieveAllPostInfo(){

        try{
            // Pssing data to controller and getting response
            showLoader();
            let response = await axios.get('/retrieveAllPostInfo');
            hideLoader();

            // Getting all post in a variable
            let allPosts = response.data.data;

            // Getting total available blogs
            let totalBlog = allPosts.length;

            // Load the initial set of blog
            loadBlogs(totalBlog, allPosts)

            // Attach event listener to the Load More button
            $('#loadMoreButton').on('click', function(){
                $('#loadMoreButtonSpinner').removeClass('d-none');
                $('#loadMoreButtonText').addClass('d-none');
                loadBlogs(totalBlog, allPosts);
                $('#loadMoreButtonSpinner').addClass('d-none');
                $('#loadMoreButtonText').removeClass('d-none');
            });
            
        } catch(e){
            console.error('Something went wrong', e);
        }
    }


    // Function for loading blog iteratively
    function loadBlogs(totalBlog, allPosts){
        // Get the blog container
        let website_all_blog = $('#websiteAllBlog');

        // Check if there are more blogs to load
        if(offset < totalBlog){
            for(i = offset; i < offset + limit && i < totalBlog; i++){
                let item = allPosts[i];

                // Generate the full path for the post thumbnail
                let postThumbnailFullPath = "{{ url('/') }}" + '/storage/post_thumbnails/' + item.post_thumbnail;

                // Format the publish time
                let publishTime = new Date(item.publish_time);
                let formattedPublishTime = publishTime.toLocaleDateString('en-US', {
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric',
                });

                // Limit the post description
                function shortenText(text, length = 100, suffix = '...') {
                    let tempElement = $('<p>').html(text);
                    let strippedText = tempElement.text();

                    if (strippedText.length > length) {
                        let cutOffIndex = strippedText.lastIndexOf(' ', length);

                        if (cutOffIndex === -1) {
                            cutOffIndex = length;
                        }

                        return strippedText.substring(0, cutOffIndex) + suffix;
                    }

                    return strippedText;
                }

                // Create the blog card HTML
                let row = `<div class="col-lg-4 col-sm-12 col-md-6 mb-5">
                                <div class="card border-0 p-0">
                                    <div class="overflow-hidden" style="max-height: 215px;">
                                        <img src="${postThumbnailFullPath}" alt="Blog Image" class="img-fluid">
                                    </div>
                                    <div class="card-body">
                                        <h3 class="card-title">${item.post_heading}</h3>
                                        <p class="blog_MK25_info">
                                            <i class="fas fa-user"></i><a class="ms-1" href="">${item.user.first_name} ${item.user.last_name}</a>
                                            <span class="mx-2 fw-bold">.</span>
                                            <i class="fa-solid fa-calendar-days"></i><span class="ms-1">${formattedPublishTime}</span>
                                        </p>
                                        <p class="card-text">
                                            ${shortenText(item.post_description)}
                                        </p>
                                        <a href="blog/${item.post_slug}" class="read_more_link">
                                            Read More <i class="fa-solid fa-circle-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>`;
                // Append the new blog card to the blog container
                website_all_blog.append(row);
            }

            // Update the offset for the next batch
            offset += limit;

            // Hide the Load More button if there are no more blogs to load
            if (offset >= totalBlog){
                $('#loadMoreButton').hide();
            }

        }
    }
</script>

{{-- Front end script end --}}