<section class=" wed-hom-footer">
    <div class="container">
        <div class="row foot-supp">
            <h2><span>Free support:</span> <?= $setting->support_no ?> &nbsp;&nbsp;|&nbsp;&nbsp; <span>Email:</span> <?= $website_setting->support_mail ?></h2>
        </div>
        
        <div class="row wed-foot-link-1">
                        <div class="col-md-4">
                <h4>Get In Touch</h4>
                <p>Address: <?= $website_setting->address ?></p>
                <p>Phone: <a href="tel:+01 5426 24400"><?= $setting->support_no ?></a></p>
                <p>Email: <a href="mailto:rn53themes@gmail.com"><?= $website_setting->support_mail ?></a></p>
            </div>
                                    <div class="col-md-4 fot-app">
                <h4>DOWNLOAD OUR FREE MOBILE APPS</h4>
                <ul>
                    <li><a href="<?= $website_setting->android_link ?>"><img src="<?= base_url('assets/') ?>images/gstore.png" alt="" loading="lazy"></a>
                    </li>
<!--                    <li><a href="<?= $website_setting->ios_link ?>"><img src="<?= base_url('assets/') ?>images/astore.png" alt="" loading="lazy"></a>
                    </li>-->
                </ul>
            </div>
                        <div class="col-md-4 fot-soc">
                <h4>SOCIAL MEDIA</h4>
                <ul>
                    <li><a target="_blank" href="<?= $website_setting->in_link ?>"><img src="<?= base_url('assets/') ?>images/social/1.png" alt="" loading="lazy"></a></li>
                    <!--<li><a target="_blank" href="<?= $website_setting->tw_link ?>"><img src="<?= base_url('assets/') ?>images/social/2.png" alt="" loading="lazy"></a></li>-->
                    <li><a target="_blank" href="<?= $website_setting->fb_link ?>"><img src="<?= base_url('assets/') ?>images/social/3.png" alt="" loading="lazy"></a></li>
                    <!--<li><a target="_blank" href=""><img src="<?= base_url('assets/') ?>images/social/4.png" alt="" loading="lazy"></a></li>-->
                    <li><a target="_blank" href="<?= $website_setting->yt_link ?>"><img src="<?= base_url('assets/') ?>images/social/5.png" alt="" loading="lazy"></a></li>
                </ul>
            </div>
        </div>
                <div class="row foot-count">
            <ul>
                <li><a  href="<?= base_url('about') ?>">About Us</a></li>
                <li><a  href="<?= base_url('contact') ?>">Contact Us</a></li>
                <li><a  href="<?= base_url('privacy_policy') ?>">Privacy Policy</a></li>
                <li><a  href="<?= base_url('terms_conditions') ?>">Terms of use</a></li>
<!--                <li><a target="_blank" href="http://www.domainname.ge">Germany</a></li>
                <li><a target="_blank" href="http://www.domainname.ch">China</a></li>
                <li><a target="_blank" href="http://www.domainname.fr">france</a></li>-->
            </ul>
        </div>
            </div>
</section>

<!-- START -->
<section>
    <div class="cr">
        <div class="container">
            <div class="row">
                <p>Copyright © <?= date('Y') ?> <a href="https://just4entrepreneurs.com" target="_blank">Just4Entrepreneurs</a>. Proudly powered by <a href="https://applexinfotech.com/" target="_blank">Applex Infotech</a></p>
            </div>
        </div>
    </div>
</section>
<!-- END -->

