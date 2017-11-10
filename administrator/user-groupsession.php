<?php
session_start();
require_once('../database/dbconfig.php');

$sql = "SELECT g.id, g.roomTypeID, g.typeofTrainingID, g.startTime, g.endTime, g.date, g.description, g.trainerEmail, g.groupCapacity, g.status, r.name, r.capacity, t.trainingName, t.cost, v.location "
        . "FROM groupsession g, roomtype r, typeoftraining t, venue v where g.status = 'approved' and g.roomtypeid = r.id and g.typeoftrainingid = t.id and v.id = r.venueid";
$req = $conn->prepare($sql);
$req->execute();

$events = $req->fetchAll();
?>
<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>STPS</title>
        <!-- CSS import -->
        <?php include_once 'include.php'; ?>
        <link rel="stylesheet" type="text/css" href="css/user-management.css" />
        <!-- Bootstrap Core CSS -->
        <link href="../bootstrap-3.3.5-dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- FullCalendar -->
        <link href='../fullcalendar-3.5.1/fullcalendar.css' rel='stylesheet' />
        <link href="../assets/css/calendar.css" rel="stylesheet" type="text/css"/>
        <!-- Custom CSS -->
        <!--<style>
      
            #calendar {
                    max-width: 800px;
            }
            .col-centered{
                    float: none;
                    margin: 0 auto;
            }
        </style>-->

    </head>
    <body>
        <div class="container-fluid" style="padding-top: 80px;">
            <?php include_once 'nav-bar.php'; ?>
            <h1 class="text-center"><span class="glyphicon glyphicon-list-alt icon-space"></span> GROUP SESSION</h1>
            <div class="col-md-8 col-md-offset-2 padding-0" id="usermanagement">
                <div id="calendar" class="col-centered"></div>

                <!--view groupTraining-->
                <div class="modal fade" id="ModalView" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="padding-top: 70px;">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <form class="form-horizontal" method="POST" action="#">

                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel">View Approved Group Training</h4>
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

                <!-- jQuery Version 1.11.1 -->
                <script src="../fullcalendar-3.5.1/lib/jquery.js"></script>

                <!-- Bootstrap Core JavaScript -->
                <script src="../bootstrap-3.3.5-dist/js/bootstrap.min.js"></script>

                <!-- FullCalendar -->
                <script src='../fullcalendar-3.5.1/lib/moment.min.js'></script>
                <script src='../fullcalendar-3.5.1/fullcalendar.min.js'></script>

                <!--Calendar script-->
                <script>
                    $(document).ready(function () {

                        $('#calendar').fullCalendar({
                            header: {
                                left: 'title',
                                center: 'prev,next today',
                                right: 'month,agendaWeek,agendaDay'
                            },

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


                            ],
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

            </div>
        </div>

    </body>
</html>