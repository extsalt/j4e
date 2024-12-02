<?php include 'header.php'; ?>
<?php include 'menu1.php'; ?>
<section class=" ud">
    <div class="ud-inn">
        <?php include 'dashboard_menu.php'; ?>
        <div class="ud-main">
            <div class="ud-main-inn">
                <div class="ud-cen">
                    <?php
                    if ($this->session->flashdata('message')) {
                    ?>
                        <div class="log-suc">
                            <p><?= $this->session->flashdata('message') ?></p>
                        </div>
                    <?php
                    }
                    ?>
                    <div class="cd-cen-intr">
                        <div class="cd-cen-intr-inn">
                            <h2>Welcome back, <b><?= $user_info->first_name . " " . $user_info->last_name ?></b></h2>
                            <p>Stay up to date reports in your listing, products, events and blog reports here</p>
                        </div>
                    </div>
                    <div class="ud-cen-s1">
                        <ul>
                            <li>
                                <div>
                                    <b><?= $this->db->where('request_from', $this->session->userdata('userid'))->count_all_results('connection'); ?></b>
                                    <h4>Connections</h4>
                                    <p>Sent</p>
                                    <a href="#">&nbsp;</a>
                                </div>
                            </li>
                            <li>
                                <div>
                                    <b><?= $this->db->where('request_to', $this->session->userdata('userid'))->count_all_results('connection'); ?></b>
                                    <h4>Connections</h4>
                                    <p>Received</p>
                                    <a href="#">&nbsp;</a>
                                </div>
                            </li>
                            <li>
                                <div>
                                    <b><?= $this->db->where('user_id', $this->session->userdata('userid'))->where('is_referral', 0)->where('requirements_status', 1)->count_all_results('requirements'); ?></b>
                                    <h4>Requirements</h4>
                                    <p>-</p>
                                    <a href="#">&nbsp;</a>
                                </div>
                            </li>
                            <li>
                                <div>
                                    <b><?= $this->db->where('user_id !=', $this->session->userdata('userid'))->where('is_referral', 0)->where('requirements_status', 1)->where('status', 1)->count_all_results('requirements'); ?></b>
                                    <h4>Leads</h4>
                                    <p>Open</p>
                                    <a href="#">&nbsp;</a>
                                </div>
                            </li>
                            <li>
                                <div>
                                    <b><?= $this->db->where('user_id !=', $this->session->userdata('userid'))->where('is_referral', 0)->where('requirements_status', 1)->where('status', 2)->count_all_results('requirements'); ?></b>
                                    <h4>Leads</h4>
                                    <p>Closed</p>
                                    <a href="#">&nbsp;</a>
                                </div>
                            </li>
                            <li>
                                <div>
                                    <b><?= $this->db->where('user_id', $this->session->userdata('userid'))->count_all_results('buddies'); ?></b>
                                    <h4>Buddies</h4>
                                    <p>-</p>
                                    <a href="#">&nbsp;</a>
                                </div>
                            </li>
                            <li>
                                <div>
                                    <b><?= $this->db->where('bns_trans_touser', $this->session->userdata('userid'))->count_all_results('business_transaction'); ?></b>
                                    <h4>Business Transaction</h4>
                                    <p>Received</p>
                                    <a href="#">&nbsp;</a>
                                </div>
                            </li>
                            <li>
                                <div>
                                    <b><?= $this->db->where('bns_trans_byuser', $this->session->userdata('userid'))->count_all_results('business_transaction'); ?></b>
                                    <h4>Business Transaction</h4>
                                    <p>Given</p>
                                    <a href="#">&nbsp;</a>
                                </div>
                            </li>
                            <li>
                                <div>
                                    <b><?= $this->db->where('post_userid', $this->session->userdata('userid'))->where('post_status', 1)->count_all_results('postdetail'); ?></b>
                                    <h4>Posts</h4>
                                    <p>-</p>
                                    <a href="#">&nbsp;</a>
                                </div>
                            </li>
                            <li>
                                <div>
                                    <b><?= $this->db->where('userid', $this->session->userdata('userid'))->group_by('recomend_by')->count_all_results('recomendation'); ?></b>
                                    <h4>Recommended To</h4>
                                    <p>Peoples</p>
                                    <a href="#">&nbsp;</a>
                                </div>
                            </li>
                            <li>
                                <div>
                                    <b><?= $this->db->where('userid', $this->session->userdata('userid'))->count_all_results('recomendation'); ?></b>
                                    <h4>Recommended To</h4>
                                    <p>Times</p>
                                    <a href="#">&nbsp;</a>
                                </div>
                            </li>
                            <li>
                                <div>
                                    <b><?= $this->db->where('recomend_by', $this->session->userdata('userid'))->group_by('userid')->count_all_results('recomendation'); ?></b>
                                    <h4>Recommended By</h4>
                                    <p>Peoples</p>
                                    <a href="#">&nbsp;</a>
                                </div>
                            </li>
                            <li>
                                <div>
                                    <b><?= $this->db->where('recomend_by', $this->session->userdata('userid'))->count_all_results('recomendation'); ?></b>
                                    <h4>Recommended By</h4>
                                    <p>Times</p>
                                    <a href="#">&nbsp;</a>
                                </div>
                            </li>
                            <li>
                                <div>
                                    <b><?= $this->db->where('user_id', $this->session->userdata('userid'))->where('status', 1)->count_all_results('ratings_reviews'); ?></b>
                                    <h4>Testimonials</h4>
                                    <p>Received</p>
                                    <a href="#">&nbsp;</a>
                                </div>
                            </li>
                            <li>
                                <div>
                                    <b><?= $this->db->where('reviewed_by', $this->session->userdata('userid'))->where('status', 1)->count_all_results('ratings_reviews'); ?></b>
                                    <h4>Testimonials</h4>
                                    <p>Given</p>
                                    <a href="#">&nbsp;</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <!--RIGHT SECTION-->
                <div class="ud-rhs">
                    <div class="ud-rhs-poin">
                        <div class="ud-rhs-poin1">
                            <h4>Your points</h4>
                            <?php
                            $rewardpoint = $this->db->select('sum(point) as total_reward')->where('userid', $this->session->userdata('userid'))->get('reward_user_point')->row();
                            ?>
                            <span class="count1"><?= $rewardpoint->total_reward ?></span>
                        </div>
                        <div class="ud-rhs-poin2">
                            <h3>Earn more credit points</h3>
                            <p>Use this poins to promote your listing. <a
                                    href="#">Click here</a> for demo </p>
                        </div>
                    </div>
                    <!--    //Total Point Section Ends-->
                    <?php
                    if (!empty($user_info->packages_id)) {
                        $pack_info = $this->db->where('user_id', $this->session->userdata('userid'))->where('plan_status', 'Active')->get('user_package_purchase')->row();
                        $pack_info1 = $this->db->where('pack_id', $pack_info->plan_id)->get('packages')->row();
                        if ($pack_info1) {
                    ?>
                            <div class="ud-rhs-pay">
                                <div class="ud-rhs-pay-inn">
                                    <h3>Payment Information</h3>
                                    <ul>
                                        <li><b>Plan name : </b> <?= $pack_info1->pack_name; ?></li>
                                        <li><b>Start date : </b> <?= date('d, M Y', strtotime($pack_info->plan_startdate)) ?></li>


                                        <li><b>Expiry date : </b> <?= date('d, M Y', strtotime($pack_info->plan_enddate)) ?></li>
                                        <li><b>duration : </b> <?= $pack_info1->pack_duration ?> months</li>

                                        <!--<li><b>Remaining Days: </b> 3652</li>-->
                                        <li><span
                                                class="ud-stat-pay-btn"><b>Checkout cost :</b> <?= '₹' . $pack_info1->pack_price ?></span></li>
                                        <!--                    <li><span
                            class="ud-stat-pay-btn"><b>Payment Status:</b> PENDING</span></li>-->


                                    </ul>
                                    <a href="<?= base_url('home/renew') ?>" class="btn btn2" id="plan_type_submit">Renew</a>
                                    <a href="<?= base_url('home/upgrade') ?>" class="btn btn2">Upgrade</a>

                                </div>
                            </div>
                    <?php
                        }
                    }
                    ?>

                </div>
            </div>
        </div>
    </div>
