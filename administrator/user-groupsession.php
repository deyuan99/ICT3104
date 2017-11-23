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
        <?php include 'include.php'; ?>
        <?php include 'loadApprovalInfo.php'; ?>
    
        <!-- FullCalendar -->
        <link href="../fullcalendar-3.5.1/fullcalendar.css" rel="stylesheet" />
        <link href="../assets/css/calendar.css" rel="stylesheet" type="text/css"/>
        <style>
            #toptitle{
                padding-top: 30px;
            }
            
            #calendar {
                max-width: 800px;
                
            }
            h2{
                color: #000;
            }
            .col-centered{
                float: none;
                margin: 0 auto;
            }*
            /* calendar hover */
            .qtip-content-margin {
                margin-left:0;
                margin-right:0;
                margin-bottom:8px;
            }
        </style>

    </head>
    <body>
        <?php include 'nav-bar.php'; ?>
        <div class="container-fluid" style="padding-top: 80px;">
            <h2 class="text-center" id="toptitle" ><span class="glyphicon glyphicon-list-alt icon-space"></span> GROUP SESSION </h2>

            <!--<h1 class="text-center"><span class="glyphicon glyphicon-list-alt icon-space"></span> GROUP SESSION</h1>-->
            <div class="col-md-8 col-md-offset-2 padding-0" id="usermanagement">

                <div id="calendar" class="col-centered"></div>

                <!--view groupTraining-->
                <div class="modal fade" id="ModalView" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="padding-top: 70px;">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <form class="form-horizontal" method="POST" action="doDeleteGroupevent.php">

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

                                    <input type="hidden" id="status" name="status" value="Deleted"/>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button type="submit" name="delete" id="delete" class="btn btn-danger">Delete</button>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                
                <br><br>
                 <h2 class="text-center" id="toptitle"><span class="glyphicon glyphicon-list-alt icon-space"></span> GROUP SESSION HISTORY/SUMMARY </h2>
                <div class="tab-pane add--15-margin" id="approvel_reject_tab">
                        <div class="panel panel-default margin-l0-r0">
                            <div class="panel-heading">
                                <div class="panel-title">Approved Group-Training</div>
                            </div>
                            <div class="table-responsive my-table-style">
                                <table id="esa-table" class="table table-striped table-bordered" cellspacing="0" width="100%" >
                                    <thead>
                                        <tr>
                                            <th class="col-md-2">Email Address</th>
                                            <th class="col-md-1">Venue</th>
                                            <th class="col-md-1">Type of Training</th>
                                            <th class="col-md-2">Room Type</th>
                                            <th class="col-md-1">Group Capacity</th>
                                            <th class="col-md-1">Date</th>
                                            <th class="col-md-1">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php getApprovedGrouptraining(); ?>
                                    </tbody>
                                </table>
                            </div><br><br>

                            <div class="panel-heading">
                                <div class="panel-title">Rejected Group-Training</div>
                            </div>
                            <div class="table-responsive my-table-style">
                                <table id="esa-table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th class="col-md-2">Email Address</th>
                                            <th class="col-md-1">Venue</th>
                                            <th class="col-md-1">Type of Training</th>
                                            <th class="col-md-2">Room Type</th>
                                            <th class="col-md-1">Group Capacity</th>
                                            <th class="col-md-1">Date</th>
                                            <th class="col-md-1">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php getRejectedGrouptraining(); ?>
                                    </tbody>
                                </table>
                            </div><br><br>

                            <div class="panel-heading">
                                <div class="panel-title">Deleted Group-Training</div>
                            </div>
                            <div class="table-responsive my-table-style">
                                <table id="esa-table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th class="col-md-2">Email Address</th>
                                            <th class="col-md-1">Venue</th>
                                            <th class="col-md-1">Type of Training</th>
                                            <th class="col-md-2">Room Type</th>
                                            <th class="col-md-1">Group Capacity</th>
                                            <th class="col-md-1">Date</th>
                                            <th class="col-md-1">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php getDeletedGrouptraining(); ?>
                                    </tbody>
                                </table>
                            </div>

                        </div>
            </div>
         
            </div>
            
        </div>
        <!-- jQuery Version 1.11.1 -->
        <script src="../fullcalendar-3.5.1/lib/jquery.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="../bootstrap-3.3.5-dist/js/bootstrap.min.js"></script>

        <!-- FullCalendar -->
        <script src="../fullcalendar-3.5.1/lib/moment.min.js"></script>
        <script src="../fullcalendar-3.5.1/fullcalendar.min.js"></script>

        <!--qtip must be after funllcalendarJS-->
        <link type="text/css" rel="stylesheet" href="../jquery_qtip/jquery.qtip.css" />
        <script src="../jquery_qtip/jquery.qtip.js"></script>
  

                <!--Calendar script-->
                <script>
                    var today = new Date();
                    var datetoday = today.getFullYear() + '-' + (today.getMonth() + 1) + '-' + today.getDate();
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
                            selectConstraint: {
                                start: $.fullCalendar.moment().subtract(1, 'days'),
                                end: $.fullCalendar.moment().startOf('month').add(1, 'month')
                            },
                            events: [
<?php
$todaydateis = date("Y-m-d");

foreach ($events as $event):
    $typeofTrainingID = $event['trainingName'];
    $roomTypeID = $event['name'];
    $status = $event['status'];
    $trainerEmail = $event['trainerEmail'];
    $groupCapacity = $event['groupCapacity'];
    $description = $event ['description'];
    $eventdate = $event['date'];
    $start = $event['startTime'];
    $end = $event['endTime'];
    $combinedstart = date('Y-m-d H:i:s', strtotime("$eventdate $start"));
    $combinedend = date('Y-m-d H:i:s', strtotime("$eventdate $end"));
    if (strtotime($todaydateis) > strtotime($eventdate)) {
        $color = '#DC143C';
    } else {
        $color = '#3D9970';
    }
    ?>
                                    {
                                        id: '<?php echo $event['id']; ?>',
                                        trainer: '<?php echo $event['trainerEmail']; ?>',
                                        title: '<?php echo $event['trainingName']; ?>',
                                        date: '<?php echo $event['date']; ?>',
                                        startTime: '<?php echo $event['startTime']; ?>',
                                        endTime: '<?php echo $event['endTime']; ?>',
                                        start: '<?php echo $combinedstart ?>',
                                        end: '<?php echo $combinedend; ?>',
                                        description: '<?php echo $event['description']; ?>',
                                        venue: '<?php echo $event['location']; ?>',
                                        type: '<?php echo $event['trainingName']; ?>',
                                        cost: '<?php echo '$ ' . $event['cost']; ?>',
                                        color: '<?php echo $color; ?>',
                                        capacity: '<?php echo $event['groupCapacity']; ?>',
                                        room: '<?php echo $event['name']; ?>',

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
                                    // compare date for javascript
                                    if (new Date(datetoday).getTime() > new Date(event.date).getTime()) {
                                        $('#delete').hide();
                                    } else {
                                        $('#delete').show();
                                    }
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
                                content += '<div class="row qtip-content-margin"><b>Description:</b> ' + event.description + '</div>';
                                content += '<div class="row qtip-content-margin"><b>Date:</b> ' + event.date + '</div>';
                                content += '<div class="row qtip-content-margin"><b>Training Time:</b> ' + event.startTime + ' to ' + event.endTime + '</div>';
                                content += '<div class="row qtip-content-margin"><b>Venue:</b> ' + event.room + ' room at ' + event.venue + '</div>';


                                tooltip.set({
                                    'content.text': content
                                }).show(jsEvent);

                            }

                        });
                    });

                </script>

    </body>
</html>