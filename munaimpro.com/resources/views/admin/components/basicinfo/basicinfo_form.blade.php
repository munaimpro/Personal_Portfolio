{{-- Page header - About start --}}
<div class="page-header">
    <div class="page-title">
        <h4>Basic Information</h4>
        <h6>Used for hero section and contact information</h6>
    </div>
</div>
{{-- Page header - About end --}}

{{-- About form start --}}
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-lg-6 col-sm-6 col-12">
                <div class="form-group">
                    <label>Greetings</label>
                    <input type="text" spellcheck="false" data-ms-editor="true" id="websiteGreetings">
                </div>
            </div>

            <div class="col-lg-6 col-sm-6 col-12">
                <div class="form-group">
                    <label>Full Name</label>
                    <input type="text" spellcheck="false" data-ms-editor="true" id="websiteFullName">
                </div>
            </div>

            <div class="col-lg-6 col-sm-6 col-12">
                <div class="form-group">
                    <label>Designation</label>
                    <input type="text" spellcheck="false" data-ms-editor="true" id="websiteDesignation">
                </div>
            </div>

            <div class="col-lg-6 col-sm-6 col-12">
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control" spellcheck="false" data-ms-editor="true" id="websiteEmail">
                </div>
            </div>

            <div class="col-lg-6 col-sm-6 col-12">
                <div class="form-group">
                    <label>Phone</label>
                    <input type="phone" class="form-control" spellcheck="false" data-ms-editor="true" id="websitePhone">
                </div>
            </div>

            <div class="col-lg-6 col-sm-6 col-12">
                <div class="form-group">
                    <label>Location</label>
                    <textarea class="form-control" spellcheck="false" data-ms-editor="true" id="websiteLocation"></textarea>
                </div>
            </div>

            <div class="col-lg-12 col-sm-6 col-12">
                <div class="form-group">
                    <label>Hero Description</label>
                    <textarea class="form-control" spellcheck="false" data-ms-editor="true" id="websiteHeroDescription"></textarea>
                </div>
            </div>

            <div class="col-lg-12 col-sm-12 col-12">
                <div class="form-group">
                    <label>Hero Image</label>
                    <div class="product-list">
                        <ul>
                            <li class="p-0">
                                <div class="productviews">
                                    <div class="productviewsimg">
                                        <img class="mw-100 mh-100" src="{{ asset('assets/img/profiles/avatar-17.jpg') }}" alt="website logo" id="websiteHeroImage">
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <div class="image-upload ">
                        <input type="file" id="uploadHeroImage" oninput="websiteHeroImage.src=window.URL.createObjectURL(this.files[0])">
                        <div class="image-uploads">
                            <img src="{{ asset('assets/img/icons/upload.svg') }}" alt="img">
                            <h4>Drag and drop a file to upload</h4>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-12 col-sm-6 col-12">
                <div class="form-group">
                    <label>About Description</label>
                    <textarea class="form-control" spellcheck="false" data-ms-editor="true" id="websiteAboutDescription"></textarea>
                </div>
            </div>

            <div class="col-lg-12 col-sm-12 col-12">
                <div class="form-group">
                    <label>About Image</label>
                    <div class="product-list">
                        <ul>
                            <li class="p-0">
                                <div class="productviews">
                                    <div class="productviewsimg">
                                        <img class="mw-100 mh-100" src="{{ asset('assets/img/profiles/avatar-17.jpg') }}" alt="website logo" id="websiteAboutImage">
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <div class="image-upload ">
                        <input type="file" id="uploadAboutImage" oninput="websiteAboutImage.src=window.URL.createObjectURL(this.files[0])">
                        <div class="image-uploads">
                            <img src="{{ asset('assets/img/icons/upload.svg') }}" alt="img">
                            <h4>Drag and drop a file to upload</h4>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <button class="btn btn-submit me-2" onclick="updateAboutInfo()">Update</button>
                <button class="btn btn-cancel" id="cancelAboutBtn">Cancel</button>
            </div>
        </div>
    </div>
</div>
{{-- About form end --}}


{{-- Front end script start --}}

<script>

    // Function for toast message common features
    function displayToast(icon, title){
        Swal.fire({
            toast: true,
            position: 'top-end',
            icon: icon,
            iconColor: 'white',
            title: title,
            showConfirmButton: false,
            timer: 60000,
            customClass: {
                popup: 'colored-toast'
            }
        });
    }

    // Function for retriving about information
    getAboutInfo();

    async function getAboutInfo() {
        showLoader();
        let response = await axios.get('../retriveAboutInfo');
        hideLoader();

        if(response.data['status'] === 'success'){
            // Getting base URL of the system
            let baseUrl = "{{ url('/') }}";
            
            // Generating full path for the hero image
            let heroImageFullPath = baseUrl + '/storage/website_pictures/hero/' + response.data.data['hero_image'];

            // Generating full path for the about image
            let aboutImageFullPath = baseUrl + '/storage/website_pictures/about/' + response.data.data['about_image'];

            document.getElementById('websiteGreetings').value = response.data.data['greetings'];
            document.getElementById('websiteFullName').value = response.data.data['full_name'];
            document.getElementById('websiteDesignation').value = response.data.data['designation'];
            document.getElementById('websiteHeroDescription').value = response.data.data['hero_description'];
            document.getElementById('websiteHeroImage').src = heroImageFullPath;
            document.getElementById('websiteAboutDescription').value = response.data.data['about_description'];
            document.getElementById('websiteAboutImage').src = aboutImageFullPath;
        } else{
            displayToast('error', response.data['message']);
        }
    }

    // Function for update about information
    async function updateAboutInfo(){

        try{
            // Getting input data
            let website_greetings = $('#websiteGreetings').val().trim();
            let website_full_name = $('#websiteFullName').val().trim();
            let website_designation = $('#websiteDesignation').val().trim();
            let website_hero_description = $('#websiteHeroDescription').val().trim();
            let upload_hero_image = document.getElementById('uploadHeroImage').files[0];
            let website_about_description = $('#websiteAboutDescription').val().trim();
            let upload_about_image = document.getElementById('uploadAboutImage').files[0];
            let website_resume_link = "Link here";

            // Front end validation process
            if(website_greetings.length === 0){
                displayToast('warning', 'Greetings text is required');
            } else if(website_full_name.length === 0){
                displayToast('warning', 'Full name is required');
            } else if(website_designation.length === 0){
                displayToast('warning', 'Designation is required');
            } else if(website_hero_description.length === 0){
                displayToast('warning', 'Hero description is required');
            } else if(website_about_description.length === 0){
                displayToast('warning', 'About description is required');
            } else{
                // FormData object
                let formData = new FormData();

                // Data append to FormData
                formData.append('greetings', website_greetings);
                formData.append('full_name', website_full_name);
                formData.append('designation', website_designation);
                formData.append('hero_description', website_hero_description);
                if(upload_hero_image) formData.append('hero_image', upload_hero_image);
                formData.append('about_description', website_about_description);
                if(upload_about_image) formData.append('about_image', upload_about_image);
                formData.append('resume_link', website_resume_link);

                // Pssing data to controller and getting response
                showLoader();
                let response = await axios.post('../updateAboutInfo', formData, {
                    headers:{'content-type':'multipart/form-data'}
                });
                hideLoader();

                if(response.data['status'] === 'success'){
                    getAboutInfo();
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