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
            <header style="border: solid 1px silver; margin-bottom: 20px; margin-top: 10px; padding-left: 15px;">
                <h1>XPS</h1>
                <h3>Thailand Center of Excellence in Physics (ThEP)</h3>
            </header>