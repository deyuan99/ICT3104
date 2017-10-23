<?php



// connect to database
session_start();
require_once('database/dbconfig.php');

	 $Semail = $_SESSION['email'];
         $Sname = $_SESSION['name'];

         $id = $_POST['evid'];

	$sql = "UPDATE personalsession set traineeEmail = '$Semail' WHERE id = '$id'";
	//$req = $bdd->prepare($sql
	//$req->execute();
	//	echo $sql;
	
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
     . "window.location.href='trainer_dashboard.php';"
     . "</script>";
   }
     else{
 echo "<script type='text/javascript'>alert('failed');"
     . "window.location.href='trainer_dashboard.php';"
      . "</script>";    
     }

	
