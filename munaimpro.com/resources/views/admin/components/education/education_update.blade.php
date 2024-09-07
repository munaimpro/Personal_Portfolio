{{-- Edit modal start --}}
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Update Education</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="updateEducationForm">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">
                                <div class="form-group">
                                    <label class="form-label">Education Type *</label>
                                    <select class="select" id="updateEducationType">
                                        <option value="Academic">Academic Education</option>
                                        <option value="Technical">Technical Education</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label class="form-label mt-3">Degree *</label>
                                    <input type="text" class="form-control" id="updateEducationDegree">
                                </div>

                                <div class="form-group">
                                    <label class="form-label mt-3">Institution *</label>
                                    <input type="text" class="form-control" id="updateEducationInstitution">
                                </div>

                                <div class="form-group">
                                    <label class="form-label mt-3">Starting Date *</label>
                                    <input type="date" class="form-control" id="updateEducationStartingDate">
                                </div>

                                <div class="form-group">
                                    <label class="form-label mt-3">Ending Date *</label>
                                    <input type="date" class="form-control" id="updateEducationEndingDate">
                                </div>

                                <input type="text" class="form-control" id="educationInfoId">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-end">
                <button type="button" class="btn btn-sm btn-submit" onclick="updateEducationInfo()">Save changes</button>
                <button type="button" class="btn btn-sm btn-cancel" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
{{-- Edit modal end --}}


{{-- Front end script start --}}

<script>
    // Function for retrieve education details
    async function retrieveEducationInfoById(education_info_id){

        try{
            // Assigning id to hidden field
            $('#educationInfoId').val(education_info_id);

            // Pssing id to controller and getting response
            showLoader();
            let response = await axios.post('/retrieveEducationInfoById', {education_info_id:education_info_id});
            hideLoader();

            if(response.data['status'] === 'success'){
                // Iterate through the options and add `selected` attribute to the correct one
                $('#updateEducationType option').each(function() {
                    if ($(this).val() == response.data.data['education_type']) {
                        $(this).prop('selected', true);
                    }
                });

                // Assigning retrieved values
                $('#updateEducationDegree').val(response.data.data['education_degree']);
                $('#updateEducationInstitution').val(response.data.data['education_institution']);
                $('#updateEducationStartingDate').val(response.data.data['education_starting_date']);
                $('#updateEducationEndingDate').val(response.data.data['education_ending_date']);
            } else{
                displayToast('error', response.data['message']);
            }
        } catch(e){
            console.error('Something went wrong', e);
        }
    }

    // Function for update education details
    async function updateEducationInfo() {
        try{
            // Getting input data
            let education_type = $('#updateEducationType').val().trim();
            let education_degree = $('#updateEducationDegree').val().trim();
            let education_institution = $('#updateEducationInstitution').val().trim();
            let education_starting_date = $('#updateEducationStartingDate').val().trim();
            let education_ending_date = $('#updateEducationEndingDate').val().trim();
            let education_info_id = $('#educationInfoId').val().trim();

            // Front end validation process
            if(education_type.length === 0){
                displayToast('warning', 'Education type is required');
            } else if(education_degree.length === 0){
                displayToast('warning', 'Education degree is required');
            } else if(education_institution.length === 0){
                displayToast('warning', 'Education institution is required');
            } else if(education_starting_date.length === 0){
                displayToast('warning', 'Education starting date is required');
            } else if(education_info_id.length === 0){
                displayToast('warning', 'Education details id missing');
            } else if(education_starting_date === education_ending_date){
                displayToast('warning', 'Dates should not be same');
            } else if(education_ending_date && education_ending_date < education_starting_date){
                displayToast('warning', 'Invalid ending date');
            } else{
                // Closing modal
                $('#editModal').modal('hide');

                // Assigning education data to variable in JSON format
                let educationData = {
                    "education_type" : education_type,
                    "education_degree" : education_degree,
                    "education_institution" : education_institution,
                    "education_starting_date" : education_starting_date,
                    "education_ending_date" : education_ending_date,
                    "education_info_id" : education_info_id,
                }

                // Pssing data to controller and getting response
                showLoader();
                let response = await axios.put('../updateEducationInfo', educationData);
                hideLoader();

                if(response.data['status'] === 'success'){
                    // Reset form
                    $('#updateEducationForm')[0].reset();

                    // Call function to refresh education list
                    await retrieveAllEducationInfo();

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