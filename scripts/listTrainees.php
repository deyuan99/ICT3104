<?php

$id = $_SESSION['email'];

//$sqlTraineeName = "SELECT * FROM personalsession WHERE trainerEmail='$id' AND category='1-1 training'";

$sqlTraineeName = "SELECT * FROM personalsession ps 
JOIN users u ON ps.traineeEmail = u.email 
JOIN typeoftraining t ON ps.typeofTrainingID = t.id 
WHERE ps.trainerEmail='$id' 
AND ps.category='1-1 training'";
$result = $conn->prepare($sqlTraineeName);
$result->execute();

$count = $result->rowCount();

if ($count > 0) {
    while ($trainee = $result->fetch(PDO::FETCH_ASSOC)) {
        $firstName = $trainee['firstName'];
        $lastName = $trainee['lastName'];
        $email = $trainee['traineeEmail'];
        $typeofTraining = $trainee['trainingName'];
        $description = $trainee['description'];
        $bond = $trainee['bondTo'];
        
        if ($bond == $id) {
            $bondStatus = "Yes";
        } else {
            $bondStatus = "No";
        }
        
        echo "<tbody>";
        echo "<tr>";
        echo "<td>" . $firstName ." " . $lastName . "</td>";
        echo "<td>" . $email ."</td>";
        echo "<td>" . $typeofTraining ."</td>";
        echo "<td>" . $description."</td>";
        echo "<td>" . $bondStatus."</td>";
        if ($bondStatus == "Yes") {        
            echo "<td><a data-toggle=\"modal\" data-target=\"#unbondUserModal\" onclick=\"setUnbondInfo('$email', '$id')\" class=\"btn btn-danger btn-sm\"><span class=\"glyphicon glyphicon-remove\"></span> UNBOND</a></td>";
        } else {
            echo "<td></td>";
        }
        echo "</tr>";
        echo "</tbody>";
    }
} else {
    echo "";
}
