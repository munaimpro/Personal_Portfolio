{{-- Page header start --}}
<div class="page-header">
    <div class="page-title">
        <h4>User List</h4>
        <h6>Manage your User</h6>
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
            <table class="table datanew" id="tableData">
                <thead>
                    <tr>
                        <th>Profile</th>
                        <th>Name </th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody id="tableList">
                    
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- Table end --}}


{{-- Front end script start --}}

<script>

    // Function for retrive user information
    
    retrieveAllUserInfo();

    async function retrieveAllUserInfo(){

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
            let response = await axios.get('/retrieveAllUserInfo');
            hideLoader();

            // Getting base URL of the system
            let baseUrl = "{{ url('/') }}";

            response.data.data.forEach(function(item, index){
                // Generating full path for the user image
                let userImageFullPath = item['profile_picture'] == null ? baseUrl + '/assets/img/profiles/avater.png' : baseUrl + '/storage/profile_picture/user_images/' + item['profile_picture'];

                console.log(baseUrl + '/storage/profile_picture/user_images/' + item['profile_picture']);

                let row = `<tr>
                                <td class="productimgname d-block">
                                    <a href="javascript:void(0);" class="product-img">
                                        <img src="${userImageFullPath}" alt="profile picture">
                                    </a>
                                </td>
                                <td>${item['first_name']} ${item['last_name']}</td>
                                <td>${item['phone']}</td>
                                <td>${item['email']}</td>
                                <td>${item['role'] === 'admin' ? '<span class="bg-lightgreen badges">Admin</span>' : '<span class="bg-lightgrey badges">User</span>'}</td>
                                <td>
                                    <a data-id="${item.id}" class="editBtn me-3" data-bs-toggle="modal" data-bs-target="#editModal">
                                        <img src="{{ asset('assets/img/icons/edit.svg') }}" alt="Edit">
                                    </a>                                        
                                    <a data-id="${item.id}" class="deleteBtn me-3" data-bs-toggle="modal" data-bs-target="#deleteModal">
                                        <img src="{{ asset('assets/img/icons/delete.svg') }}" alt="Delete">
                                    </a>
                                </td>
                            </tr>`
                table_list.append(row);
            });

            $('.deleteBtn').on('click', function(){
                $('#userInfoDeleteId').val($(this).data('id'));
            });

            $('.editBtn').on('click', function(){
                let user_info_id = $(this).data('id');
                retrieveUserInfoById(user_info_id);
            });

            // table_data.DataTable();
        } catch(e){
            console.error('Something went wrong', e);
        }
    }
</script>

{{-- Front end script end --}}
