<?php include 'header.php'; ?>
<?php include 'menu1.php'; ?>   
<?php
    $rating = 0;
    $a = 0;
    $b = 0;
    $rating_info1 = $this->db->where('user_id',$profile_info->id)->where('status',1)->get('ratings_reviews')->result();
    if(!empty($rating_info1))
    {
        foreach($rating_info1 as $val1)
        {
            $a = $a + $val1->ratings;
            $b = $b + 5;
        }
        $rating = $rating + (($a/$b)*5);
    }
    $pf_info = $this->db->where(array('package_id'=>$profile_info->packages_id,'feature_id'=>8))->get('package_features')->row();
    if($pf_info->is_allowed == 0)
    {
        $flag = 0;
    }
    else
    {
        $flag = 1;
        $package_info = $this->db->where(array('user_id'=>$profile_info->id,'plan_id'=>$profile_info->packages_id,'plan_status'=>'Active'))->order_by('pur_id','desc')->get('user_package_purchase')->row();
        $user_consumption = $this->db->where(array('user_id'=>$profile_info->id,'package_id'=>$profile_info->packages_id,'feature_id'=>8,'package_purchase_id'=>$package_info->pur_id))->order_by('id','desc')->get('user_package_features')->row();
        if(empty($user_consumption))
        {                                 
            $data1['user_id'] = $profile_info->id;
            $data1['package_id'] = $profile_info->packages_id;
            $data1['package_purchase_id'] = $package_info->pur_id;
            $data1['feature_id'] = 8;
            $data1['used_count'] = 0;
            $q = $this->db->insert('user_package_features',$data1);
        }
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
        $review_info = $this->db->where(array('user_id'=>$profile_info->id,'reviewed_by'=>$this->session->userdata('userid')))->get('ratings_reviews')->result();
        if(!empty($review_info))
        {
            $flag = 0;
        }
    }
?>
<!-- START -->
<section>
    <div class="job-prof-pg exp-prof-pg">
        <div class="container">
            <?php
                if($this->session->flashdata('message'))
                {
            ?>
            <div class="log-suc"><p><?= $this->session->flashdata('message') ?></p></div>
            <?php
                }
            ?>
            <div class="row">
                <div class="lhs">
<!--                    <div class="jpro-bd-chat">
                        <h4>Book this                            (<b>Richflayer</b>) Service expert                            <span data-toggle="modal" data-target="#expfrm">Book now</span></h4>
                    </div>-->
                    <!--START-->
                    <div class="profile">
                        <div class="job-days">
                                                        <span class="ver"><i class="material-icons" title="Verified expert">verified_user</i></span>
                                                                                        <span class="rat" title="User rating 5 out of"><?= number_format($rating,1) ?></span>
                                                        </div>
                        <div class="jpro-ban-bg-img">
                            <span><?= $this->db->where('pack_id',$profile_info->packages_id)->get('packages')->row()->pack_name; ?></span>
                            <img
                                src="<?= base_url('assets/') ?>images/services/33982pexels-aleksejs-bergmanis-681368.jpg"
                                alt="" loading="lazy">
                        </div>
                        <div class="jpro-ban-tit">
                            <div class="s1">
                                <img
                                    src="<?= base_url('admin/upload/avatar/'.$profile_info->avatar) ?>"
                                    alt="" loading="lazy">
                            </div>
                            <div class="s2">
                                <h1><?= $profile_info->first_name." ".$profile_info->last_name ?></h1>
                                <span class="loc"><?= $profile_info->company ?></span>
                                <p><?= $profile_info->designation ?></p>
                            </div>
                            <div class="s3">
