<html>
    <head>
        <meta charset="UTF-8">
        <title>STPS</title>
        <!-- Bootstrap Core CSS -->
        <link href="bootstrap-3.3.5-dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- FullCalendar -->
        <link href='fullcalendar-3.5.1/fullcalendar.css' rel='stylesheet' />
        <link href="assets/css/calendar.css" rel="stylesheet" type="text/css"/>

        <!-- Main CSS -->
        <link rel="stylesheet" href="assets/css/main.css" />
    </head>

    <body>
        <!-- Header -->
        <?php
        include "trainee_header.php";
        ?>
        <!-- Trainers list -->
        <section id="main" class="wrapper">
            <div class="container">
                <header class="major special">
                    <h3>Trainer List</h3>
                    <p>Look for a trainer A</p>
                </header>

                <section>
                    <div class="table-wrapper">
                        <table>
                            <thead>
                                <tr>
                                    <th>Trainer's Name</th>
                                    <th>Category</th>
                                    <th>Profile</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                include "listTrainers.php";
                                ?>


                               


                            <tfoot>
                                <tr>
                                    <!- pagination -->
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </section>
            </div>
        </section>

        <!-- Footer -->
        <?php
        include "footer.php";
        ?>

        <!-- Scripts -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/skel.min.js"></script>
        <script src="assets/js/util.js"></script>
        <script src="assets/js/main.js"></script>
    </body>
</html>