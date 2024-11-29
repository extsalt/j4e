<?php include 'header.php'; ?>
<?php include 'menu1.php'; ?>
<style>
    
.short{
    overflow: hidden;
   text-overflow: ellipsis;
   display: -webkit-box;
   min-height: 100px;
   /*line-height: 16px;  fallback */
   max-height: 100px; /* fallback */
   /*-webkit-line-clamp: 2;  number of lines to show */
   -webkit-box-orient: vertical;
}
.full{
    height:auto;
}
.read-more {
   cursor: pointer;
}
</style>
<section class=" blog-head eve-head">
    <div class="container">
        <div class="blog-head-inn">
            <h1>Posts</h1>
            <!--<p>Here post your events, seminar, webinar, fetivals and more</p>-->
        </div>
<!--        <div class="ban-search">
            <form>
                <ul>
                    <li class="sr-sea">
                        <input type="text" id="event-search" class="autocomplete"
                               placeholder="Search event in your city...">
                    </li>
                </ul>
            </form>
        </div>-->
                
            </div>
</section>
<!--END-->

<section class="news-hom-big">
    <div class="container">
        <div class="row">
            <?php
                $posts = $this->db->where('post_status',1)->get('postdetail')->result();
                if(!empty($posts))
                {
                    foreach($posts as $val)
                    {
            ?>
            <div class="col-md-6">
                
                                    <!--BIG POST START-->
                    <div class="news-home-box ">
                        <div class="im" style="min-height: 399px;">
                            <img src="<?= base_url('admin/upload/post/'.$val->post_image) ?>"
                                 alt="" loading="lazy">
                        </div>
                        <div class="txt">
                            <span class="news-cate"><?php
                            if(empty($val->post_catid))
                            {
                                if($val->post_type == 1)
                                {
                                    echo "Buddy Meet";
                                }
                                if($val->post_type == 2)
                                {
                                    echo "Requirement";
                                }
                                if($val->post_type == 3)
                                {
                                    echo "Event";
                                }
                            }else{
                                echo $this->db->where('cat_id',$val->post_catid)->get('postcategory')->row()->cat_name;
                            }
                                ?></span>
                            <!--<h2>Kiribatii goes into first lockdown after Covid flight cases</h2>-->
                            <p>
                                <div class="text short">
                            <?= $val->post_description ?>
                                </div>
                            <!--<br>-->
                            <span class="read-more"><a title="Read More">...</a></span>
                            </p>
                            <span class="news-date"><?= date('d, M Y',strtotime($val->post_date)) ?></span>
                            <!--<span class="news-views">277 Views</span>-->
                        </div>
                        <!--<a href="#" class="fclick"></a>-->
                    </div>
            </div>
            <?php
                    }
                }
            ?>
        </div>
    </div>
</section>
<!--END-->

   <?php include 'footer.php'; ?>     