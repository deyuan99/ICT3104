<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once('database/dbconfig.php');
$id = $_POST['id'];
$category = $_POST['category'];
$Semail = $_SESSION['email'];

if ($category == '1-1 Training') {

    // Notification to trainer
    $sql22 = "SELECT * FROM personalsession where id = '$id' ";
    $req22 = $conn->prepare($sql22);
    $req22->execute();
    $row22 = $req22->fetch(PDO::FETCH_ASSOC);
    $dateformat = $row22['date'];
    $starttime = $row22['startTime'];
    $endtime = $row22['endTime'];
    $trainerEmail = $row22['trainerEmail'];

    // send a notification to the trainer
    $msg5 = "Trainee $Semail has left your 1-1 training on $dateformat at $starttimes";
    $sql5 = "INSERT into notificationlog (message, userEmail, readStatus) VALUES ('$msg5', '$trainerEmail', '0')";
    $query5 = $conn->prepare($sql5);
    $query5->execute();


    $sql = "UPDATE personalsession SET traineeEmail = '' WHERE id = '$id' ";
    $query = $conn->prepare($sql);
    if ($query == false) {
        print_r($conn->errorInfo());
        die('Error prepare');
    }
    $res = $query->execute();
    if ($res == false) {
        print_r($query->errorInfo());
        die('Error execute');
    }
    if ($query) {
        echo "<script type='text/javascript'>alert('submitted successfully!');"
        . "window.location.href='trainee_dashboard.php';"
        . "</script>";
    } else {
        echo "<script type='text/javascript'>alert('failed');"
        . "window.location.href='trainee_dashboard.php';"
        . "</script>";
    }
} else {
    $sql = "DELETE FROM groupsessionapplicant WHERE groupsessionID = '$id'";
    $query = $conn->prepare($sql);
    if ($query == false) {
        print_r($conn->errorInfo());
        die('Error prepare');
    }
    $res = $query->execute();

    if ($res == false) {
        print_r($query->errorInfo());
        die('Error execute');
    }
    if ($query) {
        echo "<script type='text/javascript'>alert('Delete successfully!');" . "window.location.href='trainee_dashboard.php';" . "</script>";
    } else {
        echo "<script type='text/javascript'>alert('failed');" . "window.location.href='trainee_dashboard.php';" . "</script>";
    }
}
?>

