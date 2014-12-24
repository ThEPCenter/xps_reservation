 
<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: 10px; margin-right: 20px;"><span aria-hidden="true">&times;</span></button>

<h3 style="margin-left: 40px;"><span class="glyphicon glyphicon-globe" aria-hidden="true"></span> รายการแจ้งเตือน</h3>

<ul style="list-style-type: none; -webkit-padding-start: 0;">

    <?php foreach ($q_reserved->result() as $reservation): ?>

        <?php if (!$this->admin_model->is_checked_notification($reservation->reserved_id)): ?>
            <?php $q_user = $this->admin_model->get_user_detail($reservation->user_id); ?>
            <?php
            foreach ($q_user->result() as $user):
                $firstname = $user->firstname;
                $lastname = $user->lastname;
            endforeach;
            ?>

            <li class="notif-list">
                <div style="">
                    <a style="color: #333; display: block; outline: none; padding: 7px 27px 7px 16px;
                       text-decoration: none;
                       " 
                       title="ดูรายระเอียด" href="<?php echo site_url(); ?>/admin/reserved_detail/<?php echo $reservation->reserved_date; ?>/<?php echo $reservation->reserved_id; ?>">
                        คุณ <strong><?php echo $firstname . ' ' . $lastname; ?></strong>
                        จองคิววันที่ <strong><?php echo $reservation->reserved_date; ?></strong>
                        <br>
                        <span style="color: #9197a3;" class="glyphicon glyphicon-pencil" aria-hidden="true"></span> <abbr style="font-size: 12px; color: #9197a3; cursor: context-menu; border-bottom: none;" title="<?php echo date("l, F d, Y. H:ia", strtotime($reservation->created)); ?>" data-utime="1419389429" data-shorten="1"><?php echo $this->new_date_time->fb_th_time(strtotime($reservation->created)); ?></abbr>
                    </a>
                </div>
            </li>


        <?php endif; ?> 

    <?php endforeach; ?>

</ul>



