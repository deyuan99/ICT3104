<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
require_once('database/dbconfig.php');

$email = $_POST['email'];
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE email = '$email' and password = sha1('$password')";

$req = $conn->prepare($sql);
$req->execute();
$rows = $req->fetchAll();

foreach ($rows as $row):
    $role = $row['role'];
    $firstname = $row['firstName'];
    $lastname = $row['lastName'];
    $status = $row['status'];
    $subscription = $row['subscription'];
endforeach;

if ($req->rowCount() == 1) {
    if ($status == 1) {
        $_SESSION['email'] = $email;
        $_SESSION['name'] = $lastname . ' ' . $firstname;
        $_SESSION['role'] = $role;
        if (!empty($_POST["copy"])) {
            setcookie("member_login", $email, time() + (10 * 365 * 24 * 60 * 60));
            setcookie("member_password", $password, time() + (10 * 365 * 24 * 60 * 60));
        } else {
            if (isset($_COOKIE["member_login"])) {
                setcookie("member_login", "");
            }
            if (isset($_COOKIE["member_password"])) {
                setcookie("member_password", "");
            }
        }

        if ($role == "trainee") {
            //Arifah: to change based on expiry date!
            //get date compare date
            if ($subscription == 0) {
                header("location: trainee_expiredSubscription.php");
            
            } else {
                header("location: trainee_dashboard.php");
            }
        } else if ($role == "trainer") {
            header("location: trainer_dashboard.php");
        } else {
            header("location: administrator/user-management.php");
        }
    } else {
        $error = "Your access has been denied";
        echo "<script type='text/javascript'>alert('$error');"
        . "window.location.href='registration.php';"
        . "</script>";
    }
} else {
    $error = "Your Login email or Password is invalid";
    echo "<script type='text/javascript'>alert('$error');"
    . "window.location.href='registration.php';"
    . "</script>";
}
?>

