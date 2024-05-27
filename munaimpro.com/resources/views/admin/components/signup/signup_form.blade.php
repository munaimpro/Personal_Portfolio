{{-- Signup form start --}}
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
        <input type="text" placeholder="Enter your email address" id="userEmail">
        <img src="{{ asset('assets/img/icons/mail.svg') }}" alt="img">
    </div>
</div>

<div class="form-login">
    <label>Password</label>
    <div class="pass-group">
        <input type="password" class="pass-input" placeholder="Enter your password" id="userPassword">
        <span class="fas toggle-password fa-eye-slash"></span>
    </div>
</div>

<div class="form-login">
    <a class="btn btn-login" onclick="signupUser()">Sign Up</a>
</div>

<div class="signinform text-center">
    <h4>Already a user? <a href="signin.html" class="hover-a">Sign In</a></h4>
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
        timer: 2000,
        customClass: {
            popup: 'colored-toast'
        }
    });
}

// Function for user signup
async function signupUser(){

    // Sanitize all input data
    function sanitizeInput(input) {
        return input.replace(/<\/?[^>]+(>|$)/g, "");
    }

    // Getting input data
    let first_name = sanitizeInput($('#userFirstName').val().trim());
    let last_name  = sanitizeInput($('#userLastName').val().trim());
    let email      = sanitizeInput($('#userEmail').val().trim());
    let password   = sanitizeInput($('#userPassword').val().trim());

    // Regular expression for basic email validation
    let emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    // Front end validation process
    if(first_name.length === 0){
        displayToast('warning', 'First name is required');
    } else if(last_name.length === 0){
        displayToast('warning', 'Last name is required');
    } else if(email.length === 0){
        displayToast('warning', 'Mail address is required');
    } else if(!emailPattern.test(email)){
        displayToast('warning', 'Invalid email address');
    } else if(password.length === 0){
        displayToast('warning', 'Password is required');
    } else if(password.length < 8){
        displayToast('warning', 'Password should be at least 8 character long');
    } else{
        alert(first_name);
    }
}

</script>

{{-- Front end script end --}}