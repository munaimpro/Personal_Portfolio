{{-- Page header start --}}
<div class="page-header">
    <div class="page-title">
        <h4>Social Media</h4>
        <h6>All about Social media</h6>
    </div>
    <div class="page-btn">
        <button class="btn btn-added" data-bs-toggle="modal" data-bs-target="#createModal">
            <img src="{{ asset('assets/img/icons/plus.svg') }}" class="me-1" alt="img">Add Social Media
        </button>
    </div>
</div>
{{-- Page header end --}}

{{-- Table start --}}
<div class="card">
    <div class="card-body">
        {{-- Table search start --}}
        <div class="table-top">
            <div class="search-set">
                <div class="search-input">
                    <a class="btn btn-searchset"><img src="{{ asset('assets/img/icons/search-white.svg') }}" alt="img"></a>
                </div>
            </div>
            <div class="wordset">
                <ul>
                    <li>
                        <a data-bs-toggle="tooltip" data-bs-placement="top" title="pdf"><img src="{{ asset('assets/img/icons/pdf.svg') }}" alt="img"></a>
                    </li>
                    <li>
                        <a data-bs-toggle="tooltip" data-bs-placement="top" title="excel"><img src="{{ asset('assets/img/icons/excel.svg') }}" alt="img"></a>
                    </li>
                    <li>
                        <a data-bs-toggle="tooltip" data-bs-placement="top" title="print"><img src="{{ asset('assets/img/icons/printer.svg') }}" alt="img"></a>
                    </li>
                </ul>
            </div>
        </div>
        {{-- Table search end --}}
        
        {{-- Table content start --}}
        <div class="table-responsive">
            <table class="table datanew" id="tableData">
                <thead>
                    <tr>
                        <th>Social Media</th>
                        <th>Placement</th>
                        <th>Link</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody id="tableList">
                    
                </tbody>
            </table>
        </div>
        {{-- Table content end --}}
    </div>
</div>
{{-- Table end --}}


{{-- Front end script start --}}

<script>

    // Function for retrieve social media information
    
    retrieveAllSocialMediaInfo();

    async function retrieveAllSocialMediaInfo(){

        try{
            // Getting data table
            let table_data = $('#tableData');

            // Getting table rows
            let table_list = $('#tableList');

            // Destroy data table
            // table_data.DataTable().destroy();

            // Make data table empty
            table_list.empty();

            // Pssing data to controller and getting response
            showLoader();
            let response = await axios.post('/retrieveAllSocialMediaInfo');
            hideLoader();
            
            response.data.data.forEach(function(item, index){
                let formattedPlacement = '';

                if(item['social_media_placement'].includes("hero") && item['social_media_placement'].includes("contact")){
                    formattedPlacement = 'About page, Hero, Contact';
                } else if(item['social_media_placement'].includes("hero") && item['social_media_placement'].includes("footer")){
                    formattedPlacement = 'About page, Hero, Footer';
                } else if(item['social_media_placement'].includes("contact") && item['social_media_placement'].includes("footer")){
                    formattedPlacement = 'About page, Contact, Footer';
                } else if(item['social_media_placement'].includes("hero")){
                    formattedPlacement = 'About page, Hero';
                } else if(item['social_media_placement'].includes("contact")){
                    formattedPlacement = 'About page, Contact';
                } else if(item['social_media_placement'].includes("footer")){
                    formattedPlacement = 'About page, Footer';
                } else{
                    formattedPlacement = 'About page';
                }

                let row = `<tr>
                                <td>${item['social_media_title']}</td>
                                <td>${formattedPlacement}</td>
                                <td>${item['social_media_link']}</td>
                                <td>
                                    <a data-id=${item.id} class="editBtn me-3" data-bs-toggle="modal" data-bs-target="#editModal">
                                        <img src="{{ asset('assets/img/icons/edit.svg') }}" alt="img">
                                    </a>                                        
                                    <a data-id=${item.id} class="deleteBtn me-3" data-bs-toggle="modal" data-bs-target="#deleteModal">
                                        <img src="{{ asset('assets/img/icons/delete.svg') }}" alt="img">
                                    </a>
                                </td>
                            </tr>`
                table_list.append(row);
            });

            $('.deleteBtn').on('click', function(){
                $('#socialMediaInfoDeleteId').val($(this).data('id'));
            });

            $('.editBtn').on('click', function(){
                let social_media_info_id = $(this).data('id');
                retrieveSocialMediaInfoById(social_media_info_id);
            });

            // table_data.DataTable();
        } catch(e){
            console.error('Something went wrong', e);
        }
    }
</script>

{{-- Front end script end --}}