<?php
	$id = $_POST['id'];

?>


<html
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>   
<script>
    function cancel() {
                var id = "<?php echo $id; ?>";
              console.log("public Key: ", id);
    if (confirm("you are about to cancel an event which start less than 48hours,fees will not be refund") === true) {
            $.ajax({
                url: "DeleteEvent.php",
                type: "POST",
                data: {'id' : id},
                success: function() {
                    alert("Succesfully deleted!");
                    window.location.href='trainee_dashboard.php'         

                }
            });  
        } else {
         alert('cancel unsuccessful')
         window.location.href='trainee_dashboard.php'         
    }
    }
</script>
</html>
<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

// connect to database

require_once('database/dbconfig.php');

if (isset($_POST['delete']) && isset($_POST['id'])){
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
             . "window.location.href='trainee_dashboard.php';"
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
             . "window.location.href='trainee_dashboard.php';"
             . "</script>";
           }
             else{
         echo "<script type='text/javascript'>alert('failed');"
             . "window.location.href='trainee_dashboard.php';"
              . "</script>";    
             }
            
        }else{
            if ($hourdiff<48){
            echo "<script> cancel(); </script>";
            }
            else
                {
                
                   $sql = "UPDATE personalsession SET traineeEmail = '' WHERE id = '$id' ";
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
                     echo "<script type='text/javascript'>alert('Delete successfully!');"
                     . "window.location.href='trainee_dashboard.php';"
                     . "</script>";
                   }
                     else{
                 echo "<script type='text/javascript'>alert('failed');"
                     . "window.location.href='trainee_dashboard.php';"
                      . "</script>";    
                     }
            }
        }
        }
	
}elseif (isset($_POST['category']) && isset($_POST['description']) && isset($_POST['starttime']) && isset($_POST['endtime']) && isset($_POST['id']) && isset($_POST['save'])){
	
	$id = $_POST['id'];
	$category = $_POST['category'];
	$description = $_POST['description'];
        $startTime = $_POST['starttime'];
        $endTime = $_POST['endtime'];
        $todaydate = date('Y-m-d H:i:s');
        $combinedstart = date('Y-m-d H:i:s', strtotime("$eventdate $startTime"));
         $hourdiff = round((strtotime($combinedstart) - strtotime($todaydate))/3600, 1);
        if($hourdiff  < 0){
           echo "<script type='text/javascript'>alert('Cant edit past event!');"
             . "window.location.href='trainee_dashboard.php';"
              . "</script>";    
        }else{
         
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
}
?>


