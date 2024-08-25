{{-- Signup form start --}}
<form id="signupForm">
<div class="form-login">
    <label>First Name</label>
    <div class="form-addons">
        <input type="text" placeholder="Enter your first name" id="userFirstName">
        <img src="{{ asset('assets/img/icons/users1.svg') }}" alt="img">
    </div>
</div>

<div class="form-login">
    <label>Last Name</label>
    <div class="form-addons">
        <input type="text" placeholder="Enter your last name" id="userLastName">
        <img src="{{ asset('assets/img/icons/users1.svg') }}" alt="img">
    </div>
</div>

<div class="form-login">
    <label>Email</label>
    <div class="form-addons">
        <input type="email" placeholder="Enter your email address" id="userEmail">
        <img src="{{ asset('assets/img/icons/mail.svg') }}" alt="img">
    </div>
</div>

<div class="form-login">
    <label>Phone</label>
    <div class="form-addons">
        <input type="phone" placeholder="Enter your phone number" id="userPhone">
        <img src="{{ asset('assets/img/icons/phone.svg') }}" alt="img">
    </div>
</div>

<div class="form-login">
    <label>Password</label>
    <div class="pass-group">
        <input type="password" class="pass-input" placeholder="Enter your password" id="userPassword">
        <span class="fas toggle-password fa-eye-slash"></span>
    </div>
</div>

<div class="form-group">
    <label>Profile Picture</label>
    <div class="product-list">
        <ul>
            <li class="p-0">
                <div class="productviews">
                    <div class="productviewsimg">
                        <img id="profilePicture" class="mw-100 mh-100" src="{{ asset('assets/img/profiles/avater.png') }}" alt="profile picture">
                    </div>
                </div>
            </li>
        </ul>
    </div>

    <div class="image-upload ">
        <input type="file" id="userProfilePicture" oninput="profilePicture.src=window.URL.createObjectURL(this.files[0])">
        <div class="image-uploads">
            <img src="{{ asset('assets/img/icons/upload.svg') }}" alt="img">
            <h4>Drag and drop a file to upload</h4>
        </div>
    </div>
</div>

<div class="form-login">
    <a class="btn btn-login" onclick="signupUser()">Sign Up</a>
</div>

<div class="signinform text-center">
    <h4>Already a user? <a href="{{ url('Admin/signin') }}" class="hover-a">Sign In</a></h4>
</div>

<div class="form-setlogin">
    <h4>Or sign up with</h4>
</div>

<div class="form-sociallink">
    <ul>
        <li>
            <a href="javascript:void(0);">
                <img src="{{ asset('assets/img/icons/google.png') }}" class="me-2" alt="google">
                Sign Up using Google
            </a>
        </li>

        <li>
            <a href="javascript:void(0);">
                <img src="{{ asset('assets/img/icons/facebook.png') }}" class="me-2" alt="google">
                Sign Up using Facebook
            </a>
        </li>
    </ul>
</div>
</form>
{{-- Signup form end --}}


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
        timer: 6000,
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
async function signupUser(){
    try{
        // Getting input data
        let user_first_name      = $('#userFirstName').val().trim();
        let user_last_name       = $('#userLastName').val().trim();
        let user_email           = $('#userEmail').val().trim();
        let user_phone           = $('#userPhone').val().trim();
        let user_password        = $('#userPassword').val().trim();
        let user_profile_picture = $('#userProfilePicture')[0].files[0];

        console.log(user_profile_picture);

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
        } else if(user_phone.length < 8 || user_phone.length > 15){
            displayToast('warning', 'Invalid phone number');
        } else if(user_password.length === 0){
            displayToast('warning', 'Password is required');
        } else if(user_password.length < 8){
            displayToast('warning', 'Password should be at least 8 character long');
        } else{
            // Form data object creation
            let formData = new FormData();
            
            // Organizing data in JSON format
            formData.append('first_name', user_first_name);
            formData.append('last_name', user_last_name);
            formData.append('email', user_email);
            formData.append('phone', user_phone);
            formData.append('password', user_password);
            if(user_profile_picture) formData.append('profile_picture', user_profile_picture);

            // Pssing data to controller and getting response
            showLoader();
            let response = await axios.post('../userSignup', formData, {
                headers:{
                    'content-type' : 'multipart/form-data'
                }
            });
            hideLoader();

            if(response.data['status'] === 'success'){
                $('#signupForm')[0].reset();
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