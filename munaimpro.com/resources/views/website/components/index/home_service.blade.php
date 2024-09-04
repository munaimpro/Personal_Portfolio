{{-- Services section --}}
<section id="services" class="services_wrapper vertical_MK25_w_space">
    <div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-12 mb-5">
            <h2 class="section_MK25_first_title">SERVICES</h2>
            <div class="section_MK25_subtitle">
                <h3>What i do</h3>
            </div>
        </div>

        <div id="websiteHomeService" class="row">
            
        </div>

        <div class="col-12">
        <a href="{{ url('services') }}" class="external_MK25_section_link fw-bold">
            View All Services <i class="fa-solid fa-circle-arrow-right"></i>
        </a>
        </div>
    </div>
    </div>
</section>


{{-- Front end script start --}}

<script>

    // Function for retrieve service information
    
    retrieveAllServiceInfo();

    async function retrieveAllServiceInfo(){

        try{
            // Getting content section
            let website_home_service = $('#websiteHomeService');

            // Pssing data to controller and getting response
            showLoader();
            let response = await axios.get('/retrieveAllServiceInfo');
            hideLoader();

            response.data.data.forEach(function(item, index){
                if(index < 4){
                    let row = `<div class="col-sm-12 col-lg-6 mb-5">
                                <div class="card">
                                    <div class="service_MK25_icon fa-3x">
                                        ${item['service_icon']}
                                    </div>
                                    <h3 class="text-uppercase mb-3 mt-4">${item['service_title']}</h3>
                                    <p>${item['service_description']}</p>
                                </div>
                            </div>`
                    website_home_service.append(row);
                }
            });
        } catch(e){
            console.error('Something went wrong', e);
        }
    }
</script>

{{-- Front end script end --}}