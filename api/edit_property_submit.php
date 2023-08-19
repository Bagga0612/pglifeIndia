<?php
session_start();
require("../includes/database_connect.php");

$property_id=$_GET["property_id"];
$property_name=$_GET['name'];
$gender=$_GET['gender'];
$rent=$_GET['rent'];


$sql="UPDATE properties SET name='$property_name', gender='$gender' , rent='$rent' WHERE id='$property_id'";
$result= mysqli_query($conn, $sql);
if(!$result){
    echo "Something Wrong!!!";
    exit;
    // $response = array("success" => false, "message" => "Something went wrong!");
    // echo json_encode($response);
	// return;
}


echo "Sucess";
// $response = array("success" => true, "message" => "Your property detail update successfully!");
// echo json_encode($response);
mysqli_close($conn);
?>