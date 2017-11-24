<?php

function getCurrentPromotions() {
    require('../database/dbconfig.php');
    $sql = "SELECT * FROM promotions";
    $req = $conn->prepare($sql);
    $req->execute();
    $rows = $req->fetchAll();
    if (!empty($rows)) {
        foreach ($rows as $row):
            $id = $row['id'];
            $title = $row['title'];
            $description = $row['description'];
            $imagePath = $row['imagePath'];
            $featuredStatus = $row['featuredStatus'];
            
            // check if date expired            
            $startDate = $row['startDate'];
            $endDate = $row['endDate'];
            
            echo "<tr>";
            echo "<td class=\"col-md-1\">$id</td>";
            echo "<td class=\"col-md-2\">$title</td>";
            echo "<td class=\"col-md-1\">$description</td>";
            echo "<td class=\"col-md-1\">$startDate</td>";
            echo "<td class=\"col-md-2\">$endDate</td>";
            echo "<td class=\"col-md-1\">$imagePath</td>";
            echo "<td class=\"col-md-1\">$featuredStatus</td>";
            echo "<td class=\"col-md-3 padding-l15-r15\" >";
            echo "<a data-toggle=\"modal\" data-target=\"#editPromoModal\" onclick=\"setEditPromo('$id', '$title','$description', '$startDate', '$endDate', '$imagePath', '$featuredStatus')\" class=\"btn btn-info btn-sm col-md-5\"><span class=\"glyphicon glyphicon-pencil icon-space\"></span>EDIT</a>";
            echo "<a data-toggle=\"modal\" data-target=\"#deletePromoModal\" onclick=\"setDeletePromo('promotions', '$id', '$title')\" class=\"btn btn-danger btn-sm col-md-offset-1 col-md-5\"><span class=\"glyphicon glyphicon-remove icon-space\"></span>DELETE</a>";
            
            echo "</td></tr>";
        endforeach;
    }
    else {
        echo "<tr><td colspan = \"12\" style=\"text-align:center;\">";
        echo "No promotions found";
        echo "</td></tr>";
    }
}
