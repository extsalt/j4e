<?php include 'header.php'; ?>
<?php include 'menu.php'; ?>
<!-- START -->

<?php
    $highlights = $this->db->get('highlights')->result();
                                    if(!empty($highlights))
                                    {
?>
<div class="ban-ql">
<div class="container">
            <div class="row">
                            <ul>
                                <?php
                                    
                                        foreach($highlights as $val)
                                        {
                                ?>
                                                                    <li>
                                        <div>
                                            <img
                                                src="<?= base_url('admin/'.$val->image) ?>"
                                                alt="" loading="lazy" loading="lazy">
                                            <h4><?= $val->title ?></h4>
                                            <p><?= $val->description ?></p>
                                            <a href="#">Explore Now</a>
                                        </div>
                                    </li>
                                        <?php
                                        }
                                    
                                        ?>
                                    
                            </ul>

                        </div>
                        </div>
                        </div>
<?php
}
?>

<?php
    $highlighted_users = $website_setting->highlighted_users;
    if(!empty($highlighted_users))
    {
        $str = explode(',', $highlighted_users);
?>
<section>
        <div class="plac-hom-bd plac-deta-sec plac-deta-sec-com">
            <div class="container">
                <div class="row">
                    <div class="plac-hom-tit text-center">
                        <h2>J4E Members</h2>
                        <!--<p>Start planning your next trip with a little help from <b>Bizbook</b></p>-->
                    </div>
                    <div class="plac-hom-all-pla">
                        <ul class="multiple-items1">
                            <?php
                                for($i=0;$i<count($str);$i++)
                                {
                                    $ui = $this->db->where('id', $str[$i])->get('user')->row();
                                    $link = '#';
                                    if ($this->session->userdata('isLogIn'))
                                    {
                                        $check_in_usertble = $this->db->where('id',$this->session->userdata('userid'))->get('user')->row();
                                        $pf_info = $this->db->where(array('package_id'=>$check_in_usertble->packages_id,'feature_id'=>9))->get('package_features')->row();
                                        $package_info1 = $this->db->where(array('user_id'=>$this->session->userdata('userid'),'plan_id'=>$check_in_usertble->packages_id,'plan_status'=>'Active'))->order_by('pur_id','desc')->get('user_package_purchase')->row();
                                        $user_consumption = $this->db->where(array('user_id'=>$this->session->userdata('userid'),'package_id'=>$check_in_usertble->packages_id,'feature_id'=>9,'package_purchase_id'=>$package_info1->pur_id))->order_by('id','desc')->get('user_package_features')->row();
                                        $str = explode(',',$user_consumption->type_id);
                                        $flag = 1;
                                        if($pf_info->count_allowed > 0)
                                        {                                   
                                            if(!empty($user_consumption))
                                            {
                                               if($user_consumption->used_count == $pf_info->count_allowed)
                                               {
                                                   $flag = 0;
                                               }
                                            }                                   
                                        }
                                        if($flag == 0)
                                        {
                                            if(in_array($str[$i],$str))
                                            {
                                                $link = base_url('member_profile/'.$str[$i]);
                                            }
                                        }
                                        else
                                        {
                                            $link = base_url('member_profile/'.$str[$i]);
                                        }
                                    }
                            ?>
                            <li>
                                <div class="plac-hom-box">
                                    <div class="plac-hom-box-im">
                                        <img src="<?=urldecode($ui->avatar) ?>"
                                             alt="<?= $ui->id ?>" loading="lazy">
                                        <h4><?= $ui->first_name." ".$ui->last_name ?></h4>
                                        <span class="plac-det-cate"><?= $this->db->where('pack_id',$ui->packages_id)->get('packages')->row()->pack_name; ?></span>
                                    </div>
                                    <div class="plac-hom-box-txt">
<!--                                        <div class="revi-box-1">
                                                                                            <b>1.0</b>
                                                                                                                                            <label class="rat">
                                                                                                            <i class="material-icons">star</i>
                                                                                                                <i class="material-icons ratstar">star</i>
                                                                                                                <i class="material-icons ratstar">star</i>
                                                                                                                <i class="material-icons ratstar">star</i>
                                                                                                                <i class="material-icons ratstar">star</i>
                                                                                                        </label>
                                                                                                                                            <span
                                                    class="re-cnt">Reviews</span>
                                                                                        </div>-->
                                        <span>More details</span>
                                    </div>
                                    <a href="<?= $link ?>" class="fclick"></a>
                                </div>
                            </li>
                            <?php
                                }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--END-->
<?php
    }
