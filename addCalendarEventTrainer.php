<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

// connect to database
session_start();
require_once('database/dbconfig.php');

if (isset($_POST['category']) && isset($_POST['starttime']) && isset($_POST['endtime']) && isset($_POST['description']) && isset($_POST['cost'])){
	 $Semail = $_SESSION['email'];
         $Sname = $_SESSION['name'];

         $date = $_POST['date'];
         $dateformat = date('Y-m-d',strtotime($date));
	 $category= $_POST['category'];
	 $starttime = $_POST['starttime'];
         $endtime = $_POST['endtime'];
         $description = $_POST['description'];
         $cost = $_POST['cost'];

	$sql = "INSERT INTO personalsession(category, cost, startTime, endTime,date,description,trainerEmail) values ('$category', '$cost', '$starttime', '$endtime','$dateformat','$description','$Semail')";
	//$req = $bdd->prepare($sql);
	//$req->execute();
		echo $sql;
	
	$query = $conn->prepare( $sql );
	if ($query == false) {
	 print_r($conn->errorInfo());
	 die ('Error prepare');
	}
	$sth = $query->execute();
	if ($sth == false) {
	 print_r($query->errorInfo());
	 die ('Error execute');
	}
        
   //   if( $query ){ 
  //      echo "<script type='text/javascript'>alert('submitted successfully!');"
  //      . "window.location.href='trainer_dashboard.php';"
  //      . "</script>";
  //    }
//      else
 //  echo "<script type='text/javascript'>alert('failed');"
 //       . "window.location.href='trainer_dashboard.php';"
 //       . "</script>";    

}
	