<!--                                <span
                                    class="cta fol comm-msg-act-btn" data-toggle="modal" data-target="#expfrm">Book now</span>-->
                                <?php
                                    if($flag == 1)
                                    {
                                ?>
                                <span class="cta" data-toggle="modal"
                                      data-target="#expwrirevi">Write Review</span>
                                <?php
                                    }else{
                                ?>
                                <span class="cta" data-toggle="modal"
                                      data-target="#">Write Review</span>
                                <?php
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                    <!--END-->
                    <!--START-->
                    <div class="jb-pro-bio">
                        <h4>About Company</h4>
                        <p><?= $profile_info->about_company ?></p>
                        
                        <ul>
                            <li>
                                Business Entity                                <span><?= empty($profile_info->business_entity)?'-':$profile_info->business_entity ?></span>
                            </li>
                            <li>
                                Business Type                                <span><?= empty($profile_info->business_type)?'-':$profile_info->business_type ?></span>
                            </li>
                            <li>
                                Business Expertise                               <span><?= empty($profile_info->business_experties)?'-':$profile_info->business_experties ?></span>
                            </li>
                            <li>
                                Working From                                <span><?= empty($profile_info->working_from)?'-':$profile_info->working_from ?></span>
                            </li>
                            <li>
                                No. of Employees                                <span><?= empty($profile_info->no_of_employees)?'-':$this->db->where('id',$profile_info->no_of_employees)->get('employee')->row()->title ?></span>
                            </li>
                            <li>
                                Expected Turnover                                <span><?= empty($profile_info->turn_over)?'-':$this->db->where('turn_over_id',$profile_info->turn_over)->get('turn_over')->row()->turn_over_value ?></span>
                            </li>
                            <li>
                                Target Audience                                <span><?= empty($profile_info->target_audiance)?'-':$profile_info->target_audiance ?></span>
                            </li>
                        </ul>
                    </div>
                    <!--END-->
                    <!--START-->
                    <div class="jpro-bd">
<!--                                                                            <div class="jpro-bd-com">
                                <h4>Services can do</h4>
                                                                    <span>Setup Motor and Tap </span>
                                                                        <span>Pipe Line Rework</span>
                                                                        <span>Water Line Connection</span>
                                                                        <span>Fixing blocks and leakages</span>
                                                                </div>-->
                                                    <div class="jb-pro-bio">
                            <h4>Contact Details</h4>
                            <ul>
                            <li>
                                Email                                <span><?= empty($profile_info->email_address)?'-':$profile_info->email_address ?></span>
                            </li>
                            <li>
                                Mobile                                <span><?= empty($profile_info->phone)?'-':$profile_info->phone ?></span>
                            </li>
                            <li>
                                Whatsapp                              <span><?= empty($profile_info->wmobile)?'-':$profile_info->wmobile ?></span>
                            </li>
                            <li>
                                Business Whatsapp                                <span><?= empty($profile_info->company_wmobile)?'-':$profile_info->company_wmobile ?></span>
                            </li>
                            <li>
                                Experience                               <span><?= empty($profile_info->total_experience)?'-':$profile_info->total_experience ?></span>
                            </li>
                            <li>
                                Business Category                              <span><?= empty($profile_info->business_category)?'-':$this->db->where('functional_area_id',$profile_info->business_category)->get('tbl_functional_area')->row()->functional_area ?></span>
                            </li>
                            <li>
                                Website                                <span><?= empty($profile_info->website)?'-':$profile_info->website ?></span>
                            </li>
                            <li>
                                Location                                <span><?= empty($profile_info->company_address)?'-':$profile_info->company_address ?></span>
                            </li>
                            <li>
                                Date of Birth                                <span><?= empty($profile_info->dob)?'-':$profile_info->dob ?></span>
                            </li>
                        </ul>
                        </div>
<!--                        <div class="jpro-bd-com">
                            <h4>Education</h4>
                            <ul>
                                                                    <li>BSC Computer Science</li>
                                                                        <li>Special factory Training</li>
                                                                </ul>
                        </div>-->
<!--                        <div class="jpro-bd-com">
                            <h4>Additional information</h4>
                                                            <span>It uses a dictionary of over 200 Latin words, combined with a handful of model sentence</span>
                                                                <span>It uses a dictionary of over 200 Latin words, combined with a handful of model sentence</span>
                                                        </div>-->
                                                    <div class="jpro-bd-com">
                                <h4>User Reviews</h4>
                                <div class="lp-ur-all-rat">
                                    <?php
                                        $rating_info = $this->db->where('user_id',$profile_info->id)->where('status',1)->get('ratings_reviews')->result();
                                        if(!empty($rating_info))
                                        {
                                    ?>
                                    <ul>
                                        <?php
                                            foreach($rating_info as $val)
                                            {
                                                $ui = $this->db->where('id',$val->reviewed_by)->get('user')->row();
                                        ?>
                                                                                    <li>
                                                <div class="lr-user-wr-img"><img
                                                        src="<?= base_url('admin/upload/avatar/'.$ui->avatar) ?>"
                                                        alt="" loading="lazy">
                                                </div>
                                                <div class="lr-user-wr-con">
                                                    <h6><?= $ui->first_name." ".$ui->last_name ?></h6>
                                                    <label class="rat">
                                                        <?php
                                                            if($val->ratings > 0)
                                                            {
                                                        ?>
                                                        <i class="material-icons">star</i>
                                                        <?php
                                                            }
                                                            else 
                                                            {
                                                        ?>
                                                        <i class="material-icons">star_border</i>
                                                        <?php
                                                            }
                                                        ?>
                                                        <?php
                                                            if($val->ratings > 1)
                                                            {
                                                        ?>
                                                        <i class="material-icons">star</i>
                                                        <?php
                                                            }
                                                            else 
                                                            {
                                                        ?>
                                                        <i class="material-icons">star_border</i>
                                                        <?php
                                                            }
                                                        ?>
                                                        <?php
                                                            if($val->ratings > 2)
                                                            {
                                                        ?>
                                                        <i class="material-icons">star</i>
                                                        <?php
                                                            }
                                                            else 
                                                            {
                                                        ?>
                                                        <i class="material-icons">star_border</i>
                                                        <?php
                                                            }
                                                        ?>
                                                        <?php
                                                            if($val->ratings > 3)
                                                            {
                                                        ?>
                                                        <i class="material-icons">star</i>
                                                        <?php
                                                            }
                                                            else 
                                                            {
                                                        ?>
                                                        <i class="material-icons">star_border</i>
                                                        <?php
                                                            }
                                                        ?>
                                                        <?php
                                                            if($val->ratings > 4)
                                                            {
                                                        ?>
                                                        <i class="material-icons">star</i>
                                                        <?php
                                                            }
                                                            else 
                                                            {
                                                        ?>
                                                        <i class="material-icons">star_border</i>
                                                        <?php
                                                            }
                                                        ?>
                                                                                                                                                                                                                                                                                                                                            </label>
                                                    <span
                                                        class="lr-revi-date"><?= $val->review_date ?></span>
                                                    <p><?= $val->review_note ?></p>
                                                </div>
                                            </li>
                                            <?php } ?>
                                                                                </ul>
                                        <?php } ?>
                                </div>
                            </div>
                                                </div>
                    <div class="jb-pro-bio">
                        <h4>Gallery</h4>
                        <section id="gallery">
                    <div id="image-gallery">
                        <?php
                            $gallery_info = $this->db->where(array('user_id'=>$profile_info->id,'status'=>1,'gallery_type'=>1))->get('gallery')->result();
                            if(!empty($gallery_info))
                            {
                                foreach($gallery_info as $val)
                                {
                        ?>
                                                    <div class="plac-gal-imag">
                                <div class="img-wrapper">
                                    <a href="<?= base_url('admin/upload/gallery/profile/'.$val->image) ?>"><img
                                            src="<?= base_url('admin/upload/gallery/profile/'.$val->image) ?>"
                                            class="img-responsive"></a>
                                    <div class="img-overlay"><i class="material-icons">fullscreen</i></div>
                                </div>
                            </div>
                             <?php
                            }}
                             ?>
                                                </div><!-- End container -->
                </section>
                    </div>
                    
                    <!--END-->
                </div>
                <div class="rhs">
                    <div class="ud-rhs-promo">
                        <h3>Are you a Service Expert?</h3>
                        <p>Register now and generate your income multiple and move your business on next level.</p>
                        <a href="<?= base_url('login') ?>">Register for free</a>
                    </div>
                                        <div class="job-rel-pro">
                        <div class="hot-page2-hom-pre">
                            <h4>Related profiles</h4>
                            <?php
                                $rfi = $this->db->where('business_category',$profile_info->business_category)->where('user_delete',1)->where('id !=',$profile_info->id)->where_in('membership_type',array('1','2'))->order_by('first_name','asc')->limit(10)->get('user')->result();
                                if(!empty($rfi))
                                {
                            ?>
                            <ul>
                                <!-- Expert Service -->
                                <?php
                                    foreach($rfi as $val)
                                    {
                                ?>
                                <li>
                                    <div class="hot-page2-hom-pre-1">
                                        <img src="<?= base_url('admin/upload/avatar/'.$val->avatar) ?>" alt="" loading="lazy">
                                    </div>
                                    <div class="hot-page2-hom-pre-2">
                                        <h5><?= $val->first_name." ".$val->last_name ?> <!--span class="rat">5.0</span--></h5>
                                        <span><b><?= $val->designation ?></b></span>
                                    </div>
                                    <a href="<?= base_url('member_profile/'.$val->id) ?>" class="fclick"></a>
                                </li>
                                <?php
                                    }
                                ?>
                                
                                                            </ul>
                            <?php
                                }
                            ?>
                        </div>
                    </div>
                    <div class="ud-rhs-promo">
                        <h3>Are you a Service Expert?</h3>
                        <p>Register now and generate your income multiple and move your business on next level.</p>
                        <a href="<?= base_url('login') ?>">Register for free</a>
                    </div>
<!--                    <div class="job-rel-pro">
                        <div class="hot-page2-hom-pre">
                            <h4>Trending Services</h4>
                            <ul>
                                                                    <li>
                                        <div class="hot-page2-hom-pre-1">
                                            <img src="<?= base_url('assets/') ?>images/services/63410andras-vas-bd7gnnwjbku-unsplash.jpg" alt="" loading="lazy">
                                        </div>
                                        <div class="hot-page2-hom-pre-2">
                                            <h5>Laptop service</h5>
                                            <span><b>04 Experts</b>, 00 Services Done</span>
                                        </div>
                                        <a href="https://bizbookdirectorytemplate.com/all-service-experts/laptop-service" class="fclick"></a>
                                    </li>
                                                                        <li>
                                        <div class="hot-page2-hom-pre-1">
                                            <img src="<?= base_url('assets/') ?>images/services/53609pexels-blue-bird-7218013.jpg" alt="" loading="lazy">
                                        </div>
                                        <div class="hot-page2-hom-pre-2">
                                            <h5>House Decoration Services</h5>
                                            <span><b>02 Experts</b>, 00 Services Done</span>
                                        </div>
                                        <a href="https://bizbookdirectorytemplate.com/all-service-experts/house-decoration-services" class="fclick"></a>
                                    </li>
                                                                        <li>
                                        <div class="hot-page2-hom-pre-1">
                                            <img src="<?= base_url('assets/') ?>images/services/10799pexels-ksenia-chernaya-5767926.jpg" alt="" loading="lazy">
                                        </div>
                                        <div class="hot-page2-hom-pre-2">
                                            <h5>Home restoration services</h5>
                                            <span><b>00 Experts</b>, 00 Services Done</span>
                                        </div>
                                        <a href="https://bizbookdirectorytemplate.com/all-service-experts/home-restoration-services" class="fclick"></a>
                                    </li>
                                                                </ul>
                        </div>
                    </div>-->
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END -->
<div class="modal fade" id="expwrirevi">

            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="exper-rev-box">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <div class="tit">
                            <h4>Write a Review</h4>
                        </div>
                        <div class="prof">
                            <img
                                src="<?= base_url('admin/upload/avatar/'.$profile_info->avatar) ?>"
                                alt="" loading="lazy">
                            <h3><?= $profile_info->first_name." ".$profile_info->last_name ?></h3>
                            <p>Rate the Service and Care here</p>
                        </div>
                        <form class="col" name="expert_review_form" id="expert_review_form" method="post" action="<?= base_url('home/submit_review') ?>">
                            <input type="hidden" name="user_id" value="<?= $profile_info->id ?>">
                                <div id="expert_review_success"
                                     style="text-align:center;display: none;color: green;">Thanks for your Review !! Your Review Is Successful!!                                </div>
                                <div id="expert_review_fail"
                                     style="text-align:center;display: none;color: red;">Oops!! Something Went Wrong Try Later!!!</div>
                                <div class="rating-new">
                                    <fieldset class="rating">
                                        <input type="radio" id="star5" name="expert_rating"
                                               class="expert_rating" value="5"/>
                                        <label class="full" for="star5" title="Awesome"></label>
                                        <input type="radio" id="star4" name="expert_rating"
                                               class="expert_rating" value="4"/>
                                        <label class="full" for="star4" title="Excellent"></label>
                                        <input type="radio" id="star3"
                                               class="expert_rating" name="expert_rating" value="3"/>
                                        <label class="full" for="star3" title="Good"></label>
                                        <input type="radio" id="star2" name="expert_rating"
                                               class="expert_rating" value="2"/>
                                        <label class="full" for="star2" title="Average"></label>
                                        <input type="radio" id="star1" name="expert_rating"
                                               class="expert_rating" value="1" checked="checked"/>
                                        <label class="full" for="star1" title="Poor"></label>
                                    </fieldset>
                                    <div id="star-value">3 Star</div>
                                </div>
                                <div class="rating-new-msg">
                                    <textarea name="expert_message"
                                              placeholder="Write your comments.."></textarea>
                                </div>
                                <div class="rating-new-cta">
                                    <span data-dismiss="modal">Not now</span>
                                    <button type="submit" name="expert_review_submit"
                                            id="expert_review_submit">Submit Review</button>
                                </div>
                            </form>
                                            </div>
                </div>
            </div>
</div>

   <?php include 'footer.php'; ?>     