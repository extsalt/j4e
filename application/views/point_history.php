<?php include 'header.php'; ?>
<?php include 'menu1.php'; ?>
<!-- START -->
<!--PRICING DETAILS-->
<section class=" ud">
    <div class="ud-inn">
        <!--LEFT SECTION-->
        <?php include 'dashboard_menu.php'; ?><!--CENTER SECTION-->
<div class="ud-main">
   <div class="ud-main-inn ud-no-rhs">
<div class="ud-cen">
        <div class="log-bor">&nbsp;</div>
        <span class="udb-inst">Points History</span>
<!--            <div class="log-error use-act-err">
        <p>
            Important: Your Profile has not been activated yet. Once we done your verification, we email you soon when your account is fully activated.        </p>
    </div>-->
            <div class="ud-cen-s2">
            <h2>Points History</h2>
                        <!--<a href="buy-points" class="db-tit-btn">Buy More Points</a>-->
            <table class="responsive-table bordered">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Date</th>
                    <th>Reward</th>
                    <th>Activity</th>
                    <th>Points</th>

                </tr>
                </thead>
                <tbody>
                    <?php
                        $point_info = $this->db->where('userid',$this->session->userdata('userid'))->get('reward_user_point')->result();
                        if(!empty($point_info))
                        {
                            $cnt = 1;
                            foreach($point_info as $val)
                            {
                                $reward_info = $this->db->where('id',$val->rewardid)->get('reward_point')->row();
                    ?>
                    <tr>
                        <td><?= $cnt ?></td>
                        <td><?= date('d, M Y',strtotime($val->date)) ?></td>
                        <td><?= $reward_info->activity ?></td>
                        <td><?= $val->activity ?></td>
                        <td><?= $val->point ?></td>
                    </tr>
                    <?php
                                $cnt++;
                            }
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
</section>
<!--END PRICING DETAILS-->
<!-- START -->


   <?php include 'footer.php'; ?>     