{{-- Project details section start --}}
<section class="project_details_wrapper vertical_MK25_w_space">
    <div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-7 mb-5">
        <div class="project_image">
            <div class="owl-carousel owl-theme">
            <div class="item"><img src="{{ asset('assets/website/images/portfolio/portfolio1.webp') }}" alt="Project Image"></div>
            <div class="item"><img src="{{ asset('assets/website/images/portfolio/portfolio1.webp') }}" alt="Project Image"></div>
            <div class="item"><img src="{{ asset('assets/website/images/portfolio/portfolio1.webp') }}" alt="Project Image"></div>
            </div>
        </div>
        </div>
        <div class="col-lg-5">
        <div class="project_title mb-5">
            <h2 class="section_MK25_first_title text-start">Project Details</h2>
        </div>

        <div class="project_info mb-5">
            <p>
            <span class="fw-bold me-1">Project Type:</span>
            <span class="text-capitalize">e-commerce website</span>
            </p>
            <p>
            <span class="fw-bold me-1">Project Category:</span>
            <span class="text-capitalize">web design</span>
            </p>
            <p>
            <span class="fw-bold me-1">Client:</span>
            <span class="text-capitalize">jhon doe . marketing manager . hr group ltd</span>
            </p>
            <p>
            <span class="fw-bold me-1">Project Duration:</span>
            <span class="text-capitalize">March 2, 2024 - April 5, 2024</span>
            </p>
            <p>
            <span class="fw-bold me-1">Project URL:</span>
            <span class="text-lowercase"><a class="external_MK25_section_link p-0 fw-bold float-none" href="">www.web.com <i class="fas fa-external-link"></i></a></span>
            </p>
        </div>

        <div class="project_description">
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ex fugit vel doloribus consectetur odio maxime ipsa nisi cumque nesciunt placeat unde dolorem commodi eligendi, magnam ipsum delectus esse minus.</p>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nisi incidunt temporibus vero neque natus, sed recusandae! Ullam harum vel libero.</p>
        </div>
        </div>
    </div>
    </div>
</section>
{{-- Project details section end --}}


{{-- Front end script start --}}

<script>
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