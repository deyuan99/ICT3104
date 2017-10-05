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
        <link rel="stylesheet" href="assets/css/main.css" />
    </head>

    <body>
        <!-- Header -->
        <header id="header" >
            <h1><strong><a href="index.php">STPS</a></strong> by Group 4</h1>
        </header>

        <section id="main" class="wrapper">
            <div class="container">

                <div class="row">
                    <!-- Login -->
                    <div class="6u 12u(xsmall)">
                        <header class="major special">
                            <h3>Login</h3>
                            <p>Welcome back</p>
                        </header>
                           <form name="login" method="post" action="login.php">
                            <div class="row uniform 50%">
                                <div class="8u 12u(xsmall)">
                                    <input type="email" name="email" id="email" value="<?php if(isset($_COOKIE["member_login"])) { echo $_COOKIE["member_login"]; } ?>" placeholder="Email" />
                                </div>
                                <div class="8u">
                                    <input type="password" name="password" id="password" value="<?php if(isset($_COOKIE["member_password"])) { echo $_COOKIE["member_password"]; } ?>" placeholder="Password" />
                                </div>
                            </div>
                            <div class="row uniform 50%">
                                <div class="6u 6u(small) 12u(xsmall)">
                                    <div class="7u 12u(small)">
                                        <input type="checkbox" id="copy" name="copy" <?php if(isset($_COOKIE["member_login"])) { ?> checked <?php } ?>>
                                        <label for="copy">Remember me</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row uniform 50%">
                                <div class="8u 6u(small) 12u(xsmall)">
                                    <ul class="actions vertical">
                                        <li><input type="submit" name="submit" value="Login" class="button special fit"></li>
                                    </ul>
                                </div>
                            </div>
                        </form>
                    </div>
                    
                    <!-- Registration -->
                    <div class="6u 12u(xsmall)">
                        <header class="major special">
                            <h3>Register</h3>
                            <p>New account? Join now.</p>
                        </header>
                        <!--TODO validate number + pass matches-->
                        <form method="POST" action="registration_verification.php">
                            <div class="row uniform 50%">
                                <div class="6u 12u(xsmall)">
                                    <input type="text" name="firstname" id="firstname" value="" placeholder="First Name"  required/>
                                </div>
                                <div class="6u 12u(xsmall)">
                                    <input type="text" name="lastname" id="lastname" value="" placeholder="Last Name" required/>
                                </div>
                                <div class="12u">
                                    <input type="email" name="regemail" id="regemail" value="" placeholder="Email" required/>
                                </div>
                                <div class="12u">
                                    <input type="text" name="phone" id="phone" value="" placeholder="Phone Number" required/>
                                </div>
                                <div class="12u">
                                    <div class="select-wrapper">
                                        <select name="category" id="category" required>
                                            <option value="">Member Type</option>
                                            <option value="trainer">Trainer</option>
                                            <option value="trainee">Trainee</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="12u">
                                    <input type="password" name="regpass" id="regpass" value="" placeholder="Password" required/>
                                </div>
                                <div class="12u">
                                    <input type="password" name="regconfpass" id="regconfpass" value="" placeholder="Confirm Password" required/>
                                </div>
                            </div>
                            <div class="row uniform 50%">
                                <div class="12u 6u(small) 12u(xsmall)">
                                    <ul class="actions vertical">
                                        <li><button type="submit" class="button special fit">Register</button></li>
                                    </ul>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <script>
        function test(){
            var x =document.getElementById("firstname").value;
            alert(x);
        }
        
        
        </script>
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