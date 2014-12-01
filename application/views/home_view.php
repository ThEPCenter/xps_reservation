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
                        defaultDate: '<?php echo date("Y-m-d"); ?>',
                        editable: false,
                        eventLimit: true, // allow "more" link when too many events
                        events: [

                        {
                        "title": "จองแล้ว",
                                "start": "2014-11-26",
                                "color": "red",
                                "className": "occupied"
                        },
                        {
                        "title": "Maintenance",
                                "start": "2014-11-27",
                                "className": "occupied"
                        },
                        {
                        "title": "ว่าง",
<?php if ($this->session->userdata('level') != 10): ?>
                            "url": "<?php echo site_url(); ?>/reserve/reserved_date/2014-11-28",
<?php endif; ?>
                        "start": "2014-11-28",
                                "color": "white",
                                "textColor": "black",
                                "className": "unoccupied"
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

                <?php if ($this->session->userdata('level') != 10): ?>
                    text-decoration: underline;
                    cursor: pointer;
                <?php else: ?>
                    cursor: context-menu;
                <?php endif; ?>

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
            <header>
                <a href="<?php echo site_url(); ?>">
                    <div class="page-header" style="margin-top: 5px;">
                        <h1 style="margin-top: 5px;">XPS <small>Thailand Center of Excellence in Physics (ThEP)</small></h1>
                    </div>
                </a>
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
