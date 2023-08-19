<?php
session_start();
require "includes/database_connect.php";

$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : NULL;
$property_id = $_GET["property_id"];

$sql_1 = "SELECT *, p.id AS property_id, p.name AS property_name, c.city AS city_name 
            FROM properties p
            INNER JOIN cities c ON p.city_id = c.id 
            WHERE p.id = $property_id";
$result_1 = mysqli_query($conn, $sql_1);
if (!$result_1) {
    echo "Something went wrong!";
    return;
}
$property = mysqli_fetch_assoc($result_1);
if (!$property) {
    echo "Something went wrong!";
    return;
}


$sql_2 = "SELECT * FROM testimonials WHERE property_id = $property_id";
$result_2 = mysqli_query($conn, $sql_2);
if (!$result_2) {
    echo "Something went wrong!";
    return;
}
$testimonials = mysqli_fetch_all($result_2, MYSQLI_ASSOC);


$sql_3 = "SELECT a.* 
            FROM amenities a
            INNER JOIN properties_amenities pa ON a.id = pa.amenity_id
            WHERE pa.property_id = $property_id";
$result_3 = mysqli_query($conn, $sql_3);
if (!$result_3) {
    echo "Something went wrong!";
    return;
}
$amenities = mysqli_fetch_all($result_3, MYSQLI_ASSOC);


$sql_4 = "SELECT * FROM interested_users_properties WHERE property_id = $property_id";
$result_4 = mysqli_query($conn, $sql_4);
if (!$result_4) {
    echo "Something went wrong!";
    return;
}
$interested_users = mysqli_fetch_all($result_4, MYSQLI_ASSOC);
$interested_users_count = mysqli_num_rows($result_4);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PG Life</title>
    <?php
    include "includes/head_link.php";
    ?>
    <link rel="stylesheet" href="css/property_detail.css">
</head>

