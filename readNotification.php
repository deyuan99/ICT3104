<?php
session_start();
require('database/dbconfig.php');
$email = $_SESSION['email'];
$sql = "UPDATE notificationlog SET readStatus = 1 WHERE userEmail = '$email'";
$req = $conn->prepare($sql);
$req->execute();


