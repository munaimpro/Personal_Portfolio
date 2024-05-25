{{-- Page header - Website Logo start --}}

<div class="page-header">
    <div class="page-title">
        <h4>Website Logo</h4>
        <h6>Used as website and admin panel logo</h6>
    </div>
</div>

{{-- Page header - Website Logo end --}}

{{-- Logo section start --}}
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-lg-12 col-sm-6 col-12">
                <div class="form-group">
                    <label>Logo</label>
                    <div class="product-list">
                        <ul>
                            <li class="p-0">
                                <div class="productviews">
                                    <div class="productviewsimg">
                                        <img class="mw-100 mh-100" src="{{ asset('assets/img/logo.png') }}" alt="website logo">
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
            <button class="btn btn-submit me-2">Upload</button>
            <button class="btn btn-cancel">Cancel</button>
        </div>
        </div>
    </div>
</div>
{{-- Logo section end --}}