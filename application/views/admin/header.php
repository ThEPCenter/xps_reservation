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
        <?php echo link_tag('jquery-ui/jquery-ui.css', 'stylesheet', 'text/css'); ?>
        <?php echo link_tag('css/style.css', 'stylesheet', 'text/css'); ?>

        <script src="<?php echo base_url(); ?>js/jquery.min.js"></script>
        <script src="<?php echo base_url(); ?>jquery-ui/jquery-ui.js"></script>
        <script src="<?php echo base_url(); ?>bootstrap/js/bootstrap.js"></script>

        <script src="<?php echo base_url(); ?>ckeditor/ckeditor.js"></script>

        <?php echo link_tag('fullcalendar/fullcalendar.css', 'stylesheet', 'text/css'); ?>
        <?php echo link_tag('fullcalendar/fullcalendar.print.css', 'stylesheet', 'text/css'); ?>
        <script src="<?php echo base_url(); ?>fullcalendar/lib/moment.min.js"></script>
        <script src="<?php echo base_url(); ?>fullcalendar/fullcalendar.min.js"></script>

        <script src='https://www.google.com/recaptcha/api.js'></script>

        <script src="<?php echo base_url(); ?>js/script.js"></script>


    </head>

    <body>
        <div class="container">

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
                            <li><a title="ข้อมูลส่วนตัว" href="<?php echo $user_url; ?>"><strong><?php echo $my_firstname . ' ' . $my_lastname; ?></strong></a></li>
                            <li>
                                <?php if ($notification_number > 0): ?>
                                    <a title="รายการแจ้งเตือน" href="<?php echo site_url() . '/admin/notifications'; ?>" data-toggle="modal" data-target="#myModal0">Notifications
                                        <span class="badge" style="background-color: red;"><?php echo $notification_number; ?></span>
                                    </a>
                                <?php endif; ?>
                            </li>                            
                            <li><a title="ออกจากระบบ" href="<?php echo site_url(); ?>/logout"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span> Logout</a></li>
                        </ul>
                    </div><!-- /.navbar-collapse -->
                </div><!-- /.container-fluid -->

            </nav>

            <!-- Modal -->
            <div class="modal fade" id="myModal0" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog"  style="width: 432px;">
                    <div class="modal-content" style="border-radius: 0;"></div>
                </div>
            </div>

