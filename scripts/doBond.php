<?php
require('../database/dbconfig.php');
session_start();

$useremail = $_SESSION['email'];
$traineremail = $_POST['traineremail'];
$option = $_POST['option'];

if ($option == "bond") {
    // update user's bondTo status
    $sql = "UPDATE users SET bondTo = '$traineremail' WHERE email = '$useremail'";
    $req = $conn->prepare($sql);
    $req->execute();
    
    // send notification to trainer
    $msg = "A Trainee - $useremail, has decided to bond to your training.";
    $sql2 = "INSERT into notificationlog VALUES ('$msg', '$traineremail', '0')";
    $req2 = $conn->prepare($sql2);
    $req2->execute();
    
    // remove all other trainee's 1-1 training with other trainers
    $sql3 = "DELETE FROM personalsession WHERE category = '1-1 Training' AND trainerEmail != '$traineremail' AND traineeEmail = '$useremail'";
    $req3 = $conn->prepare($sql3);
    $req3->execute();
    
    header('Location: ../trainee_trainerCalendar.php?t=' . $traineremail);
    
} else if ($option == "unbound") {
    $sql = "UPDATE users SET bondTo = '' WHERE email = '$useremail'";
    $req = $conn->prepare($sql);
    $req->execute();
    header('Location: ../trainee_trainerCalendar.php?t=' . $traineremail);
    
} else {
    echo "Error";
}

?>