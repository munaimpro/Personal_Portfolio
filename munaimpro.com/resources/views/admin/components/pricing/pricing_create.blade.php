{{-- Edit modal start --}}
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Add Pricing</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addPricingForm">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">
                                <label class="form-label">Plan *</label>
                                <input type="text" class="form-control" id="pricingTitle">

                                <label class="form-label">Price *</label>
                                <input type="number" class="form-control" step="0.01" id="pricingPrice">

                                <label class="form-label">Features</label>
                                <textarea class="form-control" rows="5" id="pricingFeatures"></textarea>

                                <label class="form-label">Status *</label>
                                <select class="select" id="pricingStatus">
                                    <option value="inactive">Inactive</option>
                                    <option value="active">Active</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-end">
                <button type="button" class="btn btn-sm btn-submit" onclick="addPricingInfo()">Add</button>
                <button type="button" class="btn btn-sm btn-cancel" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
{{-- Edit modal end --}}


{{-- Front end script start --}}

<script>

    // Function for add pricing
    
    async function addPricingInfo(){
        try{
            // Getting input data
            let pricing_title = $('#pricingTitle').val().trim();
            let pricing_price = $('#pricingPrice').val().trim();
            let pricing_feature = $('#pricingFeatures').val().trim();
            let pricing_status = $('#pricingStatus').val().trim();

            // Front end validation process
            if(pricing_title.length === 0){
                displayToast('warning', 'Pricing title is required');
            } else if(pricing_price === ''){
                displayToast('warning', 'Price is required');
            } else if(pricing_feature === ''){
                displayToast('warning', 'Pricing feature is required');
            } else if(pricing_status === ''){
                displayToast('warning', 'Pricing status is required');
            } else{
                // Closing modal
                $('#createModal').modal('hide');

                // Convert features string to an array (split by comma)
                let featuresArray = pricing_feature.split(',').map(feature => feature.trim());

                // Assigning pricing data to variable in JSON format
                let pricingData = {
                    "pricing_title" : pricing_title,
                    "pricing_price" : pricing_price,
                    "pricing_features" : featuresArray,
                    "pricing_status" : pricing_status,
                };

                // Pssing data to controller and getting response
                showLoader();
                let response = await axios.post('/addPricingInfo', pricingData);
                hideLoader();

                if(response.data['status'] === 'success'){
                    // Reset form
                    $('#addPricingForm')[0].reset();

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