{{-- View Message modal start --}}
<div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Inbox Message</h5>
            </div>
            <div class="modal-body">
                <div class="col-lg-12">
                    <div class="form-group">
                        <label>Name</label>
                        <input class="form-control" type="text" id="messageClientName">
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="form-group">
                        <label>Email</label>
                        <input class="form-control" type="email" id="messageMail">
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="form-group">
                        <label>Subject</label>
                        <input class="form-control" type="text" id="messageSubject">
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="form-group">
                        <label>Message</label>
                        <textarea class="contentDetails" id="messageDescription"></textarea>
                    </div>
                </div>

                <input type="text" id="messageInfoId">
            </div>
            <div class="modal-footer justify-content-end">
                <button type="button" class="btn btn-cancel" data-bs-dismiss="modal">Ok</button>
                <button type="button" class="btn btn-submit" data-bs-toggle="modal" data-bs-target="#replyModal">Reply</button>
            </div>
        </div>
    </div>
</div>
{{-- View Message modal end --}}


{{-- Front end script start --}}

<script>
    // Function for retrive message details
    async function retriveMessageInfoById(message_info_id, message_info_action){

        try{
            // Assigning id to hidden field
            document.getElementById('messageInfoId').value = message_info_id;

            // Pssing id to controller and getting response
            showLoader();
            let response = await axios.post('/retriveMessageInfoById', {message_info_id:message_info_id, message_info_action:message_info_action});
            hideLoader();

            if(response.data['status'] === 'success'){
                // Assigning retrived values
                document.getElementById('messageClientName').value = response.data.data['name'];
                document.getElementById('messageMail').value = response.data.data['email'];
                document.getElementById('replyMessageMail').value = response.data.data['email'];
                document.getElementById('messageSubject').value = response.data.data['subject'];
                tinymce.get('messageDescription').setContent(response.data.data['message']);
                
                // Call function to refresh message list
                await retrieveAllMessageInfo();
            } else{
                displayToast('error', response.data['message']);
            }
        } catch(e){
            console.error('Something went wrong', e);
        }
    }
</script>

{{-- Front end script end --}}