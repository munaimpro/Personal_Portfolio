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
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th>Sno</th>
                                <th>Users</th>
                                <th>Role</th>
                            </tr>
                        </thead>
                        <tbody id="userTableList">
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

            <div class="card-body d-none" id="dashboardMessage">
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

            <div id="dashboardMessageStatus" class="d-flex" style="min-height:100vh">
                <div class="card w-50 m-auto">
                    <div class="card-body text-center">
                        <h5 style="color: #ff9f43">No new message</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
{{-- Latest Message end --}}
</div>
{{-- third row end --}}


{{-- Front end script start --}}

<script>

    // Function for retrieve dashboard latest user
    
    dashboardLatestUserInfo();

    async function dashboardLatestUserInfo(){

        try{
            // Getting data table
            let data_table = $('.datatable');

            // Getting table rows
            let table_list = $('#userTableList');

            // Destroy data table
            // data_table.DataTable().destroy();

            // Make data table empty
            table_list.empty();

            // Pssing data to controller and getting response
            showLoader();
            let response = await axios.get('/dashboardLatestUserInfo');
            hideLoader();

            // Getting base URL of the system
            let baseUrl = "{{ url('/') }}";

            response.data.data.forEach(function(item, index){
                // Generating full path for the user image
                let userImageFullPath = item['profile_picture'] == null ? baseUrl + '/assets/img/profiles/avater.png' : baseUrl + '/storage/profile_picture/user_images/' + item['profile_picture'];

                let row = `<tr>
                                <td>${index + 1}</td>
                                <td class="productimgname">
                                    <a href="{{ url('Admin/portfolio') }}" class="product-img">
                                        <img src="${userImageFullPath}" alt="profile picture">
                                    </a>
                                    <a href="{{ url('Admin/portfolio') }}">${item['first_name']} ${item['last_name']}</a>
                                </td>
                                <td>${item['role'] === 'admin' ? '<span class="bg-lightgreen badges">Admin</span>' : '<span class="bg-lightgrey badges">User</span>'}</td>
                            </tr>`
                table_list.append(row);
            });

            // data_table.DataTable();
        } catch(e){
            console.error('Something went wrong', e);
        }
    }



    // Function for retrieve dashboard new message

    dashboardNewMessageInfo();

    async function dashboardNewMessageInfo(){

        try{
            // Pssing id to controller and getting response
            showLoader();
            let response = await axios.get('/dashboardNewMessageInfo');
            hideLoader();

            if(response.data['status'] === 'success'){
                if(response.data.data.length > 0){
                    // Showing message
                    $('#dashboardMessage').removeClass('d-none');
                    $('#dashboardMessageStatus').addClass('d-none');

                    // Assigning retrieved values
                    $('#messageClientName').val(response.data.data[0]['name']);
                    $('#messageMail').val(response.data.data[0]['email']);
                    $('#replyMessageMail').val(response.data.data[0]['email']);
                    $('#messageSubject').val(response.data.data[0]['subject']);
                    $('#messageDescription').val(response.data.data[0]['message']);
                    $('#messageInfoId').val(response.data.data[0]['id']);
                }
            } else{
                console.log('error', response.data['message']);
            }
        } catch(e){
            console.error('Something went wrong', e);
        }
    }
</script>

{{-- Front end script end --}}