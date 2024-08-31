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
                    <table class="table datatable ">
                        <thead>
                            <tr>
                                <th>Sno</th>
                                <th>Projects</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
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

                            <tr>
                                <td>2</td>
                                <td class="productimgname">
                                    <a href="{{ url('Admin/portfolio') }}" class="product-img">
                                        <img src="{{ asset('assets/img/product/product22.jpg') }}" alt="project thumbnail">
                                    </a>
                                    <a href="{{ url('Admin/portfolio') }}">Project Name</a>
                                </td>
                                <td><span class="bg-lightgreen badges">Published</span></td>
                            </tr>

                            <tr>
                                <td>3</td>
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
                        <tbody>
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

                            <tr>
                                <td>2</td>
                                <td class="productimgname">
                                    <a href="{{ url('Admin/post') }}" class="product-img">
                                        <img src="{{ asset('assets/img/product/product22.jpg') }}" alt="project thumbnail">
                                    </a>
                                    <a href="{{ url('Admin/post') }}">Blog Title</a>
                                </td>
                                <td><span class="bg-lightgreen badges">Published</span></td>
                            </tr>

                            <tr>
                                <td>3</td>
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