<?php
    $res = $this->db->where('phone',$id)->get('user')->row_array();
    $res1 = $this->db->where('functional_area_id',$res['business_category'])->get('tbl_functional_area')->row_array();
    $res2 = $this->db->where('user_id',$res['id'])->where('gallery_type',1)->get('gallery')->result_array();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    
    <title><?= $res['first_name']." ".$res['last_name'] ?></title>
    <link rel="shortcut icon" href="<?= base_url('admin/') ?>upload/avatar/<?= $res['avatar'] ?>" type="image/x-icon">
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.css"
    />

    <link rel="stylesheet" href="<?= base_url('assets/portfolio/') ?>css/style.css" />

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
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
              <div class="active2"></div></li>
          
          <li><a href="<?= base_url('reviews/'.$id) ?>">Reviews</a></li>
        </ul>
      </div>
      <!--------------------------------GALLERY----------------------------------- -->
      <div class="gallery mTop">
        <div class="gallery_container">
            <?php
                for($i=0;$i<count($res2);$i++)
                {
            ?>
            <div class="gallery_card">
              <a
                href="<?= base_url('admin/') ?>upload/gallery/profile/<?= $res2[$i]['image'] ?>"
                class="fancybox"
                data-fancybox="gallery1"
              >
                <img
                  src="<?= base_url('admin/') ?>upload/gallery/profile/<?= $res2[$i]['image'] ?>"
                  alt=""
                  class="gallery_img"
                />
              </a>
            </div>
            <?php
                }
            ?>
            
        </div>
      </div>
    </div>
  </body>
  <script src="<?= base_url('assets/portfolio/') ?>JS/script.js"></script>
</html>
