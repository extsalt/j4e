<?php
    $website_setting = $this->db->where('id',1)->get('website_settings')->row();
    $setting = $this->db->where('id',1)->get('setting')->row();
    $services = $this->db->where('status',1)->order_by('functional_area','asc')->limit(8)->get('tbl_functional_area')->result();
?>
<!-- START -->
<section>
    <div class="str ind2-home">
                <div  class="hom-head" style=" background-image: url(<?= base_url('admin/'.$website_setting->home_slider) ?>);" >
            <div class="hom-top">
                <div class="container">
                    <div class="row">
                        <div class="hom-nav "><!--MOBILE MENU-->
                            <a href="<?= base_url('home') ?>" class="top-log"><img
                                    src="<?= base_url('assets/') ?>images/j4e logo.png"
                                    style="width:192px; height: 35px;" alt="" loading="lazy" class="ic-logo"></a>
                            
                            <!--END MOBILE MENU-->
                            <div class="top-ser">
                                <form name="filter_form" id="filter_form" class="filter_form">
                                    <ul>
                                        <li class="sr-sea">
                                            <input type="text" autocomplete="off" id="top-select-search"
                                                   placeholder="Search Members" onkeyup="getSearchProfileByName(this.value)">
                                            <ul id="tser-res" class="tser-res tser-res2" style="display:none;">

                                                                                                </ul>
                                        </li>

                                        <li class="sbtn">
                                            <button type="button" class="btn btn-success" id="top_filter_submit"><i
                                                    class="material-icons">&nbsp;</i></button>
                                        </li>
                                    </ul>
                                </form>
                            </div>
                            <?php
                                    if ($this->session->userdata('isLogIn'))                                
                                    {
                                        $user_info = $this->db->where('id',$this->session->userdata('userid'))->get('user')->row();
                                ?>
                                <div class="al" style="padding-left: 10px;">
                                    <div class="head-pro">
                                        <img
                                            src="<?= base_url('admin/upload/avatar/'.$user_info->avatar) ?>" alt="User" loading="lazy" title="Go to dashboard">
                                        <span class="fclick near-pro-cta"></span>
                                    </div>
                                    <div class="db-menu">
                                        <span class="material-icons db-menu-clo">close</span>
                                        <div class="ud-lhs-s1">
                                            <img
                                                src="<?= base_url('admin/upload/avatar/'.$user_info->avatar) ?>" alt="" loading="lazy">
                                            <div class="ud-lhs-pro-bio">
                                                <h4><?= $user_info->first_name." ".$user_info->last_name ?></h4>
                                                <b>Join on <?= date('d, M Y',strtotime($user_info->created_time)) ?></b>
                                                <a class="ud-lhs-view-pro" target="_blank"
                                                   href="<?= base_url('member_profile/'.$user_info->id) ?>">My Profile</a>
                                            </div>
                                        </div>
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
                                </div>
                                <?php
                                }
                                ?>
                                                            <ul class="bl">
                                                                <li >
                                    <a href="<?= base_url('home') ?>" class="active">Home</a>
                                    </li>
                                    <li>
                                    <a href="<?= base_url('about') ?>">About</a>
                                    </li>
                                    <li>
                                    <a href="<?= base_url('event') ?>">Events</a>
                                    </li>
                                    <li>
                                    <a href="<?= base_url('post') ?>">Posts</a>
                                    </li>
                                    <li>
                                    <a href="<?= base_url('blog') ?>">J4E Stories</a>
                                    </li>
                                    <li>
                                    <a href="<?= base_url('testimonial') ?>">J4E Testimonials</a>
                                    </li>
                                    <li>
                                    <a href="<?= base_url('contact') ?>">Contact</a>
                                    </li>
