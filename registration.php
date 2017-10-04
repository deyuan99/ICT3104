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
                    <div class="6u 12u(xsmall)">
                        <header class="major special">
                            <h3>Login</h3>
                            <p>Welcome back</p>
                        </header>
                        <form method="post" action="#">
                            <div class="row uniform 50%">
                                <div class="8u 12u(xsmall)">
                                    <input type="email" name="email" id="name" value="" placeholder="Email" />
                                </div>
                                <div class="8u">
                                    <input type="password" name="password" id="password" value="" placeholder="Password" />
                                </div>
                            </div>
                            <div class="row uniform 50%">
                                <div class="6u 6u(small) 12u(xsmall)">
                                    <div class="7u 12u(small)">
                                        <input type="checkbox" id="copy" name="copy">
                                        <label for="copy">Remember me</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row uniform 50%">
                                <div class="8u 6u(small) 12u(xsmall)">
                                    <ul class="actions vertical">
                                        <li><a href="trainee_dashboard.php" class="button special fit">Login</a></li>
                                    </ul>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="6u 12u(xsmall)">
                        <header class="major special">
                            <h3>Register</h3>
                            <p>New account? Join now.</p>
                        </header>
                        <form method="post" action="#">
                            <div class="row uniform 50%">
                                <div class="6u 12u(xsmall)">
                                    <input type="text" name="firstName" id="name" value="" placeholder="First Name" />
                                </div>
                                <div class="6u 12u(xsmall)">
                                    <input type="text" name="lastName" id="name" value="" placeholder="Last Name" />
                                </div>
                                <div class="12u">
                                    <input type="email" name="email" id="email" value="" placeholder="Email" />
                                </div>
                                <div class="12u">
                                    <div class="select-wrapper">
                                        <select name="category" id="category">
                                            <option value="">Member Type</option>
                                            <option value="1">Trainer</option>
                                            <option value="1">Trainee</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="12u">
                                    <input type="password" name="password" id="password" value="" placeholder="Password" />
                                </div>
                                <div class="12u">
                                    <input type="password" name="confrimPassword" id="password" value="" placeholder="Confirm Password" />
                                </div>
                            </div>
                            <div class="row uniform 50%">
                                <div class="12u 6u(small) 12u(xsmall)">
                                    <ul class="actions vertical">
                                        <li><a href="registration_verification.php" class="button special fit">Register</a></li>
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