{{-- Edit modal start --}}
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Change Password</h5>
            </div>
            <div class="modal-body">
                <div class="col-lg-12">
                    <div class="form-group">
                        <label>Current Password</label>
                        <input readonly type="password" id="currentPassword">
                    </div>

                    <div class="form-group">
                        <label>New Password</label>
                        <div class="pass-group">
                            <input type="password" class="pass-input" id="userPassword">
                            <span class="fas toggle-password fa-eye-slash"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Confirm Password</label>
                        <div class="pass-group">
                            <input type="password" class="pass-input" id="userConfirmPassword">
                            <span class="fas toggle-password fa-eye-slash"></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-end">
                <button type="button" class="btn btn-submit" onclick="resetUserPassword()">Reset</button>
                <button type="button" class="btn btn-cancel" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
{{-- Edit modal end --}}