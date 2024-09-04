{{-- Edit modal start --}}
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Update Project</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="updatePortfolioForm">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Title</label>
                            <input class="form-control" type="text" id="updateProjectTitle">
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Project Type</label>
                            <input class="form-control" type="text" id="updateProjectType">
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Category</label>
                            <select class="select" type="text" id="updateServiceId">
                                
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Starting Date</label>
                            <input class="form-control" type="date" id="updateProjectStartingDate">
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Ending Date</label>
                            <input class="form-control" type="date" id="updateProjectEndingDate" onchange="toggleUpdateProjectStatus()">
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>URL</label>
                            <input class="form-control" type="url" id="updateProjectUrl">
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Core Technologies</label>
                            <input class="form-control" type="text" id="updateProjectTechnology">
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Description</label>
                            <textarea class="contentDetails" id="updateProjectDescription"></textarea>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Thumbnail</label>
                            <div class="image-upload">
                                <input class="form-control" type="file" id="updateProjectThumbnail" oninput="updateProjectThumbnailPreview.src=window.URL.createObjectURL(this.files[0])">
                                <div class="image-uploads">
                                    <img src="{{ asset('assets/img/icons/upload.svg') }}" alt="img">
                                    <h4>Drag and drop a file to upload</h4>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="product-list">
                        <ul class="row">
                            <li class="ps-0">
                                <div class="productviewset">
                                    <div class="productviewsimg">
                                        <img src="{{ asset('assets/img/profiles/avater.png') }}" alt="img" id="updateProjectThumbnailPreview">
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>UI Image</label>
                            <div class="image-upload">
                                <input class="form-control" type="file" id="updateProjectUiImage" multiple>
                                <div class="image-uploads">
                                    <img src="{{ asset('assets/img/icons/upload.svg') }}" alt="img">
                                    <h4>Drag and drop a file to upload</h4>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Image Preview Container -->
                    <div class="col-12">
                        <div class="product-list">
                            <ul class="row" id="imagePreviewContainer">

                            </ul>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Portfolio Visibility</label>
                        <select class="select" id="updateProjectStatus" onchange="toggleUpdateProjectStatus()">
                            <option value="running">Running</option>
                            <option value="published">Published</option>
                        </select>
                    </div>

                    <h6 class="text-center mt-5 mb-1">Client Feedback</h6>

                    <div class="row">
                        <div id="clientFeedbackContent" class="d-none">
                            <div class="product-list">
                                <ul class="row justify-content-center">
                                    <li class="p-0">
                                        <div class="productviewset p-0">
                                            <div class="productviewsimg rounded-circle overflow-hidden m-auto" style="max-width: 120px; height: 120px;">
                                                <img class="h-100" src="{{ asset('assets/img/profiles/avater.png') }}" alt="client image" id="clientImage">
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
            
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>First Name</label>
                                    <input type="text" class="form-control" id="clientFirstName">
                                </div>
                            </div>
            
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Last Name</label>
                                    <input type="text" class="form-control" id="clientLastName">
                                </div>
                            </div>
            
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Designation</label>
                                    <input type="text" class="form-control" id="clientDesignation">
                                </div>
                            </div>
            
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Feedback</label>
                                    <textarea class="form-control" id="clientFeedback"></textarea>
                                </div>
                            </div>
            
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Date</label>
                                    <input type="text" class="form-control" id="clientFeedbackDate">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="justify-content-end mt-2">
                        <button type="button" class="btn btn-submit" id="feedbackButton" style="padding:12px;" onclick="generateFeedbackUrl()">Get Feedback</button>
                    </div>

                    <input type="number" class="d-none" id="portfolioInfoId">
                </form>
            </div>
            <div class="modal-footer justify-content-end">
                <button type="button" class="btn btn-submit" onclick="updatePortfolioInfo()">Save</button>
                <button type="button" class="btn btn-cancel" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
{{-- Edit modal end --}}


{{-- Front end script start --}}

