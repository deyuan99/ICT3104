<!--Connection for database -->
<?php
session_start();
require_once('database/dbconfig.php');
$Semail = $_SESSION['email'];
$Sname = $_SESSION['name'];
$Srole = $_SESSION['role'];

$sql = "SELECT * FROM personalsession where trainerEmail= '$Semail'";
$sql6 = "SELECT * FROM groupsession where trainerEmail= '$Semail' and status != 'Rejected' ";


$req = $conn->prepare($sql);
$req->execute();
$events = $req->fetchAll();

$req6 = $conn->prepare($sql6);
$req6->execute();
$grpevents = $req6->fetchAll();


// For selecting all venue
$sql2 = "SELECT location FROM venue";
$req2 = $conn->prepare($sql2);
$req2->execute();
$venues = $req2->fetchAll();

// For selecting all types of training
$sql3 = "SELECT trainingName FROM typeoftraining";
$req3 = $conn->prepare($sql3);
$req3->execute();
$typeofTrainings = $req3->fetchAll();
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>STPS</title>

        <!-- Bootstrap Core CSS -->
        <link href="bootstrap-3.3.5-dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- FullCalendar -->
        <link href='fullcalendar-3.5.1/fullcalendar.css' rel='stylesheet' />
        <link href="assets/css/calendar.css" rel="stylesheet" type="text/css"/>

        <!-- trainer_dashboard CSS -->
        <link rel="stylesheet" href="assets/css/trainer_dashboard.css" />

        <!-- Editable profile -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

    </head>
    <body>
        <!-- Header -->
        <?php
        include "trainer_header.php";
        ?>

        <!-- One: Trainer Profile -->
        <section id="main" class="wrapper">
            <div class="container">
                <div class="row">
                    <!-- Login -->
                    <div class="6u 12u(xsmall)">
                        <header class="major special">
                            <h3>Hello, <?php echo $Sname; ?> </h3>
                        </header>

                        <?php
                        $sqlProfile = "SELECT * FROM users where email='$Semail' ";
                        $result = $conn->prepare($sqlProfile);
                        $result->execute();
                        $count = $result->rowCount();
                        if ($count > 0) {
                            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                                $id = $row['email'];
                                $firstName = $row['firstName'];
                                $lastName = $row['lastName'];
                                $phoneNumber = $row['phoneNumber'];
                            }
                        } else {
                            echo "There are no users yet!";
                        }
                        ?>

                        <!-- profile picture -->
                        <?php
                        $sqlProfile = "SELECT * FROM users where email = '$Semail'";
                        $result = $conn->prepare($sqlProfile);
                        $result->execute();
                        $count = $result->rowCount();
                        if ($count > 0) {
                            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                                $sqlImg = $row['profilePicture'];
                                echo "<div class='user-container'>";
                                if (strlen($sqlImg) > 0) {
                                    echo "<img src='$sqlImg'>";
                                } else {
                                    echo "<img src='images/uploads/profiledefault.jpg'>";
                                }
                                echo "<p>" . $row['email'] . "</p>";
                                echo "</div>";
                            }
                        } else {
                            echo "There are no users yet!";
                        }
                        if (isset($_SESSION['email'])) {
                            if ($_SESSION['email'] == "trainee1@gmail.com") {
                                //echo "You are logged in as user ";
                            }
                            echo "<form action='scripts/uploadProfileImg.php' method='POST' enctype='multipart/form-data'>
			<input type='file' name='file'>
			<button type='submit' name='submit'>UPLOAD</button>
                        </form>";
                        } else {
                            echo "You are not logged in!";
                            echo "<form action='signup.php' method='POST'>
			<input type='text' name='first' placeholder='First name'>
			<input type='text' name='last' placeholder='Last name'>
			<input type='text' name='uid' placeholder='Username'>
			<input type='password' name='pwd' placeholder='Password'>
			<button type='submit' name='submitSignup'>Signup</button>
		</form>";
                        }
                        ?>
                        <form action="scripts/profileUpdate.php" method="post" onsubmit="return validateForm();">
                            <table id="form" class="view">
                                <tbody>
                                    <tr>
                                        <td class="col-md-3">
                                            <h3>Contact Info</h3>
                                        </td>
                                        <td>
                                            <button id="edit" class="button ">Edit</button>
                                            <input type="submit" value="update" id="update" class="button special" style="display:none"/>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="col-md-1">
                                            <p class='leftspacing'>First Name</p>
                                        </td>
                                        <td>

                                            <p><input type='text' name= "firstName" id="firstName" class="data" value="<?php echo $firstName ?>" readonly/></p>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p class='leftspacing'>Last Name</p>
                                        </td>
                                        <td>
                                            <?php
                                            echo "<p><input type='text' value=" . $lastName . " readonly/></p>"
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p class='leftspacing'>Phone Number</p>
                                        </td>
                                        <td>
                                            <?php
                                            echo "<p><input type='text' value=" . $phoneNumber . " readonly/></p>"
                                            ?>
                                        </td>
                                    </tr>
                                    </form>
                                    </div>
                                </tbody>
                            </table>
                        </form>
                    </div>
                </div>

        </section>

        <!-- Two: Trainer Calendar -->
        <section id="two" class="wrapper style2 special">
            <div class="container">
                <header class="major">
                    <h2>Your Calendar</h2>
                    <p></p>
                </header>
                <div id="calendar" class="col-centered">
                </div>
            </div>
        </section>

        <!--modal view-->
        <div class="modal fade" id="ModalView" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="padding-top: 70px;">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form class="form-horizontal" method="POST" action="applyfor1to1.php">

                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">View Events</h4>
                        </div>
                        <div class="modal-body">

                            <div class="form-group">
                                <label for="category" class="col-sm-2 control-label">Category</label>
                                <div class="col-sm-10">
                                    <input type="text" name="category" class="form-control" id="category" value="<?php echo $event['category']; ?>" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="color" class="col-sm-2 control-label">Date</label>
                                <div class="col-sm-10">
                                   <?php $celldate = "t"?>
                                    <input type="text" name="date" class="form-control" id="date" value="<?php echo $event['date']; ?>" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="start" class="col-sm-2 control-label">Start Time</label>
                                <div class="col-sm-10">
                                <!--<input type="text" name="startTime" class="form-control" id="startTime" value="<?php //echo $event['startTime'];   ?>" readonly>-->
                                    <select name="starttime" class="form-control" id="starttime" >
                                        <option value="09:00:00">9am</option>
                                        <option value="10:00:00">10am</option>
                                        <option value="11:00:00">11am</option>
                                        <option value="12:00:00">12am</option>
                                        <option value="13:00:00">1pm</option>
                                        <option value="14:00:00">2pm</option>
                                        <option value="15:00:00">3pm</option>
                                        <option value="16:00:00">4pm</option>
                                        <option value="17:00:00">5pm</option>
                                    </select>                                </div>
                            </div>

                            <div class="form-group">
                                <label for="end" class="col-sm-2 control-label">End Time</label>
                                <div class="col-sm-10">
                                    <!--<input type="text" name="endTime" class="form-control" id="endTime" value="<?php //echo $event['endTime'];   ?>" readonly>-->
                                    <select name="endtime" class="form-control" id="endtime" >
                                        <option value="10:00:00">10am</option>
                                        <option value="11:00:00">11am</option>
                                        <option value="12:00:00">12am</option>
                                        <option value="13:00:00">1pm</option>
                                        <option value="14:00:00">2pm</option>
                                        <option value="15:00:00">3pm</option>
                                        <option value="16:00:00">4pm</option>
                                        <option value="17:00:00">5pm</option>
                                        <option value="18:00:00">6pm</option>
                                    </select>
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
                                <label for="grpsizeview" class="col-sm-2 control-label">Capacity</label>
                                <div class="col-sm-10">
                                    <input type="text" name="grpsizeview" class="form-control" id="grpsizeview" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="end" class="col-sm-2 control-label">Description</label>
                                <div class="col-sm-10">
                                    <input type="text" name="description" class="form-control" id="description" value="<?php echo $event['description']; ?>" readonly>
                                </div>
                            </div>    

                            <input type="hidden" name="evid" class="form-control" id="evid">

                            <?php if ($Srole == "trainer") {?>
                                <div class="form-group">
                                    <label for="trainee" class="col-sm-2 control-label">Trainees</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="trainee" class="form-control" id="trainee" value="<?php echo $event['traineeEmail']; ?>" readonly>
                                    </div>
                                </div>
                            <?php } ?>
                            
                            <div class="form-group">
                                <label for="status" class="col-sm-2 control-label">Status</label>
                                <div class="col-sm-10">
                                    <input type="text" name="status" class="form-control" id="status" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button> 
                            <button type="submit" class="btn btn-primary">Save changes</button>                          
                            <!--<input type="hidden" id="evid" name="evid" value="<?php //echo $event['id'];   ?>" />-->
                            <?php if ($Srole == "trainee") { ?>
                                <button type="submit" class="btn btn-primary">Apply</button>
                            <?php } ?>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <?php if ($Srole == 'trainer') { ?>
            <!-- Modal Create Event-->
            <div class="modal fade" id="ModalAdd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">

                        <form class="form-horizontal" method="POST" action="addCalendarEventTrainer.php">

                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Add Event</h4>
                            </div>
                            <div class="modal-body">

                                <div class="form-group">
                                    <label for="Pcategory" class="col-sm-2 control-label">Category</label>
                                    <div class="col-sm-10">
                                        <select name="Pcategory" class="form-control" id="Pcategory" >
                                            <option style="color:#000;" value="Personal Training">&#9724; Personal Training</option>
                                            <option style="color:#008000;" value="Group Training">&#9724; Group Training</option>
                                            <option style="color:#0071c5;" value="1-1 Training">&#9724; 1-1 Training</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="date" class="col-sm-2 control-label">Date</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="date" class="form-control" id="date" readonly>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="start" class="col-sm-2 control-label">Start Time</label>
                                    <div class="col-sm-10">
                                        <select name="starttime" class="form-control" id="starttime" >
                                            <option value="09:00:00">9am</option>
                                            <option value="10:00:00">10am</option>
                                            <option value="11:00:00">11am</option>
                                            <option value="12:00:00">12am</option>
                                            <option value="13:00:00">1pm</option>
                                            <option value="14:00:00">2pm</option>
                                            <option value="15:00:00">3pm</option>
                                            <option value="16:00:00">4pm</option>
                                            <option value="17:00:00">5pm</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="end" class="col-sm-2 control-label">End Time</label>
                                    <div class="col-sm-10">
                                        <select name="endtime" class="form-control" id="endtime" >
                                            <option value="10:00:00">10am</option>
                                            <option value="11:00:00">11am</option>
                                            <option value="12:00:00">12am</option>
                                            <option value="13:00:00">1pm</option>
                                            <option value="14:00:00">2pm</option>
                                            <option value="15:00:00">3pm</option>
                                            <option value="16:00:00">4pm</option>
                                            <option value="17:00:00">5pm</option>
                                            <option value="18:00:00">6pm</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="venue" class="col-sm-2 control-label">Venue</label>
                                    <div class="col-sm-10">
                                        <select name="venue" class="form-control" id="venue" required>
                                            <option value="">- Select Venue -</option>
                                            <?php
                                            foreach ($venues as $venue):
                                                $location = $venue['location'];
                                                echo '<option value="'. $location .'">'. $location .'</option>';
                                            endforeach; ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div id="hidden_div_rm">
                                        <label for="roomtype" class="col-sm-2 control-label">Room</label>
                                        <div class="col-sm-10">
                                            <select name="roomtype" class="form-control" id="roomtype" required>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                                <div id="hidden_div_1v1grp">
                                    <div class="form-group">
                                        <label for="venue" class="col-sm-2 control-label">Type</label>
                                        <div class="col-sm-10">
                                            <select name="typeofTraining" class="form-control" id="typeofTraining" >
                                                <option value="">- Select Type -</option>
                                                <?php
                                                foreach ($typeofTrainings as $typeofTraining):
                                                    $ttype = $typeofTraining['trainingName'];
                                                    echo '<option value="'. $ttype .'">'. $ttype .'</option>';
                                                endforeach; ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div id="hidden_div_cost">
                                            <label for="cost" class="col-sm-2 control-label">Cost</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="tcost" class="form-control" id="tcost" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <div id="hidden_div_size">
                                        <label for="groupsize" class="col-sm-2 control-label">Capacity</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="groupsize" class="form-control" id="groupsize">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="description" class="col-sm-2 control-label">Description</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="description" class="form-control" id="description" placeholder="Description">
                                    </div>
                                </div>

                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Create Event</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>

    <p id="demo"></p>
    <script>
        function myFunction() {
            document.getElementById("myP").contentEditable = true;
            document.getElementById("demo").innerHTML = "The p element above is now editable. Try to change its text.";
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

    <!-- jQuery Version 1.11.1 -->
    <script src="fullcalendar-3.5.1/lib/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="bootstrap-3.3.5-dist/js/bootstrap.min.js"></script>

    <!-- FullCalendar -->
    <script src='fullcalendar-3.5.1/lib/moment.min.js'></script>
    <script src='fullcalendar-3.5.1/fullcalendar.min.js'></script>

    <!--Calendar script-->
    <script>
        $('#hidden_div_rm').hide();
        $('#hidden_div_1v1grp').hide();
        $('#hidden_div_cost').hide();
        $('#hidden_div_size').hide();
        
        // for training type
        $(function () {
            $('#Pcategory').change(function () {
                if ($('#Pcategory').val() === "Personal Training") {
                    $('#hidden_div_1v1grp').hide();
                    document.getElementById("typeofTraining").required = false;
                    $('#hidden_div_size').hide();
                    document.getElementById("groupsize").required = false;
                } else if ($('#Pcategory').val() === "1-1 Training") {
                    $('#hidden_div_1v1grp').show();
                    document.getElementById("typeofTraining").required = true;
                    $('#hidden_div_size').hide();
                    document.getElementById("groupsize").required = true;
                } else {
                    $('#hidden_div_1v1grp').show();
                    document.getElementById("typeofTraining").required = true;
                    $('#hidden_div_size').show();
                    document.getElementById("groupsize").required = true;
                }
            });
        });
        // for venue
        $("#venue").change(function ()
        {
            if ($('#venue').val() === "select") {
                $('#hidden_div_rm').hide();
            } else {
                $('#hidden_div_rm').show();
            }

            var venue = $(this).find(":selected").val();
//                alert(id);
            $.ajax
                ({
                    type: "POST",
                    url: 'phpCodes/getRoomType.php',
                    data: {venue: venue},
                    cache: false,
                    success: function (r)
                    {
                        //document.getElementById("roomtype").value = r;
                        var result = $.parseJSON(r);
//                            alert(result);
                        $('#roomtype').html("<option value=''>- Select Room -</option>");
                        result.forEach(function(item) {
                            $('#roomtype').append($("<option></option>")
                                            .attr("value",item)
                                            .text(item)); 
                        });

                    }
                });
        });
        // for training type cost
        $("#typeofTraining").change(function ()
        {
            if ($('#typeofTraining').val() === "select") {
                $('#hidden_div_cost').hide();
            } else {
                $('#hidden_div_cost').show();
            }

            var ttype = $(this).find(":selected").val();
//                alert(id);
            $.ajax
                ({
                    type: "POST",
                    url: 'phpCodes/getCost.php',
                    data: {ttype: ttype},
                    cache: false,
                    success: function (r2)
                    {
//                        alert(r2);
                        document.getElementById("tcost").value = r2;
                    }
                });
        });

        $(document).ready(function () {
            //var today = moment().day();
            $('#calendar').fullCalendar({
                header: {
                    left: 'title',
                    center: 'prev,next today',
                    right: 'month,agendaWeek,agendaDay'
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
                select: function (start) {
                    $('#ModalAdd #date').val(moment(start).format('DD-MM-YYYY '));
                    $('#ModalAdd').modal('show');
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
    
    if ($cat == "Personal Training") {
        $traineeEmail = "Not Applicable";
        $trainingname = "Not Applicable";
        $cost = "Not Applicable";
    } else if ($traineeEmail == NULL && $cat == "1-1 Training") {
        $traineeEmail = "Still available";
    }

    if ($cat == 'Personal Training') {
        $color = '#000';
    } elseif ($cat == 'Group Training') {
        $color = '#008000';
    } elseif ($cat == '1-1 Training') {
        $color = '#0071c5';
    }
    $event['color'] = $color;
    ?>
                        {
                            evid: '<?php echo $event['id']; ?>',
                            title: '<?php echo $event['category']; ?>',
                            date: '<?php echo $event['date']; ?>',
                            startTime: '<?php echo $event['startTime']; ?>',
                            endTime: '<?php echo $event['endTime']; ?>',
                            start: '<?php echo $combinedstart; ?>',
                            end: '<?php echo $combinedend; ?>',
                            venue: '<?php echo $venuename; ?>',
                            room: '<?php echo $roomname; ?>',
                            type: '<?php echo $trainingname; ?>',
                            cost: '<?php echo $cost; ?>',                            
                            grpsize: '<?php echo "Not Applicable"; ?>',
                            description: '<?php echo $event['description']; ?>',
                            trainee: '<?php echo $traineeEmail; ?>',
                            color: '<?php echo $event['color']; ?>',
                            status: '<?php echo "Not Applicable"; ?>',
                        },
<?php endforeach;
?>
<?php 
    foreach ($grpevents as $grpevent):
    $start = $grpevent['startTime'];
    $end = $grpevent['endTime'];
    $eventdate = $grpevent['date'];

    $combinedstart = date('Y-m-d H:i:s', strtotime("$eventdate $start"));
    $combinedend = date('Y-m-d H:i:s', strtotime("$eventdate $end"));
    
    $roomt = $grpevent['roomTypeID'];
    $sql4 = "SELECT roomtype.name, venue.location FROM roomtype, venue WHERE roomtype.id = '$roomt' AND roomtype.venueID = venue.id";
    $req4 = $conn->prepare($sql4);
    $req4 -> execute();
    $names = $req4 -> fetch(PDO::FETCH_ASSOC);
    $roomname = $names['name'];
    $venuename = $names['location'];
       
    $trainingtype = $grpevent['typeofTrainingID'];
    $sql5 = "SELECT trainingName, cost FROM typeoftraining WHERE id = '$trainingtype'";
    $req5 = $conn->prepare($sql5);
    $req5 -> execute();
    $names2 = $req5 -> fetch(PDO::FETCH_ASSOC);
    $trainingname = $names2['trainingName'];
    $cost = "$" . $names2['cost'];
    
    $grpeventid = $grpevent['id'];
    $sql6 = "SELECT traineeEmail FROM groupsessionapplicant where groupSessionID = '$grpeventid'";
    $req6 = $conn->prepare($sql6);
    $req6 -> execute();
    $traineelist = $req6 -> fetchAll();
    $trainees = "";
    
    foreach ($traineelist as $trainee):
        $trainees = $trainees . $trainee['traineeEmail'] . ", ";
    endforeach;
    
    if ($trainees == "") {
        $trainees = "No Applicants yet";
    }
    
    $grpsize = $grpevent['groupCapacity'];
    $currentsize = count($traineelist);
    $grpsize = $currentsize . " / " . $grpsize;

    $color = '#008000';

?>
                {
                            evid: '<?php echo $grpevent['id']; ?>',
                            title: '<?php echo "Group Training" ?>',
                            date: '<?php echo $grpevent['date']; ?>',
                            startTime: '<?php echo $grpevent['startTime']; ?>',
                            endTime: '<?php echo $grpevent['endTime']; ?>',
                            start: '<?php echo $combinedstart; ?>',
                            end: '<?php echo $combinedend; ?>',
                            venue: '<?php echo $venuename; ?>',
                            room: '<?php echo $roomname; ?>',
                            type: '<?php echo $trainingname; ?>',
                            cost: '<?php echo $cost; ?>',                            
                            grpsize: '<?php echo $grpsize; ?>',
                            description: '<?php echo $grpevent['description']; ?>',
                            trainee: '<?php echo $trainees ?>',
                            color: '<?php echo $color; ?>',
                            status: '<?php echo $grpevent['status'] ?>',
                        },
<?php endforeach;
?> 
                
                ]
                ,
                eventRender: function (event, element) {
                    element.bind('click', function () {
                        $('#ModalView #evid').val(event.evid);
                        $('#ModalView #category').val(event.title);
                        $('#ModalView #status').val(event.status);
                        $('#ModalView #date').val(event.date);
                        $('#ModalView #startTime').val(event.startTime);
                        $('#ModalView #endTime').val(event.endTime);
                        $('#ModalView #venueview').val(event.venue);
                        $('#ModalView #roomview').val(event.room);
                        $('#ModalView #typeview').val(event.type);
                        $('#ModalView #costview').val(event.cost);
                        $('#ModalView #grpsizeview').val(event.grpsize);
                        $('#ModalView #description').val(event.description);
                        $('#ModalView #trainee').val(event.trainee);
                        $('#ModalView').modal('show');
                    });
                },
                eventDrop: function (event, delta, revertFunc) {
                    edit(event);
                },
                eventResize: function (event, dayDelta, minuteDelta, revertFunc) {
                    edit(event);
                }

            });

            function edit(event) {
                startTime = event.start.format('Y-m-d H:i:s');
                if (event.endTime) {
                    endTime = event.end.format('Y-m-d H:i:s');
                } else {
                    endTime = startTime;
                }
                id = event.evid;
                date = event.date;
                
                Event = [];
                Event[0] = id;
                Event[1] = startTime;
                Event[2] = endTime;
                Event[3] = date;
                
                $.ajax({
                    url: 'editCalendarEventDate.php',
                    type: "POST",
                    data: {Event: Event},
                    success: function (rep) {
                        if (rep === 'OK') {
                            alert('Saved');
                        } else {
                            alert('Could not be saved. try again.');
                        }
                    }
                });
            }
        });</script>
    <!-- Profile update -->
    <script>
        var flag = 0;
        $('#edit').click(function () {
            $('#form').toggleClass('view');
            $('#edit').css('display', 'none');
            $('#update').css('display', 'block');
            $('input').each(function () {
                var inp = $(this);
                if (inp.attr('readonly')) {
                    inp.removeAttr('readonly');
                    $('#edit').css('display', 'none');
                    $('#update').css('display', 'block');
                }
                else {
                    inp.attr('readonly', 'readonly');
                }
            });
            flag = 0;
        });
    </script>
    <script>
        $('#update').click(function () {
            $('#form').toggleClass('view');
            $('#edit').css('display', 'block');
            $('#update').css('display', 'none');
            flag = 1;
            var fName = $('#firstName').val();
            //document.getElementById("edit_mobile").value = mobile;
            //alert(fName);
            $('input').each(function () {
                var inp = $(this);
                if (inp.attr('readonly')) {
                    inp.removeAttr('readonly');
                    $('#edit').css('display', 'block');
                    $('#update').css('display', 'none');
                }
                else {
                    inp.attr('readonly', 'readonly');
                }
            });
        });</script>
    <script>
        function validateForm() {
            //alert("fName");
            if (flag == 1) {
                return true;
            } else {
                return false;
            }
            //if update button return true
        }
    </script>
</body>
</html>