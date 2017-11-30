<?php
function getBondApprovalUsers($Semail, $conn) {
    $sql = "SELECT * FROM bondapproval ba 
            JOIN users u ON ba.traineeEmail = u.email
            WHERE ba.trainerEmail='$Semail'";
    $query = $conn->prepare($sql);
    $stmt = $query->execute();
    $result = $query->fetchAll();
    if(count($result) > 0) {
        foreach ($result as $row):
            $email = $row['email'];
            $firstName = $row['firstName'];
            $lastName = $row['lastName'];
            $mobile = $row['phoneNumber'];        
            echo "<tr>";
            echo "<td class=\"col-md-3\">$email</td>";
            echo "<td class=\"col-md-3\">$firstName $lastName</td>";
            echo "<td class=\"col-md-3\">$mobile</td>";
            echo "<td class=\"col-md-3 padding-l15-r15\" >";
            echo "<a data-toggle=\"modal\" data-target=\"#approveUserModal\" onclick=\"setApproveInfo('$email')\" class=\"btn btn-info btn-sm col-md-6\"><span class=\"glyphicon glyphicon-ok\"></span> APPROVE</a>";
            echo "<a data-toggle=\"modal\" data-target=\"#rejectUserModal\" onclick=\"setRejectInfo('$email')\" class=\"btn btn-danger btn-sm col-md-offset-1 col-md-5\"><span class=\"glyphicon glyphicon-remove\"></span> REJECT</a>";
            echo "</td></tr>";
        endforeach;
    }
    else {
        echo "<tr><td colspan = \"12\" style=\"text-align:center;\">";
        echo "No user record found";
        echo "</td></tr>";
    }
}
