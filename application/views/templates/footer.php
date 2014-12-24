

<footer style="margin-top: 15px; margin-bottom: 10px;">

    <span style="cursor: pointer; text-decoration: underline;" data-toggle="modal" data-target=".bs-example-modal-lg">ข้อตกลงและเงื่อนไข</span>
    <!-- Large modal -->
    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">                        
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalLabel">ข้อตกลงและเงื่อนไข</h4>
                </div>
                <div class="modal-body">

                    <p> ... ผู้ดูแลเครื่อง XPS สามารถ แก้ไข ย้าย หรือยกเลิก คิวที่จอง โดยไม่จำเป็นต้องแจ้งให้ทราบล่วงหน้า ...</p>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <p>&nbsp;</p>
    
    <p style="text-align: center;">
        &copy; 
        <?php
        if (date("Y") == 2014): echo '2014';
        else: echo '2014-' . date("Y");
        endif;
        ?> 
        <a target="_blank" href="http://thep-center.org">thep-center.org</a>
    </p>

</footer>

</div> <!-- /.container -->
</body>
</html>