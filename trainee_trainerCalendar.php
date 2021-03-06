<!--Connection for database -->
<?php
session_start();
require_once('database/dbconfig.php');

$email = $_SESSION['email'];
$traineremail = $_GET['t'];
$sql = "SELECT * FROM personalsession where trainerEmail= '$traineremail' and category = '1-1 Training' and date >= NOW()";
$req = $conn->prepare($sql);
$req->execute();
$events = $req->fetchAll();

$sql2 = "SELECT * FROM users where email = '$traineremail'";
$req2 = $conn->prepare($sql2);
$req2->execute();

$trainerInfo = $req2->fetch(PDO::FETCH_ASSOC);

$sql3 = "SELECT * FROM users where email = '$email'";
$req3 = $conn->prepare($sql3);
$req3->execute();
$userInfo = $req3->fetch(PDO::FETCH_ASSOC);
$bondStatus = $userInfo['bondTo'];

$sql4 = "SELECT * FROM bondapproval where traineeEmail = '$email'";
$req4 = $conn->prepare($sql4);
$req4->execute();
$bondInfo = $req4->fetch(PDO::FETCH_ASSOC);
$bondrequestTrainer = $bondInfo['trainerEmail'];
if(count($bondInfo) == 1) {
    $bondrequest = "allow";
} else {
    $bondrequest = "pending";
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>STPS</title>

        <script src="assets/js/jquery.min.js" rel="stylesheet"></script>
        <script src="bootstrap-3.3.5-dist/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">

        <!-- FullCalendar -->
        <link href='fullcalendar-3.5.1/fullcalendar.css' rel='stylesheet' />
        <link href="assets/css/calendar.css" rel="stylesheet" type="text/css"/>

        <!-- Main CSS -->
        <link rel="stylesheet" href="assets/css/trainee_dashboard.css" />

    </head>
    <body>
        <!-- Header -->
        <?php
        include "trainee_header.php";
        ?>
        <!-- Trainer Calendar -->
        <section id="two" class="wrapper style2 special">
            <div class="container">
                <header class="major">
                    <!--<h2>Trainer's Calendar</h2>-->
                    <h2><?php echo $trainerInfo['firstName'] . " " . $trainerInfo['lastName']; ?></h2>
                    <?php
                    $sqlImg = $userInfo['profilePicture'];
                    echo "<p>";
                    if (strlen($sqlImg) > 0) {
                        echo "<img src='$sqlImg'>";
                    } else {
                        echo "<img src='images/uploads/profiledefault.jpg'>";
                    }
                    echo "</p><br/>";
                    ?>
                    <p><?php echo $trainerInfo['profileBio']; ?></p><br/>
                    <form class="form-inline" role="form" action="scripts/doBond.php" method="POST">
                        <input type="hidden" name="traineremail" id="traineremail" value="<?php echo $traineremail;?>">
                        <?php
                        if (!empty($bondStatus)) {
                            if ($bondStatus == $traineremail) {
                                echo '<button type="submit" class="btn btn-danger btn-lg" value="unbound" id="option" name="option">Unbond from Trainer</button>';
                            } else {
                                echo '<button type="submit" class="btn btn-info btn-lg" value="" id="" name="" disabled>Unable to bond</button>';
                            }
                        } else {
                            if ($bondrequest == "pending" && $bondrequestTrainer == $traineremail) {
                                echo '<button type="submit" class="btn btn-warning btn-lg" value="" id="" name="" disabled>Bond approval pending</button>';
                            } else if ($bondrequest == "pending" && $bondrequestTrainer != $traineremail) {
                                echo '<button type="submit" class="btn btn-info btn-lg" value="" id="" name="" disabled>Unable to bond</button>';
                            } else {
                                echo '<button type="submit" class="btn btn-primary btn-lg" value="bond" id="option" name="option" onclick="return confirm(\'Are you sure? This will remove ALL your 1-1 trainings!\')">Bond to Trainer</button>';
                            }
                        }
                        ?>
                    </form>
                </header>
                <div id="calendar" class="col-centered">
                </div>
            </div>
        </section>

        <!--modal view-->
        <div class="modal fade" id="ModalView" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="padding-top: 70px;">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form class="form-horizontal" method="POST" action="addCalendarEventTrainee.php">
                        
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">View Event</h4>
                        </div>
                        <div class="modal-body">
                            <h3 id="e-status" style="text-align: center; color:red;"></h3>
                            <div class="form-group">
                                <label for="category" class="col-sm-2 control-label">Category</label>
                                <div class="col-sm-10">
                                    <input type="text" name="category" class="form-control" id="category" value="<?php echo $event['category']; ?>" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="color" class="col-sm-2 control-label">Date</label>
                                <div class="col-sm-10">
                                    <input type="text" name="date" class="form-control" id="date" value="<?php echo $event['date']; ?>" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="start" class="col-sm-2 control-label">Start Time</label>
                                <div class="col-sm-10">
                                    <input type="text" name="startTime" class="form-control" id="startTime" value="<?php echo $event['startTime']; ?>" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="end" class="col-sm-2 control-label">End Time</label>
                                <div class="col-sm-10">
                                    <input type="text" name="endTime" class="form-control" id="endTime" value="<?php echo $event['endTime']; ?>" readonly>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="venueview" class="col-sm-2 control-label">Venue</label>
                                <div class="col-sm-10">
                                    <input type="text" name="venueview" class="form-control" id="venueview" readonly>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="roomview" class="col-sm-2 control-label">Room</label>
                                <div class="col-sm-10">
                                    <input type="text" name="roomview" class="form-control" id="roomview" readonly>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="typeview" class="col-sm-2 control-label">Type</label>
                                <div class="col-sm-10">
                                    <input type="text" name="typeview" class="form-control" id="typeview" readonly>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="costview" class="col-sm-2 control-label">Cost</label>
                                <div class="col-sm-10">
                                    <input type="text" name="costview" class="form-control" id="costview" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="end" class="col-sm-2 control-label">Description</label>
                                <div class="col-sm-10">
                                    <input type="text" name="description" class="form-control" id="description" value="<?php echo $event['description']; ?>" readonly>
                                </div>
                            </div> 
                            <input type="hidden" id="eid" name="eid" value="23"/>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <?php 
                            if (empty($bondStatus) || $bondStatus == $traineremail) {
                                echo '<input type="submit" id="joinBtn" class="btn btn-primary" value="Join Training"/>';
                            } else {
                                echo '<input type="submit" id="joinBtn" class="btn" value="Join Training" disabled/>';
                            }
                            ?>
                            <!--<input type="submit" id="joinBtn" class="btn btn-primary" value="Join Training" disabled/>-->
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <?php
        include "footer.php";
        ?>

        <!-- Scripts -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/skel.min.js"></script>
        <script src="assets/js/util.js"></script>
        <script src="assets/js/main.js"></script>

        <!-- jQuery Version 1.11.1 -->
        <script src="fullcalendar-3.5.1/lib/jquery.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="bootstrap-3.3.5-dist/js/bootstrap.min.js"></script>

        <!-- FullCalendar -->
        <script src='fullcalendar-3.5.1/lib/moment.min.js'></script>
        <script src='fullcalendar-3.5.1/fullcalendar.min.js'></script>

        <!--Calendar script-->
        <script>
            $(document).ready(function () {
                //var today = moment().day();

                $('#calendar').fullCalendar({
                    header: {
                        left: 'title',
                        center: 'prev,next today',
                        right: 'month,basicWeek,basicDay'
                    },
                    //defaultDate: '2016-01-12',
                    defaultDate: $('#calendar').fullCalendar('today'),
                    editable: false,
                    eventLimit: true, // allow "more" link when too many events
                    selectable: true,
                    selectHelper: true,
                    selectConstraint: {
                        start: $.fullCalendar.moment().subtract(1, 'days'),
                        end: $.fullCalendar.moment().startOf('month').add(1, 'month')
                    },
                    events: [
<?php
foreach ($events as $event):


    $start = $event['startTime'];
    $end = $event['endTime'];
    $cat = $event['category'];
    $eventdate = $event['date'];
    $traineeEmail = $event['traineeEmail'];
    $combinedstart = date('Y-m-d H:i:s', strtotime("$eventdate $start"));
    $combinedend = date('Y-m-d H:i:s', strtotime("$eventdate $end"));

    $roomt = $event['roomTypeID'];
    $sql4 = "SELECT roomtype.name, venue.location FROM roomtype, venue WHERE roomtype.id = '$roomt' AND roomtype.venueID = venue.id";
    $req4 = $conn->prepare($sql4);
    $req4 -> execute();
    $names = $req4 -> fetch(PDO::FETCH_ASSOC);
    $roomname = $names['name'];
    $venuename = $names['location'];
    
    $trainingtype = $event['typeofTrainingID'];
    $sql5 = "SELECT trainingName, cost FROM typeoftraining WHERE id = '$trainingtype'";
    $req5 = $conn->prepare($sql5);
    $req5 -> execute();
    $names2 = $req5 -> fetch(PDO::FETCH_ASSOC);
    $trainingname = $names2['trainingName'];
    $cost = "$" . $names2['cost'];
    
//    if ($cat == "Personal Training") {
//        $traineeEmail = "Not Applicable";
//        $color = '#000';
//    } else if ($traineeEmail != NULL) {
//        $color = '#378006';
    
    $eStatus = "";
    if ($event['traineeEmail'] == "") {
        $color = '#0071c5';
    }
    else{
        $color = '#808080';
        $eStatus = "NOT AVAILABLE";
    }
    ?>
                            {
                                id: '<?php echo $event['id']; ?>',
                                title: '<?php echo $event['category']; ?>',
                                date: '<?php echo $event['date']; ?>',
                                startTime: '<?php echo $event['startTime']; ?>',
                                endTime: '<?php echo $event['endTime']; ?>',
                                start: '<?php echo $combinedstart ?>',
                                end: '<?php echo $combinedend; ?>',
                                venue: '<?php echo $venuename; ?>',
                                room: '<?php echo $roomname; ?>',
                                type: '<?php echo $trainingname; ?>',
                                cost: '<?php echo $cost; ?>',
                                eStatus: '<?php echo $eStatus; ?>',
                                color: '<?php echo $color; ?>',
                                description: '<?php echo $event['description']; ?>',
                            },
<?php endforeach; ?>
                    ]
                    ,
                    eventRender: function (event, element) {
                        element.bind('click', function () {
                            $('#eid').val(event.id);
                            $('#ModalView #category').val(event.title);
                            $('#ModalView #date').val(event.date);
                            $('#ModalView #startTime').val(event.startTime);
                            $('#ModalView #endTime').val(event.endTime);
                            $('#ModalView #venueview').val(event.venue);
                            $('#ModalView #roomview').val(event.room);
                            $('#ModalView #typeview').val(event.type);
                            $('#ModalView #costview').val(event.cost);
                            $('#ModalView #description').val(event.description);
                            $('#ModalView #e-status').html(event.eStatus);
                            if(event.eStatus==="NOT AVAILABLE"){
                                 $('#ModalView #joinBtn').hide();
                            }
                            $('#ModalView').modal('show');
                        });
                    }
                });


            });

        </script>



    </body>
</html>
