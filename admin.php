<?php
session_start();

require("includes/database_connect.php");

$admin_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : NULL;

$sql = "SELECT * FROM properties";
$result = mysqli_query($conn, $sql);
if (!$result) {
    echo "Something went wrong!";
    return;
}
$properties = mysqli_fetch_all($result, MYSQLI_ASSOC);

$sql_1 = "SELECT * FROM cities";
$result_1 = mysqli_query($conn, $sql_1);
if (!$result_1) {
    echo "Something went wrong!";
    return;
}
$cities = mysqli_fetch_all($result_1, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css" />
    <link rel="stylesheet" href="css/admin.css">
    <title>PG Life</title>
</head>

<body>
    <!-- navbar -->
    <?php
    include "includes/admin_navbar.php";
    ?>

    <div class="page-container">

        <h2 id="graph_name"><u><b>PG own in Different Cities</b></u></h2>
        <canvas id="myChart" style="width:100%;max-width:700px"></canvas>


        <div class="table-container">
            <div class="topic">
                List of PGs
            </div>
            <h6><u>No. of Property show in Table:</u></h6>
            <div class="form-group input-group mb-3">

                <span class="input-group-text" id="inputGroup-sizing-default"><i class="fas fa-solid fa-list-ol"></i>
                </span>
                <select required id="maxRows" class="form-select" name="gender" aria-label="Default select example">
                    <option value="5000">Show ALL Rows</option>
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="15">15</option>
                </select>
            </div>



            <table id="table_data" class="table table-striped table-class">
                <thead>
                    <tr class="heading">
                        <th scope="col">City</th>
                        <th scope="col" style="width: 180px">Name</th>
                        <th scope="col" style="width: 390px">Address</th>
                        <th scope="col">Gender</th>
                        <th scope="col" style="width: 180px">Rent (per month)</th>
                        <th scope="col" style="text-align: center;">Update</th>
                    </tr>
                </thead>

                <?php
                foreach ($properties as $property) {
                    ?>
                    <tbody>
                        <tr>
                            <td>
                                <?php
                                foreach ($cities as $city) {
                                    if ($city["id"] == $property['city_id']) {
                                        echo $city['city'];
                                    }
                                }
                                ?>
                            </td>
                            <td>
                                <?= $property['name'] ?>
                            </td>
                            <td style="max-length:50px ">
                                <?= $property['address'] ?>
                            </td>
                            <td>
                                <?= $property['gender'] ?>
                            </td>
                            <td>Rs.
                                <?= number_format($property['rent']) ?>/-
                            </td>
                            <td style="text-align: center;">
                                <button data-bs-toggle="modal" data-bs-target="#editPropertyModal" class="btn btn-info"
                                    style="margin-right: 5px;">
                                    Edit</button>
                                <a class="dlt btn btn-info" style="margin-right: 5px;"
                                  property_id="<?= $property['id'] ?>">
                                    Delete</a>
                            </td>
                        </tr>
                    </tbody>
                    <?php
                }
                ?>
            </table>

            <div class='pagination-container'>
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item" data-page="prev">
                            <span>Previous <span class="page-item sr-only">(current)</span></span>
                        </li>
                        <!--	Here the JS Function Will Add the Rows -->
                        <li class="page-item" data-page="next" id="prev">
                            <span> Next <span class="sr-only">(current)</span></span>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>

    <!-- footer -->
    <div class="footer ">
        <div class=" footer-container">
            <div class="footer-copyright">@ 2020 Copyright PG Life </div>
        </div>
    </div>


    <!-- add property modal -->
    <?php
    include "includes/add_property_modal.php";
    ?>


    <!-- edit property modal -->
    <?php
    include "includes/edit_property_modal.php";
    ?>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf"
        crossorigin="anonymous"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- <script src="js/edit_property.js"></script> -->
    <script src="js/add_property.js"></script>
    <script src="js/pagination.js"></script>
    <script src="js/delete_property.js"></script>

    <script>
        var xValues = ["Delhi", "Mumbai", "Hyderabad", "Bangalore", "Ludhiana", "Goa"];
        var yValues = [5, 2, 1, 2, 2, 1, 7, 0];
        var barColors = ["red", "green", "blue", "orange", "brown", "black"];

        new Chart("myChart", {
            type: "bar",
            data: {
                labels: xValues,
                datasets: [{
                    backgroundColor: barColors,
                    data: yValues
                }]
            },
            options: {
                legend: { display: false },
                title: {
                    display: false,
                    text: "PG in Different Cities"
                }
            }
        });

    </script>
</body>

</html>