<?php


//$sql = "SELECT * FROM users WHERE role = 'trainer' and status = 1";
//$req = $conn->prepare($sql);
//$req->execute();
//$rows = $req->fetchAll();
$email = $_POST['edit_email'];
//$firstName = $_POST['firstName'];
$sql = "SELECT * FROM users WHERE email = '$email' and status = 1";
$req = $conn->prepare($sql);
$req->execute();
$rows = $req->fetchAll();
if (!empty($rows)) {
    foreach ($rows as $row):
        $profilePicture = $row['profilePicture'];
        $firstName = $row['firstName'];
        $lastName = $row['lastName'];
        $address = $row['address'];
        $mobile = $row['phoneNumber'];
        $registerDate = $row['registerDate'];
        $profileBio = $row['profileBio'];
    endforeach;
}
else {
    echo "No trainee record found";
}
$profilePicture = empty($_POST['profilePicture']) ? $profilePicture : $_POST['profilePicture'];
$firstName = empty($_POST['firstName']) ? $firstName : $_POST['firstName'];
$lastName = empty($_POST['lastName']) ? $lastName : $_POST['lastName'];
$address = empty($_POST['address']) ? $address : $_POST['address'];
$mobile = empty($_POST['mobile']) ? $mobile : $_POST['mobile'];
$registerDate = empty($_POST['registerDate']) ? $registerDate : $_POST['registerDate'];
$profileBio = empty($_POST['profileBio']) ? profileBio : $_POST['profileBio'];


header('Location: user-management.php');
exit();

?>

