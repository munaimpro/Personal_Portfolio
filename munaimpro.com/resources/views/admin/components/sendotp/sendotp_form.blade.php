{{-- Send OTP form start --}}
<form id="sendotpForm">
<div class="form-login">
    <label>Email</label>
    <div class="form-addons">
        <input type="text" placeholder="Enter your email address" id="userEmail">
        <img src="{{ asset('assets/img/icons/mail.svg') }}" alt="img">
    </div>
</div>
<div class="form-login">
    <a class="btn btn-login" onclick="sendotpUser()">Submit</a>
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
    async function sendotpUser(){
        try{
            // Getting input data
            let user_email           = $('#userEmail').val().trim();
    
            // Regular expression for basic email validation
            let emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    
            // Front end validation process
            if(user_email.length === 0){
                displayToast('warning', 'Mail address is required');
            } else if(!emailPattern.test(user_email)){
                displayToast('warning', 'Invalid email address');
            } else{
    
                let sendotpData = {
                    "email" : user_email,
                }
    
                // Pssing data to controller and getting response
                showLoader();
                let response = await axios.post('../userSendOTP', sendotpData);
                hideLoader();
    
                if(response.data['status'] === 'success'){
                    displayToast('success', response.data['message']);
                    $('#sendotpForm')[0].reset();
                    window.location.href = "verifyotp";
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