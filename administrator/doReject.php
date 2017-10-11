<?php
require('../database/dbconfig.php');

$email = $_POST['reactivate_userid'];

$sql = "DELETE FROM userapproval WHERE email = '$email'";
$query = $conn->prepare($sql);
$stmt = $query->execute();

header('Location: user-approval.php');
exit();

