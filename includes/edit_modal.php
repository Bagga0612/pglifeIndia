<div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Signup with PGLife</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div> 
            <div class="modal-body">
                <form id="edit-form" class="form" role="form" method="post" action="api/edit_submit.php">
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="inputGroup-sizing-default"><i
                                class="fas fa-solid fa-phone fa-flip-horizontal"></i>
                        </span>
                        <input required type="text" name="phn" class="form-control" placeholder="Phone Number"
                            aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="inputGroup-sizing-default"><i
                                class="fas fa-solid fa-envelope"></i>
                        </span>
                        <input required type="text" name="mail" class="form-control" placeholder="Email" aria-label="Sizing example input"
                            aria-describedby="inputGroup-sizing-default">
                    </div>
                    <div class="input-group mb-3">
                        <button class="btn btn-info">Edit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>