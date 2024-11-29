<?php include 'header.php'; ?>
<?php include 'menu1.php'; ?>
<!-- START -->
<!--PRICING DETAILS-->
<section class="login-reg">
    <div class="container">
        <div class="row">
            <div class="login-main add-list posr">
                <div class="log-bor">&nbsp;</div>
                <div class="log log-1">
                    <div class="login login-new">
                        <?php
                            if($this->session->flashdata('message'))
                            {
                        ?>
                        <div class="log-suc"><p><?= $this->session->flashdata('message') ?></p></div>
                        <?php
                            }
                        ?>
                        <h4>Upgrade My Plan</h4>
                        <?php
                            $pack_info = $this->db->where('user_id',$this->session->userdata('userid'))->where('plan_status','Active')->get('user_package_purchase')->row();
                            $pack_info1 = $this->db->where('pack_id',$pack_info->plan_id)->get('packages')->row();
                            $pack_info2 = $this->db->where('seq_no >',$pack_info1->seq_no)->get('packages')->result();
                        ?>
                        <p>Hi <?= $user_info->first_name." ".$user_info->last_name ?>, </br>Your Current Plan <b><?= $pack_info1->pack_name; ?></b></br> Expiration date <?= date('d, M Y',strtotime($pack_info->plan_enddate)) ?></p>
                        <form name="plan_change_form" id="plan_change_form" method="post" enctype="multipart/form-data"
                              action="<?= base_url('home/upgrade') ?>">
                            <div class="form-group">
                                <div class="form-group">
                                    <select name="user_plan" required="required" id="user_plan" class="form-control">
                                        <option value="" selected="selected">Choose your plan</option>
                                        <?php
                                            if(!empty($pack_info2))
                                            {
                                                foreach($pack_info2 as $val)
                                                {
                                        ?>
                                        <option value="<?= $val->pack_id ?>" <?php if($_POST['user_plan'] == $val->pack_id){ echo 'selected'; } ?>><?= $val->pack_name ?></option>
                                        <?php
                                                }
                                            }
                                        ?>
                                    </select>
                                    <!--<a href="pricing-details" class="frmtip" target="_blank">Plan details</a>-->
                                </div>
                            </div>
                            <button type="submit" name="plan_type_submit" id="plan_type_submit" class="btn btn-primary">Upgrade</button>
                        </form>
                        <div class="col-md-12">
                            <a href="<?= base_url('dashboard') ?>" class="skip">Go to user dashboard &gt;&gt;</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--END PRICING DETAILS-->
<!-- START -->
<?php
    if($_POST)
    {
?>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<!--<form name='razorpayform' action="verify.php" method="POST">
    <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id">
    <input type="hidden" name="razorpay_signature"  id="razorpay_signature" >
</form>-->
<script>
// Checkout details as a json
var options = {
    "key"               : "<?= $key ?>",
    "amount"            : "<?= $amount ?>",
    "name"              : "J4E",
    "description"       : "J4E",
    "image"             : "https://cdn.razorpay.com/logos/FFATTsJeURNMxx_medium.png",
    "callback_url"      : "<?= base_url('home/upgrade_complete/'.$_POST['user_plan']) ?>",
    "prefill"           : {
    "name"              : "<?= $customer_info->first_name." ".$customer_info->last_name ?>",
    "email"             : "<?= $customer_info->email_address ?>",
    "contact"           : "<?= $customer_info->phone ?>"
    },
    "notes"             : {
    "address"           : "Hello World",
    "merchant_order_id" : "12312321"
    },
    "theme"             : {
    "color"             : "#99cc33"
    },
    "order_id"          : "<?= $order_data['id'] ?>"
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

document.getElementById('plan_type_submit').onclick = function(e){
    rzp.open();
    e.preventDefault();
};
document.getElementById('plan_type_submit').onclick();
</script>
<?php
    }
?>

   <?php include 'footer.php'; ?>     