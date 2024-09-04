{{-- Delete modal start --}}
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body text-center">
                <h3 class="mt-3">Are you sure?</h3>
                <p class="mb-3">You won't be able to revert this!</p>
                <input class="" id="awardInfoDeleteId"/>
            </div>
            <div class="modal-footer justify-content-end">
                <button type="button" class="btn btn-sm btn-submit" onclick="deleteAwardInfo()">Yes, delete it!</button>
                <button type="button" class="btn btn-sm btn-cancel" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
{{-- Delete modal end --}}


{{-- Front end script start --}}

<script>

    // Function for delete award information
    async function deleteAwardInfo() {
        try{
            // Getting input data
            let award_info_id = $('#awardInfoDeleteId').val().trim();

            // Front end validation process
            if(award_info_id.length === 0){
                displayToast('warning', 'Award details id missing');
            } else{
                // Closing modal
                $('#deleteModal').modal('hide');

                // Pssing data to controller and getting response
                showLoader();
                let response = await axios.delete('/deleteAwardInfo', { data: { award_info_id: award_info_id } });
                hideLoader();

                if(response.data['status'] === 'success'){
                    // Call function to refresh award list
                    await retrieveAllAwardInfo();

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