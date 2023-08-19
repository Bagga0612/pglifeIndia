<?php
session_start();
require("includes/database_connect.php");
 
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : NULL;
$city_name = $_GET["city"];

$sql_1 = "SELECT * FROM cities WHERE city = '$city_name'";
$result_1 = mysqli_query($conn, $sql_1);
if (!$result_1) {
    echo "Something went wrong!";
    return;
}
$city = mysqli_fetch_assoc($result_1);
if (!$city) {
    echo "Sorry! We do not have any PG listed in this city.";
    return;
}
$city_id = $city['id'];


$sql_2 = "SELECT * FROM properties WHERE city_id = $city_id";
$result_2 = mysqli_query($conn, $sql_2);
if (!$result_2) {
    echo "Something went wrong!";
    return;
}
$properties = mysqli_fetch_all($result_2, MYSQLI_ASSOC);


$sql_3 = "SELECT * 
            FROM interested_users_properties iup
            INNER JOIN properties p ON iup.property_id = p.id
            WHERE p.city_id = $city_id";
$result_3 = mysqli_query($conn, $sql_3);
if (!$result_3) {
    echo "Something went wrong!";
    return;
}
$interested_users_properties = mysqli_fetch_all($result_3, MYSQLI_ASSOC);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PG Life</title>
    <?php
    include "includes/database_connect.php";
    include "includes/head_link.php";
    ?>
    <link rel="stylesheet" href="css/property_list.css">
</head>

<body>

    <!-- navbar -->
    <?php
    include "includes/header.php";
    ?>

    <hr id="line">
    <div class="bg-light">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Proprty List</li>
            </ol>
        </nav>
    </div>


    <!-- contant -->
    <div class="page-container">
        <div class="filter-bar row justify-content-around">
            <div class="col-4" data-bs-toggle="modal" data-bs-target="#filterModal">
                <img style="cursor: pointer;" src="img/filter.png" alt="">
                <span style="cursor: pointer;">Filter</span>
            </div>
            <div class="col-4">
                <img style="cursor: pointer;" src="img/desc.png" alt="">
                <span style="cursor: pointer;"> Highest rent first</span>
            </div>
            <div class="col-4">
                <img style="cursor: pointer;" src="img/asc.png" alt="">
                <span style="cursor: pointer;"> Lowest rent first</span>
            </div>
        </div>

        <?php
        foreach ($properties as $property) {
            $property_images = glob("img/properties/" . $property['id'] . "/*");
            ?>
            <div class="property-card row">
                <div class="image-container col-md-4">
                    <img src="<?= $property_images[0] ?>" />
                </div>
                <div class="content-container col-md-8">
                    <div class="row no-gutters justify-content-between">
                        <?php
                        $total_rating = ($property['rating_clean'] + $property['rating_food'] + $property['rating_safety']) / 3;
                        $total_rating = round($total_rating, 1);
                        ?>
                        <div class="star-container col-6" title="<?= $total_rating ?>">
                            <?php
                            $rating = $total_rating;
                            for ($i = 0; $i < 5; $i++) {
                                if ($rating >= $i + 0.8) {
                                    ?>
                                    <i class="fas fa-star"></i>
                                    <?php
                                } elseif ($rating >= $i + 0.3) {
                                    ?>
                                    <i class="fas fa-star-half-alt"></i>
                                    <?php
                                } else {
                                    ?>
                                    <i class="far fa-star"></i>
                                    <?php
                                }
                            }
                            ?>
                        </div>
                        <div class="interested-container col-6" style="text-align: center;">
                            <?php
                            $interested_users_count = 0;
                            $is_interested = false;
                            foreach ($interested_users_properties as $interested_user_property) {
                                if ($interested_user_property['property_id'] == $property['id']) {
                                    $interested_users_count++;

                                    if ($interested_user_property['user_id'] == $user_id) {
                                        $is_interested = true;
                                    }
                                }
                            }

                            if ($is_interested) {
                                ?>
                                <i class="is_interested-image fas fa-heart" id="meee" style="font-size: 20px; cursor: pointer; "
                                    property_id="<?= $property['id'] ?>"></i>

                                <?php
                            } else {
                                ?>
                                <i class="is_interested-image far fa-heart" id="meee" style="font-size: 20px; cursor: pointer; "
                                    property_id="<?= $property['id'] ?>"></i>
                                <?php
                            }
                            ?>
                            <div class="interested-user-count" id="number" style="font-size: small;">
                                <?= $interested_users_count ?> interested
                            </div>
                        </div>
                    </div>
                    <div class="detail-container">
                        <div class="property-name">
                            <?= $property['name'] ?>
                        </div>
                        <div class="property-address">
                            <?= $property['address'] ?>
                        </div>
                        <div class="property-gender">
                            <?php
                            if ($property['gender'] == "male") {
                                ?>
                                <img src="img/male.png" />
                                <?php
                            } elseif ($property['gender'] == "female") {
                                ?>
                                <img src="img/female.png" alt="">
                                <?php
                            } else {
                                ?>
                                <img src="img/unisex.png">
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                    <div class="row no-gutters">
                        <div class="rent-container col-6">
                            <div style="display: inline-block;" class="rent">Rs
                                <?= number_format($property['rent']) ?>/-
                            </div>
                            <div style="display: inline-block;" class="rent-unit">per month</div>
                        </div>
                        <div class="button-container col-6">
                            <a href="property_detail.php?property_id=<?= $property['id'] ?>"
                                class="btn btn-primary">View</a>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }

        if (count($properties) == 0) {
            ?>
            <div class="no-property-container">
                <p>No PG to list</p>
            </div>
            <?php
        }
        ?>
    </div>

    <!-- popup form of Signup  -->
    <?php
    include "includes/signup_modal.php";
    ?>

    <!-- popup form of login -->
    <?php
    include "includes/login_modal.php";
    ?>

    <!-- popup for filter -->
    <div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Filter</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row" style="margin-bottom: 15px;">
                        <div class="btn-group col-3" role="group" aria-label="Third group">
                            <button type="button" class="btn btn-dark">No Filter</button>
                        </div>
                        <div class="btn-group col-3" role="group" aria-label="Third group">
                            <button type="button" class="btn btn-outline-dark"><i class="fas fa-solid fa-mars"
                                    style="padding-right: 10px;"></i>Male</button>
                        </div>
                        <div class="btn-group col-3" role="group" aria-label="Third group">
                            <button type="button" class="btn btn-outline-dark"><i class="fas fa-solid fa-venus"
                                    style="padding-right: 10px;"></i>Female</button>
                        </div>
                        <div class="btn-group col-3" role="group" aria-label="Third group">
                            <button type="button" class="btn btn-outline-dark"><i class="fas fa-solid fa-venus-mars"
                                    style="padding-right: 7px;"></i>Unisex</button>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <button class="btn btn-info">Apply</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- footer -->
    <?php
    include "includes/footer.php";
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf"
        crossorigin="anonymous"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
    <!-- <script type="text/javascript" src="./javascript.js"></script> -->
    <script src="http://maps.googleapis.com/maps/api/js?key=YOUR_APIKEY&sensor=false">
    </script>
    <script src="js/common.js"></script>
    <script src="js/property_list.js"></script>

</body>

</html>