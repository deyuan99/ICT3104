<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

// connect to database
session_start();
require_once('database/dbconfig.php');
$eventID = $_POST['eid'];
$email = $_SESSION['email'];

$sql = "INSERT INTO groupsessionapplicant VALUES ($eventID, '$email')";
$req = $conn->prepare($sql);
$req->execute();

header('Location: trainee_dashboard.php?t='.$trainerEmail);
exit();
