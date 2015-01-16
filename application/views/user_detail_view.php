
<section>
    <h2><span class="glyphicon glyphicon-user" aria-hidden="true"></span> ข้อมูลผู้ใช้</h2>
    <p><span class="detail-title">ชื่อและนามสกุล:</span> <?php echo $firstname . ' ' . $lastname; ?></p>
    <p><span class="detail-title">Email:</span> <?php echo $email; ?></p>
    <p><span class="detail-title">โทรศัพท์:</span> <?php echo $phone; ?></p>
    <p><span class="detail-title">เข้าใช้งานครั้งล่าสุด:</span> <?php echo $recent_login; ?></p>
    <p><span class="detail-title">ตำแหน่ง/อาชีพ:</span> 
        <?php if ($position == 'other'): ?>
            <?php echo $detail; ?>
        <?php else: ?>
            <?php echo $position_thai; ?>
        <?php endif; ?>
    </p>
    <?php if (!empty($supervisor)): ?>
        <p><span class="detail-title">อาจารย์ที่ปรึกษา:</span> <?php echo $supervisor; ?></p>
    <?php endif; ?>
    <p><span class="detail-title">สถาบัน/หน่วยงาน:</span> <?php echo $institute; ?></p>

    <!-- Button trigger modal -->
    <?php if ($this->session->userdata('user_id') == $user_id): ?>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal" style="margin-top: 10px;">
            <span class="glyphicon glyphicon-wrench" aria-hidden="true"></span> แก้ไขข้อมูล
        </button> &nbsp;
    <?php endif; ?>

    <a href="<?php echo site_url(); ?>/admin/calendar">
        <button type="button" class="btn btn-default" style="margin-top: 10px;">
            <span class="glyphicon glyphicon-calendar" aria-hidden="true"></span> ไปปฏิทิน
        </button>
    </a>

    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalLabel"><span class="glyphicon glyphicon-wrench" aria-hidden="true"></span> แก้ไขข้อมูลส่วนตัว</h4>
                </div>
                <div class="modal-body">
                    <form role="form" class="form-inline" method="post" action="<?php echo site_url(); ?>/user/edit_user_detail">
                        <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                        <div class="input-group" style="margin-right: 15px;">
                            <div class="form-group">
                                <div class="input-group" style="margin-right: 15px;">
                                    <input style="border-radius: 0;" type="text" name="firstname" class="form-control" required id="firstname" placeholder="ชื่อจริง" value="<?php echo $firstname; ?>">
                                </div>
                            </div>
                            <div class="form-group">                              
                                <input style="border-radius: 0;" type="text" name="lastname" class="form-control" required id="lastname" placeholder="นามสกุล" value="<?php echo $lastname; ?>">       
                            </div>
                            <div>
                                <input class="form-control register_email" type="email" name="email" required disabled placeholder="อีเมล" style="width: 100%; margin-top: 15px; margin-bottom: 5px;" value="<?php echo $email; ?>">
                            </div>                            
                            <div>
                                <input class="form-control" type="text" name="phone" required placeholder="โทรศัพท์" style="width: 100%; margin-top: 15px; margin-bottom: 15px;" value="<?php echo $phone; ?>">            
                            </div>

                            <div style="margin-bottom: 15px;">
                                <h4>อาชีพ / ตำแหน่ง</h4>
                                <select class="form-control" required name="position" id="position" style="width: 100%; margin-bottom: 10px;">
                                    <option value="researcher"<?php
                                    if ($position == 'researcher'): echo ' selected';
                                    endif;
                                    ?>>นักวิจัย</option>
                                    <option value="instructor"<?php
                                    if ($position == 'instructor'): echo ' selected';
                                    endif;
                                    ?>>อาจารย์</option>
                                    <option value="student"<?php
                                    if ($position == 'student'): echo ' selected';
                                    endif;
                                    ?>>นักศึกษา</option>
                                    <option value="other"<?php
                                    if ($position == 'other'): echo ' selected';
                                    endif;
                                    ?>>อื่นๆ</option>
                                </select>

                                <label>- ถ้าเลือก อื่นๆ</label>
                                <input class="form-control" name="detail" id="detail" style="width: 100%; margin-bottom: 10px;" placeholder="&nbsp;โปรดระบุ อาชีพ / ตำแหน่ง" value="<?php echo $detail; ?>">
                                <br>

                                <label>- ถ้าเลือก นักศึกษา / นักวิจัย</label>
                                <input class="form-control" name="supervisor" id="supervisor" style="width: 100%; margin-bottom: 10px;" placeholder="&nbsp;โปรดระบุ ชื่ออาจารย์ที่ปรึกษา / supervisor (ถ้ามี)" value="<?php echo $supervisor; ?>">
                                <br>

                                <label><span style="color: red;">**</span>สถาบัน / มหาวิทยาลัย / หน่วยงาน</label>
                                <input class="form-control" name="institute" id="institute" required style="width: 100%; margin-bottom: 10px;" value="<?php echo $institute; ?>">

                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-success btn-lg"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> ยืนยัน</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <p>&nbsp;</p>

    <h3><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> รายการ จองคิว</h3>
    <table class="table table-bordered">
        <tr>
            <th>วันที่จอง</th>
            <th>จำนวน Sample</th>
            <th>รายละเอียด Sample</th>
            <th>จองเมื่อ</th>
            <th>ปรับปรุงข้อมูลเมื่อ</th>
        </tr>
        <?php if ($q_reservation->num_rows() == 0): ?>
            <tr>
                <td colspan="5" style="text-align: center;">-- ไม่มีข้อมูลการจอง --</td>
            </tr>
        <?php else: ?>
            <?php foreach ($q_reservation->result() as $reservation): ?>
                <tr>
                    <td>
                        <a title="ดูรายระเอียด" href="<?php echo site_url(); ?>/reserve/reserved_detail/<?php echo $reservation->reserved_date; ?>">
                            <?php echo $reservation->reserved_date; ?>
                        </a>
                    </td>
                    <td style="text-align: center;"><?php echo $reservation->sample_number; ?></td>
                    <td><?php echo nl2br($reservation->detail); ?></td>
                    <td style="text-align: center;"><?php echo $reservation->created; ?></td>
                    <td style="text-align: center;"><?php echo $reservation->updated; ?></td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </table>

</section>