</section>
<!--END PRICING DETAILS-->
<!-- START -->
<?php
if ($is_renew) {
?>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <!--<form name='razorpayform' action="verify.php" method="POST">
    <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id">
    <input type="hidden" name="razorpay_signature"  id="razorpay_signature" >
</form>-->
    <script>
        // Checkout details as a json
        var options = {
            "key": "<?= $key ?>",
            "amount": "<?= $amount ?>",
            "name": "J4E",
            "description": "J4E",
            "image": "https://cdn.razorpay.com/logos/FFATTsJeURNMxx_medium.png",
            "callback_url": "<?= base_url('home/renew/') ?>",
            "prefill": {
                "name": "<?= $customer_info->first_name . " " . $customer_info->last_name ?>",
                "email": "<?= $customer_info->email_address ?>",
                "contact": "<?= $customer_info->phone ?>"
            },
            "notes": {
                "address": "Hello World",
                "merchant_order_id": "12312321"
            },
            "theme": {
                "color": "#99cc33"
            },
            "order_id": "<?= $order_data['id'] ?>"
        };

        /**
         * The entire list of checkout fields is available at
         * https://docs.razorpay.com/docs/checkout-form#checkout-fields
         */
        //options.handler = function (response){
        //    document.getElementById('razorpay_payment_id').value = response.razorpay_payment_id;
        //    document.getElementById('razorpay_signature').value = response.razorpay_signature;
        //    document.razorpayform.submit();
        //};

        // Boolean whether to show image inside a white frame. (default: true)
        //options.theme.image_padding = false;

        var rzp = new Razorpay(options);

        document.getElementById('plan_type_submit').onclick = function(e) {
            rzp.open();
            e.preventDefault();
        };
        document.getElementById('plan_type_submit').onclick();
    </script>
<?php
}
?>

<?php include 'footer.php'; ?>