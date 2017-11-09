<!--Connection for database -->
<?php
session_start();
require_once('database/dbconfig.php');

$email = $_SESSION['email'];
$sql = "SELECT * FROM groupsession g, roomtype r, typeoftraining t, venue v where g.status = 'approved' and g.roomtypeid = r.id and g.typeoftrainingid = t.id and v.id = r.venueid";
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
        include "trainer_header.php";
        ?>
        <!-- Trainer Calendar -->
        <section id="two" class="wrapper style2 special">
            <div class="container">
                <header class="major">
                    <h2>Group Training Schedule</h2>
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
                    <form class="form-horizontal" method="POST" action="addCalendarEventTrainee.php">
                            
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">View Event</h4>
                        </div>
                        <div class="modal-body">

                            <div class="form-group">
                                <label for="category" class="col-sm-2 control-label">Trainer</label>
                                <div class="col-sm-10">
                                    <input type="text" name="trainer" class="form-control" id="trainer" value="<?php echo $event['trainerEmail']; ?>" readonly>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="trainingname" class="col-sm-2 control-label">Type</label>
                                <div class="col-sm-10">
                                    <input type="text" name="trainingname" class="form-control" id="trainingname" value="<?php echo $event['trainingName']; ?>" readonly>
                                </div>
                            </div> 
                            
                            <div class="form-group">
                                <label for="cost" class="col-sm-2 control-label">Cost</label>
                                <div class="col-sm-10">
                                    <input type="text" name="cost" class="form-control" id="cost" value="<?php echo $event['cost']; ?>" readonly>
                                </div>
                            </div> 
                            
                            <div class="form-group">
                                <label for="description" class="col-sm-2 control-label">Description</label>
                                <div class="col-sm-10">
                                    <input type="text" name="description" class="form-control" id="description" value="<?php echo $event['description']; ?>" readonly>
                                </div>
                            </div> 

                            <div class="form-group">
                                <label for="date" class="col-sm-2 control-label">Date</label>
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
                                <label for="venue" class="col-sm-2 control-label">Venue</label>
                                <div class="col-sm-10">
                                    <input type="text" name="venue" class="form-control" id="venue" value="<?php echo $event['location']; ?>" readonly>
                                </div>
                            </div> 
                            
                            <div class="form-group">
                                <label for="capacity" class="col-sm-2 control-label">Capacity</label>
                                <div class="col-sm-10">
                                    <input type="text" name="capacity" class="form-control" id="capacity" value="<?php echo $event['groupCapacity']; ?>" readonly>
                                </div>
                            </div> 
                            
                            <input type="hidden" id="eid" name="eid" value="23"/>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                
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
                    events: [
<?php
foreach ($events as $event):

    ?>
                            {
                                id: '<?php echo $event['id']; ?>',
                                trainer: '<?php echo $event['trainerEmail']; ?>',
                                title: '<?php echo $event['trainingName']; ?>',
                                date: '<?php echo $event['date']; ?>',
                                startTime: '<?php echo $event['startTime']; ?>',
                                endTime: '<?php echo $event['endTime']; ?>',
                                description: '<?php echo $event['description']; ?>',
                                venue: '<?php echo $event['location']; ?>',
                                type: '<?php echo $event['trainingName']; ?>',
                                cost: '<?php echo '$ ' . $event['cost']; ?>',
                                color: '<?php echo '#3D9970'; ?>',
                                capacity: '<?php echo $event['groupCapacity']; ?>'
                            },
<?php endforeach; ?>
                    ]
                    ,
                    eventRender: function (event, element) {
                        element.bind('click', function () {
                            $('#eid').val(event.id);
                            $('#ModalView #trainer').val(event.trainer);
                            $('#ModalView #date').val(event.date);
                            $('#ModalView #startTime').val(event.startTime);
                            $('#ModalView #endTime').val(event.endTime);
                            $('#ModalView #description').val(event.description);
                            $('#ModalView #venue').val(event.venue);
                            $('#ModalView #trainingname').val(event.type);
                            $('#ModalView #cost').val(event.cost);
                            $('#ModalView #capacity').val(event.capacity);
                            $('#ModalView').modal('show');
                        });
                    }
                });


            });

        </script>



    </body>
</html>