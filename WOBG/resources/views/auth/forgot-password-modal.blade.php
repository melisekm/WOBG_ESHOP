<div class="modal fade" id="forgotPasswordModal" tabindex="-1" aria-labelledby="forgotPasswordModal"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{route("password.email")}}">
                @csrf
                <div class="modal-header">
                    <div class="modal-title fs-5" id="exampleModalLabel">Reset Password</div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row ">
                            <p class="modal-p"> We will send you an email to reset your
                                password. </p>
                            <div class="mb-3">
                                <label for="pwResetEmail" class="modal-label">Email</label>
                                <input type="email" id="pwResetEmail" class="form-control"
                                       name="email" required autofocus>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-blue" data-bs-dismiss="modal">Send</button>
                </div>
            </form>
        </div>
    </div>
</div>
