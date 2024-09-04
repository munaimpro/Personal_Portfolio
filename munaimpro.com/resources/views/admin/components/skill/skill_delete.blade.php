{{-- Delete modal start --}}
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body text-center">
                <h3 class="mt-3">Are you sure?</h3>
                <p class="mb-3">You won't be able to revert this!</p>
                <input class="" id="skillInfoDeleteId"/>
            </div>
            <div class="modal-footer justify-content-end">
                <button type="button" class="btn btn-sm btn-submit" onclick="deleteSkillInfo()">Yes, delete it!</button>
                <button type="button" class="btn btn-sm btn-cancel" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
{{-- Delete modal end --}}


{{-- Front end script start --}}

<script>

    // Function for delete skill information
    async function deleteSkillInfo() {
        try{
            // Getting input data
            let skill_info_id = $('#skillInfoDeleteId').val().trim();

            // Front end validation process
            if(skill_info_id.length === 0){
                displayToast('warning', 'Skill details id missing');
            } else{
                // Closing modal
                $('#deleteModal').modal('hide');

                // Pssing data to controller and getting response
                showLoader();
                let response = await axios.delete('/deleteSkillInfo', { data: { skill_info_id: skill_info_id } });
                hideLoader();

                if(response.data['status'] === 'success'){
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