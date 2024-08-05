{{-- Edit modal start --}}
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Social Media</h5>
            </div>
            <div class="modal-body">
                <form id="updateSocialMediaForm">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">
                                <label class="form-label">Media Name *</label>
                                <input type="text" class="form-control" id="updateSocialMediaTitle">

                                <label class="form-label">Media Link *</label>
                                <input type="text" class="form-control" id="updateSocialMediaLink">
                                
                                <label class="form-label">Media Icon *</label>
                                <select class="form-control" id="updateSocialMediaIcon">
                                    <option value="<i class='fas fa-phone'></i>">Icon</option>
                                    <option value="<i class='fas fa-phone'></i>">Icon</option>
                                    <option value="<i class='fas fa-phone'></i>">Icon</option>
                                </select>

                                <label class="form-label">Global Media</label>
                                <select class="form-control" id="updateGlobalSocialMedia">
                                    <option value = "0">No</option>
                                    <option value = "1">Yes</option>
                                </select>

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
    // Function for retrive social media details
    async function retriveSocialMediaInfoById(social_media_info_id){

        try{
            // Assigning id to hidden field
            document.getElementById('socialMediaInfoId').value = social_media_info_id;

            // Pssing id to controller and getting response
            showLoader();
            let response = await axios.post('/retriveSocialMediaInfoById', {social_media_info_id:social_media_info_id});
            hideLoader();

            if(response.data['status'] === 'success'){
                // Assigning retrived values
                document.getElementById('updateSocialMediaTitle').value = response.data.data['social_media_title'];
                document.getElementById('updateSocialMediaLink').value = response.data.data['social_media_link'];
                document.getElementById('updateSocialMediaIcon').value = response.data.data['social_media_icon'];
                document.getElementById('updateGlobalSocialMedia').value = response.data.data['global_social_media'];
            } else{
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
            let global_social_media = $('#updateGlobalSocialMedia').val().trim();
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
                    "global_social_media" : global_social_media,
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
                    await retriveAllSocialMediaInfo();

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