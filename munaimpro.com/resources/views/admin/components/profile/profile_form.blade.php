{{-- Page header - Profile start --}}
<div class="page-header">
    <div class="page-title">
        <h4>Profile</h4>
        <h6>User Profile</h6>
    </div>
</div>
{{-- Page header - Profile end --}}
    
{{-- Profile form start --}}
<div class="card">
    <div class="card-body">
        <div class="profile-set">
            <div class="profile-head">
            </div>
            <div class="profile-top">
                <div class="profile-content">
                    <div class="profile-contentimg">
                        <img src="{{ asset('assets/img/profiles/avater.png') }}" alt="img" id="userProfileImage">
                        <div class="profileupload">
                            <input type="file" id="uploadProfilePicture" oninput="userProfileImage.src=window.URL.createObjectURL(this.files[0])">
                            <a href="javascript:void(0);"><img src="{{ asset('assets/img/icons/edit-set.svg') }}" alt="img"></a>
                        </div>
                    </div>
                    <div class="profile-contentname">
                        <h2 id="userFullName"></h2>
                        <h4>Updates Your Photo and Personal Details.</h4>
                    </div>
                </div>
                <div class="ms-auto">
                    <a href="javascript:void(0);" class="btn btn-submit me-2" onclick="updateUserProfile()">Save</a>
                    <a href="javascript:void(0);" class="btn btn-cancel" id="cancelProfileBtn">Cancel</a>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-6 col-sm-12">
                <div class="form-group">
                    <label>First Name</label>
                    <input type="text" id="userFirstName">
                </div>
            </div>
            <div class="col-lg-6 col-sm-12">
                <div class="form-group">
                    <label>Last Name</label>
                    <input type="text" id="userLastName">
                </div>
            </div>
            <div class="col-lg-6 col-sm-12">
                <div class="form-group">
                    <label>Email</label>
                    <input type="text" id="userEmail">
                </div>
            </div>
            <div class="col-lg-6 col-sm-12">
                <div class="form-group">
                    <label>Phone</label>
                    <input type="phone" id="userPhone">
                </div>
            </div>
            <div class="col-lg-6 col-sm-12">
                <div class="form-group">
                    <button class="btn btn-submit" data-bs-toggle="modal" data-bs-target="#editModal">Change Password</button>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- Profile form end --}}


{{-- Front end script start --}}

<script>

    // Function for toast message common features
    function displayToast(icon, title){
        Swal.fire({
            toast: true,
            position: 'top-end',
            icon: icon,
            iconColor: 'white',
            title: title,
            showConfirmButton: false,
            timer: 2000,
            customClass: {
                popup: 'colored-toast'
            }
        });
    }

    // Function for getting user data
    getUserInfo();

    async function getUserInfo() {
        showLoader();
        let response = await axios.post('../userProfile');
        hideLoader();

        if(response.data['status'] === 'success'){
            // Getting base URL of the system
            let baseUrl = "{{ url('/') }}";
            
            // Generating full path for the profile picture
            let profilePictureFullPath = response.data.data['profile_picture'] == null ? baseUrl + '/assets/img/profiles/avater.png' : baseUrl + '/storage/profile_picture/user_images/' + response.data.data['profile_picture'];
            
            document.getElementById('userFullName').innerText = response.data.data['first_name']+" "+response.data.data['last_name'];
            document.getElementById('userProfileImage').src = profilePictureFullPath;
            document.getElementById('userFirstName').value = response.data.data['first_name'];
            document.getElementById('userLastName').value = response.data.data['last_name'];
            document.getElementById('userEmail').value = response.data.data['email'];
            document.getElementById('userPhone').value = response.data.data['phone'];
            document.getElementById('currentPassword').value = response.data.data['password'];
        } else{
            displayToast('error', response.data['message']);
        }
    }

    // Function for update user data
    async function updateUserProfile(){

        try{
            // Getting input data
            let user_first_name = $('#userFirstName').val().trim();
            let user_last_name = $('#userLastName').val().trim();
            let user_email = $('#userEmail').val().trim();
            let user_phone = $('#userPhone').val().trim();
            let upload_profile_picture = document.getElementById('uploadProfilePicture').files[0];

            // Regular expression for basic email validation
            let emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            // Front end validation process
            if(user_first_name.length === 0){
                displayToast('warning', 'First name is required');
            } else if(user_last_name.length === 0){
                displayToast('warning', 'Last name is required');
            } else if(user_email.length === 0){
                displayToast('warning', 'Mail address is required');
            } else if(!emailPattern.test(user_email)){
                displayToast('warning', 'Invalid email address');
            } else if(user_phone.length === 0){
                displayToast('warning', 'Phone number is required');
            } else{
                // FormData object
                let formData = new FormData();

                // Data append to FormData
                formData.append('first_name', user_first_name);
                formData.append('last_name', user_last_name);
                formData.append('email', user_email);
                formData.append('phone', user_phone);
                if(upload_profile_picture) formData.append('profile_picture', upload_profile_picture);

                // Pssing data to controller and getting response
                showLoader();
                let response = await axios.post('../userUpdateProfile', formData, {
                    headers:{'content-type':'multipart/form-data'}
                });
                hideLoader();

                if(response.data['status'] === 'success'){
                    await getUserInfo();
                    displayToast('success', response.data['message']);
                } else{
                    displayToast('error', response.data['message']);
                }
            }
        } catch(e){
            console.error('Something went wrong', e);
        }
    }
        
    // Function for user reset password
    async function resetUserPassword(){
        try{
            // Getting input data
            let user_password    = $('#userPassword').val().trim();
            let confirm_password = $('#userConfirmPassword').val().trim();
    
            // Front end validation process
            if(user_password.length === 0){
                displayToast('warning', 'Password is required');
            } else if(user_password.length < 8){
                displayToast('warning', 'Password should at least 8 character');
            } else if(confirm_password.length === 0){
                displayToast('warning', 'Password confirmation is required');
            } else if(user_password !== confirm_password){
                displayToast('warning', 'Password confirmation failure, not matched');
            } else{
                // Closing modal
                $('#editModal').modal('hide');

                // Assigning data to variable in JSON format
                let resetpasswordData = {
                    "password" : user_password,
                    "confirm_password" : confirm_password,
                }
    
                // Pssing data to controller and getting response
                showLoader();
                let response = await axios.post('../userResetPassword', resetpasswordData);
                hideLoader();
    
                if(response.data['status'] === 'success'){
                    displayToast('success', response.data['message']);
                } else{
                    displayToast('error', response.data['message']);
                }
            }
        } catch(e){
            console.error('Something went wrong', e);
        }
        
    
        
    
        
    }
</script>

{{-- Front end script end --}}