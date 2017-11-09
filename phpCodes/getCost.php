<?php
require_once('../database/dbconfig.php');

$ttype = $_POST['ttype'];

$sql = "SELECT cost FROM typeoftraining WHERE trainingName = '$ttype'";
$req = $conn->prepare($sql);
$req->execute();
$cost = $req->fetch(PDO::FETCH_ASSOC);

if (!empty($cost)) {
    echo $cost['cost'];
}
else {
    echo "Error!";
}

?>