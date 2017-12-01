<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
session_start();
require_once('database/dbconfig.php');
$Srole = '';

if (isset($_SESSION['email']) && !empty($_SESSION['email'])) {
    $Srole = $_SESSION['role'];
    if ($Srole == 'trainee') {
            header('Location: trainee_dashboard.php');
        } else if ($Srole == 'trainer') {
            header('Location: trainer_dashboard.php');
        } else if ($Srole == 'admin'){
            header('Location: administrator/user-management.php');
        }
} else {
    include "header.php";
}
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>STPS</title>
        <link rel="stylesheet" href="assets/css/main.css" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    </head>
    <body class="landing">

        <!-- Banner -->
        <section id="banner">
            <h2>Be Active</h2>
            <p>Sports Training Providing System <br /> Schedule your training.</p>
            <ul class="actions">
                <li><a href="registration.php" class="button special big">Join now</a></li>
            </ul>
        </section>

        <!-- One: About Us -->
        <section id="one" class="wrapper style1">
            <div class="container 75%">
                <div class="row 200%">
                    <div class="6u 12u(medium)">
                        <header class="major">
                            <h2>About Us</h2>
                            <p>Description of the company</p>
                        </header>
                    </div>
                    <div class="6u 12u(medium)">
                        
                    <p><?php 
                    $sql5 = "SELECT * FROM aboutus";
                    $req = $conn->prepare($sql5);
                    $req->execute();
                    $row = $req->fetch(PDO::FETCH_ASSOC); 
                    
                    $about = $row['content'];
                    echo "$about";
                    
                    ?></p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Two: Featured Training -->
        <section id="two" class="wrapper style2 special">
            <div class="container">
                <header class="major">
                    <h2>Promotions (upcoming events)</h2>
                    <!--<p>Maecenas vitae tellus feugiat eleifend</p>-->
                </header>
                <div class="row 150%">
                   
                    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel" style="text-align:center; width:100%; height:300px;">
                        <div class="carousel-inner" role="listbox">
                            
                            <div class="carousel-item active">
                                <img class="d-block img-fluid" src="images/pic01.jpg" width="100%" height="300" alt="First slide">
                            </div>
                        <?php
                            $sqlpromo = "SELECT * FROM promotions WHERE featuredStatus = 1";
                            $stmt = $conn->prepare($sqlpromo);
                            $stmt->execute();

                            while($row=$stmt->fetch(PDO::FETCH_ASSOC))
                            {
                              $sqlImg = $row['imagePath'];
                              $title = $row['title'];
                              $description =$row['description'];
                              $startDate=$row['startDate'];
                              $endDate=$row['endDate'];
                              extract($row);

                              ?>
                            <div class="carousel-item ">
                                <img src="<?php echo $sqlImg; ?>"  width="100%" height="300">
                               
                               <div class="carousel-caption d-none d-md-block">
                                  <h2><?php echo $title; ?></h2>
                                  <p><?php echo $startDate . " to " . $endDate;?></p>
                                  <p><?php echo $description; ?></p>
                               </div>
                            </div>
                              <?php
                              }
                              ?>
                          </div>
                         <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                          </a>
                          <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                          </a>
                        </div>
                    
                    <!--<div class="6u 12u(xsmall)">
                        <div class="image fit captioned">
                            <?php
                            /*$sqlpromo = "SELECT * FROM promotions WHERE featuredStatus = 1 and id = 1 ";
                            $reqpromo = $conn->prepare($sqlpromo);
                            $reqpromo->execute();
                            $reqcount = $reqpromo->rowCount();
                            if ($reqcount > 0) {
                                while ($row = $reqpromo->fetch(PDO::FETCH_ASSOC)) {
                                    $sqlImg = $row['imagePath'];
                                    $title = $row['title'];
                                    $description =$row['description'];
                                    $startDate=$row['startDate'];
                                    $endDate=$row['endDate'];
                                    echo "<div class='image rounded'>";
                                    if (strlen($sqlImg) > 0) {
                                        echo "<img src='$sqlImg'>";
                                    } else {
                                        echo "<img src='images/uploads/profiledefault.jpg'>";
                                    }
                                    echo "</div>";
                                }
                            } */?>
                            <!--<img src="images/pic02.png" alt="" />-->
                            <!--<h3>
                                <div class="content">
                                    <?php
                                    /*$sqlpromo = "SELECT * FROM promotions WHERE featuredStatus = 1 and id = 1 ";
                                    $reqpromo = $conn->prepare($sqlpromo);
                                    $reqpromo->execute();
                                    $value2 = $reqpromo->fetch(PDO::FETCH_ASSOC);
                                    $title = $value2['title'];
                                    $description =$value2['description'];
                                    $startDate=$value2['startDate'];
                                    $endDate=$value2['endDate'];*/?>
                                    <header class="align-center">
                                        <p><?php //echo $startDate . " to " . $endDate;?></p>
                                        <h2><?php //echo $title;?></h2>
                                    </header>
                                    <h6><?php //echo $description;?></h6>
                                    
                                </div>
                            </h3>
                        </div>
                    </div>-->
                    <!--<div class="6u 12u(xsmall)">
                        <div class="image fit captioned">
                            <img src="images/pic03.png" alt="" />
                            <h3>
                                <div class="content">
                                    <?php
                                    /*$sqlpromo1 = "SELECT * FROM promotions WHERE featuredStatus = 1 and id = 2 ";
                                    $reqpromo1 = $conn->prepare($sqlpromo1);
                                    $reqpromo1->execute();
                                    $value3 = $reqpromo1->fetch(PDO::FETCH_ASSOC);
                                    $title1 = $value3['title'];
                                    $description1 =$value3['description'];
                                    $startDate1=$value3['startDate'];
                                    $endDate1=$value3['endDate'];*/?>
                                    <header class="align-center">
                                        <p><?php //echo $startDate1 . " to " . $endDate1;?></p>
                                        <h2><?php// echo $title1;?></h2>
                                    </header>
                                    <h6><?php //echo $description1;?></h6>
                                    
                                </div>
                            </h3>
                        </div>
                    </div>-->
                </div>
            </div>
        </section>

        <!-- Three: Featured Trainers -->
        <section id="three" class="wrapper style1">
            <div class="container">
                <header class="major special">
                    <h2>Featured Trainers</h2>
                    <p>Our List of well trained Trainers</p>
                </header>
                <div class="feature-grid">
                    <div class="feature">
                        <?php
                            $sql = "SELECT * FROM users WHERE role = 'trainer' and status = 1 and email='trainer1@gmail.com'";
                          
                            $req5 = $conn->prepare($sql);
                            $req5->execute();
                            $count = $req5->rowCount();
                            if ($count > 0) {
                                while ($row = $req5->fetch(PDO::FETCH_ASSOC)) {
                                    $sqlImg = $row['profilePicture'];
                                    $firstName = $row['firstName'];
                                    $profileBio=$row['profileBio'];
                                    $registerDate=$row['registerDate'];
                                    echo "<div class='image rounded'>";
                                    if (strlen($sqlImg) > 0) {
                                        echo "<img src='$sqlImg'>";
                                    } else {
                                        echo "<img src='images/uploads/profiledefault.jpg'>";
                                    }
                                    echo "</div>";
                                }
                            } ?>
                        <div class="content">
                            <header>
                                <h4><?php echo $firstName; ?></h4>
                                <p><?php echo $registerDate;?></p>
                            </header>
                            <p><?php echo $profileBio;?></p>
                        </div>
                    </div>
                    <div class="feature">
                        <?php
                            $sql1 = "SELECT * FROM users WHERE role = 'trainer' and status = 1 and email='trainer2@gmail.com'";
                            $req1 = $conn->prepare($sql1);
                            $req1->execute();
                            $count2 = $req1->rowCount();
                            if ($count2 > 0) {
                                while ($row = $req1->fetch(PDO::FETCH_ASSOC)) {
                                    $sqlImg = $row['profilePicture'];
                                    $firstName1 = $row['firstName'];
                                $profileBio1=$row['profileBio'];
                                $registerDate1=$row['registerDate'];
                                    echo "<div class='image rounded'>";
                                    if (strlen($sqlImg) > 0) {
                                        echo "<img src='$sqlImg'>";
                                    } else {
                                        echo "<img src='images/uploads/profiledefault.jpg'>";
                                    }
                                    echo "</div>";
                                }
                            } ?>
                        <div class="content">
                            <header>
                                <h4><?php echo $firstName1; ?></h4>
                                <p><?php echo $registerDate1;?></p>
                            </header>
                            <p><?php echo $profileBio1;?></p>
                        </div>
                    </div>
                   <div class="feature">
                       <?php
                            $sql2 = "SELECT * FROM users WHERE role = 'trainer' and status = 1 and email='trainer3@gmail.com'";
                            $req2 = $conn->prepare($sql2);
                            $req2->execute();
                            $count3 = $req2->rowCount();
                            if ($count3 > 0) {
                                while ($row = $req2->fetch(PDO::FETCH_ASSOC)) {
                                    $sqlImg = $row['profilePicture'];
                                    $firstName2 = $row['firstName'];
                                    $profileBio2=$row['profileBio'];
                                    $registerDate2=$row['registerDate'];
                                    echo "<div class='image rounded'>";
                                    if (strlen($sqlImg) > 0) {
                                        echo "<img src='$sqlImg'>";
                                    } else {
                                        echo "<img src='images/uploads/profiledefault.jpg'>";
                                    }
                                    echo "</div>";
                                }
                            } ?>
                        <div class="content">
                            <header>
                                <h4><?php echo $firstName2; ?></h4>
                                <p><?php echo $registerDate2;?></p>
                            </header>
                            <p><?php echo $profileBio2;?></p>
                        </div>
                    </div>
                    <div class="feature">
                        <?php
                            $sql3 = "SELECT * FROM users WHERE role = 'trainer' and status = 1 and email='trainer4@gmail.com'";
                            $req3 = $conn->prepare($sql3);
                            $req3->execute();
                            $count4 = $req3->rowCount();
                            if ($count4 > 0) {
                                while ($row = $req3->fetch(PDO::FETCH_ASSOC)) {
                                    $sqlImg = $row['profilePicture'];
                                    $firstName3 = $row['firstName'];
                                    $profileBio3=$row['profileBio'];
                                    $registerDate3=$row['registerDate'];
                                    echo "<div class='image rounded'>";
                                    if (strlen($sqlImg) > 0) {
                                        echo "<img src='$sqlImg'>";
                                    } else {
                                        echo "<img src='images/uploads/profiledefault.jpg'>";
                                    }
                                    echo "</div>";
                                }
                            } ?>
                        <div class="content">
                            <header>
                                <h4><?php echo $firstName3; ?></h4>
                                <p><?php echo $registerDate3;?></p>
                            </header>
                            <p><?php echo $profileBio3;?></p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
 <!-- Four: Contact us -->
        <section id="four" class="wrapper style3 special">
            <div class="container">
                <header class="major">
                    <h2>Contact Us</h2>
                    <?php
                        $sqlu = "SELECT * FROM venue";
                        $rq3 = $conn->prepare($sqlu);
                        $rq3->execute();
                        $result3 = $rq3->fetchAll();
                        if(count($result3) > 0) {
                            foreach ($result3 as $row):
                                $location = $row['location'];
                                $address =$row['address'];
                                $contact=$row['contact'];
                                echo "<p>$location</p>";
                                echo "<p>$address</p>";
                                echo "<p>$contact</p>";
                                echo "<br><br>";
                            endforeach;
                        }
                        else {
                            echo "No Rejected events record found";
                        }
                        ?>
                </header>
                <!--<ul class="actions">
                    <li><a href="#" class="button special big">Get in touch</a></li>
                </ul>-->
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
        
        <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
    </body>
</html>