?>
    <?php
        $blogs = $this->db->get('blogs')->result();
        if(!empty($blogs))
        {            
    ?>
     <!--START-->
    <section>
        <div class="plac-hom-bd plac-deta-sec plac-deta-sec-com">
            <div class="container">
                <div class="row">
                    <div class="plac-hom-tit text-center">
                        <h2>J4E Stories</h2>
                        <!--<p>Start planning your next trip with a little help from <b>Bizbook</b></p>-->
                    </div>
                    <div class="plac-hom-all-pla plac-det-eve">
                        <ul class="multiple-items1">
                            <?php
                                foreach($blogs as $val)
                                {
                            ?>
                            <li>
                                <div class="plac-hom-box">
                                    <div class="plac-hom-box-im">
                                        <img src="<?= base_url('admin/'.$val->image) ?>" alt="" loading="lazy">
                                        <h4><?= $val->title ?></h4>
                                        <span class="plac-det-cate"><?= date('d, M Y',strtotime($val->date)) ?></span>
                                    </div>
                                    <a href="<?= base_url('blog_detail/'.$val->id) ?>" class="fclick"></a>
                                </div>
                            </li>
                            <?php
                                }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--END-->
    <?php
        }
    ?>
    <?php
        $testimonials = $this->db->where('is_featured',1)->get('testimonials')->result();
        if(!empty($testimonials))
        {
    ?>
    <!-- START -->
<section>
    <div class="plac-hom-bd plac-deta-sec plac-deta-sec-com">
        <div class="container">
            <div class="row">
                <div class="home-tit">
                    <h2><span>J4E Testimonials</span></h2>
                    <!--<p>We connect with targeted customers for greater business conversion</p>-->
                </div>

                <div class="hom2-cus-sli">
                    <ul class="multiple-items">
                        <?php
                            foreach($testimonials as $val)
                            {
                        ?>
                        <li>
                            <div class="testmo">
                                <img
                                    src="<?= base_url('admin/'.$val->user_image) ?>"
                                    alt="" loading="lazy">
                                <h4><?= $val->user_name ?></h4>
                                <span><?= $val->user_designation ?></span>
<!--                                <span>Written a review to <a href="#">Brandon David</a></span>
                                <label class="rat">                                                                                                                                                                                                                                               <i class="material-icons">star</i>
                                        <i class="material-icons">star</i>
                                        <i class="material-icons">star</i>
                                        <i class="material-icons">star</i>
                                        <i class="material-icons">star</i>
                                </label>-->
                                <p><?= $val->short_desc ?></p>
                                <a href="<?= base_url('testimonial_detail/'.$val->id) ?>" class="fclick"></a>
                            </div>
                        </li>
                        <?php
                            }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END -->
<?php
        }
?>

