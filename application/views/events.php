<?php include 'header.php'; ?>
<?php include 'menu1.php'; ?>
<section class=" blog-head eve-head">
    <div class="container">
        <div class="blog-head-inn">
            <h1>Events</h1>
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

<!-- START -->
<section class=" event-body">
    <div class="container">
        <div class="us-ppg-com">
            <ul id="intseres" class="events-wrapper">
                <?php
                    $events = $this->db->where(array('event_status'=>1,'event_publish_status'=>1))->get('events')->result();
                    if(!empty($events))
                    {
                        foreach($events as $val)
                        {
                ?>
                                        <li class="events-item">
                            <div class="eve-box">
                                <div>
                                    <a href="<?= base_url('event_detail/'.$val->event_id) ?>">
                                        <img src="<?= base_url('admin/upload/events/'.$val->event_thumbnil) ?>"
                                             alt="" loading="lazy">
                                    <span><?= date('M',strtotime($val->event_date)) ?>                                        <b><?= date('d',strtotime($val->event_date)) ?></b></span>
                                    </a>
                                </div>
                                <div>
                                    <h4>
                                        <a href="<?= base_url('event_detail/'.$val->event_id) ?>"><?= $val->event_title ?></a>
                                    </h4>
                                    <span
                                        class="addr">Address: <?= $val->event_address ?></span>
                                    <!--<span class="pho"><?= $val->event_date ?></span>-->
                                </div>
<!--                                <div>
                                    <div class="auth">
                                        <img
                                            src="<?= base_url('assets/') ?>images/user/1.jpg" alt="" loading="lazy">
                                        <b>Hosted by</b><br>
                                        <h4>Richflayer</h4>
                                        <a target="_blank"
                                           href="https://bizbookdirectorytemplate.com/profile/richflayer"
                                           class="fclick"></a>
                                    </div>
                                </div>-->
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