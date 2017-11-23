<!DOCTYPE HTML>
<!--
        Spatial by TEMPLATED
        templated.co @templatedco
        Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>STPS</title>
   <!-- Bootstrap Core CSS -->
        <link href="bootstrap-3.3.5-dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- FullCalendar -->
        <link href='fullcalendar-3.5.1/fullcalendar.css' rel='stylesheet' />
        <link href="assets/css/calendar.css" rel="stylesheet" type="text/css"/>
        
        <!-- Main CSS -->
        <link rel="stylesheet" href="assets/css/main.css" />
        
        <!-- script -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

    </head>

    <body>
        <!-- Header -->
        <?php
        session_start();
        require_once('database/dbconfig.php');
        $Srole = $_SESSION['role'];
        
        if($Srole == "trainee"){
        include "trainee_header.php";
        }else if($Srole == "trainer"){
        include "trainer_header.php";
        }
        ?>     

        <section id="main" class="wrapper">
            <div class="container">

                <div class="row">
                    <div class="6u 12u(xsmall)">
                        <header class="major special">
                            <h3>Hello <?php echo $_SESSION['name'];?> </h3>
                            <p>Change Password</p>
                        </header>
                        <form name="password" action="dochangepassword.php" onsubmit="return validateForm()" method="post">
                                <div class="row uniform 70%">
                                <div class="8u 12u(xsmall)">
                                    <input type="password" name="oldpassword" id="oldpassword" value="" placeholder="Old password" />
                                </div>
                                <div class="8u">
                                    <input type="password" name="password" id="password" value="" placeholder="New password" />
                                </div>
                                  <div class="8u">
                                    <input type="password" name="cfmpassword" id="cfmpassword" value="" placeholder="Confirm New Password" /><span id='message'></span>
                                </div>
                            </div>

                            <div class="row uniform 70%">
                                <div class="8u 6u(small) 12u(xsmall)">
                                    <ul class="actions vertical">
                                        <li><input type="submit" name="submit" value="Change" class="button special fit"></li>
                                    </ul>
                                </div>
                            </div>
                        </form>
                    </div>
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
<script type="text/javascript">
$('#password, #cfmpassword').on('keyup', function () {
    if ($('#password').val() == $('#cfmpassword').val()) {
        $('#message').html('Matching').css('color', 'green');
    } else 
        $('#message').html('Not Matching').css('color', 'red');
});
</script>