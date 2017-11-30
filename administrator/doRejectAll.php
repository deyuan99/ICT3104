<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require('../database/dbconfig.php');

if(isset($_POST["id"]))
{
 foreach($_POST["id"] as $id)
 {
    $sql5 = "SELECT * FROM groupsession WHERE id = '$id'";
    $query5 = $conn->prepare($sql5);
    $stmt5 = $query5->execute();
    $row22 = $query5->fetch(PDO::FETCH_ASSOC);
    $dateformat = $row22['date'];
    $starttime = $row22['startTime'];
    $roomtypeid = $row22['roomTypeID'];
    $trainerEmail = $row22['trainerEmail'];

    // send a notification to the trainer
    $msg = "Your group session on $dateformat at $starttime has been rejected.";
    $sql2 = "INSERT into notificationlog (message, userEmail, readStatus) VALUES ('$msg', '$trainerEmail', '0')";
    $query2 = $conn->prepare($sql2);
    $stmt2 = $query2->execute();
  
    $sql4 = "UPDATE groupsession SET status = 'Rejected' WHERE id = '$id'";
    $query5 = $conn->prepare($sql4);
    $stmt4 = $query5->execute();
 }
}elseif (isset($_POST["email"])) {
   foreach($_POST["email"] as $email)
 {
  
    $sql = "DELETE FROM userapproval WHERE email = '$email'";
    $query = $conn->prepare($sql);
    $stmt = $query->execute();
 } 
}
