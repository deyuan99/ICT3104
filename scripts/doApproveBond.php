<?php

require('../database/dbconfig.php');

$email = $_POST['approve_userid'];

$sql4 = "SELECT * FROM bondapproval where traineeEmail = '$email'";
$req4 = $conn->prepare($sql4);
$req4->execute();
$bondInfo = $req4->fetch(PDO::FETCH_ASSOC);
$traineremail = $bondInfo['trainerEmail'];

// send notification to trainee
$msg = "Trainer - $traineremail, has approved your bond request.";
$sql2 = "INSERT into notificationlog (message, userEmail, readStatus) VALUES ('$msg', '$email', '0')";
$req2 = $conn->prepare($sql2);
$req2->execute();

// update user's bondTo status
$sql = "UPDATE users SET bondTo = '$traineremail' WHERE email = '$email'";
$req = $conn->prepare($sql);
$req->execute();

// delete from userapproval table
$rmsql = "DELETE FROM bondapproval WHERE traineeEmail = '$email'";
$query3 = $conn->prepare($rmsql);
$stmt = $query3->execute();
header('Location: ../trainer_traineeList.php#approvebond_tab');

exit();
?>