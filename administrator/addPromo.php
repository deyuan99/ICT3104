<?php

require('../database/dbconfig.php');

$title = empty($_POST['title']) ? $title : $_POST['title'];
$description = empty($_POST['description']) ? $description : $_POST['description'];
$startDate = empty($_POST['startDate']) ? $startDate : $_POST['startDate'];
$endDate = empty($_POST['endDate']) ? $endDate : $_POST['endDate'];
$imagePath = empty($_POST['imagePath']) ? $imagePath : $_POST['imagePath'];
$featuredStatus = empty($_POST['featuredStatus']) ? $featuredStatus : $_POST['featuredStatus'];

$sql = "INSERT INTO promotions (title, description, startDate, endDate, imagePath, featuredStatus) VALUES ('$title', '$description', '$startDate', '$endDate', '$imagePath', '$featuredStatus')";
$req = $conn->prepare($sql);
$req->execute();

header('Location: promo-management.php');
exit();
?>