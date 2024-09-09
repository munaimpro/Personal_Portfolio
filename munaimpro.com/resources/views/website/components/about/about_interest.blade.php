{{-- Interest section start --}}
<section id="interest" class="page_sectionMK25_wrapper vertical_MK25_w_space">
    <div class="container">
        <div class="row mb-5 mb-lg-0 justify-content-center" id="websiteAllInterest">
            <div class="col-12">
                <div class="section_MK25_subtitle">
                    <h4>INTEREST</h4>
                    <h3 class="mb-5">WHAT I LIKE TO DO</h3>
                </div>
            </div>

            {{-- Interest item loaded here --}}
        </div>
    </div>
</section>
{{-- Interest section end --}}


{{-- Front end script start --}}

<script>

    // Function for retrieve website interest information
    
    retrieveAllInterestInfo();

    async function retrieveAllInterestInfo(){

        try{
            // Getting interest section
            let interest = $('#interest');

            // Pssing data to controller and getting response
            showLoader();
            let response = await axios.post('/retrieveAllInterestInfo');
            hideLoader();

            // Hiding interest section when empty
            if(response.data.data.length === 0){
                interest.addClass('d-none');
            }

            // Getting interest component
            let website_all_interest = $('#websiteAllInterest');

            response.data.data.forEach(function(item, index){
                let row = `<div class="col-lg-4 col-sm-6 interest_MK25_items">
                                <div class="interest_MK25_item me-1 row align-items-center">
                                    <div class="col-2 outer_changeable_icon fa-2x">
                                        ${item['interest_icon']}
                                    </div>
                                    <div class="col-10 outer_changeable_text">
                                        <p class="m-0">${item['interest_title']}</p>
                                    </div>
                                </div>
                            </div>`
                website_all_interest.append(row);
            });
        } catch(e){
            console.error('Something went wrong', e);
        }
    }
</script>

{{-- Front end script end --}}