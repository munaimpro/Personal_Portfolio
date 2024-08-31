{{-- third row start --}}
<div class="row">
{{-- User list start --}}
    <div class="col-lg-6 col-sm-12 col-12 d-flex">
        <div class="card flex-fill">
            <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                <h4 class="card-title mb-0">Latest Users</h4>
                <div class="dropdown">
                    <a href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false" class="dropset">
                        <i class="fa fa-ellipsis-v"></i>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <li>
                            <a href="{{ url('Admin/user') }}" class="dropdown-item">All User</a>
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
                                <th>Users</th>
                                <th>Role</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td class="productimgname sorting_1">
                                    <a href="{{ url('Admin/user') }}" class="product-img">
                                        <img src="http://127.0.0.1:8000/storage/profile_picture/user_images/695a4-munaim.jpg" alt="profile picture">
                                    </a>
                                    <a href="{{ url('Admin/user') }}">User Full Name</a>
                                </td>
                                <td><span class="bg-lightgreen badges">Admin</span></td>
                            </tr>

                            <tr>
                                <td>2</td>
                                <td class="productimgname sorting_1">
                                    <a href="{{ url('Admin/user') }}" class="product-img">
                                        <img src="http://127.0.0.1:8000/storage/profile_picture/user_images/695a4-munaim.jpg" alt="profile picture">
                                    </a>
                                    <a href="{{ url('Admin/user') }}">User Full Name</a>
                                </td>
                                <td><span class="bg-lightgreen badges">Admin</span></td>
                            </tr>

                            <tr>
                                <td>3</td>
                                <td class="productimgname sorting_1">
                                    <a href="{{ url('Admin/user') }}" class="product-img">
                                        <img src="http://127.0.0.1:8000/storage/profile_picture/user_images/695a4-munaim.jpg" alt="profile picture">
                                    </a>
                                    <a href="{{ url('Admin/user') }}">User Full Name</a>
                                </td>
                                <td><span class="bg-lightgreen badges">Admin</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
{{-- Visitor country report end --}}

{{-- Latest Message start --}}
    <div class="col-lg-6 col-sm-12 col-12 d-flex">
        <div class="card flex-fill">
            <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                <h4 class="card-title mb-0">New Message</h4>
                <div class="dropdown">
                    <a href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false" class="dropset">
                        <i class="fa fa-ellipsis-v"></i>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <li>
                            <a href="{{ url('Admin/message') }}" class="dropdown-item">All Message</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="card-body">
                <div class="col-lg-12">
                    <div class="form-group">
                        <label>Name</label>
                        <input class="form-control" type="text" id="messageClientName">
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="form-group">
                        <label>Email</label>
                        <input class="form-control" type="email" id="messageMail">
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="form-group">
                        <label>Subject</label>
                        <input class="form-control" type="text" id="messageSubject">
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="form-group">
                        <label>Message</label>
                        <textarea class="textarea" id="messageDescription"></textarea>
                    </div>
                </div>

                <input type="text" id="messageInfoId">

                <div class="d-flex justify-content-end">
                    <button type="button" class="btn btn-submit" data-bs-toggle="modal" data-bs-target="#replyModal">Reply</button>
                </div>
            </div>
        </div>
    </div>
{{-- Latest Message end --}}
</div>
{{-- third row end --}}