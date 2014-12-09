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

        <script src="<?php echo base_url(); ?>js/script.js"></script> 

    </head>
    <body>
        <div class="container">
            <header>
                <a href="<?php echo site_url(); ?>">
                    <div class="page-header" style="margin-top: 5px;">
                        <h1 style="margin-top: 5px;">XPS <small>Thailand Center of Excellence in Physics (ThEP)</small></h1>
                    </div>
                </a>
            </header>

            <?php if ($this->session->userdata('email')): ?>                
                <section style="text-align: right; margin-bottom: 15px;">
                    <strong>สวัสดี คุณ <?php echo $this->session->userdata('firstname') . ' ' . $this->session->userdata('lastname'); ?></strong>
                    <?php if ($this->session->userdata('level') == 10): ?>
                        <?php $user_url = site_url() . '/admin/user_detail/' . $this->session->userdata('user_id'); ?>
                    <?php else: ?>
                        <?php $user_url = site_url() . '/user/user_detail/' . $this->session->userdata('user_id'); ?>
                    <?php endif; ?>                    
                    <a title="ข้อมูลส่วนตัว" href="<?php echo $user_url; ?>"><button type="button" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> ข้อมูลส่วนตัว</button></a>
                    <a title="ออกจากระบบ" href="<?php echo site_url(); ?>/logout"><button type="button" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span> Logout</button></a>
                </section>
            <?php endif; ?>
            