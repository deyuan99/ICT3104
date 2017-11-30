<?php
require('../database/dbconfig.php');

$email = $_POST['unbond_userid'];
$traineremail = $_POST['trainer_userid'];

// send notification to trainee
$msg = "Trainer - $traineremail, has unbond you from his trainings.";
$sql2 = "INSERT into notificationlog (message, userEmail, readStatus) VALUES ('$msg', '$email', '0')";
$req2 = $conn->prepare($sql2);
$req2->execute();

// delete from userapproval table
$rmsql = "UPDATE users SET bondTo = '' WHERE email = '$email'";
$query3 = $conn->prepare($rmsql);
$stmt = $query3->execute();
header('Location: ../trainer_traineeList.php');
   
exit();

