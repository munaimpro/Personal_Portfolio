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
                        <input type="file" id="uploadHeroImage">
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
                        <input type="file" id="uploadAboutImage">
                        <div class="image-uploads">
                            <img src="{{ asset('assets/img/icons/upload.svg') }}" alt="img">
                            <h4>Drag and drop a file to upload</h4>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <button class="btn btn-submit me-2" id="updateAboutBtn">Update</button>
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
            timer: 2000,
            customClass: {
                popup: 'colored-toast'
            }
        });
    }

    // Fetching user data
    getAboutInfo();

    async function getAboutInfo() {
        showLoader();
        let response = await axios.get('../retriveAboutInfo');
        hideLoader();

        if(response.data['status'] === 'success'){
            // Getting base URL of the system
            let baseUrl = "{{ url('/') }}";

            // Hero image
            let heroImagePath = response.data.data['hero_image'];
            
            // Generating full path of the hero image
            let heroImageFullPath = baseUrl + '/storage/website_pictures/hero/' + heroImagePath;

            // About image
            let aboutImagePath = response.data.data['about_image'];

            // Generating full path of the about image
            let aboutImageFullPath = baseUrl + '/storage/website_pictures/about/' + aboutImagePath;

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
</script>

{{-- Front end script end --}}