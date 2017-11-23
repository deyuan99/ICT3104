<?php
require('../database/dbconfig.php');

$table = $_POST['delete_table'];
$id = $_POST['delete_id'];
$sql;


echo $table;
echo $id;

if ($table == 'promotions') {
    $sql = "DELETE FROM promotions WHERE id = $id";
} else {
    echo "Error";
}

$req = $conn->prepare($sql);
$req->execute();
header('Location: promo-management.php');
exit();
?>
