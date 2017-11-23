<!--Connection for database -->
<?php
session_start();
require_once('database/dbconfig.php');

//$sql = "SELECT id, category, startTime, endTime, description FROM peronalsession ";
$Semail = $_SESSION['email'];
$Sname = $_SESSION['name'];
$Srole = $_SESSION['role'];
$traineemail = $_SESSION['email'];

$sql = "SELECT id, category, roomTypeID, typeoftrainingid, startTime, endTime, date, description, trainerEmail, traineeEmail, null as groupCapacity 
FROM personalsession p 
where p.traineeEmail = '$traineemail' 
UNION 
SELECT g.id, 'Group Training' as category, roomTypeID, typeoftrainingid, startTime, endTime, date, description, g.trainerEmail, a.traineeEmail, g.groupCapacity 
FROM groupsessionapplicant a, groupsession g  
Where a.traineeEmail = '$traineemail' and g.id = a.groupSessionID and g.status = 'approved'";

$req = $conn->prepare($sql);
$req->execute();

$events = $req->fetchAll();


// For selecting all venue
$sql2 = "SELECT location FROM venue";
$req2 = $conn->prepare($sql2);
$req2->execute();
$venues = $req2->fetchAll();
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


        <!-- trainer_dashboard CSS -->
        <link rel="stylesheet" href="assets/css/trainer_dashboard.css" />

        <style>
            /* calendar hover */
            .qtip-content-margin {
                margin-left:0;
                margin-right:0;
                margin-bottom:8px;
            }
        </style>
    </head>
    <body>
        <!-- Header -->
        <?php
        include "trainee_header.php";
        ?>

        <!-- One: Trainer Profile -->
        <section id="one" class="wrapper style2 special">

            <div class="container">

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
                        $address = $row['address'];
                        $profileBio = $row['profileBio'];
                        $phoneNumber = $row['phoneNumber'];
                        $password = $row['password'];
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
                        echo "<p> Joined since: " . $row['registerDate'] . "</p>";
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
			<div align='center'>
                            <input type='file' name='file'><br>
                            <button class='button' type='submit' name='submit'>UPLOAD</button>
                        </div>
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
                <form action="scripts/trainee_profileUpdate.php" method="post" onsubmit="return validateForm();">
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
                                    <p><input type='text' name= "lastName" id="lastName" class="data" value="<?php echo $lastName  ?>" readonly/></p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p class='leftspacing'>Address</p>
                                </td>
                                <td>
                                    <p><input type='text' name= "address" id="address " class="data" value="<?php echo $address  ?>" readonly/></p>                             
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p class='leftspacing'>Phone Number</p>
                                </td>
                                <td>
                                  <p><input type='text' name= "phoneNumber" id="phoneNumber " class="data" value="<?php echo $phoneNumber  ?>" readonly/></p>                             
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p class='leftspacing'>Profile Bio</p>
                                </td>
                                <td>
                                      <p><input type='text' name= "profileBio" id="profileBio " class="data" value="<?php echo $profileBio  ?>" readonly/></p>                             
                                
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p class='leftspacing'>Password</p>
                                </td>
                                <td>
                                    <a href="changepassword.php" class="btn btn-default">Change Password</a>
                             
                                </td>
                            </tr>
                            </form>
                            </div>
                        </tbody>
                    </table>
                </form>
            </div>
        </section>

        <!-- Two: Trainee Calendar -->
        <section id="two" class="wrapper style1">
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
                    <form class="form-horizontal" method="POST" action="editCalendarEvent.php">

                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">View/Edit Events</h4>
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
                                    <input type="text" name="date" class="form-control" id="date" value="<?php echo $event['date']; ?>" readonly>
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
                                <label for="trainerview" class="col-sm-2 control-label">Trainer</label>
                                <div class="col-sm-10">
                                    <input type="text" name="trainerview" class="form-control" id="trainerview" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="end" class="col-sm-2 control-label">Description</label>
                                <div class="col-sm-10">
                                    <input type="text" name="description" class="form-control" id="description" value="<?php echo $event['description']; ?>" >
                                </div>
                            </div> 

                            <!--<div class="form-group"> 
                                <div class="col-sm-offset-2 col-sm-10">
                                  <div class="checkbox">
                                        <label class="text-danger"><input type="checkbox"  name="delete"> Delete event</label>
                                  </div>
                                </div>
                            </div>-->

                            <input type="hidden" name="id" class="form-control" id="id">

                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" name="save" id="save" value="save" class="btn btn-primary">Save changes</button>
                            <button type="submit" name="delete" id="delete" value="delete" class="btn btn-danger">Delete</button>

                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="ModalAdd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="padding-top: 70px;">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form class="form-horizontal" method="POST" action="addCalendarEvent.php">

                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Add Event</h4>
                        </div>
                        <div class="modal-body">

                            <div class="form-group">
                                <label for="category" class="col-sm-2 control-label">Category</label>
                                <div class="col-sm-10">
                                    <select name="category" class="form-control" id="category" >
                                        <option style="color:#000;" value="Personal Training">&#9724; Personal Training</option>
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
                                            echo '<option value="' . $location . '">' . $location . '</option>';
                                        endforeach;
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <div id="hidden_div">
                                    <label for="roomtype" class="col-sm-2 control-label">Room</label>
                                    <div class="col-sm-10">
                                        <select name="roomtype" class="form-control" id="roomtype" required>
                                        </select>
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
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Add Event</button>
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

        <!--qtip must be after funllcalendarJS-->
        <link type="text/css" rel="stylesheet" href="jquery_qtip/jquery.qtip.css" />
        <script src="jquery_qtip/jquery.qtip.js"></script>

        <!--Calendar script-->
        <script>
                    // for showing the room types based on venue chosen
