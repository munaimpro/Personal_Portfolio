{{-- Edit modal start --}}
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Experience</h5>
            </div>
            <div class="modal-body">
                <form id="updateExperienceForm">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">
                                <div class="form-group">
                                    <label class="form-label">Designation *</label>
                                    <input type="text" class="form-control" id="updateExperienceTitle">
                                </div>

                                <div class="form-group">
                                    <label class="form-label mt-3">Working Place *</label>
                                    <input type="text" class="form-control" id="updateExperienceInstitution">
                                </div>

                                <div class="form-group">
                                    <label class="form-label mt-3">Starting Date *</label>
                                    <input type="date" class="form-control" id="updateExperienceStartingDate">
                                </div>

                                <div class="form-group">
                                    <label class="form-label mt-3">Ending Date *</label>
                                    <input type="date" class="form-control" id="updateExperienceEndingDate">
                                </div>

                                <input type="text" class="form-control" id="experienceInfoId">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-end">
                <button type="button" class="btn btn-sm btn-submit" onclick="updateExperienceInfo()">Save changes</button>
                <button type="button" class="btn btn-sm btn-cancel" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
{{-- Edit modal end --}}


{{-- Front end script start --}}

<script>
    // Function for retrive experience details
    async function retriveExperienceInfoById(experience_info_id){

        try{
            // Assigning id to hidden field
            document.getElementById('experienceInfoId').value = experience_info_id;

            // Pssing id to controller and getting response
            showLoader();
            let response = await axios.post('../retriveExperienceInfoById', {experience_info_id:experience_info_id});
            hideLoader();

            if(response.data['status'] === 'success'){
                // Assigning retrived values
                document.getElementById('updateExperienceTitle').value = response.data.data['experience_title'];
                document.getElementById('updateExperienceInstitution').value = response.data.data['experience_institution'];
                document.getElementById('updateExperienceStartingDate').value = response.data.data['experience_starting_date'];
                document.getElementById('updateExperienceEndingDate').value = response.data.data['experience_ending_date'];
            } else{
                displayToast('error', response.data['message']);
            }
        } catch(e){
            console.error('Something went wrong', e);
        }
    }

    // Function for update experience details
    async function updateExperienceInfo() {
        try{
            // Getting input data
            let experience_title = $('#updateExperienceTitle').val().trim();
            let experience_institution = $('#updateExperienceInstitution').val().trim();
            let experience_starting_date = $('#updateExperienceStartingDate').val().trim();
            let experience_ending_date = $('#updateExperienceEndingDate').val().trim();
            let experience_info_id = $('#experienceInfoId').val().trim();

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
                $('#editModal').modal('hide');

                // Assigning experience data to variable in JSON format
                let experienceData = {
                    "experience_title" : experience_title,
                    "experience_institution" : experience_institution,
                    "experience_starting_date" : experience_starting_date,
                    "experience_ending_date" : experience_ending_date,
                    "experience_info_id" : experience_info_id,
                }

                // Pssing data to controller and getting response
                showLoader();
                let response = await axios.put('../updateExperienceInfo', experienceData);
                hideLoader();

                if(response.data['status'] === 'success'){
                    // Reset form
                    $('#updateExperienceForm')[0].reset();

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