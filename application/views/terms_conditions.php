<?php include 'header.php'; ?>
<?php include 'menu1.php'; ?>

    <section class=" login-reg">
    <div class="container">
        <div class="row">
            <div class="plainpg">
                <h1>Terms of Use</h1>
                <?php
                    $info = $this->db->where('infpg_id',7)->get('infopages')->row();
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