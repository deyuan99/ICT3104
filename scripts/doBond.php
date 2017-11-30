<?php
require('../database/dbconfig.php');
session_start();

$useremail = $_SESSION['email'];
$traineremail = $_POST['traineremail'];
$option = $_POST['option'];

if ($option == "bond") {
    // check if exist bond request
    $sql4 = "SELECT * FROM bondapproval where traineeEmail = '$email'";
    $req4 = $conn->prepare($sql4);
    $req4->execute();
    $bondInfo = $req4->fetch(PDO::FETCH_ASSOC);
    if(count($bondInfo) == 1) {
    
        // update bondapproval table
        $sql = "INSERT into bondapproval (trainerEmail, traineeEmail) VALUES ('$traineremail', '$useremail')";
        $req = $conn->prepare($sql);
        $req->execute();

        // send notification to trainer
        $msg = "A Trainee - $useremail, has proposed to bond to your training.";
        $sql2 = "INSERT into notificationlog (message, userEmail, readStatus) VALUES ('$msg', '$traineremail', '0')";
        $req2 = $conn->prepare($sql2);
        $req2->execute();

        // remove all other trainee's 1-1 training email with other trainers
        $sql3 = "UPDATE personalsession SET traineeEmail = '' WHERE category = '1-1 Training' AND trainerEmail != '$traineremail' AND traineeEmail = '$useremail'";
        $req3 = $conn->prepare($sql3);
        $req3->execute();

        header('Location: ../trainee_trainerCalendar.php?t=' . $traineremail);
    } else {
        echo "Error, bond request already exists!";
    }
    
} else if ($option == "unbound") {
    $sql = "UPDATE users SET bondTo = '' WHERE email = '$useremail'";
    $req = $conn->prepare($sql);
    $req->execute();
    header('Location: ../trainee_trainerCalendar.php?t=' . $traineremail);
    
} else {
    echo "Error";
}

?>