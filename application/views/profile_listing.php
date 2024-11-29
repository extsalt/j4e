<?php include 'header.php'; ?>
<?php include 'menu1.php'; ?>   
<!-- START -->
<section>
    <div class="all-listing all-listing-pg">
        <!--FILTER ON MOBILE VIEW-->
        <div class="fil-mob fil-mob-act">
            <h4>Listing filters <i class="material-icons">filter_list</i></h4>
        </div>
        <div class="all-list-bre">
            <div class="container sec-all-list-bre">
                <div class="row">
                                            <h1>Members Listing</h1>
<!--                                            <ul>
                        <li><a href="https://bizbookdirectorytemplate.com/">Home</a></li>
                        <li>
                            <a href="https://bizbookdirectorytemplate.com/all-listing">All Category</a>
                        </li>
                                                    <li>
                                <a href="https://bizbookdirectorytemplate.com/all-listing/technology">Technology</a>
                            </li>
                                                </ul>-->
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                                    <div class="col-md-3 fil-mob-view">
                        <div class="all-filt">
                            <span class="fil-mob-clo"><i class="material-icons">close</i></span>
                                           <div class="filt-alist-near">                 
                                <div class="tit">
                                        <h4>Services</h4></div>                            
                                           </div>
                                <!--START-->
                                <div class="sub_cat_section filt-com lhs-sub" style="padding-top: 10px;">
                                    <!--<h4>Sub category</h4>-->
                                    <ul>
                                        <?php
                        $service_info = $this->db->where('status',1)->order_by('functional_area','asc')->get('tbl_functional_area')->result();
                        if(!empty($service_info))
                        {
                            foreach($service_info as $val)
                            {
                    ?>
                                                                                    <li>
                                                <div class="chbox">
                                                    <input type="checkbox" class="sub_cat_check" name="sub_cat_check" onchange="getSearchProfileByService()"
                                                           value="<?= $val->functional_area_id ?>" id="<?= $val->functional_area ?>" <?php if($business_category == $val->functional_area_id){ echo 'checked'; } ?>/>
                                                    <label
                                                        for="<?= $val->functional_area ?>"><?= $val->functional_area ?></label>
                                                </div>
                                            </li>
                                                                                        <?php
                            }
                        }
                        ?>
                                                                                </ul>
                                </div>
                                <!--END-->

                                                            
                            
                            
                                                            
                                                            <!--START-->
                            <div class="filt-com lhs-ads">
                                <ul>
                                    <li>
                                        <div class="ads-box">
                                                                                        <a href="">
                                                <span>Ad</span>

                                                <img
                                                    src="<?= base_url('admin/'.$website_setting->advertise4) ?>" alt="" loading="lazy">
                                            </a>
                                        </div>
                                    </li>

                                </ul>
                            </div>
                            <!--END-->

                            
                            <!-- END -->
                        </div>
                    </div>
                                    <div class="col-md-9">
                    
                    <!--ADS-->
                    <div class="ban-ati-com ads-all-list">
                                                <a href=""><span>Ad</span><img
                                src="<?= base_url('admin/'.$website_setting->advertise2) ?>" loading="lazy"></a>
                    </div>
                    <!--ADS-->
                    <!-- Loader Image -->
                    <div id="loadingmessage" style="display:none">
                        <div id="loadingmessage1">&nbsp;</div>
                    </div>
                    <!-- Loader Image -->
                    <div class="all-list-sh all-listing-total">
                        <?php
                            if(!empty($profile_info))
                            {
                        ?>
                        <ul class="all-list-wrapper">
                            <?php
                            foreach($profile_info as $val)
                            {
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
                                        if(in_array($val->id,$str))
                                        {
                                            $link = base_url('member_profile/'.$val->id);
                                        }
                                    }
                                    else
                                    {
                                        $link = base_url('member_profile/'.$val->id);
                                    }
                                }
                        ?>
                                    <li class="all-list-item">
                                        <div class="eve-box">
                                            <!---LISTING IMAGE--->
                                            <div class="al-img">
                                                <span class="open-stat"><?= $this->db->where('pack_id',$val->packages_id)->get('packages')->row()->pack_name; ?></span>
                                                <a href="<?= $link ?>">

                                                    <img
                                                        src="<?= base_url('admin/upload/avatar/'.$val->avatar) ?>" loading="lazy">
                                                </a>

                                            </div>
                                            <!---END LISTING IMAGE--->

                                            <!---LISTING NAME--->
                                            <div class="list-con">
                                                <h4>
                                                    <a href="<?= $link ?>"><?= $val->first_name." ".$val->last_name ?></a>
                                                                                                            <i class="li-veri"><img
                                                                src="<?= base_url('assets/') ?>images/icon/svg/verified.png" title="Verified" loading="lazy"></i>
                                                                                                    </h4>
