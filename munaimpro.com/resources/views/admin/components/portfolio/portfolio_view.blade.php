{{-- Edit modal start --}}
<div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Project Details</h5>
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
                            <select class="form-control" type="text" id="updateServiceId">
                                
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
                                        <img src="{{ asset('assets/img/customer/profile2.jpg') }}" alt="img" id="updateProjectThumbnailPreview">
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
                        <input type="text" class="form-control" id="viewPortfolioVisibility">
                    </div>

                    <h6 class="text-center mt-5 mb-1">Client Feedback</h6>

                    <div class="product-list">
                        <ul class="row justify-content-center">
                            <li class="p-0">
                                <div class="productviewset p-0">
                                    <div class="productviewsimg rounded-circle overflow-hidden m-auto" style="max-width: 120px; height: 120px;">
                                        <img class="h-100" src="{{ asset('assets/img/customer/profile2.jpg') }}" alt="img" id="clientImage">
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

                    <input type="text" id="portfolioInfoId">
                </form>
            </div>
            <div class="modal-footer justify-content-end">
                <button type="button" class="btn btn-submit" data-bs-dismiss="modal">Ok</button>
                <button type="button" class="btn btn-cancel" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
{{-- Edit modal end --}}



{{-- Front end script start --}}

<script>

    // Function for retrive post details

    async function retrivePortfolioInfoById(portfolio_info_id){

        try{
            // Assigning id to hidden field
            document.getElementById('portfolioInfoId').value = portfolio_info_id;

            // Pssing id to controller and getting response
            showLoader();
            let response = await axios.post('../retrivePortfolioInfoById', {portfolio_info_id:portfolio_info_id});
            hideLoader();

            if(response.data['status'] === 'success'){
                // Getting base URL of the system
                let baseUrl = "{{ url('/') }}";
                
                // Generating full path for the project thumbnail
                let projectThumbnailFullPath = baseUrl + '/storage/portfolio/thumbnails/' + response.data.data['project_thumbnail'];
            
                // Assigning retrived values
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
                $('#updateClientName').val(response.data.data['client_name']);
                $('#updateClientDesignation').val(response.data.data['client_designation']);
            } else{
                displayToast('error', response.data['message']);
            }
        } catch(e){
            console.error('Something went wrong', e);
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
            let client_name = $('#updateClientName').val().trim();
            let client_designation = $('#updateClientDesignation').val().trim();
            let client_institution = $('#updateClientInstitution').val().trim();
            let portfolio_info_id = $('#portfolioInfoId').val().trim();

            // Front-end validation process
            if (project_title.length === 0) {
                displayToast('warning', 'Project title is required');
            } else if (project_type.length === 0) {
                displayToast('warning', 'Project type is required');
            } else if (service_id === '') {
                displayToast('warning', 'Service ID is required');
            } else if (project_starting_date === '') {
                displayToast('warning', 'Project starting date is required');
            } else if (project_ending_date != '' && project_starting_date > project_ending_date) {
                displayToast('warning', 'Invalid ending date');
            } else if (project_url.length === 0) {
                displayToast('warning', 'Project URL is required');
            } else if (project_technology.length === 0) {
                displayToast('warning', 'Project technology is required');
            } else if (project_description.length === 0) {
                displayToast('warning', 'Project description is required');
            } else if (client_name.length === 0) {
                displayToast('warning', 'Client name is required');
            } else if (client_designation.length === 0) {
                displayToast('warning', 'Client designation is required');
            } else if (client_institution.length === 0) {
                displayToast('warning', 'Client institution is required');
            } else {
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
                formData.append('client_name', client_name);
                formData.append('client_designation', client_designation);
                formData.append('client_institution', client_institution);
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
                    await retriveAllPortfolioInfo();

                    displayToast('success', response.data['message']);
                } else {
                    displayToast('error', response.data['message']);
                }
            }
        } catch (e) {
            console.error('Something went wrong', e);
        }
    }


</script>

{{-- Front end script end --}}