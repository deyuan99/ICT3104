<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title></title>
        <!-- CSS import -->
        <?php include_once 'include.php'; ?>
        <link rel="stylesheet" type="text/css" href="css/user-management.css" />
    </head>
    <body>
        <div class="container-fluid">
            <?php include_once 'nav-bar.php'; ?>
            <h1 class="text-center">USER MANAGEMENT</h1>
            <div class="col-md-8 col-md-offset-2 padding-0" id="usermanagement">
                <div class="row">
                    <ul class="nav nav-pills col-md-10 padding-l0-r0">
                        <li class="active data-tabs col-md-3 col-sm-6 col-xs-12"><a href="#trainee_tab" data-toggle="pill"><span class="glyphicon glyphicon-user icon-space"></span>Trainee</a></li>
                        <li class="data-tabs col-md-3 col-xs-12 col-sm-6"><a href="#trainer_tab" data-toggle="pill"><span class="glyphicon glyphicon-user icon-space"></span>Trainer</a></li>
                        <li class="data-tabs col-md-3 col-xs-12 col-sm-6"><a href="#deactivated_tab" data-toggle="pill"><span class="glyphicon glyphicon-user icon-space"></span>Deactivated</a></li>
                    </ul>
                    <div class="col-md-2 padding-l0-r0" id="add-btn-div" style="margin-bottom: 5px;"><button class="col-xs-12 add-btn btn btn-primary" data-toggle="modal" data-target="#addUserModal" ><span class="glyphicon glyphicon-plus icon-space"></span>ADD USER</button></div>
                </div>
                <div class="tab-content">
                    <div class="tab-pane active add--15-margin" id="trainee_tab">
                        <div class="panel panel-primary margin-l0-r0">
                            <div class="panel-heading">
                                <div class="panel-title">TRAINEE</div>
                            </div>
                            <div class="table-responsive my-table-style">
                                <table id="esa-table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th class="col-md-3">Username</th>
                                            <th class="col-md-3">NRIC</th>
                                            <th class="col-md-3">Name</th>
                                            <th class="col-md-3">Action</th>
                                        </tr>
                                        <tr>
                                            <td class="col-md-3">trainee1</td>
                                            <td class="col-md-3">S1234567A</td>
                                            <td class="col-md-3">Donald Tan</td>
                                            <td class="col-md-3"><a class="btn btn-info btn-md">EDIT</a><a class="btn btn-danger btn-md">REMOVE</a></td>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane add--15-margin" id="trainer_tab">
                        <div class="panel panel-primary margin-l0-r0">
                            <div class="panel-heading">
                                <div class="panel-title">TRAINER</div>
                            </div>
                            <div class="table-responsive my-table-style">
                                <table id="supervisor-table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th class="col-md-3">Username</th>
                                            <th class="col-md-3">NRIC</th>
                                            <th class="col-md-3">Name</th>
                                            <th class="col-md-3">Action</th>
                                        </tr>
                                    </thead>
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
                                            <th class="col-md-3">Username</th>
                                            <th class="col-md-3">NRIC</th>
                                            <th class="col-md-3">Name</th>
                                            <th class="col-md-3">Action</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="addUserModal" tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Close</span>
                        </button>
                        <h3>ADD USER</h3>
                    </div>
                    <div class="modal-body">
                        <form method="post" role="form" action="">
                            <div class="form-group row">
                                <label class="form-control-label col-md-offset-1 col-md-4 col-xs-offset-0 col-xs-5" for="userName">Username:</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="userName" name="userName" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="form-control-label col-md-offset-1 col-md-4 col-xs-offset-0 col-xs-5" for="staffId">NRIC:</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="staffId" name="staffId" required>
                                </div> 
                            </div>
                            <div class="form-group row">
                                <label class="form-control-label col-md-offset-1 col-md-4 col-xs-offset-0 col-xs-5" for="role">Name:</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="staffId" name="staffId" required>
                                </div> 
                            </div>
                            <div class="form-group row" style="margin-top: 30px;">
                                <div class="row">
                                    <div class="col-sm-6 col-sm-offset-3">
                                        <input type="submit" name="addUserBtn" tabindex="4" class="form-control btn btn-primary" value="ADD USER">
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
    </body>
</html>