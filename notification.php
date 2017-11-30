<?php
$user = $_SESSION['email'];
$role = $_SESSION['role'];
$url = "";
if($role=="admin"){
    $url = "../readNotification.php";
    require_once('../database/dbconfig.php');
}   
else
{
    $url = "readNotification.php";
    require_once('database/dbconfig.php');
}
$sql = "SELECT * FROM notificationlog WHERE userEmail = '$user' AND readStatus = 0 ORDER BY id DESC ";
$req = $conn->prepare($sql);
$req->execute();
$count = $req->rowCount();
if ($count > 0) {
    $notifications = $req->fetchAll();
    echo "<script type=\"text/javascript\">
        $(window).load(function () {
            $('#modal').modal('show');
        });
        </script>";
}
?>
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.0/jquery.min.js"></script>
    <?php  
        echo "<script src=\"https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js\"></script>";
    ?>
     <script>
         $(document).ready(function() {
            $('#msgfrm').on('submit', function(event) {
                event.preventDefault();
                $('#modal').modal('hide');
                $.ajax({
                    type: "POST",
                    url: "<?php echo $url; ?>",
                    data: "$(this).serialize()",
                    success: function(data) {
          
                    },
                });
            });
        });
        </script>
</head>
<body>
    <!----modal starts here--->
    <div id="modal" class="modal fade" role='dialog' tabindex="-1" style="padding-top: 120px;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" style="color:black;"><span class="glyphicon glyphicon-alert" style="margin-right: 10px;"></span>New Notifications</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                </div>
                <div class="modal-body">
             
                        <?php
                        if ($count > 0) {
                        foreach ($notifications as $notification):
                            $message = $notification['message'];
                            echo "<div class=\"panel panel-default\">
                             <div class=\"panel-body\">
                             <span class=\"glyphicon glyphicon-pushpin\" style=\"color: maroon; margin-right:20px;\"></span>$message</div></div>";
                        endforeach;}
                        ?>
                    <form method="post" id="msgfrm" action="<?php echo $url; ?>">
                        <input type="submit" value="OK" class="btn btn-info btn-md col-xs-8 col-xs-offset-2" style="background: #5bc0de !important;">
                    </form>
                    <br>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" style="color:black !important;" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!--Modal ends here--->

    <!--<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#modal">Click Here To Open Modal</button>-->

</body>
