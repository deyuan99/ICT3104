<?php
session_start();
require_once('../database/dbconfig.php');

$user = $_SESSION['email'];
$sql = "SELECT * FROM notificationlog WHERE userEmail = '$user' AND readStatus = 0 ";
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
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
     <script>
         $(document).ready(function() {
            $('#msgfrm').on('submit', function(event) {
                event.preventDefault();
                $('#modal').modal('hide');
                $.ajax({
                    type: "POST",
                    url: "../readNotification.php",
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
                    <h4 class="modal-title" style="color:black;"><span class="glyphicon glyphicon-alert" style="margin-right: 10px;"></span>Notification</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                </div>
                <div class="modal-body">
             
                        <?php
                        foreach ($notifications as $notification):
                            $message = $notification['message'];
                            echo "<div class=\"panel panel-default\">
                             <div class=\"panel-body\">
                             <span class=\"glyphicon glyphicon-pushpin\" style=\"color: maroon; margin-right:20px;\"></span>$message</div></div>";
                        endforeach;
                        ?>
                    <form method="post" id="msgfrm" action="../readNotification.php">
                        <input type="submit" value="OK" class="btn btn-info btn-md col-xs-8 col-xs-offset-2">
                    </form>
                    <br>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!--Modal ends here--->

    <!--<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#modal">Click Here To Open Modal</button>-->

</body>
