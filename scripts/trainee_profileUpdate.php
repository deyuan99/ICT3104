<?php

session_start();
include_once '../database/dbconfig.php';
$id = $_SESSION['email'];
$firstName = $_POST['firstName'];



$sql = "UPDATE users SET firstName= '$firstName' WHERE email='$id';";


$result = $conn->prepare($sql);
$result->execute();

 header("Location: ../trainee_dashboard.php?uploadsuccess");

?>
