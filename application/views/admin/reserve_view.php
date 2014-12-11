
<section>
    <h2><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> จองคิว</h2> 
    <h3 style="margin-bottom: 15px;"><?php echo date("l, F j, Y", $date_stamp); ?></h3>

    <form role="form" class="form-inline" method="post" action="<?php echo site_url(); ?>/admin/reserve_process">
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
            <label>Status: </label>
            <select class="form-control" name="status">
                <option value="holiday">holiday (วันหยุดพิเศษ)</option>
                <option value="maintenance">maintenance</option>
                <option value="occupied">จอง</option>
            </select> 
        </div>

        <br>

        <div class="form-group" style="margin-top: 10px;">
            <div class="input-group" style="margin-right: 15px;">
                <textarea class="form-control" name="detail" rows="2" placeholder="รายละเอียด" style="width: 493px;"></textarea>
            </div>            
        </div>
        <br>

        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" style="margin-top: 10px;" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> จองคิว</button> &nbsp;
        <button type="button" class="btn btn-default" style="margin-top: 10px;" onclick="window.history.back();"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> ยกเลิก</button>


        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title" id="myModalLabel">ยืนยันการจอง XPS</h4>
                    </div>
                    <div class="modal-body">
                        <p>คุณแน่ใจที่จะจองคิวเครื่อง XPS ในวันที่</p>
                        <p><strong><?php echo date("l, F j, Y", $date_stamp); ?></strong></p>       
                        <p>&nbsp;</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success btn-lg"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> ยืนยัน</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</section>