<?php
require('../database/dbconfig.php');

// check if form submitted is for user approval or group session approval
preg_match("/@+/", $_POST['reject_userid'], $output_array);

if (count($output_array) == 1) {
    $email = $_POST['reject_userid'];

    $sql = "DELETE FROM userapproval WHERE email = '$email'";
    $query = $conn->prepare($sql);
    $stmt = $query->execute();

    header('Location: user-approval.php');
    
} else { //reject for groupsession
    $id = $_POST['reject_userid'];
    $sql5 = "SELECT * FROM groupsession WHERE id = '$id'";
    $query5 = $conn->prepare($sql5);
    $stmt5 = $query5->execute();
    $row22 = $req22->fetch(PDO::FETCH_ASSOC);
    $dateformat = $row22['date'];
    $starttime = $row22['startTime'];
    $roomtypeid = $row22['roomTypeID'];
    $trainerEmail = $row22['trainerEmail'];

    // send a notification to the trainer
    $msg = "Your group session on $dateformat at $starttime has been rejected.";
    $sql2 = "INSERT into notificationlog (message, userEmail, readStatus) VALUES ('$msg', '$trainerEmail', '0')";
    $query2 = $conn->prepare($sql2);
    $stmt2 = $query2->execute();
    
    $sql3 = "UPDATE groupsession SET status = 'Rejected' WHERE id = '$id'";
    $query4 = $conn->prepare($sql3);
    $stmt3 = $query4->execute();
    
    header('Location: user-approval.php');
}
exit();

