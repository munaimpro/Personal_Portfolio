{{-- View Message modal start --}}
<div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Visitor Details</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-lg-12">
                    <div class="form-group">
                        <label>IP Address</label>
                        <input class="form-control" type="text" id="visitorIPAddress">
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="form-group">
                        <label>Country</label>
                        <input class="form-control" type="text" id="visitorCountry">
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="form-group">
                        <label>City</label>
                        <input class="form-control" type="text" id="visitorCity">
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="form-group">
                        <label>Device Type</label>
                        <input class="form-control" type="text" id="visitorDeviceType">
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="form-group">
                        <label>Operating System</label>
                        <input class="form-control" type="text" id="visitorOperatingSystem">
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="form-group">
                        <label>Browser Type</label>
                        <input class="form-control" type="text" id="visitorBrowser">
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="form-group">
                        <label>Screen Resolution</label>
                        <input class="form-control" type="text" id="visitorScreenResolution">
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-end">
                <button type="button" class="btn btn-submit" data-bs-dismiss="modal">Ok</button>
            </div>
        </div>
    </div>
</div>
{{-- View Message modal end --}}


{{-- Front end script start --}}

<script>
    // Function for retrieve visitor details
    async function retrieveVisitorInfoById(visitor_info_id){

        try{
            // Pssing id to controller and getting response
            showLoader();
            let response = await axios.post('/retrieveVisitorInfoById', {visitor_info_id:visitor_info_id});
            hideLoader();

            if(response.data['status'] === 'success'){
                // Assigning retrieved values
                document.getElementById('visitorIPAddress').value = response.data.data['ip_address'];
                document.getElementById('visitorCountry').value = response.data.data['visitor_country'];
                document.getElementById('visitorCity').value = response.data.data['visitor_city'];
                document.getElementById('visitorDeviceType').value = response.data.data['visitor_device_type'];
                document.getElementById('visitorOperatingSystem').value = response.data.data['visitor_operating_system'];
                document.getElementById('visitorBrowser').value = response.data.data['visitor_browser'];
                document.getElementById('visitorScreenResolution').value = response.data.data['visitor_screen_resolution'];
            } else{
                displayToast('error', response.data['message']);
            }
        } catch(e){
            console.error('Something went wrong', e);
        }
    }
</script>

{{-- Front end script end --}}