<!--                                                <div class="list-rat-all">
                                                                                                                                                                <span>No Reviews Yet</span>
                                                                                                        </div>-->
                                                
                                                    <?php
                                                        if(!empty($val->company_address))
                                                        {
                                                    ?>
                                                    <span class="addr"><?= $val->company_address ?></span>
                                                    <?php
                                                        }
                                                    ?>
                                                    <?php
                                                        if (!$this->session->userdata('isLogIn') || ($this->session->userdata('isLogIn') && !in_array($val->id,$str)))
                                                        {
                                                    ?>
                                                    <span class="pho "><a class="blurry-text">1234567890  </a></span>
                                                
                                                    <span class="mail"><a class="blurry-text">abc@example.com</a></span>

                                                <div class="links">
                                                    <!--<a href="https://bizbookdirectorytemplate.com/login?src=https://bizbookdirectorytemplate.com/all-listing/technology">Get quote</a>-->
                                                    <a href="<?= $link ?>">View more</a>
                                                    <!--<a href="Tel:35465436543 ">Call Now</a>-->
                                                    <?php
                                                        if(!empty($val->wmobile))
                                                        {
                                                    ?>
                                                    <a href="#" class="what"
                                                       target="_blank">WhatsApp</a>
                                                    <?php
                                                        }
                                                        else
                                                        {
                                                            if(!empty($val->company_wmobile))
                                                            {
                                                    ?>
                                                    <a href="#" class="what"
                                                       target="_blank">WhatsApp</a>
                                                    <?php
                                                            }
                                                        }
                                                    ?>
                                                </div>
                                                    <?php
                                                        }else{
                                                ?>
                                                <span class="pho "><a href="Tel:<?= $val->phone ?>"><?= $val->phone ?>  </a></span>
                                                
                                                    <span class="mail"><?= $val->email_address ?></span>

                                                <div class="links">
                                                    <!--<a href="https://bizbookdirectorytemplate.com/login?src=https://bizbookdirectorytemplate.com/all-listing/technology">Get quote</a>-->
                                                    <a href="<?= $link ?>">View more</a>
                                                    <!--<a href="Tel:35465436543 ">Call Now</a>-->
                                                    <?php
                                                        if(!empty($val->wmobile))
                                                        {
                                                    ?>
                                                    <a href="https://wa.me/<?= $val->wmobile ?>" class="what"
                                                       target="_blank">WhatsApp</a>
                                                    <?php
                                                        }
                                                        else
                                                        {
                                                            if(!empty($val->company_wmobile))
                                                            {
                                                    ?>
                                                    <a href="https://wa.me/<?= $val->company_wmobile ?>" class="what"
                                                       target="_blank">WhatsApp</a>
                                                    <?php
                                                            }
                                                        }
                                                    ?>
                                                </div>
                                                <?php
                                                        }
                                                    ?>
                                            </div>
                                            <!---END LISTING NAME--->

                                            <!---SAVE--->
<!--                                    <span class="enq-sav" data-toggle="tooltip"
                                          title="Click to like this listing">
                                        <i class="l-like Animatedheartfunc420 "
                                           data-for="0"
                                           data-section="1"
                                           data-num="327"
                                           data-item=""
                                           data-id='420'><img
                                                src="<?= base_url('assets/') ?>images/icon/svg/like.svg" loading="lazy"></i></span>-->
                                            <!---END SAVE--->
                                        </div>
                                    </li>
                                    <?php
                            }
                        ?>
                        </ul>
                        <?php
                            }
                        ?>
                        <!--ADS-->
                        <div class="ban-ati-com ads-all-list">
                                                        <a href="#"><span>Ad</span><img
                                    src="<?= base_url('admin/'.$website_setting->advertise3) ?>" loading="lazy"></a>
                        </div>
                        <!--ADS-->
                        <div id="all-list-pagination-container"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END -->
   <?php include 'footer.php'; ?>     