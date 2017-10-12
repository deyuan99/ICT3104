<!--Connection for database -->
<?php
session_start();
require_once('database/dbconfig.php');

$sql = "SELECT id, title, start, end, color FROM events ";

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
                                <label for="title" class="col-sm-2 control-label">Title</label>
                                <div class="col-sm-10">
                                    <input type="text" name="title" class="form-control" id="title" value="<?php echo $event['title']; ?>" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="color" class="col-sm-2 control-label">Color</label>
                                <div class="col-sm-10">
                                    <input type="text" name="color" class="form-control" id="color" value="<?php echo $event['color']; ?>" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="start" class="col-sm-2 control-label">Start date</label>
                                <div class="col-sm-10">
                                    <input type="text" name="start" class="form-control" id="start" value="<?php echo $event['start']; ?>" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="end" class="col-sm-2 control-label">End date</label>
                                <div class="col-sm-10">
                                    <input type="text" name="end" class="form-control" id="end" value="<?php echo $event['end']; ?>" readonly>
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
                    select: function (start, end) {

                        $('#ModalAdd #start').val(moment(start).format('YYYY-MM-DD HH:mm:ss'));
                        $('#ModalAdd #end').val(moment(end).format('YYYY-MM-DD HH:mm:ss'));
                        $('#ModalAdd').modal('show');
                    },
                    events: [
<?php
foreach ($events as $event):

    $start = explode(" ", $event['start']);
    $end = explode(" ", $event['end']);
    if ($start[1] == '00:00:00') {
        $start = $start[0];
    } else {
        $start = $event['start'];
    }
    if ($end[1] == '00:00:00') {
        $end = $end[0];
    } else {
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
                    ,
                    eventRender: function (event, element, start, end) {
                        element.bind('click', function () {
                            $('#ModalView #id').val(event.id);
                            $('#ModalView #title').val(event.title);
                            $('#ModalView #color').val(event.color);
                            $('#ModalView #start').val(event.start);
                            $('#ModalView #end').val(event.end);
                            //$('#ModalView #start').val(moment(start).format('YYYY-MM-DD HH:mm:ss'));
                            //$('#Modalview #end').val(moment(end).format('YYYY-MM-DD HH:mm:ss'));
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