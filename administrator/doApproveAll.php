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
}
