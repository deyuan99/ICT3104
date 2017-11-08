<?php
require_once('../database/dbconfig.php');

$venueID = $_POST['venueID'];

$sql = "SELECT name FROM roomtype where venueID = (SELECT id FROM venue WHERE location = '$venueID')";
$req = $conn->prepare($sql);
$req->execute();
$rooms = $req->fetchAll();

if (!empty($rooms)) {
    $data = array();
    
    foreach ($rooms as $room):
        $data[] = $room['name'];
    endforeach;
    
    echo json_encode($data);
}
else {
    echo "No rooms available yet!";
}

?>