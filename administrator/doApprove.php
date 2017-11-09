<?php
require('../database/dbconfig.php');

$email = $_POST['approve_userid'];

// copy from userapproval to users table
$sql = "INSERT INTO users (email, firstName, lastName, phoneNumber, profilePicture, role, password, address, subscription, registerDate, expiryDate) SELECT * FROM userapproval WHERE email = '$email'";
$query = $conn->prepare($sql);
$stmt = $query->execute();

$sql2 = "UPDATE users SET status = 1 WHERE email = '$email'";
$query2 = $conn->prepare($sql2);
$stmt2 = $query2->execute();

// delete from userapproval table
$rmsql = "DELETE FROM userapproval WHERE email = '$email'";
$query3 = $conn->prepare($rmsql);
$stmt = $query3->execute();
header('Location: user-approval.php#trainee_tab');

//update groupsession status to approved
$id = $_POST['approve_userid'];
$sql3 = "UPDATE groupsession SET status = 'Approved' WHERE id = '$id'";
$query4 = $conn->prepare($sql3);
$stmt3 = $query4->execute();

header('Location: user-approval.php#trainer_tab');
exit();

