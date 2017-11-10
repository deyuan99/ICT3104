<?php
	$id = $_POST['evid'];

?>

<?php
// connect to database
session_start();
require_once('database/dbconfig.php');
if (isset($_POST['cost']) && isset($_POST['description']) && isset($_POST['starttime']) && isset($_POST['endtime']) && isset($_POST['evid'])){
	
	$id = $_POST['evid'];
        $eventdate = $_POST['date'];
	$description = $_POST['description'];
        $startTime = $_POST['starttime'];
        $endTime = $_POST['endtime'];
        $cost = $_POST['cost'];
        $todaydate = date('Y-m-d H:i:s');
        $combinedstart = date('Y-m-d H:i:s', strtotime("$eventdate $startTime"));

        $hourdiff = round((strtotime($combinedstart) - strtotime($todaydate))/3600, 1);
        if($hourdiff  < 0){
           echo "<script type='text/javascript'>alert('Cant edit past event!');"
             . "window.location.href='trainer_dashboard.php';"
              . "</script>";    
        }else{
	//category = '$category'
	$sql = "UPDATE personalsession SET cost = '$cost', startTime = '$startTime', endTime = '$endTime', description = '$description' WHERE id = '$id' ";

	
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
        }
}
	
if (isset($_POST['delete']) && isset($_POST['evid'])){
	session_start();

        $Semail = $_SESSION['email'];
    
        $eventdate = $_POST['date'];
        $category = $_POST['category'];
        $start= $_POST['starttime'];
        $combinedstart = date('Y-m-d H:i:s', strtotime("$eventdate $start"));
        
        $todaydate = date('Y-m-d H:i:s');
        
        $hourdiff = round((strtotime($combinedstart) - strtotime($todaydate))/3600, 1);
        if($hourdiff  < 0){
           echo "<script type='text/javascript'>alert('Cant delete past event!');"
             . "window.location.href='trainer_dashboard.php';"
              . "</script>";    
        }else{
        if ($category == 'Personal Training' ){
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
            
        }
        }
}	
