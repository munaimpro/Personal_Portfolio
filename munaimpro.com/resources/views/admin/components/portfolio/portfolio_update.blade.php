{{-- Edit modal start --}}
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Update Project</h5>
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
                        <textarea class="form-control" id="postDescription"></textarea>
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

                <div class="col-12">
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

                <div class="col-12">
                    <div class="product-list">
                        <ul class="row">
                            <li class="ps-0">
                                <div class="productviewset">
                                    <div class="productviewsimg">
                                        <img src="{{ asset('assets/img/customer/profile2.jpg') }}" alt="img">
                                    </div>
                                    <div class="productviewscontent">
                                        <a href="javascript:void(0);" class="hideset"><i class="fa fa-trash-alt"></i></a>
                                    </div>
                                </div>
                            </li>

                            <li class="ps-0">
                                <div class="productviewset">
                                    <div class="productviewsimg">
                                        <img src="{{ asset('assets/img/customer/profile2.jpg') }}" alt="img">
                                    </div>
                                    <div class="productviewscontent">
                                        <a href="javascript:void(0);" class="hideset"><i class="fa fa-trash-alt"></i></a>
                                    </div>
                                </div>
                            </li>

                            <li class="ps-0">
                                <div class="productviewset">
                                    <div class="productviewsimg">
                                        <img src="{{ asset('assets/img/customer/profile2.jpg') }}" alt="img">
                                    </div>
                                    <div class="productviewscontent">
                                        <a href="javascript:void(0);" class="hideset"><i class="fa fa-trash-alt"></i></a>
                                    </div>
                                </div>
                            </li>
                        </ul>
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
                <button type="button" class="btn btn-submit">Update</button>
            </div>
        </div>
    </div>
</div>
{{-- Edit modal end --}}