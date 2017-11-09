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
        <?php include_once 'loadUserInfo.php'; ?>
        <link rel="stylesheet" type="text/css" href="css/user-management.css" />
        <script>
            function setDeactivateInfo(email)
            {
                document.getElementById("deactivate_userid").value = "";
                document.getElementById("deactivate_userid").value = email;
                document.getElementById("deactivateMsg").innerHTML = "Are you sure you want to Deactivate " + "<strong>" + email +"</strong>" + "  ?" ;
            }
            function setReactivateInfo(email)
            {
                document.getElementById("reactivate_userid").value = "";
                document.getElementById("reactivate_userid").value = email;
                document.getElementById("reactivateMsg").innerHTML = "Are you sure you want to Reactivate " + "<strong>" + email +"</strong>" + "  ?" ;
            }
            function setEditInfo(email, firstName, lastName, address, mobile)
            {
                document.getElementById("email").innerHTML = email;
                document.getElementById("firstName").placeholder = firstName;
                document.getElementById("lastName").placeholder = lastName;
                document.getElementById("address").placeholder = address;
                document.getElementById("mobile").placeholder = mobile;
                document.getElementById("edit_email").value = "";
                document.getElementById("edit_email").value = email;
                document.getElementById("edit_firstName").value = "";
                document.getElementById("edit_firstName").value = firstName;
                document.getElementById("edit_lastName").value = "";
                document.getElementById("edit_lastName").value = lastName;
                document.getElementById("edit_address").value = "";
                document.getElementById("edit_address").value = address;
                document.getElementById("edit_mobile").value = "";
                document.getElementById("edit_mobile").value = mobile;
            }
        </script>
    </head>
    <body>
        <div class="container-fluid">
            <?php include_once 'nav-bar.php'; ?>
            <h1 class="text-center"><span class="glyphicon glyphicon-user icon-space"></span> USER MANAGEMENT</h1>
            <div class="col-md-8 col-md-offset-2 padding-0" id="usermanagement">
                <div class="row" style="margin-bottom: 10px;">
                    <ul class="nav nav-pills col-md-10 padding-l0-r0">
                        <li class="active data-tabs col-md-3 col-sm-6 col-xs-12"><a href="#trainee_tab" data-toggle="pill"><span class="glyphicon glyphicon-user icon-space"></span>Trainee</a></li>
                        <li class="data-tabs col-md-3 col-xs-12 col-sm-6"><a href="#trainer_tab" data-toggle="pill"><span class="glyphicon glyphicon-user icon-space"></span>Trainer</a></li>
                        <li class="data-tabs col-md-3 col-xs-12 col-sm-6"><a href="#deactivated_tab" data-toggle="pill"><span class="glyphicon glyphicon-user icon-space"></span>Deactivated</a></li>
                    </ul>
                </div>
                <div class="tab-content">
                    <div class="tab-pane active add--15-margin" id="trainee_tab">
                        <div class="panel panel-default margin-l0-r0">
                            <div class="panel-heading">
                                <div class="panel-title">TRAINEE</div>
                            </div>
                            <div class="table-responsive my-table-style">
                                <table id="esa-table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th class="col-md-1">Email Address</th>
                                            <th class="col-md-1">First Name</th>
                                            <th class="col-md-1">Last Name</th>
                                            <th class="col-md-1">Billing Address</th>
                                            <th class="col-md-1">Mobile</th>
                                            <th class="col-md-2">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php getTrainee(); ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane add--15-margin" id="trainer_tab">
                        <div class="panel panel-default margin-l0-r0">
                            <div class="panel-heading">
                                <div class="panel-title">TRAINER</div>
                            </div>
                            <div class="table-responsive my-table-style">
                                <table id="supervisor-table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th class="col-md-1">Email Address</th>
                                            <th class="col-md-1">First Name</th>
                                            <th class="col-md-1">Last Name</th>
                                            <th class="col-md-2">Billing Address</th>
                                            <th class="col-md-1">Mobile Number</th>
                                            <th class="col-md-2">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php getTrainer(); ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane add--15-margin" id="deactivated_tab">
                        <div class="panel panel-default panel-archive">
                            <div class="panel-heading">
                                <div class="panel-title">DEACTIVATED</div>
                            </div>
                            <div class="table-responsive my-table-style">
                                <table id="archive-table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th class="col-md-1">Email Address</th>
                                            <th class="col-md-1">First Name</th>
                                            <th class="col-md-1">Last Name</th>
                                            <th class="col-md-2">Billing Address</th>
                                            <th class="col-md-1">Mobile Number</th>
                                            <th class="col-md-2">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php getDeactivated(); ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="editUserModal" tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Close</span>
                        </button>
                        <h4>EDIT USER PARTICULARS</h4>
                    </div>
                    <div class="modal-body">
                        <form method="post" role="form" action="editUserInfo.php">
                            <input type="hidden" name="edit_email" id="edit_email" value="">
                            <div class="form-group row" style="margin-top: 20px;">
                                <label class="form-control-label col-md-offset-2 col-md-3 col-xs-offset-0 col-xs-5" for="email">Email Address:</label>
                                <div class="col-sm-5" id="email"></div> 
                            </div>
                            
                            <input type="hidden" name="edit_fName" id="edit_fName" value="">
                            <div class="form-group row">
                                <label class="form-control-label col-md-offset-2 col-md-3 col-xs-offset-0 col-xs-5 label-margin">First Name:</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="firstName" name="firstName" value="">
                                </div>
                            </div>
                            
                            <input type="hidden" name="edit_lName" id="edit_lName" value="<?php echo $lastName;?>">
                            <div class="form-group row">
                                <label class="form-control-label col-md-offset-2 col-md-3 col-xs-offset-0 col-xs-5 label-margin">Last Name:</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="lastName" name="lastName" value="">
                                </div>
                            </div>
                            
                            <input type="hidden" name="edit_address" id="edit_address" value="">
                            <div class="form-group row">
                                <label class="form-control-label col-md-offset-2 col-md-3 col-xs-offset-0 col-xs-5 label-margin">Billing Address:</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="address" name="address">
                                </div>
                            </div>
                            
                            <input type="hidden" name="edit_mobile" id="edit_mobile" value="">
                            <div class="form-group row">
                                <label class="form-control-label col-md-offset-2 col-md-3 col-xs-offset-0 col-xs-5 label-margin" for="mobile">Mobile Number:</label>
                                <div class="col-sm-5">
                                    <input type="number" class="form-control" id="mobile" name="mobile" value="">
                                </div>
                            </div>
                            <div class="form-group row" style="margin-top: 30px;">
                                <div class="row">
                                    <div class="col-sm-6 col-sm-offset-3 col-xs-8 col-xs-offset-2">
                                        <input type="submit" name="updateBtn" tabindex="4" class="form-control btn btn-primary" value="UPDATE">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">CLOSE</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="deactivateUserModal" tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title" id="remove-title">DEACTIVATE USER</h4>
                    </div>
                    <div class="modal-body">
                        <div id="deactivateMsg"></div>
                        <div class="widget-body" id="manualForm"> 
                            <form name="form" id="form" class="form-horizontal" role="form" action="doDeactivate.php" enctype="multipart/form-data" method="POST">
                                <input type="hidden" name="deactivate_userid" id="deactivate_userid" value="">
                                <div class="form-actions">
                                    <div class="row">
                                        <div class="col-sm-offset-7 col-sm-5 col-xs-offset-0 col-xs-12">
                                            <button class="btn btn-success col-sm-offset-3 col-sm-4 col-xs-offset-0 col-xs-5" type="submit" name="deactivateBtn">YES</button>
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
        <div class="modal fade" id="reactivateUserModal" tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title" id="remove-title">REACTIVATE USER</h4>
                    </div>
                    <div class="modal-body">
                        <div id="reactivateMsg"></div>
                        <div class="widget-body" id="manualForm">
                            <form name="form" id="form" class="form-horizontal" role="form" action="doReactivate.php" enctype="multipart/form-data" method="POST">
                                <input type="hidden" name="reactivate_userid" id="reactivate_userid" value="">
                                <div class="form-actions">
                                    <div class="row">
                                        <div class="col-sm-offset-7 col-sm-5 col-xs-offset-0 col-xs-12">
                                            <button class="btn btn-success col-sm-offset-3 col-sm-4 col-xs-offset-0 col-xs-5" type="submit" name="reactivateBtn">YES</button>
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