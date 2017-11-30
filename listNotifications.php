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
$sql = "SELECT * FROM notificationlog WHERE userEmail = '$user' AND readStatus = 0";
$req = $conn->prepare($sql);
$req->execute();
$notificationsUnread = $req->fetchAll();

$sql2 = "SELECT * FROM notificationlog WHERE userEmail = '$user' AND readStatus = 1 ORDER BY id DESC";
$req2 = $conn->prepare($sql2);
$req2->execute();
$notificationsRead = $req2->fetchAll();
$count = 0;
?>

<div id="notifications" class="modal" role='dialog' tabindex="-1" style="padding-top: 120px;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" style="color:black;"><span class="glyphicon glyphicon-envelope" style="margin-right: 10px;"></span>My Notifications</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

            </div>
            <div class="modal-body">

                <?php
                foreach ($notificationsUnread as $notificationUnread):
                    $message = $notificationUnread['message'];
                    echo "<div class=\"panel panel-default\">
                             <div class=\"panel-body\" style=\"color: maroon;\">
                             <span class=\"glyphicon glyphicon-pushpin\" style=\"color: maroon; margin-right:20px;\"></span>$message</div></div>";
                    $count ++;
                endforeach;
                
                foreach ($notificationsRead as $notificationRead):
                    $message2 = $notificationRead['message'];
                    echo "<div class=\"panel panel-default\">
                             <div class=\"panel-body\">
                             <span class=\"glyphicon glyphicon-pushpin\" style=\"color: grey; margin-right:20px;\"></span>$message2</div></div>";
                    $count ++;
                endforeach;
                
                if($count == 0){
                    echo "You have no notifications";
                }
                ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" style="color:black !important;" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>