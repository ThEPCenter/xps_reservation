<h2><?php echo $title; ?></h2>
<p>Email: <?php echo $email; ?></p>
<p>Password: <?php echo $password; ?></p>
<p>ชื่อ-นามสกุล: <?php echo $firstname . ' ' . $lastname; ?></p>
<p>โทรศัพท์: <?php echo $phone; ?></p>
<p>ตำแหน่ง / สถานภาพ: 
    <?php
    if (!empty($detail)):
        echo $detail;
    else:
        echo $position;
    endif;
    ?>
</p>
<?php if (!empty($supervisor)): ?>
    <p>อาจารย์ที่ปรึกษา / supervisor: <?php echo $supervisor; ?></p>
<?php endif; ?>

    <p>สถาบัน / หน่วยงาน / องกรค์: <?php echo $institute; ?></p>

<p>&nbsp;</p>

<button type="button" class="btn btn-danger" onclick="window.location = '<?php echo site_url(); ?>/login';"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> ยกเลิกการสมัคร</button> 
<form method="post" action="" style="display: inline;">
    <button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-wrench" aria-hidden="true"></span> แก้ไขข้อมูล</button>
</form>

<form method="post" action="<?php echo site_url(); ?>/register/process" style="display: inline;">
    <input type="hidden" name="email" value="<?php echo $email; ?>">
    <input type="hidden" name="password" value="<?php echo $password; ?>">
    <input type="hidden" name="firstname" value="<?php echo $firstname; ?>">
    <input type="hidden" name="lastname" value="<?php echo $lastname; ?>">
    <input type="hidden" name="phone" value="<?php echo $phone; ?>">
    <input type="hidden" name="position" value="<?php echo $position; ?>">
    <input type="hidden" name="detail" value="<?php echo $detail; ?>">
    <input type="hidden" name="supervisor" value="<?php echo $supervisor; ?>">
    <input type="hidden" name="institute" value="<?php echo $institute; ?>">

    <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> ยืนยันข้อมูล</button>
</form>
