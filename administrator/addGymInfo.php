<?php
require('../database/dbconfig.php');

$table = $_POST['table'];

if ($table == 'venue') {
    $location = $_POST['location'];
    $address = $_POST['address'];
    $contact = $_POST['contact'];

    $sql = "INSERT into venue (location, address, contact) VALUES ('$location', '$address', '$contact')";
    $req = $conn->prepare($sql);
    $req->execute();

    header('Location: manageGym.php');
    
} else if ($table == 'room') {
    $name = $_POST['name'];
    $capacity = $_POST['capacity'];
    $venueID = $_POST['venueID'];

    $sql = "INSERT into roomtype (name, capacity, venueID) VALUES ('$name', '$capacity', '$venueID')";
    $req = $conn->prepare($sql);
    $req->execute();

    header('Location: manageGym.php');
    
} else if ($table == 'training') {
    $trainingName = $_POST['trainingName'];
    $cost = $_POST['cost'];

    $sql = "INSERT into typeoftraining (trainingName, cost) VALUES ('$trainingName', '$cost')";
    $req = $conn->prepare($sql);
    $req->execute();

    header('Location: manageGym.php');
    
} else {
    echo "Data input error";
}

exit();
?>
