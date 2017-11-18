<!DOCTYPE html>

<?php
session_start();
$Srole = '';

if (isset($_SESSION['email']) && !empty($_SESSION['email'])) {
    $Srole = $_SESSION['role'];
}
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>STPS</title>
        <link rel="stylesheet" href="assets/css/main.css" />
    </head>
    <body class="landing">
        <!-- Header -->

        <!-- Banner -->
        <section id="banner">
           
        </section>

        <!-- One: About Us -->
        <section id="one" class="wrapper style1 special">
         
        </section>
        
        <!-- Two: Featured Training -->
        <section id="two" class="wrapper style2">
        
        </section>

        <!-- Three: Featured Trainers -->
        <section id="three" class="wrapper style1">
        
        </section>

        <!-- Four: Contact us -->
        <section id="four" class="wrapper style3 special">
            <div class="container">
             
            </div>
        </section>

        <!-- Footer -->
        <?php
        include "../footer.php";
        ?>

        <!-- Scripts -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/skel.min.js"></script>
        <script src="assets/js/util.js"></script>
        <script src="assets/js/main.js"></script>
    </body>
</html>
