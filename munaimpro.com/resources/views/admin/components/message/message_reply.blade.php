{{-- Reply Message modal start --}}
<div class="modal fade" id="replyModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Reply Message</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="replyMessageForm">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Email</label>
                            <input readonly class="form-control" type="email" id="replyMessageMail">
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Subject</label>
                            <input class="form-control" type="text" id="replyMessageSubject">
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Message</label>
                            <textarea class="contentDetails" id="replyMessageDescription"></textarea>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-end">
                <button type="button" class="btn btn-cancel" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-submit" onclick="replyMessageFromAdmin()">Send</button>
            </div>
        </div>
    </div>
</div>
{{-- Reply Message modal end --}}


{{-- Front end script start --}}

<script>
    // Function for reply message
    async function replyMessageFromAdmin(){

        try{
            // Getting input data
            let reply_message_mail = $('#replyMessageMail').val().trim();
            let reply_message_subject = $('#replyMessageSubject').val().trim();
            let reply_message_description = tinymce.get('replyMessageDescription').getContent();

            // Front end validation process
            if(reply_message_mail.length === 0){
                displayToast('warning', 'Email address is required');
            } else if(reply_message_subject.length === 0){
                displayToast('warning', 'Message subject is required');
            } else if(reply_message_description.length === 0){
                displayToast('warning', 'Message body is required');
            } else{
                // Closing modal
                $('#replyModal').modal('hide');

                // Assigning reply message data to variable in JSON format
                let replyMessageData = {
                    "email" : reply_message_mail,
                    "subject" : reply_message_subject,
                    "message" : reply_message_description,
                }

                // Pssing id to controller and getting response
                showLoader();
                let response = await axios.post('/replyMessageFromAdmin', replyMessageData);
                hideLoader();

                if(response.data['status'] === 'success'){
                    // Reset form
                    $('#replyMessageForm')[0].reset();

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