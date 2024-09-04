{{-- Create modal start --}}
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Add Project</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addPortfolioForm">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Title</label>
                            <input class="form-control" type="text" id="projectTitle">
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Project Type</label>
                            <input class="form-control" type="text" id="projectType">
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Category</label>
                            <select class="select" type="text" id="serviceId">
                                
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Starting Date</label>
                            <input class="form-control" type="date" id="projectStartingDate">
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Ending Date</label>
                            <input class="form-control" type="date" id="projectEndingDate" onchange="toggleProjectStatus()">
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>URL</label>
                            <input class="form-control" type="url" id="projectUrl">
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Core Technologies</label>
                            <input class="form-control" type="text" id="projectTechnology">
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Description</label>
                            <textarea class="contentDetails" id="projectDescription"></textarea>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Thumbnail</label>
                            <div class="image-upload">
                                <input class="form-control" type="file" id="projectThumbnail" oninput="projectThumbnailPreview.src=window.URL.createObjectURL(this.files[0])">
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
                                        <img src="{{ asset('assets/img/customer/profile2.jpg') }}" alt="img" id="projectThumbnailPreview">
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>UI Image</label>
                            <div class="image-upload">
                                <input class="form-control" type="file" id="projectUiImage" onchange="getUiImagePreview(event)" multiple>
                                <div class="image-uploads">
                                    <img src="{{ asset('assets/img/icons/upload.svg') }}" alt="img">
                                    <h4>Drag and drop a file to upload</h4>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Portfolio Visibility</label>
                        <select class="select" id="projectStatus" onchange="toggleProjectStatus()">
                            <option value="running">Running</option>
                            <option value="published">Published</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-end">
                <button type="button" class="btn btn-submit" onclick="addPortfolioInfo()">Add</button>
                <button type="button" class="btn btn-cancel" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
{{-- Create modal end --}}


{{-- Front end script start --}}

<script>

    // Function for retrieve category(service) information

    retrieveAllServiceInfo();

    async function retrieveAllServiceInfo(){

        try{
            // Getting input field
            let service_id = $('#serviceId');

            // Pssing request to controller and getting response
            showLoader();
            let response = await axios.get('/retrieveAllServiceInfo');
            hideLoader();

            response.data.data.forEach(function(item, index){
                let row = `<option value="${item['id']}">${item['service_title']}</option>`
                service_id.append(row);
            });
        } catch(e){
            console.error('Something went wrong', e);
        }
    }


    // Function for toggle portfolio status
        
    function toggleProjectStatus(){
        const projectStatus = $('#projectStatus');
        const endingDateInput = $('#projectEndingDate').val();
        const selectedDate = new Date(endingDateInput);
        const currentDate = new Date();

        // Remove seconds and milliseconds for comparison
        // selectedTime.setSeconds(0, 0);
        // currentTime.setSeconds(0, 0);

        console.log(selectedDate.getDate())
        console.log(currentDate.getDate())
        console.log(selectedDate.getDate() < currentDate.getDate())
        
        // Compare the selected date with the current date
        if(endingDateInput && selectedDate.getDate() < currentDate.getDate()){
            projectStatus.val('published');
        } else if (endingDateInput && selectedDate.getDate() > currentDate.getDate()) {
            projectStatus.val('running');
        } else if (!endingDateInput) {
            projectStatus.val('running');
        }
    }
    
    
    // Function for add portfolio

    async function addPortfolioInfo(){
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

            // Front-end validation process
            if (project_title.length === 0){
                displayToast('warning', 'Project title is required');
            } else if (project_type.length === 0){
                displayToast('warning', 'Project type is required');
            } else if (service_id === ''){
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
            } else if (!project_thumbnail){
                displayToast('warning', 'Project thumbnail is required');
            } else if (project_ui_image.length === 0){
                displayToast('warning', 'At least one UI image is required');
            } else{
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


</script>

{{-- Front end script end --}}