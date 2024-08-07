{{-- Edit modal start --}}
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">SEO Properties</h5>
            </div>
            <div class="modal-body">
                <form id="update-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">
                                <div class="form-group">
                                    <label class="form-label">Title *</label>
                                    <input type="text" class="form-control" id="siteTitle">
                                </div>

                                <div class="form-group">
                                    <label class="form-label mt-3">Keywords *</label>
                                    <input type="text" class="form-control" id="siteKeywords">
                                </div>

                                <div class="form-group">
                                    <label class="form-label mt-3">Description *</label>
                                    <textarea class="form-control" id="siteDescription"></textarea>
                                </div>
                                
                                <div class="form-group">
                                    <label class="form-label mt-3">Open Graph Website Name *</label>
                                    <input type="text" class="form-control" id="ogSitename">
                                </div>

                                <div class="form-group">
                                    <label class="form-label mt-3">Open Graph Website Title *</label>
                                    <input type="text" class="form-control" id="ogSitetitle">
                                </div>

                                <div class="form-group">
                                    <label class="form-label mt-3">Open Graph Website URL *</label>
                                    <input type="text" class="form-control" id="ogSiteURL">
                                </div>

                                <div class="form-group">
                                    <label class="form-label mt-3">Open Graph Website Image *</label>
                                    <input type="file" class="form-control" id="ogSiteimage">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-end">
                <button type="button" class="btn btn-sm btn-submit">Save changes</button>
                <button type="button" class="btn btn-sm btn-cancel" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
{{-- Edit modal end --}}