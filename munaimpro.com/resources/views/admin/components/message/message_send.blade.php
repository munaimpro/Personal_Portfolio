{{-- Send Message modal start --}}
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Send Message</h5>
            </div>
            <div class="modal-body">
                <form id="sendMessageForm">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Email</label>
                            <input class="form-control" type="email" id="sendMessageMail">
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Subject</label>
                            <input class="form-control" type="text" id="sendMessageSubject">
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Message</label>
                            <textarea class="contentDetails" id="sendMessageDescription"></textarea>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-end">
                <button type="button" class="btn btn-cancel" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-submit" onclick="sendMessageFromAdmin()">Send</button>
            </div>
        </div>
    </div>
</div>
{{-- Send Message modal end --}}


{{-- Front end script start --}}

<script>
    // Function for sending message
    async function sendMessageFromAdmin(){

        try{
            // Getting input data
            let send_message_mail = $('#sendMessageMail').val().trim();
            let send_message_subject = $('#sendMessageSubject').val().trim();
            let send_message_description = tinymce.get('sendMessageDescription').getContent();

            // Front end validation process
            if(send_message_mail.length === 0){
                displayToast('warning', 'Email address is required');
            } else if(send_message_subject.length === 0){
                displayToast('warning', 'Message subject is required');
            } else if(send_message_description.length === 0){
                displayToast('warning', 'Message body is required');
            } else{
                // Closing modal
                $('#createModal').modal('hide');

                // Assigning send message data to variable in JSON format
                let sendMessageData = {
                    "email" : send_message_mail,
                    "subject" : send_message_subject,
                    "message" : send_message_description,
                }

                // Passing data to controller and getting response
                showLoader();
                let response = await axios.post('/sendMessageFromAdmin', sendMessageData);
                hideLoader();

                if(response.data['status'] === 'success'){
                    // Reset form
                    $('#sendMessageForm')[0].reset();

                    // Call function to refresh message list
                    await retrieveAllMessageInfo();

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
