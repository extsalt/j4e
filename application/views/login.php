<?php include 'header.php'; ?>
<?php include 'menu1.php'; ?>
<!-- START -->
<!--PRICING DETAILS-->

<section class=" login-reg">
    <div class="container">
        <div class="row">
            <div class="login-main">
                <div class="log-bor">&nbsp;</div>
                <div class="log log-1" <?php if ($_POST) {
                                            echo 'style="display:none;"';
                                        } ?>>

                    <div class="login login-new">
                        <?php
                        if ($this->session->flashdata('message')) {
                        ?>
                            <div class="log-suc">
                                <p><?= $this->session->flashdata('message') ?></p>
                            </div>
                        <?php
                        }
                        ?>
                        <h4>Member Login</h4>
                        <p id="errotp" style="color: red;"></p>
                        <form id="login_form" name="login_form" method="post" action="">
                            <div class="form-group">
                                <input type="text" autocomplete="off" name="email_id" id="email_id"
                                    class="form-control numinput" placeholder="Enter mobile*"
                                    pattern="" size="10" maxlength="10"
                                    title="Enter Mobile Number" value="" required>
                            </div>
                            <button type="button" name="login_submit" value="submit"
                                class="btn btn-primary" onclick="getSendOTP()">Submit </button>
                        </form>



                    </div>
                </div>
                <div class="log log-11" style="display: none;">
                    <div class="login login-new">
                        <h4>Enter OTP</h4>
                        <p>Please Enter OTP sent on below mobile number.</p>
                        <p id="errotp1" style="color: red;"></p>
                        <form id="login_form1" name="login_form" method="post" action="">
                            <div class="form-group">
                                <input type="text" autocomplete="off" name="email_id1" id="email_id1"
                                    class="form-control numinput" placeholder="Enter mobile*"
                                    pattern=""
                                    title="Enter Mobile Number" value="" required readonly="">
                            </div>
                            <div class="form-group">
                                <input type="password" name="password" id="password" class="form-control numinput"
                                    placeholder="Enter OTP*" required
                                    value="" size="4" maxlength="4">
                            </div>
                            <button type="button" name="login_submit" value="submit"
                                class="btn btn-primary" onclick="getVerifyOTP()">Submit </button>
                        </form>



                    </div>
                    <div class="log-bot">
                        <ul>
                            <li>
                                Didn't get OTP? <span class="ll-1">Resend Now</span>
                            </li>
                            <!--                        <li>
                            <span class="ll-2">Create an account?</span>
                        </li>
                        <li>
                            <span class="ll-3">Forgot password?</span>
                        </li>-->
                        </ul>
                    </div>
                </div>
                <div class="log log-2" <?php if (!$_POST) {
                                            echo 'style="display:none;"';
                                        } ?>>
                    <div class="login login-new">
                        <h4>Create an account</h4>
                        <p>Don't have an account? Create your account. It's take less then a minutes</p>
                        <form name="register_form" id="register_form" method="post" action="<?= base_url('login') ?>">
                            <div class="form-group">
                                <input type="text" autocomplete="off" name="first_name" id="first_name"
                                    class="form-control" placeholder="First Name*" required="" value="<?= $this->session->userdata('register_details')['first_name'] ?>">
                            </div>
                            <div class="form-group">
                                <input type="text" autocomplete="off" name="middle_name" id="middle_name"
                                    class="form-control" placeholder="Middle Name" value="<?= $this->session->userdata('register_details')['middle_name'] ?>">
                            </div>
                            <div class="form-group">
                                <input type="text" autocomplete="off" name="last_name" id="last_name"
                                    class="form-control" placeholder="Last Name*" required="" value="<?= $this->session->userdata('register_details')['last_name'] ?>">
                            </div>
                            <div class="form-group">
                                <input type="email" autocomplete="off" name="email_address" id="email_id"
                                    class="form-control" placeholder="Email id*"
                                    required value="<?= $this->session->userdata('register_details')['email_address'] ?>">
                            </div>
                            <div class="form-group">
                                <input type="text" autocomplete="off" name="company" id="company"
                                    class="form-control" placeholder="Company" value="<?= $this->session->userdata('register_details')['company'] ?>">
                            </div>
                            <div class="form-group">
                                <input type="text" autocomplete="off" name="designation" id="designation"
                                    class="form-control" placeholder="Designation" value="<?= $this->session->userdata('register_details')['designation'] ?>">
                            </div>
                            <div class="form-group">
                                <input type="text" onkeypress="return isNumber(event)" autocomplete="off"
                                    name="mobile_number" id="mobile_number" class="form-control numinput"
                                    placeholder="Phone" readonly="" value="<?= $this->session->userdata('register_details')['mobile_number'] ?>">
                            </div>
                            <div class="form-group">
                                <input type="text" onkeypress="return isNumber(event)" autocomplete="off"
                                    name="wmobile" id="wmobile" class="form-control numinput" required="" size="10" maxlength="10"
                                    placeholder="Whatsapp Number*" value="<?= $this->session->userdata('register_details')['wmobile'] ?>">
                            </div>
                            <div class="form-group">
                                <input type="text" onkeypress="return isNumber(event)" autocomplete="off"
                                    name="company_contact" id="landline" class="form-control numinput" size="10" maxlength="10"
                                    placeholder="Office Phone Number" value="<?= $this->session->userdata('register_details')['company_contact'] ?>">
                            </div>
                            <div class="form-group">
                                <input type="text" autocomplete="off" name="company_address" id="address"
                                    class="form-control" placeholder="Address" value="<?= $this->session->userdata('register_details')['company_address'] ?>">
                            </div>
                            <div class="form-group">
                                <input type="text" onkeypress="return isNumber(event)" autocomplete="off"
                                    name="referral_mobile" id="referral_mobile" class="form-control numinput" size="10" maxlength="10"
                                    placeholder="Referral Mobile Number" onkeyup="getReferredBy(this.value)" value="<?= $this->input->post('referral_mobile') ?>">
                                <p id="err_ref" style="color:red;text-align: left;"></p>
                            </div>
                            <input type="hidden" name="referred_by" id="referred_by" value="<?= $this->session->userdata('register_details')['referred_by'] ?>">
                            <div class="form-group">
                                <select name="packages_id" id="user_plan" class="form-control" required="">
                                    <option value=""
                                        selected="selected">Choose your plan*</option>
                                    <?php
                                    $pack_info = $this->db->get('packages')->result();
                                    if (!empty($pack_info)) {
                                        foreach ($pack_info as $val) {
                                    ?>
                                            <option value="<?= $val->pack_id ?>" <?php if ($this->session->userdata('register_details')['packages_id'] == $val->pack_id) {
                                                                                        echo 'selected';
                                                                                    } ?>><?= $val->pack_name ?></option>
                                    <?php
                                        }
                                    }
                                    ?>
                                </select>

                            </div>
                            <button type="submit" name="register_submit" id="register_submit"
                                class="btn btn-primary">Register Now</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
<!--END PRICING DETAILS-->
<?php
if ($_POST) {
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
            "callback_url": "<?= base_url('home/register') ?>",
            "prefill": {
                "name": "<?= $customer_info['name'] ?>",
                "email": "<?= $customer_info['email'] ?>",
                "contact": "<?= $customer_info['phone'] ?>"
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

        document.getElementById('register_submit').onclick = function(e) {
            rzp.open();
            e.preventDefault();
        };
        document.getElementById('register_submit').onclick();
    </script>
<?php
}
?>




<?php include 'footer.php'; ?>