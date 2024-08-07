{{-- Edit modal start --}}
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Update Post</h5>
            </div>
            <div class="modal-body">
                <div class="col-lg-12">
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text">
                    </div>

                    <div class="form-group">
                        <label>Slug</label>
                        <input type="text">
                    </div>

                    <div class="form-group">
                        <label>Category</label>
                        <select class="form-control" id="">
                            <option value="">Category Name</option>
                            <option value="">Category Name</option>
                            <option value="">Category Name</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Thumbnail</label>
                        <div class="image-upload">
                            <input type="file">
                            <div class="image-uploads">
                                <img src="{{ asset('assets/img/icons/upload.svg') }}" alt="img">
                                <h4>Drag and drop a file to upload</h4>
                            </div>
                        </div>
                    </div>

                    <div class="product-list">
                        <ul class="row">
                            <li class="ps-0">
                                <div class="productviewset">
                                    <div class="productviewsimg">
                                        <img src="{{ asset('assets/img/customer/profile2.jpg') }}" alt="img">
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control" id="postDescription"></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-end">
                <button type="button" class="btn btn-cancel" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-submit">Save Changes</button>
            </div>
        </div>
    </div>
</div>
{{-- Edit modal end --}}