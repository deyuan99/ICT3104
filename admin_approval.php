<?php 
// connect to database
require_once('database/dbconfig.php');

$sql = "SELECT firstName, lastName, email, phoneNumber, role FROM userapproval";

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
$result = $query->fetchAll();


// Approving/Disapproving items
if (isset($_POST['approveMail'])) {
    echo "value = " . $_POST['approveMail'];
    $email = $_POST['approveMail'];
    
    // copy from userapproval to users table
    $sql = "INSERT INTO users SELECT * FROM userapproval WHERE email = '$email'";
    $query = $conn->prepare($sql);
    $stmt = $query->execute();
    
    // delete from userapproval table
    $rmsql = "DELETE FROM userapproval WHERE email = '$email'";
    $query = $conn->prepare($rmsql);
    $stmt = $query->execute();
    
    header( "Location: admin_approval.php" );
    
} elseif (isset ($_POST['disproveMail'])) {
    echo "dvalue = " . $_POST['disproveMail'];
    $email = $_POST['disproveMail'];
    
    $sql = "DELETE FROM userapproval WHERE email = '$email'";
    $query = $conn->prepare($sql);
    $stmt = $query->execute();
    
    header( "Location: admin_approval.php" );
}

?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>STPS</title>

        <!-- Bootstrap Core CSS -->
        <link href="bootstrap-3.3.5-dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Main CSS -->
        <link rel="stylesheet" href="assets/css/main.css" />
         <!-- Scripts -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/skel.min.js"></script>
        <script src="assets/js/util.js"></script>
        <script src="assets/js/main.js"></script>
        <!--TODO-->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>

    <body>
        <!-- Header -->
        <?php
        include "admin_header.php";
        ?>

        <!-- Banner -->
        <section id="main" class="wrapper">
            <div class="container">
                <h3>Approval table</h3>
                <div>
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#users">Users</a></li>
                        <li><a data-toggle="tab" href="#trainings">Trainings</a></li>
                    </ul>

                    <div class="tab-content">
                        <div id="users" class="tab-pane fade in active">
                            <?php if(count($result) > 0) {?>
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Email</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Phone Number</th>
                                        <th>Role</th>
                                        <th>Approval</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $count = 1;
                                    foreach($result as $row) {
                                        echo 
                                        "<tr>".
                                            "<th>$count</th>".
                                            "<td>".$row['email']."</td>".
                                            "<td>".$row['firstName']."</td>".
                                            "<td>".$row['lastName']."</td>".
                                            "<td>".$row['phoneNumber']."</td>".
                                            "<td>".$row['role']."</td>";
                                    ?>
                                            <td id='approval'>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <form class="form-horizontal" method='POST' action='admin_approval.php' id='approve<?php echo $count ?>'><input type='hidden' name='approveMail' value='<?php echo $row['email'] ?>'/><span onclick='document.getElementById("approve<?php echo $count ?>").submit();' style='cursor:pointer;' class='glyphicon glyphicon-ok'></span></form>
                                                    </div>
                                                    <div class="col-md-3">    
                                                        <form class="form-horizontal" method='POST' action='admin_approval.php' id='disprove<?php echo $count ?>'><input type='hidden' name='disproveMail' value='<?php echo $row['email'] ?>'/><span onclick='document.getElementById("disprove<?php echo $count ?>").submit();' style='cursor:pointer;' class='glyphicon glyphicon-remove'></span></form>
                                                    </div>
                                                </div>
                                            </td>
                                    <?php
                                    echo    
                                        "</tr>";
                                        $count++;
                                    } 
                                    ?>
                                </tbody>
                            </table>
                            <?php } else { ?>
                            <p><h3>There is currently no users to approve</h3></p>
                            <?php } ?>
                        </div>
                        <div id="trainings" class="tab-pane fade">
                            <p><h3>Under Construction</h3></p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <?php
        include "footer.php";
        ?>

    </body>
</html>