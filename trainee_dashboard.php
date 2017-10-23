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
if ($Srole == "trainee"){
    $sql = "SELECT * FROM personalsession where traineeEmail= '$Semail'";
}else{
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

        <!-- profile image -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
        <script src="dist_files/jquery.imgareaselect.js" type="text/javascript"></script>
        <script src="dist_files/jquery.form.js"></script>
        <link rel="stylesheet" href="dist_files/imgareaselect.css">
        <script src="functions.js"></script>

        <!-- edit test -->
        <style>
            a { text-decoration: none; color: #39569d; }
            a:hover { text-decoration: underline; }

            //#core { display: block; max-width: 460px; font-family: 'lucida grande', tahoma, verdana, arial, sans-serif; margin-left: 30%; }

            //.profileinfo { background: #f2f2f2; width: 100%; padding: 4px 10px; border-left: 1px solid #b3b3b3; border-right: 1px solid #b3b3b3; border-bottom: 1px solid #b3b3b3; }
            .profileinfo h3 { position: relative; left: -250px; }

            .gear { position: relative; display: block; margin-bottom: 25px; padding-bottom: 15px; border-bottom: 1px solid #d9d9d9; }

            .gear a.editlink { position: absolute; right: 0; top: 13px; }

            //.datainfo { margin-left: 10px; font-size: 11px; color: #333; }

            label { display: inline-block; font-weight: bold; color: #696969; font-size: 12px; width: 100px; }
        </style>

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
                    <div>
                        <img class="img-circle" id="profile_picture" height="128" data-src="default.jpg" data-holder-rendered="true" style="width: 140px; height: 140px;" src="default.jpg"/>
                        <br><br>
                        <a type="button" class="btn btn-primary" id="change-profile-pic">Change Profile Picture</a>
                    </div>
                </div>

                <!-- profile image upload modal -->
                <div id="profile_pic_modal" class="modal fade">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h3>Change Profile Picture</h3>
                            </div>
                            <div class="modal-body">
                                <form id="cropimage" method="post" enctype="multipart/form-data" action="change_pic.php">
                                    <strong>Upload Image:</strong> <br><br>
                                    <input type="file" name="profile-pic" id="profile-pic" />
                                    <input type="hidden" name="hdn-profile-id" id="hdn-profile-id" value="1" />
                                    <input type="hidden" name="hdn-x1-axis" id="hdn-x1-axis" value="" />
                                    <input type="hidden" name="hdn-y1-axis" id="hdn-y1-axis" value="" />
                                    <input type="hidden" name="hdn-x2-axis" value="" id="hdn-x2-axis" />
                                    <input type="hidden" name="hdn-y2-axis" value="" id="hdn-y2-axis" />
                                    <input type="hidden" name="hdn-thumb-width" id="hdn-thumb-width" value="" />
                                    <input type="hidden" name="hdn-thumb-height" id="hdn-thumb-height" value="" />
                                    <input type="hidden" name="action" value="" id="action" />
                                    <input type="hidden" name="image_name" value="" id="image_name" />
                                    <div id='preview-profile-pic'></div>
                                    <div id="thumbs" style="padding:5px; width:600p"></div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="button" id="save_crop" class="btn btn-primary">Crop & Save</button>
                            </div>
                        </div>
                    </div>
                </div>



                <section id="core">
                    <div class="profileinfo">
                        <div class="gear">
                            <label>Email</label>
                            <span id="pemail" class="datainfo">myaddress@googlemail.com</span>
                            <a href="#" class="editlink">Edit Info</a>
                            <a class="savebtn">Save</a>
                        </div>

                        <div class="gear">
                            <label>First Name</label>
                            <span id="fullname" class="datainfo">Johnny Appleseed</span>
                            <a href="#" class="editlink">Edit Info</a>
                            <a class="savebtn">Save</a>
                        </div>

                        <div class="gear">
                            <label>Last Name:</label>
                            <span id="birthday" class="datainfo">August 21, 1989</span>
                            <a href="#" class="editlink">Edit Info</a>
                            <a class="savebtn">Save</a>
                        </div>

                        <div class="gear">
                            <label>Phone Number:</label>
                            <span id="citytown" class="datainfo">Los Angeles, CA</span>
                            <a href="#" class="editlink">Edit Info</a>
                            <a class="savebtn">Save</a>
                        </div>

                        <div class="gear">
                            <label>Password:</label>
                            <span id="occupation" class="datainfo">Freelance Web Developer</span>
                            <a href="#" class="editlink">Edit Info</a>
                            <a class="savebtn">Save</a>
                        </div>
                    </div>
                </section>
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

                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
                                        <option style="color:#008000;" value="Group Training">&#9724; Group Training</option>
                                        <option value="1-1 Training">&#9724; 1-1 Training</option>
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
                            <button type="submit" class="btn btn-primary">Save changes</button>
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
                    editable: true,
                    eventLimit: true, // allow "more" link when too many events
                    selectable: true,
                    selectHelper: true,
                    select: function(start){
                        $('#ModalAdd #date').val(moment(start).format('DD-MM-YYYY '));
                        $('#ModalAdd').modal('show');
                    },
                    events: [
<?php
foreach ($events as $event):

    
    $start = $event['startTime'];
    $end = $event['endTime'];
    $cat = $event['category'];
    $eventdate = $event['date'];
    $traineeEmail= $event['traineeEmail'];
    $combinedstart = date('Y-m-d H:i:s', strtotime("$eventdate $start"));
    $combinedend = date('Y-m-d H:i:s', strtotime("$eventdate $end"));
    
    if ($cat == "Personal Training"){
        $traineeEmail = "Not Applicable";
        $color = '#000';
    }else if ($traineeEmail != NULL){
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
                    eventRender: function(event, element) {
                            element.bind('click', function() {
                              $('#ModalView #id').val(event.evid);
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

        <!-- Profile update script -->
        <script>
            $(document).ready(function () {
                $(".editlink").on("click", function (e) {
                    e.preventDefault();
                    var dataset = $(this).prev(".datainfo");
                    var savebtn = $(this).next(".savebtn");
                    var theid = dataset.attr("id");
                    var newid = theid + "-form";
                    var currval = dataset.text();

                    dataset.empty();

                    $('<input type="text" name="' + newid + '" id="' + newid + '" value="' + currval + '" class="hlite">').appendTo(dataset);

                    $(this).css("display", "none");
                    savebtn.css("display", "block");
                });
                $(".savebtn").on("click", function (e) {
                    e.preventDefault();
                    var elink = $(this).prev(".editlink");
                    var dataset = elink.prev(".datainfo");
                    var newid = dataset.attr("id");

                    var cinput = "#" + newid + "-form";
                    var einput = $(cinput);
                    var newval = einput.attr("value");

                    $(this).css("display", "none");
                    einput.remove();
                    dataset.html(newval);

                    elink.css("display", "block");
                });
            });
        </script>

    </body>
</html>