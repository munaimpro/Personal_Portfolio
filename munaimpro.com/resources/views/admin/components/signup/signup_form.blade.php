{{-- Signup form start --}}
<div class="form-login">
    <label>Full Name</label>
    <div class="form-addons">
        <input type="text" placeholder="Enter your full name">
        <img src="{{ asset('assets/img/icons/users1.svg') }}" alt="img">
    </div>
</div>

<div class="form-login">
    <label>Email</label>
    <div class="form-addons">
        <input type="text" placeholder="Enter your email address">
        <img src="{{ asset('assets/img/icons/mail.svg') }}" alt="img">
    </div>
</div>

<div class="form-login">
    <label>Password</label>
    <div class="pass-group">
        <input type="password" class="pass-input" placeholder="Enter your password">
        <span class="fas toggle-password fa-eye-slash"></span>
    </div>
</div>

<div class="form-login">
    <a class="btn btn-login">Sign Up</a>
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