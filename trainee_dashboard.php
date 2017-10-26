<!--Connection for database -->
<?php
session_start();
require_once('database/dbconfig.php');

//$sql = "SELECT id, category, startTime, endTime, description FROM peronalsession ";
$Semail = $_SESSION['email'];
$Sname = $_SESSION['name'];
$Srole = $_SESSION['role'];
$notpersonal = "Personal Training";

// for testing when trainee view
$traineemail = "trainee1@gmail.com";
if ($Srole == "trainee") {
    $sql = "SELECT * FROM personalsession where traineeEmail= '$Semail'";
} else {
    $sql = "SELECT * FROM personalsession where traineeEmail= '$traineemail' AND category !='$notpersonal' AND trainerEmail = ' ' ";
}
$req = $conn->prepare($sql);
$req->execute();

$events = $req->fetchAll();
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

        <!-- Main CSS -->
        <link rel="stylesheet" href="assets/css/trainee_dashboard.css" />

    </head>
    <body>
        <!-- Header -->
        <?php
        include "trainee_header.php";
        ?>

        <!-- One: Trainee's Profile -->
        <section id="one" class="wrapper style1">

            <div class="container">
                <div class="6u 6u(xsmall)">
                    <header class="major special">
                        <h3>Hello <?php echo $_SESSION['name']; ?> </h3>

                        <p>this is your profile</p>
                    </header>
                </div>
                <div class="6u 4u(xsmall)">
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

                </div>
            </div>
        </section>

        <!-- Two: Trainee Calendar -->
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
                            <button type="submit" id="save" class="btn btn-primary">Save changes</button>
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
                                <label for="description" class="col-sm-2 control-label">Description</label>
                                <div class="col-sm-10">
                                    <input type="text" name="description" class="form-control" id="description">
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

        <!--Calendar script-->
        <script>
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
                    editable: true,
                    eventLimit: true, // allow "more" link when too many events
                    selectable: true,
                    selectHelper: true,
                    select: function (start) {
                        $('#ModalAdd #date').val(moment(start).format('DD-MM-YYYY '));
                        $('#ModalAdd').modal('show');
                    },
                    eventRender: function (event, element) {
                        element.bind('click', function () {
                            $('#ModalView #id').val(event.id);
                            $('#ModalView #category').val(event.title);
                            $('#ModalView #date').val(event.date);
                            $('#ModalView #startTime').val(event.startTime);
                            $('#ModalView #endTime').val(event.endTime);
                            $('#ModalView #description').val(event.description);
                            
                            if(event.title==="1-1 Training")
                            {
                                $('#save').hide();
                            }
                            else{
                                $('#save').show();
                            }
                            $('#ModalView').modal('show');
                        });
                    },
                    eventDrop: function(event, delta, revertFunc) { 

				edit(event);

                    },
                    eventResize: function(event,dayDelta,minuteDelta,revertFunc) { 

				edit(event);

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

                if ($cat == "Personal Training") {
                    $traineeEmail = "Not Applicable";
            
                } else if ($traineeEmail != NULL) {
                    $color = '#378006';
                }
                
                if($cat== 'Personal Training'){
                    $color = '#000';
                } elseif($cat== 'Group Training') {
                    $color = '#008000';
                }elseif($cat== '1-1 Training'){
                    $color = '#0071c5';
                }
                $event['color']=$color;
                ?>
                            {
                                id: '<?php echo $event['id']; ?>',
                                title: '<?php echo $event['category']; ?>',
                                date: '<?php echo $event['date']; ?>',
                                startTime: '<?php echo $event['startTime']; ?>',
                                endTime: '<?php echo $event['endTime']; ?>',
                                start: '<?php echo $combinedstart ?>',
                                end: '<?php echo $combinedend; ?>',
                                description: '<?php echo $event['description']; ?>',
                                color: '<?php echo $event['color']; ?>',
                                
                            },
<?php endforeach; ?>
                    ]
                    
                    });

                  function edit(event){
			startTime = event.start.format('Y-m-d H:i:s');
			if(event.endTime){
				endTime = event.end.format('Y-m-d H:i:s');
			}else{
				endTime = startTime;
			}	
			id =  event.id;
			date = event.date;
                        
			Event = [];
			Event[0] = id;
			Event[1] = startTime;
			Event[2] = endTime;
                        Event[3] = date;
                        
			$.ajax({
			 url: 'editCalendarEventDate.php',
			 type: "POST",
			 data: {Event:Event},
			 success: function(rep) {
					if(rep === 'OK'){
						alert('Saved');
					}else{
						alert('Could not be saved. try again.'); 
					}
				}
			});
		}
            });

        </script>



    </body>
</html>