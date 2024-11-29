<?php include 'header.php'; ?>
<?php include 'menu1.php'; ?>
<!-- START -->
<!--PRICING DETAILS-->
<section class=" login-reg">
    <div class="container">
        <div class="row">
            <div class="login-main">
                <div class="log-bor">&nbsp;</div>
                <div class="log log-1">
                    <div class="login login-new">
                        <h4>Verify OTP</h4>
                        <form id="login_form" name="login_form" method="post" action="<?= base_url('register') ?>">
                                                        <div class="form-group">
                                <input type="text" autocomplete="off" name="email_id" id="email_id"
                                       class="form-control" placeholder="Enter otp*"
                                       pattern=""
                                       title="Enter otp" value="123456" required>
                            </div>
<!--                            <div class="form-group">
                                <input type="password" name="password" id="password" class="form-control"
                                       placeholder="Enter password*" required
                                       value="m2kzlmkm">
                            </div>-->
                            <button type="submit" name="login_submit" value="submit"
                                    class="btn btn-primary">Submit                           </button>
                        </form>

                       

                    </div>
                </div>
<!--                <div class="log log-2">
                    <div class="login login-new">
                                                <h4>Create an account</h4>
                        <p>Don't have an account? Create your account. It's take less then a minutes</p>
                        <form name="register_form" id="register_form" method="post" action="register_update.php">

                            <input type="hidden" autocomplete="off" name="trap_box" id="trap_box" class="validate">

                            <input type="hidden" autocomplete="off" name="mode_path" value="XeFrOnT_MoDeX_PATHXHU"
                                   id="mode_path" class="validate">

                            <div class="form-group">
                                <input type="text" autocomplete="off" name="first_name" id="first_name"
                                       class="form-control" placeholder="Name">
                            </div>
                            <div class="form-group">
                                <input type="email" autocomplete="off" name="email_id" id="email_id"
                                       class="form-control" placeholder="Email id*"
                                       required>
                            </div>
                            <div class="form-group">
                                <input type="password" name="password" id="password" class="form-control"
                                       placeholder="Password*" required>
                            </div>
                            <div class="form-group">
                                <input type="text" onkeypress="return isNumber(event)" autocomplete="off"
                                       name="mobile_number" id="mobile_number" class="form-control"
                                       placeholder="Phone">
                            </div>
                            <div class="form-group ca-sh-user">
                                <select name="user_type" id="user_type" class="form-control ca-check-plan">
                                    <option value="">User type</option>
                                    <option value="General">General user</option>
                                    <option
                                        value="Service provider">Service provider</option>
                                </select>
                                <a href="user-type" class="frmtip"
                                   target="_blank">User options</a>
                            </div>
                            <div class="form-group ca-sh-plan">
                                <select name="user_plan" id="user_plan" class="form-control">
                                    <option value="" disabled="disabled"
                                            selected="selected">Choose your plan</option>
                                                                            <option
                                            value="1">Free</option>
                                                                                <option
                                            value="2">Standard - $9/year</option>
                                                                                <option
                                            value="3">Premium - $19/year</option>
                                                                                <option
                                            value="4">Premium Plus - $20/year</option>
                                                                        </select>
                                <a href="pricing-details" class="frmtip"
                                   target="_blank">Plan details</a>
                            </div>
                            <button type="submit" name="register_submit"
                                    class="btn btn-primary">Register Now</button>
                        </form>
                                                     SOCIAL MEDIA LOGIN 
                            <div class="soc-log">
                                <ul>
                                                                            <li>
                                             <div class="g-signin2" data-onsuccess="onSignIn"></div> --- old way
                                            <div class="g_id_signin" data-type="standard" data-shape="rectangular" data-theme="filled_blue" data-text="signin_with" data-size="large" data-logo_alignment="left">
                                            </div>
                                        </li>
                                                                                <li>
                                            <a href="javascript:void(0);" onclick="fbLogin();" class="login-fb"><img
                                                    src="images/icon/facebook.png"> Continue with Facebook                                            </a>
                                        </li>
                                        
                                </ul>

                            </div>
                             END SOCIAL MEDIA LOGIN 
                                                </div>
                </div>-->
                
            </div>
        </div>
    </div>
</section>
<!--END PRICING DETAILS-->


	


   <?php include 'footer.php'; ?>     