<!-- START --> 
<?php
if(!empty($services))
{
?>
<section>
    <div class="str">
        <div class="container">
            <div class="row">
                <div class="home-tit">
                    <h2><span>Popular Services</span> near you</h2>
                    <!--<p>lacinia viverra lectus. Fusce imperdiet ullamcorper metus eu fringilla.</p>-->
                </div>
                <div class="land-pack">
                    <ul>
                        <?php
                            
                                foreach($services as $val)
                                {
                        ?>
                                                    <li>
                                <div class="land-pack-grid">
                                    <div class="land-pack-grid-img">
                                        <img src="<?= base_url('admin/'.$val->functional_area_thumbnil) ?>" alt="" loading="lazy">
                                    </div>
                                    <div class="land-pack-grid-text">
                                        <h4><?= $val->functional_area ?>                                                                                            
                                            <!--<span class="dir-ho-cat">Show All (06)</span>-->
                                                                                        </h4>
                                    </div>
                                    <a href="<?= base_url('profile_listing/'.$val->functional_area_id) ?>"
                                       class="land-pack-grid-btn">View all listings</a>
                                </div>
                            </li>
                            <?php
                                }
                            
                            ?>
                                                        
                                                </ul>
                    <a href="<?= base_url('business_category') ?>" class="more">View all services</a>
                                    </div>
            </div>
        </div>
    </div>
</section>
<?php
}
?>
<!-- END -->


    <!-- START -->
    <!-- <section>
        <div class="hom-mpop-ser">
            <div class="container">
                <div class="hom-mpop-main">
                    <div class="home-tit">
                        <h2><span></span>
                        </h2>
                        <p></p>
                    </div>

                    <div class="hom2-cus-sli">
                        <ul class="multiple-items1">
                                                            <li>
                                    <div class="testmo hom4-prop-box">
                                        <img
                                            src="" alt="" loading="lazy">
                                        <div>
                                            <h4>
                                                <a href=""></a>
                                            </h4>
                                                                                            <label class="rat">
                                                                                                            <i class="material-icons">star</i>
                                                                                                                <i class="material-icons">star_border</i>
                                                                                                        </label>
                                                                                        <span><a
                                                    href="#"></a></span>
                                        </div>
                                        <a href=""
                                           class="fclick"></a>
                                    </div>
                                </li>
                                                        </ul>
                    </div>
                </div>
                <div class="hlead-coll">
                    <div class="col-md-6">
                        <div class="hom-cre-acc-left">
                            <h3>                                <span></span>
                            </h3>
                            <p></p>
                            <ul>
                                <li><img src="<?= base_url('assets/') ?>images/icon/blog.png" alt="" loading="lazy">
                                    <div>
                                        <h5></h5>
                                        <p></p>
                                    </div>
                                </li>
                                <li><img src="<?= base_url('assets/') ?>images/icon/shield.png" alt="" loading="lazy">
                                    <div>
                                        <h5></h5>
                                        <p></p>
                                    </div>
                                </li>
                                <li><img src="<?= base_url('assets/') ?>images/icon/general.png" alt="" loading="lazy">
                                    <div>
                                        <h5></h5>
                                        <p></p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="hom-col-req">
                            <div class="log-bor">&nbsp;</div>
                            <span class="udb-inst"></span>
                            <h4></h4>
                            <div id="home_enq_success" class="log"
                                 style="display: none;">
                                <p></p>
                            </div>
                            <div id="home_enq_fail" class="log" style="display: none;">
                                <p></p>
                            </div>
                            <div id="home_enq_same" class="log" style="display: none;">
                                <p></p>
                            </div>
                            <form name="home_enquiry_form" id="home_enquiry_form" method="post"
                                  enctype="multipart/form-data">
                                <input type="hidden" class="form-control" name="listing_id" value="0" placeholder=""
                                       required>
                                <input type="hidden" class="form-control" name="listing_user_id" value="0"
                                       placeholder=""
                                       required>
                                <input type="hidden" class="form-control" name="enquiry_sender_id" value=""
                                       placeholder=""
                                       required>
                                <input type="hidden" class="form-control"
                                       name="enquiry_source"
                                       value="" placeholder="" required>
                                <div class="form-group">
                                    <input type="text" name="enquiry_name" value="" required="required"
                                           class="form-control"
                                           placeholder="">
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control"
                                           placeholder=""
                                           required="required"
                                           value="" name="enquiry_email"
                                           pattern="^[\w]{1,}[\w.+-]{0,}@[\w-]{2,}([.][a-zA-Z]{2,}|[.][\w-]{2,}[.][a-zA-Z]{2,})$"
                                           title="">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" value="" name="enquiry_mobile"
                                           placeholder=""
                                           pattern="[7-9]{1}[0-9]{9}"
                                           title=""
                                           required="">
                                </div>
                                <div class="form-group">
                                    <select name="enquiry_category" id="enquiry_category" class="form-control">
                                        <option value=""></option>
                                                                                    <option
                                                value=""></option>
                                                                                </select>
                                </div>
                                <div class="form-group">
                        <textarea class="form-control" rows="3" name="enquiry_message"
                                  placeholder=""></textarea>
                                </div>
                                <input type="hidden" id="source">
                                <button type="submit" id="home_enquiry_submit" name="home_enquiry_submit"
                                        class="btn btn-primary">
                                                                    </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> -->
    <!-- END -->

    <!-- START -->
    <!-- <section>
        <div class="str str-full">
            <div class="container">
                <div class="row">
                    <div class="home-tit">
                        <h2>
                            <span></span>                         </h2>
                        <p></p>
                    </div>
                    <div class="ho-popu-bod">
                                                    <div class="col-md-4">
                                <div class="hot-page2-hom-pre-head">
                                    <h4>                                        <span></span></h4>
                                </div>
                                <div class="hot-page2-hom-pre">
                                    <ul>
                                                                                    <li>
                                                <div class="hot-page2-hom-pre-1"><img
                                                        src="" alt="" loading="lazy">
                                                </div>
                                                <div class="hot-page2-hom-pre-2">
                                                    <h5></h5>
                                                    <span></span>
                                                </div>
                                                                                                    <div class="hot-page2-hom-pre-3">
                                                        <span></span>
                                                    </div>
                                                                                                <a href=""
                                                   class="fclick"></a>
                                            </li>
                                            
                                    </ul>
                                </div>
                            </div>
                                                </div>
                </div>
            </div>
        </div>
    </section> -->
    <!-- END -->
    <?php
        $advertisement1 = $this->db->get('advertisement1')->result();
        if(!empty($advertisement1))
        {
    ?>
    <section>
        <div id="demo" class="carousel slide cate-sli caro-home" data-ride="carousel">
            <div class="container">
                <div class="row">
                    <div class="inn">
                        <div class="carousel-inner">
                            <?php
                                $cnt = 1;
                                foreach($advertisement1 as $val)
                                {
                            ?>
                                                            <div class="carousel-item <?php if($cnt == 1){ echo 'active'; } ?>">
                                    <img src="<?= base_url('admin/'.$val->image) ?>"
                                         alt=""
                                         width="1100" height="500">
                                    <a href="<?= $val->link ?>" target="_blank"></a>
                                </div>
                            <?php
                                    $cnt++;
                                }
                            ?>
                                                                
                                                        </div>
                        <a class="carousel-control-prev" href="#demo" data-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                        </a>
                        <a class="carousel-control-next" href="#demo" data-slide="next">
                            <span class="carousel-control-next-icon"></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php
        }
    ?>
    <?php
        $advertisement2 = $this->db->get('advertisement2')->result();
        if(!empty($advertisement2))
        {
    ?>
    <!--START-->
    <section>
        <div class="plac-hom-bd">
            <div class="container">
                <div class="row">
                    <div class="plac-det-tit-inn">
                        <h2>Explore our more Services</h2>
                    </div>
                    <div class="plac-hom-all-pla hom-more-modu">
                        <ul class="travel-sliser-auto">
                            <?php
                                
                                foreach($advertisement2 as $val)
                                {
                            ?>
                            
                                                                <li>
            <div class="plac-hom-box">
                <div class="plac-hom-box-im">
                    <img src="<?= base_url('admin/'.$val->image) ?>" alt="" loading="lazy">
                    <div class="inn-text">
                        <h4><?= $val->title ?></h4>
<!--                        <a href="#">Start finding <i
                                class="material-icons">arrow_forward</i></a>-->
                    </div>
                </div>
            </div>
        </li>
             <?php
                                    
                                }
                            ?>                                                                           
                                                    </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--END-->
<?php
        }
    ?>
    <?php
        $packages = $this->db->order_by('seq_no','asc')->get('packages')->result();
        if(!empty($packages))
        {
    ?>
    <!--PRICING DETAILS-->
    <section class=" pri">
        <div class="container">
            <div class="row">
                <div class="plac-det-tit-inn">
                    <h2>Choose your plan</h2>
                </div>
                <div>
                    <ul>
                        <?php
                            foreach($packages as $val)
                            {
                        ?>
                                                    <li>
                                <div class="pri-box">
                                    <div class="c2">
                                        <h4><?= $val->pack_name ?></h4>

                                            <!--<p>For getting started</p>-->
                                        
                                    </div>
                                    <div class="c3">
                                        <h2><span></span>
                                        <?php
                                            if(empty($val->pack_price))
                                            {
                                                echo 'FREE';
                                            }
                                            else 
                                            {
                                                echo '₹'.$val->pack_price;
                                            }
                                        ?>
                                        </h2>
                                        <!--<p>Single user</p>-->
                                        
                                    </div>
                                    <div class="c5">
                                        <a href="<?= base_url('login') ?>" class="cta1">Get Start</a>
<!--                                        <a href="#" class="cta2"
                                           target="_blank">Know more</a>-->
                                    </div>
                                </div>
                            </li>
                            <?php
                            }
                            ?>
                                                        
                                                </ul>
                </div>
            </div>
        </div>
    </section>
    <!--END PRICING DETAILS-->
<?php
        }
    ?>
    <!-- START -->
    <section>
        <div class="str count">
            <div class="container">
                <div class="row">
                    <!-- <div class="home-tit">
                        <h2><span>Feature Events</span> in city                        </h2>
                        <p>lacinia viverra lectus. Fusce imperdiet ullamcorper metus eu fringilla.</p>
                    </div>
                    <div class="hom-event">
                        <div class="hom-eve-com hom-eve-lhs">
                                                            <div class="hom-eve-lhs-1 col-md-4">
                                    <div class="eve-box">
                                        <div>
                                            <a href="https://bizbookdirectorytemplate.com/event/chicago-bike-trails-for-a-long-ride">
                                                <img src="<?= base_url('assets/') ?>images/events/19158pexels-punlob-564107.jpg"
                                                     alt="" loading="lazy">
                                            <span>Mar                                                <b> 11</b></span>
                                            </a>
                                        </div>
                                        <div>
                                            <h4>
                                                <a href="https://bizbookdirectorytemplate.com/event/chicago-bike-trails-for-a-long-ride">Chicago bike trails for a long ride</a>
                                            </h4>
                                    <span
                                        class="addr">28800 Orchard Lake Road, Suite 180 Farmington Hills, U.S.A.</span>
                                            <span class="pho">643114512</span>
                                        </div>
                                        <div>
                                            <div class="auth">
                                                <img
                                                    src="<?= base_url('assets/') ?>images/user/1.jpg" alt="" loading="lazy">
                                                <b>Hosted by</b><br>
                                                <h4>Richflayer</h4>
                                                <a target="_blank"
                                                   href="https://bizbookdirectorytemplate.com/profile/richflayer"
                                                   class="fclick"></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                                                <div class="hom-eve-lhs-1 col-md-4">
                                    <div class="eve-box">
                                        <div>
                                            <a href="https://bizbookdirectorytemplate.com/event/light-music-event-2022">
                                                <img src="<?= base_url('assets/') ?>images/events/15315pexels-daniel-nouri-8448535.jpg"
                                                     alt="" loading="lazy">
                                            <span>Dec                                                <b> 31</b></span>
                                            </a>
                                        </div>
                                        <div>
                                            <h4>
                                                <a href="https://bizbookdirectorytemplate.com/event/light-music-event-2022">Light Music Event 2022</a>
                                            </h4>
                                    <span
                                        class="addr">Address: 28800 Orchard Lake Road, Suite 180 Farmington Hills, U.S.A.</span>
                                            <span class="pho">987654122</span>
                                        </div>
                                        <div>
                                            <div class="auth">
                                                <img
                                                    src="<?= base_url('assets/') ?>images/user/1.jpg" alt="" loading="lazy">
                                                <b>Hosted by</b><br>
                                                <h4>Richflayer</h4>
                                                <a target="_blank"
                                                   href="https://bizbookdirectorytemplate.com/profile/richflayer"
                                                   class="fclick"></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                                            <div class="hom-eve-lhs-2 col-md-4">
                                <ul>
                                                                            <li>
                                            <div class="eve-box-list">
                                                <img src="<?= base_url('assets/') ?>images/events/"
                                                     alt="" loading="lazy">
                                                <h4 title=""></h4>
                                                <p></p>
                                            <span>Jan                                                <b> 01</b></span>
                                                <a href="https://bizbookdirectorytemplate.com/event/"
                                                   class="fclick"></a>
                                            </div>
                                        </li>
                                                                                <li>
                                            <div class="eve-box-list">
                                                <img src="<?= base_url('assets/') ?>images/events/77500pexels-patrick-case-3628912.jpg"
                                                     alt="" loading="lazy">
                                                <h4 title="Cricket Tournament for Mens">Cricket Tournament for Mens</h4>
                                                <p>Lorem Ipsum is simply dummy text of the printing a</p>
                                            <span>Jun                                                <b> 18</b></span>
                                                <a href="https://bizbookdirectorytemplate.com/event/cricket-tournament-for-mens"
                                                   class="fclick"></a>
                                            </div>
                                        </li>
                                                                                <li>
                                            <div class="eve-box-list">
                                                <img src="<?= base_url('assets/') ?>images/events/6507pexels-mae-gregorio-1776151.jpg"
                                                     alt="" loading="lazy">
                                                <h4 title="Top Annual  event in new york 2022">Top Annual  event in new york 2022</h4>
                                                <p>Event details is simply dummy text of the printing</p>
                                            <span>May                                                <b> 12</b></span>
                                                <a href="https://bizbookdirectorytemplate.com/event/top-annual--event-in-new-york-2022"
                                                   class="fclick"></a>
                                            </div>
                                        </li>
                                                                                <li>
                                            <div class="eve-box-list">
                                                <img src="<?= base_url('assets/') ?>images/events/20523pexels-evg-culture-1126993.jpg"
                                                     alt="" loading="lazy">
                                                <h4 title="Every New York Fashion Week events may 2022">Every New York Fashion Week events may 2022</h4>
                                                <p>Event details is simply dummy text of the printing</p>
                                            <span>May                                                <b> 03</b></span>
                                                <a href="https://bizbookdirectorytemplate.com/event/every-new-york-fashion-week-events-may-2022"
                                                   class="fclick"></a>
                                            </div>
                                        </li>
                                                                                <li>
                                            <div class="eve-box-list">
                                                <img src="<?= base_url('assets/') ?>images/events/4321pexels-helena-lopes-697244.jpg"
                                                     alt="" loading="lazy">
                                                <h4 title="places to hang out in new york">places to hang out in new york</h4>
                                                <p>Event details is simply dummy text of the printing</p>
                                            <span>May                                                <b> 17</b></span>
                                                <a href="https://bizbookdirectorytemplate.com/event/places-to-hang-out-in-new-york"
                                                   class="fclick"></a>
                                            </div>
                                        </li>
                                                                                <li>
                                            <div class="eve-box-list">
                                                <img src="<?= base_url('assets/') ?>images/events/92225pexels-kindel-media-7148439.jpg"
                                                     alt="" loading="lazy">
                                                <h4 title="beach party in new los angeles">beach party in new los angeles</h4>
                                                <p>Event details is simply dummy text of the printing</p>
                                            <span>Nov                                                <b> 26</b></span>
                                                <a href="https://bizbookdirectorytemplate.com/event/beach-party-in-new-los-angeles"
                                                   class="fclick"></a>
                                            </div>
                                        </li>
                                                                        </ul>
                            </div>

                        </div>
                    </div> -->
                    <?php
        $intro_screen = $this->db->get('intro_screen')->result();
        if(!empty($intro_screen))
        {
    ?>
                    <div class="how-wrks">
                        <div class="home-tit">
                            <h2><span>How It Works</span></h2>
                            <!--<p>Explore some of the best tips from around the world from our<br>partners and friends.lacinia viverra lectus.</p>-->
                        </div>
                        <div class="how-wrks-inn">
                            <ul>
                                <?php
                                    $cnt = 1;
                                    foreach($intro_screen as $val)
                                    {
                                ?>
                                <li>
                                    <div>
                                        <span><?= $cnt ?></span>
                                        <img src="<?= base_url('admin/'.$val->screen_image) ?>" alt="" loading="lazy">
                                        <h4><?= $val->screen_title ?></h4>
                                        <p><?= $val->screen_desc ?></p>
                                    </div>
                                </li>
                                <?php
                                    $cnt++;
                                    }
                                ?>
                            </ul>
                        </div>
                    </div>
                    <?php
        }
    ?>
                                            <div class="mob-app">
                            <div class="lhs">
                                <img src="<?= base_url('assets/') ?>images/mobile.png" alt="" loading="lazy">
                            </div>
                            <div class="rhs">
                                <h2>Looking for the Best Service Provider?                                    <span>Get the App!</span></h2>
                                <ul>
                                    <li>HOM-APP-TITFind nearby listings</li>
                                    <li>Easy service enquiry</li>
                                    <li>Listing reviews and ratings</li>
                                    <li>Manage your listing, enquiry and reviews</li>
                                </ul>
                                <span>We'll send you a link, to you below provided email id & open it on your smart phone to download the app</span>
                                <a href="<?= $website_setting->android_link ?>"><img src="<?= base_url('assets/') ?>images/gstore.png" alt="" loading="lazy"> </a>
                                <!--<a href="<?= $website_setting->ios_link ?>"><img src="<?= base_url('assets/') ?>images/astore.png" alt="" loading="lazy"> </a>-->
                            </div>
                        </div>
                                    </div>
            </div>
        </div>
    </section>
    <!-- END -->
    
