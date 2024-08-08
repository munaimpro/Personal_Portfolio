{{-- Edit modal start --}}
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Update Service</h5>
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
                                    <select class="form-control" id="updateServiceIcon">
                                        <option value="<i class='fas fa-phone'></i>">Icon</option>
                                        <option value="<i class='fas fa-phone'></i>">Icon</option>
                                        <option value="<i class='fas fa-phone'></i>">Icon</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Service Description</label>
                                    <textarea id="updateServiceDescription"></textarea>
                                </div>
                                
                                <div class="form-group">
                                    <label>Service Status</label>
                                    <select class="form-control" id="updateServiceStatus">
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
    // Function for retrive service details
    async function retriveServiceInfoById(service_info_id){

        try{
            // Assigning id to hidden field
            document.getElementById('serviceInfoId').value = service_info_id;

            // Pssing id to controller and getting response
            showLoader();
            let response = await axios.post('/retriveServiceInfoById', {service_info_id:service_info_id});
            hideLoader();

            if(response.data['status'] === 'success'){
                // Assigning retrived values
                document.getElementById('updateServiceTitle').value = response.data.data['service_title'];
                document.getElementById('updateServiceIcon').value = response.data.data['service_icon'];
                document.getElementById('updateServiceDescription').value = response.data.data['service_description'];
                document.getElementById('updateServiceStatus').value = response.data.data['service_status'];
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