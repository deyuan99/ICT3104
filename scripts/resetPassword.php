<?php

// connect to database
require_once('../database/dbconfig.php');

$password = "";
$charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";


$header = 'From: stps.team4@gmail.com';


if (isset($_POST['email'])) {
    $email = $_POST['email'];
    //check email exist or not in users
    $sql = "SELECT * FROM users WHERE email='$email'";

    $result = $conn->prepare($sql);
    $result->execute();
    $count = $result->rowCount();

    //echo $count;

    if ($count > 0) {
        // output data of each row
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $id = $row['email'];

            //echo $id;

            //generate random password
            for ($i = 0; $i < 8; $i++) {
                $random_int = mt_rand();
                $password .= $charset[$random_int % strlen($charset)];
            }

            //echo "<br>";
            //echo $password, "\n";
            //update password
            $sqlUpdate = "UPDATE users SET password= sha1('$password') WHERE email='$id';";

            $resultUpdate = $conn->prepare($sqlUpdate);
            $resultUpdate->execute();

            //send email with password
            $message = "your new password:" . ' ' . $password;
            mail($email, 'Reset password', $message, $header);
            
            header("location: ../resetPassword_mailSent.php");
        }

        //if yes
        /* if (count($validEmail) == 1) {

          } else {

          echo "no";
          } */
    } else {
        //echo sorry

        header("location: ../resetPassword_invalidEmail.php");
    }
}
?>