{{-- View modal start --}}
<div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="viewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewModalLabel">Client Feedback</h5>
            </div>
            <div class="modal-body">
                <div class="product-list">
                    <ul class="row">
                        <li class="ps-0">
                            <div class="productviewset">
                                <div class="productviewsimg">
                                    <img src="{{ asset('assets/img/customer/profile2.jpg') }}" alt="img" id="clientImage">
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>

                <div class="col-lg-12">
                    <div class="form-group">
                        <label>First Name</label>
                        <input type="text" class="form-control" id="clientFirstName">
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" class="form-control" id="clientLastName">
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="form-group">
                        <label>Designation</label>
                        <input type="text" class="form-control" id="clientDesignation">
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="form-group">
                        <label>Project</label>
                        <input type="text" class="form-control" id="clientProject">
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="form-group">
                        <label>Feedback</label>
                        <textarea class="form-control" id="clientFeedback"></textarea>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="form-group">
                        <label>Date</label>
                        <input type="text" class="form-control" id="clientFeedbackDate">
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-end">
                <button type="button" class="btn btn-cancel" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-submit" data-bs-dismiss="modal">Ok</button>
            </div>
        </div>
    </div>
</div>
{{-- View modal end --}}


{{-- Front end script start --}}

<script>

    // Function for retrive client feedback details

    async function retrieveClientFeedbackInfoById(clientfeedback_info_id){

        try{
            // Pssing id to controller and getting response
            showLoader();
            let response = await axios.post('../retrieveClientFeedbackInfoById', {clientfeedback_info_id:clientfeedback_info_id});
            hideLoader();

            console.log(response.data.data);

            if(response.data['status'] === 'success'){
                // Getting base URL of the system
                let baseUrl = "{{ url('/') }}";
                
                // Generating full path for the client image
                let clientImageFullPath = baseUrl + '/storage/profile_picture/client_images/' + response.data.data['client_image'];

                // Formatting the client feedback created at date
                let feedbackDate = new Date(response.data.data['created_at']);
                let formattedfeedbackDate = feedbackDate.toLocaleDateString('en-US', {
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric',
                    hour: '2-digit',
                    minute: '2-digit'
                });
            
                // Assigning retrived values
                $('#clientFirstName').val(response.data.data['client_first_name']);
                $('#clientLastName').val(response.data.data['client_last_name']);
                $('#clientDesignation').val(response.data.data['client_designation']);
                $('#clientFeedback').val(response.data.data['client_feedback']);
                $('#clientFeedbackDate').val(formattedfeedbackDate);
                $('#clientProject').val(response.data.data.portfolio['project_title']);
                $('#clientImage')[0].src = clientImageFullPath;
            } else{
                displayToast('error', response.data['message']);
            }
        } catch(e){
            console.error('Something went wrong', e);
        }
    }

</script>

{{-- Front end script end --}}