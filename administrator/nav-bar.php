<!--Trainee Header -->
<header id="header">
    <h1><strong><a href="../index.php">STPS</a></strong> by Group 4 <a href="#notifications" data-toggle="modal" style="margin-left:30px; font-size: 120%;"><span class="glyphicon glyphicon-envelope"></span></a></h1>
    <nav id="nav">
        <ul>
            <li><a href="user-management.php"><span class="glyphicon glyphicon-user icon-space"></span>USER MANAGEMENT</a></li>
            <li><a href="user-approval.php"><span class="glyphicon glyphicon-ok-sign icon-space"></span>APPROVALS</a></li>
            <li><a href="user-groupsession.php"><span class="glyphicon glyphicon-calendar icon-space"></span>GROUP SESSION</a></li>
            
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="">MANAGE SITE
                    <span class="caret"></span></a>
                <ul class="dropdown-menu" id="listdown">
                    <li><a href="promo-management.php"><span class="glyphicon glyphicon-tags icon-space"></span> PROMOTIONS</a></li>
                    <li><a href="manageGym.php"><span class="glyphicon glyphicon-globe icon-space"></span> MANAGE GYM</a></li>
                </ul>
            </li>
            
            <li><a href="../logout.php"><span class="glyphicon glyphicon-log-out icon-space"></span>SIGN OUT</a></li>
        </ul>
    </nav>
</header>

<a href="#menu" class="navPanelToggle"><span class="fa fa-bars"></span></a>
<?php include_once '../notification.php'; ?>
<?php include_once '../listNotifications.php'; ?>
