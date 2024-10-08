{{-- Create modal start --}}
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Add Education</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addEducationForm">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">
                                <div class="form-group">
                                    <label class="form-label">Education Type *</label>
                                    <select class="select" id="educationType">
                                        <option value="Academic">Academic Education</option>
                                        <option value="Technical">Technical Education</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label class="form-label mt-3">Degree *</label>
                                    <input type="text" class="form-control" id="educationDegree">
                                </div>

                                <div class="form-group">
                                    <label class="form-label mt-3">Institution *</label>
                                    <input type="text" class="form-control" id="educationInstitution">
                                </div>

                                <div class="form-group">
                                    <label class="form-label mt-3">Starting Date *</label>
                                    <input type="date" class="form-control" id="educationStartingDate">
                                </div>

                                <div class="form-group">
                                    <label class="form-label mt-3">Ending Date *</label>
                                    <input type="date" class="form-control" id="educationEndingDate">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-end">
                <button type="button" class="btn btn-sm btn-submit" onclick="addEducationInfo()">Add Education</button>
                <button type="button" class="btn btn-sm btn-cancel" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
{{-- Create modal end --}}


{{-- Front end script start --}}

<script>

    // Function for add education information
    async function addEducationInfo(){
        try{
            // Getting input data
            let education_type = $('#educationType').val().trim();
            let education_degree = $('#educationDegree').val().trim();
            let education_institution = $('#educationInstitution').val().trim();
            let education_starting_date = $('#educationStartingDate').val().trim();
            let education_ending_date = $('#educationEndingDate').val().trim();

            // Front end validation process
            if(education_type.length === 0){
                displayToast('warning', 'Education type is required');
            } else if(education_degree.length === 0){
                displayToast('warning', 'Education degree is required');
            } else if(education_institution.length === 0){
                displayToast('warning', 'Education institution is required');
            } else if(education_starting_date.length === 0){
                displayToast('warning', 'Education starting date is required');
            } else if(education_starting_date === education_ending_date){
                displayToast('warning', 'Dates should not be same');
            } else if(education_ending_date && education_ending_date < education_starting_date){
                displayToast('warning', 'Invalid ending date');
            } else{
                // Closing modal
                $('#createModal').modal('hide');

                // Assigning education data to variable in JSON format
                let educationData = {
                    "education_type" : education_type,
                    "education_degree" : education_degree,
                    "education_institution" : education_institution,
                    "education_starting_date" : education_starting_date,
                    "education_ending_date" : education_ending_date,
                }

                // Pssing data to controller and getting response
                showLoader();
                let response = await axios.post('../addEducationInfo', educationData);
                hideLoader();

                if(response.data['status'] === 'success'){
                    // Reset form
                    $('#addEducationForm')[0].reset();

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