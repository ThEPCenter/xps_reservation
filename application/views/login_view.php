
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

    <div class="">
        <label>
            <input type="checkbox"> Remember me
        </label>
    </div>

</form>

