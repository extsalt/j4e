<?php include 'header.php'; ?>
<?php include 'menu1.php'; ?>
<!-- START -->
<section class="  eve-deta-pg">
    <div class="container">
        <div class="eve-deta-pg-main">
            
<!--                            <div class="rhs">
                    <div class="list-rhs-form pglist-bg pglist-p-com">
                        <div class="quote-pop">
                            <h3>Send enquiry</h3>
                            <div id="blog_detail_enq_success" class="log new-tnk-msg" style="display: none;"><p>Your Enquiry Is Submitted Successfully!!!</p>
                            </div>
                            <div id="blog_detail_enq_same" class="log" style="display: none;"><p>You cannot make enquiry on your own blog!!</p>
                            </div>
                            <div id="blog_detail_enq_fail" class="log" style="display: none;"><p>Oops!! Something Went Wrong Try Later!!!</p>
                            </div>
                            <form method="post" name="blog_detail_enquiry_form" id="blog_detail_enquiry_form">

                                                                <fieldset disabled="disabled">
                                    
                                    <input type="hidden" class="form-control" name="blog_id"
                                           value="60"
                                           placeholder=""
                                           required>
                                    <input type="hidden" class="form-control"
                                           name="listing_user_id"
                                           value="323" placeholder=""
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

                                    <div class="form-group ic-user">
                                        <input type="text" name="enquiry_name"
                                               value=""
                                               required="required" class="form-control"
                                               placeholder="Enter name*">
                                    </div>
                                    <div class="form-group ic-eml">
                                        <input type="email" class="form-control"
                                               placeholder="Enter email*"  required="required"
                                               value=""
                                               name="enquiry_email"
                                               pattern="^[\w]{1,}[\w.+-]{0,}@[\w-]{2,}([.][a-zA-Z]{2,}|[.][\w-]{2,}[.][a-zA-Z]{2,})$"
                                               title="Invalid email address" >
                                    </div>
                                    <div class="form-group ic-pho">
                                        <input type="text" class="form-control"
                                               value=""
                                               name="enquiry_mobile"
                                               placeholder="Enter mobile number *"
                                               pattern="[7-9]{1}[0-9]{9}"
                                               title="Phone number starting with 7-9 and remaining 9 digit with 0-9"
                                               required>
                                    </div>
                                    <div class="form-group">
                                        <textarea class="form-control" rows="3" name="enquiry_message"
                                                  placeholder="Enter your query or message"></textarea>
                                    </div>
                                    <input type="hidden" id="source">
                                                                    </fieldset>
                                                                                                <a href="<?= base_url('assets/') ?>login"> <button type="button" name="" class="btn btn-primary">Login & Enjoy Our Services</button></a>
                                                            </form>
                        </div>
                    </div>
                </div>-->
                            <div class="lhs">
                <div class="img">
                    <img src="<?= $blog_info->image ?>" alt="" loading="lazy">
                </div>
                
            </div>
        </div>
    </div>
</section>
<!--END-->

<!-- START -->
<section class=" eve-deta-body blog-deta-body">
    <div class="container">
        <div class="eve-deta-body-main">
            <div class="lhs">
               <div class="head">
<!--                   <div class="eve-bred-crum">
                        <ul>
                        <li><a href="<?= base_url('assets/') ?>">Home</a></li>
                        <li><a href="<?= base_url('assets/') ?>blog-posts">All Blogs</a></li>
                        <li><a href="#">Tips para limpiar tu alberca</a></li>
                        </ul>
                    </div>-->
                    
                    <h1><?= $blog_info->title ?></h1>
                    <div class="blog-bred-post-date">
                        <span class="ic-time"><?= date('d, M Y',strtotime($blog_info->date)) ?></span>
                        <!--<span class="ic-view">29</span>-->
                    </div>
                </div> 
                <?= $blog_info->description ?>
                
<!--                <div class="list-sh">
                        <span class="share-new" data-toggle="modal" data-target="#sharepop"><i class="material-icons">share</i> Share now</span>
                    </div>-->
            </div>
            <div class="rhs">
<!--                <div class="sec-3">
                    <div class="pro-bad-sml">
                        <img src="<?= base_url('assets/') ?>images/user/44529screenshot_3.png" alt="" loading="lazy">
                        <h4>Rn53</h4>
                        <b>Joined on 09, Nov 2022</b>
                        <a target="_blank" href="<?= base_url('assets/') ?>profile/rn53" class="fclick">&nbsp;</a>
                    </div>
                </div>-->
                <div class="sec-4">
                    <h4>Other Post</h4>
                    <!--<input type="text" id="pg-sear" placeholder="Search all posts..">-->
                    <?php
            $blogs = $this->db->where(array('id !='=>$blog_info->id))->get('blogs')->result();
            if(!empty($blogs))
            {
        ?>
                    <ul id="pg-resu">
                        <?php
                            foreach($blogs as $val)
                            {
                        ?>
                                                    <li><a href="<?= base_url('blog_detail/'.$val->id) ?>"><?= $val->title ?></a></li>
                            <?php  } ?>             
                                                </ul>
                    <?php
            }
                    ?>
                </div>
            </div>
        </div>
        
<!--        <div class="pro-rel-posts">
            <h4>Related Posts</h4>
            <div class="us-ppg-com us-ppg-blog">
                <ul>

                                            <li>
                            <div class="pro-eve-box">
                                <div>
                                    <img src="<?= base_url('assets/') ?>images/blogs/35286pexels-leon-ardho-1552242.jpg" alt="" loading="lazy">
                                </div>
                                <div>
                                    <h2>Fat Burner for Men</h2>
                                </div>
                                <a href="<?= base_url('assets/') ?>blog/fat-burner-for-men" class="fclick">&nbsp;</a>
                            </div>
                        </li>
                                                <li>
                            <div class="pro-eve-box">
                                <div>
                                    <img src="<?= base_url('assets/') ?>images/blogs/66772pexels-robo-michalec-9390184.jpg" alt="" loading="lazy">
                                </div>
                                <div>
                                    <h2>Beach Football for Mens 2022</h2>
                                </div>
                                <a href="<?= base_url('assets/') ?>blog/beach-football-for-mens-2022" class="fclick">&nbsp;</a>
                            </div>
                        </li>
                                                <li>
                            <div class="pro-eve-box">
                                <div>
                                    <img src="<?= base_url('assets/') ?>images/blogs/799270128fd36-66c8-4f0a-a98f-932a954f37d5.jpeg" alt="" loading="lazy">
                                </div>
                                <div>
                                    <h2>T’contact@test,com</h2>
                                </div>
                                <a href="<?= base_url('assets/') ?>blog/t---contact-test-com" class="fclick">&nbsp;</a>
                            </div>
                        </li>
                                        </ul>
            </div>
        </div>-->
    </div>
</section>
<!--END-->
   <?php include 'footer.php'; ?>     