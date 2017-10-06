<?php
require('../database/dbconfig.php');
$email = $_POST['reactivate_userid'];
$sql = "UPDATE users SET status = 1 WHERE email = '$email'";
$req = $conn->prepare($sql);
$req->execute();
header('Location: user-management.php');
exit();

