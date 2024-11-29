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
        <span class="udb-inst">Subscriptions</span>
<!--            <div class="log-error use-act-err">
        <p>
            Important: Your Profile has not been activated yet. Once we done your verification, we email you soon when your account is fully activated.        </p>
    </div>-->
            <div class="ud-cen-s2">
            <h2>Payment History</h2>
                        <table class="responsive-table bordered">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Plan Name</th>
                    <th>Start Date</th>
                    <th>Amount</th>
                    <th>Status</th>
                </tr>
                </thead>
                <tbody>
                    <?php
                        $pack_info = $this->db->where('user_id',$this->session->userdata('userid'))->get('user_package_purchase')->result();
                        if(!empty($pack_info))
                        {
                            $cnt = 1;
                            foreach($pack_info as $val)
                            {
                                $pack_info1 = $this->db->where('pack_id',$val->plan_id)->get('packages')->row();
                    ?>  
                    <tr>
                        <td><?= $cnt ?></td>
                        <td><?= $pack_info1->pack_name ?></td>
                        <td><?= date('d, M Y',strtotime($val->plan_startdate)) ?></td>
                        <td><span class="db-list-rat"><?= '₹'.$pack_info1->pack_price ?></span></td>
                                                    <td><?= $val->plan_status ?></td>
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