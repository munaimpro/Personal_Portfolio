{{-- Edit modal start --}}
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Update Service</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="updateServiceForm">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Service Name</label>
                                    <input type="text" class="form-control" id="updateServiceTitle">
                                </div>
                                
                                <div class="form-group">
                                    <label>Service Icon</label>
                                    <select class="select" id="updateServiceIcon">
                                        <option value="<i class='fas fa-phone'></i>">Icon</option>
                                        <option value="<i class='fas fa-phone'></i>">Icon</option>
                                        <option value="<i class='fas fa-phone'></i>">Icon</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Service Description</label>
                                    <textarea class="form-control" id="updateServiceDescription"></textarea>
                                </div>
                                
                                <div class="form-group">
                                    <label>Service Status</label>
                                    <select class="select" id="updateServiceStatus">
                                        <option value="1">Activate</option>
                                        <option value="0">Deactivate</option>
                                    </select>
                                </div>

                                <input type="text" class="form-control" id="serviceInfoId">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-end">
                <button type="button" class="btn btn-submit" onclick="updateServiceInfo()">Save Changes</button>
                <button type="button" class="btn btn-cancel" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
{{-- Edit modal end --}}


{{-- Front end script start --}}

<script>
    // Function for retrieve service details
    async function retrieveServiceInfoById(service_info_id){

        try{
            // Assigning id to hidden field
            $('#serviceInfoId').val(service_info_id);

            // Pssing id to controller and getting response
            showLoader();
            let response = await axios.post('/retrieveServiceInfoById', {service_info_id:service_info_id});
            hideLoader();

            if(response.data['status'] === 'success'){
                // Assigning retrieved values
                $('#updateServiceTitle').val(response.data.data['service_title']);
                $('#updateServiceIcon').val(response.data.data['service_icon']);
                $('#updateServiceDescription').val(response.data.data['service_description']);
                
                // Iterate through the options and add `selected` attribute to the correct one
                $('#updateServiceStatus option').each(function() {
                    if ($(this).val() == response.data.data['service_status']) {
                        $(this).prop('selected', true);
                    }
                });
            } else{
                displayToast('error', response.data['message']);
            }
        } catch(e){
            console.error('Something went wrong', e);
        }
    }

    // Function for update service details
    async function updateServiceInfo() {
        try{
            // Getting input data
            let service_title = $('#updateServiceTitle').val().trim();
            let service_icon = $('#updateServiceIcon').val().trim();
            let service_description = $('#updateServiceDescription').val().trim();
            let service_status = $('#updateServiceStatus').val().trim();
            let service_info_id = $('#serviceInfoId').val().trim();

            // Front end validation process
            if(service_title.length === 0){
                displayToast('warning', 'Service title is required');
            } else if(service_icon === ''){
                displayToast('warning', 'Service icon is required');
            } else if(service_description.length === 0){
                displayToast('warning', 'Service description is required');
            } else{
                // Closing modal
                $('#editModal').modal('hide');

                // Assigning service data to variable in JSON format
                let serviceData = {
                    "service_title" : service_title,
                    "service_icon" : service_icon,
                    "service_description" : service_description,
                    "service_status" : service_status,
                    "service_info_id" : service_info_id,
                }

                // Pssing data to controller and getting response
                showLoader();
                let response = await axios.put('/updateServiceInfo', serviceData);
                hideLoader();

                if(response.data['status'] === 'success'){
                    // Reset form
                    $('#updateServiceForm')[0].reset();

                    // Call function to refresh service list
                    await retrieveAllServiceInfo();

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