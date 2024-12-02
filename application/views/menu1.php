<?php
$website_setting = $this->db->where('id', 1)->get('website_settings')->row();
$setting = $this->db->where('id', 1)->get('setting')->row();
?>
<!-- START -->
<section>
    <div class="str ind2-home">
        <div>
            <div class="hom-top">
                <div class="container">
                    <div class="row">
                        <div class="hom-nav "><!--MOBILE MENU-->
                            <a href="<?= base_url('home') ?>" class="top-log"><img
                                    src="<?= base_url('assets/') ?>images/j4e logo.png"
                                    style="width: 192px; height: 35px;" alt="" loading="lazy" class="ic-logo"></a>

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
                            if ($this->session->userdata('isLogIn')) {
                                $user_info = $this->db->where('id', $this->session->userdata('userid'))->get('user')->row();
                            ?>
                                <div class="al" style="padding-left: 10px;">
                                    <div class="head-pro">
                                        <img
                                            src="<?= base_url('admin/upload/avatar/' . $user_info->avatar) ?>" alt="User" loading="lazy" title="Go to dashboard">
                                        <span class="fclick near-pro-cta"></span>
                                    </div>
                                    <div class="db-menu">
                                        <span class="material-icons db-menu-clo">close</span>
                                        <div class="ud-lhs-s1">
                                            <img
                                                src="<?= base_url('admin/upload/avatar/' . $user_info->avatar) ?>" alt="" loading="lazy">
                                            <div class="ud-lhs-pro-bio">
                                                <h4><?= $user_info->first_name . " " . $user_info->last_name ?></h4>
                                                <b>Join on <?= date('d, M Y', strtotime($user_info->created_time)) ?></b>
                                                <a class="ud-lhs-view-pro" target="_blank"
                                                    href="<?= base_url('member_profile/' . $user_info->id) ?>">My Profile</a>
                                            </div>
                                        </div>
                                        <ul>
                                            <li>
                                                <a href="<?= base_url('dashboard') ?>"
                                                    class="db-lact"><img src="<?= base_url('assets/') ?>images/icon/dbl1.png"
                                                        alt="" loading="lazy" /> My Dashboard</a>
                                            </li>

                                            <li>
                                                <a href="<?= base_url('point_history') ?>"
                                                    class=""><img src="<?= base_url('assets/') ?>images/icon/point.png"
                                                        alt="" loading="lazy" />Points History</a>
                                            </li>

                                            <li>
                                                <a href="<?= base_url('edit_profile') ?>"
                                                    class=""><img src="<?= base_url('assets/') ?>images/icon/profile.png"
                                                        alt="" loading="lazy" />Edit Profile</a>
                                            </li>

                                            <li>
                                                <a href="<?= base_url('payments') ?>"
                                                    class=""><img src="<?= base_url('assets/') ?>images/icon/dbl9.png"
                                                        alt="" loading="lazy">Payment & plan</a>
                                            </li>

                                            <li>
                                                <a href="<?= base_url('logout') ?>"><img
                                                        src="<?= base_url('assets/') ?>images/icon/dbl12.png"
                                                        alt="" loading="lazy" />Log Out</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>
                            <ul class="bl">
                                <li>
                                    <a href="<?= base_url('home') ?>">Home</a>
                                </li>
                                <li>
                                    <a href="<?= base_url('about') ?>" class="active">About</a>
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
                                <?php
                                if (!$this->session->userdata('isLogIn')) {
                                ?>
                                    <li>
                                        <a href="<?= base_url('login') ?>">Create an account</a>
                                    </li>
                                <?php
                                }
                                ?>
                            </ul>


                            <!--MOBILE MENU-->

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

                                            <?php
                                            if (!$this->session->userdata('isLogIn')) {
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

        </div>
    </div>
</section>
<!-- END -->