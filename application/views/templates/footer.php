<footer style="text-align: center; margin-top: 15px; margin-bottom: 10px;">
    <p>
        <?php if ($this->session->userdata('email')): ?>
            <a href="<?php echo site_url(); ?>/logout">Logout</a>
        <?php endif; ?>
    </p>
    &copy; 
    <?php
    if (date("Y") == 2014): echo '2014';
    else: echo '2014-' . date("Y");
    endif;
    ?> 
    <a href="http://thep-center.org">thep-center.org</a>
</footer>

</div> <!-- /.container -->
</body>
</html>