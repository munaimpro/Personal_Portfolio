{{-- Create modal start --}}
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Add Project</h5>
            </div>
            <div class="modal-body">
                <div class="col-lg-12">
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text">
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="form-group">
                        <label>Project Type</label>
                        <input type="text">
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="form-group">
                        <label>Category</label>
                        <select class="form-control" id="">
                            <option value="">Category Name</option>
                            <option value="">Category Name</option>
                            <option value="">Category Name</option>
                        </select>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="form-group">
                        <label>Starting Date</label>
                        <input type="date">
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="form-group">
                        <label>Ending Date</label>
                        <input type="date">
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="form-group">
                        <label>URL</label>
                        <input type="text">
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="form-group">
                        <label>Core Technologies</label>
                        <input type="text">
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control" name="content" id="postDescription"></textarea>
                    </div>
                </div>

                <div class="col-lg-12">
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
                </div>

                <div class="col-lg-12">
                    <div class="form-group">
                        <label>UI Image</label>
                        <div class="image-upload">
                            <input type="file">
                            <div class="image-uploads">
                                <img src="{{ asset('assets/img/icons/upload.svg') }}" alt="img">
                                <h4>Drag and drop a file to upload</h4>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="form-group">
                        <label>Client Name</label>
                        <input type="text">
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="form-group">
                        <label>Client Designation</label>
                        <input type="text">
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="form-group">
                        <label>Client Institution</label>
                        <input type="text">
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-end">
                <button type="button" class="btn btn-cancel" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-submit">Add</button>
            </div>
        </div>
    </div>
</div>
{{-- Create modal end --}}