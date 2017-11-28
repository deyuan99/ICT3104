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
        <?php include_once 'loadGymInfo.php'; ?>
        <!-- Bootstrap Core JavaScript -->
        <script src="../bootstrap-3.3.5-dist/js/bootstrap.min.js"></script>
        <script>
            function setDeleteInfo(table, id, name)
            {
                document.getElementById("delete_table").value = "";
                document.getElementById("delete_table").value = table;
                document.getElementById("delete_id").value = "";
                document.getElementById("delete_id").value = id;
                document.getElementById("deleteMsg").innerHTML = "Are you sure you want to Delete " + "<strong>" + name + "</strong>" + "  ?";
            }
            function setEditInfo(table, id, name, third, fourth)
            {
                document.getElementById("table").value = "";
                document.getElementById("table").value = table;
                document.getElementById("itemID").innerHTML = id;
                document.getElementById("name").placeholder = name;
                document.getElementById("third").placeholder = third;
                document.getElementById("edit_id").value = "";
                document.getElementById("edit_id").value = id;
                document.getElementById("edit_name").value = "";
                document.getElementById("edit_name").value = name;
                document.getElementById("edit_third").value = "";
                document.getElementById("edit_third").value = third;

                if (table == "venue") {
                    document.getElementById("third_field").innerHTML = "Address";
                } else if (table == "room") {
                    document.getElementById("third_field").innerHTML = "Capacity";
                } else if (table == "training") {
                    document.getElementById("third_field").innerHTML = "Cost";
                }

                if (fourth) {
                    document.getElementById("fourthdiv").innerHTML =
                            "<input type='hidden' name='edit_forth' id='edit_forth' value='" + fourth + "'>" +
                            "<div class='form-group row'>" +
                            "<label class='form-control-label col-md-offset-2 col-md-3 col-xs-offset-0 col-xs-5 label-margin'>VenueID:</label>" +
                            "<div class='col-sm-5'>" +
                            "<input type='text' class='form-control' id='fourth' name='fourth' value='' placeholder='" + fourth + "'>" +
                            "</div>";
                } else {
                    document.getElementById("fourthdiv").innerHTML = "";
                }

            }
        </script>
    </head>
    <body>
        <?php include_once 'nav-bar.php'; ?>
        <section id="main" class="wrapper">
            <div class="container-fluid">
                <h2 class="text-center" id="toptitle"><span class="glyphicon glyphicon-globe icon-space"></span> MANAGE GYM</h2>
                <div class="col-md-10 col-md-offset-1 padding-0" id="usermanagement">
                    <div class="row" style="margin-bottom: 10px;">
                        <ul class="nav nav-pills col-md-10 padding-l0-r0">
                            <li class="active data-tabs col-md-3 col-sm-6 col-xs-12"><a href="#venue_tab" data-toggle="pill"><span class="glyphicon glyphicon-map-marker icon-space"></span>Venue</a></li>
                            <li class="data-tabs col-md-3 col-xs-12 col-sm-6"><a href="#room_tab" data-toggle="pill"><span class="glyphicon glyphicon-modal-window icon-space"></span>Room Type</a></li>
                            <li class="data-tabs col-md-3 col-xs-12 col-sm-6"><a href="#training_tab" data-toggle="pill"><span class="glyphicon glyphicon-th icon-space"></span>Training Type</a></li>
                        </ul>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane active add--15-margin" id="venue_tab">
                            <div class="panel panel-default margin-l0-r0">
                                <div class="panel-heading">
                                    <div class="panel-title">VENUE</div>
                                </div>
                                <div class="table-responsive my-table-style">
                                    <table id="esa-table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th class="col-md-1">ID</th>
                                                <th class="col-md-3">Location</th>
                                                <th class="col-md-5">Address</th>
                                                <th class="col-md-3">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php getVenue(); ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div style="text-align:center;">
                                <a data-toggle="modal" data-target="#addvenueModal" class="btn btn-success"><span class="glyphicon glyphicon-plus icon-space"></span>Add Venue</a>
                            </div>
                        </div>

                        <div class="tab-pane add--15-margin" id="room_tab">
                            <div class="panel panel-default margin-l0-r0">
                                <div class="panel-heading">
                                    <div class="panel-title">ROOM TYPE</div>
                                </div>
                                <div class="table-responsive my-table-style">
                                    <table id="supervisor-table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th class="col-md-1">ID</th>
                                                <th class="col-md-4">Name</th>
                                                <th class="col-md-2">Capacity</th>
                                                <th class="col-md-2">VenueID</th>
                                                <th class="col-md-3">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php getRoom(); ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div style="text-align:center;">
                                <a data-toggle="modal" data-target="#addroomModal" class="btn btn-success"><span class="glyphicon glyphicon-plus icon-space"></span>Add Room Type</a>
                            </div>
                        </div>

                        <div class="tab-pane add--15-margin" id="training_tab">
                            <div class="panel panel-default panel-archive">
                                <div class="panel-heading">
                                    <div class="panel-title">TRAINING TYPE</div>
                                </div>
                                <div class="table-responsive my-table-style">
                                    <table id="archive-table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th class="col-md-1">ID</th>
                                                <th class="col-md-6">Training Type Name</th>
                                                <th class="col-md-2">Cost</th>
                                                <th class="col-md-3">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php getTrainingType(); ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div style="text-align:center;">
                                <a data-toggle="modal" data-target="#addtrainingModal" class="btn btn-success"><span class="glyphicon glyphicon-plus icon-space"></span>Add Training Type</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="editGymModal" tabindex="-1" role="dialog" style="padding-top: 70px;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">
                                <span aria-hidden="true">&times;</span>
                                <span class="sr-only">Close</span>
                            </button>
                            <h4>EDIT DETAILS</h4>
                        </div>
                        <div class="modal-body">
                            <form method="post" role="form" action="editGymInfo.php">
                                <input type="hidden" name="table" id="table" value="">
                                <input type="hidden" name="edit_id" id="edit_id" value="">
                                <div class="form-group row" style="margin-top: 20px;">
                                    <label class="form-control-label col-md-offset-2 col-md-3 col-xs-offset-0 col-xs-5" for="itemID">ID:</label>
                                    <div class="col-sm-5" id="itemID"></div> 
                                </div>

                                <input type="hidden" name="edit_name" id="edit_name" value="">
                                <div class="form-group row">
                                    <label class="form-control-label col-md-offset-2 col-md-3 col-xs-offset-0 col-xs-5 label-margin">Name:</label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" id="name" name="name" value="">
                                    </div>
                                </div>

                                <input type="hidden" name="edit_third" id="edit_third" value="">
                                <div class="form-group row">
                                    <label class="form-control-label col-md-offset-2 col-md-3 col-xs-offset-0 col-xs-5 label-margin" id="third_field"></label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" id="third" name="third" value="">
                                    </div>
                                </div>

                                <div id="fourthdiv">
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
            <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" style="padding-top: 70px;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title" id="remove-title">DELETE</h4>
                        </div>
                        <div class="modal-body">
                            <div id="deleteMsg"></div>
                            <div class="widget-body" id="manualForm"> 
                                <form name="form" id="form" class="form-horizontal" role="form" action="doDelete.php" enctype="multipart/form-data" method="POST">
                                    <input type="hidden" name="delete_table" id="delete_table" value="">
                                    <input type="hidden" name="delete_id" id="delete_id" value="">
                                    <div class="form-actions">
                                        <div class="row">
                                            <div class="col-sm-offset-7 col-sm-5 col-xs-offset-0 col-xs-12">
                                                <button class="btn btn-success col-sm-offset-3 col-sm-4 col-xs-offset-0 col-xs-5" type="submit" name="deleteBtn">YES</button>
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
            
            <div class="modal fade" id="addvenueModal" tabindex="-1" role="dialog" style="padding-top: 70px;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">
                                <span aria-hidden="true">&times;</span>
                                <span class="sr-only">Close</span>
                            </button>
                            <h4>ADD VENUE</h4>
                        </div>
                        <div class="modal-body">
                            <form method="post" role="form" action="addGymInfo.php">
                                <input type="hidden" name="table" id="table" value="venue">
                                <div class="form-group row" style="margin-top: 20px;">
                                    <label class="form-control-label col-md-offset-2 col-md-3 col-xs-offset-0 col-xs-5 label-margin">Location:</label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" id="location" name="location" value="">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="form-control-label col-md-offset-2 col-md-3 col-xs-offset-0 col-xs-5 label-margin">Address:</label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" id="address" name="address" value="">
                                    </div>
                                </div>

                                <div class="form-group row" style="margin-top: 30px;">
                                    <div class="row">
                                        <div class="col-sm-6 col-sm-offset-3 col-xs-8 col-xs-offset-2">
                                            <input type="submit" name="addBtn" tabindex="4" class="form-control btn btn-primary" value="ADD">
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
            
            <div class="modal fade" id="addroomModal" tabindex="-1" role="dialog" style="padding-top: 70px;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">
                                <span aria-hidden="true">&times;</span>
                                <span class="sr-only">Close</span>
                            </button>
                            <h4>ADD ROOM TYPE</h4>
                        </div>
                        <div class="modal-body">
                            <form method="post" role="form" action="addGymInfo.php">
                                <input type="hidden" name="table" id="table" value="room">
                                <div class="form-group row" style="margin-top: 20px;">
                                    <label class="form-control-label col-md-offset-2 col-md-3 col-xs-offset-0 col-xs-5 label-margin">Name:</label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" id="name" name="name" value="">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="form-control-label col-md-offset-2 col-md-3 col-xs-offset-0 col-xs-5 label-margin">Capacity:</label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" id="capacity" name="capacity" value="">
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label class="form-control-label col-md-offset-2 col-md-3 col-xs-offset-0 col-xs-5 label-margin">VenueID:</label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" id="venueID" name="venueID" value="">
                                    </div>
                                </div>

                                <div class="form-group row" style="margin-top: 30px;">
                                    <div class="row">
                                        <div class="col-sm-6 col-sm-offset-3 col-xs-8 col-xs-offset-2">
                                            <input type="submit" name="addBtn" tabindex="4" class="form-control btn btn-primary" value="ADD">
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
            
            <div class="modal fade" id="addtrainingModal" tabindex="-1" role="dialog" style="padding-top: 70px;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">
                                <span aria-hidden="true">&times;</span>
                                <span class="sr-only">Close</span>
                            </button>
                            <h4>ADD TRAINING TYPE</h4>
                        </div>
                        <div class="modal-body">
                            <form method="post" role="form" action="addGymInfo.php">
                                <input type="hidden" name="table" id="table" value="training">
                                <div class="form-group row" style="margin-top: 20px;">
                                    <label class="form-control-label col-md-offset-2 col-md-3 col-xs-offset-0 col-xs-5 label-margin">Training Type:</label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" id="trainingName" name="trainingName" value="">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="form-control-label col-md-offset-2 col-md-3 col-xs-offset-0 col-xs-5 label-margin">Cost:</label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" id="cost" name="cost" value="">
                                    </div>
                                </div>

                                <div class="form-group row" style="margin-top: 30px;">
                                    <div class="row">
                                        <div class="col-sm-6 col-sm-offset-3 col-xs-8 col-xs-offset-2">
                                            <input type="submit" name="addBtn" tabindex="4" class="form-control btn btn-primary" value="ADD">
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
