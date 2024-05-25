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
            <table class="table  datanew">
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

            <tbody>
                <tr>
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
                </tr>
            </tbody>
            </table>
            </div>
    </div>
</div>
{{-- Table end --}}