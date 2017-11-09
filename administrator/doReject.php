<?php
require('../database/dbconfig.php');

$email = $_POST['reject_userid'];

$sql = "DELETE FROM userapproval WHERE email = '$email'";
$query = $conn->prepare($sql);
$stmt = $query->execute();

//reject for groupsession
$id = $_POST['reject_userid'];
$sql3 = "UPDATE groupsession SET status = 'Rejected' WHERE id = '$id'";
$query4 = $conn->prepare($sql3);
$stmt3 = $query4->execute();

header('Location: user-approval.php');
exit();

