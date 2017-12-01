<?php
$id = $_POST['id'];
$category      = $_POST['category'];
?>


<html
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>   
<script>
    function cancel() {
                var id = "<?php echo $id;?>";
                var category = "<?php echo $category;?>";
                
    if (confirm("you are about to cancel an event which start less than 48hours,fees will not be refund") === true) {
            $.ajax({
                url: "DeleteEvent.php",
                type: "POST",
                data: {'id' : id,'category' : category},
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
session_start();

if (isset($_POST['delete']) && isset($_POST['id'])) {
    
    $Semail = $_SESSION['email'];
    
    $eventdate     = $_POST['date'];
    $category      = $_POST['category'];
    $start         = $_POST['starttime'];
    $combinedstart = date('Y-m-d H:i:s', strtotime("$eventdate $start"));
    
    $todaydate = date('Y-m-d H:i:s');
    
    $hourdiff = round((strtotime($combinedstart) - strtotime($todaydate)) / 3600, 1);
    if ($hourdiff < 0) {
        echo "<script type='text/javascript'>alert('Cant delete past event!');" . "window.location.href='trainee_dashboard.php';" . "</script>";
    } else {
        if ($category == 'Personal Training') {
            $sql   = "DELETE FROM personalsession WHERE id = '$id'";
            $query = $conn->prepare($sql);
            if ($query == false) {
                print_r($conn->errorInfo());
                die('Error prepare');
            }
            $res = $query->execute();
            if ($res == false) {
                print_r($query->errorInfo());
                die('Error execute');
            }
            if ($query) {
                echo "<script type='text/javascript'>alert('submitted successfully!');" . "window.location.href='trainee_dashboard.php';" . "</script>";
            } else {
                echo "<script type='text/javascript'>alert('failed');" . "window.location.href='trainee_dashboard.php';" . "</script>";
            }
            
        } else if ($category == '1-1 Training') {
            if ($hourdiff < 48) {
                echo "<script> cancel(); </script>";
            } else {
                // Notification to trainer
                $sql22 = "SELECT * FROM personalsession where id = '$id' ";
                $req22 = $conn->prepare($sql22);
                $req22->execute();
                $row22 = $req22->fetch(PDO::FETCH_ASSOC);
                $dateformat = $row22['date'];
                $starttime = $row22['startTime'];
                $endtime = $row22['endTime'];
                $trainerEmail = $row22['trainerEmail'];

                // send a notification to the trainer
                $msg5 = "Trainee $Semail has left your 1-1 training on $dateformat at $start";
                $sql5 = "INSERT into notificationlog (message, userEmail, readStatus) VALUES ('$msg5', '$trainerEmail', '0')";
                $query5 = $conn->prepare($sql5);
                $query5->execute();
                
                $sql   = "UPDATE personalsession SET traineeEmail = '' WHERE id = '$id' ";
                $query = $conn->prepare($sql);
                if ($query == false) {
                    print_r($conn->errorInfo());
                    die('Error prepare');
                }
                $res = $query->execute();
                
                if ($res == false) {
                    print_r($query->errorInfo());
                    die('Error execute');
                }
                if ($query) {
                    echo "<script type='text/javascript'>alert('Delete successfully!');" . "window.location.href='trainee_dashboard.php';" . "</script>";
                } else {
                    echo "<script type='text/javascript'>alert('failed');" . "window.location.href='trainee_dashboard.php';" . "</script>";
                }
            }
        } else {
            if ($hourdiff < 48) {
                echo "<script> cancel(); </script>";
            } else {
                
                $sql   = "DELETE FROM groupsessionapplicant WHERE groupsessionID = '$id' and traineeEmail='$Semail'  ";
                $query = $conn->prepare($sql);
                if ($query == false) {
                    print_r($conn->errorInfo());
                    die('Error prepare');
                }
                $res = $query->execute();
                
                if ($res == false) {
                    print_r($query->errorInfo());
                    die('Error execute');
                }
                if ($query) {
                    echo "<script type='text/javascript'>alert('Delete successfully!');" . "window.location.href='trainee_dashboard.php';" . "</script>";
                } else {
                    echo "<script type='text/javascript'>alert('failed');" . "window.location.href='trainee_dashboard.php';" . "</script>";
                }
            }
        }
    }
    
} elseif (isset($_POST['category']) && isset($_POST['description']) && isset($_POST['starttime']) && isset($_POST['endtime']) && isset($_POST['id']) && isset($_POST['save'])) {
    $Semail      = $_SESSION['email'];
    $id          = $_POST['id'];
    $category    = $_POST['category'];
    $description = $_POST['description'];
    $startTime   = $_POST['starttime'];
    $endTime     = $_POST['endtime'];
    $todaydate   = date('Y-m-d H:i:s');
    $eventdate   = $_POST['date'];
    $dateformat  = date('Y-m-d', strtotime($eventdate));
    
    if ($startTime == $endTime || $endTime < $startTime) {
        echo "<script type='text/javascript'>alert('select appropriate timing');" . "window.location.href='trainee_dashboard.php';" . "</script>";
    } else {
        
        // 1) check if already book at starttime 2)its booked at the end time and the last one 3) check is already book in between
        $sql1 = "select * from personalsession where date = '$dateformat' AND ((startTime <= '$startTime' AND '$startTime' < endTime) OR (startTime < '$endTime' AND '$endTime' < endTime) OR ('$startTime' < startTime AND startTime < '$endTime')) AND traineeEmail = '$Semail'";
        //echo $sql1;
        $req = $conn->prepare($sql1);
        $req->execute();
        
        if ($req->rowCount() >= 1) {
            echo "<script type='text/javascript'>alert('exist event');" . "window.location.href='trainee_dashboard.php';" . "</script>";
            
        } else {
            
            $sql = "UPDATE personalsession SET category = '$category', startTime = '$startTime', endTime = '$endTime', description = '$description' WHERE id = '$id' ";
            
            
            $query = $conn->prepare($sql);
            if ($query == false) {
                print_r($conn->errorInfo());
                die('Error prepare');
            }
            $sth = $query->execute();
            if ($sth == false) {
                print_r($query->errorInfo());
                die('Error execute');
            }
            if ($query) {
                echo "<script type='text/javascript'>alert('submitted successfully!');" . "window.location.href='trainee_dashboard.php';" . "</script>";
            } else {
                echo "<script type='text/javascript'>alert('failed');" . "window.location.href='trainee_dashboard.php';" . "</script>";
            }
        }
    }
    
}

?>