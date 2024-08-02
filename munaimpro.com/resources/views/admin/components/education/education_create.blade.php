{{-- Create modal start --}}
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Create Education</h5>
            </div>
            <div class="modal-body">
                <form id="update-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">
                                <label class="form-label">Education Type *</label>
                                <select class="form-control" id="educationType">
                                    <option value="Academic">Academic Education</option>
                                    <option value="Technical">Technical Education</option>
                                </select>

                                <label class="form-label mt-3">Degree *</label>
                                <input type="text" class="form-control" id="educationDegree">

                                <label class="form-label mt-3">Institution *</label>
                                <input type="text" class="form-control" id="educationInstitution">

                                <label class="form-label mt-3">Starting Date *</label>
                                <input type="date" class="form-control" id="educationStartingDate">

                                <label class="form-label mt-3">Ending Date *</label>
                                <input type="date" class="form-control" id="educationEndingDate">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-end">
                <button type="button" class="btn btn-sm btn-submit">Create education</button>
                <button type="button" class="btn btn-sm btn-cancel" data-bs-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
{{-- Create modal end --}}


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

    // Function for add education information
    async function addEducationInformation(){

        try{
            // Getting input data
            let education_type = $('#educationType').val().trim();
            let education_degree = $('#educationDegree').val().trim();
            let education_institution = $('#educationInstitution').val().trim();
            let education_starting_date = $('#educationStartingDate').val().trim();
            let education_ending_date = $('#educationEndingDate').val().trim();

            // Front end validation process
            if(education_type.length === 0){
                displayToast('warning', 'Education type is required');
            } else if(education_degree.length === 0){
                displayToast('warning', 'Education degree is required');
            } else if(education_institution.length === 0){
                displayToast('warning', 'Education institution is required');
            } else if(education_starting_date === 0){
                displayToast('warning', 'Education starting date is required');
            } else{
                // FormData object
                let formData = new FormData();

                // Data append to FormData
                formData.append('first_name', user_first_name);
                formData.append('last_name', user_last_name);
                formData.append('email', user_email);
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
</script>

{{-- Front end script end --}}