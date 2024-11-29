<?php include 'header.php'; ?>
<?php include 'menu1.php'; ?>
<!-- START -->
<section class=" blog-head">
    <div class="container">
        <div class="blog-head-inn">
            <h1>J4E Stories</h1>
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
                    $blogs = $this->db->get('blogs')->result();
                    if(!empty($blogs))
                    {
                        foreach($blogs as $val)
                        {
                ?>
                                    <li class="blog-item">
                        <div class="pro-eve-box">
                            <div>
                                <img src="<?= base_url('admin/'.$val->image) ?>" alt="" loading="lazy">
                            </div>
                            <div>
                                <h2><?= $val->title ?></h2>
                                <span class="ic-time"><?= date('d, M Y',strtotime($val->date)) ?></span>
                                <!--<span class="ic-view">29</span>-->
                            </div>
                            <a href="<?= base_url('blog_detail/'.$val->id) ?>" class="fclick">
                                &nbsp;</a>
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