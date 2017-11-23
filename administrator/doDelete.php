<?php
require('../database/dbconfig.php');

$table = $_POST['delete_table'];
$id = $_POST['delete_id'];
$sql;

if ($table == 'venue') {
    $sql = "DELETE FROM venue WHERE id = '$id'";
} else if ($table == 'room') {
    $sql = "DELETE FROM roomtype WHERE id = '$id'";
} else if ($table == 'training') {
    $sql = "DELETE FROM typeoftraining WHERE id = '$id'";
} else {
    echo "Error";
}

$req = $conn->prepare($sql);
$req->execute();
header('Location: manageGym.php');
exit();
?>
