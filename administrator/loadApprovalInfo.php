<?php

function getApprovalUsers() {
    require('../database/dbconfig.php');
    $sql = "SELECT firstName, lastName, email, phoneNumber, role, subscription, registerDate, address FROM userapproval";
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
            $subscription = $row['subscription'];
            $registerDate = $row['registerDate'];
            $address = $row['address'];            
            echo "<tr>";
            echo "<td class=\"col-md-2\">$email</td>";
            echo "<td class=\"col-md-1\">$firstName</td>";
            echo "<td class=\"col-md-1\">$lastName</td>";
            echo "<td class=\"col-md-1\">$mobile</td>";
            echo "<td class=\"col-md-1\">$role</td>";
            echo "<td class=\"col-md-1\">$subscription</td>";
            echo "<td class=\"col-md-1\">$registerDate</td>";
            echo "<td class=\"col-md-1\">$address</td>";
            echo "<td class=\"col-md-3 padding-l15-r15\" >";
            echo "<a data-toggle=\"modal\" data-target=\"#approveUserModal\" onclick=\"setApproveInfo('$email')\" class=\"btn btn-info btn-sm col-md-6\"><span class=\"glyphicon glyphicon-ok\"></span> APPROVE</a>";
            echo "<a data-toggle=\"modal\" data-target=\"#rejectUserModal\" onclick=\"setRejectInfo('$email')\" class=\"btn btn-danger btn-sm col-md-offset-1 col-md-5\"><span class=\"glyphicon glyphicon-remove\"></span> REJECT</a>";
            echo "</td></tr>";
        endforeach;
    }
    else {
        echo "<tr><td colspan = \"9\" style=\"text-align:center;\">";
        echo "No trainee record found";
        echo "</td></tr>";
    }
}
