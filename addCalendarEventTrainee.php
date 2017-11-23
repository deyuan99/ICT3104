<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

// connect to database
session_start();
require_once('database/dbconfig.php');
$eventID = $_POST['eid'];
$email = $_SESSION['email'];
$sql = "UPDATE personalsession SET traineeEmail = '$email' WHERE id = $eventID";
$req = $conn->prepare($sql);
$req->execute();

$sql2 = "SELECT * FROM personalsession where id = $eventID";

$req2 = $conn->prepare($sql2);
$req2->execute();
$rows = $req2->fetchAll();
if (!empty($rows)) {
    foreach ($rows as $row):
        $trainerEmail = $row['trainerEmail'];
        $date = $row['date'];
        $starttime = $row['startTime'];
    endforeach;
}

// send a notification to the trainer
$msg = "A Trainee - $useremail, has decided to join your 1-1 training on $date at $starttime.";
$sql3 = "INSERT into notificationlog (message, userEmail, readStatus) VALUES ('$msg', '$trainerEmail', '0')";
$query3 = $conn->prepare($sql3);
$stmt3 = $query3->execute();

echo $trainerEmail;
header('Location: trainee_trainerCalendar.php?t='.$trainerEmail);
exit();