<!-- START -->
<?php
        $advertisement3 = $this->db->get('advertisement3')->result();
        if(!empty($advertisement3))
        {
    ?>
<section >
        <div id="demo" class="carousel slide cate-sli caro-home" data-ride="carousel" style="padding-bottom: 50px;">
            <div class="container">
                <div class="row">
                    <div class="inn">
                        <div class="carousel-inner">
                            <?php
                                $cnt = 1;
                                foreach($advertisement3 as $val)
                                {
                            ?>
                                                            <div class="carousel-item <?php if($cnt == 1){ echo 'active'; } ?>">
                                    <img src="<?= base_url('admin/'.$val->image) ?>"
                                         alt=""
                                         width="1100" height="500">
                                    <a href="<?= $val->link ?>" target="_blank"></a>
                                </div>
                            <?php
                                    $cnt++;
                                }
                            ?>
                                                                
                                                        </div>
<!--                        <a class="carousel-control-prev" href="#demo" data-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                        </a>
                        <a class="carousel-control-next" href="#demo" data-slide="next">
                            <span class="carousel-control-next-icon"></span>
                        </a>-->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php
        }
    ?>
<!--<section>
    <div class="hom-ads">
        <div class="container">
            <div class="row">
                <div class="filt-com lhs-ads">
                    <div class="ads-box">
                                                <a href="">
                            <span>Ad</span>

                            <img src="<?= base_url('admin/'.$website_setting->advertise1) ?>" alt="" loading="lazy">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>-->
