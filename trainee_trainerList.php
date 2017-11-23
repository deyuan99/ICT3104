<?php session_start(); ?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>STPS</title>

        
        <script src="assets/js/jquery.min.js" rel="stylesheet"></script>
        <script src=\"https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js\"></script>;
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
        
        
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
                                    <th class="col-md-4">Trainer's Name</th>
                                    <th class="col-md-6">Email Address</th>
                                    <th class="col-md-2">Action</th>
                                </tr>
                            </thead>
                            <?php
                            include "scripts/listTrainers.php";
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

    </body>
</html>