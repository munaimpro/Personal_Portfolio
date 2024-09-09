{{-- Portfolio section start --}}
<section id="portfolio" class="portfolio_wrapper vertical_MK25_w_space">
    <div class="container">
        <div class="row justify-content-start">
            <div class="col-sm-12 mb-5">
                <div class="section_MK25_subtitle">
                <h3 class="text-center text-capitalize">Explore my awesome works here</h3>
                <p class="text-center text-capitalize">I like to do something new and creative always</p>
                </div>
            </div>
        
            <div class="row justify-content-center" id="websiteAllPortfolio">

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
    </div>
</section>
{{-- Portfolio section end --}}


{{-- Front end script start --}}

<script>
        
    // Set initial counter and limit
    let offset = 0;
    const limit = 3;

    // Function for retrieve post information
    
    retrieveAllPortfolioInfo();

    async function retrieveAllPortfolioInfo(){

        try{
            // Pssing data to controller and getting response
            showLoader();
            let response = await axios.post('/retrieveAllPortfolioInfo');
            hideLoader();

            // Getting all post in a variable
            let allPortfolio = response.data.data;

            // Getting total available portfolio
            let totalPortfolio = allPortfolio.length;

            // Load the initial set of portfolio
            loadPortfolios(totalPortfolio, allPortfolio)

            // Attach event listener to the Load More button
            $('#loadMoreButton').on('click', function(){
                $('#loadMoreButtonSpinner').removeClass('d-none');
                $('#loadMoreButtonText').addClass('d-none');
                loadPortfolios(totalPortfolio, allPortfolio);
                $('#loadMoreButtonSpinner').addClass('d-none');
                $('#loadMoreButtonText').removeClass('d-none');
            });
            
        } catch(e){
            console.error('Something went wrong', e);
        }
    }


    // Function for loading portfolio iteratively
    function loadPortfolios(totalPortfolio, allPortfolio){
        // Getting content section
        let website_all_portfolio = $('#websiteAllPortfolio');

        // Check if there are more portfolio to load
        if(offset < totalPortfolio){
            for(i = offset; i < offset + limit && i < totalPortfolio; i++){
                let item = allPortfolio[i];

                if(item.project_status === 'published'){
                    // Generating full path for the project thumbnail
                    let projectThumbnailFullPath = "{{ url('/') }}" + '/storage/portfolio/thumbnails/' + item.project_thumbnail;

                    let row = `<div class="col-sm-12 col-md-6 col-lg-4 mb-5 portfolio-container">
                                    <div class="card p-0">
                                        <div class="card-body">
                                            <div class="portfolio_image">
                                                <span style="background-image: url(${projectThumbnailFullPath})"></span>
                                            </div>
                                            <div class="portfolio_data">
                                                <p class="portfolio_title mb-3 mt-4">${item.project_title}</p>
                                                <p class="portfolio_technology">
                                                    <span class="me-1"><i class="fas fa-laptop"></i></span>
                                                    <span class="me-3">${item.project_type}</span>
                                                    <span class="me-1"><i class="fas fa-code"></i></span>
                                                    <span class="me-3">${item.core_technology}</span>
                                                </p>
                                                <a href="portfolio/details/${item.id}" class="btn primary-btn float-end">
                                                    Details<span class="ms-3"><i class="fa-solid fa-circle-arrow-right"></i></span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>`
                    website_all_portfolio.append(row);
                }
            }

            // Update the offset for the next batch
            offset += limit;

            // Hide the Load More button if there are no more portfolio to load
            if (offset >= totalPortfolio){
                $('#loadMoreButton').hide();
            }
        }
    }
</script>

{{-- Front end script end --}}