
<h2>รายละเอียดการจองคิว</h2>
<h3 style="margin-bottom: 15px;"><?php echo date("l, F j, Y", strtotime($reserved_date)); ?></h3>
<p><span class="detail-title">ชื่อผู้จอง:</span> <?php echo $firstname; ?> <?php echo $lastname; ?></p>
<p><span class="detail-title">จำนวน Sample:</span> <?php echo $sample_number; ?></p>
<p><span class="detail-title">รายละเอียด Sample:</span> <br> 
    <?php echo nl2br($detail); ?></p>
<p><span class="detail-title">จองเมื่อ:</span> <?php echo $created; ?></p>
<?php if (!empty($updated) && $updated != '0000-00-00 00:00:00'): ?>
    <!-- <p><span class="detail-title">ปรับปรุงข้อมูลเมื่อ:</span> <?php echo $updated; ?></p> -->
<?php endif; ?>

<!-- Button trigger modal -->
<a href="<?php echo site_url() . '/home/calendar'; ?>"><button type="button" class="btn btn-default"><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span> ไปปฏิทิน </button></a> 
&nbsp;
