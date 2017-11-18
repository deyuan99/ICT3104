<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require('../database/dbconfig.php');

if(isset($_POST["id"]))
{
 foreach($_POST["id"] as $id)
 {
  
    $sql4 = "UPDATE groupsession SET status = 'Approved' WHERE id = '$id'";
    $query5 = $conn->prepare($sql4);
    $stmt4 = $query5->execute();
 }
}elseif (isset($_POST["email"])) {
   foreach($_POST["email"] as $email)
 {
  
    // copy from userapproval to users table
    $sql = "INSERT INTO users (email, firstName, lastName, phoneNumber, profilePicture, role, password, address, subscription, registerDate, expiryDate) SELECT * FROM userapproval WHERE email = '$email'";
    $query = $conn->prepare($sql);
    $stmt = $query->execute();

    $sql2 = "UPDATE users SET status = 1 WHERE email = '$email'";
    $query2 = $conn->prepare($sql2);
    $stmt2 = $query2->execute();

    // delete from userapproval table
    $rmsql = "DELETE FROM userapproval WHERE email = '$email'";
    $query3 = $conn->prepare($rmsql);
    $stmt = $query3->execute();
 } 
}
