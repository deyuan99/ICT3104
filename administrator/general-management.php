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
    </head>
    <body>

        <?php include_once 'nav-bar.php'; ?>
        <!-- Current promotion-->
        <section id="one" class="wrapper">
            <div class="container">

        </section>
        <section id="two" class="wrapper style1">
            <div class="container">
                <form class="form-horizontal">
                    <div class="form-group">
                        <div class="col-xs-4">
                            <label for="title">Title</label>
                            <input class="form-control" id="title" type="text">
                        </div>
                    </div>
                </form>
            </div>
        </section>

        <section id="two" class="wrapper style1">
            <div class="container-fluid">
                <h1 class="text-center"><span class="glyphicon glyphicon-user icon-space"></span> USER MANAGEMENT</h1>
                <div class="col-md-10 col-md-offset-1 padding-0" id="usermanagement">
                    <div class="row" style="margin-bottom: 10px;">
                        <ul class="nav nav-tabs col-md-10 padding-l0-r0">
                            <li class="active data-tabs col-md-3 col-sm-6 col-xs-12"><a href="#about_tab" data-toggle="pill">About</a></li>
                            <li class="data-tabs col-md-3 col-xs-12 col-sm-6"><a href="#promo_tab" data-toggle="pill">Promo</a></li>
                        </ul>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane active add--15-margin" id="about_tab">
                            <div class="panel panel-default margin-l0-r0">
                                <div class="table-responsive my-table-style">
                                    <table id="esa-table" class="table table-striped table-bordered" cellspacing="0" width="100%">

                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Title</th>
                                                <th>Description</th>
                                                <th>Start Date</th>
                                                <th>End Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="odd">
                                                <td>1</td>
                                                <td id="first_name:1" contenteditable="true">Karthikeyan</td>
                                                <td id="last_name:1" contenteditable="true">K</td>
                                                <td id="city:1" contenteditable="true">Chennai</td>
                                                <td id="date:1" contenteditable="true">Chennai</td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td id="first_name:2" contenteditable="true">Facebook</td>
                                                <td id="last_name:2" contenteditable="true">Inc</td>
                                                <td id="city:2" contenteditable="true">California</td>
                                                <td id="date:1" contenteditable="true">Chennai</td>
                                            </tr>
                                            <tr class="odd">
                                                <td>3</td>
                                                <td id="first_name:3" contenteditable="true">W3lessons</td>
                                                <td id="last_name:3" contenteditable="true">Blog</td>
                                                <td id="city:3" contenteditable="true">Chennai, India</td>
                                                <td id="date:1" contenteditable="true">Chennai</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane active add--15-margin" id="promo_tab">
                            <div class="panel panel-default margin-l0-r0">
                                <div class="table-responsive my-table-style">
                                    <table id="esa-table" class="table table-striped table-bordered" cellspacing="0" width="100%">

                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Title</th>
                                                <th>Description</th>
                                                <th>Start Date</th>
                                                <th>End Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="odd">
                                                <td>1</td>
                                                <td id="first_name:1" contenteditable="true">Karthikeyan</td>
                                                <td id="last_name:1" contenteditable="true">K</td>
                                                <td id="city:1" contenteditable="true">Chennai</td>
                                                <td id="date:1" contenteditable="true">Chennai</td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td id="first_name:2" contenteditable="true">Facebook</td>
                                                <td id="last_name:2" contenteditable="true">Inc</td>
                                                <td id="city:2" contenteditable="true">California</td>
                                                <td id="date:1" contenteditable="true">Chennai</td>
                                            </tr>
                                            <tr class="odd">
                                                <td>3</td>
                                                <td id="first_name:3" contenteditable="true">W3lessons</td>
                                                <td id="last_name:3" contenteditable="true">Blog</td>
                                                <td id="city:3" contenteditable="true">Chennai, India</td>
                                                <td id="date:1" contenteditable="true">Chennai</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                    </section>
                    <script>
                        $(function () {
                        //acknowledgement message
                        var message_status = $("#status");
                                $("td[contenteditable=true]").blur(function () {
                        var field_userid = $(this).attr("id");
                                var value = $(this).text();
                                $.post('ajax.php', field_userid + "=" + value, function (data) {
                                if (data != '')
                                {
                                message_status.show();
                                        message_status.text(data);
                                        //hide the message
                                        setTimeout(function () {
                                        message_status.hide()
                                        }, 3000);
                                }
                                });
                        });
                        });
                                if (!empty($_POST))
                                {
                                //database settings
                                include "db_config.php";
                                        foreach($_POST as $field_name = > $val)
                                {
                                //clean post values
                                $field_userid = strip_tags(trim($field_name));
                                        $val = strip_tags(trim(mysql_real_escape_string($val)));
                                        //from the fieldname:user_id we need to get user_id
                                        $split_data = explode(':', $field_userid);
                                        $user_id = $split_data[1];
                                        $field_name = $split_data[0];
                                        if (!empty($user_id) && !empty($field_name) && !empty($val))
                                {
                                //update the values
                                mysql_query("UPDATE user_details SET $field_name = '$val' WHERE user_id = $user_id") or mysql_error();
                                        echo "Updated";
                                } else {
                                echo "Invalid Requests";
                                }
                                }
                                } else {
                        echo "Invalid Requests";
                                }
                    </script>
                    </body>
                    </html>
