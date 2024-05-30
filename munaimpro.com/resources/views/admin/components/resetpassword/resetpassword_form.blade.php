{{-- Send OTP form start --}}
<form id="resetpasswordForm">
    <div class="form-login">
        <label>New Password</label>
        <div class="pass-group">
            <input type="password" class="pass-input" placeholder="Enter your new password" id="userPassword">
            <span class="fas toggle-password fa-eye-slash"></s>
        </div>
    </div>

    <div class="form-login">
        <label>Confirm Password</label>
        <div class="pass-group">
            <input type="password" class="pass-input" placeholder="Confirm your new password" id="userConfirmPassword">
            <span class="fas toggle-password fa-eye-slash"></s>
        </div>
    </div>

    <div class="form-login">
        <a class="btn btn-login" onclick="resetpasswordUser()">Update</a>
    </div>
    </form>
    {{-- Send OTP form end --}}
    
    
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
        
        // Sanitize all input data
        function sanitizeInput(input) {
            return input.replace(/<\/?[^>]+(>|$)/g, "");
        }
        
        // Function for user signup
        async function resetpasswordUser(){
            try{
                // Getting input data
                let user_password    = $('#userPassword').val().trim();
                let confirm_password = $('#userConfirmPassword').val().trim();
        
                // Front end validation process
                if(user_password.length === 0){
                    displayToast('warning', 'Password is required');
                } else if(user_password.length < 8){
                    displayToast('warning', 'Password should at least 8 character');
                } else if(user_password !== confirm_password){
                    displayToast('warning', 'Password confirmation failure, not matched');
                } else{
        
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
                        $('#resetpasswordForm')[0].reset();
                        window.location.href = "signin";
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