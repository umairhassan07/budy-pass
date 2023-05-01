<!-- logout modal -->
<div class="modal fade" id="logout_modal" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="logout_inner">
                    <div class="tick-div">
                        <i class="fi fi-rr-sign-out-alt"></i>
                    </div>
                    <h5>logout</h5>
                    <p>are you sure you want to logout of your account?</p>
                    <div class="btn-grp-logout">
                        <button class="cancel" data-bs-dismiss="modal" aria-label="Close">cancel</button>
                        <a href="{{ route('logout') }}" class="logout">logout</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