<body>

    <!-- navbar -->
    <?php
    include "includes/header.php";
    ?>

    <hr id="line">
    <div class="crumb bg-light">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                <li class="breadcrumb-item"><a href="property_list.php?city=<?= $property['city_name']; ?>"><?= $property['city_name']; ?></a></li>
                <li class="breadcrumb-item active" aria-current="page">
                    <?= $property['property_name']; ?>
                </li>
            </ol>
        </nav>
    </div>

    <!-- carousel -->
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="img/properties/1/1d4f0757fdb86d5f.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="img/properties/1/46ebbb537aa9fb0a.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="img/properties/1/eace7b9114fd6046.jpg" class="d-block w-100" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>


    <!-- content -->


    <div class="page-container row">
        <div class="content-container col-md-12 ">
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
                <div class="interested-container col-6" style="text-align: center; ">
                    <?php
                    $is_interested = false;
                    foreach ($interested_users as $interested_user) {
                        if ($interested_user['user_id'] == $user_id) {
                            $is_interested = true;
                        }
                    }

                    if ($is_interested) {
                        ?>
                        <i class="is-interested-image fas fa-heart" id="meee" property_id="<?= $property['id'] ?>"></i>
                        <?php
                    } else {
                        ?>
                        <i class="is-interested-image far fa-heart" id="meee" property_id="<?= $property['id'] ?>"></i>
                        <?php
                    }
                    ?>
                    <div class="interested-text" id="number" style="font-size: small; cursor: pointer;">
                        <?= $interested_users_count ?> interested
                    </div>
                </div>
            </div>
            <div class="detail-container">
                <div class="property-name" style="font-size:30px; font-weight:bold;">
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
                    <a href="#" class="btn btn-primary">Book Now</a>
                </div>
            </div>
        </div>
    </div>
    </div>



    <div class="property_d">
        <div class="property_detail">
            <div class="topic ">
                <h1>Amenities</h1>
            </div>
            <div class="row justify-content-between">
                <div class="col-md-auto">
                    <h5>Building</h5>
                    <?php
                    foreach ($amenities as $amenity) {
                        if ($amenity['type'] == "Building") {
                            ?>
                            <div class="amenity-container">
                                <img src="img/amenities/<?= $amenity['icon'] ?>.svg">
                                <span>
                                    <?= $amenity['name'] ?>
                                </span>
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>

                <div class="col-md-auto">
                    <h5>Common Area</h5>
                    <?php
                    foreach ($amenities as $amenity) {
                        if ($amenity['type'] == "Common Area") {
                            ?>
                            <div class="amenity-container">
                                <img src="img/amenities/<?= $amenity['icon'] ?>.svg">
                                <span>
                                    <?= $amenity['name'] ?>
                                </span>
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>

                <div class="col-md-auto">
                    <h5>Bedroom</h5>
                    <?php
                    foreach ($amenities as $amenity) {
                        if ($amenity['type'] == "Bedroom") {
                            ?>
                            <div class="amenity-container">
                                <img src="img/amenities/<?= $amenity['icon'] ?>.svg">
                                <span>
                                    <?= $amenity['name'] ?>
                                </span>
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>

                <div class="col-md-auto">
                    <h5>Washroom</h5>
                    <?php
                    foreach ($amenities as $amenity) {
                        if ($amenity['type'] == "Washroom") {
                            ?>
                            <div class="amenity-container">
                                <img src="img/amenities/<?= $amenity['icon'] ?>.svg">
                                <span>
                                    <?= $amenity['name'] ?>
                                </span>
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>


    <div class="page-container">
        <div class="content-container">
            <div class="topic ">
                <h1>About the Property</h1>
            </div>
            <div class="About_property">
                <p class="about">
                    <?= $property['description'] ?>
                </p>
            </div>
        </div>
    </div>



    <div class="property_d">
        <div class="property_detail">
            <div class="topic ">
                <h1>Property Rating</h1>
            </div>
            <div class="Rating-detail row">
                <div class="rating-item col-6">
                    <div class="Rating_item row">
                        <div class="cleaning-rating col-6">
                            <i class="fas fa-solid fa-broom"></i>
                            <p>Cleanliness</p>
                        </div>
                        <div class="cleaning-rating col-6" title="<?= $property['rating_clean'] ?>">
                            <?php
                            $rating = $property['rating_clean'];
                            for ($i = 0; $i < 5; $i++) {
                                if ($rating >= $i + 0.8) {
                                    ?>
                                    <i class=" fas fa-star"></i>
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
                    </div>
                    <div class="Rating_item row">
                        <div class="cleaning-rating col-6">
                            <i class="fas fa-solid fa-utensils"></i>
                            <p>Food Quality</p>
                        </div>
                        <div class="cleaning-rating col-6" title="<?= $property['rating_food'] ?>">
                            <?php
                            $rating = $property['rating_food'];
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
                    </div>
                    <div class="Rating_item row">
                        <div class="cleaning-rating col-6">
                            <i class="fas fa-solid fa-lock"></i>
                            <p>Safety</p>
                        </div>
                        <div class="cleaning-rating col-6" title="<?= $property['rating_safety'] ?>">
                            <?php
                            $rating = $property['rating_safety'];
                            for ($i = 0; $i < 5; $i++) {
                                if ($rating >= $i + 0.8) {
                                    ?>

                                    <i class=" fas fa-star"></i>
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
                    </div>
                </div>
                <div class="col-2">

                </div>
                <div class="rating-circle col-4 align-items-center" style="text-align: center;">
                    <?php
                    $total_rating = ($property['rating_clean'] + $property['rating_food'] + $property['rating_safety']) / 3;
                    $total_rating = round($total_rating, 1);
                    ?>
                    <div class="total-rating">
                        <?= $total_rating ?>
                    </div>
                    <div class="star-container" title="<? $total_rating ?>">
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
                </div>

            </div>
        </div>
    </div>


    <div class="page-container" style="margin-bottom: 80px;">
        <div class="content-container">
            <div class="topic" style="padding-bottom: 0%;">
                <h1>What people say</h1>
            </div>
            <?php
            foreach ($testimonials as $testimonial) {
                ?>
                <div class="people">
                    <div class="img-container">
                        <img src="img/man.png" alt="">
                    </div>
                    <div class="say-container">
                        <p class="words"><i class="fas fa-quote-left"></i>
                            <?= $testimonial['content'] ?>
                        </p>
                        <p class="name">
                            -
                            <?= $testimonial['user_name'] ?>
                        </p>
                    </div>
                </div>
                <?php
            }
            ?>
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
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
    <!-- <script type="text/javascript" src="./javascript.js"></script> -->
    <script src="http://maps.googleapis.com/maps/api/js?key=YOUR_APIKEY&sensor=false">
    </script>
    <script src="js/common.js"></script>
    <script src="js/property_detail.js"></script>

</body>

</html>