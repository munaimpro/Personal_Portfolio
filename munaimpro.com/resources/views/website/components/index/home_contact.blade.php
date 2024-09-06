<!-- Contact section -->
<section id="contact" class="contact_wrapper vertical_MK25_w_space">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-12 mb-5">
                <h2 class="section_MK25_first_title">CONTACT</h2>
            </div>

            <div class="col-lg-7 mb-5 mb-lg-0">
                <div class="contact_MK25_form">
                    <p>I am always open to discuss about <span>web application development</span></p>
                    <form class="row g-3" id="sendMessageForm">
                        <div class="col-md-6">
                            <input placeholder="Name" type="text" class="form-control" id="sendMessageName">
                        </div>
                        <div class="col-md-6">
                            <input placeholder="Email" type="email" class="form-control" id="sendMessageMail">
                        </div>
                        <div class="col-12">
                            <input placeholder="Subject" type="text" class="form-control" id="sendMessageSubject">
                        </div>
                        <div class="col-12">
                            <textarea placeholder="Message" class="form-control" id="sendMessageDescription"></textarea>
                        </div>
                        <div class="col-12">
                            <button type="button" class="btn primary-btn" onclick="sendMessageFromWebsite()">Send Message <i class="fa-regular fa-paper-plane"></i></button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-lg-5 mb-5 mb-lg-0">
            <div class="contact_MK25_info">
                <h2>For Enqueries</h2>
                <div class="contact_widget_item">
                <div class="contact_widget_item_icon">
                    <i class="fa-solid fa-location-dot"></i>
                </div>
                <div class="contact_widget_item_text">
                    <p class="m-0 mb-2 contact_widget_item_title">Locatoin</p>
                    <p class="m-0" id="websiteHomeContactLocation"></p>
                </div>
                </div>
                <div class="contact_widget_item">
                <div class="contact_widget_item_icon">
                    <i class="fa-solid fa-envelope"></i>
                </div>
                <div class="contact_widget_item_text">
                    <p class="m-0 mb-2 contact_widget_item_title">Email</p>
                    <p class="m-0" id="websiteHomeContactEmail"></p>
                </div>
                </div>
                <div class="contact_widget_item">
                <div class="contact_widget_item_icon">
                    <i class="fa-solid fa-phone"></i>
                </div>
                <div class="contact_widget_item_text">
                    <p class="m-0 mb-2 contact_widget_item_title">Phone</p>
                    <p class="m-0" id="websiteHomeContactPhone"></p>
                </div>
                </div>
                <div class="social_links">
                    <div class="d-none" id="contactWidgetTitle">
                        <p class="mb-2 contact_widget_item_title">Follow me on social</p>
                    </div>
                    <div class="d-flex" id="contactSocialLinks">
                        
                    </div>
                </div>
            </div>
            
            </div>
        </div>
    </div>
</section>


{{-- Front end script start --}}

<script>
    // Function for sending message from website
    async function sendMessageFromWebsite(){

        try{
            // Getting input data
            let send_message_name = $('#sendMessageName').val().trim();
            let send_message_mail = $('#sendMessageMail').val().trim();
            let send_message_subject = $('#sendMessageSubject').val().trim();
            let send_message_description = $('#sendMessageDescription').val().trim();

            // Regular expression for basic email validation
            let emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            // Front end validation process
            if(send_message_name.length === 0){
                displayToast('warning', 'Name is required');
            } else if(send_message_mail.length === 0){
                displayToast('warning', 'Email address is required');
            } else if(!emailPattern.test(send_message_mail)){
                displayToast('warning', 'Invalid email address');
            } else if(send_message_subject.length === 0){
                displayToast('warning', 'Message subject is required');
            } else if(send_message_description.length === 0){
                displayToast('warning', 'Message is required');
            } else{
                // Assigning send message data to variable in JSON format
                let sendMessageData = {
                    "name" : send_message_name,
                    "email" : send_message_mail,
                    "subject" : send_message_subject,
                    "message" : send_message_description,
                }

                // Passing data to controller and getting response
                showLoader();
                let response = await axios.post('/sendMessageFromWebsite', sendMessageData);
                hideLoader();

                if(response.data['status'] === 'success'){
                    // Reset contact form
                    $('#sendMessageForm')[0].reset();

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