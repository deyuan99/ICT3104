<?php

function getPromotions() {
    require('../database/dbconfig.php');
    $sql = "SELECT * FROM promotions";
    $req = $conn->prepare($sql);
    $req->execute();
    $rows = $req->fetchAll();
    if (!empty($rows)) {
        foreach ($rows as $row):
            $title = $row['title'];
            $desription = $row['description'];
            $startDate = $row['startDate'];
            $endDate = $row['endDate'];
            $imagePath = $row['imagePath'];
            $featuredStatus = $row['featuredStatus'];
            echo "<tr>";
            echo "<td class=\"col-md-2\">$title</td>";
            echo "<td class=\"col-md-1\">$desription</td>";
            echo "<td class=\"col-md-1\">$startDate</td>";
            echo "<td class=\"col-md-2\">$endDate</td>";
            echo "<td class=\"col-md-1\">$imagePath</td>";
            echo "<td class=\"col-md-1\">$featuredStatus</td>";
            echo "<td class=\"col-md-3 padding-l15-r15\" >";
            echo "<a data-toggle=\"modal\" data-target=\"#editUserModal\" onclick=\"setEditInfo('$title','$desription', '$startDate', '$endDate', '$featuredStatus')\" class=\"btn btn-info btn-sm col-md-5\"><span class=\"glyphicon glyphicon-pencil icon-space\"></span>EDIT</a>";
            echo "</td></tr>";
        endforeach;
    }
    else {
        echo "<tr><td colspan = \"12\" style=\"text-align:center;\">";
        echo "No promotions found";
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
            $email = $row['email'];
            $firstName = $row['firstName'];
            $lastName = $row['lastName'];
            $address = $row['address'];
            $mobile = $row['phoneNumber'];
            $password = $row['password'];
            $bio = $row['profileBio'];
            $featured = $row['featuredStatus'];
            if ($featured == 1) {
                $featured = "Yes";
            } else {
                $featured = "No";
            }
            
            echo "<tr>";
            echo "<td class=\"col-md-2\">$email</td>";
            echo "<td class=\"col-md-1\">$firstName</td>";
            echo "<td class=\"col-md-1\">$lastName</td>";
            echo "<td class=\"col-md-1\">$address</td>";
            echo "<td class=\"col-md-1\">$mobile</td>";
            echo "<td class=\"col-md-2\">$bio</td>";
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

