{{-- Page header start --}}
<div class="page-header">
    <div class="page-title">
        <h4>Blog Post</h4>
        <h6>Manage Blog Post</h6>
    </div>
    <div class="page-btn">
        <button class="btn btn-added" data-bs-toggle="modal" data-bs-target="#createModal">
            <img src="{{ asset('assets/img/icons/plus.svg') }}" class="me-1" alt="img">Add Post
        </button>
    </div>
</div>
{{-- Page header end --}}

{{-- Table start --}}
<div class="card">
    <div class="card-body">
        <div class="table-top">
            <div class="search-set">
                <div class="search-input">
                    <a class="btn btn-searchset">
                        <img src="{{ asset('assets/img/icons/search-white.svg') }}" alt="img">
                    </a>
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

        <div class="table-responsive">
            <table class="table datanew" id="tableData">
                <thead>
                    <tr>
                        <th>Heading</th>
                        <th>Category</th>
                        <th>Created By</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>View</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody id="tableList">
                    {{-- <tr>
                        <td class="productimgname">
                            <a href="javascript:void(0);" class="post image">
                                <img src="{{ asset('assets/img/product/product17.jpg') }}" alt="post thumbnail">
                            </a>
                            Post heading will be go here
                        </td>
                        <td>Post category</td>
                        <td>Created by</td>
                        <td>Date</td>
                        <td>
                            <span class="bg-lightgreen badges">Published</span>
                            <span class="bg-lightred badges">Drafted</span>
                        </td>
                        <td>22</td>
                        <td>
                            <a class="me-3" data-bs-toggle="modal" data-bs-target="#editModal">
                                <img src="{{ asset('assets/img/icons/edit.svg') }}" alt="img">
                            </a>                                        
                            <a lass="me-3" data-bs-toggle="modal" data-bs-target="#deleteModal">
                                <img src="{{ asset('assets/img/icons/delete.svg') }}" alt="img">
                            </a>
                        </td>
                    </tr> --}}
                </tbody>
            </table>
        </div>
    </div>
</div>
{{-- Table end --}}


{{-- Front end script start --}}

<script>

    // Function for retrive post information
    
    retriveAllPostInfo();

    async function retriveAllPostInfo(){

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
            let response = await axios.get('/retriveAllPostInfo');
            hideLoader();

            // Getting base URL of the system
            let baseUrl = "{{ url('/') }}";

            response.data.data.forEach(function(item, index){
                // Generating full path for the post thumbnail
                let postThumbnailFullPath = baseUrl + '/storage/post_thumbnails/' + item['post_thumbnail'];

                // Formatting the created_at date
                let createdAt = new Date(item['created_at']);
                let formattedDate = createdAt.toLocaleDateString('en-US', {
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric',
                    hour: '2-digit',
                    minute: '2-digit'
                });

                let row = `<tr>
                                <td class="productimgname d-block">
                                    <a href="javascript:void(0);" class="post image">
                                        <img src=${postThumbnailFullPath} alt="post thumbnail">
                                    </a>
                                    <p class="fw-bold">Lorem ipsum dolor sit amet</p>
                                </td>
                                <td>${item.category['category_name']}</td>
                                <td>${item.user['first_name']} ${item.user['last_name']}</td>
                                <td>${formattedDate}</td>
                                <td>${item['post_status'] === 'published' ? '<span class="bg-lightgreen badges">Published</span>' : item['post_status'] === 'scheduled' ? '<span class="bg-lightblue badges">Scheduled</span>' : '<span class="bg-lightred badges">Drafted</span>'}</td>
                                <td>${item['post_view']}</td>
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
                $('#postInfoDeleteId').val($(this).data('id'));
            });

            $('.editBtn').on('click', function(){
                let post_info_id = $(this).data('id');
                retrivePostInfoById(post_info_id);
            });

            // table_data.DataTable();
        } catch(e){
            console.error('Something went wrong', e);
        }
    }
</script>

{{-- Front end script end --}}