{{-- Edit modal start --}}
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">SEO Properties</h5>
            </div>
            <div class="modal-body">
                <form id="update-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">
                                <div class="form-group">
                                    <label class="form-label">Website Title *</label>
                                    <input type="text" class="form-control" id="siteTitle">
                                </div>

                                <div class="form-group">
                                    <label class="form-label mt-3">Website Keywords *</label>
                                    <input type="text" class="form-control" id="siteKeywords">
                                </div>

                                <div class="form-group">
                                    <label class="form-label mt-3">Website Description *</label>
                                    <textarea class="form-control" id="siteDescription"></textarea>
                                </div>

                                <div class="form-group">
                                    <label class="form-label mt-3">Website Author *</label>
                                    <input type="text" class="form-control" id="siteAuthor">
                                </div>
                                
                                <div class="form-group">
                                    <label class="form-label mt-3">Open Graph Website Name *</label>
                                    <input type="text" class="form-control" id="ogSiteName">
                                </div>

                                <div class="form-group">
                                    <label class="form-label mt-3">Open Graph Website Title *</label>
                                    <input type="text" class="form-control" id="ogSiteTitle">
                                </div>

                                <div class="form-group">
                                    <label class="form-label mt-3">Open Graph Website URL *</label>
                                    <input type="text" class="form-control" id="ogSiteURL">
                                </div>

                                <div class="form-group">
                                    <label class="form-label mt-3">Open Graph Type *</label>
                                    <select class="form-control" id="ogSiteType">
                                        <option value="website">Website (General web page)</option>
                                        <option value="article">Article (News or blog post)</option>
                                        <option value="profile">Profile (Personal or company profile)</option>
                                        <option value="video.movie">Video: Movie (A full-length film)</option>
                                        <option value="video.episode">Video: Episode (A TV show episode)</option>
                                        <option value="video.tv_show">Video: TV Show (A TV show)</option>
                                        <option value="video.other">Video: Other (Other types of video content)</option>
                                        <option value="music.song">Music: Song (A single song)</option>
                                        <option value="music.album">Music: Album (A music album)</option>
                                        <option value="product">Product (A product page)</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label class="form-label mt-3">Open Graph Website Description *</label>
                                    <textarea class="form-control" id="ogSiteDescription"></textarea>
                                </div>

                                <div class="form-group">
                                    <label class="form-label mt-3">Open Graph Website Image *</label>
                                    <div class="product-list">
                                        <ul>
                                            <li class="p-0">
                                                <div class="productviews">
                                                    <div class="productviewsimg">
                                                        <img class="mw-100 mh-100" src="{{ asset('assets/img/profiles/avatar-17.jpg') }}" alt="open graph image" id="ogSiteImagePreview">
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="image-upload ">
                                        <input type="file" id="ogSiteImage" oninput="ogSiteImagePreview.src=window.URL.createObjectURL(this.files[0])">
                                        <div class="image-uploads">
                                            <img src="{{ asset('assets/img/icons/upload.svg') }}" alt="img">
                                            <h4>Drag and drop a file to upload</h4>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="form-label mt-3">Twitter Card Type *</label>
                                    <select class="form-control" id="twitterCard">
                                        <option value="summary">Summary (small image and text)</option>
                                        <option value="summary_large_image">Summary Large Image (large image and text)</option>
                                        <option value="app">App (mobile app promotion)</option>
                                        <option value="player">Player (multimedia content)</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Twitter Title *</label>
                                    <input type="text" class="form-control" id="twitterTitle">
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Twitter Description *</label>
                                    <textarea class="form-control" id="twitterDescription"></textarea>
                                </div>

                                <div class="form-group">
                                    <label class="form-label mt-3">Twitter Image *</label>
                                    <div class="product-list">
                                        <ul>
                                            <li class="p-0">
                                                <div class="productviews">
                                                    <div class="productviewsimg">
                                                        <img class="mw-100 mh-100" src="{{ asset('assets/img/profiles/avatar-17.jpg') }}" alt="page twitter image" id="twitterImagePreview">
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="image-upload ">
                                        <input type="file" id="twitterImage" oninput="twitterImagePreview.src=window.URL.createObjectURL(this.files[0])">
                                        <div class="image-uploads">
                                            <img src="{{ asset('assets/img/icons/upload.svg') }}" alt="img">
                                            <h4>Drag and drop a file to upload</h4>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="form-label mt-3">Robots Type *</label>
                                    <select class="form-control" id="robots">
                                        <option value="index, follow">Index, Follow (Default behavior)</option>
                                        <option value="noindex, follow">No Index, Follow (Do not index this page, but follow links)</option>
                                        <option value="index, nofollow">Index, No Follow (Index this page, but do not follow links)</option>
                                        <option value="noindex, nofollow">No Index, No Follow (Do not index this page or follow links)</option>
                                        <option value="noarchive">No Archive (Do not cache a copy of this page)</option>
                                        <option value="nosnippet">No Snippet (Do not show a snippet in search results)</option>
                                        <option value="noodp">No ODP (Do not use the Open Directory Project description for this page)</option>
                                        <option value="noimageindex">No Image Index (Do not index images on this page)</option>
                                        <option value="nocache">No Cache (Do not cache this page)</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Canonical URL *</label>
                                    <input type="text" class="form-control" id="canonicalUrl">
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Application Name *</label>
                                    <input type="text" class="form-control" id="applicationName">
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Theme Color *</label>
                                    <input type="color" class="form-control" id="themeColor">
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Google Site Verification *</label>
                                    <input type="text" class="form-control" id="googleSiteVerification">
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Referrer Policy *</label>
                                    <select class="form-control" id="referrerPolicy">
                                        <option value="no-referrer">no-referrer</option>
                                        <option value="no-referrer-when-downgrade">no-referrer-when-downgrade</option>
                                        <option value="origin">origin</option>
                                        <option value="origin-when-cross-origin">origin-when-cross-origin</option>
                                        <option value="same-origin">same-origin</option>
                                        <option value="strict-origin">strict-origin</option>
                                        <option value="strict-origin-when-cross-origin">strict-origin-when-cross-origin</option>
                                        <option value="unsafe-url">unsafe-url</option>
                                    </select>
                                </div>

                                <input type="text" id="seoPropertyInfoId">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-end">
                <button type="button" class="btn btn-sm btn-cancel" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-sm btn-submit">Save Changes</button>
            </div>
        </div>
    </div>
