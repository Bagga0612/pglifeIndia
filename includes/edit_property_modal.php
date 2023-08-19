<div class="modal fade" id="editPropertyModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update the Property Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="edit-property-form" class="form" role="form" method="get"
                    action="api/edit_property_submit.php">
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="inputGroup-sizing-default"><i
                                class="fas fa-solid fa-signature"></i>
                        </span>
                        <input required type="text" name="name" class="form-control" placeholder="Property Name"
                            aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="inputGroup-sizing-default"><i
                                class="fas fa-solid fa-venus-mars"></i>
                        </span>
                        <input required type="text" name="gender" class="form-control" placeholder="Gender"
                            aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                        </input>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="inputGroup-sizing-default"><i
                                class="fas fa-solid fa-rupee-sign"></i>
                        </span>
                        <input required type="number" name="rent" class="form-control" placeholder="Rent"
                            aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                    </div>
                    <div class="input-group mb-3">
                            <button class="btn btn-info" property_id="<?php
                            foreach($properties as $property){
                                $property['id'];
                            } ?>">Edit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>