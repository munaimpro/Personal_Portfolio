{{-- Services section start --}}
<section id="services" class="services_wrapper vertical_MK25_w_space">
  <div class="container">
    <div class="row justify-content-start" id="websiteAllService">
      
    </div>
  </div>
</section>
{{-- Services section end --}}


{{-- Front end script start --}}

<script>

    // Function for retrive service information
    
    retriveAllServiceInfo();

    async function retriveAllServiceInfo(){

        try{
            // Getting content section
            let website_all_service = $('#websiteAllService');

            // Pssing data to controller and getting response
            showLoader();
            let response = await axios.get('/retriveAllServiceInfo');
            hideLoader();

            response.data.data.forEach(function(item, index){
                let row = `<div class="col-sm-12 col-lg-6 mb-5">
                            <div class="card">
                                <div class="service_MK25_icon fa-3x">
                                    ${item['service_icon']}
                                </div>
                                <h3 class="text-uppercase mb-3 mt-4">${item['service_title']}</h3>
                                <p>${item['service_description']}</p>
                            </div>
                        </div>`
                website_all_service.append(row);
            });
        } catch(e){
            console.error('Something went wrong', e);
        }
    }
</script>

{{-- Front end script end --}}