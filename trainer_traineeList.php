<!--Connection for database -->
<?php
session_start();
require_once('database/dbconfig.php');
$Semail = $_SESSION['email'];
$Sname = $_SESSION['name'];
$Srole = $_SESSION['role'];

$sql = "SELECT * FROM personalsession where trainerEmail= '$Semail'";
$sql6 = "SELECT * FROM groupsession where trainerEmail= '$Semail' and status != 'Rejected' ";

$req = $conn->prepare($sql);
$req->execute();
$events = $req->fetchAll();

$req6 = $conn->prepare($sql6);
$req6->execute();
$grpevents = $req6->fetchAll();

// For selecting all venue
$sql2 = "SELECT location FROM venue";
$req2 = $conn->prepare($sql2);
$req2->execute();
$venues = $req2->fetchAll();

// For selecting all types of training
$sql3 = "SELECT trainingName FROM typeoftraining";
$req3 = $conn->prepare($sql3);
$req3->execute();
$typeofTrainings = $req3->fetchAll();
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>STPS</title>

        <script src="assets/js/jquery.min.js" rel="stylesheet"></script>
        <script src="bootstrap-3.3.5-dist/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">

        <?php include 'scripts/loadBondApproval.php'; ?>
        
        <!-- FullCalendar -->
        <link href='fullcalendar-3.5.1/fullcalendar.css' rel='stylesheet' />
        <link href="assets/css/calendar.css" rel="stylesheet" type="text/css"/>

        <!-- trainer_dashboard CSS -->
        <link rel="stylesheet" href="assets/css/trainer_dashboard.css" />

        <!-- Editable profile -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        
        <script>
            function setApproveInfo(email)
            {
                document.getElementById("approve_userid").value = "";
                document.getElementById("approve_userid").value = email;
                document.getElementById("approveMsg").innerHTML = "Are you sure you want to Approve " + "<strong>" + email + "</strong>" + "  ?";
            }
            function setRejectInfo(email)
            {
                document.getElementById("reject_userid").value = "";
                document.getElementById("reject_userid").value = email;
                document.getElementById("rejectMsg").innerHTML = "Are you sure you want to Reject " + "<strong>" + email + "</strong>" + "  ?";
            }
            function setUnbondInfo(email, id)
            {
                document.getElementById("unbond_userid").value = "";
                document.getElementById("unbond_userid").value = email;
                document.getElementById("trainer_userid").value = "";
                document.getElementById("trainer_userid").value = id;
                document.getElementById("unbondMsg").innerHTML = "Are you sure you want to Unbond " + "<strong>" + email + "</strong>" + "  ?";
            }
        </script>
    </head>
    <body>
        <!-- Header -->
        <?php
        include "trainer_header.php";
        ?>

        <!-- One: Trainee List -->
        <section id="main" class="wrapper">
            <div class="container">
                <div class="row" style="margin-bottom: 10px;">
                    <ul class="nav nav-pills col-md-10 padding-l0-r0">
                        <li class="active data-tabs col-md-3 col-sm-6 col-xs-12"><a href="#traineelist_tab" data-toggle="pill"><span class="glyphicon glyphicon-map-marker icon-space"></span> Trainee List</a></li>
                        <li class="data-tabs col-md-3 col-xs-12 col-sm-6"><a href="#approvebond_tab" data-toggle="pill"><span class="glyphicon glyphicon-modal-window icon-space"></span> Approve Bonds</a></li>
                    </ul>
                </div>
                
                <div class="tab-content">
                    <div class="tab-pane active add--15-margin" id="traineelist_tab">
                        <div class="margin-l0-r0">
                            <div class="panel-heading">
                                <div class="panel-title">
                                    <h3>Trainee List</h3>
                                    <h5>Your 1-1 training trainees.</h5>
                                </div>
                            </div>
                            <div class="table-responsive my-table-style">
                                <table class="table table-striped table-bordered" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th class="col-md-2">Trainee's Name</th>
                                            <th class="col-md-2">Trainee's Email</th>
                                            <th class="col-md-2">Type of Training</th>
                                            <th class="col-md-4">Description</th>
                                            <th class="col-md-1">Bonded</th>
                                            <th class="col-md-1">Actions</th> 
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php include "scripts/listTrainees.php"; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    
                    <div class="tab-pane add--15-margin" id="approvebond_tab">
                        <div class="margin-l0-r0">
                            <div class="panel-heading">
                                <div class="panel-title">
                                    <h3>Approve/Reject Trainee Bonds</h3>
                                </div>
                            </div>
                            <div class="table-responsive my-table-style">
                                <table class="table table-striped table-bordered" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th class="col-md-3">Trainee's Name</th>
                                            <th class="col-md-3">Trainee's Email</th>
                                            <th class="col-md-3">Trainee's Mobile</th>
                                            <th class="col-md-3">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php getBondApprovalUsers($Semail, $conn); ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                
