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

        </div>
    </div>
</section>
{{-- Portfolio section end --}}


{{-- Front end script start --}}

<script>

    // Function for retrieve portfolio information
    
    retrieveAllPortfolioInfo();

    async function retrieveAllPortfolioInfo(){

        try{
            // Getting content section
            let website_all_portfolio = $('#websiteAllPortfolio');

            // Pssing data to controller and getting response
            showLoader();
            let response = await axios.get('/retrieveAllPortfolioInfo');
            hideLoader();

            // Getting base URL of the system
            let baseUrl = "{{ url('/') }}";

            response.data.data.forEach(function(item, index){

                if(item['project_status'] === 'published'){
                    // Generating full path for the project thumbnail
                    let projectThumbnailFullPath = baseUrl + '/storage/portfolio/thumbnails/' + item['project_thumbnail'];

                    let row = `<div class="col-sm-12 col-md-6 col-lg-4 mb-5 portfolio-container">
                                    <div class="card p-0">
                                        <div class="card-body">
                                            <div class="portfolio_image">
                                                <span style="background-image: url(${projectThumbnailFullPath})"></span>
                                            </div>
                                            <div class="portfolio_data">
                                                <p class="portfolio_title mb-3 mt-4">${item['project_title']}</p>
                                                <p class="portfolio_technology">
                                                    <span class="me-1"><i class="fas fa-laptop"></i></span>
                                                    <span class="me-3">${item['project_type']}</span>
                                                    <span class="me-1"><i class="fas fa-code"></i></span>
                                                    <span class="me-3">${item['core_technology']}</span>
                                                </p>
                                                <a href="project_details/${item['id']}" class="btn primary-btn float-end">
                                                    Details<span class="ms-3"><i class="fa-solid fa-circle-arrow-right"></i></span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>`
                    website_all_portfolio.append(row);
                }
            });
        } catch(e){
            console.error('Something went wrong', e);
        }
    }
</script>

{{-- Front end script end --}}