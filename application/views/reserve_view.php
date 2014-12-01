
<section>
    <h2>จองคิว</h2> 
    <h3 style="margin-bottom: 15px;"><?php echo date("l, F j, Y", $date_stamp); ?></h3>

    <form role="form" class="form-inline" method="post" action="<?php echo site_url(); ?>/reserve/process">
        <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
        <input type="hidden" name="reserved_date" value="<?php echo date("Y-m-d", $date_stamp); ?>">
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
                <input class="form-control" type="number" name="sample_number" required min="1" max="10">
            </div>
        </div>        

        <br>

        <div class="form-group" style="margin-top: 10px;">
            <div class="input-group" style="margin-right: 15px;">
                <textarea class="form-control" name="sample_detail" rows="7" placeholder="รายละเอียด Sample" style="width: 493px;"></textarea>
            </div>            
        </div>

        <br>

        <button type="submit" class="btn btn-default btn-lg" style="margin-top: 10px;">ยืนยัน</button>

    </form>
</section>