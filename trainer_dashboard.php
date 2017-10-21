
<!--Connection for database -->

<?php
session_start();
require_once('database/dbconfig.php');
$Semail = $_SESSION['email'];
$Sname = $_SESSION['name'];
$Srole = $_SESSION['role'];
$notpersonal = "Personal Training";
// for testing when trainee view
$trainermail = "trainer1@gmail.com";
if ($Srole == "trainer"){
    $sql = "SELECT * FROM personalsession where trainerEmail= '$Semail'";
}else{
        $sql = "SELECT * FROM personalsession where trainerEmail= '$trainermail' AND category !='$notpersonal' ";

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
        <link rel="stylesheet" href="assets/css/main.css" />

    </head>
    <body>
        <!-- Header -->
        <?php
        include "trainee_header.php";
        ?>

        <!-- One: Trainer Profile -->
        <section id="one" class="wrapper style1">

            <div class="container">

                <header class="major special">
                    <h3>Hello <?php echo $Sname;?> </h3>
                </form>
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
                    <form class="form-horizontal" method="POST" action="#">

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
                            <label for="end" class="col-sm-2 control-label">Description</label>
                            <div class="col-sm-10">
                                <input type="text" name="description" class="form-control" id="description" value="<?php echo $event['description']; ?>" readonly>
                            </div>
                        </div>    
                       	
                         <div class="form-group">
                            <label for="end" class="col-sm-2 control-label">Cost $</label>
                            <div class="col-sm-10">
                                <input type="text" name="cost" class="form-control" id="cost" value="<?php echo $event['cost']; ?>" readonly>
                            </div>
                        </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <!-- Modal -->
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
                                <label for="category" class="col-sm-2 control-label">Category</label>
                                <div class="col-sm-10">
                                    <select name="category" class="form-control" id="category" >
                                        <option value="Personal Training">Personal Training</option>
                                        <option value="Group Training">Group Training</option>
                                        <option value="1-1 Training">1-1 Training</option>
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
                       	
                         <div class="form-group">
                            <label for="cost" class="col-sm-2 control-label">Cost $</label>
                            <div class="col-sm-10">
                                <input type="text" name="cost" class="form-control" id="cost"
                            </div>
                        </div>

                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
   </div>



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
                    editable: true,
                    eventLimit: true, // allow "more" link when too many events
                    selectable: true,
                    selectHelper: true,
                    select: function (start) {

                        $('#ModalAdd #date').val(moment(start).format('DD-MM-YYYY '));
                        $('#ModalAdd').modal('show');
                    },
                    events: [
<?php
foreach ($events as $event):
    $start =  $event['startTime'];
    $end = $event['endTime'];
    $eventdate = $event['date'];
    $combinedstart = date('Y-m-d H:i:s', strtotime("$eventdate $start"));
    $combinedend = date('Y-m-d H:i:s', strtotime("$eventdate $end"));

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
                                cost: '<?php echo $event['cost']; ?>',
                            },
<?php endforeach;

?>
                    ]
                    ,
                        eventRender: function(event, element) {
                            element.bind('click', function() {
                              $('#ModalView #id').val(event.id);
                              $('#ModalView #category').val(event.title);
                              $('#ModalView #date').val(event.date);
                              $('#ModalView #startTime').val(event.startTime);
                             $('#ModalView #endTime').val(event.endTime);
                              $('#ModalView #description').val(event.description);
                              $('#ModalView #cost').val(event.cost);
                              $('#ModalView').modal('show');
                              });
                          }
                });


            });

        </script>

        <!-- Profile update script -->
    </body>
</html>