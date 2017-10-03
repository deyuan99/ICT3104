
<!--Connection for database -->

<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


require_once('database/dbconfig.php');

$sql = "SELECT id, title, start, end, color FROM events ";

$req = $conn->prepare($sql);
$req->execute();

$events = $req->fetchAll();
?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>STPS</title>
        
        <link rel="stylesheet" href="assets/css/main.css" />
        <!-- Bootstrap Core CSS -->
        <link href="bootstrap-3.3.5-dist/css/bootstrap.min.css" rel="stylesheet">
	
	<!-- FullCalendar -->
        <link href='fullcalendar-3.5.1/fullcalendar.css' rel='stylesheet' />
        
        <!-- Custom CSS -->
        <style>
        body {
            padding-top: 100px;
            /* Required padding for .navbar-fixed-top. Remove if using .navbar-static-top. Change if height of navigation changes. */
        }
        #calendar {
                max-width: 800px;
        }
        .col-centered{
                float: none;
                margin: 0 auto;
        }
        
        #ModalAdd{
            padding-top: 180px;
        }
        
        </style>
        
        
    </head>
    
    <body>
        
     <!-- Header -->
        <?php
        include "trainee_header.php";
        ?>
   
    <!-- Page Content -->
    <div class="container">
        
        <div class="row">
            <div class="col-lg-12 text-center">
                <div id="calendar" class="col-centered">
                </div>
            </div>
			
        </div>
        <!-- end row -->
        
        
        <!-- Modal -->
       <div class="modal fade" id="ModalAdd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form class="form-horizontal" method="POST" action="addCalendarEvent.php">

                  <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Add Event</h4>
                  </div>
                  <div class="modal-body">

                          <div class="form-group">
                                <label for="title" class="col-sm-2 control-label">Title</label>
                                <div class="col-sm-10">
                                  <input type="text" name="title" class="form-control" id="title" placeholder="Title">
                                </div>
                          </div>
                      
                          <div class="form-group">
                                <label for="color" class="col-sm-2 control-label">Color</label>
                                <div class="col-sm-10">
                                  <select name="color" class="form-control" id="color">
                                    <option value="">Choose</option>
                                    <option style="color:#0071c5;" value="#0071c5">&#9724; Dark blue</option>
                                    <option style="color:#40E0D0;" value="#40E0D0">&#9724; Turquoise</option>
                                    <option style="color:#008000;" value="#008000">&#9724; Green</option>						  
                                    <option style="color:#FFD700;" value="#FFD700">&#9724; Yellow</option>
                                    <option style="color:#FF8C00;" value="#FF8C00">&#9724; Orange</option>
                                    <option style="color:#FF0000;" value="#FF0000">&#9724; Red</option>
                                    <option style="color:#000;" value="#000">&#9724; Black</option>

                                  </select>
                                </div>
                          </div>
                      
                          <div class="form-group">
                                <label for="start" class="col-sm-2 control-label">Start date</label>
                                <div class="col-sm-10">
                                  <input type="text" name="start" class="form-control" id="start" readonly>
                                </div>
                          </div>
                      
                          <div class="form-group">
                                <label for="end" class="col-sm-2 control-label">End date</label>
                                <div class="col-sm-10">
                                  <input type="text" name="end" class="form-control" id="end" readonly>
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
        <!--end of add modal-->
        
        
    </div>
    <!--end of page container-->
    
    <!-- jQuery Version 1.11.1 -->
    <script src="fullcalendar-3.5.1/lib/jquery.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="bootstrap-3.3.5-dist/js/bootstrap.min.js"></script>

	<!-- FullCalendar -->
        <script src='fullcalendar-3.5.1/lib/moment.min.js'></script>
        <script src='fullcalendar-3.5.1/fullcalendar.min.js'></script>
        
    <!--start of script-->
    	<script>

	$(document).ready(function() {
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
			select: function(start, end) {
				
				$('#ModalAdd #start').val(moment(start).format('YYYY-MM-DD HH:mm:ss'));
				$('#ModalAdd #end').val(moment(end).format('YYYY-MM-DD HH:mm:ss'));
				$('#ModalAdd').modal('show');
			},
			events: [
			<?php foreach($events as $event): 
			
				$start = explode(" ", $event['start']);
				$end = explode(" ", $event['end']);
				if($start[1] == '00:00:00'){
					$start = $start[0];
				}else{
					$start = $event['start'];
				}
				if($end[1] == '00:00:00'){
					$end = $end[0];
				}else{
					$end = $event['end'];
				}
			?>
				{
					id: '<?php echo $event['id']; ?>',
					title: '<?php echo $event['title']; ?>',
					start: '<?php echo $start; ?>',
					end: '<?php echo $end; ?>',
					color: '<?php echo $event['color']; ?>',
				},
			<?php endforeach; ?>
			]
		});
		
		
	});

</script>
    </body>
</html>
