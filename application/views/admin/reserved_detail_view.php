
<section>
    <h2>ข้อมูลการจองคิว</h2>
    <h3 style="margin-bottom: 15px;"><?php echo date("l, F j, Y", strtotime($reserved_date)); ?></h3>

    <p><span class="detail-title">ชื่อผู้จอง:</span> <a href="<?php echo site_url(); ?>/admin/user_detail/<?php echo $user_id; ?>"><?php echo $firstname; ?> <?php echo $lastname; ?></a></p>

    <?php if ($status != 'holiday' && $status != 'maintenance'): ?>
        <p>จำนวน Sample: <?php echo $sample_number; ?></p>
    <?php endif; ?>

    <?php if ($status != 'holiday' && $status != 'maintenance'): ?>
        <p><span class="detail-title">รายละเอียด Sample:</span> <?php echo $detail; ?></p>
    <?php else: ?>
        <p><span class="detail-title">Status:</span> <?php echo $status; ?></p>
        <p><span class="detail-title">รายละเอียด:</span> <?php echo $detail; ?></p>
    <?php endif; ?>
    <p><span class="detail-title">จองเมื่อ:</span> <?php echo $created; ?></p>
    <p><span class="detail-title">ปรับปรุงข้อมูลเมื่อ:</span> <?php echo $updated; ?></p>

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-wrench" aria-hidden="true"></span> แก้ไข</button> &nbsp;
    <a href="<?php echo site_url() . '/admin/calendar'; ?>"><button type="button" class="btn btn-default"><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span> ไปปฏิทิน</button></a> 
    &nbsp;
    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal2"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> ลบการจองนี้</button>


    <!-- Modal 1 -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalLabel"><span class="glyphicon glyphicon-wrench" aria-hidden="true"></span> แก้ไขการจองคิว <?php echo date("l, F j, Y", strtotime($reserved_date)); ?></h4>
                </div>

                <form role="form" class="form-inline" method="post" action="<?php echo site_url(); ?>/admin/edit_reserved_process">
                    <div class="modal-body">
                        <input type="hidden" name="reserved_id" value="<?php echo $reserved_id; ?>">
                        <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">                    

                        <label>วันที่</label>
                        <input class="form-control" type="text" name="reserved_date" id="datepicker" value="<?php echo date("m/d/Y", strtotime($reserved_date)); ?>" style="margin-bottom: 10px; border-radius: 0;"> 
                        <script>
                            $(function () {
                                $("#datepicker").datepicker();
                            });
                        </script>
                        <br>&nbsp;

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

                        <?php if ($status != 'holiday' && $status != 'maintenance'): ?>
                            <input type="hidden" name="status" value="occupied">
                            <div class="form-group" style="margin-top: 10px;">
                                <label>จำนวน Sample</label>
                                <div class="input-group" style="margin-right: 15px;">
                                    <input class="form-control" type="number" name="sample_number" required min="1" max="10" value="<?php echo $sample_number; ?>">
                                </div>
                            </div>
                            <br>
                        <?php else: ?>
                            <div class="form-group" style="margin-top: 10px;">
                                <label>Status: </label>
                                <div class="input-group" style="margin-right: 15px;">
                                    <select class="form-control" name="status">
                                        <option value="holiday"<?php
                                        if ($status == 'holiday') {
                                            echo ' selected';
                                        }
                                        ?>>holiday (วันหยุดพิเศษ)</option>
                                        <option value="maintenance"<?php
                                        if ($status == 'maintenance') {
                                            echo ' selected';
                                        }
                                        ?>>maintenance</option>
                                        <option value="occupied"<?php
                                        if ($status == 'occupied') {
                                            echo ' selected';
                                        }
                                        ?>>จองแล้ว</option>
                                    </select>
                                </div>
                            </div>
                            <br>
                        <?php endif; ?>

                        <div class="form-group" style="margin-top: 10px;">
                            <div class="input-group" style="margin-right: 15px;">
                                <textarea class="form-control" name="detail" rows="<?php
                                if ($status == 'holiday' || $status == 'maintenance'):echo 1;
                                else: echo 7;
                                endif;
                                ?>" placeholder="รายละเอียด <?php
                                          if ($status != 'holiday' && $status != 'maintenance'):echo 'Sample';
                                          endif;
                                          ?>" style="width: 493px;"><?php echo $detail; ?></textarea>
                            </div>            
                        </div>

                    </div>

                    <div class="modal-footer">                        
                        <button type="button" class="btn btn-default btn-lg"data-dismiss="modal"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> ยกเลิก</button> &nbsp;
                        <button type="submit" class="btn btn-success btn-lg"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> ยืนยัน</button>                        
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal 2 -->
    <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #ca320a; color: white;">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h3 class="modal-title" id="myModalLabel"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> ลบการจอง!</h3>
                </div>
                <div class="modal-body">
                    คุณแน่ใจหรือว่าจะลบการจอง
                    <h4 style="margin-bottom: 15px;"><?php echo date("l, F j, Y", strtotime($reserved_date)); ?></h4>


                    <p>ชื่อผู้จอง: <?php echo $firstname; ?> <?php echo $lastname; ?></p>
                    <?php if ($status != 'holiday' && $status != 'maintenance'): ?>
                        <p>จำนวน Sample: <?php echo $sample_number; ?></p>
                        <p>รายละเอียด Sample: <?php echo $detail; ?></p>
                    <?php else: ?>
                        <p>Status: <?php echo $status; ?></p>
                        <p>รายละเอียด: <?php echo $detail; ?></p>
                    <?php endif; ?>                

                </div>
                <div class="modal-footer">
                    <form method="post" action="<?php echo site_url(); ?>/admin/delete_reserved_process">
                        <input type="hidden" name="reserved_id" value="<?php echo $reserved_id; ?>">
                        <button type="button" class="btn btn-default btn-lg" data-dismiss="modal">ยกเลิก</button> &nbsp;
                        <button type="submit" class="btn btn-danger btn-lg"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> ยืนยันการลบ</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

</section>