<!-- END -->

<!-- START -->
<!--<div class="ani-quo">
    <div class="ani-q1">
        <h4>What you looking for?</h4>
        <p>We connect you to service experts.</p>
        <span>Get experts</span>
    </div>
    <div class="ani-q2">
        <img src="<?= base_url('assets/') ?>images/quote.png" alt="" loading="lazy">
    </div>
</div>-->
<!-- END -->

<!-- START -->

<!--<span class="btn-ser-need-ani"><img src="<?= base_url('assets/') ?>images/icon/help.png" alt="" loading="lazy"></span>

<div class="ani-quo-form">
    <i class="material-icons ani-req-clo">close</i>
    <div class="tit">
        <h3>What service do you need? <span>BizBook will help you</span></h3>
    </div>
    <div class="hom-col-req">
        <div id="home_slide_enq_success" class="log"
             style="display: none;">
            <p>Your Enquiry Is Submitted Successfully!!!</p>
        </div>
        <div id="home_slide_enq_fail" class="log" style="display: none;">
            <p>Oops!! Something Went Wrong Try Later!!!</p>
        </div>
        <div id="home_slide_enq_same" class="log" style="display: none;">
            <p>You cannot make enquiry on your own listing!!</p>
        </div>
        <form name="home_slide_enquiry_form" id="home_slide_enquiry_form" method="post" enctype="multipart/form-data">
            <input type="hidden" class="form-control"
                   name="listing_id"
                   value="0"
                   placeholder=""
                   required>
            <input type="hidden" class="form-control"
                   name="listing_user_id"
                   value="0"
                   placeholder=""
                   required>
            <input type="hidden" class="form-control"
                   name="enquiry_sender_id"
                   value=""
                   placeholder=""
                   required>
            <input type="hidden" class="form-control"
                   name="enquiry_source"
                   value="Website"
                   placeholder=""
                   required>
            <div class="form-group">
                <input type="text" name="enquiry_name" value="" required="required" class="form-control"
                       placeholder="Enter name*">
            </div>
            <div class="form-group">
                <input type="email" class="form-control" placeholder="Enter email*" required="required" value=""
                       name="enquiry_email"
                       pattern="^[\w]{1,}[\w.+-]{0,}@[\w-]{2,}([.][a-zA-Z]{2,}|[.][\w-]{2,}[.][a-zA-Z]{2,})$"
                       title="Invalid email address">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" value="" name="enquiry_mobile"
                       placeholder="Enter mobile number *" pattern="[7-9]{1}[0-9]{9}"
                       title="Phone number starting with 7-9 and remaining 9 digit with 0-9" required="">
            </div>
            <div class="form-group">
                <select name="enquiry_category" id="enquiry_category" class="form-control chosen-select">
                    <option value="">Select Category</option>
                                            <option
                            value="20">Restaurants</option>
                                                <option
                            value="19">Wedding halls</option>
                                                <option
                            value="17">Pet shop</option>
                                                <option
                            value="16">Technology</option>
                                                <option
                            value="15">Spa and Facial</option>
                                                <option
                            value="10">Real Estate</option>
                                                <option
                            value="8">Sports</option>
                                                <option
                            value="7">Education</option>
                                                <option
                            value="6">Electricals</option>
                                                <option
                            value="5">Automobiles</option>
                                                <option
                            value="3">Transportation</option>
                                                <option
                            value="2">Hospitals</option>
                                        </select>
            </div>
            <div class="form-group">
                <textarea class="form-control" rows="3" name="enquiry_message"
                          placeholder="Enter your query or message"></textarea>
            </div>
            <input type="hidden" id="source">
            <button type="submit" id="home_slide_enquiry_submit" name="home_slide_enquiry_submit"
                    class="btn btn-primary">Submit Requirements            </button>
        </form>
    </div>
</div>-->
<!-- END -->

<!-- START -->
<section>
    <div class="full-bot-book">
        <div class="container">
            <div class="row">
                                <div class="bot-book">
                    <div class="col-md-12 bb-text">
                        <h4>List your business for FREE</h4>
                        <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour.</p>
                        <a href="<?= base_url('login') ?>">Add my business <i class="material-icons">arrow_forward</i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END -->
	


   <?php include 'footer.php'; ?>     