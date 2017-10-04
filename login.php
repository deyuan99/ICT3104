<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
   session_start();
   require_once('database/dbconfig.php');

     $email = $_POST['email'];
     $password = $_POST['password']; 
     
     $sql = "SELECT * FROM user WHERE Email = '$email' and Password = sha1('$password')";
    
      $req = $conn->prepare($sql);
      $req->execute();
      $rows = $req->fetchAll();
      
      foreach ($rows as $row):
      $role = $row['Role'];
      $name = $row['Name'];
      endforeach;
      
      if($req->rowCount()==1) {
         $_SESSION['email'] = $email;
         $_SESSION['name'] = $name;
         $_SESSION['role'] = $role;
         
         if ($role == "te") {
            header("location: trainee_dashboard.php");
         }else if($role == "tr"){
             header("location: trainer_dashboard.php");
         }else{
            header("location: admin_dashboard.php");
         }
      }else {
         $error = "Your Login email or Password is invalid";
         echo "<script type='text/javascript'>alert('$error');"
                 . "window.location.href='registration.php';"
                 . "</script>";

      }

?>