<!--                <div class="row">
                    <header class="major special">
                        <h3>Trainee List</h3>
                        <p>Your 1-1 training trainees.</p>
                    </header>
                    <div class="table table-striped table-wrapper">
                        <table>
                            <thead>
                                <tr>
                                    <th class="col-md-4">Trainee's Name</th>
                                    <th class="col-md-4">Trainee's Email</th>
                                    <th class="col-md-4">Type of Training</th>
                                    <th class="col-md-6">Description</th>
                                </tr>
                            </thead>
                            <?php
                            //include "scripts/listTrainees.php";
                            ?>
                            <tfoot>
                                <tr>
                                     pagination 
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>-->
            </div>
            
            <div class="modal fade" id="approveUserModal" tabindex="-1" role="dialog" style="padding-top: 70px;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title" id="remove-title">APPROVE USER</h4>
                    </div>
                    <div class="modal-body">
                        <div id="approveMsg"></div>
                        <div class="widget-body" id="manualForm">
                            <form name="form" id="form" class="form-horizontal" role="form" action="scripts/doApproveBond.php" enctype="multipart/form-data" method="POST">
                                <input type="hidden" name="approve_userid" id="approve_userid" value="">
                                <div class="form-actions">
                                    <div class="row">
                                        <div class="col-sm-offset-7 col-sm-5 col-xs-offset-0 col-xs-12">
                                            <button class="btn btn-success col-sm-offset-3 col-sm-4 col-xs-offset-0 col-xs-5" type="submit" name="approveBtn">YES</button>
                                            <button type="button" class="btn btn-danger col-sm-4 col-sm-offset-1 col-xs-5 col-xs-offset-2" data-dismiss="modal">NO</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="rejectUserModal" tabindex="-1" role="dialog" style="padding-top: 70px;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title" id="remove-title">REJECT USER</h4>
                    </div>
                    <div class="modal-body">
                        <div id="rejectMsg"></div>
                        <div class="widget-body" id="manualForm">
                            <form name="form" id="form" class="form-horizontal" role="form" action="scripts/doRejectBond.php" enctype="multipart/form-data" method="POST">
                                <input type="hidden" name="reject_userid" id="reject_userid" value="">
                                <div class="form-actions">
                                    <div class="row">
                                        <div class="col-sm-offset-7 col-sm-5 col-xs-offset-0 col-xs-12">
                                            <button class="btn btn-success col-sm-offset-3 col-sm-4 col-xs-offset-0 col-xs-5" type="submit" name="rejectBtn">YES</button>
                                            <button type="button" class="btn btn-danger col-sm-4 col-sm-offset-1 col-xs-5 col-xs-offset-2" data-dismiss="modal">NO</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
        
        <div class="modal fade" id="unbondUserModal" tabindex="-1" role="dialog" style="padding-top: 70px;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title" id="remove-title">UNBOND USER</h4>
                    </div>
                    <div class="modal-body">
                        <div id="unbondMsg"></div>
                        <div class="widget-body" id="manualForm">
                            <form name="form" id="form" class="form-horizontal" role="form" action="scripts/doUnbond.php" enctype="multipart/form-data" method="POST">
                                <input type="hidden" name="unbond_userid" id="unbond_userid" value="">
                                <input type="hidden" name="trainer_userid" id="trainer_userid" value="">
                                <div class="form-actions">
                                    <div class="row">
                                        <div class="col-sm-offset-7 col-sm-5 col-xs-offset-0 col-xs-12">
                                            <button class="btn btn-success col-sm-offset-3 col-sm-4 col-xs-offset-0 col-xs-5" type="submit" name="unbondBtn">YES</button>
                                            <button type="button" class="btn btn-danger col-sm-4 col-sm-offset-1 col-xs-5 col-xs-offset-2" data-dismiss="modal">NO</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
        </section>



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

        <!--qtip must be after funllcalendarJS-->
        <link type="text/css" rel="stylesheet" href="jquery_qtip/jquery.qtip.css" />
        <script src="jquery_qtip/jquery.qtip.js"></script>

        <!--Calendar script-->
        <script>
                    // get today date javascript
                    var today = new Date();
                    var datetoday = today.getFullYear() + '-' + (today.getMonth() + 1) + '-' + today.getDate();
                    $('#hidden_div_rm').hide();
                    $('#hidden_div_1v1grp').hide();
                    $('#hidden_div_cost').hide();
                    $('#hidden_div_size').hide();
                    // for training type
                    $(function () {
                    $('#Pcategory').change(function () {
                    if ($('#Pcategory').val() === "Personal Training") {
                    $('#hidden_div_1v1grp').hide();
                            document.getElementById("typeofTraining").required = false;
                            $('#hidden_div_size').hide();
                            document.getElementById("groupsize").required = false;
                    } else if ($('#Pcategory').val() === "1-1 Training") {
                    $('#hidden_div_1v1grp').show();
                            document.getElementById("typeofTraining").required = true;
                            $('#hidden_div_size').hide();
                            document.getElementById("groupsize").required = false;
                    } else {
                    $('#hidden_div_1v1grp').show();
                            document.getElementById("typeofTraining").required = true;
                            $('#hidden_div_size').show();
                            document.getElementById("groupsize").required = true;
                    }
                    });
                    });
                    // for venue
                    $("#venue").change(function ()
            {
            if ($('#venue').val() === "select") {
            $('#hidden_div_rm').hide();
            } else {
            $('#hidden_div_rm').show();
            }

            var venue = $(this).find(":selected").val();
                    //                alert(id);
                    $.ajax
                    ({
                    type: "POST",
                            url: 'phpCodes/getRoomType.php',
                            data: {venue: venue},
                            cache: false,
                            success: function (r)
                            {
                            //document.getElementById("roomtype").value = r;
                            var result = $.parseJSON(r);
                                    //                            alert(result);
                                    $('#roomtype').html("<option value=''>- Select Room -</option>");
                                    result.forEach(function(item) {
                                    $('#roomtype').append($("<option></option>")
                                            .attr("value", item)
                                            .text(item));
                                    });
                            }
                    });
            });
                    // for training type cost
                    $("#typeofTraining").change(function ()
            {
            if ($('#typeofTraining').val() === "select") {
            $('#hidden_div_cost').hide();
            } else {
            $('#hidden_div_cost').show();
            }

            var ttype = $(this).find(":selected").val();
                    //                alert(id);
                    $.ajax
                    ({
                    type: "POST",
                            url: 'phpCodes/getCost.php',
                            data: {ttype: ttype},
                            cache: false,
                            success: function (r2)
                            {
                            //                        alert(r2);
                            document.getElementById("tcost").value = r2;
                            }
                    });
            });
                    $(document).ready(function () {
            //var today = moment().day();
            $('#calendar').fullCalendar({
            header: {
            left: 'title',
                    center: 'prev,next today',
                    right: 'month,agendaWeek,agendaDay'
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
                    select: function (start) {
                    $('#ModalAdd #date').val(moment(start).format('DD-MM-YYYY '));
                            $('#ModalAdd').modal('show');
                    },
                    events: [
<?php
//date to set colour
$todaydateis = date("Y-m-d");

foreach ($events as $event):
    $start = $event['startTime'];
    $end = $event['endTime'];
    $cat = $event['category'];
    $eventdate = $event['date'];
    $traineeEmail = $event['traineeEmail'];

    $combinedstart = date('Y-m-d H:i:s', strtotime("$eventdate $start"));
    $combinedend = date('Y-m-d H:i:s', strtotime("$eventdate $end"));

    $roomt = $event['roomTypeID'];
    $sql4 = "SELECT roomtype.name, venue.location FROM roomtype, venue WHERE roomtype.id = '$roomt' AND roomtype.venueID = venue.id";
    $req4 = $conn->prepare($sql4);
    $req4->execute();
    $names = $req4->fetch(PDO::FETCH_ASSOC);
    $roomname = $names['name'];
    $venuename = $names['location'];

    $trainingtype = $event['typeofTrainingID'];
    $sql5 = "SELECT trainingName, cost FROM typeoftraining WHERE id = '$trainingtype'";
    $req5 = $conn->prepare($sql5);
    $req5->execute();
    $names2 = $req5->fetch(PDO::FETCH_ASSOC);
    $trainingname = $names2['trainingName'];
    $cost = "$" . $names2['cost'];

    if ($cat == "Personal Training") {
        $traineeEmail = "Not Applicable";
        $trainingname = "Not Applicable";
        $cost = "Not Applicable";
    } else if ($traineeEmail == NULL && $cat == "1-1 Training") {
        $traineeEmail = "Still available";
    }

    if ($cat == 'Personal Training') {
        $color = '#000';
    } elseif ($cat == 'Group Training') {
        $color = '#008000';
    } elseif ($cat == '1-1 Training') {
        $color = '#0071c5';
    }
    if (strtotime($todaydateis) > strtotime($eventdate)) {
        $color = '#DC143C';
    }
    $event['color'] = $color;
    ?>
                        {
                        evid: '<?php echo $event['id']; ?>',
                                title: '<?php echo $event['category']; ?>',
                                date: '<?php echo $event['date']; ?>',
                                startTime: '<?php echo $event['startTime']; ?>',
                                endTime: '<?php echo $event['endTime']; ?>',
                                start: '<?php echo $combinedstart; ?>',
                                end: '<?php echo $combinedend; ?>',
                                venue: '<?php echo $venuename; ?>',
                                room: '<?php echo $roomname; ?>',
                                type: '<?php echo $trainingname; ?>',
                                cost: '<?php echo $cost; ?>',
                                grpsize: '<?php echo "Not Applicable"; ?>',
                                description: '<?php echo $event['description']; ?>',
                                trainee: '<?php echo $traineeEmail; ?>',
                                color: '<?php echo $event['color']; ?>',
                                status: '<?php echo "Not Applicable"; ?>',
                        },
<?php endforeach;
?>
<?php
foreach ($grpevents as $grpevent):
    $start = $grpevent['startTime'];
    $end = $grpevent['endTime'];
    $eventdate = $grpevent['date'];

    $combinedstart = date('Y-m-d H:i:s', strtotime("$eventdate $start"));
    $combinedend = date('Y-m-d H:i:s', strtotime("$eventdate $end"));

    $roomt = $grpevent['roomTypeID'];
    $sql4 = "SELECT roomtype.name, venue.location FROM roomtype, venue WHERE roomtype.id = '$roomt' AND roomtype.venueID = venue.id";
    $req4 = $conn->prepare($sql4);
    $req4->execute();
    $names = $req4->fetch(PDO::FETCH_ASSOC);
    $roomname = $names['name'];
    $venuename = $names['location'];

    $trainingtype = $grpevent['typeofTrainingID'];
    $sql5 = "SELECT trainingName, cost FROM typeoftraining WHERE id = '$trainingtype'";
    $req5 = $conn->prepare($sql5);
    $req5->execute();
    $names2 = $req5->fetch(PDO::FETCH_ASSOC);
    $trainingname = $names2['trainingName'];
    $cost = "$" . $names2['cost'];

    $grpeventid = $grpevent['id'];
    $sql6 = "SELECT traineeEmail FROM groupsessionapplicant where groupSessionID = '$grpeventid'";
    $req6 = $conn->prepare($sql6);
    $req6->execute();
    $traineelist = $req6->fetchAll();
    $trainees = "";

    foreach ($traineelist as $trainee):
        $trainees = $trainees . $trainee['traineeEmail'] . ", ";
    endforeach;

    if ($trainees == "") {
        $trainees = "No Applicants Found";
    }

    $grpsize = $grpevent['groupCapacity'];
    $currentsize = count($traineelist);
    $grpsize = $currentsize . " / " . $grpsize;

    if (strtotime($todaydateis) > strtotime($eventdate)) {
        $color = '#DC143C';
    } else {
        $color = '#008000';
    }
    ?>
                        {
                        evid: '<?php echo $grpevent['id']; ?>',
                                title: '<?php echo "Group Training" ?>',
                                date: '<?php echo $grpevent['date']; ?>',
                                startTime: '<?php echo $grpevent['startTime']; ?>',
                                endTime: '<?php echo $grpevent['endTime']; ?>',
                                start: '<?php echo $combinedstart; ?>',
                                end: '<?php echo $combinedend; ?>',
                                venue: '<?php echo $venuename; ?>',
                                room: '<?php echo $roomname; ?>',
                                type: '<?php echo $trainingname; ?>',
                                cost: '<?php echo $cost; ?>',
                                grpsize: '<?php echo $grpsize; ?>',
                                description: '<?php echo $grpevent['description']; ?>',
                                trainee: '<?php echo $trainees ?>',
                                color: '<?php echo $color; ?>',
                                status: '<?php echo $grpevent['status'] ?>',
                        },
<?php endforeach; ?>

                    ],
                    eventRender: function (event, element) {
                    element.bind('click', function () {
                    $('#ModalView #evid').val(event.evid);
                            $('#ModalView #category').val(event.title);
                            $('#ModalView #status').val(event.status);
                            $('#ModalView #date').val(event.date);
                            $('#ModalView #startTime').val(event.startTime);
                            $('#ModalView #endTime').val(event.endTime);
                            $('#ModalView #venueview').val(event.venue);
                            $('#ModalView #roomview').val(event.room);
                            $('#ModalView #typeview').val(event.type);
                            $('#ModalView #costview').val(event.cost);
                            $('#ModalView #grpsizeview').val(event.grpsize);
                            $('#ModalView #description').val(event.description);
                            $('#ModalView #trainee').val(event.trainee);
                            $('#ModalView').modal('show');
                            if (new Date(datetoday).getTime() > new Date(event.date).getTime() || event.title == "Group Training"){
                    $('#save').hide();
                            $('#delete').hide();
                    } else{
                    $('#save').show();
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
                            content += '<div class="row qtip-content-margin"><b>Description: </b> &nbsp' + event.description + '</div>';
                            content += '<div class="row qtip-content-margin"><b>Date: </b> &nbsp' + event.date + '</div>';
                            content += '<div class="row qtip-content-margin"><b>Time: </b> &nbsp' + event.startTime + ' to ' + event.endTime + '</div>';
                            content += '<div class="row qtip-content-margin"><b>Venue: </b> &nbsp' + event.room + ' room at ' + event.venue + '</div>';
                            tooltip.set({
                            'content.text': content
                            }).show(jsEvent);
                    },
                    eventDrop: function (event, delta, revertFunc) {
                    edit(event);
                    },
                    eventResize: function (event, dayDelta, minuteDelta, revertFunc) {
                    edit(event);
                    }

            });
                    function edit(event) {
                    startTime = event.start.format('Y-m-d H:i:s');
                            if (event.endTime) {
                    endTime = event.end.format('Y-m-d H:i:s');
                    } else {
                    endTime = startTime;
                    }
                    id = event.evid;
                            date = event.date;
                            Event = [];
                            Event[0] = id;
                            Event[1] = startTime;
                            Event[2] = endTime;
                            Event[3] = date;
                            $.ajax({
                            url: 'editCalendarEventDate.php',
                                    type: "POST",
                                    data: {Event: Event},
                                    success: function (rep) {
                                    if (rep === 'OK') {
                                    alert('Saved');
                                    } else {
                                    alert('Could not be saved. try again.');
                                    }
                                    }
                            });
                    }
            });</script>
        <!-- Profile update -->
        <script>
                    var flag = 0;
                    $('#edit').click(function () {
            $('#form').toggleClass('view');
                    $('#edit').css('display', 'none');
                    $('#update').css('display', 'block');
                    $('input').each(function () {
            var inp = $(this);
                    if (inp.attr('readonly')) {
            inp.removeAttr('readonly');
                    $('#edit').css('display', 'none');
                    $('#update').css('display', 'block');
            }
            else {
            inp.attr('readonly', 'readonly');
            }
            });
                    flag = 0;
            });        </script>
        <script>
                    $('#update').click(function () {
            $('#form').toggleClass('view');
                    $('#edit').css('display', 'block');
                    $('#update').css('display', 'none');
                    flag = 1;
                    var fName = $('#firstName').val();
                    //document.getElementById("edit_mobile").value = mobile;
                    //alert(fName);
                    $('input').each(function () {
            var inp = $(this);
                    if (inp.attr('readonly')) {
            inp.removeAttr('readonly');
                    $('#edit').css('display', 'block');
                    $('#update').css('display', 'none');
            }
            else {
            inp.attr('readonly', 'readonly');
            }
            });
            });</script>
        <script>
                    function validateForm() {
                    //alert("fName");
                    if (flag == 1) {
                    return true;
                    } else {
                    return false;
                    }
                    //if update button return true
                    }
        </script>
    </body>
</html>
