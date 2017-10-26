<?php

session_start();
include_once '../database/dbconfig.php';
$id = $_SESSION['email'];

$sql = "UPDATE users SET firstName= ('".$_POST['firstName']."') WHERE email='$id';";


$result = $conn->prepare($sql);
$result->execute();

 header("Location: trainer_dashboard.php?uploadsuccess");

?>
