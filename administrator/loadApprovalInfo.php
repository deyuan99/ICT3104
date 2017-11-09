<?php

function getApprovalUsers() {
    require('../database/dbconfig.php');
    $sql = "SELECT firstName, lastName, email, phoneNumber, role FROM userapproval";
    $query = $conn->prepare($sql);
    $stmt = $query->execute();
    $result = $query->fetchAll();
    if(count($result) > 0) {
        foreach ($result as $row):
            $email = $row['email'];
            $firstName = $row['firstName'];
            $lastName = $row['lastName'];
            $mobile = $row['phoneNumber'];
            $role = $row['role'];
            echo "<tr>";
            echo "<td class=\"col-md-2\">$email</td>";
            echo "<td class=\"col-md-2\">$firstName</td>";
            echo "<td class=\"col-md-2\">$lastName</td>";
            echo "<td class=\"col-md-2\">$mobile</td>";
            echo "<td class=\"col-md-1\">$role</td>";
            echo "<td class=\"col-md-3 padding-l15-r15\" >";
            echo "<a data-toggle=\"modal\" data-target=\"#approveUserModal\" onclick=\"setApproveInfo('$email')\" class=\"btn btn-info btn-sm col-md-6\"><span class=\"glyphicon glyphicon-ok icon-space\"></span>APPROVE</a>";
            echo "<a data-toggle=\"modal\" data-target=\"#rejectUserModal\" onclick=\"setRejectInfo('$email')\" class=\"btn btn-danger btn-sm col-md-offset-1 col-md-5\"><span class=\"glyphicon glyphicon-remove icon-space\"></span>REJECT</a>";
            echo "</td></tr>";
        endforeach;
    }
    else {
        echo "<tr><td colspan = \"6\" style=\"text-align:center;\">";
        echo "No trainee record found";
        echo "</td></tr>";
    }
}


function getApprovalGrouptraining() {
    require('../database/dbconfig.php');
    //$sql1 = "SELECT id, venue, startTime, endTime, date, description, trainerEmail, groupCapacity, status FROM groupsession where status = 'pending'";
    //$sql1 = "SELECT gs.id, gs.trainerEmail, tt.trainingName, rt.name, gs.groupCapacity, gs.date, gs.status FROM((groupsession gs INNER JOIN roomtype rt ON gs.roomTypeID = rt.id ) INNER JOIN typeoftraining tt ON gs.typeofTrainingID = tt.id) where gs.status = ‘Pending'";
    //$sql1 ="select gs.id, gs.trainerEmail, v.location, t.trainingName, r.name, gs.groupCapacity, gs.date, gs.status from groupSession gs, venue v, roomtype r, typeoftraining t where v.id = r.venueID and r.id = gs.roomTypeID and t.id = gs.typeofTrainingID and gs.status = ‘Pending'";
    $sql1 = "SELECT id, trainerEmail, date, groupCapacity, status, (SELECT name FROM roomtype WHERE id=roomTypeID) AS name, (SELECT venueID FROM roomtype WHERE id=roomTypeID) AS venueID, (SELECT location FROM venue WHERE id=venueID) AS location, (SELECT trainingName FROM typeoftraining where id=typeofTrainingID) AS trainingName FROM groupsession WHERE status = 'Pending'";
    $query1 = $conn->prepare($sql1);
    $stmt1 = $query1->execute();
    $result1 = $query1->fetchAll();
    if(count($result1) > 0) {
        foreach ($result1 as $row):
            $id = $row['id'];
            $trainerEmail = $row['trainerEmail'];
            $venue = $row['location'];
            $typeoftraining = $row['trainingName'];
            $roomtype = $row['name'];
            $groupCapacity = $row['groupCapacity'];
            $date = $row['date'];
            $status = $row['status'];
            echo "<tr>";
            //echo "<td class=\"col-md-1\">$id</td>";
            echo "<td class=\"col-md-2\">$trainerEmail</td>";
            echo "<td class=\"col-md-1\">$venue</td>";
            echo "<td class=\"col-md-1\">$typeoftraining</td>";
            echo "<td class=\"col-md-2\">$roomtype</td>";
            echo "<td class=\"col-md-1\">$groupCapacity</td>";
            echo "<td class=\"col-md-1\">$date</td>";
            //echo "<td class=\"col-md-2\">$description</td>";
            echo "<td class=\"col-md-1\">$status</td>";
            echo "<td class=\"col-md-3 padding-l15-r15\" >";
            echo "<a data-toggle=\"modal\" data-target=\"#approveUserModal\" onclick=\"setApproveInfo('$id')\" class=\"btn btn-info btn-sm col-md-6\"><span class=\"glyphicon glyphicon-ok icon-space\"></span>APPROVE</a>";
            echo "<a data-toggle=\"modal\" data-target=\"#rejectUserModal\" onclick=\"setRejectInfo('$id')\" class=\"btn btn-danger btn-sm col-md-offset-1 col-md-5\"><span class=\"glyphicon glyphicon-remove icon-space\"></span>REJECT</a>";
            echo "</td></tr>";
        endforeach;
    }
    else {
        echo "<tr><td colspan = \"6\" style=\"text-align:center;\">";
        echo "No Pending events record found";
        echo "</td></tr>";
    }
}

