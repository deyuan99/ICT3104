<?php
require('../database/dbconfig.php');

$table = $_POST['table'];

if ($table == 'venue') {
    $id = $_POST['edit_id'];

    $sql = "SELECT * FROM venue WHERE id = '$id'";
    $req = $conn->prepare($sql);
    $req->execute();
    $rows = $req->fetchAll();
    if (!empty($rows)) {
        foreach ($rows as $row):
            $location = $row['location'];
            $address = $row['address'];
        endforeach;
    }
    else {
        echo "No venue record found";
    }

    $location = empty($_POST['name']) ? $location : $_POST['name'];
    $address = empty($_POST['third']) ? $address : $_POST['third'];


    $sql = "UPDATE venue SET location = '$location', address ='$address' WHERE id = '$id'";
    $req = $conn->prepare($sql);
    $req->execute();

    header('Location: manageGym.php');
    
} else if ($table == 'room') {
    $id = $_POST['edit_id'];

    $sql = "SELECT * FROM roomtype WHERE id = '$id'";
    $req = $conn->prepare($sql);
    $req->execute();
    $rows = $req->fetchAll();
    if (!empty($rows)) {
        foreach ($rows as $row):
            $name = $row['name'];
            $capacity = $row['capacity'];
            $venueID = $row['venueID'];
        endforeach;
    }
    else {
        echo "No room type record found";
    }

    $name = empty($_POST['name']) ? $name : $_POST['name'];
    $capacity = empty($_POST['third']) ? $capacity : $_POST['third'];
    $venueID = empty($_POST['fourth']) ? $venueID : $_POST['fourth'];


    $sql = "UPDATE roomtype SET name = '$name', capacity ='$capacity', venueID ='$venueID' WHERE id = '$id'";
    $req = $conn->prepare($sql);
    $req->execute();

    header('Location: manageGym.php');
    
} else if ($table == 'training') {
    $id = $_POST['edit_id'];

    $sql = "SELECT * FROM typeoftraining WHERE id = '$id'";
    $req = $conn->prepare($sql);
    $req->execute();
    $rows = $req->fetchAll();
    if (!empty($rows)) {
        foreach ($rows as $row):
            $trainingName = $row['trainingName'];
            $cost = $row['cost'];
        endforeach;
    }
    else {
        echo "No venue record found";
    }

    $trainingName = empty($_POST['name']) ? $trainingName : $_POST['name'];
    $cost = empty($_POST['third']) ? $cost : $_POST['third'];


    $sql = "UPDATE typeoftraining SET trainingName = '$trainingName', cost ='$cost' WHERE id = '$id'";
    $req = $conn->prepare($sql);
    $req->execute();

    header('Location: manageGym.php');
    
} else {
    echo "Data input error";
}

exit();
?>
