{{-- Create modal start --}}
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Add Service</h5>
            </div>
            <div class="modal-body">
                <form id="addServiceForm">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Service Name</label>
                                    <input type="text" class="form-control" id="serviceTitle">
                                </div>
                                
                                <div class="form-group">
                                    <label>Service Icon</label>
                                    <select class="form-control" id="serviceIcon">
                                        <option value="<i class='fas fa-phone'></i>">Icon</option>
                                        <option value="<i class='fas fa-phone'></i>">Icon</option>
                                        <option value="<i class='fas fa-phone'></i>">Icon</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Service Description</label>
                                    <textarea class="form-control" id="serviceDescription"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-end">
                <button type="button" class="btn btn-submit" onclick="addServiceInfo()">Add Service</button>
                <button type="button" class="btn btn-cancel" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
{{-- Create modal end --}}


{{-- Front end script start --}}

<script>

    // Function for add service information
    async function addServiceInfo(){
        try{
            // Getting input data
            let service_title = $('#serviceTitle').val().trim();
            let service_icon = $('#serviceIcon').val().trim();
            let service_description = $('#serviceDescription').val().trim();

            // Front end validation process
            if(service_title.length === 0){
                displayToast('warning', 'Service name is required');
            } else if(service_icon === ''){
                displayToast('warning', 'Service icon is required');
            } else if(service_description.length === 0){
                displayToast('warning', 'Service description is required');
            } else{
                // Closing modal
                $('#createModal').modal('hide');

                // Assigning service data to variable in JSON format
                let serviceData = {
                    "service_title" : service_title,
                    "service_icon" : service_icon,
                    "service_description" : service_description,
                }

                // Pssing data to controller and getting response
                showLoader();
                let response = await axios.post('/addServiceInfo', serviceData);
                hideLoader();

                if(response.data['status'] === 'success'){
                    // Reset form
                    $('#addServiceForm')[0].reset();

                    // Call function to refresh service list
                    await retriveAllServiceInfo();

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