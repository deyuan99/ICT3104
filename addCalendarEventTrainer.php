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
    
    // if category is personal
    if ($category == 'Personal Training') {
    
        if ($starttime == $endtime ||$endtime < $starttime){
           echo "<script type='text/javascript'>alert('select appropriate timing');" . "window.location.href='trainer_dashboard.php';" . "</script>";
        }else{

        //same date same time and end date inside the range
        $sql1        = "select * from personalsession where date = '$dateformat' AND startTime >= '$starttime' AND endTime >= '$endtime'";
        $req         = $conn->prepare($sql1);
        $req->execute();


        if ($req->rowCount() >= 1) {
            echo "<script type='text/javascript'>alert('exist event');" . "window.location.href='trainer_dashboard.php';" . "</script>";

        } else {
            //start date inside range
            $sql2 = "select * from personalsession where  date = '$dateformat' AND startTime  <= '$starttime' AND  endTime <= '$endtime' ";
            $req2 = $conn->prepare($sql2);
            $req2->execute();
            if ($req2->rowCount() >= 1) {

                echo "<script type='text/javascript'>alert('exist event');" . "window.location.href='trainer_dashboard.php';" . "</script>";

            } else {

                $sql3 = "select * from personalsession where  date = '$dateformat' AND startTime  < '$starttime' AND  endTime > '$endtime' ";
                $req3 = $conn->prepare($sql3);
                $req3->execute();
                if ($req3->rowCount() >= 1) {

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
                           echo "<script type='text/javascript'>alert('submitted successfully!');"
                            . "window.location.href='trainer_dashboard.php';"
                            . "</script>";
                    } else {
                        echo "<script type='text/javascript'>alert('failed');" . "window.location.href='trainer_dashboard.php';" . "</script>";
                    }
                }
            }
            }
        }
    }
    
    // 1v1 training
    else if ($category == '1-1 Training') {
        $typename = $_POST['typeofTraining'];
        
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
            echo "<script type='text/javascript'>alert('submitted successfully!');"
            . "window.location.href='trainer_dashboard.php';"
            . "</script>";
        } else {
            echo "<script type='text/javascript'>alert('failed');" . "window.location.href='trainer_dashboard.php';" . "</script>";
        }
    }
    
    
    // group training
    else {
        $typename = $_POST['typeofTraining'];
        $groupsize = $_POST['groupsize'];
        
        $sql = "INSERT INTO groupsession(roomTypeID, typeofTrainingID, startTime, endTime, date, description, trainerEmail, groupCapacity, status) values ((SELECT id FROM roomtype WHERE name = '$roomtype' AND venueID = (SELECT id FROM venue WHERE location = '$venue')),"
                . "(SELECT id FROM typeoftraining WHERE trainingName = '$typename'),"
                . "'$starttime','$endtime','$dateformat','$description','$Semail','$groupsize','Pending')";

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
            echo "<script type='text/javascript'>alert('proposal submitted successfully!');"
            . "window.location.href='trainer_dashboard.php';"
            . "</script>";
        } else {
            echo "<script type='text/javascript'>alert('failed');" . "window.location.href='trainer_dashboard.php';" . "</script>";
        }
    }
}

