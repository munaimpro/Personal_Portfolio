<div id="feedback-body">
{{-- Page header - Profile start --}}
<div class="page-header">
    <div class="page-title">
        <h4>Feedback</h4>
        <h6>Please provide your valuable feedback</h6>
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
                        <img src="{{ asset('assets/img/customer/customer5.jpg') }}" alt="img" id="clientImage">
                        <div class="profileupload">
                            <input type="file" id="uploadClientImage" oninput="clientImage.src=window.URL.createObjectURL(this.files[0])">
                            <a href="javascript:void(0);"><img src="{{ asset('assets/img/icons/edit-set.svg') }}" alt="img"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-6 col-sm-12">
                <div class="form-group">
                    <label>First Name</label>
                    <input type="text" id="clientFirstName">
                </div>
            </div>
            <div class="col-lg-6 col-sm-12">
                <div class="form-group">
                    <label>Last Name</label>
                    <input type="text" id="clientLastName">
                </div>
            </div>
            <div class="col-lg-6 col-sm-12">
                <div class="form-group">
                    <label>Designation</label>
                    <input type="text" id="clientDesignation">
                </div>
            </div>
            <div class="col-lg-6 col-sm-12">
                <div class="form-group">
                    <label>Feedback</label>
                    <textarea class="form-control" id="clientFeedback"></textarea>
                </div>
            </div>

            <input type="text" id="portfolioInfoId" value="{{ $portfolioInfoId }}">
            <input type="text" id="token" value="{{ $token }}">

            <div class="ms-auto">
                <button type="button" class="btn btn-submit me-2 float-end" onclick="addClientFeedback()">Send</button>
            </div>
        </div>
    </div>
</div>
{{-- Profile form end --}}
</div>

<div id="feedback-message" class="d-flex d-none" style="min-height:100vh">
    <div class="card w-50 m-auto">
        <div class="card-body text-center">
            <h1 style="color: #ff9f43">Thank you!</h1>
            <h5>For your feedback. Stay connected with us.</h5>
        </div>
    </div>
</div>


{{-- Front end script start --}}

<script>
    
    hideLoader();

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

    // Function for add client feedback
    async function addClientFeedback(){

        try{
            // Getting input data
            let client_first_name = $('#clientFirstName').val().trim();
            let client_last_name = $('#clientLastName').val().trim();
            let client_designation = $('#clientDesignation').val().trim();
            let client_feedback = $('#clientFeedback').val().trim();
            let upload_client_image = $('#uploadClientImage')[0].files[0];
            let portfolio_info_id = $('#portfolioInfoId').val().trim();
            let token = $('#token').val().trim();

            // Front end validation process
            if(client_first_name.length === 0){
                displayToast('warning', 'First name is required');
            } else if(client_last_name.length === 0){
                displayToast('warning', 'Last name is required');
            } else if(client_designation.length === 0){
                displayToast('warning', 'Designation is required');
            } else if(client_feedback.length === 0){
                displayToast('warning', 'Feedback is required');
            } else if(!upload_client_image){
                displayToast('warning', 'Image is required');
            } else{
                // FormData object
                let formData = new FormData();

                // Data append to FormData
                formData.append('client_first_name', client_first_name);
                formData.append('client_last_name', client_last_name);
                formData.append('client_designation', client_designation);
                formData.append('client_feedback', client_feedback);
                formData.append('client_image', upload_client_image);
                formData.append('portfolio_id', portfolio_info_id);
                formData.append('token', token);

                // Pssing data to controller and getting response
                showLoader();
                let response = await axios.post('../addClientFeedbackInfo', formData, {
                    headers:{'content-type':'multipart/form-data'}
                });
                hideLoader();

                if(response.data['status'] === 'success'){
                    // displayToast('success', response.data['message']);
                    $('#feedback-body').addClass('d-none');
                    $('#feedback-message').removeClass('d-none');
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