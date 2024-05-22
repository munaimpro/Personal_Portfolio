{{-- Edit modal start --}}
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Award</h5>
            </div>
            <div class="modal-body">
                <form id="update-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">
                                <label class="form-label">Award Type *</label>
                                <select class="form-control" id="AwardType">
                                    <option value="">Programming Award</option>
                                    <option value="">Technical Award</option>
                                    <option value="">Other Award</option>
                                </select>

                                <label class="form-label mt-3">Award Name *</label>
                                <input type="text" class="form-control" id="awardName">

                                <label class="form-label mt-3">Award Issue Date *</label>
                                <input type="date" class="form-control" id="awardDate">

                                <label class="form-label mt-3">Award Provider *</label>
                                <input type="text" class="form-control" id="awardProvider">

                                <label class="form-label mt-3">Award For *</label>
                                <textarea class="form-control" id="awardFor"></textarea>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-end">
                <button type="button" class="btn btn-sm btn-primary">Save changes</button>
                <button type="button" class="btn btn-sm btn-danger" data-bs-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
{{-- Edit modal end --}}