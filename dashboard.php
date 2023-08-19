<?php
session_start();
require "includes/database_connect.php";


if (!isset($_SESSION["user_id"])) {
    header("location: index.php");
    die();
}
$user_id = $_SESSION['user_id'];

$sql_1 = "SELECT * FROM users WHERE id = $user_id";
$result_1 = mysqli_query($conn, $sql_1);
if (!$result_1) {
    echo "Something went wrong!";
    return;
}
$user = mysqli_fetch_assoc($result_1);
if (!$user) {
    echo "Something went wrong!";
    return;
}

$sql_2 = "SELECT * 
            FROM interested_users_properties iup
            INNER JOIN properties p ON iup.property_id = p.id
            WHERE iup.user_id = $user_id";
$result_2 = mysqli_query($conn, $sql_2);
if (!$result_2) {
    echo "Something went wrong!";
    return;
}
$interested_properties = mysqli_fetch_all($result_2, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PG Life</title>
    <?php
    include "includes/database_connect.php";
    ?>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">

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
                <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
            </ol>
        </nav>
    </div>

    <div class="page-container">
        <div class="content-container row justify-content-around">
            <div class="col-12">
                <h1>My Profile</h1>
            </div>
            <div class="card mb-3" style="border: none;">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="img/man.png" class="img-fluid rounded-start" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body ">
                            <h3 style="margin: 0%;" class="card-title">
                                <?= $user["full_name"] ?>
                            </h3>
                            <p style="margin: 0%; font-size: smaller;" class="card-text">+91
                                <?= $user["phone"] ?>
                            </p>
                            <p style="margin: 0%; font-size: smaller;" class="card-text">
                                <?= $user["email"] ?>
                            </p>
                            <p style="margin: 0%; font-size: smaller;" class="card-text">House no. 221, street no.01,
                                Mundian Khurd, Ludhiana </p>
                        </div>
                        <div class="button">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#editProfileModal">
                                Eidt Profile
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <?php
    if (count($interested_properties) > 0) {
        ?>
        <div class="interested-container">
            <div class="col-12">
                <h1 id="me">My Interested Properties</h1>
            </div>
            <?php
            foreach ($interested_properties as $property) {
                $property_images = glob("img/properties/" . $property['id'] . "/*");
                ?>
                <div class="property-card property-id-<?= $property['id'] ?> row justify-content-around">
                    <div class="image-container col-md-4">
                        <img src="<?= $property_images[0] ?>" />
                    </div>
                    <div class="contnt-container col-md-8">
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
                            <div class="interest-container col-6" style="text-align: center;">
                                <i class="is-interested-image fas fa-heart" style="cursor: pointer;"
                                    property_id="<?= $property['id'] ?>"></i>
                            </div>
                        </div>
                        <div class="detail-container">
                            <div class="property-name">
                                <?= $property["name"] ?>
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
            ?>
        </div>
        <?php
    }
    ?>

    <!-- popup for edit Profile  -->
    <?php
    include "includes/edit_modal.php";
    ?>

    <!-- footer -->
    <?php
    include "includes/footer.php";
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf"
        crossorigin="anonymous"></script>
        <script  src="js/common.js"></script>
        <script  src="js/edit.js"></script>
        <script src="js/dashboard.js"></script>


</body>

</html>