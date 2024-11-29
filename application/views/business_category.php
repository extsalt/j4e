<?php include 'header.php'; ?>
<?php include 'menu1.php'; ?>   
<section class="abou-pg commun-pg-main">
    <div class="about-ban comunity-ban">
        <h1>All Services</h1>
        <!--<p>Connect with the right Service Experts</p>-->
        <input type="text" id="tail-se" placeholder="Search Service here.." onkeyup="getSearchServiceByName(this.value)">
    </div>
</section>

<!-- START -->
<section>
    <div class="str all-cate-pg">
        <div class="container">
            <div class="row">
                <div class="sh-all-scat">
                    <?php
                        $service_info = $this->db->where('status',1)->order_by('functional_area','asc')->get('tbl_functional_area')->result();
                        if(!empty($service_info))
                        {
                            foreach($service_info as $val)
                            {
                    ?>

                                            <ul id="tail-re">
                            <li>
                                <div class="sh-all-scat-box">
                                    <div class="lhs">
                                        <img src="<?= base_url('admin/'.$val->functional_area_thumbnil) ?>"
                                             alt="" loading="lazy">
                                    </div>
                                    <div class="rhs">
                                        <h4>
                                            <a href="<?= base_url('profile_listing/'.$val->functional_area_id) ?>"><?= $val->functional_area ?> </a><!--span>07</span-->
                                        </h4>
<!--                                        <ol>
                                                                                            <li>
                                                    <a href="<?= base_url('profile_listing/1') ?>">Community Hospitals                                                        <span>05</span></a>
                                                </li>
                                                                                                <li>
                                                    <a href="<?= base_url('profile_listing/1') ?>">Clinics                                                        <span>06</span></a>
                                                </li>
                                                                                                <li>
                                                    <a href="<?= base_url('profile_listing/1') ?>">Child Hospitals                                                        <span>05</span></a>
                                                </li>
                                                                                        </ol>-->
                                    </div>
                                </div>
                            </li>
                        </ul>
                       
                        <?php
                            }
                        }
                        ?>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END -->

   <?php include 'footer.php'; ?>     