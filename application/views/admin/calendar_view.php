<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="shortcut icon" href="">
        <title><?php echo $title; ?></title>
        <!-- Bootstrap core CSS -->
        <?php echo link_tag('bootstrap/css/bootstrap.css', 'stylesheet', 'text/css'); ?>
        <?php echo link_tag('bootstrap/css/bootstrap-theme.css', 'stylesheet', 'text/css'); ?>
        <?php echo link_tag('css/style.css', 'stylesheet', 'text/css'); ?>

        <script src="<?php echo base_url(); ?>js/jquery.min.js"></script>
        <script src="<?php echo base_url(); ?>bootstrap/js/bootstrap.js"></script>

        <?php echo link_tag('fullcalendar/fullcalendar.css', 'stylesheet', 'text/css'); ?>
        <?php
        $link = array(
            'href' => 'fullcalendar/fullcalendar.print.css',
            'rel' => 'stylesheet',
            'type' => 'text/css',
            'media' => 'print'
        );
        echo link_tag($link);
        ?>
        <script src="<?php echo base_url(); ?>fullcalendar/lib/moment.min.js"></script>
        <?php /** <script src="<?php echo base_url(); ?>fullcalendar/lib/jquery.min.js"></script> */ ?>
        <script src="<?php echo base_url(); ?>fullcalendar/fullcalendar.min.js"></script>
        <script>
            $(document).ready(function () {

                $('#calendar').fullCalendar({
                    header: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'month'
                    },
                    defaultDate: '<?php echo date("Y-m-d"); ?>',
                    editable: false,
                    eventLimit: true, // allow "more" link when too many events
                    events: [
<?php echo $reserved_data . $free_date; ?>
                    ]
                });

            });
        </script>

        <style>
            #calendar {
                max-width: 900px;
                margin: 0 auto;
            }
            .unoccupied {
                text-align: center;
                font-size: 16px;
                font-weight: bold;                
            }
            .unoccupied:hover{                
                text-decoration: underline;
                cursor: pointer; 
            }
            .occupied {
                text-align: center;
                font-size: 16px;
                font-weight: bold;
                cursor: pointer;
            }
        </style>

    </head>

    <body>
        <div class="container">
            <header>
                <a href="<?php echo site_url(); ?>">
                    <div class="page-header" style="margin-top: 5px;">
                        <h1><a href="admin/calendar">ระบบจองคิวเครื่อง XPS</a></h1>
                    </div>
                </a>
            </header>

            <?php $user_url = site_url() . '/admin/user_detail/' . $this->session->userdata('user_id'); ?>
            <nav class="navbar navbar-default" role="navigation" style="border-radius: 0;">
                <div class="container-fluid">

                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="<?php echo site_url(); ?>/admin/calendar">ระบบจองคิวเครื่อง XPS</a>
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">                        

                        <ul class="nav navbar-nav navbar-right">
                            <li><a title="ข้อมูลส่วนตัว" href="<?php echo $user_url; ?>"><strong><?php echo $this->session->userdata('firstname') . ' ' . $this->session->userdata('lastname'); ?></strong></a></li>
                            <li>
                                <?php if ($notification_number > 0): ?>
                                    <a title="Notifications" href="#">Notifications
                                        <span class="badge" style="background-color: red;"><?php echo $notification_number; ?></span>
                                    </a>
                                <?php endif; ?>
                            </li>
                            <li><a title="ออกจากระบบ" href="<?php echo site_url(); ?>/logout"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span> Logout</a></li>
                        </ul>

                    </div><!-- /.navbar-collapse -->
                </div><!-- /.container-fluid -->
            </nav>


            <h2 style="text-align: center;">ปฏิทินรายการจองคิว</h2>
            <div id="calendar" style="margin-top: 15px;"></div>

            <section>
                <p>&nbsp;</p>
                <h4>
                    *** จองได้สัปดาห์ละ 4 วัน จันทร์-ศุกร์ วันไหนก็ได้<br>
                    สัปดาห์สุดท้ายของเดือน รับ 3 คิว
                </h4>
                <P>&nbsp;</P>
            </section>
