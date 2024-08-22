{{-- Page header - Website Logo start --}}

<div class="page-header">
    <div class="page-title">
        <h4>Website Logo</h4>
        <h6>Used as website and admin panel logo</h6>
    </div>
</div>

{{-- Page header - Website Logo end --}}

{{-- Logo section start --}}
<div class="card">
    <div class="card-body">
        <div class="row">
            <form id="websiteLogoForm">
                @method('PUT')
                <div class="col-lg-12 col-sm-6 col-12">
                    <div class="form-group">
                        <label>Logo</label>
                        <div class="product-list">
                            <ul>
                                <li class="p-0">
                                    <div class="productviews">
                                        <div class="productviewsimg">
                                            <img class="mw-100 mh-100" src="{{ asset('assets/img/logo.png') }}" alt="website logo" id="websiteLogoPreview">
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>

                        <div class="image-upload ">
                            <input type="file" id="websiteLogo" oninput="websiteLogoPreview.src=window.URL.createObjectURL(this.files[0])">
                            <div class="image-uploads">
                                <img src="{{ asset('assets/img/icons/upload.svg') }}" alt="img">
                                <h4>Drag and drop a file to upload</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        <div class="col-lg-12">
            <button class="btn btn-submit me-2" onclick="updateLogoInfo()">Upload</button>
            <button class="btn btn-cancel">Cancel</button>
        </div>
        </div>
    </div>
</div>
{{-- Logo section end --}}


{{-- Front end script start --}}

<script>

    // Function for retrive website logo

    async function retrieveLogoInfo(seoproperty_info_id){

        try{
            // Assigning id to hidden field
            $('#seoPropertyInfoId').val(seoproperty_info_id);

            // Pssing id to controller and getting response
            showLoader();
            let response = await axios.post('/retrieveSeoPropertyInfoById', {seoproperty_info_id:seoproperty_info_id});
            hideLoader();

            if(response.data['status'] === 'success'){
                // Getting base URL of the system
                let baseUrl = "{{ url('/') }}";
                
                // Generating full path for the open graph website image
                let ogSiteImageFullPath = baseUrl + '/storage/website_pictures/website_social_images/' + response.data.data['og_image'];
                
                // Generating full path for the og site image
                let twitterImageFullPath = baseUrl + '/storage/website_pictures/website_social_images/' + response.data.data['twitter_image'];

                $('#siteTitle').val(response.data.data['site_title']);
                $('#siteKeywords').val(response.data.data['site_keywords']);
                $('#siteDescription').val(response.data.data['site_description']);
                $('#siteAuthor').val(response.data.data['author']);
                $('#ogSiteName').val(response.data.data['og_site_name']);
                $('#ogSiteTitle').val(response.data.data['og_title']);
                $('#ogSiteURL').val(response.data.data['og_url']);
                $('#ogSiteType').val(response.data.data['og_type']);
                $('#ogSiteDescription').val(response.data.data['og_description']);
                $('#ogSiteImagePreview')[0].src = ogSiteImageFullPath;
                $('#twitterCard').val(response.data.data['twitter_card']);
                $('#twitterTitle').val(response.data.data['twitter_title']);
                $('#twitterDescription').val(response.data.data['twitter_description']);
                $('#twitterImagePreview')[0].src = twitterImageFullPath;
                $('#robots').val(response.data.data['robots']);
                $('#canonicalUrl').val(response.data.data['canonical_url']);
                $('#applicationName').val(response.data.data['application_name']);
                $('#themeColor').val(response.data.data['theme_color']);
                $('#googleSiteVerification').val(response.data.data['google_site_verification']);
                $('#referrerPolicy').val(response.data.data['referrer']);
            } else{
                displayToast('error', response.data['message']);
            }
        } catch(e){
            console.error('Something went wrong', e);
        }
    }


    // Function for update website logo

    async function updateLogoInfo(){

        try{
            // Getting input data
            let website_logo = $('#websiteLogo')[0].files[0];
            console.log(website_logo);

            // Front end validation process
            if(!website_logo){
                displayToast('warning', 'Website logo is required');
            } else{
                // Reset form
                $('#websiteLogoForm')[0].reset();

                // FormData object
                let formData = new FormData();

                formData.append('logo', website_logo);

                // Passing data to controller and getting response
                showLoader();
                let response = await axios.post('/updateLogoInfo', formData, {
                    headers: {'content-type': 'multipart/form-data'}
                });
                hideLoader();

                if(response.data['status'] === 'success'){
                    // Reset form
                    $('#updateSEOPropertyForm')[0].reset();

                    // Refresh the logo
                    // retrieveLogoInfo();

                    displayToast('success', response.data['message']);
                } else {
                    displayToast('error', response.data['message']);
                }
            }
        } catch(e){
            console.error('Something went wrong', e);
        }
    }
</script>

{{-- Front end script end --}}