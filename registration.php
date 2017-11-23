<!DOCTYPE HTML>
<?php
session_start();
$Srole = '';

if (isset($_SESSION['email']) && !empty($_SESSION['email'])) {
    $Srole = $_SESSION['role'];

    if ($Srole == 'trainee') {
        header("Location: trainee_dashboard.php");
    } else if ($Srole == 'trainer') {
        header("Location: trainer_dashboard.php");
    }else if($Srole == 'admin'){
        header("Location: administrator/user-management.php");
    }else{
        header("Location: index.php");
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
                                    <input type="email" name="email" id="email" value="<?php
                                    if (isset($_COOKIE["member_login"])) {
                                        echo $_COOKIE["member_login"];
                                    }
                                    ?>" placeholder="Email" />
                                </div>
                                <div class="8u">
                                    <input type="password" name="password" id="password" value="<?php
                                    if (isset($_COOKIE["member_password"])) {
                                        echo $_COOKIE["member_password"];
                                    }
                                    ?>" placeholder="Password" />
                                </div>
                            </div>
                            <div class="row uniform 50%">
                                <div class="6u 6u(small) 12u(xsmall)">
                                    <div class="7u 12u(small)">
                                        <input type="checkbox" id="copy" name="copy" <?php if (isset($_COOKIE["member_login"])) { ?> checked <?php } ?>>
                                        <p for="copy">Remember me</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row uniform 50%">
                                <div class="8u 6u(small) 12u(xsmall)">
                                    <ul class="actions vertical">
                                        <li><input type="submit" name="submit" value="Login" class="button special fit"></li>
                                        <a style="text-decoration:none;" href="forgetPassword.php">Forget Password?</a>
                                    </ul>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Registration -->
                    <div class="6u 12u(xsmall)">
                        <header class="major special">
                            <h3>Register</h3>
                            <p>New account? Join now!</p>
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
                                    <textarea style="resize: none;" name="address" id="address" rows="3"  placeholder="Address"></textarea>
                                </div>
                                <div class="12u">
                                    <input type="password" name="regpass" id="regpass" value="" placeholder="Password" required/>
                                </div>
                                <div class="12u">
                                    <input type="password" name="regconfpass" id="regconfpass" value="" placeholder="Confirm Password" required/>
                                </div>
                                <div class="12u"> <h4>Membership type</h4>
                                    <input type="radio" name="category" id="category" value="trainer" required> Trainer
                                    <input type="radio" name="category" id="category" value="trainee"> Trainee

                                    <select class="dropdown" name="subscription" id="member_type">
                                        <option value="" disabled selected>Select membership type</option>
                                    </select>
                                    
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

        <!-- Footer -->
        <?php
        include "footer.php";
        ?>

        <!-- Scripts -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/skel.min.js"></script>
        <script src="assets/js/util.js"></script>
        <script src="assets/js/main.js"></script>

        <script type="text/javascript">
            $("input[type='radio'][name='category']").change(function () {
                var selected = $("input[type='radio'][name='category']:checked").val();
                if (selected === "trainer")
                    var opts = [
                        {name: "Not Applicable", val: ""}
                    ];
					document.getElementById("member_type").required = false;

                else
                    var opts = [
                        {name: "Choose Trainee Subscription", val: ""},
                        {name: "3 months- $27", val: "3"},
                        {name: "6 months- $50", val: "6"},
                        {name: "12 months- $80", val: "12"}
                    ];
                
                    document.getElementById("member_type").required = true;
                $("#member_type").empty();

                $.each(opts, function (k, v) {
                    $("#member_type").append("<option value='" + v.val + "'>" + v.name + "</option>");

                });
            });
        </script>

    </body>
</html>