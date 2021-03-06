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
        <?php include_once 'loadPromo.php'; ?>

        <script src="../bootstrap-3.3.5-dist/js/bootstrap.min.js"></script>

        <script>
            function setDeletePromo(table, id, title)
            {
                document.getElementById("delete_table").value = "";
                document.getElementById("delete_table").value = table;
                document.getElementById("delete_id").value = "";
                document.getElementById("delete_id").value = id;
                document.getElementById("deleteMsg").innerHTML = "Are you sure you want to Delete " + "<strong>" + title + "</strong>" + "  ?";
            }
            function setEditPromo(id, title, description, startDate, endDate, imagePath, featuredStatus)
            {
                document.getElementById("id").innerHTML = id;
                
                document.getElementById("id").placeholder = id;
                document.getElementById("title").placeholder = title;
                document.getElementById("description").placeholder = description;
                document.getElementById("startDate").placeholder = startDate;
                document.getElementById("endDate").placeholder = endDate;
                document.getElementById("imagePath").placeholder = imagePath;
                document.getElementById("featuredStatus").placeholder = featuredStatus;

                document.getElementById("edit_id").value = "";
                document.getElementById("edit_id").value = id;
                document.getElementById("edit_title").value = "";
                document.getElementById("edit_title").value = title;
                document.getElementById("edit_description").value = "";
                document.getElementById("edit_description").value = description;
                document.getElementById("edit_startDate").value = "";
                document.getElementById("edit_startDate").value = startDate;
                document.getElementById("edit_endDate").value = "";
                document.getElementById("edit_endDate").value = endDate;
                document.getElementById("edit_imagePath").value = "";
                document.getElementById("edit_imagePath").value = imagePath;
                document.getElementById("edit_featuredStatus").value = "";
                document.getElementById("edit_featuredStatus").value = featuredStatus;
            }

            function addPromo(title, description, startDate, endDate, imagePath, featuredStatus)
            {
                document.getElementById("title").innerHTML = title;
                document.getElementById("title").placeholder = title;
                document.getElementById("description").innerHTML = description;
                document.getElementById("description").placeholder = description;
                document.getElementById("startDate").innerHTML = startDate;
                document.getElementById("startDate").placeholder = startDate;
                document.getElementById("endDate").innerHTML = endDate;
                document.getElementById("endDate").placeholder = endDate;
                document.getElementById("imagePath").innerHTML = imagePath;
                document.getElementById("imagePath").placeholder = imagePath;
                document.getElementById("featuredStatus").innerHTML = featuredStatus;
                document.getElementById("featuredStatus").placeholder = featuredStatus;

                document.getElementById("add_title").value = "";
                document.getElementById("add_title").value = title;
                document.getElementById("add_description").value = "";
                document.getElementById("add_description").value = description;
                document.getElementById("add_startDate").value = "";
                document.getElementById("add_startDate").value = startDate;
                document.getElementById("add_endDate").value = "";
                document.getElementById("add_endDate").value = endDate;
                document.getElementById("add_imagePath").value = "";
                document.getElementById("add_imagePath").value = imagePath;
                document.getElementById("add_featuredStatus").value = "";
                document.getElementById("add_featuredStatus").value = featuredStatus;
            }
        </script>
    </head>
    <body>
        <?php include_once 'nav-bar.php'; ?>
        <section id="main" class="wrapper">
            <div class="container-fluid" style="margin: 0px 80px 0px 80px;">
                <h2 class="text-center" id="toptitle"><span class="glyphicon glyphicon-tags icon-space"></span>PROMOTIONS MANAGEMENT</h2>
                <div class="panel panel-default margin-l0-r0">
                    <div class="panel-heading">
                        <div class="panel-title">PROMOTIONS</div>
                    </div>
                    <div class="table-responsive my-table-style">
                        <table id="esa-table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th class="col-md-1">ID</th>
                                    <th class="col-md-1">Title</th>
                                    <th class="col-md-1">Description</th>
                                    <th class="col-md-1">Start Date</th>
                                    <th class="col-md-1">End Date</th>
                                    <th class="col-md-1">Image Path</th>
                                    <th class="col-md-1">Featured Status</th>
                                    <th class="col-md-2">Action</th>
                                </tr>
                            </thead>
                            <tbody><?php getCurrentPromotions(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div>
                    <a data-toggle="modal" data-target="#addPromoModal" class="btn btn-primary"> <span class="glyphicon glyphicon-plus icon-space"></span>ADD PROMOTION</a>
                    <br>
                    <br>
                </div>
            </div>

            <!-- Edit promo modal-->
            <div class="modal fade" id="editPromoModal" tabindex="-1" role="dialog" style="padding-top: 70px;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">
                                <span aria-hidden="true">&times;</span>
                                <span class="sr-only">Close</span>
                            </button>
                            <h2 style="color: black; text-align:center; margin-top: 12px;">EDIT PROMOTIONS</h2>
                        </div>
                        <div class="modal-body">
                            <form method="post" role="form" action="editPromo.php">
                                <input type="hidden" name="edit_id" id="edit_id" value="">
                                <div class="form-group row" style="margin-top: 20px;">
                                    <label class="form-control-label col-md-offset-2 col-md-3 col-xs-offset-0 col-xs-5">ID:</label>
                                    <div class="col-sm-5" id="id"></div> 
                                </div>
                                <input type="hidden" name="edit_title" id="edit_title" value="">
                                <div class="form-group row">
                                    <label class="form-control-label col-md-offset-2 col-md-3 col-xs-offset-0 col-xs-5 label-margin">Title:</label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" id="title" name="title" value="">
                                    </div>
                                </div>


                                <input type="hidden" name="edit_description" id="edit_description" value="">
                                <div class="form-group row">
                                    <label class="form-control-label col-md-offset-2 col-md-3 col-xs-offset-0 col-xs-5 label-margin">Description:</label>
                                    <div class="col-sm-5">
                                        <textarea style="resize:none" type="text" class="form-control" id="description" rows="3" name="description" value=""></textarea>
                                    </div>
                                </div>

                                <input type="hidden" name="edit_startDate" id="edit_startDate" value="">
                                <div class="form-group row">
                                    <label class="form-control-label col-md-offset-2 col-md-3 col-xs-offset-0 col-xs-5 label-margin" for="date" >Start Date:</label>
                                    <div class="col-sm-5">
                                        <input type="date" class="form-control" id="startDate" name="startDate" min="2017-12-01" value="">
                                    </div>
                                </div>

                                <input type="hidden" name="edit_endDate" id="edit_endDate" value="">
                                <div class="form-group row">
                                    <label class="form-control-label col-md-offset-2 col-md-3 col-xs-offset-0 col-xs-5 label-margin">End Date:</label>
                                    <div class="col-sm-5">
                                        <input type="date" class="form-control" id="endDate" name="endDate" min="2017-12-03" value="">
                                    </div>
                                </div>

                                <input type="hidden" name="edit_imagePath" id="edit_imagePath" value="">
                                <div class="form-group row">
                                    <label class="form-control-label col-md-offset-2 col-md-3 col-xs-offset-0 col-xs-5 label-margin">Image Path:</label>
                                    <div class="col-sm-5">
                                        <input type="file" class="form-control" id="imagePath" name="imagePath" value="">
                                    </div>
                                </div>

                                <input type="hidden" name="edit_featuredStatus" id="edit_featuredStatus" value="">
                                <div class="form-group row">
                                    <label class="form-control-label col-md-offset-2 col-md-3 col-xs-offset-0 col-xs-5 label-margin">Featured Status:</label>
                                    <div class="col-sm-5">
                                        <input type="number" class="form-control" id="featuredStatus" name="featuredStatus" min="0" max="1" value="">
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

            <!-- Add promo modal-->
            <div class="modal fade" id="addPromoModal" tabindex="-1" role="dialog" style="padding-top: 70px;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">
                                <span aria-hidden="true">&times;</span>
                                <span class="sr-only">Close</span>
                            </button>
                            <h4>ADD PROMOTION</h4>
                        </div>
                        <div class="modal-body">
                            <form method="post" role="form" action="addPromo.php">
                                <input type="hidden" name="edit_title" id="edit_title" value="">
                                <div class="form-group row">
                                    <label class="form-control-label col-md-offset-2 col-md-3 col-xs-offset-0 col-xs-5 label-margin">Title:</label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" id="title" name="title" value="" required>
                                    </div>
                                </div>

                                <input type="hidden" name="edit_description" id="edit_description" value="">
                                <div class="form-group row">
                                    <label class="form-control-label col-md-offset-2 col-md-3 col-xs-offset-0 col-xs-5 label-margin">Description:</label>
                                    <div class="col-sm-5">
                                        <textarea style="resize:none" type="text" class="form-control" id="description" rows="3" name="description" value="" required></textarea>
                                    </div>
                                </div>

                                <input type="hidden" name="edit_startDate" id="edit_startDate" value="">
                                <div class="form-group row">
                                    <label class="form-control-label col-md-offset-2 col-md-3 col-xs-offset-0 col-xs-5 label-margin">Start Date:</label>
                                    <div class="col-sm-5">
                                        <input type="date" class="form-control" id="startDate" min="2017-12-01" name="startDate" required>
                                    </div>
                                </div>

                                <input type="hidden" name="edit_endDate" id="edit_endDate" value="">
                                <div class="form-group row">
                                    <label class="form-control-label col-md-offset-2 col-md-3 col-xs-offset-0 col-xs-5 label-margin">End Date:</label>
                                    <div class="col-sm-5">
                                        <input type="date" class="form-control" id="endDate"  min="2017-12-03" name="endDate" required>
                                    </div>
                                </div>

                                <input type="hidden" name="edit_imagePath" id="edit_imagePath" value="">
                                <div class="form-group row">
                                    <label class="form-control-label col-md-offset-2 col-md-3 col-xs-offset-0 col-xs-5 label-margin">Image Path:</label>
                                    <div class="col-sm-5">
                                        <input type="file" class="form-control" id="imagePath"  name="imagePath">
                                    </div>
                                </div>

                                <input type="hidden" name="edit_featuredStatus" id="edit_featuredStatus" value="">
                                <div class="form-group row">
                                    <label class="form-control-label col-md-offset-2 col-md-3 col-xs-offset-0 col-xs-5 label-margin">Featured Status:</label>
                                    <div class="col-sm-5">
                                        <input type="number" class="form-control" id="featuredStatus" min="0" max="1" name="featuredStatus">
                                    </div>
                                </div>

                                <div class="form-group row" style="margin-top: 30px;">
                                    <div class="row">
                                        <div class="col-sm-6 col-sm-offset-3 col-xs-8 col-xs-offset-2">
                                            <input type="submit" name="addBtn" tabindex="4" class="form-control btn btn-primary" value="Add">
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

            <!-- Delete Promo -->
            <div class="modal fade" id="deletePromoModal" tabindex="-1" role="dialog" style="padding-top: 70px;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title" id="remove-title">DELETE</h4>
                        </div>
                        <div class="modal-body">
                            <div id="deleteMsg"></div>
                            <div class="widget-body" id="manualForm"> 
                                <form name="form" id="form" class="form-horizontal" role="form" action="doDeletePromo.php" enctype="multipart/form-data" method="POST">
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
        </section>
    </body>
</html>
