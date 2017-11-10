<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require('../database/dbconfig.php');
$id = $_POST['eid'];
$sql4 = "UPDATE groupsession SET status = 'Deleted' WHERE id = '$id'";
$query5 = $conn->prepare($sql4);
$stmt4 = $query5->execute();
header('Location: user-groupsession.php');
exit();


