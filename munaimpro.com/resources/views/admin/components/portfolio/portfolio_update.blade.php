{{-- Edit modal start --}}
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Update Project</h5>
            </div>
            <div class="modal-body">
                <form id="addPortfolioForm">
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
                            <input class="form-control" type="date" id="updateProjectEndingDate" onchange="toggleProjectStatus()">
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
                        <select class="form-control" id="updateProjectStatus" onchange="toggleProjectStatus()">
                            <option value="running">Running</option>
                            <option value="published">Published</option>
                        </select>
                    </div>
                    

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Client Name</label>
                            <input class="form-control" type="text" id="updateClientName">
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Client Designation</label>
                            <input class="form-control" type="text" id="updateClientDesignation">
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Client Institution</label>
                            <input class="form-control" type="text" id="updateClientInstitution">
                        </div>
                    </div>

                    <input type="text" id="portfolioInfoId">
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

    // Function for retrive category(service) information

    retriveAllServiceInfo();

    async function retriveAllServiceInfo(){

        try{
            // Getting input field
            let update_service_id = $('#updateServiceId');

            // Pssing request to controller and getting response
            showLoader();
            let response = await axios.get('/retriveAllServiceInfo');
            hideLoader();

            response.data.data.forEach(function(item, index){
                let row = `<option value="${item['id']}">${item['service_title']}</option>`
                update_service_id.append(row);
            });
        } catch(e){
            console.error('Something went wrong', e);
        }
    }


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
                $('#updateClientInstitution').val(response.data.data['client_institution']);
            } else{
                displayToast('error', response.data['message']);
            }
        } catch(e){
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
            console.log(portfolio_info_id);

            // Send request to server to remove image from JSON
            showLoader();
            let response = await axios.delete('../removePortfolioUiImage', {data: {
                portfolio_info_id: portfolio_info_id,
                ui_image_name: imageName
            } });
            hideLoader();

            if (response.data.status === 'success') {
                // Re-fetch portfolio info to refresh the UI images preview
                await retrivePortfolioInfoById(portfolio_info_id);
                displayToast('success', response.data.message);
            } else {
                displayToast('error', response.data.message);
            }
        } catch (error) {
            console.error('Something went wrong', error);
        }
    }


    // Function for toggle portfolio status
        
    function toggleProjectStatus(){
        const updateProjectStatus = $('#updateProjectStatus');
        const updateEndingDateInput = $('#updateProjectEndingDate').val();
        const updateSelectedDate = new Date(updateEndingDateInput);
        const updateCurrentDate = new Date();

        // Remove seconds and milliseconds for comparison
        // selectedTime.setSeconds(0, 0);
        // currentTime.setSeconds(0, 0);

        console.log(updateSelectedDate.getDate())
        console.log(updateCurrentDate.getDate())
        console.log(selectedDate.getDate() < updateCurrentDate.getDate())
        
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
            let project_title = $('#projectTitle').val().trim();
            let project_type = $('#projectType').val().trim();
            let project_starting_date = $('#projectStartingDate').val().trim();
            let project_ending_date = $('#projectEndingDate').val().trim();
            let project_thumbnail = $('#projectThumbnail')[0].files[0];
            let project_ui_image = $('#projectUiImage')[0].files;
            let service_id = $('#serviceId').val().trim();
            let project_description = tinymce.get('projectDescription').getContent().trim();
            let project_url = $('#projectUrl').val().trim();
            let project_technology = $('#projectTechnology').val().trim();
            let project_status = $('#projectStatus').val().trim();
            let client_name = $('#clientName').val().trim();
            let client_designation = $('#clientDesignation').val().trim();
            let client_institution = $('#clientInstitution').val().trim();

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
            } else if (!project_thumbnail) {
                displayToast('warning', 'Project thumbnail is required');
            } else if (project_ui_image.length === 0) {
                displayToast('warning', 'At least one UI image is required');
            } else if (client_name.length === 0) {
                displayToast('warning', 'Client name is required');
            } else if (client_designation.length === 0) {
                displayToast('warning', 'Client designation is required');
            } else if (client_institution.length === 0) {
                displayToast('warning', 'Client institution is required');
            } else {
                // Closing modal
                $('#createModal').modal('hide');

                // FormData object
                let formData = new FormData();

                // Append data to FormData
                formData.append('project_title', project_title);
                formData.append('project_type', project_type);
                formData.append('project_starting_date', project_starting_date);
                formData.append('project_ending_date', project_ending_date);
                formData.append('project_thumbnail', project_thumbnail);
                for (let i = 0; i < project_ui_image.length; i++) {
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

                // Sending data to the controller and getting response
                showLoader();
                let response = await axios.post('/addPortfolioInfo', formData, {
                    headers: {'Content-Type': 'multipart/form-data'}
                });
                hideLoader();

                if (response.data['status'] === 'success') {
                    // Reset form
                    $('#addPortfolioForm')[0].reset();

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