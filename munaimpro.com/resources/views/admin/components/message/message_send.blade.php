{{-- Create Message modal start --}}
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Message</h5>
            </div>
            <div class="modal-body">
                <div class="col-lg-12">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text">
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email">
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="form-group">
                        <label>Subject</label>
                        <input type="text">
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="form-group">
                        <label>Message</label>
                        <textarea class="form-control" id="messageDescription"></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-end">
                <button type="button" class="btn btn-cancel" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-submit">Send</button>
            </div>
        </div>
    </div>
</div>
{{-- Create Message modal end --}}