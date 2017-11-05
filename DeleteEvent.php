<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once('database/dbconfig.php');
      $id = $_POST['id'];
      echo $id;
   $sql = "UPDATE personalsession SET traineeEmail = ' ' WHERE id = '$id' ";
                $query = $conn->prepare( $sql );
                if ($query == false) {
                 print_r($conn->errorInfo());
                 die ('Error prepare');
                }
                $res = $query->execute();
                if ($res == false) {
                 print_r($query->errorInfo());
                 die ('Error execute');
                }
                 if( $query ){ 
                     echo "<script type='text/javascript'>alert('submitted successfully!');"
                     . "window.location.href='trainee_dashboard.php';"
                     . "</script>";
                   }
                     else{
                 echo "<script type='text/javascript'>alert('failed');"
                     . "window.location.href='trainee_dashboard.php';"
                      . "</script>";    
                     }

?>

