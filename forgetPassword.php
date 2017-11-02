<html>
    <head>
        <meta charset="UTF-8">
        <title>STPS</title>
        <link rel="stylesheet" href="assets/css/main.css" />
    </head>

    <body>
        <!-- Header -->
        <header id="header" >
            <h1><strong><a href="index.php">STPS</a></strong> by Group 4</h1>
        </header>

        <section id="main" class="wrapper">
            <div class="container">
                
                <br>
                <br>
                <br>
                <br>
                
                <div class="row">
                    <!-- Login -->
                    <div class="12u(xsmall)">
                        <header class="major special">
                            <h3>Forget your password?</h3><br>
                            Enter your registered email, and we'll send you a temporary password.
                        </header>
                        <form name="resetPassword" method="post" action="scripts/resetPassword.php">
                            <div class="row uniform 80%">
                                <div class="12u 12u(xsmall)">
                                    <input type="email" name="email" id="email" value="" placeholder="Email" />
                                </div>
                            </div>
                            <div class="row uniform 80%">
                                <div class="12u 6u(small) 12u(xsmall)">
                                    <ul class="actions vertical">
                                        <li><input type="submit" name="resetPwd" value="Reset Password" class="button special fit"></li>
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