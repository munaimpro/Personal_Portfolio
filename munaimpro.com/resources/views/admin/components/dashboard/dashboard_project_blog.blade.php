{{-- Second row start --}}
<div class="row">
{{-- Recent projects start --}}
    <div class="col-lg-6 col-sm-12 col-12 d-flex">
        <div class="card flex-fill">
            <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                <h4 class="card-title mb-0">Recent Projects</h4>
                <div class="dropdown">
                    <a href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false" class="dropset">
                        <i class="fa fa-ellipsis-v"></i>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <li>
                            <a href="{{ url('Admin/portfolio') }}" class="dropdown-item">All Project</a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive dataview">
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th>Sno</th>
                                <th>Projects</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody id="projectTableList">
                            <tr>
                                <td>1</td>
                                <td class="productimgname">
                                    <a href="{{ url('Admin/portfolio') }}" class="product-img">
                                        <img src="{{ asset('assets/img/product/product22.jpg') }}" alt="project thumbnail">
                                    </a>
                                    <a href="{{ url('Admin/portfolio') }}">Project Name</a>
                                </td>
                                <td><span class="bg-lightgreen badges">Published</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
{{-- Recent projects end --}}

{{-- Recent blogs start --}}
    <div class="col-lg-6 col-sm-12 col-12 d-flex">
        <div class="card flex-fill">
            <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                <h4 class="card-title mb-0">Recent Blogs</h4>
                <div class="dropdown">
                    <a href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false" class="dropset">
                        <i class="fa fa-ellipsis-v"></i>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <li>
                            <a href="{{ url('Admin/post') }}" class="dropdown-item">All Blog</a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive dataview">
                    <table class="table datatable ">
                        <thead>
                            <tr>
                                <th>Sno</th>
                                <th>Blogs</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody id="postTableList">
                            <tr>
                                <td>1</td>
                                <td class="productimgname">
                                    <a href="{{ url('Admin/post') }}" class="product-img">
                                        <img src="{{ asset('assets/img/product/product22.jpg') }}" alt="project thumbnail">
                                    </a>
                                    <a href="{{ url('Admin/post') }}">Blog Title</a>
                                </td>
                                <td><span class="bg-lightgreen badges">Published</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
{{-- Recent blogs end --}}
</div>
{{-- Second row end --}}


{{-- Front end script start --}}

<script>

    // Function for retrieve dashboard recent portfolio
    
    dashboardLatestProjectInfo();

    async function dashboardLatestProjectInfo(){

        try{
            // Getting data table
            let data_table = $('.datatable');

            // Getting table rows
            let table_list = $('#projectTableList');

            // Destroy data table
            // data_table.DataTable().destroy();

            // Make data table empty
            table_list.empty();

            // Pssing data to controller and getting response
            showLoader();
            let response = await axios.post('/dashboardLatestProjectInfo');
            hideLoader();

            // Getting base URL of the system
            let baseUrl = "{{ url('/') }}";

            response.data.data.forEach(function(item, index){
                // Generating full path for the project thumbnail
                let projectThumbnailFullPath = baseUrl + '/storage/portfolio/thumbnails/' + item['project_thumbnail'];

                let row = `<tr>
                                <td>${index + 1}</td>
                                <td class="productimgname">
                                    <a href="{{ url('Admin/portfolio') }}" class="product-img">
                                        <img src="${projectThumbnailFullPath}" alt="project thumbnail">
                                    </a>
                                    <a href="{{ url('Admin/portfolio') }}">${item['project_title']}</a>
                                </td>
                                <td>${item['project_status'] === 'published' ? '<span class="bg-lightgreen badges">Published</span>' : item['project_status'] === 'running' ? '<span class="bg-lightgrey badges">Running</span>' : '<span class="bg-lightred badges">Private</span>'}</td>
                            </tr>`
                table_list.append(row);
            });

            // data_table.DataTable();
        } catch(e){
            console.error('Something went wrong', e);
        }
    }



    // Function for retrieve dashboard recent blog post
    
    dashboardLatestPostInfo();

    async function dashboardLatestPostInfo(){

        try{
            // Getting data table
            let data_table = $('.datatable');

            // Getting table rows
            let table_list = $('#postTableList');

            // Destroy data table
            // data_table.DataTable().destroy();

            // Make data table empty
            table_list.empty();

            // Pssing data to controller and getting response
            showLoader();
            let response = await axios.post('/dashboardLatestPostInfo');
            hideLoader();

            // Getting base URL of the system
            let baseUrl = "{{ url('/') }}";

            response.data.data.forEach(function(item, index){
                // Generating full path for the post thumbnail
                let postThumbnailFullPath = baseUrl + '/storage/post_thumbnails/' + item['post_thumbnail'];

                let row = `<tr>
                                <td>${index + 1}</td>
                                <td class="productimgname">
                                    <a href="{{ url('Admin/portfolio') }}" class="product-img">
                                        <img src="${postThumbnailFullPath}" alt="project thumbnail">
                                    </a>
                                    <a href="{{ url('Admin/portfolio') }}">${item['post_heading']}</a>
                                </td>
                                <td>${item['post_status'] === 'published' ? '<span class="bg-lightgreen badges">Published</span>' : item['post_status'] === 'scheduled' ? '<span class="bg-lightgrey badges">Scheduled</span>' : '<span class="bg-lightred badges">Private</span>'}</td>
                            </tr>`
                table_list.append(row);
            });

            // data_table.DataTable();
        } catch(e){
            console.error('Something went wrong', e);
        }
    }
</script>

{{-- Front end script end --}}