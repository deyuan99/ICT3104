<?php
// connect to database
session_start();
require_once('database/dbconfig.php');
//echo $_POST['title'];
if (isset($_POST['category']) && isset($_POST['starttime']) && isset($_POST['endtime']) && isset($_POST['description'])) {
    $date       = $_POST['date'];
    $roomtype   = $_POST['roomtype'];
    $venue      = $_POST['venue'];
    $dateformat = date('Y-m-d', strtotime($date));
    $starttime  = $_POST['starttime'];
    $Semail     = $_SESSION['email'];
    $Sname      = $_SESSION['name'];
    
    $category    = $_POST['category'];
    $endtime     = $_POST['endtime'];
    $description = $_POST['description'];

    if ($starttime == $endtime || $endtime < $starttime) {
        echo "<script type='text/javascript'>alert('select appropriate timing');" . "window.location.href='trainee_dashboard.php';" . "</script>";
    } else {
        
       // $sql1 = "select * from personalsession where date = '$dateformat' AND startTime = '$starttime' AND endTime = '$endtime' AND traineeEmail = '$Semail'";
        // 1) check if already book at starttime 2)its booked at the end time and the last one 3) check is already book in between
        $sql1 = "select * from personalsession where date = '$dateformat' AND ((startTime <= '$starttime' AND '$starttime' < endTime) OR (startTime < '$endtime' AND '$endtime' < endTime) OR ('$starttime' < startTime AND startTime < '$endtime')) AND traineeEmail = '$Semail'";
        echo $sql1;
        $req  = $conn->prepare($sql1);
        $req->execute();
        
        if ($req->rowCount() >= 1) {
            echo "<script type='text/javascript'>alert('exist event');" . "window.location.href='trainee_dashboard.php';" . "</script>";
            
        } else {
                    // (1)get the number from personal training on this date, roomtype and venue and startime
                    $sql6 = "SELECT COUNT(*) as total_rows FROM personalsession p,roomtype r, venue v where p.roomTypeID=r.id and v.id = r.venueID and p.date ='$dateformat' and p.startTime = '$starttime' and r.name = '$roomtype' and v.location = '$venue'";
                    $req1 = $conn->prepare($sql6);
                    $req1->execute();
                    $row        = $req1->fetch(PDO::FETCH_ASSOC);
                    $total_rows = $row['total_rows'];
                    
                    //(2) get the group cap base on this date, roomtype and venue and startime
                    $totalgroupcap = 0;
                    $sql9          = "SELECT * FROM groupsession g,roomtype r, venue v where g.roomTypeID=r.id and v.id = r.venueID and date= '$dateformat'and g.startTime = '$starttime' and status = 'Approved' and r.name = '$roomtype' and v.location = '$venue' ";
                    $req2          = $conn->prepare($sql9);
                    $req2->execute();
                    $coungroup = $req2->rowCount();
                    if ($coungroup > 0) {
                        while ($row2 = $req2->fetch(PDO::FETCH_ASSOC)) {
                            $grpcap        = $row2['groupCapacity'];
                            $totalgroupcap = $grpcap + $totalgroupcap;
                        }
                    }
                    
                    //(3)get the number limit base on  roomtype and venue
                    $sql12 = "SELECT capacity FROM roomtype r, venue v where v.id = r.venueID and r.name = '$roomtype' and v.location = '$venue' ";
                    $req3  = $conn->prepare($sql12);
                    $req3->execute();
                    $row3     = $req3->fetch(PDO::FETCH_ASSOC);
                    $capacity = $row3['capacity'];
                    
                    $currenttotalevent = $totalgroupcap + $total_rows;
                    //comparing
                    if ($currenttotalevent >= $capacity) {
                        echo "<script type='text/javascript'>alert('Unable to book due to capacity reached');" . "window.location.href='trainee_dashboard.php';" . "</script>";
                    } else {
                        
                        $sql = "INSERT INTO personalsession(category, roomTypeID, startTime, endTime, date, description, traineeEmail) values ('$category', (SELECT id FROM roomtype WHERE name = '$roomtype' AND venueID = (SELECT id FROM venue WHERE location = '$venue')), '$starttime', '$endtime','$dateformat','$description','$Semail')";
                        
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
}
