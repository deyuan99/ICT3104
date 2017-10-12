<?php
require('../database/dbconfig.php');
$email = $_POST['deactivate_userid'];
$sql = "UPDATE users SET status = 0 WHERE email = '$email'";
$req = $conn->prepare($sql);
$req->execute();
header('Location: user-management.php');
exit();

