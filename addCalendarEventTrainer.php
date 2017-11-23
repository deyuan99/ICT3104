<?php
// connect to database
session_start();
require_once('database/dbconfig.php');

if (isset($_POST['Pcategory']) && isset($_POST['starttime']) && isset($_POST['endtime']) && isset($_POST['description'])) {
    $Semail = $_SESSION['email'];
    $Sname  = $_SESSION['name'];
    
    $date        = $_POST['date'];
    $dateformat  = date('Y-m-d', strtotime($date));
    $category    = $_POST['Pcategory'];
    $starttime   = $_POST['starttime'];
    $endtime     = $_POST['endtime'];
    $description = $_POST['description'];
    $venue       = $_POST['venue'];
    $roomtype    = $_POST['roomtype'];
    
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
        echo "<script type='text/javascript'>alert('Unable to book due to capacity reached');" . "window.location.href='trainer_dashboard.php';" . "</script>";
    } else {
        
        // if category is personal
        if ($category == 'Personal Training') {
            
            if ($starttime == $endtime || $endtime < $starttime) {
                echo "<script type='text/javascript'>alert('select appropriate timing');" . "window.location.href='trainer_dashboard.php';" . "</script>";
            } else {
                
                // 1) check if already book at starttime 2)its booked at the end time and the last one 3) check is already book in between
                $sql1 = "select * from personalsession where date = '$dateformat' AND ((startTime <= '$starttime' AND '$starttime' < endTime) OR (startTime < '$endtime' AND '$endtime' < endTime) OR ('$starttime' < startTime AND startTime < '$endtime')) AND trainerEmail = '$Semail'";
                $req  = $conn->prepare($sql1);
                $req->execute();
                if ($req->rowCount() >= 1) {
                    echo "<script type='text/javascript'>alert('exist event');" . "window.location.href='trainer_dashboard.php';" . "</script>";
                } else {
                    // 1) check if already book at starttime 2)its booked at the end time and the last one 3) check is already book in between
                    $sql2 = "select * from groupsession where date = '$dateformat' AND ((startTime <= '$starttime' AND '$starttime' < endTime) OR (startTime < '$endtime' AND '$endtime' < endTime) OR ('$starttime' < startTime AND startTime < '$endtime')) AND trainerEmail = '$Semail'";
                    $req  = $conn->prepare($sql2);
                    $req->execute();
                    if ($req->rowCount() >= 1) {
                        echo "<script type='text/javascript'>alert('exist event');" . "window.location.href='trainer_dashboard.php';" . "</script>";
                    } else {
                        $sql = "INSERT INTO personalsession(category, roomTypeID, startTime, endTime, date, description, trainerEmail) values ('$category', (SELECT id FROM roomtype WHERE name = '$roomtype' AND venueID = (SELECT id FROM venue WHERE location = '$venue')), '$starttime', '$endtime','$dateformat','$description','$Semail')";
                        //$req = $bdd->prepare($sql);
                        //$req->execute();
                        //    echo $sql;
                        // echo "<script type='text/javascript'>alert('here!');</script>";
                        
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
                            //   echo "<script type='text/javascript'>alert('submitted successfully!');"
                            //     . "window.location.href='trainer_dashboard.php';"
                            //     . "</script>";
                        } else {
                            echo "<script type='text/javascript'>alert('failed');" . "window.location.href='trainer_dashboard.php';" . "</script>";
                        }
                    }
                    
                    
                }
            }
            
        }
        
        // 1v1 training
        else if ($category == '1-1 Training') {
            $typename = $_POST['typeofTraining'];
            if ($starttime == $endtime || $endtime < $starttime) {
                echo "<script type='text/javascript'>alert('select appropriate timing');" . "window.location.href='trainer_dashboard.php';" . "</script>";
            } else {
                
                // 1) check if already book at starttime 2)its booked at the end time and the last one 3) check is already book in between
                $sql1 = "select * from personalsession where date = '$dateformat' AND ((startTime <= '$starttime' AND '$starttime' < endTime) OR (startTime < '$endtime' AND '$endtime' < endTime) OR ('$starttime' < startTime AND startTime < '$endtime')) AND trainerEmail = '$Semail'";
                $req  = $conn->prepare($sql1);
                $req->execute();
                if ($req->rowCount() >= 1) {
                    echo "<script type='text/javascript'>alert('exist event');" . "window.location.href='trainer_dashboard.php';" . "</script>";
                } else {
                    // 1) check if already book at starttime 2)its booked at the end time and the last one 3) check is already book in between
                    $sql2 = "select * from groupsession where date = '$dateformat' AND ((startTime <= '$starttime' AND '$starttime' < endTime) OR (startTime < '$endtime' AND '$endtime' < endTime) OR ('$starttime' < startTime AND startTime < '$endtime')) AND trainerEmail = '$Semail'";
                    $req  = $conn->prepare($sql2);
                    $req->execute();
                    if ($req->rowCount() >= 1) {
                        echo "<script type='text/javascript'>alert('exist event');" . "window.location.href='trainer_dashboard.php';" . "</script>";
                    } else {
                        $sql = "INSERT INTO personalsession(category, roomTypeID, typeofTrainingID, startTime, endTime, date, description, trainerEmail) values ('$category', (SELECT id FROM roomtype WHERE name = '$roomtype' AND venueID = (SELECT id FROM venue WHERE location = '$venue')), (SELECT id FROM typeoftraining WHERE trainingName = '$typename'), '$starttime', '$endtime','$dateformat','$description','$Semail')";
                        
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
                            echo "<script type='text/javascript'>alert('submitted successfully!');" . "window.location.href='trainer_dashboard.php';" . "</script>";
                        } else {
                            echo "<script type='text/javascript'>alert('failed');" . "window.location.href='trainer_dashboard.php';" . "</script>";
                        }
                    }
                }
            }
        }
        
        
        // group training
        else {
            $typename  = $_POST['typeofTraining'];
            $groupsize = $_POST['groupsize'];
            if ($starttime == $endtime || $endtime < $starttime) {
                echo "<script type='text/javascript'>alert('select appropriate timing');" . "window.location.href='trainer_dashboard.php';" . "</script>";
            } else {
                
                // 1) check if already book at starttime 2)its booked at the end time and the last one 3) check is already book in between
                $sql1 = "select * from personalsession where date = '$dateformat' AND ((startTime <= '$starttime' AND '$starttime' < endTime) OR (startTime < '$endtime' AND '$endtime' < endTime) OR ('$starttime' < startTime AND startTime < '$endtime')) AND trainerEmail = '$Semail'";
                $req  = $conn->prepare($sql1);
                $req->execute();
                if ($req->rowCount() >= 1) {
                    echo "<script type='text/javascript'>alert('exist event');" . "window.location.href='trainer_dashboard.php';" . "</script>";
                } else {
                    // 1) check if already book at starttime 2)its booked at the end time and the last one 3) check is already book in between
                    $sql2 = "select * from groupsession where date = '$dateformat' AND ((startTime <= '$starttime' AND '$starttime' < endTime) OR (startTime < '$endtime' AND '$endtime' < endTime) OR ('$starttime' < startTime AND startTime < '$endtime')) AND trainerEmail = '$Semail'";
                    $req  = $conn->prepare($sql2);
                    $req->execute();
                    if ($req->rowCount() >= 1) {
                        echo "<script type='text/javascript'>alert('exist event');" . "window.location.href='trainer_dashboard.php';" . "</script>";
                    } else {
                        $sql = "INSERT INTO groupsession(roomTypeID, typeofTrainingID, startTime, endTime, date, description, trainerEmail, groupCapacity, status) values ((SELECT id FROM roomtype WHERE name = '$roomtype' AND venueID = (SELECT id FROM venue WHERE location = '$venue'))," . "(SELECT id FROM typeoftraining WHERE trainingName = '$typename')," . "'$starttime','$endtime','$dateformat','$description','$Semail','$groupsize','Pending')";
                        
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
                        
                        // send a notification to the admin
                        $notification = "Trainer " . $Semail . " has created a group session";
                        $notificationsql = "INSERT INTO notificationlog (message, userEmail, readStatus) VALUES ('$notification', 'admin1@gmail.com', 0)";
                        $query2 = $conn->prepare($notificationsql);
                        $query2->execute();
                        
                        if ($query) {
                            echo "<script type='text/javascript'>alert('proposal submitted successfully!');" . "window.location.href='trainer_dashboard.php';" . "</script>";
                        } else {
                            echo "<script type='text/javascript'>alert('failed');" . "window.location.href='trainer_dashboard.php';" . "</script>";
                        }
                    }
                }
            }
        }
    }
}