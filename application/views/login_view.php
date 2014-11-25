
<section style="background-color: #c0c0c0; padding-top: 10px; padding-bottom: 10px; padding-left: 15px;">
    <form class="form-inline" role="form" method="post" action="<?php echo site_url(); ?>/login/process">
        <div class="input-group" style="margin-right: 15px;">
            <label class="" for="exampleInputEmail2">Email address</label>            
            <input style="border-radius: 0;" type="email" name="email" class="form-control" required id="exampleInputEmail2" placeholder="Email">
        </div>


        <div class="input-group" style="margin-right: 15px;">
            <label class="" for="exampleInputPassword2">Password</label>
            <input style="border-radius: 0;" type="password" name="password" class="form-control" required id="exampleInputPassword2" placeholder="Password"> 
        </div>        


        <div class="input-group" style="margin-top: 25px;">
            <label class="sr-only">Button</label>
            <button type="submit" class="btn btn-default">เข้าสู่ระบบ</button>
        </div>

        <div style="margin-top: 10px;">            
            <input type="checkbox" name="remember"> Remember me
        </div>
    </form>
</section>

<hr>

<section>
    <h3>สมัครใช้งาน</h3>
    <form role="form" class="form-inline" method="post" action="<?php echo site_url(); ?>/register_process">
        <div class="input-group" style="margin-right: 15px;">
            <div class="form-group">
                <div class="input-group" style="margin-right: 15px;">
                    <input style="border-radius: 0;" type="text" name="firstname" class="form-control" required id="firstname" placeholder="ชื่อจริง">
                </div>              

            </div>
            <div class="form-group">                              
                <input style="border-radius: 0;" type="text" name="lastname" class="form-control" required id="lastname" placeholder="นามสกุล">       
            </div>
            <div class="">
                <input class="form-control" type="email" name="email" required placeholder="ป้อนอีเมลอีครั้ง" style="width: 100%; margin-top: 15px;">
            </div>
            <div style="">
                <input class="form-control" type="password" name="password" required placeholder="รหัสผ่านใหม่" style="width: 100%; margin-top: 15px; margin-bottom: 15px;">
            </div>
            <button type="submit" class="btn btn-default btn-lg">สมัครใช้งาน</button>
        </div>
    </form>
</section>
