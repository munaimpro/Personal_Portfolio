{{-- Project details section start --}}
<section class="project_details_wrapper vertical_MK25_w_space">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7 mb-5">
                <div class="project_image">
                    <div class="owl-carousel owl-theme" id="websiteProjectUIImages">
                        {{-- Project UI images loaded here --}}
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="project_title mb-5">
                    <h2 class="section_MK25_first_title text-start" id="websiteProjectTitle">Project Details</h2>
                </div>

                <div class="project_info mb-5">
                    <p>
                        <span class="fw-bold me-1">Project Type:</span>
                        <span class="text-capitalize" id="websiteProjectType"></span>
                    </p>
                    <p>
                        <span class="fw-bold me-1">Project Category:</span>
                        <span class="text-capitalize" id="websiteProjectCategory"></span>
                    </p>
                    <p>
                        <span class="fw-bold me-1">Project Technology:</span>
                        <span class="text-capitalize" id="websiteProjectTechnology"></span>
                    </p>
                    <p>
                        <span class="fw-bold me-1">Project Duration:</span>
                        <span class="text-capitalize" id="websiteProjectDuration"></span>
                    </p>
                    <p>
                        <span class="fw-bold me-1">Project URL:</span>
                        <span class="text-lowercase" id="websiteProjectUrl">
                            
                        </span>
                    </p>
                </div>

                <div class="project_description" id="websiteProjectDescription">
                    {{-- Website protfolio details loaded here --}}
                </div>
            </div>
        </div>
    </div>
</section>
{{-- Project details section end --}}


{{-- Front end script start --}}

<script>
    
    // Function for retrieve portfolio details
    retrievePortfolioInfoById();

    async function retrievePortfolioInfoById(){
        try {
            // Getting portfolio id
            let portfolio_info_id = {{ $id }};

            // Sending id to controller and getting response
            showLoader();
            let response = await axios.post('../../retrievePortfolioInfoById', { portfolio_info_id: portfolio_info_id });
            hideLoader();

            if(response.data.data){
                // Formatting the project starting date
                let startingDate = new Date(response.data.data['project_starting_date']);
                let formattedStartingDate = startingDate.toLocaleDateString('en-US', {
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric',
                });

                // Formatting the project ending date
                let endingDate = new Date(response.data.data['project_ending_date']);
                let formattedEndingDate = endingDate.toLocaleDateString('en-US', {
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric',
                });

                if(response.data['status'] === 'success'){
                    // Generating full path for the project thumbnail
                    let projectThumbnailFullPath = "{{ url('/') }}" + '/storage/portfolio/thumbnails/' + response.data.data['project_thumbnail'];
                
                    // Assigning retrieved values
                    $('#websiteProjectTitle').html(response.data.data['project_title']);
                    $('#websiteProjectType').html(response.data.data['project_type']);
                    $('#websiteProjectDuration').html(`${formattedStartingDate} - ${endingDate < startingDate ? 'Present' : formattedEndingDate}`);
                    getUiImagePreview(JSON.parse(response.data.data['project_ui_image']));
                    $('#websiteProjectCategory').html(response.data.data.service['service_title']);
                    $('#websiteProjectUrl').html(`<a class="external_MK25_section_link p-0 fw-bold float-none" href="${response.data.data['project_url']}">${response.data.data['project_url']}</a> <i class="fas fa-external-link"></i>`);
                    $('#websiteProjectDescription').html(response.data.data['project_description']);
                    $('#websiteProjectTechnology').html(response.data.data['core_technology']);
                } else{
                    console.log('error', response.data['message']);
                }
            } else{
                console.log('error', response.data['message']);
            }
        } catch (e){
            console.error('Something went wrong', e);
        }
    }

    
    // Function for UI image preview

    function getUiImagePreview(uiImages){
        const carouselContainer = $('#websiteProjectUIImages');

        uiImages.forEach((image, index) => {
            // Generating full path for the project thumbnail
            let projectUIFullPath = "{{ url('/') }}" + '/storage/portfolio/ui_images/' + image;

            let row =  `<div class="item">
                            <img src="${projectUIFullPath}" alt="Project Image">
                        </div>`;
            carouselContainer.append(row);
        });
    }

</script>