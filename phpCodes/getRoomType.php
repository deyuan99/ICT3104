<?php
require_once('../database/dbconfig.php');

$venue = $_POST['venue'];

$sql = "SELECT name FROM roomtype where venueID = (SELECT id FROM venue WHERE location = '$venue')";
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