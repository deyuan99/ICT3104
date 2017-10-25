<?php

session_start();
include_once 'database/dbconfig.php';
$id = $_SESSION['email'];

$sqlTrainerName = "SELECT * FROM users WHERE role='trainer';";
$result = $conn->prepare($sqlTrainerName);
$result->execute();

$count = $result->rowCount();

if ($count > 0) {
    while ($trainer = $result->fetch(PDO::FETCH_ASSOC)) {
        $firstName = $trainer['firstName'];
        $lastName = $trainer['lastName'];
        
        echo "<tbody>";
        echo "<tr>";
        echo "<td>" . $firstName ." " . $lastName . "</td>";
        echo "<td>some decription</td>";
        echo "<td><a href = 'trainer_dashboard.php' class = 'button small'>View</a></td>";
        /* to be implemented
         * echo "<form action='trainee_trainerProfile.php' method='POST' enctype=''>
			<input type='text' name=''>
			<button type='submit' name='$trainerID'>View</button>
                        </form>";
         */
        echo "</tr>";
        echo "</tbody>";
    }
} else {
    echo "There are no Trainers yet!";
}
