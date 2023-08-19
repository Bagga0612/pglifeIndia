<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PG Life</title>
    <?php
    include "includes/database_connect.php";
    include "includes/head_link.php";
    ?>
    <link href="css/home.css" rel="stylesheet" />
</head>

<body>

    <!-- navbar -->
    <?php
    include "includes/header.php";
    ?>


    <!-- contant -->
    <div class="page-container">
        <div class="image-container">
            <img src="img/bg.png" alt="">
            <h3>Happiness per Square Foot</h3>
            <form class="d-flex form" id="search-form" role="form" method="GET" action="property_list.php">
                <input class="form-control me-1" style="width:350px" name='city' type="search" placeholder="Enter the name of city where to see PG" aria-label="Search">
                <button class="btn btn-light" type="submit">Search</button>
            </form>
        </div>
        <div class="content-container">
            <h1>Major Cities</h1>
            <div class="button-container">
                <div class="detail-container">
                    <a href="property_list.php?city=delhi">
                        <img src="img/delhi.png" alt="">
                    </a>
                </div>
                <div class="detail-container">
                    <a href="property_list.php?city=hyderabad">
                        <img src="img/hyderabad.png" alt="">
                    </a>
                </div>
                <div class="detail-container">
                    <a href="property_list.php?city=chennai">
                        <img src="img/chennai.png" alt="">
                    </a>
                </div>
                <div class="detail-container">
                    <a href="property_list.php?city=bangalore">
                        <img src="img/bangalore.png" alt="">
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- popup form of Signup  -->
    <?php
    include "includes/signup_modal.php";
    ?>


    <!-- popup form of login -->
    <?php
    include "includes/login_modal.php";
    ?>


    <!-- footer -->
    <?php
    include "includes/footer.php";
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf"
        crossorigin="anonymous"></script>
        <script  src="js/common.js"></script>
</body>

</html>