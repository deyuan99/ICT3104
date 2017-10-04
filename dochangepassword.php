<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
   session_start();
   require_once('database/dbconfig.php');
   
    if (isset($_POST['oldpassword']) && isset($_POST['password']) && isset($_POST['cfmpassword'])){

     $oldpassword = $_POST['oldpassword'];
     $password = $_POST['password']; 
     $cfmpassword = $_POST['cfmpassword']; 
     $email = $_SESSION['email'];
     
     $sql = "SELECT * FROM user WHERE Email = '$email'";
    
      $req = $conn->prepare($sql);
      $req->execute();
      $rows = $req->fetchAll();
      
      foreach ($rows as $row):
      $current = $row['Password'];
      endforeach;
      
      if($current!= sha1($oldpassword)) {
           $error = "Please key in the correct password";
            echo "<script type='text/javascript'>alert('$error');"
                 . "window.location.href='changepassword.php';"
                 . "</script>";
         
    } else {
        echo $email;
        echo $cfmpassword;
        $stmt1 = "UPDATE user SET Password = sha1('$cfmpassword') WHERE Email='$email'";
            $stmt = $conn->prepare($stmt1);
            $stmt->execute();
         echo $stmt->rowCount() . " records UPDATED successfully";
           $success = "Password has been updated";
         echo "<script type='text/javascript'>alert('$success');"
                 . "window.location.href='changepassword.php';"
                 . "</script>";
        }
    
    
    }else{
        $error = "Please Fill in the from";
         echo "<script type='text/javascript'>alert('$error');"
                 . "window.location.href='changepassword.php';"
                 . "</script>";
        }
        
    

?>

