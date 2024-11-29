<?php
    $res = $this->db->where('phone',$id)->get('user')->row_array();
    $res1 = $this->db->where('functional_area_id',$res['business_category'])->get('tbl_functional_area')->row_array();
    $res2 = $this->db->where('user_id',$res['id'])->where('status',1)->get('ratings_reviews')->result_array();
    $res3 = $this->db->where('user_id',$res['id'])->where('status',1)->get('ratings_reviews')->result_array();
    $total_no_of_count = mysqli_num_rows($result2);
    $totalreviewcount = 0;
    $usss=0;
    $review_note=array();
    $ratingg=0;
    $one_star = $two_star = $three_star = $four_star = $five_star = 0;
    for($i=0;$i<count($res2);$i++)
    {
        if($res2[$i]['ratings'] == 1 || $res2[$i]['ratings'] == 1.5)
        {
            $one_star++;
        }
        if($res2[$i]['ratings'] == 2 || $res2[$i]['ratings'] == 2.5)
        {
            $two_star++;
        }
        if($res2[$i]['ratings'] == 3 || $res2[$i]['ratings'] == 3.5)
        {
            $three_star++;
        }
        if($res2[$i]['ratings'] == 4 || $res2[$i]['ratings'] == 4.5)
        {
            $four_star++;
        }
        if($res2[$i]['ratings'] == 5)
        {
            $five_star++;
        }
        $ratingg= $ratingg+ floatval($res2[$i]['ratings']);
        $usss++;
        $totalreviewcount++;    
    }
    if(!empty($usss))
    {
    $average_ratings=floatval($ratingg)/floatval($usss);			        
    $avegare_rat=number_format((float)$average_ratings, 1, '.', '');
    }
    else
    {
        $avegare_rat = 0.00;
    }
    if($avegare_rat > 0 && $avegare_rat < 1)
    {
        $full = "full20";
        $fill = "fill20";
    }
    else if($avegare_rat > 1 && $avegare_rat < 2)
    {
        $full = "full40";
        $fill = "fill40";
    }
    else if($avegare_rat > 2 && $avegare_rat < 3)
    {
        $full = "full60";
        $fill = "fill60";
    }
    else if($avegare_rat > 4 && $avegare_rat < 5)
    {
        $full = "full80";
        $fill = "fill80";
    }
    else if($avegare_rat == 5)
    {
        $full = "full100";
        $fill = "fill100";
    }
    else
    {
        $full = "";
        $fill = "";
    }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    
    <title><?= $res['first_name']." ".$res['last_name'] ?></title>
    <link rel="shortcut icon" href="<?= base_url('admin/') ?>upload/avatar/<?= $res['avatar'] ?>" type="image/x-icon">
    <link rel="stylesheet" href="<?= base_url('assets/portfolio/') ?>css/style.css" />
  </head>
  <body>
    <div class="container">
       <div class="flex jse header">
        <div>
          <img src="<?= base_url('admin/') ?>upload/avatar/<?= $res['avatar'] ?>" alt="" />
        </div>
        <div>
          <h3 class="mb1 flex aic space"><?= $res['first_name']." ".$res['last_name'] ?></h3>
          <h5 class="space"><?= empty($res['company'])?'Not Available':$res['company'] ?></h5>
          <p><?= empty($res1['functional_area'])?'Not Available':$res1['functional_area'] ?>,<?= empty($res['business_type'])?'Not Available':$res['business_type'] ?>, <?= empty($res['business_entity'])?'Not Available':$res['business_entity'] ?>. <?= empty($res['total_experience'])?'Not Available':$res['total_experience'] ?></p>
        </div>
      </div>
      <!--------------------------------NAVIGATION----------------------------------- -->
      <div class="nav">
        <ul class="flex jcsb">
          <li>
            <a href="<?= base_url('profile/'.$id) ?>">About Us</a>
            
          </li>
          <li><a href="<?= base_url('contact1/'.$id) ?>">Contact Us</a>
          </li>
          <li><a href="<?= base_url('gallery/'.$id) ?>">Gallery</a>
              </li>
          
          <li><a href="<?= base_url('reviews/'.$id) ?>">Reviews</a>
              <div class="active3"></div>
          </li>
        </ul>
      </div>
      <!-------------------- RATING ----------------------->
      <div class="rating mTop">
        <p>Total No. Rating :<?= str_pad($totalreviewcount, 2, '0', STR_PAD_LEFT) ?></p>
        <div class="rating_container">
            
          <div class="rating_card">
            <div class="circle-wrap <?php if($avegare_rat == 5){ echo 'circle-wrap100'; } ?>">
              <div class="circle <?php if($avegare_rat == 5){ echo 'circle100'; } ?>">
                <div class="mask <?php if($avegare_rat == 5){ echo 'mask100'; } ?> full <?= $full ?>">
                  <div class="fill <?= $fill ?>"></div>
                </div>
                <div class="mask half">
                  <div class="fill <?= $fill ?>"></div>
                </div>
                <div class="inside-circle"><?= $avegare_rat ?>/5</div>
              </div>
            </div>
          </div>
           
          <div class="rating_card">
            <div class="rating-bar">
              <span><?= str_pad($one_star, 2, '0', STR_PAD_LEFT) ?>/<?= str_pad($totalreviewcount, 2, '0', STR_PAD_LEFT) ?></span>
              <div class="bar_container">
                <div class="bar-<?= $one_star ?>"></div>
              </div>
            </div>
            <div class="rating-bar">
              <span><?= str_pad($two_star, 2, '0', STR_PAD_LEFT) ?>/<?= str_pad($totalreviewcount, 2, '0', STR_PAD_LEFT) ?></span>
              <div class="bar_container">
                <div class="bar-<?= $two_star ?>"></div>
              </div>
            </div>
            <div class="rating-bar">
              <span><?= str_pad($three_star, 2, '0', STR_PAD_LEFT) ?>/<?= str_pad($totalreviewcount, 2, '0', STR_PAD_LEFT) ?></span>
              <div class="bar_container">
                <div class="bar-<?= $three_star ?>"></div>
              </div>
            </div>
            <div class="rating-bar">
              <span><?= str_pad($four_star, 2, '0', STR_PAD_LEFT) ?>/<?= str_pad($totalreviewcount, 2, '0', STR_PAD_LEFT) ?></span>
              <div class="bar_container">
                <div class="bar-<?= $four_star ?>"></div>
              </div>
            </div>
            <div class="rating-bar">
              <span><?= str_pad($five_star, 2, '0', STR_PAD_LEFT) ?>/<?= str_pad($totalreviewcount, 2, '0', STR_PAD_LEFT) ?></span>
              <div class="bar_container">
                <div class="bar-<?= $five_star ?>"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-------------------- REVIEWS ----------------------->
      <div class="reviews">
        <p>Total No. Rating :<?= str_pad($totalreviewcount, 2, '0', STR_PAD_LEFT) ?></p>
        <?php
            for($i=0;$i<count($res3);$i++)
            {
                $res4 = $this->db->where('id',$res3[$i]['reviewed_by'])->get('user')->row_array();
            ?>
        <div class="review_container">
            
          <div class="review_card">
            <div>
              <div class="name">
                  <div><?= substr($res4['first_name'],0, 1) ?></div>
              </div>
              <span class="review_name"><?= $res4['first_name']." ".$res4['last_name'] ?></span>
              <span class="review_date"><?= $res3[$i]['review_date'] ?></span>
            </div>
            <div>
                <?php
                    if($res3[$i]['ratings'] == 1 || $res3[$i]['ratings'] == 1.5)
                    {
                ?>
              <img src="<?= base_url('assets/portfolio/') ?>assets/star@2x.png" alt="star" class="star" />
              <img src="<?= base_url('assets/portfolio/') ?>assets/star@2x.png" alt="star" class="blank" />
              <img src="<?= base_url('assets/portfolio/') ?>assets/star@2x.png" alt="star" class="blank" />
              <img src="<?= base_url('assets/portfolio/') ?>assets/star@2x.png" alt="star" class="blank" />
              <img src="<?= base_url('assets/portfolio/') ?>assets/Star blank@2x.png" alt="star" class="blank" />
              <?php
                    }
              ?>
              <?php
                    if($res3[$i]['ratings'] == 2 || $res3[$i]['ratings'] == 2.5)
                    {
                ?>
              <img src="<?= base_url('assets/portfolio/') ?>assets/star@2x.png" alt="star" class="star" />
              <img src="<?= base_url('assets/portfolio/') ?>assets/star@2x.png" alt="star" class="star" />
              <img src="<?= base_url('assets/portfolio/') ?>assets/star@2x.png" alt="star" class="blank" />
              <img src="<?= base_url('assets/portfolio/') ?>assets/star@2x.png" alt="star" class="blank" />
              <img src="<?= base_url('assets/portfolio/') ?>assets/Star blank@2x.png" alt="star" class="blank" />
              <?php
                    }
              ?>
              <?php
                    if($res3[$i]['ratings'] == 3 || $res3[$i]['ratings'] == 3.5)
                    {
                ?>
              <img src="<?= base_url('assets/portfolio/') ?>assets/star@2x.png" alt="star" class="star" />
              <img src="<?= base_url('assets/portfolio/') ?>assets/star@2x.png" alt="star" class="star" />
              <img src="<?= base_url('assets/portfolio/') ?>assets/star@2x.png" alt="star" class="star" />
              <img src="<?= base_url('assets/portfolio/') ?>assets/star@2x.png" alt="star" class="blank" />
              <img src="<?= base_url('assets/portfolio/') ?>assets/Star blank@2x.png" alt="star" class="blank" />
              <?php
                    }
              ?>
              <?php
                    if($res3[$i]['ratings'] == 4 || $res3[$i]['ratings'] == 4.5)
                    {
                ?>
              <img src="<?= base_url('assets/portfolio/') ?>assets/star@2x.png" alt="star" class="star" />
              <img src="<?= base_url('assets/portfolio/') ?>assets/star@2x.png" alt="star" class="star" />
              <img src="<?= base_url('assets/portfolio/') ?>assets/star@2x.png" alt="star" class="star" />
              <img src="<?= base_url('assets/portfolio/') ?>assets/star@2x.png" alt="star" class="star" />
              <img src="<?= base_url('assets/portfolio/') ?>assets/Star blank@2x.png" alt="star" class="blank" />
              <?php
                    }
              ?>
              <?php
                    if($res3[$i]['ratings'] == 5)
                    {
                ?>
              <img src="<?= base_url('assets/portfolio/') ?>assets/star@2x.png" alt="star" class="star" />
              <img src="<?= base_url('assets/portfolio/') ?>assets/star@2x.png" alt="star" class="star" />
              <img src="<?= base_url('assets/portfolio/') ?>assets/star@2x.png" alt="star" class="star" />
              <img src="<?= base_url('assets/portfolio/') ?>assets/star@2x.png" alt="star" class="star" />
              <img src="<?= base_url('assets/portfolio/') ?>assets/Star blank@2x.png" alt="star" class="star" />
              <?php
                    }
              ?>
            </div>
          </div>
          <div class="review_para">
            <p>
              <?= $res3[$i]['review_note'] ?>
            </p>
            <div class="review_border"></div>
          </div>
        </div>
         <?php
            }
            ?>
        
      </div>
    </div>
  </body>
</html>
