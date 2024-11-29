<?php include 'header.php'; ?>
<?php include 'menu1.php'; ?>

    <!-- START -->
<section class=" con-us-map">
    <iframe
        src="<?= $website_setting->map_link ?>"
        allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
</section>
<!--END-->

<!-- START -->
<section class=" con-us-loc">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="tit">
                    <h2>Contact Us</h2>
                    <!--<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration</p>-->
                </div>
            </div>
            <div class="col-md-4">
                <div class="con-pg-addr ">
                    <h4>Address:</h4>
                    <!--<h5>United States:</h5>-->
                    <p><?= $website_setting->address ?></p>
<!--                    <h5>India:</h5>
                    <p>28800 Orchard Lake Road, Suite 180 Farmington, Chennai, India</p>-->
                </div>
            </div>
            <div class="col-md-4">
                <div class="con-pg-info">
                    <h4>Contact info:</h4>
                    <ul>
                        <li class="ic-pho">Support: <?= $setting->support_no ?></li>
                        <!--<li class="ic-pho">Enquiry: +01 9867 4326</li>-->
                        <li class="ic-eml">Email: <?= $website_setting->support_mail ?></li>
                        <!--<li class="ic-eml">Email: support@company.com</li>-->
                    </ul>
                </div>
            </div>
            <div class="col-md-4">
                <div class="con-pg-soc">
                    <h4>Website & Social media:</h4>
                    <ul>
                        <!--<li class="ic-man-web"><a href="https://just4entrepreneurs.com/" target="_blank">www.just4entrepreneurs.com</a></li>-->
                        <li class="ic-man-fb"><a href="<?= $website_setting->fb_link ?>" target="_blank">Facebook</a></li>
                        <li class="ic-man-tw"><a href="<?= $website_setting->in_link ?>" target="_blank">Linkedin</a></li>
                        <li class="ic-man-tw"><a href="<?= $website_setting->yt_link ?>" target="_blank">Youtube</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!--END-->

   <?php include 'footer.php'; ?>     