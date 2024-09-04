{{-- Edit modal start --}}
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Update User</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="updateUserForm">
                    <div class="col-12">
                        <div class="product-list">
                            <ul class="row">
                                <li class="ps-0">
                                    <div class="productviewset">
                                        <div class="productviewsimg">
                                            <img src="{{ asset('assets/img/customer/profile2.jpg') }}" alt="profile picture" id="userImagePreview">
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>First Name</label>
                            <input class="form-control" type="text" id="userFirstName">
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Last Name</label>
                            <input class="form-control" type="text" id="userLastName">
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Phone</label>
                            <input class="form-control" type="phone" id="userPhone">
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Email</label>
                            <input class="form-control" type="email" id="userEmail">
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Role</label>
                            <select class="select" id="userRole">
                                <option disabled>Select</option>
                                <option value="admin">Admin</option>
                                <option value="user">User</option>
                            </select>
                        </div>
                    </div>

                    <input type="text" id="userInfoId">
                </form>
            </div>
            <div class="modal-footer justify-content-end">
                <button type="button" class="btn btn-cancel" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-submit" onclick="updateUserInfo()">Update User</button>
            </div>
        </div>
    </div>
</div>
{{-- Edit modal end --}}


{{-- Front end script start --}}

<script>

    // Function for retrieve user details

    async function retrieveUserInfoById(user_info_id){
        try {
            // Assigning id to hidden field
            $('#userInfoId').val(user_info_id);

            // Sending id to controller and getting response
            showLoader();
            let response = await axios.post('../retrieveUserInfoById', { user_info_id: user_info_id });
            hideLoader();

            if (response.data['status'] === 'success'){
                // Getting base URL of the system
                let baseUrl = "{{ url('/') }}";
                
                // Generating full path for the user image
                let userImageFullPath = baseUrl + '/storage/profile_picture/user_images/' + response.data.data['profile_picture'];
            
                // Assigning retrieved values
                $('#userFirstName').val(response.data.data['first_name']);
                $('#userLastName').val(response.data.data['last_name']);
                $('#userEmail').val(response.data.data['email']);
                $('#userPhone').val(response.data.data['phone']);
                $('#userRole').val(response.data.data['role']);
                $('#userImagePreview')[0].src = userImageFullPath;
            } else {
                displayToast('error', response.data['message']);
            }
        } catch (e) {
            console.error('Something went wrong', e);
        }
    }
    
    
    // Function for update portfolio

    async function updateUserInfo(){
        try{
            // Getting input data
            let user_role = $('#userRole').val().trim();
            let user_info_id = $('#userInfoId').val().trim();

            console.log(user_role);
            console.log(user_info_id);

            // Front-end validation process
            if (user_role === '') {
                displayToast('warning', 'User role is required');
            } else {
                // Closing modal
                $('#editModal').modal('hide');

                // Sending data to the controller and getting response
                showLoader();
                let response = await axios.post('/updateUserInfo', {role: user_role, user_info_id: user_info_id});
                hideLoader();

                if (response.data['status'] === 'success') {
                    // Reset form
                    $('#updateUserForm')[0].reset();

                    // Call function to refresh the user list
                    await retrieveAllUserInfo();

                    displayToast('success', response.data['message']);
                } else {
                    displayToast('error', response.data['message']);
                }
            }
        } catch (e) {
            console.error('Something went wrong', e);
        }
    }

</script>

{{-- Front end script end --}}