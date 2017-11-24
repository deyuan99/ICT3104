<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require('../database/dbconfig.php');
$id = $_POST['eid'];
$sql4 = "UPDATE groupsession SET status = 'Deleted' WHERE id = '$id'";
$query5 = $conn->prepare($sql4);
$stmt4 = $query5->execute();

$sql5 = "SELECT * FROM groupsessionapplicant a, groupsession g WHERE a.groupSessionID = '$id' AND g.id = a.groupSessionID ";
$req = $conn->prepare($sql5);
$req->execute();
$rows = $req->fetchAll();
if (!empty($rows)) {
    foreach ($rows as $row):
        $traineeEmail = $row['traineeEmail'];
        $trainerEmail = $row['trainerEmail'];
        $starttime = $row['startTime'];
        $date = $row['date'];
        $msg = "Your group session on $date at $starttime has been cancelled";
        $sql3 = "INSERT into notificationlog (message, userEmail, readStatus) VALUES ('$msg', '$traineeEmail', '0')";
        $query3 = $conn->prepare($sql3);
        $query3->execute();
    endforeach;
    $msg2 = "Your group session on $date at $starttime has been cancelled";
    $sql33 = "INSERT into notificationlog (message, userEmail, readStatus) VALUES ('$msg2', '$trainerEmail', '0')";
    $query33 = $conn->prepare($sql33);
    $query33->execute();
}

header('Location: user-groupsession.php');
exit();


