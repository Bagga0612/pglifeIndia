<div class="modal fade" id="signupModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Signup with PGLife</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="signup-form" class="form" role="form" method="post" action="api/signup_submit.php">
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="inputGroup-sizing-default"><i class="fas fa-user"></i>
                        </span>
                        <input required type="text" class="form-control" name="name" placeholder="Full Name"
                            aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="inputGroup-sizing-default"><i
                                class="fas fa-solid fa-phone fa-flip-horizontal"></i>
                        </span>
                        <input required type="text" class="form-control" name="number" placeholder="Phone Number"
                            aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="inputGroup-sizing-default"><i
                                class="fas fa-solid fa-envelope"></i>
                        </span>
                        <input required type="text" class="form-control" name="email" placeholder="Email" aria-label="Sizing example input"
                            aria-describedby="inputGroup-sizing-default">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="inputGroup-sizing-default"><i
                                class="fas fa-solid fa-lock"></i>
                        </span>
                        <input required type="password" class="form-control" name="password" placeholder="Password" aria-label="Sizing example input"
                            aria-describedby="inputGroup-sizing-default">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="inputGroup-sizing-default"><i
                                class="fas fa-solid fa-lock"></i>
                        </span>
                        <input required type="password" class="form-control" placeholder="Re-enter Password"
                            aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                    </div>
                    <div class="input-group mb-3">
                        <button class="btn btn-info">Create Account</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <p style="text-align: center;">Already have an account? <a href="#" data-bs-toggle="modal"
                        data-bs-target="#exampleModal" data-bs-dismiss="modal">Login</a></p>
            </div>
        </div>
    </div>
</div>