{{-- Page header - Message not read start --}}
<div class="page-header">
    <div class="page-title">
        <h4>Message</h4>
        <h6>Manage Client Message</h6>
    </div>
    <div class="page-btn">
        <button class="btn btn-added" data-bs-toggle="modal" data-bs-target="#createModal">
            <img src="{{ asset('assets/img/icons/plus.svg') }}" class="me-1" alt="img">Send Message
        </button>
    </div>
</div>
{{-- Page header - Message not read end --}}

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
                <th>Name</th>
                <th>Email</th>
                <th>Subject</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
            </thead>

            <tbody>
                <tr>
                    <td>Client name</td>
                    <td>example@example.com</td>
                    <td>Email subject will be go here</td>
                    <td>Feb 2, 2022</td>
                    <td>
                        <a class="me-3" data-bs-toggle="modal" data-bs-target="#viewModal">
                            <img src="{{ asset('assets/img/icons/eye.svg') }}" alt="img">
                        </a>                                        
                        <a lass="me-3" data-bs-toggle="modal" data-bs-target="#replyModal">
                            <img src="{{ asset('assets/img/icons/reply.svg') }}" alt="img">
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