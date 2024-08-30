{{-- Edit modal start --}}
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">SEO Properties</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="updateSEOPropertyForm">
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
                                    <select class="select" id="ogSiteType">
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
                                    <select class="select" id="twitterCard">
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
                                    <select class="select" id="robots">
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
                                    <select class="select" id="referrerPolicy">
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
                <button type="button" class="btn btn-sm btn-submit" onclick="updateSeoPropertyInfo()">Save Changes</button>
            </div>
        </div>
    </div>
</div>
{{-- Edit modal end --}}


{{-- Front end script start --}}

<script>

    // Function for retrive SEO property details

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


    // Function for update SEO property information

    async function updateSeoPropertyInfo(){

        try{
            // Getting input data
            let site_title = $('#siteTitle').val().trim();
            let site_keywords = $('#siteKeywords').val().trim();
            let site_description = $('#siteDescription').val().trim();
            let site_author = $('#siteAuthor').val().trim();
            let og_site_name = $('#ogSiteName').val().trim();
            let og_site_title = $('#ogSiteTitle').val().trim();
            let og_site_url = $('#ogSiteURL').val().trim();
            let og_site_type = $('#ogSiteType').val().trim();
            let og_site_description = $('#ogSiteDescription').val().trim();
            let og_site_image = $('#ogSiteImage')[0].files[0];
            let twitter_card = $('#twitterCard').val().trim();
            let twitter_title = $('#twitterTitle').val().trim();
            let twitter_description = $('#twitterDescription').val().trim();
            let twitter_image = $('#twitterImage')[0].files[0];
            let robots = $('#robots').val().trim();
            let canonical_url = $('#canonicalUrl').val().trim();
            let application_name = $('#applicationName').val().trim();
            let theme_color = $('#themeColor').val().trim();
            let google_site_verification = $('#googleSiteVerification').val().trim();
            let referrer_policy = $('#referrerPolicy').val().trim();
            let seoproperty_info_id = $('#seoPropertyInfoId').val().trim();

            // Front end validation process
            if(site_title.length === 0){
                displayToast('warning', 'Page title is required');
            } else if(site_keywords.length === 0){
                displayToast('warning', 'Page meta keywords are required');
            } else if(site_description.length === 0){
                displayToast('warning', 'Page description is required');
            } else if(site_author.length === 0){
                displayToast('warning', 'Author is required');
            } else if(og_site_name.length === 0){
                displayToast('warning', 'Open Graph name is required');
            } else if(og_site_title.length === 0){
                displayToast('warning', 'Open Graph title is required');
            } else if(og_site_url.length === 0){
                displayToast('warning', 'Open Graph URL is required');
            } else if(og_site_type === ''){
                displayToast('warning', 'Open Graph type is required');
            } else if(og_site_description.length === 0){
                displayToast('warning', 'Open Graph description is required');
            } else if(twitter_card === ''){
                displayToast('warning', 'Twitter card is required');
            } else if(twitter_title.length === 0){
                displayToast('warning', 'Twitter title is required');
            } else if(twitter_description.length === 0){
                displayToast('warning', 'Twitter description is required');
            } else if(robots === ''){
                displayToast('warning', 'Robot type is required');
            } else if(canonical_url.length === 0){
                displayToast('warning', 'Canonical URL is required');
            } else if(application_name.length === 0){
                displayToast('warning', 'Application name is required');
            } else if(theme_color.length === 0){
                displayToast('warning', 'Theme color is required');
            } else if(referrer_policy === ''){
                displayToast('warning', 'Referrer policy is required');
            } else{
                // Closing modal
                $('#editModal').modal('hide');

                // FormData object
                let formData = new FormData();

                formData.append('site_title', site_title);
                formData.append('site_keywords', site_keywords);
                formData.append('site_description', site_description);
                formData.append('author', site_author);
                formData.append('og_site_name', og_site_name);
                formData.append('og_title', og_site_title);
                formData.append('og_url', og_site_url);
                formData.append('og_type', og_site_type);
                formData.append('og_description', og_site_description);
                if(og_site_image) formData.append('og_image', og_site_image);
                formData.append('twitter_card', twitter_card);
                formData.append('twitter_title', twitter_title);
                formData.append('twitter_description', twitter_description);
                if(twitter_image) formData.append('twitter_image', twitter_image);
                formData.append('robots', robots);
                formData.append('canonical_url', canonical_url);
                formData.append('application_name', application_name);
                formData.append('theme_color', theme_color);
                formData.append('google_site_verification', google_site_verification);
                formData.append('referrer', referrer_policy);
                formData.append('seoproperty_info_id', seoproperty_info_id);

                // Passing data to controller and getting response
                showLoader();
                let response = await axios.post('/updateSeoPropertyInfo', formData, {
                    headers: {'content-type': 'multipart/form-data'}
                });
                hideLoader();

                if(response.data['status'] === 'success'){
                    // Reset form
                    $('#updateSEOPropertyForm')[0].reset();

                    // Refresh the SEO properties list or update UI accordingly
                    retrieveAllSeoPropertyInfo();

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