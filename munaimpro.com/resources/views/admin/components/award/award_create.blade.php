{{-- Create modal start --}}
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Create Award</h5>
            </div>
            <div class="modal-body">
                <form id="addAwardForm">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">
                                <div class="form-group">
                                    <label class="form-label">Award Type *</label>
                                    <select class="form-control" id="AwardType">
                                        <option value="Programming">Programming Award</option>
                                        <option value="Technical">Technical Award</option>
                                        <option value="Other">Other Award</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label class="form-label mt-3">Award Name *</label>
                                    <input type="text" class="form-control" id="awardTitle">
                                </div>

                                <div class="form-group">
                                    <label class="form-label mt-3">Award Issue Date *</label>
                                    <input type="date" class="form-control" id="awardDate">
                                </div>

                                <div class="form-group">
                                    <label class="form-label mt-3">Award Provider *</label>
                                    <input type="text" class="form-control" id="awardProvider">
                                </div>

                                <div class="form-group">
                                    <label class="form-label mt-3">Award For *</label>
                                    <textarea class="contentDetails" id="awardFor"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-end">
                <button type="button" class="btn btn-sm btn-submit" onclick="addAwardInfo()">Add Award</button>
                <button type="button" class="btn btn-sm btn-cancel" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
{{-- Create modal end --}}


{{-- Front end script start --}}

<script>

    // Function for add Award information
    async function addAwardInfo(){
        try{
            // Getting input data
            let award_type = $('#AwardType').val().trim();
            let award_title = $('#awardTitle').val().trim();
            let award_date = $('#awardDate').val().trim();
            let award_provider = $('#awardProvider').val().trim();
            let award_for = $('#awardFor').val().trim();

            // Front end validation process
            if(award_type.length === 0){
                displayToast('warning', 'Award type is required');
            } else if(award_title.length === 0){
                displayToast('warning', 'Award name is required');
            } else if(award_date.length === 0){
                displayToast('warning', 'Award issue date is required');
            } else if(award_provider.length === 0){
                displayToast('warning', 'Award provider name is required');
            } else if(award_for.length === 0){
                displayToast('warning', 'Award reason is required');
            } else{
                // Closing modal
                $('#createModal').modal('hide');

                // Assigning award data to variable in JSON format
                let awardData = {
                    "award_type" : award_type,
                    "award_title" : award_title,
                    "award_date" : award_date,
                    "award_provider" : award_provider,
                    "award_for" : award_for,
                }

                // Pssing data to controller and getting response
                showLoader();
                let response = await axios.post('/addAwardInfo', awardData);
                hideLoader();

                if(response.data['status'] === 'success'){
                    // Reset form
                    $('#addAwardForm')[0].reset();

                    // Call function to refresh award list
                    await retriveAllAwardInfo();

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