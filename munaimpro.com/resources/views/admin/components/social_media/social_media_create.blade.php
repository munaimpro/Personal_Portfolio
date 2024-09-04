{{-- Create modal start --}}
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Create Social Media</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addSocialMediaForm">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">
                                <div class="form-group">
                                    <label class="form-label">Media Name *</label>
                                    <input type="text" class="form-control" id="socialMediaTitle">
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Media Link *</label>
                                    <input type="text" class="form-control" id="socialMediaLink">
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Media Icon *</label>
                                    <select class="select" id="socialMediaIcon">
                                        <option value="<i class='fas fa-phone'></i>">Icon</option>
                                        <option value="<i class='fas fa-phone'></i>">Icon</option>
                                        <option value="<i class='fas fa-phone'></i>">Icon</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Media Placement</label>
                                    <select class="select" id="socialMediaPlacement" multiple>
                                        <option value = " ">Select media placement</option>
                                        <option value = "hero">Website Hero Section</option>
                                        <option value = "contact">Website Contact</option>
                                        <option value = "footer">Website Footer</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-end">
                <button type="button" class="btn btn-sm btn-submit" onclick="addSocialMediaInfo()">Add Social Media</button>
                <button type="button" class="btn btn-sm btn-cancel" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
{{-- Create modal end --}}


{{-- Front end script start --}}

<script>

    // Function for add social media information
    async function addSocialMediaInfo(){
        try{
            // Getting input data
            let social_media_title = $('#socialMediaTitle').val().trim();
            let social_media_link = $('#socialMediaLink').val().trim();
            let social_media_icon = $('#socialMediaIcon').val().trim();
            let social_media_placement = $('#socialMediaPlacement').val();

            // Front end validation process
            if(social_media_title.length === 0){
                displayToast('warning', 'Social media name is required');
            } else if(social_media_link.length === 0){
                displayToast('warning', 'Social media link is required');
            } else if(social_media_icon.length === 0){
                displayToast('warning', 'Social media icon is required');
            } else{
                // Closing modal
                $('#createModal').modal('hide');

                // Assigning social media data to variable in JSON format
                let socialMediaData = {
                    "social_media_title" : social_media_title,
                    "social_media_link" : social_media_link,
                    "social_media_icon" : social_media_icon,
                    "social_media_placement" : social_media_placement,
                }

                // Pssing data to controller and getting response
                showLoader();
                let response = await axios.post('/addSocialMediaInfo', socialMediaData);
                hideLoader();

                if(response.data['status'] === 'success'){
                    // Reset form
                    $('#addSocialMediaForm')[0].reset();

                    // Call function to refresh social media list
                    await retrieveAllSocialMediaInfo();

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