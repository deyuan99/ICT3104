<?php

function getTrainee() {
    require('../database/dbconfig.php');
    $sql = "SELECT * FROM users WHERE role = 'trainee' and status = 1";
    $req = $conn->prepare($sql);
    $req->execute();
    $rows = $req->fetchAll();
    if (!empty($rows)) {
        foreach ($rows as $row):
            $role = "trainee";
            $email = $row['email'];
            $firstName = $row['firstName'];
            $lastName = $row['lastName'];
            $address = $row['address'];
            $mobile = $row['phoneNumber'];
            $password = $row['password'];
            $expiryDate = $row['expiryDate'];
            $registerDate=$row['registerDate'];
            $profileBio=$row['profileBio'];
            $profilePicture = $row['profilePicture'];
            echo "<tr>";
            echo "<td class=\"col-md-2\">"
            . "<a data-toggle=\"modal\" data-target=\"#viewUserModal\" onclick=\"setViewInfo('$email','$firstName', '$lastName', '$address', '$mobile','$registerDate','$profileBio','$profilePicture', '$role')\" style=\"color:blue;\"><U>$email</U></a>"
            . "</td>";
            echo "<td class=\"col-md-1\">$firstName</td>";
            echo "<td class=\"col-md-1\">$lastName</td>";
            echo "<td class=\"col-md-2\">$address</td>";
            echo "<td class=\"col-md-1\">$mobile</td>";
            echo "<td class=\"col-md-1\">*****</td>";
            echo "<td class=\"col-md-1\">$expiryDate</td>";
            echo "<td class=\"col-md-3 padding-l15-r15\" >";
            echo "<a data-toggle=\"modal\" data-target=\"#editUserModal\" onclick=\"setEditInfo('$email','$firstName', '$lastName', '$address', '$mobile', '$password')\" class=\"btn btn-info btn-sm col-md-5\"><span class=\"glyphicon glyphicon-pencil icon-space\"></span>EDIT</a>";
            echo "<a data-toggle=\"modal\" data-target=\"#deactivateUserModal\" onclick=\"setDeactivateInfo('$email')\" class=\"btn btn-danger btn-sm col-md-offset-1 col-md-6\"><span class=\"glyphicon glyphicon-remove icon-space\"></span>DEACTIVATE</a>";
            echo "</td></tr>";
        endforeach;
    }
    else {
        echo "<tr><td colspan = \"12\" style=\"text-align:center;\">";
        echo "No trainee record found";
        echo "</td></tr>";
    }
}

function getTrainer() {
    require('../database/dbconfig.php');
    $sql = "SELECT * FROM users WHERE role = 'trainer' and status = 1";
    $req = $conn->prepare($sql);
    $req->execute();
    $rows = $req->fetchAll();
    if (!empty($rows)) {
        foreach ($rows as $row):
            $role = "trainer";
            $email = $row['email'];
            $firstName = $row['firstName'];
            $lastName = $row['lastName'];
            $address = $row['address'];
            $mobile = $row['phoneNumber'];
            $password = $row['password'];
            $profileBio = $row['profileBio'];
            $featured = $row['featuredStatus'];
            $registerDate=$row['registerDate'];
            $profilePicture = $row['profilePicture'];
            if ($featured == 1) {
                $featured = "Yes";
            } else {
                $featured = "No";
            }
            
            echo "<tr>";
            echo "<tr>";
            echo "<td class=\"col-md-2\">"
            . "<a data-toggle=\"modal\" data-target=\"#viewUserModal\" onclick=\"setViewInfo('$email','$firstName', '$lastName', '$address', '$mobile','$registerDate','$profileBio','$profilePicture','$role')\" style=\"color:blue;\"><U>$email</U></a>"
            . "</td>";
            echo "<td class=\"col-md-1\">$firstName</td>";
            echo "<td class=\"col-md-1\">$lastName</td>";
            echo "<td class=\"col-md-1\">$address</td>";
            echo "<td class=\"col-md-1\">$mobile</td>";
            //echo "<td class=\"col-md-2\">$profileBio</td>";
            echo "<td class=\"col-md-1\">$featured</td>";
            echo "<td class=\"col-md-3 padding-l15-r15\" >";
            // TODO add edit bio
            echo "<a data-toggle=\"modal\" data-target=\"#editUserModal\" onclick=\"setEditInfo('$email','$firstName', '$lastName', '$address', '$mobile', '$password')\" class=\"btn btn-info btn-sm col-md-5\"><span class=\"glyphicon glyphicon-pencil icon-space\"></span>EDIT</a>";
            echo "<a data-toggle=\"modal\" data-target=\"#deactivateUserModal\" onclick=\"setDeactivateInfo('$email')\" class=\"btn btn-danger btn-sm col-md-offset-1 col-md-6\"><span class=\"glyphicon glyphicon-remove icon-space\"></span>DEACTIVATE</a>";
            echo "</td></tr>";
        endforeach;
    }
    else {
        echo "<tr><td colspan = \"12\" style=\"text-align:center;\">";
        echo "No trainer record found";
        echo "</td></tr>";
    }
}

function getDeactivated() {
    require('../database/dbconfig.php');
    $sql = "SELECT * FROM users WHERE status = 0 and (role = 'trainer' or role = 'trainee')";
    $req = $conn->prepare($sql);
    $req->execute();
    $rows = $req->fetchAll();
    if (!empty($rows)) {
        foreach ($rows as $row):
            $email = $row['email'];
            $firstName = $row['firstName'];
            $lastName = $row['lastName'];
            $address = $row['address'];
            $role = $row['role'];
            $register = $row['registerDate'];
            $expiryDate = $row['expiryDate'];
            echo "<tr>";
            echo "<td class=\"col-md-2\">$email</td>";
            echo "<td class=\"col-md-1\">$firstName</td>";
            echo "<td class=\"col-md-1\">$lastName</td>";
            echo "<td class=\"col-md-2\">$address</td>";
            echo "<td class=\"col-md-1\">$role</td>";
            echo "<td class=\"col-md-1\">$register</td>";
            echo "<td class=\"col-md-1\">$expiryDate</td>";
            echo "<td class=\"col-md-3 padding-l15-r15\" >";
            echo "<a data-toggle=\"modal\" data-target=\"#reactivateUserModal\" onclick=\"setReactivateInfo('$email')\" class=\"btn btn-warning btn-sm col-md-12\"><span class=\"glyphicon glyphicon-refresh icon-space\"></span>REACTIVATE</a>";
            echo "</td></tr>";
        endforeach;
    }
    else {
        echo "<tr><td colspan = \"12\" style=\"text-align:center;\">";
        echo "No deactivated user record found";
        echo "</td></tr>";
    }
}
