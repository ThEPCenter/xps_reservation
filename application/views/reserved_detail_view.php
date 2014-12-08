
<section>
    <h2>รายละเอียดการจองคิว</h2>
    <h3 style="margin-bottom: 15px;"><?php echo date("l, F j, Y", strtotime($reserved_date)); ?></h3>

    <p>ชื่อผู้จอง: <?php echo $firstname; ?> <?php echo $lastname; ?></p>
    <p>จำนวน Sample: <?php echo $sample_number; ?></p>
    <p>รายละเอียด Sample: <?php echo $detail; ?></p>

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-wrench" aria-hidden="true"></span> แก้ไข</button> &nbsp;
    <a href="<?php echo site_url() . '/home/calendar'; ?>"><button type="button" class="btn btn-default btn-lg"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> ไปปฏิทิน </button></a> 
    &nbsp;
    <button type="button" class="btn btn-danger btn-lg" data-toggle="modal" data-target="#myModal2"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> ลบการจองนี้</button>


    <!-- Modal 1 -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalLabel">แก้ไขการจองคิว <?php echo date("l, F j, Y", strtotime($reserved_date)); ?></h4>
                </div>

                <form role="form" class="form-inline" method="post" action="<?php echo site_url(); ?>/reserve/edit_reserved_process">
                    <div class="modal-body">
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

                    </div>

                    <div class="modal-footer">                        
                        <button type="submit" class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> ยืนยัน</button> &nbsp;
                        <button type="button" class="btn btn-default btn-lg"data-dismiss="modal"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> ยกเลิก</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal 2 -->
    <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h3 class="modal-title" id="myModalLabel">ลบการจอง!</h3>
                </div>
                <div class="modal-body">
                    คุณแน่ใจหรือว่าจะลบการจอง
                    <h4 style="margin-bottom: 15px;"><?php echo date("l, F j, Y", strtotime($reserved_date)); ?></h4>


                    <p>ชื่อผู้จอง: <?php echo $firstname; ?> <?php echo $lastname; ?></p>
                    <p>จำนวน Sample: <?php echo $sample_number; ?></p>
                    <p>รายละเอียด Sample: <?php echo $detail; ?></p>

                </div>
                <div class="modal-footer">
                    <form method="post" action="<?php echo site_url(); ?>/reserve/delete_reserved_process">
                        <input type="hidden" name="reserved_id" value="<?php echo $reserved_id; ?>">
                        <button type="button" class="btn btn-default btn-lg" data-dismiss="modal">ยกเลิก</button> &nbsp;
                        <button type="submit" class="btn btn-danger btn-lg"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> ยืนยันการลบ</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

</section>