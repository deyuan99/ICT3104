<?php

function getVenue() {
    require('../database/dbconfig.php');
    $sql = "SELECT * FROM venue";
    $req = $conn->prepare($sql);
    $req->execute();
    $rows = $req->fetchAll();
    if (!empty($rows)) {
        foreach ($rows as $row):
            $id = $row['id'];
            $location = $row['location'];
            $address = $row['address'];
            $contact = $row['contact'];
            echo "<tr>";
            echo "<td class=\"col-md-1\">$id</td>";
            echo "<td class=\"col-md-2\">$location</td>";
            echo "<td class=\"col-md-5\">$address</td>";
            echo "<td class=\"col-md-1\">$contact</td>";
            echo "<td class=\"col-md-3 padding-l15-r15\" >";
            echo "<a data-toggle=\"modal\" data-target=\"#editGymModal\" onclick=\"setEditInfo('venue', '$id','$location', '$address', '$contact')\" class=\"btn btn-info btn-sm col-md-5\"><span class=\"glyphicon glyphicon-pencil icon-space\"></span>EDIT</a>";
            echo "<a data-toggle=\"modal\" data-target=\"#deleteModal\" onclick=\"setDeleteInfo('venue', '$id','$location')\" class=\"btn btn-danger btn-sm col-md-offset-1 col-md-6\"><span class=\"glyphicon glyphicon-remove icon-space\"></span>DELETE</a>";
            echo "</td></tr>";
        endforeach;
    }
    else {
        echo "<tr><td colspan = \"12\" style=\"text-align:center;\">";
        echo "No venue record found";
        echo "</td></tr>";
    }
}

function getRoom() {
    require('../database/dbconfig.php');
    $sql = "SELECT * FROM roomtype";
    $req = $conn->prepare($sql);
    $req->execute();
    $rows = $req->fetchAll();
    if (!empty($rows)) {
        foreach ($rows as $row):
            $id = $row['id'];
            $name = $row['name'];
            $capacity = $row['capacity'];
            $venueID = $row['venueID'];
            echo "<tr>";
            echo "<td class=\"col-md-1\">$id</td>";
            echo "<td class=\"col-md-4\">$name</td>";
            echo "<td class=\"col-md-2\">$capacity</td>";
            echo "<td class=\"col-md-2\">$venueID</td>";
            echo "<td class=\"col-md-3 padding-l15-r15\" >";
            // TODO add edit bio
            echo "<a data-toggle=\"modal\" data-target=\"#editGymModal\" onclick=\"setEditInfo('room','$id','$name', '$capacity', '$venueID')\" class=\"btn btn-info btn-sm col-md-5\"><span class=\"glyphicon glyphicon-pencil icon-space\"></span>EDIT</a>";
            echo "<a data-toggle=\"modal\" data-target=\"#deleteModal\" onclick=\"setDeleteInfo('room','$id','$name')\" class=\"btn btn-danger btn-sm col-md-offset-1 col-md-6\"><span class=\"glyphicon glyphicon-remove icon-space\"></span>DELETE</a>";
            echo "</td></tr>";
        endforeach;
    }
    else {
        echo "<tr><td colspan = \"12\" style=\"text-align:center;\">";
        echo "No room type record found";
        echo "</td></tr>";
    }
}

function getTrainingType() {
    require('../database/dbconfig.php');
    $sql = "SELECT * FROM typeoftraining";
    $req = $conn->prepare($sql);
    $req->execute();
    $rows = $req->fetchAll();
    if (!empty($rows)) {
        foreach ($rows as $row):
            $id = $row['id'];
            $trainingName = $row['trainingName'];
            $cost = $row['cost'];
            echo "<tr>";
            echo "<td class=\"col-md-1\">$id</td>";
            echo "<td class=\"col-md-6\">$trainingName</td>";
            echo "<td class=\"col-md-2\">$cost</td>";
            echo "<td class=\"col-md-3 padding-l15-r15\" >";
            // TODO add edit bio
            echo "<a data-toggle=\"modal\" data-target=\"#editGymModal\" onclick=\"setEditInfo('training','$id','$trainingName', '$cost')\" class=\"btn btn-info btn-sm col-md-5\"><span class=\"glyphicon glyphicon-pencil icon-space\"></span>EDIT</a>";
            echo "<a data-toggle=\"modal\" data-target=\"#deleteModal\" onclick=\"setDeleteInfo('training','$id','$trainingName')\" class=\"btn btn-danger btn-sm col-md-offset-1 col-md-6\"><span class=\"glyphicon glyphicon-remove icon-space\"></span>DELETE</a>";
            echo "</td></tr>";
        endforeach;
    }
    else {
        echo "<tr><td colspan = \"12\" style=\"text-align:center;\">";
        echo "No training type record found";
        echo "</td></tr>";
    }
}

function getAboutus() {
    require('../database/dbconfig.php');
    $sql = "SELECT * FROM aboutus";
    $req = $conn->prepare($sql);
    $req->execute();
    $row = $req->fetch(PDO::FETCH_ASSOC);
    $about = $row['content'];
    echo "<textarea class=\"form-control\" rows=\"8\" id=\"aboutus\" name=\"aboutus\">$about</textarea>";
}