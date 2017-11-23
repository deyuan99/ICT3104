<?php

session_start();
include_once '../database/dbconfig.php';
$id = $_SESSION['email'];
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$address = $_POST['address'];
$profileBio = $_POST['profileBio'];
$phoneNumber = $_POST['phoneNumber'];
$password = empty(sha1($_POST['password'])) ? sha1($password) : sha1($_POST['password']); 



$sql = "UPDATE users SET firstName= '$firstName', lastName= '$lastName', address= '$address', profileBio= '$profileBio', phoneNumber= '$phoneNumber', password= '$password' WHERE email='$id';";


$result = $conn->prepare($sql);
$result->execute();

 header("Location: ../trainer_dashboard.php?uploadsuccess");

?>
