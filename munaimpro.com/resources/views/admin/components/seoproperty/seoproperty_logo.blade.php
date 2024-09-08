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
                                            <img class="mw-100 mh-100" src="" alt="website logo" id="websiteLogoPreview">
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
                    retrieveLogoInfo();

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