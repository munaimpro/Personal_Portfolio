{{-- Edit modal start --}}
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Update Interest</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="updateInterestForm">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">
                                <label class="form-label">Interest *</label>
                                <input type="text" class="form-control" id="updateInterestTitle">

                                <label class="form-label">Icon *</label>
                                <select class="select" id="updateInterestIcon">
                                    <option value="<i class='fas fa-phone'></i>">Icon</option>
                                    <option value="<i class='fas fa-phone'></i>">Icon</option>
                                    <option value="<i class='fas fa-phone'></i>">Icon</option>
                                </select>

                                <input type="text" class="form-control" id="interestInfoId">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-end">
                <button type="button" class="btn btn-sm btn-submit" onclick="updateInterestInfo()">Save Changes</button>
                <button type="button" class="btn btn-sm btn-cancel" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
{{-- Edit modal end --}}


{{-- Front end script start --}}

<script>
    // Function for retrive interest details
    async function retriveInterestInfoById(interest_info_id){

        try{
            // Assigning id to hidden field
            document.getElementById('interestInfoId').value = interest_info_id;

            // Pssing id to controller and getting response
            showLoader();
            let response = await axios.post('/retriveInterestInfoById', {interest_info_id:interest_info_id});
            hideLoader();

            if(response.data['status'] === 'success'){
                // Assigning retrived values
                document.getElementById('updateInterestTitle').value = response.data.data['interest_title'];
                document.getElementById('updateInterestIcon').value = response.data.data['interest_icon'];
            } else{
                displayToast('error', response.data['message']);
            }
        } catch(e){
            console.error('Something went wrong', e);
        }
    }

    // Function for update interest details
    async function updateInterestInfo() {
        try{
            // Getting input data
            let interest_title = $('#updateInterestTitle').val().trim();
            let interest_icon = $('#updateInterestIcon').val().trim();
            let interest_info_id = $('#interestInfoId').val().trim();

            // Front end validation process
            if(interest_title.length === 0){
                displayToast('warning', 'Interest title is required');
            } else if(interest_icon === ''){
                displayToast('warning', 'Interest icon is required');
            } else{
                // Closing modal
                $('#editModal').modal('hide');

                // Assigning interest data to variable in JSON format
                let interestData = {
                    "interest_title" : interest_title,
                    "interest_icon" : interest_icon,
                    "interest_info_id" : interest_info_id,
                }

                // Pssing data to controller and getting response
                showLoader();
                let response = await axios.put('/updateInterestInfo', interestData);
                hideLoader();

                if(response.data['status'] === 'success'){
                    // Reset form
                    $('#updateInterestForm')[0].reset();

                    // Call function to refresh interest list
                    await retriveAllInterestInfo();

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