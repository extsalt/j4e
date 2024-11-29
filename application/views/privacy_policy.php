<?php include 'header.php'; ?>
<?php include 'menu1.php'; ?>

    <section class=" login-reg">
    <div class="container">
        <div class="row">
            <div class="plainpg">
                <h1>Privacy Policy</h1>
                <?php
                    $info = $this->db->where('infpg_id',6)->get('infopages')->row();
                    if(!empty($info))
                    {
                        echo $info->infpg_desc_eng;
                    }
                ?>
            </div>
        </div>
    </div>
</section>

   <?php include 'footer.php'; ?>     