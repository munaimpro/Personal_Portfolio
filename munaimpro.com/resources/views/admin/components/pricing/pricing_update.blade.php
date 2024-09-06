{{-- Edit modal start --}}
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Update Pricing</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="updatePricingForm">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">
                                <label class="form-label">Plan *</label>
                                <input type="text" class="form-control" id="updatePricingTitle">

                                <label class="form-label">Price *</label>
                                <input type="number" class="form-control" step="0.01" id="updatePricingPrice">

                                <label class="form-label">Features</label>
                                <textarea class="form-control" rows="5" id="updatePricingFeatures"></textarea>
                                <small>Enter features separated by commas (e.g., Feature1, Feature2, Feature3)</small>

                                <input type="text" class="form-control" id="pricingInfoId">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-end">
                <button type="button" class="btn btn-sm btn-submit" onclick="updatePricingInfo()">Save Changes</button>
                <button type="button" class="btn btn-sm btn-cancel" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
{{-- Edit modal end --}}


{{-- Front end script start --}}

<script>
    // Function for retrieve pricing details
    async function retrievePricingInfoById(pricing_info_id){

        try{
            // Assigning id to hidden field
            document.getElementById('pricingInfoId').value = pricing_info_id;

            // Pssing id to controller and getting response
            showLoader();
            let response = await axios.post('/retrievePricingInfoById', {pricing_info_id:pricing_info_id});
            hideLoader();

            if(response.data['status'] === 'success'){
                // Assigning retrieved values
                $('#updatePricingTitle').val(response.data.data['pricing_title']);
                $('#updatePricingPrice').val(response.data.data['pricing_price']);

                // Converting JSON array to a comma-separated string and showing
                let features = JSON.parse(response.data.data['pricing_features']).join(', ');
                $('#updatePricingFeatures').val(features);
            } else{
                displayToast('error', response.data['message']);
            }
        } catch(e){
            console.error('Something went wrong', e);
        }
    }

    // Function for update pricing details
    async function updatePricingInfo() {
        try{
            // Getting input data
            let pricing_title = $('#updatePricingTitle').val().trim();
            let pricing_price = $('#updatePricingPrice').val().trim();
            let pricing_feature = $('#updatePricingFeatures').val().trim();
            let pricing_info_id = $('#pricingInfoId').val().trim();

            // Front end validation process
            if(pricing_title.length === 0){
                displayToast('warning', 'Pricing title is required');
            } else if(pricing_price === ''){
                displayToast('warning', 'Price is required');
            } else if(pricing_feature === ''){
                displayToast('warning', 'Pricing feature is required');
            } else{
                // Closing modal
                $('#editModal').modal('hide');

                // Convert features string to an array (split by comma)
                let featuresArray = pricing_feature.split(',').map(feature => feature.trim());

                // Assigning pricing data to variable in JSON format
                let pricingData = {
                    "pricing_title" : pricing_title,
                    "pricing_price" : pricing_price,
                    "pricing_features" : featuresArray,
                    "pricing_info_id" : pricing_info_id,
                };

                // Pssing data to controller and getting response
                showLoader();
                let response = await axios.put('/updatePricingInfo', pricingData);
                hideLoader();

                if(response.data['status'] === 'success'){
                    // Reset form
                    $('#updatePricingForm')[0].reset();

                    // Call function to refresh pricing list
                    await retrieveAllPricingInfo();

                    displayToast('success', response.data['message']);
                } else{
                    displayToast('error', response.data['message']);
                }
            }
        } catch(e){
            console.error('Something went wrong', e);
        }
    }
</script>

{{-- Front end script end --}}