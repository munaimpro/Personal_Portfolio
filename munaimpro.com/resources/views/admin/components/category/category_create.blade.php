{{-- Create modal start --}}
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Create Category</h5>
            </div>
            <div class="modal-body">
                <form id="addCategoryForm">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Category Name</label>
                            <input type="text" id="categoryName">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-end">
                <button type="button" class="btn btn-submit" onclick="addCategoryInfo()">Add Category</button>
                <button type="button" class="btn btn-cancel" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
{{-- Create modal end --}}


{{-- Front end script start --}}

<script>

    // Function for add category information
    async function addCategoryInfo(){
        try{
            // Getting input data
            let category_name = $('#categoryName').val().trim();

            // Front end validation process
            if(category_name.length === 0){
                displayToast('warning', 'Category name is required');
            } else{
                // Closing modal
                $('#createModal').modal('hide');

                // Pssing data to controller and getting response
                showLoader();
                let response = await axios.post('/addCategoryInfo', {"category_name" : category_name});
                hideLoader();

                if(response.data['status'] === 'success'){
                    // Reset form
                    $('#addCategoryForm')[0].reset();

                    // Call function to refresh category list
                    await retriveAllCategoryInfo();

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