<!-- START -->
<?php
    if ($this->session->userdata('isLogIn'))                                
    {
?>
<div class="fqui-menu">
    <ul>
        <li>
                                                <a href="<?= base_url('dashboard') ?>"
                                                   class="db-lact"><img src="<?= base_url('assets/') ?>images/icon/dbl1.png"
                                                              alt="" loading="lazy"/> My Dashboard</a>
                                            </li>
                                                                                                                                                
                                                <li>
                                                    <a href="<?= base_url('point_history') ?>"
                                                       class=""><img src="<?= base_url('assets/') ?>images/icon/point.png"
                                                                  alt="" loading="lazy"/>Points History</a>
                                                </li>
                                                
                                            <li>
                                                <a href="<?= base_url('edit_profile') ?>"
                                                   class=""><img src="<?= base_url('assets/') ?>images/icon/profile.png"
                                                              alt="" loading="lazy"/>Edit Profile</a>
                                            </li>
                                                                                            
                                                <li>
                                                    <a href="<?= base_url('payments') ?>"
                                                       class=""><img src="<?= base_url('assets/') ?>images/icon/dbl9.png"
                                                                  alt="" loading="lazy">Payment & plan</a>
                                                </li>
                                                
                                            <li>
                                                <a href="<?= base_url('logout') ?>"><img
                                                        src="<?= base_url('assets/') ?>images/icon/dbl12.png"
                                                        alt="" loading="lazy"/>Log Out</a>
                                            </li>
    </ul>
</div>
<?php
    }
?>

<!-- END -->
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="<?= base_url('assets/') ?>js/jquery.min.js"></script>
<script src="<?= base_url('assets/') ?>js/popper.min.js"></script>
<script src="<?= base_url('assets/') ?>js/bootstrap.min.js"></script>
<script src="<?= base_url('assets/') ?>js/jquery-ui.js"></script>
<script src="<?= base_url('assets/') ?>js/select-opt.js"></script>
<!--<script type="text/javascript">var webpage_full_link = 'https://bizbookdirectorytemplate.com/';</script>
<script type="text/javascript">var login_url = 'https://bizbookdirectorytemplate.com/login?src=https://bizbookdirectorytemplate.com/index.php?preview=preview&q=6RVUN4UZZI30O6NC8AT4X3BR1GX3E6S4PPLDNTXAFBQXCPEGZIP3UXDVYKPVX3BR1GX3E6S4PPLDNTXA6RVUN4UZZI30O6NC8AT40BQRIEKF67NSOE0PEPFU&type=1&query=X3BR1GX3E6S4PPLDNTXA6RVUN4UZZI30O6NC8AT40BQRIEKF67NSOE0PEPFU';</script>-->
<script src="<?= base_url('assets/') ?>js/slick.js"></script>
<script src="<?= base_url('assets/') ?>/js/custom.js"></script>
<script src="<?= base_url('assets/') ?>js/jquery.validate.min.js"></script>
<script src="<?= base_url('assets/') ?>js/custom_validation.js"></script>
<script src="<?= base_url('assets/') ?>admin/ckeditor/ckeditor.js"></script>
<script>
    CKEDITOR.replace('product_description');
</script>
<!--<script>
    function getSearchCategories(val) {
        var new_class = '';
        if(val == 1){
             new_class = "ban-search ban-sear-all ser-oly-listing";
        }else if(val == 2){
             new_class = "ban-search ban-sear-all ser-oly-expert";
        }else if(val == 3){
             new_class = "ban-search ban-sear-all ser-oly-job";
        }else if(val == 4){
             new_class = "ban-search ban-sear-all ser-oly-place";
        }else if(val == 5){
             new_class = "ban-search ban-sear-all ser-oly-news";
        }else if(val == 6){
             new_class = "ban-search ban-sear-all ser-oly-event";
        }else if(val == 7){
             new_class = "ban-search ban-sear-all ser-oly-product";
        }else if(val == 8){
             new_class = "ban-search ban-sear-all ser-oly-coupon";
        }else if(val == 9){
            new_class = "ban-search ban-sear-all ser-oly-blog";
        }else{
            new_class = "ban-search ban-sear-all";
        }

        $('.sr-cate').parents('.ban-search').removeClass().addClass(new_class);

        getSearchCities(val);
        $.ajax({
            type: "POST",
            url: "search_category_process.php",
            data: 'type_id=' + val,
            success: function (data) {
                $("#expert-select-search").html(data);
                $('#expert-select-search').trigger("chosen:updated");
            }
        });
    }
    function getSearchCities(val) {
        $.ajax({
            type: "POST",
            url: "search_city_process.php",
            data: 'type_id=' + val,
            success: function (data) {
                $("#city_check").html(data);
                $('#city_check').trigger("chosen:updated");
            }
        });
    }
