{{-- Create modal start --}}
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Create Skill</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addSkillForm">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">
                                <div class="form-group">
                                    <label class="form-label">Skill Type *</label>
                                    <select class="select" id="skillType">
                                        <option value="Programming">Programming Skill</option>
                                        <option value="Technical">Technical Skill</option>
                                        <option value="Other">Other Skill</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label class="form-label mt-3">Skill Name *</label>
                                    <input type="text" class="form-control" id="skillName">
                                </div>
                                
                                <div class="form-group">
                                    <label class="form-label mt-3">Percentage *</label>
                                    <input type="text" class="form-control" id="skillPercentage">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-end">
                <button type="button" class="btn btn-sm btn-submit" onclick="addSkillInfo()">Add Skill</button>
                <button type="button" class="btn btn-sm btn-cancel" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
{{-- Create modal end --}}


{{-- Front end script start --}}

<script>

    // Function for add skill information
    async function addSkillInfo(){
        try{
            // Getting input data
            let skill_type = $('#skillType').val().trim();
            let skill_name = $('#skillName').val().trim();
            let skill_percentage = $('#skillPercentage').val().trim();

            // Front end validation process
            if(skill_type.length === 0){
                displayToast('warning', 'Skill type is required');
            } else if(skill_name.length === 0){
                displayToast('warning', 'Skill name is required');
            } else if(skill_percentage.length === 0){
                displayToast('warning', 'Skill percentage is required');
            } else{
                // Closing modal
                $('#createModal').modal('hide');

                // Assigning skill data to variable in JSON format
                let skillData = {
                    "skill_type" : skill_type,
                    "skill_name" : skill_name,
                    "skill_percentage" : skill_percentage,
                }

                // Pssing data to controller and getting response
                showLoader();
                let response = await axios.post('/addSkillInfo', skillData);
                hideLoader();

                if(response.data['status'] === 'success'){
                    // Reset form
                    $('#addSkillForm')[0].reset();

                    // Call function to refresh skill list
                    await retrieveAllSkillInfo();

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