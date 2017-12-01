<?php
require('../database/dbconfig.php');

$content = $_POST['aboutus'];

echo $content;

$sql2 = "UPDATE aboutus SET content = '$content' WHERE id = '1'";
$req2 = $conn->prepare($sql2);
$req2->execute();

header('Location: manageGym.php');

?>

