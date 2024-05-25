{{-- Page header start --}}
<div class="page-header">
    <div class="page-title">
        <h4>User List</h4>
        <h6>Manage your User</h6>
    </div>
    <div class="page-btn">
        <button class="btn btn-added" data-bs-toggle="modal" data-bs-target="#createModal">
            <img src="{{ asset('assets/img/icons/plus.svg') }}" class="me-1" alt="img">Add User
        </button>
    </div>
</div>
{{-- Page header start --}}

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
                        <th>
                            <label class="checkboxs">
                                <input type="checkbox">
                                <span class="checkmarks"></span>
                            </label>
                        </th>
                        <th>Profile</th>
                        <th>Name </th>
                        <th>User name </th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Joined On</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td>
                            <label class="checkboxs">
                                <input type="checkbox">
                                <span class="checkmarks"></span>
                            </label>
                        </td>
                        <td class="productimgname">
                            <a href="javascript:void(0);" class="product-img">
                                <img src="{{ asset('assets/img/customer/customer1.jpg') }}" alt="product">
                            </a>
                        </td>
                        <td>Thomas</td>
                        <td>Thomas21 </td>
                        <td>+12163547758 </td>
                        <td>email</td>
                        <td>Admin</td>
                        <td>2024-3-5</td>
                        <td>
                            <span class="bg-lightgreen badges">Active</span>
                            <span class="bg-lightred badges">Restricted</span>
                        </td>
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
