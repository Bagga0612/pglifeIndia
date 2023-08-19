<?php
session_start();
require("../includes/database_connect.php");

$property_id=$_GET["property_id"];

$sql= "DELETE FROM properties WHERE id=$property_id";
$result=mysqli_query($conn, $sql);
if(!$result){
    $response = array("success" => false, "message" => "Something went wrong!");
    echo json_encode($response);
    return;
}

$response = array("success" => true, "message"=> "Delete Successfully!");
echo json_encode($response);
mysqli_close($conn);

?>