<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

// connect to database

require_once('database/dbconfig.php');

if (isset($_POST['delete']) && isset($_POST['id'])){
	

	$id = $_POST['id'];
        
	
	$sql = "DELETE FROM personalsession WHERE id = '$id'";
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
	
}elseif (isset($_POST['category']) && isset($_POST['description']) && isset($_POST['starttime']) && isset($_POST['endtime']) && isset($_POST['id'])){
	
	$id = $_POST['id'];
	$category = $_POST['category'];
	$description = $_POST['description'];
        $startTime = $_POST['starttime'];
        $endTime = $_POST['endtime'];
        
	
	$sql = "UPDATE personalsession SET category = '$category', startTime = '$startTime', endTime = '$endTime', description = '$description' WHERE id = '$id' ";

	
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
}




