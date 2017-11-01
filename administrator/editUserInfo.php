<?php

require('../database/dbconfig.php');
$email = $_POST['edit_email'];
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$address = $_POST['address'];
$mobile = $_POST['mobile'];

/* $sql = "UPDATE users SET firstName = $firstName, lastName = $lastName, address =$address, phoneNumber = $mobile WHERE email = '$email'";
  $req = $conn->prepare($sql);
  $req->execute(); */

//this doesn't work
/*$sqlF = "UPDATE users SET firstName = $firstName WHERE email = '$email'";
$reqF = $conn->prepare($sqlF);
$reqF->execute();*/

$sql = "UPDATE users SET phoneNumber = $mobile WHERE email = '$email'";
$req = $conn->prepare($sql);
$req->execute();

if (is_numeric($mobile) && $mobile > 9999999 && $mobile < 100000000) {
    //if i were to put $sql...$req in here it won't work either
}
header('Location: user-management.php');
exit();

