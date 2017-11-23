<!--Trainee Header -->
<header id="header">
    <h1><strong><a href="../index.php">STPS</a></strong> by Group 4</h1>
    <nav id="nav">
        <ul>
                 <!--<li><a href="../index.php"><span class="glyphicon glyphicon-home icon-space"></span>HOME</a></li>-->
            <li><a href="user-management.php"><span class="glyphicon glyphicon-user icon-space"></span>USER MANAGEMENT</a></li>
            <li><a href="user-approval.php"><span class="glyphicon glyphicon-ok-sign icon-space"></span>APPROVALS</a></li>
            <li><a href="user-groupsession.php"><span class="glyphicon glyphicon-calendar icon-space"></span>GROUP SESSION</a></li>
            
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="">MANAGE SITE
                    <span class="caret"></span></a>
                <ul class="dropdown-menu" id="listdown">
                    <li><a href="promo-management.php"><span class="glyphicon glyphicon-plus icon-space"></span> Promotions</a></li>
                    <li><a href="manageGym.php"><span class="glyphicon glyphicon-globe icon-space"></span> Manage Gym</a></li>
                </ul>
            </li>
            
            <li><a href="../logout.php"><span class="glyphicon glyphicon-log-out icon-space"></span>SIGN OUT</a></li>
        </ul>
    </nav>
</header>

<a href="#menu" class="navPanelToggle"><span class="fa fa-bars"></span></a>
<?php include_once '../notification.php'; ?>
