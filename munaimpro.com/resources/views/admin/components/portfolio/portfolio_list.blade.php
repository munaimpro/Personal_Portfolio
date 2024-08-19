{{-- Page header start --}}
<div class="page-header">
    <div class="page-title">
        <h4>Project</h4>
        <h6>Manage Projects</h6>
    </div>
    <div class="page-btn">
        <button class="btn btn-added" data-bs-toggle="modal" data-bs-target="#createModal">
            <img src="{{ asset('assets/img/icons/plus.svg') }}" class="me-1" alt="img">Add Project
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
                <th>Title</th>
                <th>Project Type</th>
                <th>URL</th>
                <th>Duration</th>
                <th>View</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            </thead>

            <tbody id="tableList">
                <tr>
                    <td class="productimgname sorting_1">
                        <a href="javascript:void(0);" class="post image">
                            <img src="{{ asset('assets/img/product/product17.jpg') }}" alt="post thumbnail">
                        </a>
                        Post heading will be go here
                    </td>
                    <td>Project type</td>
                    <td>https://www.example.com</td>
                    <td>From date to To date</td>
                    <td>22</td>
                    <td>
                        <span class="bg-lightgreen badges">Published</span>
                        <span class="bg-lightred badges">Drafted</span>
                    </td>
                    <td>
                        <a class="me-3" data-bs-toggle="modal" data-bs-target="#editModal">
                            <img src="{{ asset('assets/img/icons/edit.svg') }}" alt="img">
                        </a>
                        <a class="me-3" data-bs-toggle="modal" data-bs-target="#viewModal">
                            <img src="{{ asset('assets/img/icons/eye.svg') }}" alt="img">
                        </a>                                        
                        <a lass="me-3" data-bs-toggle="modal" data-bs-target="#deleteModal">
                            <img src="{{ asset('assets/img/icons/delete.svg') }}" alt="img">
                        </a>
                    </td>
                </tr>
            </tbody>
            </table>
            </div>
    </div>
</div>
{{-- Table end --}}


{{-- Front end script start --}}

<script>

    // Function for retrive portfolio information
    
    retriveAllPortfolioInfo();

    async function retriveAllPortfolioInfo(){

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
            let response = await axios.get('/retriveAllPortfolioInfo');
            hideLoader();

            // Getting base URL of the system
            let baseUrl = "{{ url('/') }}";

            response.data.data.forEach(function(item, index){
                // Generating full path for the project thumbnail
                let projectThumbnailFullPath = baseUrl + '/storage/portfolio/thumbnails/' + item['project_thumbnail'];

                // Formatting the project starting date date
                let startingDate = new Date(item['project_starting_date']);
                let formattedStartingDate = startingDate.toLocaleDateString('en-US', {
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric',
                });

                // Formatting the project ending date date
                let endingDate = new Date(item['project_ending_date']);
                let formattedEndingDate = endingDate.toLocaleDateString('en-US', {
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric',
                });

                let row = `<tr>
                                <td class="productimgname d-block">
                                    <a href="javascript:void(0);" class="post image">
                                        <img src=${projectThumbnailFullPath} alt="project thumbnail" class="h-50 w-75">
                                    </a>
                                    <p class="fw-bold">Lorem ipsum dolor sit amet</p>
                                </td>
                                <td>${item['project_type']}</td>
                                <td>${item['project_url']}</td>
                                <td>${formattedStartingDate} to ${formattedEndingDate}</td>
                                <td>${item['project_view']}</td>
                                <td>${item['project_status'] === 'published' ? '<span class="bg-lightgreen badges">Published</span>' : item['project_status'] === 'running' ? '<span class="bg-lightgrey badges">Running</span>' : '<span class="bg-lightred badges">Private</span>'}</td>
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
                $('#portfolioInfoDeleteId').val($(this).data('id'));
            });

            $('.editBtn').on('click', function(){
                let post_info_id = $(this).data('id');
                retrivePortfolioInfoById(post_info_id);
            });

            // table_data.DataTable();
        } catch(e){
            console.error('Something went wrong', e);
        }
    }
</script>

{{-- Front end script end --}}