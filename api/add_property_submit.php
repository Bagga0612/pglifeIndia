<?php
session_start();
require("../includes/database_connect.php");

$city_name = $_POST['city_name'];
$property_name = $_POST['name'];
$address = $_POST['address'];
$description = $_POST['description'];
$gender = $_POST['gender'];
$clean = $_POST['clean'];
$food = $_POST['food'];
$safety = $_POST['safety'];
$rent = $_POST['rent'];


$sql = "INSERT INTO properties (id,city_id, name, address, description, gender, rent, rating_clean, rating_food, rating_safety) VALUES(null,(SELECT id FROM cities WHERE city='$city_name'), '$property_name' , '$address', '$description', '$gender' ,'$rent', '$clean' , '$food' , '$safety' )";

$result = mysqli_query($conn, $sql);
if (!$result) {
    $response = array("success" => false, "message" => "Something went wrong!");
    echo json_encode($response);
    return;
}


$response = array("success" => true, "message" => "Your New Property has been added successfully!");
echo json_encode($response);
mysqli_close($conn);
?>