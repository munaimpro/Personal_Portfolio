{{-- Pricing section start --}}
<section class="pricing_wrapper vertical_MK25_w_space">
    <div class="container">
      <div class="row justify-content-center" id="websiteAllPricing">
        <div class="col-sm-12 mb-5">
          <div class="section_MK25_subtitle">
            <h3 class="text-center text-capitalize">Choose your best plan</h3>
            <p class="text-center text-capitalize">Let's build an incredible business solution togather</p>
          </div>
        </div>

        {{-- Website all pricings loaded here --}}

      </div>
    </div>
</section>
{{-- Pricing section end --}}


{{-- Front end script start --}}

<script>

    // Function to retrieve pricing information
    retrieveAllPricingInfo();

    async function retrieveAllPricingInfo(){
        try {
            // Getting the content section
            let website_all_pricing = $('#websiteAllPricing');

            // Passing data to controller and getting response
            showLoader();
            let response = await axios.get('/retrieveAllPricingInfo');
            hideLoader();

            console.log(response);

            if (response.data.status === 'success'){
                // Clear existing content
                website_all_pricing.empty();

                // Loop through each pricing item
                response.data.data.forEach(function (item) {
                    // Get features and convert them into a list
                    let features = JSON.parse(item.pricing_features).map(feature => {
                        return `<li>${feature} <i class="far fa-check-circle"></i></li>`;
                    }).join('');

                    // Construct each pricing card
                    let row = `<div class="col-lg-4 col-md-6 col-sm-12 d-flex">
                                    <div class="single_pricing mb-5 mb-lg-0 flex-fill">
                                        <div class="deal_type">${item.pricing_title}</div>
                                        <div class="deal_amount">
                                            <div class="price">
                                                <span class="money"><sup>$</sup>${item.pricing_price}</span>
                                            </div>
                                        </div>
                                        <ul class="single_deal">
                                            ${features}
                                        </ul>
                                        <a href="contact" class="btn">choose plan <i class="fas fa-circle-arrow-right"></i></a>
                                    </div>
                                </div>`;
                    website_all_pricing.append(row);
                });
            } else {
                console.error('Failed to fetch pricing data');
            }
        } catch (e) {
            console.error('Something went wrong', e);
        }
    }

</script>

{{-- Front end script end --}}