{{-- Create modal start --}}
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Add Interest</h5>
            </div>
            <div class="modal-body">
                <form id="addInterestForm">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">
                                <div class="form-group">
                                    <label class="form-label">Interest *</label>
                                    <input type="text" class="form-control" id="interestTitle">
                                </div>
                                
                                <div class="form-group">
                                    <label class="form-label">Icon *</label>
                                    <select class="form-control" id="interestIcon">
                                        <option value="<i class='fas fa-phone'></i>">Icon</option>
                                        <option value="<i class='fas fa-phone'></i>">Icon</option>
                                        <option value="<i class='fas fa-phone'></i>">Icon</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-end">
                <button type="button" class="btn btn-sm btn-submit" onclick="addInterestInfo()">Add Interest</button>
                <button type="button" class="btn btn-sm btn-cancel" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
{{-- Create modal end --}}


{{-- Front end script start --}}

<script>

    // Function for add interest information
    async function addInterestInfo(){
        try{
            // Getting input data
            let interest_title = $('#interestTitle').val().trim();
            let interest_icon = $('#interestIcon').val().trim();

            // Front end validation process
            if(interest_title.length === 0){
                displayToast('warning', 'Interest title is required');
            } else if(interest_icon === ''){
                displayToast('warning', 'Interest icon is required');
            } else{
                // Closing modal
                $('#createModal').modal('hide');

                // Assigning interest data to variable in JSON format
                let interestData = {
                    "interest_title" : interest_title,
                    "interest_icon" : interest_icon,
                }

                // Pssing data to controller and getting response
                showLoader();
                let response = await axios.post('/addInterestInfo', interestData);
                hideLoader();

                if(response.data['status'] === 'success'){
                    // Reset form
                    $('#addInterestForm')[0].reset();

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