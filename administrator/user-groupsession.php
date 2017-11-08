<?php
session_start();
require_once('../database/dbconfig.php');

$sql = "SELECT * FROM groupsession where status='Approved'";

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
        <style>
      
            #calendar {
                    max-width: 800px;
            }
            .col-centered{
                    float: none;
                    margin: 0 auto;
            }
        </style>
        
    </head>
    <body>
        <div class="container-fluid" style="padding-top: 80px;">
            <?php include_once 'nav-bar.php'; ?>
            <h1 class="text-center"><span class="glyphicon glyphicon-list-alt icon-space"></span> GROUP SESSION</h1>
          <div class="col-md-8 col-md-offset-2 padding-0" id="usermanagement">
           <div id="calendar" class="col-centered"></div>
               
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
                    editable: true,
                    eventLimit: true, // allow "more" link when too many events
                    selectable: true,
                    selectHelper: true,
                    
            events: [
                
            <?php  foreach ($events as $event):

                $TypeofTrainingID = $event['TypeofTrainingID'];
                $start = $event['startTime'];
                $end = $event['endTime'];
                $status = $event['status'];
                $eventdate = $event['date'];
                $trainerEmail = $event['trainerEmail'];
                $groupCapacity = $event['groupCapacity'];
                $venue = $event['venue'];
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
                        venue: '<?php echo $event['venue']; ?>',
                        TypeofTrainingID: '<?php echo $event['TypeofTrainingID']; ?>',
                        date: '<?php echo $event['date']; ?>',
                        startTime: '<?php echo $event['startTime']; ?>',
                        endTime: '<?php echo $event['endTime']; ?>',
                        start: '<?php echo $combinedstart ?>',
                        end: '<?php echo $combinedend; ?>',
                        title: '<?php echo $event['description']; ?>',
                        groupCapacity: '<?php echo $event['groupCapacity']; ?>',
                        status: '<?php echo $event['status']; ?>',
                        color: '<?php echo $event['color']; ?>',

                    },
                <?php endforeach; ?>
                    
                    
                    ]
                    
                    
                    
                    
                    
                    });
            });

        </script>

            </div>
        </div>
        
    </body>
</html>