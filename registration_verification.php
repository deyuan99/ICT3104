<?php
// connect to database
require_once('database/dbconfig.php');

//subscription is monthly: 3, 6, 12

$expire = new DateTime('2010-12-07');
$date2 = new DateTime('2017-11-08');

//$today = date("Y-m-d");
//echo "today: " . $today;
//
//if( $today > $expire ){
//  echo 'expired <br>';
//}
//
//elseif( $today > $date2 ){
//  echo 'valid <br>';
//}

if (isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['regemail']) && isset($_POST['phone']) && isset($_POST['category']) && isset($_POST['regpass']) && isset($_POST['regconfpass'])) {

    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $regemail = $_POST['regemail'];
    $phone = $_POST['phone'];
    $role = $_POST['category'];
    $regpass = $_POST['regpass'];
	if (isset($_POST['subscription'])) {
        $subscription = $_POST['subscription'];
    } else {
        $subscription = "";
    }
    if (isset($_POST['address'])) {
        $address = $_POST['address'];
    } else {
        $address = "";
    }

    //registration expiry
    $registerDate = date("Y-m-d");
    
    if ($subscription == 3){
        $date = strtotime(date("Y-m-d", strtotime($registerDate)) . " +3 month");
    }
    elseif ($subscription == 6) {
        $date = strtotime(date("Y-m-d", strtotime($registerDate)) . " +6 month");
    }
    elseif ($subscription == 12) {
        $date = strtotime(date("Y-m-d", strtotime($registerDate)) . " +12 month");
    } else { // trainer
        $date = strtotime($registerDate);
    }

    $expiredDate = date("Y-m-d", $date);


    $sql = "SELECT * FROM users u, userApproval ua WHERE u.email = '$regemail' OR ua.email = '$regemail'";

    $query = $conn->prepare($sql);
    if ($query == false) {
        print_r($conn->errorInfo());
        die('Error prepare');
    }
    $stmt = $query->execute();
    if ($stmt == false) {
        print_r($query->errorInfo());
        die('Error execute');
    }
    $checkResult = $query->fetch(PDO::FETCH_ASSOC);

//    echo "\nresult = " . $result['firstName'];
//    echo " result = " . count($checkResult) . "<br/>";

    $header = 'From: stps.team4@gmail.com';
    $message = 'thanks for signing up';

    // If there is no existing email in db, add user to admin approval
    if (count($checkResult) == 1) {
        $insertsql = "INSERT INTO userApproval (firstName, lastName, email, phoneNumber, profilePicture, role, password, address, subscription, expiryDate, registerDate) VALUES ('$firstname', '$lastname', '$regemail', '$phone', '', '$role', sha1('$regpass'), '$address', '$subscription', '$expiredDate', '$registerDate')";
//        echo "prepare ";
        $query = $conn->prepare($insertsql);

        // send a notification to the admin
        $msg = "A new $role has registered and is waiting for approval.";
        $sql2 = "INSERT into notificationlog (message, userEmail, readStatus) VALUES ('$msg', 'admin1@gmail.com', '0')";
        $query2 = $conn->prepare($sql2);
        $stmt2 = $query2->execute();
        
        //send email
        mail($regemail, 'Confirmation Email', $message, $header);
//        echo "mail sent";

        if ($query == false) {
            print_r($conn->errorInfo());
            die('Error prepare');
        }
        $stmt = $query->execute();
        if ($stmt == false) {
            print_r($query->errorInfo());
            die('Error execute');
        }
    }
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>STPS</title>
        <link rel="stylesheet" href="assets/css/main.css" />
    </head>

    <body>
        <!-- Header -->
        <header id="header">
            <h1><strong><a href="index.php">STPS</a></strong> by Group 4</h1>
            <nav id="nav">
                <ul>
                    <li><a href="registration.php">Login</a></li>
                </ul>
            </nav>
        </header>

        <!-- Banner -->
        <section id="main" class="wrapper">
            <div class="container">
                <div class="row">
                    <?php if (count($checkResult) > 1) { ?> 
                        <div class="6u 12u(xsmall)">
                            <header class="major special">
                                <h3>Oops!</h3>
                                <p>The email has been taken, please try again!</p>
                            </header>
                            <ul class="actions">
                                <li><a href="registration.php" class="button special big">Back</a></li>
                            </ul>
                        </div>
                    <?php } else { ?> 
                        <div class="6u 12u(xsmall)">
                            <header class="major special">
                                <h3>Almost there!</h3>
                                <p>Thank you for signing up. Your account has been sent for review.<br> When your account is active, we'll notify you via email. </p>
                            </header>
                            <ul class="actions">
                                <li><a href="index.php" class="button special big">Back to Home</a></li>
                            </ul>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <?php
        include "footer.php";
        ?>

        <!-- Scripts -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/skel.min.js"></script>
        <script src="assets/js/util.js"></script>
        <script src="assets/js/main.js"></script>
    </body>
</html>