//            $(function () {
//                $('#hidden_div').hide();
//                $('#venue').change(function () {
//                    if ($('#venue').val() !== "select") {
//                        $('#hidden_div').show();
//                    } else {
//                        $('#hidden_div').hide();
//                    }
//                });
//            });
// get today date javascript
                    var today = new Date();
                    var datetoday = today.getFullYear() + '-' + (today.getMonth() + 1) + '-' + today.getDate();

                    $('#hidden_div').hide();
                    $("#venue").change(function ()
                    {
                        if ($('#venue').val() === "select") {
                            $('#hidden_div').hide();
                        } else {
                            $('#hidden_div').show();
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
                                        //$('#roomtype').html("");
                                        $('#roomtype').html("<option value=''>- Select Room -</option>");
                                        result.forEach(function (item) {
                                            $('#roomtype').append($("<option></option>")
                                                    .attr("value", item)
                                                    .text(item));
                                        });

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
                                end: $.fullCalendar.moment().startOf('month').add(2, 'month')
                            },
                            select: function (start) {
                                $('#ModalAdd #date').val(moment(start).format('DD-MM-YYYY '));
                                $('#ModalAdd').modal('show');
                            },
                            eventDrop: function (event, delta, revertFunc) {

                                edit(event);

                            },
                            eventResize: function (event, dayDelta, minuteDelta, revertFunc) {

                                edit(event);

                            },
                            events: [
<?php
//date to set colour
$todaydateis = date("Y-m-d");
foreach ($events as $event):


    $start = $event['startTime'];
    $end = $event['endTime'];
    $cat = $event['category'];
    $eventdate = $event['date'];
    $traineeEmail = $event['traineeEmail'];
    $trainerEmail = $event['trainerEmail'];
    $combinedstart = date('Y-m-d H:i:s', strtotime("$eventdate $start"));
    $combinedend = date('Y-m-d H:i:s', strtotime("$eventdate $end"));

    $roomt = $event['roomTypeID'];
    $sql4 = "SELECT roomtype.name, venue.location FROM roomtype, venue WHERE roomtype.id = '$roomt' AND roomtype.venueID = venue.id";
    $req4 = $conn->prepare($sql4);
    $req4->execute();
    $names = $req4->fetch(PDO::FETCH_ASSOC);
    $roomname = $names['name'];
//                echo "alert($roomname)";
    $venuename = $names['location'];

    if ($cat == "1-1 Training" || $cat == "Group Training") {
        $trainingtype = $event['typeoftrainingid'];
        $sql5 = "SELECT trainingName, cost FROM typeoftraining WHERE id = '$trainingtype'";
        $req5 = $conn->prepare($sql5);
        $req5->execute();
        $names2 = $req5->fetch(PDO::FETCH_ASSOC);
        $trainingname = $names2['trainingName'];
        $cost = "$" . $names2['cost'];
    }

    if ($cat == "Personal Training") {
        $traineeEmail = "Not Applicable";
        $trainingname = "Not Applicable";
        $cost = "Not Applicable";
        $trainerEmail = "Not Applicable";
    } else if ($traineeEmail != NULL) {
        $color = '#378006';
    }

    if ($cat == 'Personal Training') {
        $color = '#000';
    } elseif ($cat == 'Group Training') {
        $color = '#008000';
    } elseif ($cat == '1-1 Training') {
        $color = '#0071c5';
    }
    if (strtotime($todaydateis) > strtotime($eventdate)) {
        $color = '#DC143C';
    }
    ?>
                                    {
                                        id: '<?php echo $event['id']; ?>',
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
                                        trainer: '<?php echo $trainerEmail; ?>',
                                        description: '<?php echo $event['description']; ?>',
                                        color: '<?php echo $color; ?>',
                                    },
<?php endforeach; ?>
                            ],
                            eventRender: function (event, element) {

                                element.bind('click', function () {
                                    $('#ModalView #id').val(event.id);
                                    $('#ModalView #category').val(event.title);
                                    $('#ModalView #date').val(event.date);
                                    $('#ModalView #startTime').val(event.startTime);
                                    $('#ModalView #endTime').val(event.endTime);
                                    $('#ModalView #venueview').val(event.venue);
                                    $('#ModalView #roomview').val(event.room);
                                    $('#ModalView #typeview').val(event.type);
                                    $('#ModalView #costview').val(event.cost);
                                    $('#ModalView #trainerview').val(event.trainer);
                                    $('#ModalView #description').val(event.description);


                                    // compare date for javascript


                                    if (event.title === "1-1 Training" || event.title === "Group Training" && new Date(datetoday).getTime() < new Date(event.date).getTime())
                                    {
                                        $('#save').hide();
                                        $('#delete').show();
                                    }
                                    else {
                                        $('#save').show();
                                    }
                                    if (new Date(datetoday).getTime() > new Date(event.date).getTime()) {
                                        $('#save').hide();
                                        $('#delete').hide();
                                    }
                                    $('#ModalView').modal('show');
                                });
                            },
                            eventMouseover: function (event, jsEvent, view) {

                                var tooltip = $(this).qtip({
                                    id: 'calendar',
                                    prerender: true,
                                    content: {
                                        text: ''
                                    },
                                    position: {
                                        my: 'left center',
                                        at: 'right center',
                                        viewport: $('#calendar'),
                                        adjust: {
                                            mouse: true,
                                            scroll: true
                                        }
                                    },
                                    show: {
                                        solo: true
                                    },
                                    hide: {
                                        event: 'mouseleave',
                                        fixed: true
                                    },
                                    style: 'qtip-light'
                                }).qtip('api');

                                current = new Date();

                                var content = '<h4>' + event.title + '</h4>';
                                content += '<div class="row qtip-content-margin"><b>Description: </b> &nbsp' + event.description + '</div>';
                                content += '<div class="row qtip-content-margin"><b>Date: </b> &nbsp' + event.date + '</div>';
                                content += '<div class="row qtip-content-margin"><b>Time: </b> &nbsp' + event.startTime + ' to ' + event.endTime + '</div>';
                                content += '<div class="row qtip-content-margin"><b>Venue: </b> &nbsp' + event.room + ' room at ' + event.venue + '</div>';

                                tooltip.set({
                                    'content.text': content
                                }).show(jsEvent);

                            }
                        });

                        function edit(event) {
                            startTime = event.start.format('Y-m-d H:i:s');
                            if (event.endTime) {
                                endTime = event.end.format('Y-m-d H:i:s');
                            } else {
                                endTime = startTime;
                            }
                            id = event.id;
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
                    });

        </script>

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
                var lName = $('#lastName').val();
                var address = $('#address').val();
                var phoneNumber = $('#phoneNumber').val();
                var profileBio = $('#profileBio').val();
                var password = $('#password').val();
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