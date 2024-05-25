{{-- Edit modal start --}}
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Update User</h5>
            </div>
            <div class="modal-body">
                <div class="col-lg-12">
                    <div class="form-group">
                        <label>First Name</label>
                        <input type="text">
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="form-group">
                        <label>Last Name</label>
                        <input type="text">
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="form-group">
                        <label>User Name</label>
                        <input type="text">
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="form-group">
                        <label>Password</label>
                        <div class="pass-group">
                            <input type="password" class=" pass-input">
                            <span class="fas toggle-password fa-eye-slash"></span>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="form-group">
                        <label>Phone</label>
                        <input type="text">
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text">
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="form-group">
                        <label>Role</label>
                        <select class="form-control">
                            <option>Select</option>
                            <option>Owner</option>
                        </select>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="form-group">
                        <label> User Image</label>
                        <div class="image-upload">
                            <input type="file">
                            <div class="image-uploads">
                            <img src="assets/img/icons/upload.svg" alt="img">
                            <h4>Drag and drop a file to upload</h4>
                        </div>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="product-list">
                        <ul class="row">
                            <li class="ps-0">
                                <div class="productviewset">
                                    <div class="productviewsimg">
                                        <img src="assets/img/customer/profile2.jpg" alt="img">
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-end">
                <button type="button" class="btn btn-submit">Update details</button>
                <button type="button" class="btn btn-cancel" data-bs-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
{{-- Edit modal end --}}