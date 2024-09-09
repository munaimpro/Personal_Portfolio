{{-- Portfolio section --}}
<section id="portfolio" class="portfolio_wrapper vertical_MK25_w_space">
    <div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-12 mb-5">
            <h2 class="section_MK25_first_title">PORTFOLIO</h2>
            <div class="section_MK25_subtitle">
                <h3>What i have done</h3>
            </div>
        </div>

        <div class="row justify-content-center" id="websiteHomePortfolio">

        </div>

        <div class="col-12">
        <a href="{{ url('portfolio') }}" class="external_MK25_section_link fw-bold">
            View All Works <i class="fa-solid fa-circle-arrow-right"></i>
        </a>
        </div>
    </div>
    </div>
</section>


{{-- Front end script start --}}

<script>

    // Function for retrieve portfolio information
    
    retrieveAllPortfolioInfo();

    async function retrieveAllPortfolioInfo(){

        try{
            // Getting portfolio section
            let portfolio = $('#portfolio');

            // Getting content section
            let website_home_portfolio = $('#websiteHomePortfolio');

            // Pssing data to controller and getting response
            showLoader();
            let response = await axios.post('/retrieveAllPortfolioInfo');
            hideLoader();

            // Hiding portfolio section when empty
            if(response.data.data.length === 0){
                portfolio.addClass('d-none');
            }

            // Getting base URL of the system
            let baseUrl = "{{ url('/') }}";

            response.data.data.forEach(function(item, index){

                if(index < 3 && item['project_status'] === 'published'){
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
                                                <a href="portfolio/details/${item['id']}" class="btn primary-btn float-end portfolioDetailsBtn">
                                                    Details<span class="ms-3"><i class="fa-solid fa-circle-arrow-right"></i></span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>`
                    website_home_portfolio.append(row);
                }
            });
        } catch(e){
            console.error('Something went wrong', e);
        }
    }
</script>

{{-- Front end script end --}}