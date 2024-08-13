{{-- Edit modal start --}}
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Award</h5>
            </div>
            <div class="modal-body">
                <form id="updateAwardForm">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">
                                <div class="form-group">
                                    <label class="form-label">Award Type *</label>
                                    <select class="form-control" id="updateAwardType">
                                        <option value="Programming">Programming Award</option>
                                        <option value="Technical">Technical Award</option>
                                        <option value="Other">Other Award</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label class="form-label mt-3">Award Name *</label>
                                    <input type="text" class="form-control" id="updateAwardTitle">
                                </div>

                                <div class="form-group">
                                    <label class="form-label mt-3">Award Issue Date *</label>
                                    <input type="date" class="form-control" id="updateAwardDate">
                                </div>

                                <div class="form-group">
                                    <label class="form-label mt-3">Award Provider *</label>
                                    <input type="text" class="form-control" id="updateAwardProvider">
                                </div>

                                <div class="form-group">
                                    <label class="form-label mt-3">Award For *</label>
                                    <textarea class="form-control contentDetails" id="updateAwardFor"></textarea>
                                </div>

                                <input type="text" class="form-control" id="awardInfoId">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-end">
                <button type="button" class="btn btn-sm btn-submit" onclick="updateAwardInfo()">Save changes</button>
                <button type="button" class="btn btn-sm btn-cancel" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
{{-- Edit modal end --}}


{{-- Front end script start --}}

<script>
    // Function for retrive award details
    async function retriveAwardInfoById(award_info_id){

        try{
            // Assigning id to hidden field
            document.getElementById('awardInfoId').value = award_info_id;

            // Pssing id to controller and getting response
            showLoader();
            let response = await axios.post('/retriveAwardInfoById', {award_info_id:award_info_id});
            hideLoader();

            if(response.data['status'] === 'success'){
                // Assigning retrived values
                document.getElementById('updateAwardType').value = response.data.data['award_type'];
                document.getElementById('updateAwardTitle').value = response.data.data['award_title'];
                document.getElementById('updateAwardDate').value = response.data.data['award_date'];
                document.getElementById('updateAwardProvider').value = response.data.data['award_provider'];
                document.getElementById('updateAwardFor').value = response.data.data['award_for'];
            } else{
                displayToast('error', response.data['message']);
            }
        } catch(e){
            console.error('Something went wrong', e);
        }
    }

    // Function for update award details
    async function updateAwardInfo() {
        try{
            // Getting input data
            let award_type = $('#updateAwardType').val().trim();
            let award_title = $('#updateAwardTitle').val().trim();
            let award_date = $('#updateAwardDate').val().trim();
            let award_provider = $('#updateAwardProvider').val().trim();
            let award_for = $('#updateAwardFor').val().trim();
            let award_info_id = $('#awardInfoId').val().trim();

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
                $('#editModal').modal('hide');

                // Assigning award data to variable in JSON format
                let awardData = {
                    "award_type" : award_type,
                    "award_title" : award_title,
                    "award_date" : award_date,
                    "award_provider" : award_provider,
                    "award_for" : award_for,
                    "award_info_id" : award_info_id,
                }

                // Pssing data to controller and getting response
                showLoader();
                let response = await axios.put('/updateAwardInfo', awardData);
                hideLoader();

                if(response.data['status'] === 'success'){
                    // Reset form
                    $('#updateAwardForm')[0].reset();

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