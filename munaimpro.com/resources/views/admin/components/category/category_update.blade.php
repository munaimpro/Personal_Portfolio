{{-- Edit modal start --}}
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Update Category</h5>
            </div>
            <div class="modal-body">
                <form id="updateCategoryForm">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label>Category Name</label>
                            <input type="text" id="updateCategoryName">
                        </div>

                        <input type="text" class="form-control" id="categoryInfoId">
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-end">
                <button type="button" class="btn btn-submit" onclick="updateCategoryInfo()">Save Changes</button>
                <button type="button" class="btn btn-cancel" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
{{-- Edit modal end --}}


{{-- Front end script start --}}

<script>
    // Function for retrive category details
    async function retriveCategoryInfoById(category_info_id){

        try{
            // Assigning id to hidden field
            document.getElementById('categoryInfoId').value = category_info_id;

            // Pssing id to controller and getting response
            showLoader();
            let response = await axios.post('/retriveCategoryInfoById', {category_info_id:category_info_id});
            hideLoader();

            if(response.data['status'] === 'success'){
                // Assigning retrived values
                document.getElementById('updateCategoryName').value = response.data.data['category_name'];
            } else{
                displayToast('error', response.data['message']);
            }
        } catch(e){
            console.error('Something went wrong', e);
        }
    }

    // Function for update category details
    async function updateCategoryInfo() {
        try{
            // Getting input data
            let category_name = $('#updateCategoryName').val().trim();
            let category_info_id = $('#categoryInfoId').val().trim();

            // Front end validation process
            if(category_name.length === 0){
                displayToast('warning', 'Category name is required');
            } else{
                // Closing modal
                $('#editModal').modal('hide');

                // Assigning category data to variable in JSON format
                let categoryData = {
                    "category_name" : category_name,
                    "category_info_id" : category_info_id,
                }

                // Pssing data to controller and getting response
                showLoader();
                let response = await axios.put('/updateCategoryInfo', categoryData);
                hideLoader();

                if(response.data['status'] === 'success'){
                    // Reset form
                    $('#updateCategoryForm')[0].reset();

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