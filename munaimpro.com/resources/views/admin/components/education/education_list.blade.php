{{-- Page header start --}}
<div class="page-header">
    <div class="page-title">
        <h4>Education Details</h4>
        <h6>All about edication information</h6>
    </div>
    <div class="page-btn">
        <button class="btn btn-added" data-bs-toggle="modal" data-bs-target="#createModal">
            <img src="{{ asset('assets/img/icons/plus.svg') }}" class="me-1" alt="img">Add Education
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
        <!-- Table search end -->
        
        <!-- Table content start -->
        <div class="table-responsive">
            <table class="table datanew">
                <thead>
                    <tr>
                        <th>
                            <label class="checkboxs">
                                <input type="checkbox" id="select-all">
                                <span class="checkmarks"></span>
                            </label>
                        </th>
                        <th>Education Type</th>
                        <th>Degree</th>
                        <th>Starting Date</th>
                        <th>Ending Date</th>
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
                        <td>Academic</td>
                        <td>B.Sc in Computer Science & Engineering</td>
                        <td>17 May, 2017</td>
                        <td>17 May, 2022</td>
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
        {{-- Table content end --}}
    </div>
</div>
{{-- Table end --}}