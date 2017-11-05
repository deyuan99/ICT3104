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
    $sql1 = "SELECT id, venue, startTime, endTime, date, description, trainerEmail, groupCapacity, status FROM groupsession";
    $query1 = $conn->prepare($sql1);
    $stmt1 = $query1->execute();
    $result1 = $query1->fetchAll();
    if(count($result1) > 0) {
        foreach ($result1 as $row):
            $id = $row['id'];
            $trainerEmail = $row['trainerEmail'];
            $venue = $row['venue'];
            $groupCapacity = $row['groupCapacity'];
            $date = $row['date'];
            $startTime = $row['startTime'];
            $endTime = $row['endTime'];
            //$description = $row['description'];
            $status = $row['status'];
            echo "<tr>";
            //echo "<td class=\"col-md-1\">$id</td>";
            echo "<td class=\"col-md-2\">$trainerEmail</td>";
            echo "<td class=\"col-md-1\">$venue</td>";
            echo "<td class=\"col-md-1\">$groupCapacity</td>";
            echo "<td class=\"col-md-2\">$date</td>";
            echo "<td class=\"col-md-1\">$startTime</td>";
            echo "<td class=\"col-md-1\">$endTime</td>";
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
        echo "No trainee record found";
        echo "</td></tr>";
    }
}