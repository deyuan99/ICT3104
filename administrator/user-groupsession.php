<?php
session_start();
require_once('../database/dbconfig.php');

//$sql = "SELECT * FROM groupsession where status='Approved'";
$sql = "SELECT id, trainerEmail, date, startTime, endTime, description, groupCapacity, status, (SELECT name FROM roomtype WHERE id=roomTypeID) AS name, (SELECT trainingName FROM typeoftraining where id=typeofTrainingID) AS trainingName FROM groupsession WHERE status = 'Approved'";

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
                            <label for="title" class="col-sm-2 control-label">Title</label>
                            <div class="col-sm-10">
                                <input type="text" name="title" class="form-control" id="title" value="<?php echo $event['trainingName']; ?>" readonly>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="trainerEmail" class="col-sm-2 control-label">By Who</label>
                            <div class="col-sm-10">
                                <input type="text" name="trainerEmail" class="form-control" id="trainerEmail" value="<?php echo $event['trainerEmail']; ?>" readonly>
                            </div>
                        </div> 
                        
                        <div class="form-group">
                            <label for="groupCapacity" class="col-sm-2 control-label">Group Capacity</label>
                            <div class="col-sm-10">
                                <input type="text" name="groupCapacity" class="form-control" id="groupCapacity" value="<?php echo $event['groupCapacity']; ?>" readonly>
                            </div>
                        </div>
                            
                        <div class="form-group">
                            <label for="date" class="col-sm-2 control-label">Date</label>
                            <div class="col-sm-10">
                                <input type="text" name="date" class="form-control" id="date" value="<?php echo $event['date']; ?>" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="startTime" class="col-sm-2 control-label">Start Time</label>
                            <div class="col-sm-10">
                                <input type="text" name="startTime" class="form-control" id="startTime" value="<?php echo $event['startTime']; ?>" readonly>
                            </div>
                        </div>
                            
                        <div class="form-group">
                            <label for="endTime" class="col-sm-2 control-label">End Time</label>
                            <div class="col-sm-10">
                                <input type="text" name="endTime" class="form-control" id="endTime" value="<?php echo $event['endTime']; ?>" readonly>
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
                
            <?php  foreach ($events as $event):

                $typeofTrainingID = $event['trainingName'];
                $roomTypeID = $event['name'];
                $start = $event['startTime'];
                $end = $event['endTime'];
                $status = $event['status'];
                $eventdate = $event['date'];
                $trainerEmail = $event['trainerEmail'];
                $groupCapacity = $event['groupCapacity'];
                $description = $event ['description'];
                $combinedstart = date('Y-m-d H:i:s', strtotime("$eventdate $start"));
                $combinedend = date('Y-m-d H:i:s', strtotime("$eventdate $end"));

                if($status == 'Approved'){
                    $color = '#3D9970';
                } elseif($status== 'Rejected') {
                    $color = '#FF4136';
                }elseif($status== 'pending'){
                    $color = '#AAAAAA';
                }
                $event['color']=$color;
                ?>
                    {
                        id: '<?php echo $event['id']; ?>',
                        title: '<?php echo $event['trainingName']; ?>',
                        roomTypeID: '<?php echo $event['name']; ?>',
                        date: '<?php echo $event['date']; ?>',
                        startTime: '<?php echo $event['startTime']; ?>',
                        endTime: '<?php echo $event['endTime']; ?>',
                        start: '<?php echo $combinedstart ?>',
                        end: '<?php echo $combinedend; ?>',
                        description: '<?php echo $event['description']; ?>',
                        groupCapacity: '<?php echo $event['groupCapacity']; ?>',
                        status: '<?php echo $event['status']; ?>',
                        color: '<?php echo $event['color']; ?>',
                        trainerEmail: '<?php echo $event['trainerEmail']; ?>',

                    },
                <?php endforeach; ?>
                    
                    
                    ],
                    eventRender: function(event, element) {
                            element.bind('click', function() {
                              $('#ModalView #id').val(event.id);
                              $('#ModalView #title').val(event.title);
                              $('#ModalView #trainerEmail').val(event.trainerEmail);
                              $('#ModalView #groupCapacity').val(event.groupCapacity);
                              $('#ModalView #date').val(event.date);
                              $('#ModalView #startTime').val(event.startTime);
                              $('#ModalView #endTime').val(event.endTime);
                              //$('#ModalView #start').val(moment(start).format('YYYY-MM-DD HH:mm:ss'));
                              //$('#Modalview #end').val(moment(end).format('YYYY-MM-DD HH:mm:ss'));
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