<!--                                    <li>
                                        <a href="https://bizbookdirectorytemplate.com/pricing-details">Add business</a>
                                    </li>
                                    <li>
                                        <a href="https://bizbookdirectorytemplate.com/login">Sign in</a>
                                    </li>-->
                                    <?php
                                        if (!$this->session->userdata('isLogIn'))                                
                                        {
                                    ?>
                                    <li>
                                        <a href="<?= base_url('login') ?>">Create an account</a>
                                    </li>
                                    <?php
                                        }
                                    ?>
                                </ul>
                                                            <!--MOBILE MENU-->
                            <div class="mob-menu">
                                <div class="mob-me-ic"><i class="material-icons">menu</i></div>
                                <div class="mob-me-all">
                                    <div class="mob-me-clo"><i class="material-icons">close</i></div>
                                                                            <div class="mv-bus">
                                            <h4></h4>
                                            <ul>
                                                <li>
                                    <a href="<?= base_url('home') ?>">Home</a>
                                    </li>
                                    <li>
                                    <a href="<?= base_url('about') ?>">About</a>
                                    </li>
                                    <li>
                                    <a href="<?= base_url('event') ?>">Events</a>
                                    </li>
                                    <li>
                                    <a href="<?= base_url('post') ?>">Posts</a>
                                    </li>
                                    <li>
                                    <a href="<?= base_url('blog') ?>">J4E Stories</a>
                                    </li>
                                    <li>
                                    <a href="<?= base_url('testimonial') ?>">J4E Testimonials</a>
                                    </li>
                                    <li>
                                    <a href="<?= base_url('contact') ?>">Contact</a>
                                    </li>
<!--                                                <li>
                                                    <a href="https://bizbookdirectorytemplate.com/pricing-details">Add business</a>
                                                </li>
                                                <li>
                                                    <a href="https://bizbookdirectorytemplate.com/login">Sign in</a>
                                                </li>-->
                                                <?php
                                        if (!$this->session->userdata('isLogIn'))                                
                                        {
                                    ?>
                                    <li>
                                        <a href="<?= base_url('login') ?>">Create an account</a>
                                    </li>
                                    <?php
                                        }
                                    ?>
                                            </ul>
                                        </div>
<!--                                                                            <div class="mv-cate">
                                        <h4>All Categories</h4>
                                        <ul>
                                                                                            <li>
                                                    <a href="https://bizbookdirectorytemplate.com/all-listing/hospitals">Hospitals</a>
                                                </li>
                                                                                            <li>
                                                    <a href="https://bizbookdirectorytemplate.com/all-listing/electricals">Electricals</a>
                                                </li>
                                                                                            <li>
                                                    <a href="https://bizbookdirectorytemplate.com/all-listing/spa-and-facial">Spa and Facial</a>
                                                </li>
                                                                                            <li>
                                                    <a href="https://bizbookdirectorytemplate.com/all-listing/automobiles">Automobiles</a>
                                                </li>
                                                                                            <li>
                                                    <a href="https://bizbookdirectorytemplate.com/all-listing/wedding-halls">Wedding halls</a>
                                                </li>
                                                                                            <li>
                                                    <a href="https://bizbookdirectorytemplate.com/all-listing/restaurants">Restaurants</a>
                                                </li>
                                                                                            <li>
                                                    <a href="https://bizbookdirectorytemplate.com/all-listing/technology">Technology</a>
                                                </li>
                                                                                            <li>
                                                    <a href="https://bizbookdirectorytemplate.com/all-listing/pet-shop">Pet shop</a>
                                                </li>
                                                                                            <li>
                                                    <a href="https://bizbookdirectorytemplate.com/all-listing/real-estate">Real Estate</a>
                                                </li>
                                                                                            <li>
                                                    <a href="https://bizbookdirectorytemplate.com/all-listing/sports">Sports</a>
                                                </li>
                                                                                            <li>
                                                    <a href="https://bizbookdirectorytemplate.com/all-listing/education">Education</a>
                                                </li>
                                                                                            <li>
                                                    <a href="https://bizbookdirectorytemplate.com/all-listing/transportation">Transportation</a>
                                                </li>
                                                                                    </ul>
                                    </div>-->
                                </div>
                            </div>
                            <!--END MOBILE MENU-->
                        </div>
                    </div>
                </div>
            </div>

                            <div class="container">
                    <div class="row">
                        <div class="ban-tit">
                            <h1>
                                <?= $website_setting->home_slider_caption ?>
