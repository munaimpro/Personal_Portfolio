{{-- Edit modal start --}}
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Update Social Media</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="updateSocialMediaForm">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">
                                <div class="form-group">
                                    <label class="form-label">Media Name *</label>
                                    <input type="text" class="form-control" id="updateSocialMediaTitle">
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Media Link *</label>
                                    <input type="text" class="form-control" id="updateSocialMediaLink">
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Media Icon *</label>
                                    <select class="select" id="updateSocialMediaIcon">
                                        <option value="<i class='fas fa-phone'></i>">Icon</option>
                                        <option value="<i class='fas fa-phone'></i>">Icon</option>
                                        <option value="<i class='fas fa-phone'></i>">Icon</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Media Placement</label>
                                    <select class="select" id="updateSocialMediaPlacement" multiple>
                                        <option value = " ">Select media placement</option>
                                        <option value = "hero">Website Hero Section</option>
                                        <option value = "contact">Website Contact</option>
                                        <option value = "footer">Website Footer</option>
                                    </select>
                                </div>

                                <input type="text" class="form-control" id="socialMediaInfoId">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-end">
                <button type="button" class="btn btn-sm btn-submit" onclick="updateSocialMediaInfo()">Save changes</button>
                <button type="button" class="btn btn-sm btn-cancel" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
{{-- Edit modal end --}}


{{-- Front end script start --}}

<script>
    // Function for retrieve social media details
    async function retrieveSocialMediaInfoById(social_media_info_id) {
        try{
            // Assigning id to hidden field
            document.getElementById('socialMediaInfoId').value = social_media_info_id;

            // Pssing id to controller and getting response
            showLoader();
            let response = await axios.post('/retrieveSocialMediaInfoById', { social_media_info_id: social_media_info_id });
            hideLoader();

            if (response.data['status'] === 'success') {
                // Assigning retrieved values to form fields
                document.getElementById('updateSocialMediaTitle').value = response.data.data['social_media_title'];
                document.getElementById('updateSocialMediaLink').value = response.data.data['social_media_link'];
                document.getElementById('updateSocialMediaIcon').value = response.data.data['social_media_icon'];

                // Handle social media placement as an array (in case it's JSON)
                let placements = response.data.data['social_media_placement'];
                if (typeof placements === 'string') {
                    placements = JSON.parse(placements); // Convert JSON string to array
                }

                let selectElement = document.getElementById('updateSocialMediaPlacement');
                // Reset select options
                for (let option of selectElement.options) {
                    option.selected = false;
                }

                // Mark appropriate options as selected
                for (let placement of placements) {
                    for (let option of selectElement.options) {
                        if (option.value === placement) {
                            option.selected = true;
                        }
                    }
                }
            } else {
                displayToast('error', response.data['message']);
            }
        } catch(e){
            console.error('Something went wrong', e);
        }
    }


    // Function for update social media information
    async function updateSocialMediaInfo(){
        try{
            // Getting input data
            let social_media_title = $('#updateSocialMediaTitle').val().trim();
            let social_media_link = $('#updateSocialMediaLink').val().trim();
            let social_media_icon = $('#updateSocialMediaIcon').val().trim();
            let social_media_placement = $('#updateSocialMediaPlacement').val();
            let social_media_info_id = $('#socialMediaInfoId').val().trim();

            // Front end validation process
            if(social_media_title.length === 0){
                displayToast('warning', 'Social media name is required');
            } else if(social_media_link.length === 0){
                displayToast('warning', 'Social media link is required');
            } else if(social_media_icon.length === 0){
                displayToast('warning', 'Social media icon is required');
            } else{
                // Closing modal
                $('#editModal').modal('hide');

                // Assigning social media data to variable in JSON format
                let socialMediaData = {
                    "social_media_title" : social_media_title,
                    "social_media_link" : social_media_link,
                    "social_media_icon" : social_media_icon,
                    "social_media_placement" : social_media_placement,
                    "social_media_info_id" : social_media_info_id,
                }

                // Pssing data to controller and getting response
                showLoader();
                let response = await axios.put('/updateSocialMediaInfo', socialMediaData);
                hideLoader();

                if(response.data['status'] === 'success'){
                    // Reset form
                    $('#updateSocialMediaForm')[0].reset();

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