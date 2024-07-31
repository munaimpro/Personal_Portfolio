
{{-- Signin form start --}}
<form id="signinForm">
<div class="form-login">
    <label>Email</label>
    <div class="form-addons">
        <input type="email" placeholder="Enter your email address" id="userEmail">
        <img src="{{ asset('assets/img/icons/mail.svg') }}" alt="img">
    </div>
</div>
<div class="form-login">
    <label>Password</label>
    <div class="pass-group">
        <input type="password" class="pass-input" placeholder="Enter your password" id="userPassword">
        <span class="fas toggle-password fa-eye-slash"></s>
    </div>
</div>
<div class="form-login">
    <div class="alreadyuser">
        <h4><a href="{{ url('Admin/sendotp') }}" class="hover-a">Forgot Password?</a></h4>
    </div>
</div>
<div class="form-login">
    <a class="btn btn-login" onclick="signinUser()">Sign In</a>
</div>
<div class="signinform text-center">
    <h4>Don’t have an account? <a href="{{ url('Admin/signup') }}" class="hover-a">Sign Up</a></h4>
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

{{-- Signin form end --}}


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
async function signinUser(){
    try{
        // Getting input data
        let user_email           = $('#userEmail').val().trim();
        let user_password        = $('#userPassword').val().trim();

        // Regular expression for basic email validation
        let emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        // Front end validation process
        if(user_email.length === 0){
            displayToast('warning', 'Mail address is required');
        } else if(!emailPattern.test(user_email)){
            displayToast('warning', 'Invalid email address');
        } else if(user_password.length === 0){
            displayToast('warning', 'Password is required');
        } else{

            let signinData = {
                "email" : user_email,
                "password" : user_password,
            }

            // Pssing data to controller and getting response
            // showLoader();
            let response = await axios.post('../userSignin', signinData);
            // hideLoader();

            if(response.data['status'] === 'success'){
                displayToast('success', response.data['message']);
                $('#signinForm')[0].reset();
                window.location.href = "dashboard";
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