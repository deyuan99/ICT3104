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
        <!-- Bootstrap Core JavaScript -->
        <script src="../bootstrap-3.3.5-dist/js/bootstrap.min.js"></script>
        <script>
            function setDeactivateInfo(email)
            {
                document.getElementById("deactivate_userid").value = "";
                document.getElementById("deactivate_userid").value = email;
                document.getElementById("deactivateMsg").innerHTML = "Are you sure you want to Deactivate " + "<strong>" + email + "</strong>" + "  ?";
            }
            function setReactivateInfo(email)
            {
                document.getElementById("reactivate_userid").value = "";
                document.getElementById("reactivate_userid").value = email;
                document.getElementById("reactivateMsg").innerHTML = "Are you sure you want to Reactivate " + "<strong>" + email + "</strong>" + "  ?";
            }
            function setEditInfo(email, firstName, lastName, address, mobile, password)
            {
                document.getElementById("email").innerHTML = email;
                document.getElementById("firstName").placeholder = firstName;
                document.getElementById("lastName").placeholder = lastName;
                document.getElementById("address").placeholder = address;
                document.getElementById("mobile").placeholder = mobile;
                document.getElementById("pass").placeholder = "*****";
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
                document.getElementById("edit_pass").value = "";
                document.getElementById("edit_pass").value = password;
            }
            function setViewInfo(email, firstName, lastName, address, mobile, registerDate,profileBio,profilePicture,role)
            {   
                if(profilePicture===""){
                    profilePicture = "images/uploads/profiledefault.jpg";
                }
                if(role==="trainee"){
                    $('#bio').hide();
                }
                else{
                    $('#bio').show();
                }
                document.getElementById("email5").innerHTML = email;
                document.getElementById("firstName5").innerHTML = firstName;
                document.getElementById("lastName5").innerHTML = lastName;
                document.getElementById("address5").innerHTML = address;
                document.getElementById("mobile5").innerHTML = mobile;
                document.getElementById("registerDate5").innerHTML = registerDate;
                document.getElementById("profileBio5").innerHTML = profileBio;
                document.getElementById("profilePicture5").src = "../"+profilePicture;
                
            }
        </script>
    </head>
    <body>
        <?php include_once 'nav-bar.php'; ?>
        <section id="main" class="wrapper">
            <div class="container-fluid">
                <h2 class="text-center" id="toptitle"><span class="glyphicon glyphicon-user icon-space"></span> USER MANAGEMENT</h2>
                <div class="col-md-10 col-md-offset-1 padding-0" id="usermanagement">
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
                                                <th class="col-md-2">Email Address</th>
                                                <th class="col-md-1">First Name</th>
                                                <th class="col-md-1">Last Name</th>
                                                <th class="col-md-2">Billing Address</th>
                                                <th class="col-md-1">Mobile</th>
                                                <th class="col-md-1">Password</th>
                                                <th class="col-md-1">Expiry Date</th>
                                                <th class="col-md-3">Action</th>
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
                                                <th class="col-md-2">Email Address</th>
                                                <th class="col-md-1">First Name</th>
                                                <th class="col-md-1">Last Name</th>
                                                <th class="col-md-1">Billing Address</th>
                                                <th class="col-md-1">Mobile</th>
                                                <!--<th class="col-md-2">Bio</th>-->
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
                        <div class="tab-pane add--15-margin" id="deactivated_tab">
                            <div class="panel panel-default panel-archive">
                                <div class="panel-heading">
                                    <div class="panel-title">DEACTIVATED</div>
                                </div>
                                <div class="table-responsive my-table-style">
                                    <table id="archive-table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th class="col-md-2">Email Address</th>
                                                <th class="col-md-1">First Name</th>
                                                <th class="col-md-1">Last Name</th>
                                                <th class="col-md-2">Billing Address</th>
                                                <th class="col-md-1">Role</th>
                                                <th class="col-md-1">Register Date</th>
                                                <th class="col-md-1">Expiry Date</th>
                                                <th class="col-md-3">Action</th>
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
          <div class="modal fade" id="viewUserModal" tabindex="-1" role="dialog" style="padding-top: 70px;">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Close</span>
                        </button>
                        <h4 style="color: black; text-align:center; margin-top: 12px;">View User Profile</h4>
                    </div>
                    <div class="modal-body">
                        <form method="post" role="form" action="viewUserInfo.php" >
                            <div class="form-group row">
                                <div class="col-md-2 col-md-offset-5">
                                    <img src="" alt="" value="" id="profilePicture5" style="width:100%;"/> 
                                </div>
                            </div>
                            
                            <div class="form-group row" >
                                <label class="form-control-label col-md-offset-2 col-md-3 col-xs-offset-0 col-xs-5" for="email">Email Address:</label>
                                <div class="col-sm-5" id="email5">
                                    <input type="text" class="form-control" id="edit_email5" name="edit_email" value="<?php echo $email; ?>" readonly/>
                                </div> 
                            </div>
                            
                            <div class="form-group row">
                                <label class="form-control-label col-md-offset-2 col-md-3 col-xs-offset-0 col-xs-5" >First Name:</label>
                                <div class="col-sm-5" id="firstName5">
                                    <input type="text" class="form-control" id="firstName5" name="firstName" value="<?php echo $firstName; ?>" readonly/>
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label class="form-control-label col-md-offset-2 col-md-3 col-xs-offset-0 col-xs-5 label-margin">Last Name:</label>
                                <div class="col-sm-5" id="lastName5">
                                    <input type="text" class="form-control" id="lastName5" name="lastName" value="<?php echo $lastName; ?>" readonly/>
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label class="form-control-label col-md-offset-2 col-md-3 col-xs-offset-0 col-xs-5 label-margin">Join Since:</label>
                                <div class="col-sm-5" id="registerDate5">
                                    <input type="text" class="form-control" id="registerDate5" name="registerDate" value="<?php echo $registerDate; ?>" readonly/>
                                </div>
                            </div>
                            
                            <div class="form-group row" id="bio">
                                <label class="form-control-label col-md-offset-2 col-md-3 col-xs-offset-0 col-xs-5 label-margin">ProfileBio:</label>
                                <div class="col-sm-5" id="profileBio5">
                                    <input type="text" class="form-control" id="profileBio5" name="profileBio" value="<?php echo $profileBio; ?>" readonly/>
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label class="form-control-label col-md-offset-2 col-md-3 col-xs-offset-0 col-xs-5 label-margin">Address:</label>
                                <div class="col-sm-5" id="address5">
                                    <input type="text" class="form-control" id="address5" name="address" value="<?php echo $address; ?>" readonly/>
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label class="form-control-label col-md-offset-2 col-md-3 col-xs-offset-0 col-xs-5 label-margin">Phone Number:</label>
                                <div class="col-sm-5" id="mobile5">
                                    <input type="text" class="form-control" id="mobile5" name="mobile" value="<?php echo $mobile; ?>" readonly/>
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
            
        <div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" style="padding-top: 70px;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Close</span>
                        </button>
                        <h4 style="color: black; text-align:center; margin-top: 12px;">EDIT USER PARTICULARS</h4>
                    </div>
                    <div class="modal-body">
                        <form method="post" role="form" action="editUserInfo.php" onsubmit="return validateForm()">
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

                            <input type="hidden" name="edit_lName" id="edit_lName" value="">
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
                                    <!--<input type="textarea" class="form-control" id="address" name="address" rows="3">-->
                                    <textarea style="resize: none; width: 100%; overflow: hidden;" name="address" id="address" rows="3"></textarea>

                                </div>
                            </div>

                            <input type="hidden" name="edit_mobile" id="edit_mobile" value="">
                            <div class="form-group row">
                                <label class="form-control-label col-md-offset-2 col-md-3 col-xs-offset-0 col-xs-5 label-margin" for="mobile">Mobile Number:</label>
                                <div class="col-sm-5">
                                    <input type="number" class="form-control" id="mobile" name="mobile" value="">
                                </div>
                            </div>

                            <input type="hidden" name="edit_pass" id="edit_pass" value="">
                            <div class="form-group row">
                                <label class="form-control-label col-md-offset-2 col-md-3 col-xs-offset-0 col-xs-5 label-margin" for="pass">Password:</label>
                                <div class="col-sm-5">
                                    <input type="password" class="form-control" id="pass" name="pass" value="">
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
        <div class="modal fade" id="deactivateUserModal" tabindex="-1" role="dialog" style="padding-top: 70px;">
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
        <div class="modal fade" id="reactivateUserModal" tabindex="-1" role="dialog" style="padding-top: 70px;">
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
            </section>
    </body>
</html>
<script type="text/javascript">
function validateForm(){
                var regpass = document.getElementById("pass");

                if(regpass.value.length < 7){
                    alert("make sure the password is at least 8 characters long")
                    return false;
                }
            }    
</script>