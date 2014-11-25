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
                        right: 'month,basicWeek'
                    },
                    defaultDate: '2014-11-12',
                    editable: true,
                    eventLimit: true, // allow "more" link when too many events
                    events: [
                        {
                            title: 'All Day Event',
                            start: '2014-11-01'
                        },
                        {
                            title: 'Long Event',
                            start: '2014-11-07',
                            end: '2014-11-10'
                        },
                        {
                            id: 999,
                            title: 'Repeating Event',
                            start: '2014-11-09T16:00:00'
                        },
                        {
                            id: 999,
                            title: 'Repeating Event',
                            start: '2014-11-16T16:00:00'
                        },
                        {
                            title: 'Conference',
                            start: '2014-11-11',
                            end: '2014-11-13'
                        },
                        {
                            title: 'Meeting',
                            start: '2014-11-12T10:30:00',
                            end: '2014-11-12T12:30:00'
                        },
                        {
                            title: 'Lunch',
                            start: '2014-11-12T12:00:00'
                        },
                        {
                            title: 'Meeting',
                            start: '2014-11-12T14:30:00'
                        },
                        {
                            title: 'Happy Hour',
                            start: '2014-11-12T17:30:00'
                        },
                        {
                            title: 'Dinner',
                            start: '2014-11-12T20:00:00'
                        },
                        {
                            title: 'Birthday Party',
                            start: '2014-11-13T07:00:00'
                        },
                        {
                            title: 'ว่าง',
                            url: 'reservation/2014-11-28',
                            start: '2014-11-28',
                            color: 'white', // an option!
                            textColor: 'black',
                            className: 'unoccupied'
                        },
                        {
                            title: 'จองแล้ว',
                            start: '2014-11-29',
                            color: 'red', // an option!
                            textColor: 'black',
                            className: 'occupied'
                        }


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
            }
            .occupied {
                text-align: center;
                font-size: 16px;
                font-weight: bold;
                cursor: context-menu;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <header style="border: solid 1px silver; margin-bottom: 20px; margin-top: 5px; padding-left: 15px;">
                <h1>XPS</h1>
                <h3>Thailand Center of Excellence in Physics (ThEP)</h3>
            </header>

            <div id="calendar"></div>

            <section>
                <P>&nbsp;</P>
                <h4>
                    *** จองได้สัปดาห์ละ 4 วัน จันทร์-ศุกร์ วันไหนก็ได้<br>
                    สัปดาห์สุดท้ายของเดือน รับ 3 คิว
                </h4>
                <P>&nbsp;</P>
            </section>
