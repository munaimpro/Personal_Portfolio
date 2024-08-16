{{-- Create modal start --}}
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Create Post</h5>
            </div>
            <div class="modal-body">
                <form id="addPostForm">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Heading</label>
                            <input class="form-control" type="text" id="postHeading">
                        </div>

                        <div class="form-group">
                            <label>Slug</label>
                            <input class="form-control" type="text" id="postSlug">
                        </div>

                        <div class="form-group">
                            <label>Category</label>
                            <select class="form-control" id="categoryId">
                                
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Thumbnail</label>
                            <div class="image-upload">
                                <input class="form-control" type="file" id="postThumbnail">
                                <div class="image-uploads">
                                    <img src="{{ asset('assets/img/icons/upload.svg') }}" alt="img">
                                    <h4>Drag and drop a file to upload</h4>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Description</label>
                            <textarea class="contentDetails" id="postDescription"></textarea>
                        </div>

                        <div class="form-group">
                            <label>Publish Time</label>
                            <input class="form-control" type="datetime-local" id="publishTime" onchange="togglePostButton()">
                        </div>

                        <input type="text" id="publishStatus">
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-end">
                <button type="button" id="publishBtn" class="btn btn-submit" onclick="addPostInfo()">Publish</button>
                <button type="button" id="scheduleBtn" class="btn btn-submit d-none" onclick="addPostInfo()">Schedule</button>
                <button type="button" class="btn btn-cancel" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
{{-- Create modal end --}}


{{-- Front end script start --}}

<script>

    // Function for retrive category information

    retriveAllCategoryInfo();

    async function retriveAllCategoryInfo(){

        try{
            // Getting data table
            let category_id = $('#categoryId');

            // Pssing request to controller and getting response
            showLoader();
            let response = await axios.get('/retriveAllCategoryInfo');
            hideLoader();

            response.data.data.forEach(function(item, index){
                let row = `<option value="${item['id']}">${item['category_name']}</option>`
                category_id.append(row);
            });
        } catch(e){
            console.error('Something went wrong', e);
        }
    }


    // Function for toggle shedule and publish button
    
    function togglePostButton(){
        const publishBtn = $('#publishBtn');
        const scheduleBtn = $('#scheduleBtn');
        const publishStatus = $('#publishStatus');
        const publishTimeInput = $('#publishTime').val();
        const selectedTime = new Date(publishTimeInput);
        const currentTime = new Date();

        // Remove seconds and milliseconds for comparison
        selectedTime.setSeconds(0, 0);
        currentTime.setSeconds(0, 0);

        console.log(selectedTime.getTime())
        console.log(currentTime.getTime())
        console.log(selectedTime.getTime() < currentTime.getTime())
        
        // Compare the selected time with the current time
        if(publishTimeInput && selectedTime.getTime() < currentTime.getTime()){
            publishBtn.addClass('disabled');
            publishBtn.removeClass('d-none');
            scheduleBtn.addClass('d-none');
        } else if (publishTimeInput && selectedTime.getTime() > currentTime.getTime()) {
            publishBtn.addClass('d-none');
            scheduleBtn.removeClass('d-none');
        } else{
            publishBtn.removeClass('disabled');
            publishBtn.removeClass('d-none');
            scheduleBtn.addClass('d-none');
        }
    }

    // Update the publish time with the current time every second
    setInterval(togglePostButton, 1000);
    
    
    // Function for add blog post

    async function addPostInfo(){
        try{
            // Getting input data
            let post_heading = $('#postHeading').val().trim();
            let post_slug = $('#postSlug').val().trim();
            let category_id = $('#categoryId').val().trim();
            let post_thumbnail = $('#postThumbnail')[0].files[0];
            let post_description = tinymce.get('postDescription').getContent().trim();
            let publish_time = $('#publishTime').val().trim();
            
            // Front end validation process
            if(post_heading.length === 0){
                displayToast('warning', 'Post heading is required');
            } else if(post_slug.length === 0){
                displayToast('warning', 'Post slug is required');
            } else if(category_id === ''){
                displayToast('warning', 'Post category is required');
            } else if(!post_thumbnail){
                displayToast('warning', 'Post thumbnail is required');
            } else if(post_description.length === 0){
                displayToast('warning', 'Post details is required');
            } else{
                // Closing modal
                $('#createModal').modal('hide');

                // FormData object
                let formData = new FormData();

                // Data append to FormData
                formData.append('post_heading', post_heading);
                formData.append('post_slug', post_slug);
                formData.append('category_id', category_id);
                formData.append('post_thumbnail', post_thumbnail);
                formData.append('post_description', post_description);
                if(publish_time) formData.append('publish_time', publish_time);

                // Pssing data to controller and getting response
                showLoader();
                let response = await axios.post('../addPostInfo', formData, {
                    headers:{'content-type':'multipart/form-data'}
                });
                hideLoader();

                if(response.data['status'] === 'success'){
                    // Reset form
                    $('#addPostForm')[0].reset();

                    // Call function to refresh post list
                    await retriveAllPostInfo();

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