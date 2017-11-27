<?php

require('../database/dbconfig.php');

// check if form submitted is for user approval or group session approval
preg_match("/@+/", $_POST['approve_userid'], $output_array);

if (count($output_array) == 1) {
    $email = $_POST['approve_userid'];

    // copy from userapproval to users table
    $sql = "INSERT INTO users (email, firstName, lastName, phoneNumber, profilePicture, role, password, address, subscription, registerDate, expiryDate) SELECT * FROM userapproval WHERE email = '$email'";
    $query = $conn->prepare($sql);
    $stmt = $query->execute();

    $sql2 = "UPDATE users SET status = 1, featuredStatus = 0 WHERE email = '$email'";
    $query2 = $conn->prepare($sql2);
    $stmt2 = $query2->execute();

    // delete from userapproval table
    $rmsql = "DELETE FROM userapproval WHERE email = '$email'";
    $query3 = $conn->prepare($rmsql);
    $stmt = $query3->execute();
    header('Location: user-approval.php#trainee_tab');
} else {

    //update groupsession status to approved
    $id = $_POST['approve_userid'];

    $sql22 = "SELECT * FROM groupsession where id = '$id' ";
    $req22 = $conn->prepare($sql22);
    $req22->execute();
    $row22 = $req22->fetch(PDO::FETCH_ASSOC);
    $dateformat = $row22['date'];
    $starttime = $row22['startTime'];
    $endtime = $row22['endTime'];
    $roomtypeid = $row22['roomTypeID'];
    $trainerEmail = $row22['trainerEmail'];


/*
    //(1)get the number from personal training on this date, roomtype and venue and startime
    $sql6 = "SELECT COUNT(*) as total_rows FROM personalsession p,roomtype r where p.roomTypeID=r.id and p.date ='$dateformat' and p.startTime = '$starttime' and r.id = '$roomtypeid'";
    $req1 = $conn->prepare($sql6);
    $req1->execute();
    $row = $req1->fetch(PDO::FETCH_ASSOC);
    $total_rows = $row['total_rows'];

    //(2) get the group cap base on this date, roomtype and venue and startime
    $totalgroupcap = 0;
    $sql9 = "SELECT * FROM groupsession g,roomtype r where g.roomTypeID=r.id and date= '$dateformat'and g.startTime = '$starttime' and status = 'Approved' and r.id = '$roomtypeid'";
    $req2 = $conn->prepare($sql9);
    $req2->execute();
    $coungroup = $req2->rowCount();
    if ($coungroup > 0) {
        while ($row2 = $req2->fetch(PDO::FETCH_ASSOC)) {
            $grpcap = $row2['groupCapacity'];
            $totalgroupcap = $grpcap + $totalgroupcap;
        }
    }

  (3)get the number limit base on  roomtype and venue
   $sql12 = "SELECT capacity FROM roomtype r where r.id = '$roomtypeid' ";
   $req3 = $conn->prepare($sql12);
   $req3->execute();
   $row3 = $req3->fetch(PDO::FETCH_ASSOC);
   $capacity = $row3['capacity'];

  $currenttotalevent = $totalgroupcap + $total_rows;
  echo "current total event : ";
   echo $currenttotalevent;
   echo "</br>";
   echo "total capacity :";
   echo $capacity;


    //(4) get the group cap
    $sql33 = "Select groupCapacity from groupsession WHERE id = '$id'";
    $req33 = $conn->prepare($sql33);
    $req33->execute();
    $row33 = $req33->fetch(PDO::FETCH_ASSOC);
    $capacityapp = $row33['groupCapacity'];
    echo "</br>";
    echo "total cap for approve event :";
    echo $capacityapp;
    comparing
  if ($currenttotalevent >= $capacity || $currenttotalevent + $capacityapp >= $capacity) {
   */ 
    
    $sql9 = "SELECT * FROM groupsession where date= '$dateformat' and status = 'Approved' and roomTypeID = '$roomtypeid' and ((startTime > '$starttime' AND startTime < '$endtime') OR (endTime > '$starttime' AND endTime < '$endtime'))  ";
    $req2 = $conn->prepare($sql9);
    $req2->execute();
    $resultexist = $req2->rowCount();
    if ($resultexist > 0) {
       echo "<script type='text/javascript'>alert('Facility being use on this timeslot');"
       . "window.location.href='user-approval.php';"
        . "</script>";
    } else {

        $sql3 = "UPDATE groupsession SET status = 'Approved' WHERE id = '$id'";
        $query4 = $conn->prepare($sql3);
        $stmt3 = $query4->execute();
        
        // send a notification to the trainer
        $msg5 = "Your group session on $dateformat at $starttime has been approved.";
        $sql5 = "INSERT into notificationlog (message, userEmail, readStatus) VALUES ('$msg5', '$trainerEmail', '0')";
        $query5 = $conn->prepare($sql5);
        $stmt5 = $query5->execute();
        
        echo "<script type='text/javascript'>alert('Success');"
        . "window.location.href='user-approval.php';"
        . "</script>";
    }
    //header('Location: user-approval.php#trainer_tab');
}
exit();
?>