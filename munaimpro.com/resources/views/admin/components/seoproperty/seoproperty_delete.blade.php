{{-- Delete SEO Property Modal Start --}}
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteSeoModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body text-center">
                <h3 class="mt-3">Are you sure?</h3>
                <p class="mb-3">You won't be able to revert this!</p>
                <input type="text" id="seopropertyInfoDeleteId"/>
            </div>
            <div class="modal-footer justify-content-end">
                <button type="button" class="btn btn-cancel" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-submit" onclick="deleteSeoPropertyInfo()">Yes, delete it!</button>
            </div>
        </div>
    </div>
</div>
{{-- Delete SEO Property Modal End --}}


{{-- Front end script start --}}

<script>

    // Function for deleting an SEO property
    async function deleteSeoPropertyInfo() {
        try {
            // Getting the SEO property ID from the input field
            let seoproperty_info_id = $('#seopropertyInfoDeleteId').val().trim();

            // Front end validation to ensure the ID is present
            if (seoproperty_info_id.length === 0) {
                displayToast('warning', 'SEO property ID is missing');
            } else {
                // Closing the modal
                $('#deleteModal').modal('hide');

                // Showing loader while making the request
                showLoader();
                let response = await axios.delete('../deleteSeoPropertyInfo', { data: { seoproperty_info_id: seoproperty_info_id } });
                hideLoader();

                // Handling the response from the server
                if (response.data['status'] === 'success') {
                    // Call function to refresh the SEO properties list
                    await retrieveAllSeoPropertyInfo();

                    displayToast('success', response.data['message']);
                } else {
                    displayToast('error', response.data['message']);
                }
            }
        } catch (e) {
            console.error('Something went wrong', e);
            displayToast('error', 'An error occurred while trying to delete the SEO property');
        }
    }

</script>

{{-- Front end script end --}}