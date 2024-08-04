{{-- Edit modal start --}}
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Interest</h5>
            </div>
            <div class="modal-body">
                <form id="updateInterestForm">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">
                                <label class="form-label">Interest *</label>
                                <input type="text" class="form-control" id="updateInterestTitle">

                                <label class="form-label">Icon *</label>
                                <select class="form-control" id="updateInterestIcon">
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
                <button type="button" class="btn btn-sm btn-submit" onclick="updateInterestInfo()">Save changes</button>
                <button type="button" class="btn btn-sm btn-cancel" data-bs-dismiss="modal">Cancel</button>
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
                document.getElementById('updateSkillType').value = response.data.data['skill_type'];
                document.getElementById('updateSkillName').value = response.data.data['skill_name'];
                document.getElementById('updateSkillPercentage').value = response.data.data['skill_percentage'];
            } else{
                displayToast('error', response.data['message']);
            }
        } catch(e){
            console.error('Something went wrong', e);
        }
    }

    // Function for update skill details
    async function updateInterestInfo() {
        try{
            // Getting input data
            let skill_type = $('#updateSkillType').val().trim();
            let skill_name = $('#updateSkillName').val().trim();
            let skill_percentage = $('#updateSkillPercentage').val().trim();
            let skill_info_id = $('#skillInfoId').val().trim();

            // Front end validation process
            if(skill_type.length === 0){
                displayToast('warning', 'Skill type is required');
            } else if(skill_name.length === 0){
                displayToast('warning', 'Skill name is required');
            } else if(skill_percentage.length === 0){
                displayToast('warning', 'Skill percentage is required');
            } else{
                // Closing modal
                $('#editModal').modal('hide');

                // Assigning skill data to variable in JSON format
                let skillData = {
                    "skill_type" : skill_type,
                    "skill_name" : skill_name,
                    "skill_percentage" : skill_percentage,
                    "skill_info_id" : skill_info_id,
                }

                // Pssing data to controller and getting response
                showLoader();
                let response = await axios.put('/updateSkillInfo', skillData);
                hideLoader();

                if(response.data['status'] === 'success'){
                    // Reset form
                    $('#updateSkillForm')[0].reset();

                    // Call function to refresh skill list
                    await retriveAllSkillInfo();

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