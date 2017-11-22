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
        <?php include_once 'loadIndex.php'; ?>
        <!-- Bootstrap Core JavaScript -->
        <script src="../bootstrap-3.3.5-dist/js/bootstrap.min.js"></script>
        <script>
            function setEditInfo(title, description, startDate, endDate, featuredStatus)
                    {
                        document.getElementById("title").innerHTML = title;
                        document.getElementById("description").placeholder = description;
                        document.getElementById("startDate").placeholder = startDate;
                        document.getElementById("endDate").placeholder = endDate;
                        document.getElementById("featuredStatus").placeholder = featuredStatus;
                    }
        </script>
    </head>
    <body>
        <?php include_once 'nav-bar.php'; ?>
        <section id="main" class="wrapper">
            <div class="container-fluid">
                <h2 class="text-center" id="toptitle"><span class="glyphicon glyphicon-user icon-space"></span>INDEX PAGE MANAGEMENT</h2>
                <div class="col-md-10 col-md-offset-1 padding-0" id="usermanagement">
                    <div class="row" style="margin-bottom: 10px;">
                        <ul class="nav nav-pills col-md-10 padding-l0-r0">
                            <li class="active data-tabs col-md-3 col-sm-6 col-xs-12"><a href="#promo_tab" data-toggle="pill"><span class="glyphicon glyphicon-tags icon-space"></span>Promo</a></li>
                            <li class="data-tabs col-md-3 col-xs-12 col-sm-6"><a href="#trainer_tab" data-toggle="pill"><span class="glyphicon glyphicon-user icon-space"></span>Trainer</a></li>
                        </ul>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane active add--15-margin" id="promo_tab">
                            <div class="panel panel-default margin-l0-r0">
                                <div class="panel-heading">
                                    <div class="panel-title">PROMOTIONS</div>
                                </div>
                                <div class="table-responsive my-table-style">
                                    <table id="esa-table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th class="col-md-2">Title</th>
                                                <th class="col-md-1">Description</th>
                                                <th class="col-md-1">Start Date</th>
                                                <th class="col-md-2">End Date</th>
                                                <th class="col-md-1">Image Path</th>
                                                <th class="col-md-1">Featured Status</th>
                                                <th class="col-md-3">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php getPromotions(); ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- featured trainer -->
                        <div class="tab-pane add--15-margin" id="trainer_tab">
                            <div class="panel panel-default margin-l0-r0">
                                <div class="panel-heading">
                                    <div class="panel-title">TRAINER</div>
                                </div>
                                <div class="table-responsive my-table-style">
                                    <table id="supervisor-table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th class="col-md-2">Email Address</th>
                                                <th class="col-md-1">First Name</th>
                                                <th class="col-md-1">Last Name</th>
                                                <th class="col-md-1">Billing Address</th>
                                                <th class="col-md-1">Mobile</th>
                                                <th class="col-md-2">Bio</th>
                                                <th class="col-md-1">Featured</th>
                                                <th class="col-md-3">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php getTrainer(); ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- edit modal -->
            <div class="modal fade" id="editUserModal" tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Close</span>
                        </button>
                        <h4>EDIT PROMOTIONS</h4>
                    </div>
                    <div class="modal-body">
                        <form method="post" role="form" action="editPromo.php">
                            
                            <input type="hidden" name="edit_title" id="edit_title" value="">
                            <div class="form-group row">
                                <label class="form-control-label col-md-offset-2 col-md-3 col-xs-offset-0 col-xs-5 label-margin">Description:</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="title" name="title" value="">
                                </div>
                            </div>

                            <input type="hidden" name="edit_description" id="edit_description" value="">
                            <div class="form-group row">
                                <label class="form-control-label col-md-offset-2 col-md-3 col-xs-offset-0 col-xs-5 label-margin">Description:</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="description" name="description" value="">
                                </div>
                            </div>

                            <input type="hidden" name="edit_startDate" id="edit_startDate" value="">
                            <div class="form-group row">
                                <label class="form-control-label col-md-offset-2 col-md-3 col-xs-offset-0 col-xs-5 label-margin">Start Date:</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="startDate" name="startDate" value="">
                                </div>
                            </div>

                            <input type="hidden" name="edit_endDate" id="edit_endDate" value="">
                            <div class="form-group row">
                                <label class="form-control-label col-md-offset-2 col-md-3 col-xs-offset-0 col-xs-5 label-margin">End Date:</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="address" name="address">
                                </div>
                            </div>

                            <input type="hidden" name="edit_mobile" id="edit_imagePath" value="">
                            <div class="form-group row">
                                <label class="form-control-label col-md-offset-2 col-md-3 col-xs-offset-0 col-xs-5 label-margin">Image Path:</label>
                                <div class="col-sm-5">
                                    <input type="number" class="form-control" id="imagePath" name="imagePath" value="">
                                </div>
                            </div>

                            <input type="hidden" name="edit_featuredStatus" id="edit_featuredStatus" value="">
                            <div class="form-group row">
                                <label class="form-control-label col-md-offset-2 col-md-3 col-xs-offset-0 col-xs-5 label-margin" for="pass">Featured Status:</label>
                                <div class="col-sm-5">
                                    <input type="password" class="form-control" id="featuredStatus" name="featuredStatus" value="">
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
        </section>

    </body>
</html>
