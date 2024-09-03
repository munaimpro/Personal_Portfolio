{{-- Testimonial section --}}
<section id="testimonial" class="testimonial_wrapper vertical_MK25_w_space">
    <div class="container">
    <div class="row">
        <div class="col-sm-12 mb-5">
        <h2 class="section_MK25_first_title">OUR CLIENT</h2>
        <div class="section_MK25_subtitle">
            <h3>What are they saying</h3>
        </div>
        </div>

        <div class="col-lg-10 m-auto mb-5">
        <div class="owl-carousel owl-theme" id="websiteHomeTestimonial">
            
        </div>
        </div>
    </div>
    </div>
</section>


{{-- Front end script start --}}

<script>

    // Function for retrieve client feedback information
    
    retrieveAllClientFeedbackInfo();

    async function retrieveAllClientFeedbackInfo(){

        try{
            // Getting testimonial content
            let website_home_testimonial = $('#websiteHomeTestimonial');

            // Pssing data to controller and getting response
            showLoader();
            let response = await axios.get('/retrieveAllClientFeedbackInfo');
            hideLoader();

            // Getting base URL of the system
            let baseUrl = "{{ url('/') }}";

            response.data.data.forEach(function(item, index){
                if(index < 3){
                    // Generating full path for the client image
                    let clientImageFullPath = baseUrl + '/storage/profile_picture/client_images/' + item['client_image'];

                    let row = `<div class="item">
                                    <div class="row justify-content-center">
                                        <div class="col-md-6 testimonial_image">
                                            <div class="mb-4 mb-lg-0">
                                                <img src="${clientImageFullPath}" class="img-fluid" alt="Client Image">
                                            </div>
                                        </div>
                                        <div class="col-md-6 testimonial_data">
                                            <div class="client_message border-bottom">
                                                <p>${item['client_feedback']}</p>
                                            </div>
                                            
                                            <div class="client_identity">
                                            <h3>${item['client_first_name']} ${item['client_last_name']}</h3>
                                            <p>${item['client_designation']}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>`
                    website_home_testimonial.trigger('add.owl.carousel', [$(row)]).trigger('refresh.owl.carousel');
                }
            });
        } catch(e){
            console.error('Something went wrong', e);
        }
    }
</script>

{{-- Front end script end --}}