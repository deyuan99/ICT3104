<?php

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
        $email = $trainer['email'];
        
        echo "<tbody>";
        echo "<tr>";
        echo "<td>" . $firstName ." " . $lastName . "</td>";
        echo "<td>" . $email ."</td>";
        echo "<td><a href = 'trainee_trainerCalendar.php?t=$email' class = 'button small'>View Calendar</a></td>";
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