<script>

    // Function for retrieve category(service) information

    retrieveAllServiceInfo();

    async function retrieveAllServiceInfo(){

        try{
            // Getting input field
            let update_service_id = $('#updateServiceId');

            // Pssing request to controller and getting response
            showLoader();
            let response = await axios.get('/retrieveAllServiceInfo');
            hideLoader();

            response.data.data.forEach(function(item, index){
                let row = `<option value="${item['id']}">${item['service_title']}</option>`
                update_service_id.append(row);
            });
        } catch(e){
            console.error('Something went wrong', e);
        }
    }


    // Function for retrieve post details

    async function retrievePortfolioInfoById(portfolio_info_id){
        try {
            // Assigning id to hidden field
            $('#portfolioInfoId').val(portfolio_info_id);

            // Sending id to controller and getting response
            showLoader();
            let response = await axios.post('../retrievePortfolioInfoById', { portfolio_info_id: portfolio_info_id });
            hideLoader();

            if (response.data['status'] === 'success'){

                // console.log(response.data.data['client_feedback'].length > 0);

                // Getting base URL of the system
                let baseUrl = "{{ url('/') }}";
                
                // Generating full path for the project thumbnail
                let projectThumbnailFullPath = baseUrl + '/storage/portfolio/thumbnails/' + response.data.data['project_thumbnail'];
            
                // Assigning retrieved values
                $('#updateProjectTitle').val(response.data.data['project_title']);
                $('#updateProjectType').val(response.data.data['project_type']);
                $('#updateProjectStartingDate').val(response.data.data['project_starting_date']);
                $('#updateProjectEndingDate').val(response.data.data['project_ending_date']);
                $('#updateProjectThumbnailPreview')[0].src = projectThumbnailFullPath;
                getUiImagePreview(JSON.parse(response.data.data['project_ui_image']));
                $('#updateServiceId').val(response.data.data['service_id']);
                tinymce.get('updateProjectDescription').setContent(response.data.data['project_description']);
                $('#updateProjectUrl').val(response.data.data['project_url']);
                $('#updateProjectTechnology').val(response.data.data['core_technology']);
                $('#updateProjectStatus').val(response.data.data['project_status']);
                $('#portfolioTestData').val(response.data.data['client_feedback'][0]['client_first_name']);

                if(response.data.data['client_feedback'].length > 0){
                    // Showing client feedback content
                    $('#clientFeedbackContent').removeClass('d-none');

                    // Hiding client feedback button
                    $('#feedbackButton').addClass('d-none');

                    // Generating full path for the client image
                    let clientImageFullPath = baseUrl + '/storage/profile_picture/client_images/' + response.data.data['client_feedback'][0]['client_image'];

                    // Formatting the client feedback date
                    let feedbackDate = new Date(response.data.data['client_feedback'][0]['created_at']);
                    let formattedFeedbackDate = feedbackDate.toLocaleDateString('en-US', {
                        year: 'numeric',
                        month: 'long',
                        day: 'numeric',
                        hour: '2-digit',
                        minute: '2-digit',
                    });

                    $('#clientImage')[0].src = clientImageFullPath;
                    $('#clientFirstName').val(response.data.data['client_feedback'][0]['client_first_name']);
                    $('#clientLastName').val(response.data.data['client_feedback'][0]['client_last_name']);
                    $('#clientDesignation').val(response.data.data['client_feedback'][0]['client_designation']);
                    $('#clientFeedback').val(response.data.data['client_feedback'][0]['client_feedback']);
                    $('#clientFeedbackDate').val(formattedFeedbackDate);
                }
            } else{
                displayToast('error', response.data['message']);
            }
        } catch (e){
            console.error('Something went wrong', e);
        }
    }

    
    // Function for UI image preview

    function getUiImagePreview(uiImages){
        const previewContainer = document.getElementById('imagePreviewContainer');
        previewContainer.innerHTML = ''; // Clear any existing previews

        uiImages.forEach((image, index) => {
            const li = document.createElement('li');
            li.classList.add('ps-0');

            const divSet = document.createElement('div');
            divSet.classList.add('productviewset');

            const divImg = document.createElement('div');
            divImg.classList.add('productviewsimg');

            const img = document.createElement('img');
            img.src = `/storage/portfolio/ui_images/${image}`;
            img.alt = "img";
            img.id = `projectUIPreview-${index}`;

            const divContent = document.createElement('div');
            divContent.classList.add('productviewscontent');

            const a = document.createElement('a');
            a.classList.add('hideset');
            a.dataset.imageName = image
            a.innerHTML = '<i class="fa fa-trash-alt"></i>';
            a.onclick = function() {
                removeUiImage(image);
            };

            divImg.appendChild(img);
            divSet.appendChild(divImg);
            divContent.appendChild(a);
            divSet.appendChild(divContent);
            li.appendChild(divSet);
            previewContainer.appendChild(li);
        });
    }


    // Function for remove UI image 

    async function removeUiImage(imageName){
        try {
            // Get portfolio ID
            let portfolio_info_id = $('#portfolioInfoId').val();

            // Send request to server to remove image from JSON
            showLoader();
            let response = await axios.delete('../removePortfolioUiImage', {data: {
                portfolio_info_id: portfolio_info_id,
                ui_image_name: imageName
            } });
            hideLoader();

            if (response.data.status === 'success') {
                // Re-fetch portfolio info to refresh the UI images preview
                await retrievePortfolioInfoById(portfolio_info_id);
                displayToast('success', response.data.message);
            } else {
                displayToast('error', response.data.message);
            }
        } catch (error) {
            console.error('Something went wrong', error);
        }
    }


    // Function for toggle portfolio status
        
    function toggleUpdateProjectStatus(){
        const updateProjectStatus = $('#updateProjectStatus');
        const updateEndingDateInput = $('#updateProjectEndingDate').val();
        const updateSelectedDate = new Date(updateEndingDateInput);
        const updateCurrentDate = new Date();

        // Remove seconds and milliseconds for comparison
        // selectedTime.setSeconds(0, 0);
        // currentTime.setSeconds(0, 0);

        console.log(updateSelectedDate.getDate())
        console.log(updateCurrentDate.getDate())
        console.log(updateSelectedDate.getDate() < updateCurrentDate.getDate())
        
        // Compare the selected date with the current date
        if(updateEndingDateInput && updateSelectedDate.getDate() < updateCurrentDate.getDate()){
            updateProjectStatus.val('published');
        } else if (updateEndingDateInput && updateSelectedDate.getDate() > updateCurrentDate.getDate()) {
            updateProjectStatus.val('running');
        } else if (!updateEndingDateInput) {
            updateProjectStatus.val('running');
        }
    }
    
    
    // Function for update portfolio

    async function updatePortfolioInfo(){
        try{
            // Getting input data
            let project_title = $('#updateProjectTitle').val().trim();
            let project_type = $('#updateProjectType').val().trim();
            let project_starting_date = $('#updateProjectStartingDate').val().trim();
            let project_ending_date = $('#updateProjectEndingDate').val().trim();
            let project_thumbnail = $('#updateProjectThumbnail')[0].files[0];
            let project_ui_image = $('#updateProjectUiImage')[0].files;
            let service_id = $('#updateServiceId').val().trim();
            let project_description = tinymce.get('updateProjectDescription').getContent().trim();
            let project_url = $('#updateProjectUrl').val().trim();
            let project_technology = $('#updateProjectTechnology').val().trim();
            let project_status = $('#updateProjectStatus').val().trim();
            let portfolio_info_id = $('#portfolioInfoId').val().trim();

            // Front-end validation process
            if (project_title.length === 0){
                displayToast('warning', 'Project title is required');
            } else if (project_type.length === 0){
                displayToast('warning', 'Project type is required');
            } else if (service_id === '') {
                displayToast('warning', 'Service ID is required');
            } else if (project_starting_date === ''){
                displayToast('warning', 'Project starting date is required');
            } else if (project_ending_date != '' && project_starting_date > project_ending_date) {
                displayToast('warning', 'Invalid ending date');
            } else if (project_url.length === 0){
                displayToast('warning', 'Project URL is required');
            } else if (project_technology.length === 0){
                displayToast('warning', 'Project technology is required');
            } else if (project_description.length === 0){
                displayToast('warning', 'Project description is required');
            } else{
                // Closing modal
                $('#editModal').modal('hide');

                // FormData object
                let formData = new FormData();

                // Append data to FormData
                formData.append('project_title', project_title);
                formData.append('project_type', project_type);
                formData.append('project_starting_date', project_starting_date);
                formData.append('project_ending_date', project_ending_date);
                if(project_thumbnail) formData.append('project_thumbnail', project_thumbnail);
                if(project_ui_image)
                    for (let i = 0; i < project_ui_image.length; i++){
                        formData.append('project_ui_image[]', project_ui_image[i]);
                    }
                formData.append('service_id', service_id);
                formData.append('project_description', project_description);
                formData.append('project_url', project_url);
                formData.append('core_technology', project_technology);
                formData.append('project_status', project_status);
                formData.append('portfolio_info_id', portfolio_info_id);

                // Sending data to the controller and getting response
                showLoader();
                let response = await axios.post('/updatePortfolioInfo', formData, {
                    headers: {'Content-Type': 'multipart/form-data'}
                });
                hideLoader();

                if (response.data['status'] === 'success') {
                    // Reset form
                    $('#updatePortfolioForm')[0].reset();

                    // Call function to refresh the portfolio list (if applicable)
                    await retrieveAllPortfolioInfo();

                    displayToast('success', response.data['message']);
                } else {
                    displayToast('error', response.data['message']);
                }
            }
        } catch (e) {
            console.error('Something went wrong', e);
        }
    }


    // Function for generate feedback URL

    async function generateFeedbackUrl(){
        // Getting portfolio id
        let portfolio_info_id = $('#portfolioInfoId').val();
    
        // Passing data to controller and getting response
        showLoader();
        let response = await axios.post('/generateFeedbackUrl', { portfolio_info_id: portfolio_info_id });
        hideLoader();

        if (response.data['status'] === 'success'){
            // Closing modal
            $('#editModal').modal('hide');

            // Redirect to the generated feedback URL
            window.location.href = '../feedback/'+response.data.cache;

            displayToast('success', response.data['message']);
        } else {
            displayToast('error', response.data['message']);
        }
    }

</script>

{{-- Front end script end --}}