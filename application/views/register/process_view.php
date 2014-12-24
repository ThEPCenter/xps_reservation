
<h2><?php echo $title; ?></h2>
<p>&nbsp;</p>
<p><strong>Email:</strong> <?php echo $email; ?></p>
<p><strong>Password:</strong> <?php echo $password; ?></p>
<p><strong>ชื่อ-นามสกุล:</strong> <?php echo $firstname . ' ' . $lastname; ?></p>
<p><strong>โทรศัพท์:</strong> <?php echo $phone; ?></p>
<p><strong>ตำแหน่ง / สถานภาพ:</strong> 
    <?php
    if (!empty($detail)):
        echo $detail;
    else:
        echo $position;
    endif;
    ?>
</p>
<?php if (!empty($supervisor)): ?>
    <p><strong>อาจารย์ที่ปรึกษา / supervisor:</strong> <?php echo $supervisor; ?></p>
<?php endif; ?>

<p><strong>สถาบัน / หน่วยงาน / องกรค์:</strong> <?php echo $institute; ?></p>

<p>&nbsp;</p>

<button type="button" class="btn btn-danger" onclick="window.location = '<?php echo site_url(); ?>/login';"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> ยกเลิกการสมัคร</button> 

<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editModal"><span class="glyphicon glyphicon-wrench" aria-hidden="true"></span> แก้ไขข้อมูล</button>

<button type="button" class="btn btn-success" data-toggle="modal" data-target="#confirmModal"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> ยืนยันข้อมูล</button>

<form method="post" action="<?php echo site_url(); ?>/register/process" style="display: inline;">


</form>

<!-- editModal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel"><span class="glyphicon glyphicon-wrench" aria-hidden="true"></span> แก้ไขข้อมูลการสมัคร</h4>
            </div>
            <div class="modal-body">
                <form role="form" class="form-inline" method="post" action="<?php echo site_url(); ?>/register/data_confirmation">

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
                            <input class="form-control register_email" type="email" name="email" required placeholder="อีเมล" style="width: 100%; margin-top: 15px; margin-bottom: 5px;" value="<?php echo $email; ?>">
                        </div>
                        <button type="button" id="check_email">Check email</button>&nbsp;<span id="check_result"></span>
                        <script>
                            $(function () {

                                $("#check_email").click(function () {
                                    $(document).ajaxStart(function () {
                                        $("#check_result").html("<img src=\"<?php echo base_url(); ?>images/indicator_big.gif\">");
                                    });
                                    $.ajax({
                                        url: "<?php echo site_url(); ?>/register/check_email",
                                        data: {
                                            register_email: $(".register_email").val()
                                        },
                                        success: function (data) {
                                            $("#check_result").html(data);
                                        }
                                    });
                                });

                                $(".register_email").focusout(function () {
                                    $(document).ajaxStart(function () {
                                        $("#check_result").html("<img src=\"<?php echo base_url(); ?>images/indicator_big.gif\">");
                                    });
                                    $.ajax({
                                        url: "<?php echo site_url(); ?>/register/check_email",
                                        data: {
                                            register_email: $(".register_email").val()
                                        },
                                        success: function (data) {
                                            $("#check_result").html(data);
                                        }
                                    });
                                });

                            });
                        </script>

                        <div>
                            <input class="form-control" type="text" name="password" required placeholder="password" style="width: 100%; margin-top: 15px; margin-bottom: 15px;" value="<?php echo $password; ?>">            
                        </div>
                        <div>
                            <input class="form-control" type="text" name="phone" required placeholder="โทรศัพท์" style="width: 100%; margin-top: 15px; margin-bottom: 15px;" value="<?php echo $phone; ?>">            
                        </div>

                        <div style="margin-bottom: 15px;">
                            <h4>ตำแหน่ง / สถานภาพ</h4>
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

                            <label><span style="color: red;">**</span>สถาบัน / หน่วยงาน / องกรค์</label>
                            <input class="form-control" name="institute" id="institute" required style="width: 100%; margin-bottom: 10px;" value="<?php echo $institute; ?>">

                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success btn-lg"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> ยืนยันการแก้ไข</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /editModal -->

<!-- confirmModal -->
<div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h3 class="modal-title" id="myModalLabel">ยืนยันการสมัคร</h3>
            </div>
            <div class="modal-body">
                <h3>หากคุณได้ตรวจสอบข้อมูลการสมัครและต้องการที่จะส่งข้อมูลการสมัคร กรุณาคริก ยืนยันการสมัคร</h3>
                <form role="form" class="form-inline" method="post" action="<?php echo site_url(); ?>/register/process">
                    <input type="hidden" name="email" value="<?php echo $email; ?>">
                    <input type="hidden" name="password" value="<?php echo $password; ?>">
                    <input type="hidden" name="firstname" value="<?php echo $firstname; ?>">
                    <input type="hidden" name="lastname" value="<?php echo $lastname; ?>">
                    <input type="hidden" name="phone" value="<?php echo $phone; ?>">
                    <input type="hidden" name="position" value="<?php echo $position; ?>">
                    <input type="hidden" name="detail" value="<?php echo $detail; ?>">
                    <input type="hidden" name="supervisor" value="<?php echo $supervisor; ?>">
                    <input type="hidden" name="institute" value="<?php echo $institute; ?>">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-lg" data-dismiss="modal"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> ยกเลิก</button>
                        <button type="submit" class="btn btn-success btn-lg"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> ยืนยันการสมัคร</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /confirmModal -->
