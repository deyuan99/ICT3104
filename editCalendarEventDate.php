<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once('database/dbconfig.php');

if (isset($_POST['Event'][0]) && isset($_POST['Event'][1]) && isset($_POST['Event'][2]) && isset($_POST['Event'][3])){
	
	
	$id = $_POST['Event'][0];
	$startTime = $_POST['Event'][1];
	$endTime = $_POST['Event'][2];
        $date = $_POST['Event'][3];
        $dateformat = date('Y-m-d',strtotime($date));
        

	$sql = "UPDATE personalsession SET startTime = '$startTime', endTime = '$endTime', date = '$dateformat' WHERE id = '$id' ";

	
	$query = $conn->prepare( $sql );
	if ($query == false) {
	 print_r($conn->errorInfo());
	 die ('Error prepare');
	}
	$sth = $query->execute();
	if ($sth == false) {
	 print_r($query->errorInfo());
	 die ('Error execute');
	}else{
		die ('OK');
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