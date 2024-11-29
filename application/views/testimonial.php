<?php include 'header.php'; ?>
<?php include 'menu1.php'; ?>
<!-- START -->
<section class=" blog-head">
    <div class="container">
        <div class="blog-head-inn">
            <h1>J4E Testimonials</h1>
            <!--<p>Here submit your blogs and make your own audiance.</p>-->
        </div>
<!--        <div class="ban-search">
            <form>
                <ul>
                    <li class="sr-sea">
                        <input type="text" id="blog-search" class="autocomplete" placeholder="Search blog posts...">
                    </li>
                </ul>
            </form>
        </div>-->
                
            </div>
</section>
<!--END-->

<!-- START -->
<section class=" blog-body">
    <div class="container">
        <div class="us-ppg-com us-ppg-blog">
            <ul id="intseres" class="blog-wrapper">
                <?php
                    $testimonials = $this->db->get('testimonials')->result();
                    if(!empty($testimonials))
                    {
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
                        }
                        ?>
                                        
                                </ul>
        </div>

    </div>
</section>
<!--END-->
   <?php include 'footer.php'; ?>     