<!--                                                                    Restaurants, cafe's, and bars in New york                                                           -->
                            </h1>
                        </div>
<!--                        <div class="ban-search ban-sear-all">
                            <form name="filter_form" id="filter_form" class="filter_form">
                                <ul>
                                    <li class="sr-cate">
                                        <select onChange="getSearchCategories(this.value);" name="explor_select" id="explor_select" data-placeholder="Select Services" class="chosen-select" >
                                            <option value="">Select Services</option>
                                                                                        <option value="0">All Services</option>
                                                                                        <?php
                                                                                            if(!empty($services))
                                                                                            {
                                                                                                foreach($services as $val)
                                                                                                {
                                                                                        ?>
                                                                                        <option value="<?= $val->functional_area_id ?>"><?= $val->functional_area ?></option>
                                                                                        <?php
                                                                                                }
                                                                                            }
                                                                                        ?>
                                                                                    </select>
                                    </li>
                                    <li class="sr-cit">
                                        <select id="city_check" name="city_check" data-placeholder="Select City" class="chosen-select">
                                                                                                    <option                                                             value="48025">Los Angeles</option>
                                                                                                                <option                                                             value="48026">Chicago</option>
                                                                                                                <option                                                             value="48027">Houston</option>
                                                                                                                <option                                                             value="48028">Phoenix</option>
                                                                                                                <option                                                             value="48024">New York City</option>
                                                                                                                <option                                                             value="48029">Philadelphia</option>
                                                                                                                <option                                                             value="48030">San Antonio</option>
                                                                                                                <option                                                             value="48031">San Diego</option>
                                                                                                                <option                                                             value="48032">Dallas</option>
                                                                                                                <option                                                             value="48035">Illunois city</option>
                                                                                                                <option selected                                                            value=""></option>
                                                                                                </select>
                                    </li>
                                    <li class="sr-nor" style="display:none;">
                                        <select id="expert-select-search" name="expert-select-search" class="chosen-select">
                                            <option value="">What are you looking for?</option>
                                                                                            <option
                                                    value="Hospitals">Hospitals</option>
                                                                                                <option
                                                    value="Electricals">Electricals</option>
                                                                                                <option
                                                    value="Spa and Facial">Spa and Facial</option>
                                                                                                <option
                                                    value="Automobiles">Automobiles</option>
                                                                                                <option
                                                    value="Wedding halls">Wedding halls</option>
                                                                                                <option
                                                    value="Restaurants">Restaurants</option>
                                                                                                <option
                                                    value="Technology">Technology</option>
                                                                                                <option
                                                    value="Pet shop">Pet shop</option>
                                                                                                <option
                                                    value="Real Estate">Real Estate</option>
                                                                                                <option
                                                    value="Sports">Sports</option>
                                                                                                <option
                                                    value="Education">Education</option>
                                                                                                <option
                                                    value="Transportation">Transportation</option>
                                                                                        </select>
                                    </li>
                                    <li class="sr-sea">
                                        <input type="text" autocomplete="off" id="select-search"
                                               placeholder="Search for Members"
                                               class="search-field" onkeyup="getSearchProfileByName(this.value)">
                                        <ul id="tser-res1" class="tser-res tser-res1" style="display:none;">
                                                                                            
                                                                                               
                                                                                        </ul>
                                    </li>
                                    <li class="sr-btn">
                                        <input type="submit" id="filter_submit" name="filter_submit"
                                               value="Search" class="filter_submit">
                                    </li>
                                </ul>
                            </form>
                        </div>-->
                        
                    </div>
                </div>
                    </div>
    </div>
</section>
<!-- END -->    <style>
        .hom-top {
            transition: all 0.5s ease;
            /*background: none;*/
            box-shadow: none;
        }

/*        .top-ser {
            display: none;
        }*/

        .dmact .top-ser {
            display: block;
        }

        .caro-home {
            margin-top: 90px;
            float: left;
            width: 100%;
        }

        .carousel-item:before {
            background: none;
        }
    </style>
    
