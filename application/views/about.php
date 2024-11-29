<?php include 'header.php'; ?>
<?php include 'menu1.php'; ?>
<!-- START -->

    
<section class=" abou-pg abou-pg1">
    <div class="about-ban">
        <h1>About us</h1>
        <!--<p>injected humourThere are many variations of passages of Lorem Ipsum available now</p>-->
    </div>
    <div class="container">
        <div class="row">
            <div class="about-us">
                <?= $website_setting->about ?>
            </div>
            <?php
        $wcu = $this->db->get('why_choose_us')->result();
        if(!empty($wcu))
        {
    ?>
            <div class="how-wrks">
                <div class="home-tit">
                    <h2><span>Why Choose Us</span></h2>
                    <!--<p>Explore some of the best tips from around the world from our partners and friends</p>-->
                </div>
                <div class="how-wrks-inn">
                    <ul>
                        <?php
//                                    $cnt = 1;
                                    foreach($wcu as $val)
                                    {
                                ?>
                        <li>
                            <div>
                                <img src="<?= base_url('admin/'.$val->image) ?>" alt="" loading="lazy">
                                <h4><?= $val->title ?></h4>
                                <p><?= $val->description ?></p>
                            </div>
                        </li>
                        <?php
//                                    $cnt++;
                                    }
                                ?>
                    </ul>
                </div>
            </div>
            <?php
        }
    ?>
            <?php
        $our_team = $this->db->get('our_team')->result();
        if(!empty($our_team))
        {
    ?>
            <div class="how-wrks how-wrks-2">
                <div class="home-tit">
                    <h2><span>Our Team</span></h2>
                    <!--<p>Explore some of the best tips from around the world from our partners and friends</p>-->
                </div>
                <div class="how-wrks-inn abo-memb">
                    <ul>
                         <?php
//                                    $cnt = 1;
                                    foreach($our_team as $val)
                                    {
                                ?>
                        <li>
                            <div>
                                <img src="<?= base_url('admin/'.$val->image) ?>" alt="" loading="lazy">
                                <h4><?= $val->title ?></h4>
                                <p><?= $val->description ?></p>
                            </div>
                        </li>
                        <?php
//                                    $cnt++;
                                    }
                                ?>
                    </ul>
                </div>
            </div>
            <?php
        }
    ?>
        </div>
    </div>
</section>
<!--END-->
	


   <?php include 'footer.php'; ?>     