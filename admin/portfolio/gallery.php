<?php
    $id = $_GET['id'];
    include 'connection.php';
//    mysqli_set_charset($con,'utf8');
    
    $result = mysqli_query($con, "SELECT * FROM user WHERE id='$id'");
    $res = mysqli_fetch_array($result);
    $result1 = mysqli_query($con, "SELECT * FROM tbl_functional_area WHERE functional_area_id='$res[business_category]'");
    $res1 = mysqli_fetch_array($result1);
    $result2 = mysqli_query($con, "SELECT * FROM gallery WHERE gallery_type='1' AND user_id='$id'");
    
//    print_r($res);die;
//    $link = $base.'upload/company/brochure/'.$res['company_brochure_pdf'];
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    
    <title><?= $res['first_name']." ".$res['last_name'] ?></title>
    <link rel="shortcut icon" href="<?= $base ?>upload/avatar/<?= $res['avatar'] ?>" type="image/x-icon">
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.css"
    />

    <link rel="stylesheet" href="./css/style.css" />

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
  </head>
  <body>
    <div class="container">
       <div class="flex jse header">
        <div>
          <img src="<?= $base ?>upload/avatar/<?= $res['avatar'] ?>" alt="" />
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
            <a href="./index.php?id=<?= $id ?>">About Us</a>
            
          </li>
          <li><a href="./contact.php?id=<?= $id ?>">Contact Us</a></li>
          
          <li><a href="./gallery.php?id=<?= $id ?>">Gallery</a></li>
          <div class="active2"></div>
          <li><a href="./reviews.php?id=<?= $id ?>">Reviews</a></li>
        </ul>
      </div>
      <!--------------------------------GALLERY----------------------------------- -->
      <div class="gallery mTop">
        <div class="gallery_container">
            <?php
                while($res2 = mysqli_fetch_array($result2))
                {
            ?>
            <div class="gallery_card">
              <a
                href="<?= $base ?>upload/gallery/profile/<?= $res2['image'] ?>"
                class="fancybox"
                data-fancybox="gallery1"
              >
                <img
                  src="<?= $base ?>upload/gallery/profile/<?= $res2['image'] ?>"
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
  <script src="./JS/script.js"></script>
</html>
