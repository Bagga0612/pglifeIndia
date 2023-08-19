<?php
session_start();
require("../includes/database_connect.php");

$phone=$_POST['phn'];
$email=$_POST['mail'];

$sql= "UPDATE users SET email='$email', phone='$phone' WHERE id=$_SESSION[user_id]";

$result=mysqli_query($conn, $sql);
if(!$result){
    $response = array("success" => false, "message" => "Something went wrong!");
    echo json_encode($response);
	return;
}

$response = array("success" => true, "message" => "Your account detail update successfully!");
echo json_encode($response);

// header("location: ../dashboard.php");
mysqli_close($conn);


?>