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
        <!-- Trainer Calendar -->
        <section id="two" class="wrapper style2 special">
            <div class="container">
                <header class="major">
                    <h2>Trainer's Calendar</h2>
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
                            <input type="hidden" id="eid" name="eid" value="23"/>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <input type="submit" class="btn btn-primary" value="Add Event"/>
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

    if ($cat == "Personal Training") {
        $traineeEmail = "Not Applicable";
        $color = '#000';
    } else if ($traineeEmail != NULL) {
        $color = '#378006';
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
                            $('#ModalView #description').val(event.description);
                            $('#ModalView').modal('show');
                        });
                    }
                });


            });

        </script>



    </body>
</html>