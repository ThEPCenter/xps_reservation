
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
<!-- Button trigger modal -->
<button class="btn btn-warning" data-toggle="modal" data-target="#editTitle">แก้ไขการจองคิว</button>

<!-- Modal -->
<div class="modal fade" id="editTitle" tabindex="-1" role="dialog" aria-labelledby="editTitle" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">การแก้ไขรายละเอียดการจอง</h4>
            </div>
            <div class="modal-body">
                สามารถ<strong>แก้ไข</strong>รายละเอียดหรือ<strong>ยกเลิก</strong>การจอง ได้ที่ <strong>087-7250960</strong> หรือ <strong>chanvit82@hotmail.com</strong> ในวันและเวลาราชการ
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
