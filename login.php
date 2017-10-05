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
     
     $sql = "SELECT * FROM user WHERE email = '$email' and password = sha1('$password')";
    
      $req = $conn->prepare($sql);
      $req->execute();
      $rows = $req->fetchAll();
      
      foreach ($rows as $row):
      $role = $row['role'];
      $firstname = $row['firstName'];
      $lastname = $row['lastName'];
      endforeach;
      
      if($req->rowCount()==1) {
         $_SESSION['email'] = $email;
         $_SESSION['name'] = $lastname.' '.$firstname;
         $_SESSION['role'] = $role;
         if(!empty($_POST["copy"])) {
				setcookie ("member_login",$email,time()+ (10 * 365 * 24 * 60 * 60));
				setcookie ("member_password",$password,time()+ (10 * 365 * 24 * 60 * 60));
			} else {
				if(isset($_COOKIE["member_login"])) {
					setcookie ("member_login","");
				}
				if(isset($_COOKIE["member_password"])) {
					setcookie ("member_password","");
				}
			}
         
         if ($role == "trainee") {
            header("location: trainee_dashboard.php");
         }else if($role == "trainer"){
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

