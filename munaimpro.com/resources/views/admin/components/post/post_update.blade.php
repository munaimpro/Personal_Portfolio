{{-- Edit modal start --}}
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Update Post</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="updatePostForm">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Heading</label>
                            <input class="form-control" type="text" id="updatePostHeading">
                        </div>

                        <div class="form-group">
                            <label>Slug</label>
                            <input class="form-control" type="text" id="updatePostSlug">
                        </div>

                        <div class="form-group">
                            <label>Category</label>
                            <select class="select" id="updateCategoryId">
                                
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Thumbnail</label>
                            <div class="image-upload">
                                <input class="form-control" type="file" id="updatePostThumbnail" oninput="updatePostThumbnailPreview.src=window.URL.createObjectURL(this.files[0])">
                                <div class="image-uploads">
                                    <img src="{{ asset('assets/img/icons/upload.svg') }}" alt="img">
                                    <h4>Drag and drop a file to upload</h4>
                                </div>
                            </div>
                        </div>

                        <div class="product-list">
                            <ul class="row">
                                <li class="ps-0">
                                    <div class="productviewset">
                                        <div class="productviewsimg">
                                            <img src="{{ asset('assets/img/customer/profile2.jpg') }}" alt="img" id="updatePostThumbnailPreview">
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>

                        <div class="form-group">
                            <label>Description</label>
                            <textarea class="contentDetails" id="updatePostDescription"></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Publish Time</label>
                        <input class="form-control" type="datetime-local" id="updatePublishTime" onchange="toggleUpdatePostButton()">
                    </div>

                    <div class="form-group">
                        <label>Post Visibility</label>
                        <select class="select" id="updatePostStatus" onchange="toggleUpdatePostButton()">
                            <option value="published">Published</option>
                            <option value="scheduled">Scheduled</option>
                            <option value="unpublished">Unpublished</option>
                        </select>
                    </div>
                    
                    {{-- <input type="text" id="updatePostStatus"> --}}

                    <input type="text" id="userId">

                    <input type="text" id="postInfoId">
                </form>
            </div>
            <div class="modal-footer justify-content-end">
                <button type="button" id="updatePublishBtn" class="btn btn-submit" onclick="updatePostInfo()">Publish</button>
                <button type="button" id="updateScheduleBtn" class="btn btn-submit d-none" onclick="updatePostInfo()">Schedule</button>
                <button type="button" id="updatePostBtn" class="btn btn-submit d-none" onclick="updatePostInfo()">Save</button>
                <button type="button" class="btn btn-cancel" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
{{-- Edit modal end --}}


{{-- Front end script start --}}

