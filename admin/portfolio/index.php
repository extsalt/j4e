<?php
    $id = $_GET['id'];
    include 'connection.php';
//    mysqli_set_charset($con,'utf8');
    
    $result = mysqli_query($con, "SELECT * FROM user WHERE id='$id'");
    $res = mysqli_fetch_array($result);
    $result1 = mysqli_query($con, "SELECT * FROM tbl_functional_area WHERE functional_area_id='$res[business_category]'");
    $res1 = mysqli_fetch_array($result1);
    $result2 = mysqli_query($con, "SELECT * FROM employee WHERE id='$res[no_of_employees]'");
    $res2 = mysqli_fetch_array($result2);
    $result3 = mysqli_query($con, "SELECT * FROM turn_over WHERE turn_over_id='$res[turn_over]'");
    $res3 = mysqli_fetch_array($result3);
    $result4 = mysqli_query($con, "SELECT * FROM packages WHERE pack_id='$res[packages_id]'");
    $res4 = mysqli_fetch_array($result4);
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
    <link rel="stylesheet" href="./css/style.css" />
    
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
            <div class="active"></div>
          </li>
          <li><a href="./contact.php?id=<?= $id ?>">Contact Us</a></li>
          <li><a href="./gallery.php?id=<?= $id ?>">Gallery</a></li>
          <li><a href="./reviews.php?id=<?= $id ?>">Reviews</a></li>
        </ul>
      </div>
      <!-------------------------------- ABOUT US ----------------------------------- -->
      <div class="about_container mTop">
        <h4>About</h4>
        <?= empty($res['about_company'])?'Not Available':$res['about_company'] ?>
      </div>
      <!---------------------------- COMPANY DETAILS ----------------------------->
      <div class="details_container">
        <div class="details">
          <p>Company Name</p>
          <h4><?= empty($res['company'])?'Not Available':$res['company'] ?></h4>
          <div class="detail_border"></div>
        </div>
        <div class="details mt1">
          <p>Business Entity</p>
          <h4><?= empty($res['business_entity'])?'Not Available':$res['business_entity'] ?></h4>
          <div class="detail_border"></div>
        </div>
        <div class="details mt1">
          <p>Business Type</p>
          <h4><?= empty($res['business_type'])?'Not Available':$res['business_type'] ?></h4>
          <div class="detail_border"></div>
        </div>
        <div class="details mt1">
          <p>Business Experties</p>
          <h4><?= empty($res['business_experties'])?'Not Available':$res['business_experties'] ?></h4>
          <div class="detail_border"></div>
        </div>
        <div class="details mt1">
          <p>Working From</p>
          <h4><?= empty($res['working_from'])?'Not Available':$res['working_from'] ?></h4>
          <div class="detail_border"></div>
        </div>
        <div class="details mt1">
          <p>No. Of Employees</p>
          <h4><?= empty($res2['title'])?'Not Available':$res2['title'] ?></h4>
          <div class="detail_border"></div>
        </div>
        <div class="details mt1">
          <p>Expected Turnover</p>
          <h4><?= empty($res3['turn_over_value'])?'Not Available':$res3['turn_over_value'] ?></h4>
          <div class="detail_border"></div>
        </div>
        <div class="details mt1">
          <p>Who is your Target Audience</p>
          <h4><?= empty($res['target_audiance'])?'Not Available':$res['target_audiance'] ?></h4>
          <div class="detail_border"></div>
        </div>
        <div class="details mt1">
          <p>Type Of Membership</p>
          <h4><?= empty($res4['pack_name'])?'Not Available':$res4['pack_name'] ?></h4>
          <div class="detail_border"></div>
        </div>
        <div class="details mt1">
          <p>Company Brochure</p>
          <div class="flex aic jcc file">
            <div>
                <?php
                    if(empty($res['company_profile']))
                    {
                ?>
              <img src="./assets/Pdf@2x.png" alt="">
              <?php
                    }else{
              ?>
              <a href="<?= $base ?>upload/requirements/<?= $res['company_profile'] ?>" target="_blank">
                  <img src="./assets/Pdf@2x.png" alt=""></a>
                    <?php } ?>
              <!--<p>13-02-2020</p>-->
            </div>
            <div>
                <?php
                    if(empty($res['company_ppt']))
                    {
                ?>
              <img src="./assets/Ppt@2x.png" alt="">
              <?php
                    }else{
              ?>
              <a href="<?= $base ?>upload/requirements/<?= $res['company_ppt'] ?>" target="_blank">
                  <img src="./assets/Ppt@2x.png" alt=""></a>
              <?php } ?>
              <!--<p>File Name</p>-->
            </div>
          </div>
          <div class="detail_border"></div>
        </div>
      </div>
    </div>
  </body>
</html>
