<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Login with PGLife</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="login-form" class="form" role="form" method="post" action="api/login_submit.php">
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="inputGroup-sizing-default"><i class="fas fa-user"></i>
                        </span>
                        <input required type="text" name="email" class="form-control" placeholder="Email" aria-label="Sizing example input"
                            aria-describedby="inputGroup-sizing-default">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="inputGroup-sizing-default"><i
                                class="fas fa-solid fa-lock"></i>
                        </span>
                        <input required type="password" name="password" class="form-control" placeholder="Password" aria-label="Sizing example input"
                            aria-describedby="inputGroup-sizing-default">
                    </div>
                    <div class="input-group mb-3">
                        <button class="btn btn-info">Login</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <p style="text-align: center;"><a href="#" data-bs-toggle="modal" data-bs-target="#signupModal"
                        data-bs-dismiss="modal">Click here</a> to register a new account</p>
            </div>
        </div>
    </div>
</div>