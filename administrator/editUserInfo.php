<?php

require('../database/dbconfig.php');
$email = $_POST['edit_email'];
$mobile = $_POST['mobile'];
if (is_numeric($mobile) && $mobile > 9999999 && $mobile < 100000000) {
    $sql = "UPDATE users SET phoneNumber = $mobile WHERE email = '$email'";
    $req = $conn->prepare($sql);
    $req->execute();
}
header('Location: user-management.php');
exit();

