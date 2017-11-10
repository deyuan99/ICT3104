<link rel="stylesheet" type="text/css" href="CSS/navbar.css">    
<?php include_once 'include.php'; ?>
<nav class="navbar navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" id="nav-toggle" class="navbar-toggle" data-toggle="collapse" data-target="#main-nav">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand">Admin</a>
        </div>
        <div id="main-nav" class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="../index.php"><span class="glyphicon glyphicon-home icon-space"></span>HOME</a></li>
                <li><a href="user-management.php"><span class="glyphicon glyphicon-user icon-space"></span>USER MANAGEMENT</a></li>
                <li><a href="user-approval.php"><span class="glyphicon glyphicon-ok-sign icon-space"></span>APPROVAL REQUEST</a></li>
                <li><a href="user-groupsession.php"><span class="glyphicon glyphicon-list-alt icon-space"></span>GROUP SESSION</a></li>
                <li><a href="../logout.php"><span class="glyphicon glyphicon-log-out icon-space"></span>SIGN OUT</a></li>
                
            </ul>
        </div>
    </div>
</nav>