<script>

    // Function for retrieve category information

    retrieveAllCategoryInfo();

    async function retrieveAllCategoryInfo(){

        try{
            // Getting data table
            let category_id = $('#updateCategoryId');

            // Pssing request to controller and getting response
            showLoader();
            let response = await axios.get('/retrieveAllCategoryInfo');
            hideLoader();

            response.data.data.forEach(function(item, index){
                let row = `<option value="${item['id']}">${item['category_name']}</option>`
                category_id.append(row);
            });
        } catch(e){
            console.error('Something went wrong', e);
        }
    }

    // Function for retrieve post details
    
    async function retrievePostInfoById(post_info_id){

        try{
            // Assigning id to hidden field
            document.getElementById('postInfoId').value = post_info_id;

            // Pssing id to controller and getting response
            showLoader();
            let response = await axios.post('../retrievePostInfoById', {post_info_id:post_info_id});
            hideLoader();

            if(response.data['status'] === 'success'){
                // Getting base URL of the system
                let baseUrl = "{{ url('/') }}";
                
                // Generating full path for the post thumbnail
                let postThumbnailFullPath = baseUrl + '/storage/post_thumbnails/' + response.data.data['post_thumbnail'];
            
                // Assigning retrieved values
                document.getElementById('updatePostHeading').value = response.data.data['post_heading'];
                document.getElementById('updatePostSlug').value = response.data.data['post_slug'];
                document.getElementById('updateCategoryId').value = response.data.data['category_id'];
                document.getElementById('updatePostThumbnailPreview').src = postThumbnailFullPath;
                tinymce.get('updatePostDescription').setContent(response.data.data['post_description']);
                document.getElementById('updatePostStatus').value = response.data.data['post_status'];
                document.getElementById('updatePublishTime').value = response.data.data['publish_time'];
                document.getElementById('userId').value = response.data.data['user_id'];
                console.log(response.data.data['post_status']);
            } else{
                displayToast('error', response.data['message']);
            }
        } catch(e){
            console.error('Something went wrong', e);
        }
    }


    // Function for toggle shedule and publish button
    
    function toggleUpdatePostButton(){
        const publishBtn = $('#updatePublishBtn');
        const scheduleBtn = $('#updateScheduleBtn');
        const updateBtn = $('#updatePostBtn');
        const postStatus = $('#updatePostStatus');
        const publishTimeInput = $('#updatePublishTime').val();
        const selectedTime = new Date(publishTimeInput);
        const currentTime = new Date();

        // Remove seconds and milliseconds for comparison
        selectedTime.setSeconds(0, 0);
        currentTime.setSeconds(0, 0);

        // console.log(selectedTime.getTime())
        // console.log(currentTime.getTime())
        // console.log(selectedTime.getTime() < currentTime.getTime())
        console.log(postStatus.val())
        console.log(publishTimeInput)
        
        // Compare the selected time with the current time
        if(postStatus.val() == "unpublished"){
            updateBtn.removeClass('d-none');
            publishBtn.addClass('d-none');
            scheduleBtn.addClass('d-none');
        } else{
            // Disable custom update button
            updateBtn.addClass('d-none');

            if(publishTimeInput && selectedTime.getTime() < currentTime.getTime() && postStatus.val() == "scheduled"){
                publishBtn.addClass('d-none');
                scheduleBtn.removeClass('d-none');
                scheduleBtn.addClass('disabled');
            } else if(publishTimeInput && selectedTime.getTime() < currentTime.getTime()){
                // publishBtn.addClass('disabled');
                publishBtn.removeClass('d-none');
                scheduleBtn.addClass('d-none');
                postStatus.val(postStatus.val());
            } else if (publishTimeInput && selectedTime.getTime() > currentTime.getTime()) {
                publishBtn.addClass('d-none');
                scheduleBtn.removeClass('d-none');
                scheduleBtn.removeClass('disabled');
                postStatus.val('scheduled');
            } else{
                publishBtn.removeClass('disabled');
                publishBtn.removeClass('d-none');
                scheduleBtn.addClass('d-none');
                postStatus.val('published');
            }
        }
    }

    // Update the publish time with the current time every second
    setInterval(togglePostButton, 1000);
    
    
    // Function for update blog post

    async function updatePostInfo(){
        try{
            // Getting input data
            let updated_heading = $('#updatePostHeading').val().trim();
            let post_slug = $('#updatePostSlug').val().trim();
            let category_id = $('#updateCategoryId').val().trim();
            let post_thumbnail = $('#updatePostThumbnail')[0].files[0];
            let post_description = tinymce.get('updatePostDescription').getContent().trim();
            let publish_time = $('#updatePublishTime').val().trim();
            let post_status = $('#updatePostStatus').val().trim();
            let post_info_id = $('#postInfoId').val().trim();
            let user_id = $('#userId').val().trim();

            console.log(updated_heading);
            
            // Front end validation process
            if(updated_heading.length === 0){
                displayToast('warning', 'Post heading is required');
            } else if(post_slug.length === 0){
                displayToast('warning', 'Post slug is required');
            } else if(category_id === ''){
                displayToast('warning', 'Post category is required');
            } else if(post_description.length === 0){
                displayToast('warning', 'Post details is required');
            } else{
                // Closing modal
                $('#editModal').modal('hide');

                // FormData object
                let formData = new FormData();

                // Data append to FormData
                formData.append('post_heading', updated_heading);
                formData.append('post_slug', post_slug);
                formData.append('category_id', category_id);
                if(post_thumbnail) formData.append('post_thumbnail', post_thumbnail);
                formData.append('post_description', post_description);
                formData.append('publish_time', publish_time);
                formData.append('post_status', post_status);
                formData.append('post_info_id', post_info_id);
                formData.append('user_id', user_id);

                // Pssing data to controller and getting response
                showLoader();
                let response = await axios.post('../updatePostInfo', formData, {
                    headers:{'content-type':'multipart/form-data'}
                });
                hideLoader();

                if(response.data['status'] === 'success'){
                    // Reset form
                    $('#updatePostForm')[0].reset();

                    // Call function to refresh post list
                    await retrieveAllPostInfo();

                    displayToast('success', response.data['message']);
                } else{
                    displayToast('error', response.data['message']);
                }
            }
        } catch(e){
            console.error('Something went wrong', e);
        }
    }


    // Function for publish schedule post
    
    async function publishSchedulePost(){
        const currentTime = new Date();

        // Remove seconds and milliseconds for comparison
        currentTime.setSeconds(0, 0);

        // Pssing data to controller and getting response
        let response = await axios.post('../publishSchedulePost', {'current_time' : currentTime});

        if(response.data['status'] === 'success'){
            // Call function to refresh post list
            await retrieveAllPostInfo();

            console.log(response.data['message']);
        } else{
            console.log(response.data['message']);
        }
    }

    // Call the function every second for tracking schedule posting
    setInterval(publishSchedulePost, 60000);
    
</script>

{{-- Front end script end --}}