function getApprovedGrouptraining() {
    require('../database/dbconfig.php');
    //$sql2 = "SELECT venue, startTime, endTime, date, description, trainerEmail, status FROM groupsession where status = 'Approved'";
    //$sql2 = "SELECT id, trainerEmail, date, groupCapacity, status, (SELECT name FROM roomtype WHERE id=roomTypeID) AS name, (SELECT trainingName FROM typeoftraining where id=typeofTrainingID) AS trainingName FROM groupsession WHERE status = 'Approved'";
    $sql2 = "SELECT id, trainerEmail, date, groupCapacity, status, (SELECT name FROM roomtype WHERE id=roomTypeID) AS name, (SELECT venueID FROM roomtype WHERE id=roomTypeID) AS venueID, (SELECT location FROM venue WHERE id=venueID) AS location, (SELECT trainingName FROM typeoftraining where id=typeofTrainingID) AS trainingName FROM groupsession WHERE status = 'Approved'";
    $query2 = $conn->prepare($sql2);
    $stmt2 = $query2->execute();
    $result2 = $query2->fetchAll();
    if(count($result2) > 0) {
        foreach ($result2 as $row):
            $trainerEmail = $row['trainerEmail'];
            $venue = $row['location'];
            $typeoftraining = $row['trainingName'];
            $roomtype = $row['name'];
            $groupCapacity = $row['groupCapacity'];
            $date = $row['date'];
            $status = $row['status'];
            echo "<tr>";
            echo "<td class=\"col-md-2\">$trainerEmail</td>";
            echo "<td class=\"col-md-1\">$venue</td>";
            echo "<td class=\"col-md-1\">$typeoftraining</td>";
            echo "<td class=\"col-md-2\">$roomtype</td>";
            echo "<td class=\"col-md-1\">$groupCapacity</td>";
            echo "<td class=\"col-md-1\">$date</td>";
            echo "<td class=\"col-md-1\">$status</td>";
            echo "</td></tr>";
        endforeach;
    }
    else {
        echo "<tr><td colspan = \"6\" style=\"text-align:center;\">";
        echo "No Approved events record found";
        echo "</td></tr>";
    }
}

function getRejectedGrouptraining() {
    require('../database/dbconfig.php');
    //$sql3 = "SELECT venue, startTime, endTime, date, description, trainerEmail, status FROM groupsession where status = 'Rejected'";
    //$sql3 = "SELECT id, trainerEmail, date, groupCapacity, status, (SELECT name FROM roomtype WHERE id=roomTypeID) AS name, (SELECT trainingName FROM typeoftraining where id=typeofTrainingID) AS trainingName FROM groupsession WHERE status = 'Rejected'";
    $sql3 = "SELECT id, trainerEmail, date, groupCapacity, status, (SELECT name FROM roomtype WHERE id=roomTypeID) AS name, (SELECT venueID FROM roomtype WHERE id=roomTypeID) AS venueID, (SELECT location FROM venue WHERE id=venueID) AS location, (SELECT trainingName FROM typeoftraining where id=typeofTrainingID) AS trainingName FROM groupsession WHERE status = 'Rejected'";
    $query3 = $conn->prepare($sql3);
    $stmt3 = $query3->execute();
    $result3 = $query3->fetchAll();
    if(count($result3) > 0) {
        foreach ($result3 as $row):
            $trainerEmail = $row['trainerEmail'];
            $venue = $row['location'];
            $typeoftraining = $row['trainingName'];
            $roomtype = $row['name'];
            $groupCapacity = $row['groupCapacity'];
            $date = $row['date'];
            $status = $row['status'];
            echo "<tr>";
            echo "<td class=\"col-md-2\">$trainerEmail</td>";
            echo "<td class=\"col-md-1\">$venue</td>";
            echo "<td class=\"col-md-1\">$typeoftraining</td>";
            echo "<td class=\"col-md-2\">$roomtype</td>";
            echo "<td class=\"col-md-1\">$groupCapacity</td>";
            echo "<td class=\"col-md-1\">$date</td>";
            echo "<td class=\"col-md-1\">$status</td>";
            echo "</td></tr>";
        endforeach;
    }
    else {
        echo "<tr><td colspan = \"6\" style=\"text-align:center;\">";
        echo "No Rejected events record found";
        echo "</td></tr>";
    }
}