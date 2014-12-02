
<section>
    <h2>แก้ไขการจองคิว</h2>
    <h3 style="margin-bottom: 15px;"><?php echo date("l, F j, Y", strtotime($reserved_date)); ?></h3>

    <form role="form" class="form-inline" method="post" action="<?php echo site_url(); ?>/reserve/edit_reserved_process">

        <input type="hidden" name="reserved_id" value="<?php echo $reserved_id; ?>">
        <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
        <input type="hidden" name="reserved_date" value="<?php echo $reserved_date; ?>">
        <div class="form-group">
            <label>ชื่อ</label>
            <div class="input-group" style="margin-right: 15px;">                    
                <input style="border-radius: 0;" type="text" name="firstname" class="form-control" required id="firstname" value="<?php echo $firstname; ?>" disabled>
            </div>
        </div>
        <div class="form-group">
            <label>นามสกุล</label>
            <div class="input-group">
                <input style="border-radius: 0;" type="text" name="lastname" class="form-control" required id="lastname" value="<?php echo $lastname; ?>" disabled>
            </div>
        </div>

        <br>

        <div class="form-group" style="margin-top: 10px;">
            <label>จำนวน Sample</label>
            <div class="input-group" style="margin-right: 15px;">
                <input class="form-control" type="number" name="sample_number" required min="1" max="10" value="<?php echo $sample_number; ?>">
            </div>
        </div>        

        <br>

        <div class="form-group" style="margin-top: 10px;">
            <div class="input-group" style="margin-right: 15px;">
                <textarea class="form-control" name="detail" rows="7" placeholder="รายละเอียด Sample" style="width: 493px;"><?php echo $detail; ?></textarea>
            </div>            
        </div>

        <br>


        <button type="submit" class="btn btn-primary btn-lg" style="margin-top: 10px;"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> ยืนยัน</button> &nbsp;
        <button type="button" class="btn btn-warning btn-lg" style="margin-top: 10px;" onclick="window.history.back();">ยกเลิก</button> &nbsp;
        <button type="button" class="btn btn-danger btn-lg" style="margin-top: 10px;" onclick="window.history.back();"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> ลบการจองนี้</button>
    </form>
</section>