</script>-->
<script>
    $(window).scroll(function () {
        var scroll = $(window).scrollTop();
        if (scroll >= 250) {
            $(".hom-top").addClass("dmact");
        }
        else {
            $(".hom-top").removeClass("dmact");
        }
    });
    
    $('.travel-sliser').slick({
        infinite: true,
        slidesToShow: 3,
        slidesToScroll: 1,
        autoplay: false,
        autoplaySpeed: 3000,
        responsive: [{
            breakpoint: 992,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
                centerMode: false
            }
        }]

    });
    $('.travel-sliser-auto').slick({
        infinite: true,
        slidesToShow: 3,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 3000,
        responsive: [{
            breakpoint: 992,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
                centerMode: false
            }
        }]

    });

    $('.multiple-items').slick({
        infinite: true,
        slidesToShow: 4,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 3000,
        responsive: [{
            breakpoint: 992,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
                centerMode: false,
            }
        }]

    });
//test
    $('.multiple-items2').slick({
        infinite: true,
        slidesToShow: 5,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 3000,
        responsive: [{
            breakpoint: 992,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
                centerMode: false,
            }
        }]

    });
    
    $('.multiple-items1').slick({
        infinite: true,
        slidesToShow: 3,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 3000,
        responsive: [{
            breakpoint: 992,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
                centerMode: false,
            }
        }]

    });
    // Gallery image hover
    $(".img-wrapper").hover(
        function () {
            $(this).find(".img-overlay").animate({opacity: 1}, 600);
        }, function () {
            $(this).find(".img-overlay").animate({opacity: 0}, 600);
        }
    );

    // Lightbox
    var $overlay = $('<div id="overlay"></div>');
    var $image = $("<img>");
    var $prevButton = $('<div id="prevButton"><i class="material-icons">chevron_left</i></div>');
    var $nextButton = $('<div id="nextButton"><i class="material-icons">chevron_right</i></div>');
    var $exitButton = $('<div id="exitButton"><i class="material-icons">close</i></div>');

    // Add overlay
    $overlay.append($image).prepend($prevButton).append($nextButton).append($exitButton);
    $("#gallery").append($overlay);

    // Hide overlay on default
    $overlay.hide();

    // When an image is clicked
    $(".img-overlay").click(function (event) {
        event.preventDefault();
        var imageLocation = $(this).prev().attr("href");
        $image.attr("src", imageLocation);
        $overlay.fadeIn("slow");
    });

    // When the overlay is clicked
    $overlay.click(function () {
        $(this).fadeOut("slow");
    });

    // When next button is clicked
    $nextButton.click(function (event) {
        $("#overlay img").hide();
        var $currentImgSrc = $("#overlay img").attr("src");
        var $currentImg = $('#image-gallery img[src="' + $currentImgSrc + '"]');
        var $nextImg = $($currentImg.closest(".plac-gal-imag").next().find("img"));
        var $images = $("#image-gallery img");
        if ($nextImg.length > 0) {
            $("#overlay img").attr("src", $nextImg.attr("src")).fadeIn(800);
        } else {
            $("#overlay img").attr("src", $($images[0]).attr("src")).fadeIn(800);
        }
        event.stopPropagation();
    });

    // When previous button is clicked
    $prevButton.click(function (event) {
        $("#overlay img").hide();
        var $currentImgSrc = $("#overlay img").attr("src");
        var $currentImg = $('#image-gallery img[src="' + $currentImgSrc + '"]');
        var $nextImg = $($currentImg.closest(".plac-gal-imag").prev().find("img"));
        $("#overlay img").attr("src", $nextImg.attr("src")).fadeIn(800);
        event.stopPropagation();
    });

    $exitButton.click(function () {
        $("#overlay").fadeOut("slow");
    });
     $('.numinput').on('input', function() {
      this.value = this.value.replace(/(?!^-)[^0-9.]/g, "").replace(/(\..*)\./g, '$1'); 
});
    $(".read-more").click(function(){

            var $elem = $(this).parent().find(".text");
            if($elem.hasClass("short"))
            {
                $elem.removeClass("short").addClass("full");
                $(this).html('<a title="Read Less">...</a>');
            }
            else
            {
                $elem.removeClass("full").addClass("short");
                $(this).html('<a title="Read More">...</a>');
                 
            }

        });
    function getSearchProfileByName(val) {
        $.ajax({
            type: "POST",
            url: "<?= base_url('home/') ?>search_profile_by_name",
            data: 'keyword=' + val,
            success: function (data) {
                if(data)
                {
                    $("#tser-res").show();
                    $("#tser-res").html(data);
                }
                else
                {
                    $("#tser-res").hide();
                    $("#tser-res").html('');
                }
            }
        });
    }
    function getSearchProfileByService() {
        const str = [];
            $("input:checkbox[name=sub_cat_check]:checked").each(function() {
                str.push($(this).val());
            });
        $.ajax({
            type: "POST",
            url: "<?= base_url('home/') ?>search_profile_by_service",
            data: 'keyword=' + str,
            success: function (data) {
                
                    $(".all-list-wrapper").html(data);
                 
            }
        });
    }
    function getSearchServiceByName(val) {
        $.ajax({
            type: "POST",
            url: "<?= base_url('home/') ?>search_service_by_name",
            data: 'keyword=' + val,
            success: function (data) {
                
                    $(".sh-all-scat").html(data);
                
            }
        });
    }
    function getReferredBy(val) {
        $.ajax({
            type: "POST",
            url: "<?= base_url('home/') ?>get_referred_by",
            data: 'keyword=' + val,
            success: function (data) {
                if(val === "")
                {
                    $('#err_ref').html('');
                    $('#register_submit').removeAttr('disabled');
                    $('#referred_by').val('');
                }
                else
                {
                    if(data === "false")
                    {
                        $('#err_ref').html('Invalid Mobile Number');
                        $('#register_submit').attr('disabled','disabled');
                    }
                    else
                    {
                        $('#err_ref').html('');
                        $('#register_submit').removeAttr('disabled');
                        $('#referred_by').val(data);
                    }
                }
            }
        });
    }
    function getSendOTP() {
        var mobile = $('#email_id').val();
//        alert(mobile.length);
        if(mobile === "" || mobile.length !== 10)
        {
            $('#errotp').html('Please Enter Valid Mobile Number to proceed');
        }
        else
        {
        $.ajax({
            type: "POST",
            url: "<?= base_url('home/') ?>send_otp",
            data: 'mobile=' + mobile,
            success: function (data) {
                if(data === "1")
                {
                    $(".log-1").hide();
                    $(".log-11").show();
                    $('#email_id1').val(mobile);   
                }
                else if(data === "2")
                {
                    $('#errotp').html('Account Deactivated');
                }
                else
                {
                    $('#errotp').html('Something went wrong...Please try again');
                }
            }
        });
        }
    }
    function getVerifyOTP() {
        var mobile = $('#email_id1').val();
        var otp = $('#password').val();
        if(otp === "" || otp.length !== 4)
        {
            $('#errotp1').html('Please Enter Valid OTP to proceed');
        }
        else
        {
            $.ajax({
                type: "POST",
                url: "<?= base_url('home/') ?>verify_otp",
                data: {mobile:mobile,otp:otp},
                success: function (data) {
                    if(data === "1")
                    {
                        $(".log-1").hide();
                        $(".log-11").hide();
                        $(".log-2").show();
                        $('#mobile_number').val(mobile);   
                    }
                    else if(data === "2")
                    {
                        window.open("<?= base_url('dashboard') ?>","_self");
                    }
                    else
                    {
                        $('#errotp1').html('Invalid OTP');
                    }
                }
            });
        }
    }
</script>
</body>

</html>