{{-- Create modal start --}}
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Create Experience</h5>
            </div>
            <div class="modal-body">
                <form id="addExperienceForm">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">
                                <div class="form-group">
                                    <label class="form-label">Designation *</label>
                                    <input type="text" class="form-control" id="experienceTitle">
                                </div>

                                <div class="form-group">
                                    <label class="form-label mt-3">Working Place *</label>
                                    <input type="text" class="form-control" id="experienceInstitution">
                                </div>

                                <div class="form-group">
                                    <label class="form-label mt-3">Starting Date *</label>
                                    <input type="date" class="form-control" id="experienceStarttingDate">
                                </div>

                                <div class="form-group">
                                    <label class="form-label mt-3">Ending Date *</label>
                                    <input type="date" class="form-control" id="experienceEndingDate">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-end">
                <button type="button" class="btn btn-sm btn-submit" onclick="addExperienceInfo()">Add Experience</button>
                <button type="button" class="btn btn-sm btn-cancel" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
{{-- Create modal end --}}


{{-- Front end script start --}}

<script>

    // Function for add experience information
    async function addExperienceInfo(){
        try{
            // Getting input data
            let experience_title = $('#experienceTitle').val().trim();
            let experience_institution = $('#experienceInstitution').val().trim();
            let experience_starting_date = $('#experienceStarttingDate').val().trim();
            let experience_ending_date = $('#experienceEndingDate').val().trim();

            // Front end validation process
            if(experience_title.length === 0){
                displayToast('warning', 'Job title is required');
            } else if(experience_institution.length === 0){
                displayToast('warning', 'Working place/company is required');
            } else if(experience_starting_date.length === 0){
                displayToast('warning', 'Job starting date is required');
            } else if(experience_starting_date === experience_ending_date){
                displayToast('warning', 'Dates should not be same');
            } else if(experience_ending_date && experience_ending_date < experience_starting_date){
                displayToast('warning', 'Invalid ending date');
            } else{
                // Closing modal
                $('#createModal').modal('hide');

                // Assigning experience data to variable in JSON format
                let experienceData = {
                    "experience_title" : experience_title,
                    "experience_institution" : experience_institution,
                    "experience_starting_date" : experience_starting_date,
                    "experience_ending_date" : experience_ending_date,
                }

                // Pssing data to controller and getting response
                showLoader();
                let response = await axios.post('../addExperienceInfo', experienceData);
                hideLoader();

                if(response.data['status'] === 'success'){
                    // Reset form
                    $('#addExperienceForm')[0].reset();

                    // Call function to refresh experience list
                    await retriveAllExperienceInfo();

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