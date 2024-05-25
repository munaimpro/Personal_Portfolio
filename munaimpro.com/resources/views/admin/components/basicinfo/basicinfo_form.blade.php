<!-- Page header start -->
<div class="page-header">
    <div class="page-title">
        <h4>Basic Information</h4>
        <h6>Used for hero section and contact information</h6>
    </div>
</div>
<!-- Page header end -->

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-lg-6 col-sm-6 col-12">
                <div class="form-group">
                    <label>Greetings</label>
                    <input type="text" spellcheck="false" data-ms-editor="true">
                </div>
            </div>

            <div class="col-lg-6 col-sm-6 col-12">
                <div class="form-group">
                    <label>Full Name</label>
                    <input type="text" spellcheck="false" data-ms-editor="true">
                </div>
            </div>

            <div class="col-lg-6 col-sm-6 col-12">
                <div class="form-group">
                    <label>Designation</label>
                    <input type="text" spellcheck="false" data-ms-editor="true">
                </div>
            </div>

            <div class="col-lg-6 col-sm-6 col-12">
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control" spellcheck="false" data-ms-editor="true">
                </div>
            </div>

            <div class="col-lg-6 col-sm-6 col-12">
                <div class="form-group">
                    <label>Phone</label>
                    <input type="phone" class="form-control" spellcheck="false" data-ms-editor="true">
                </div>
            </div>

            <div class="col-lg-6 col-sm-6 col-12">
                <div class="form-group">
                    <label>Location</label>
                    <textarea class="form-control" spellcheck="false" data-ms-editor="true"></textarea>
                </div>
            </div>

            <div class="col-lg-12 col-sm-6 col-12">
                <div class="form-group">
                    <label>Hero Description</label>
                    <textarea class="form-control" spellcheck="false" data-ms-editor="true"></textarea>
                </div>
            </div>

            <div class="col-lg-12 col-sm-12 col-12">
                <div class="form-group">
                    <label>Hero Image</label>
                    <div class="product-list">
                        <ul>
                            <li class="p-0">
                                <div class="productviews">
                                    <div class="productviewsimg">
                                        <img class="mw-100 mh-100" src="{{ asset('assets/img/profiles/avatar-17.jpg') }}" alt="website logo">
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <div class="image-upload ">
                        <input type="file">
                        <div class="image-uploads">
                            <img src="{{ asset('assets/img/icons/upload.svg') }}" alt="img">
                            <h4>Drag and drop a file to upload</h4>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-12 col-sm-6 col-12">
                <div class="form-group">
                    <label>About Description</label>
                    <textarea class="form-control" spellcheck="false" data-ms-editor="true"></textarea>
                </div>
            </div>

            <div class="col-lg-12 col-sm-12 col-12">
                <div class="form-group">
                    <label>About Image</label>
                    <div class="product-list">
                        <ul>
                            <li class="p-0">
                                <div class="productviews">
                                    <div class="productviewsimg">
                                        <img class="mw-100 mh-100" src="{{ asset('assets/img/profiles/avatar-17.jpg') }}" alt="website logo">
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <div class="image-upload ">
                        <input type="file">
                        <div class="image-uploads">
                            <img src="{{ asset('assets/img/icons/upload.svg') }}" alt="img">
                            <h4>Drag and drop a file to upload</h4>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <button class="btn btn-submit me-2">Update</button>
                <button class="btn btn-cancel">Cancel</button>
            </div>
        </div>
    </div>
</div>