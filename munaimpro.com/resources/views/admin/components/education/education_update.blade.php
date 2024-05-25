{{-- Edit modal start --}}
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Education</h5>
            </div>
            <div class="modal-body">
                <form id="update-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">
                                <label class="form-label">Education Type *</label>
                                <select class="form-control" id="educationType">
                                    <option value="">Academic Education</option>
                                    <option value="">Technical Education</option>
                                </select>

                                <label class="form-label mt-3">Degree *</label>
                                <input type="text" class="form-control" id="edicationDegree">

                                <label class="form-label mt-3">Institution *</label>
                                <input type="text" class="form-control" id="edicationInstitution">

                                <label class="form-label mt-3">Starting Date *</label>
                                <input type="date" class="form-control" id="startingDate">

                                <label class="form-label mt-3">Ending Date *</label>
                                <input type="date" class="form-control" id="endingDate">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-end">
                <button type="button" class="btn btn-sm btn-submit">Save changes</button>
                <button type="button" class="btn btn-sm btn-cancel" data-bs-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
{{-- Edit modal end --}}