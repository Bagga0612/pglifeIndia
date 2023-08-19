<div class="modal fade" id="addPropertyModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New Property with PGLife</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="add-form" class="form" role="form" method="post" action="api/add_property_submit.php">

                    <div class="input-group mb-3">
                        <span class="input-group-text" id="inputGroup-sizing-default"><i
                                class="fas fa-solid fa-city"></i>
                        </span>
                        <input required type="text" class="form-control" name="city_name"
                            placeholder="Enter the name of city where the PG is" aria-label="Sizing example input"
                            aria-describedby="inputGroup-sizing-default">
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text" id="inputGroup-sizing-default"><i
                                class="fas fa-solid fa-signature"></i>
                        </span>
                        <input required type="text" class="form-control" name="name" placeholder="Enter Property Name"
                            aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text" id="inputGroup-sizing-default"><i
                                class="fas fa-solid fa-address-book"></i>
                        </span>
                        <input required type="textarea" class="form-control" name="address"
                            placeholder="Enter the Address of Property" aria-label="Sizing example input"
                            aria-describedby="inputGroup-sizing-default">
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text" id="inputGroup-sizing-default"><i
                                class="fas fa-solid fa-audio-description"></i>
                        </span>
                        <input required type="textarea" class="form-control" name="description"
                            placeholder="Enter property description" aria-label="Sizing example input"
                            aria-describedby="inputGroup-sizing-default">
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text" id="inputGroup-sizing-default"><i
                                class="fas fa-solid fa-venus-mars"></i>
                        </span>
                        <select required class="form-select" name="gender" aria-label="Default select example">
                            <option selected>Select the Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Unisex">Unisex</option>
                        </select>
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text" id="inputGroup-sizing-default"><i
                                class="fas fa-solid fa-broom"></i>
                        </span>
                        <input required type="float" name="clean" class="form-control" placeholder="Rating of Cleanning"
                            aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text" id="inputGroup-sizing-default"><i
                                class="fas fa-solid fa-utensils"></i>
                        </span>
                        <input required type="float" name="food" class="form-control" placeholder="Rating for Food"
                            aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text" id="inputGroup-sizing-default"><i
                                class="fas fa-solid fa-user-shield"></i>
                        </span>
                        <input required type="float" name="safety" class="form-control" placeholder="Ratinf for Safety"
                            aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text" id="inputGroup-sizing-default"><i
                                class="fas fa-solid fa-rupee-sign"></i>
                        </span>
                        <input required type="number" name="rent" class="form-control" placeholder="Rent"
                            aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                    </div>




                    <div class="input-group mb-3">
                        <button class="btn btn-info">Add Property</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>