<!--Trainee Header -->
<header id="header">
    <h1><strong><a href="index.php">STPS</a></strong> by Group 4 <a href="#notifications" data-toggle="modal" style="margin-left:30px; font-size: 120%;"><span class="glyphicon glyphicon-envelope"></span></a></h1>
    <nav id="nav">
        <ul>
            <li><a href="trainee_dashboard.php">Home</a></li>
            <li><a href="trainee_trainerList.php">Find a Trainer</a></li>
            <li><a href="trainee_groupCalendar.php">Group Training</a></li>
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="trainee_dashboard.php">My Account<span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </li>
        </ul>
    </nav>
</header>

<a href="#menu" class="navPanelToggle"><span class="fa fa-bars"></span></a>
<?php include_once 'notification.php'; ?>
<?php include_once 'listNotifications.php'; ?>