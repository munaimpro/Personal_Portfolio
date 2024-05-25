{{-- Create modal start --}}
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Create Experience</h5>
            </div>
            <div class="modal-body">
                <form id="save-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">
                                <label class="form-label">Designation *</label>
                                <input type="text" class="form-control" id="experienceTitle">

                                <label class="form-label mt-3">Working Place *</label>
                                <input type="text" class="form-control" id="experienceInstitution">

                                <label class="form-label mt-3">Starting Date *</label>
                                <input type="text" class="form-control" id="starttingDate">

                                <label class="form-label mt-3">Ending Date *</label>
                                <input type="text" class="form-control" id="endingDate">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-end">
                <button type="button" class="btn btn-sm btn-submit">Create Experience</button>
                <button type="button" class="btn btn-sm btn-cancel" data-bs-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
{{-- Create modal end --}}