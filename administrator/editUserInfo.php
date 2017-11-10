<?php

require('../database/dbconfig.php');


$email = $_POST['edit_email'];

$sql = "SELECT * FROM users WHERE email = '$email' and status = 1";
$req = $conn->prepare($sql);
$req->execute();
$rows = $req->fetchAll();
if (!empty($rows)) {
    foreach ($rows as $row):
        $firstName = $row['firstName'];
        $lastName = $row['lastName'];
        $address = $row['address'];
        $mobile = $row['phoneNumber'];
        $password = $row['password'];
    endforeach;
}
else {
    echo "No trainee record found";
}


//$firstName = $_POST['firstName'];
//$lastName = $_POST['lastName'];
//$address = $_POST['address'];
//$mobile = $_POST['mobile'];

$firstName = empty($_POST['firstName']) ? $firstName : $_POST['firstName'];
$lastName = empty($_POST['lastName']) ? $lastName : $_POST['lastName'];
$address = empty($_POST['address']) ? $address : $_POST['address'];
$mobile = empty($_POST['mobile']) ? $mobile : $_POST['mobile'];
$password = empty($_POST['pass']) ? $password : $_POST['pass']; 


$sql = "UPDATE users SET firstName = '$firstName', lastName = '$lastName', address ='$address', phoneNumber = '$mobile', password = '$password' WHERE email = '$email'";
$req = $conn->prepare($sql);
$req->execute();

if (is_numeric($mobile) && $mobile > 9999999 && $mobile < 100000000) {
    //if i were to put $sql...$req in here it won't work either
}
header('Location: user-management.php');
exit();

?>
