<?php
require('../database/dbconfig.php');

/*
 * id, title, description, startDate, endDate, imagePath, featuredStatus
 */

$id = $_POST['edit_id'];

$sql = "SELECT * FROM promotions WHERE id = '$id'";
$req = $conn->prepare($sql);
$req->execute();
$rows = $req->fetchAll();
if (!empty($rows)) {
    foreach ($rows as $row):
        //$id = $row['id'];
        $title = $row['title'];
        $description = $row['description'];
        $startDate = $row['startDate'];
        $endDate = $row['endDate'];
        $imagePath = $row['imagePath'];
        $featuredStatus = $row['featuredStatus'];

    endforeach;
}
else {
    echo "No promotions found";
}


//$firstName = $_POST['firstName'];
//$lastName = $_POST['lastName'];
//$address = $_POST['address'];
//$mobile = $_POST['mobile'];
$title = empty($_POST['title']) ? $title : $_POST['title'];
$description = empty($_POST['description']) ? $description : $_POST['description'];
$startDate = empty($_POST['startDate']) ? $startDate : $_POST['startDate'];
$endDate = empty($_POST['endDate']) ? $endDate : $_POST['endDate'];
$imagePath = empty($_POST['imagePath']) ? $imagePath : $_POST['imagePath'];
$featuredStatus = empty($_POST['featuredStatus']) ? $featuredStatus : $_POST['featuredStatus'];


$sql = "UPDATE promotions SET title = '$title', description = '$description', startDate ='$startDate', endDate = '$endDate', imagePath = '$imagePath', featuredStatus='$featuredStatus' WHERE id = '$id'";
$req = $conn->prepare($sql);
$req->execute();

header('Location: promo-management.php');
exit();
?>