</div>
{{-- Edit modal end --}}


{{-- Front end script start --}}

<script>

    async function retrieveSeoPropertyInfoById(seoproperty_info_id){

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
                let ogSiteImageFullPath = baseUrl + '/storage/website_pictures/open_graph_images/' + response.data.data['og_image'];
                
                // Generating full path for the og site image
                let twitterImageFullPath = baseUrl + '/storage/website_pictures/twitter_images/' + response.data.data['twitter_image'];

                document.getElementById('siteTitle').value = response.data.data['site_title'];
                document.getElementById('siteKeywords').value = response.data.data['site_keywords'];
                document.getElementById('siteDescription').value = response.data.data['site_description'];
                document.getElementById('siteAuthor').value = response.data.data['author'];
                document.getElementById('ogSiteName').value = response.data.data['og_site_name'];
                document.getElementById('ogSiteTitle').value = response.data.data['og_title'];
                document.getElementById('ogSiteURL').value = response.data.data['og_url'];
                document.getElementById('ogSiteType').value = response.data.data['og_type'];
                document.getElementById('ogSiteDescription').value = response.data.data['og_description'];
                document.getElementById('ogSiteImagePreview').src = ogSiteImageFullPath;
                document.getElementById('twitterCard').value = response.data.data['twitter_card'];
                document.getElementById('twitterTitle').value = response.data.data['twitter_title'];
                document.getElementById('twitterDescription').value = response.data.data['twitter_description'];
                document.getElementById('twitterImagePreview').src = twitterImageFullPath;
                document.getElementById('robots').value = response.data.data['robots'];
                document.getElementById('canonicalUrl').value = response.data.data['canonical_url'];
                document.getElementById('applicationName').value = response.data.data['application_name'];
                document.getElementById('themeColor').value = response.data.data['theme_color'];
                document.getElementById('googleSiteVerification').value = response.data.data['google_site_verification'];
                document.getElementById('referrerPolicy').value = response.data.data['referrer'];
            } else{
                displayToast('error', response.data['message']);
            }
        } catch(e){
            console.error('Something went wrong', e);
        }
    }

    // Function for update about information
    async function updateAboutInfo(){

        try{
            // Getting input data
            let website_greetings = $('#websiteGreetings').val().trim();
            let website_full_name = $('#websiteFullName').val().trim();
            let website_designation = $('#websiteDesignation').val().trim();
            let website_email = $('#websiteEmail').val().trim();
            let website_phone = $('#websitePhone').val().trim();
            let website_location = $('#websiteLocation').val().trim();
            let website_hero_description = tinymce.get('websiteHeroDescription').getContent().trim();
            let upload_hero_image = document.getElementById('uploadHeroImage').files[0];
            let website_about_description = tinymce.get('websiteAboutDescription').getContent().trim();
            let upload_about_image = document.getElementById('uploadAboutImage').files[0];
            let website_resume = document.getElementById('uploadResume').files[0];

            // Regular expression for basic email validation
            let emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            // Front end validation process
            if(website_greetings.length === 0){
                displayToast('warning', 'Greetings text is required');
            } else if(website_full_name.length === 0){
                displayToast('warning', 'Full name is required');
            } else if(website_designation.length === 0){
                displayToast('warning', 'Designation is required');
            } else if(website_email.length === 0){
                displayToast('warning', 'Email is required');
            } else if(!emailPattern.test(website_email)){
                displayToast('warning', 'Invalid email address');
            } else if(website_phone.length === 0){
                displayToast('warning', 'Phone number is required');
            } else if(website_location.length === 0){
                displayToast('warning', 'Location is required');
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
                formData.append('email', website_email);
                formData.append('phone', website_phone);
                formData.append('location', website_location);
                formData.append('hero_description', website_hero_description);
                if(upload_hero_image) formData.append('hero_image', upload_hero_image);
                formData.append('about_description', website_about_description);
                if(upload_about_image) formData.append('about_image', upload_about_image);
                if(website_resume) formData.append('resume_link', website_resume);

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