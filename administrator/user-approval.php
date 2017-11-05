<?php
session_start();
?>
<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>STPS</title>
        <!-- CSS import -->
        <?php include_once 'include.php'; ?>
        <?php include_once 'loadApprovalInfo.php'; ?>
        <link rel="stylesheet" type="text/css" href="css/user-management.css" />
        <script>
            function setApproveInfo(email)
            {
                document.getElementById("approve_userid").value = "";
                document.getElementById("approve_userid").value = email;
                document.getElementById("approveMsg").innerHTML = "Are you sure you want to Approve " + "<strong>" + email +"</strong>" + "  ?" ;
            }
            function setRejectInfo(email)
            {
                document.getElementById("reject_userid").value = "";
                document.getElementById("reject_userid").value = email;
                document.getElementById("rejectMsg").innerHTML = "Are you sure you want to Reject " + "<strong>" + email +"</strong>" + "  ?" ;
            }
        </script>
    </head>
    <body>
        <div class="container-fluid">
            <?php include_once 'nav-bar.php'; ?>
            <h1 class="text-center"><span class="glyphicon glyphicon-ok-sign icon-space"></span> APPROVAL REQUEST</h1>
            <div class="col-md-8 col-md-offset-2 padding-0" id="usermanagement">
                <div class="row" style="margin-bottom: 10px;">
                    <ul class="nav nav-pills col-md-10 padding-l0-r0">
                        <li class="active data-tabs col-md-3 col-sm-6 col-xs-12"><a href="#trainee_tab" data-toggle="pill"><span class="glyphicon glyphicon-user icon-space"></span>New Users</a></li>
                        <li class="data-tabs col-md-3 col-xs-12 col-sm-6"><a href="#trainer_tab" data-toggle="pill"><span class="glyphicon glyphicon-user icon-space"></span>Group Trainings</a></li>
                    </ul>
                </div>
                <div class="tab-content">
                    <div class="tab-pane active add--15-margin" id="trainee_tab">
                        <div class="panel panel-default margin-l0-r0">
                            <div class="panel-heading">
                                <div class="panel-title">NEW USERS</div>
                            </div>
                            <div class="table-responsive my-table-style">
                                <table id="esa-table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th class="col-md-2">Email Address</th>
                                            <th class="col-md-2">First Name</th>
                                            <th class="col-md-2">Last Name</th>
                                            <th class="col-md-2">Mobile Number</th>
                                            <th class="col-md-1">Role</th>
                                            <th class="col-md-3">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php getApprovalUsers(); ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane add--15-margin" id="trainer_tab">
                        <div class="panel panel-default margin-l0-r0">
                            <div class="panel-heading">
                                <div class="panel-title">GROUP TRAININGS</div>
                            </div>
                            <div class="table-responsive my-table-style">
                                <table id="esa-table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th class="col-md-2">Email Address</th>
                                            <th class="col-md-1">Venue</th>
                                            <th class="col-md-1">Group Capacity</th>
                                            <th class="col-md-2">Date</th>
                                            <th class="col-md-1">Start Time</th>
                                            <th class="col-md-1">End Time</th>
                                            <th class="col-md-1">Status</th>
                                            <th class="col-md-3">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php getApprovalGrouptraining(); ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="modal fade" id="approveUserModal" tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title" id="remove-title">APPROVE USER</h4>
                    </div>
                    <div class="modal-body">
                        <div id="approveMsg"></div>
                        <div class="widget-body" id="manualForm">
                            <form name="form" id="form" class="form-horizontal" role="form" action="doApprove.php" enctype="multipart/form-data" method="POST">
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
        <div class="modal fade" id="rejectUserModal" tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title" id="remove-title">REJECT USER</h4>
                    </div>
                    <div class="modal-body">
                        <div id="rejectMsg"></div>
                        <div class="widget-body" id="manualForm">
                            <form name="form" id="form" class="form-horizontal" role="form" action="doReject.php" enctype="multipart/form-data" method="POST">
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
    </body>
</html>