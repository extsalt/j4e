<?php    
    $res = $this->db->where('phone',$id)->get('user')->row_array();
    $res1 = $this->db->where('functional_area_id',$res['business_category'])->get('tbl_functional_area')->row_array();
    $res2 = $this->db->where('id',$res['no_of_employees'])->get('employee')->row_array();
    $res3 = $this->db->where('turn_over_id',$res['turn_over'])->get('turn_over')->row_array();
    $res4 = $this->db->where('pack_id',$res['packages_id'])->get('packages')->row_array();
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
          <div class="active1"></div></li>
          <li><a href="<?= base_url('gallery/'.$id) ?>">Gallery</a></li>
          <li><a href="<?= base_url('reviews/'.$id) ?>">Reviews</a></li>
        </ul>
      </div>
      <!---------------------------- SOCIAL MEDIA WEBSITES ----------------------------->
      <div class="web mTop">
         <div class="contact_name">
            <h2><?= $res['first_name']." ".$res['last_name'] ?></h2>
            <p><?= empty($res['gender'])?'Not Available':$res['gender'] ?></p>
         </div>
        <div class="web_container">
           <div>
               <img src="<?= base_url('assets/portfolio/') ?>assets/Email@2x.png" alt="">
           </div>
           <div>
               <a href="#"><?= empty($res['email_address'])?'Not Available':$res['email_address'] ?></a>
               <div class="border_web"></div>
           </div>
        </div>
        <div class="web_container">
           <div>
               <img src="<?= base_url('assets/portfolio/') ?>assets/Call@2x.png" alt="">
           </div>
           <div>
               <a href="#"><?= empty($res['phone'])?'Not Available':$res['phone'] ?></a>
               <div class="border_web"></div>
           </div>
        </div>
        <div class="web_container">
          <div>
              <img src="<?= base_url('assets/portfolio/') ?>assets/WhatsApp@2x.png" alt="">
          </div>
          <div>
              <a href="#"><?= empty($res['company_contact'])?'Not Available':$res['company_contact'] ?></a>
              <div class="border_web"></div>
          </div>
       </div>
        <div class="web_container">
           <div>
               <img src="<?= base_url('assets/portfolio/') ?>assets/WhatsApp Business@2x.png" alt="">
           </div>
           <div>
               <a href="#"><?= empty($res['wmobile'])?'Not Available':$res['wmobile'] ?></a>
               <div class="border_web"></div>
           </div>
        </div>
       </div>
      <!---------------------------- COMPANY DETAILS ----------------------------->
      <!---------------------------- COMPANY DETAILS ----------------------------->
      <div class="details_container">
        <div class="details">
          <p>Company Name</p>
          <h4><?= empty($res['company'])?'Not Available':$res['company'] ?></h4>
          <div class="detail_border"></div>
        </div>
        <div class="details mt1">
          <p>Designation</p>
          <h4><?= empty($res['designation'])?'Not Available':$res['designation'] ?></h4>
          <div class="detail_border"></div>
        </div>
        <div class="details mt1">
          <p>You total year of Experience</p>
          <h4><?= empty($res['total_experience'])?'Not Available':$res['total_experience'] ?></h4>
          <div class="detail_border"></div>
        </div>
        <div class="details mt1">
          <p>Business Category</p>
          <h4><?= empty($res1['functional_area'])?'Not Available':$res1['functional_area'] ?></h4>
          <div class="detail_border"></div>
        </div>
      </div>  
      <!---------------------------- SOCIAL MEDIA WEBSITES ----------------------------->
      <div class="web">
         <div class="web_container">
            <div>
                <img src="<?= base_url('assets/portfolio/') ?>assets/WWW@2x.png" alt="">
            </div>
            <div>
                <a href="#"><?= empty($res['website'])?'Not Available':$res['website'] ?></a>
                <div class="border_web"></div>
            </div>
         </div>
         <div class="web_container">
            <div>
                <img src="<?= base_url('assets/portfolio/') ?>assets/Address@2x.png" alt="">
            </div>
            <div>
                <a href="#"><?= empty($res['company_address'])?'Not Available':$res['company_address'] ?></a>
                <div class="border_web"></div>
            </div>
         </div>
         <div class="web_container">
            <div>
                <img src="<?= base_url('assets/portfolio/') ?>assets/Calander@2x.png" alt="">
            </div>
            <div>
                <a href="#"><?= empty($res['dob'])?'Not Available':$res['dob'] ?></a>
                <div class="border_web"></div>
            </div>
         </div>
      </div>
      <div class="social">
         <div class="social_container">
             <?php
                    if(!empty($res['vcard_front']))
                    {
                ?>
           <div>
             <img src="<?= base_url('admin/') ?>upload/requirements/<?= $res['vcard_front'] ?>" alt="" class="card">
           </div>
             <?php } ?>
           <div class="social_design">
               <?php
                    if(empty($res['company_google']))
                    {
                ?>
              <img src="<?= base_url('assets/portfolio/') ?>assets/Google@2x.png" alt="" class="social_icon">
              <?php
                    }else{
              ?>
              <a href="<?= $res['company_google'] ?>" target="_blank"><img src="<?= base_url('assets/portfolio/') ?>assets/Google@2x.png" alt="" class="social_icon"></a>
              <?php } ?>
              <?php
                    if(empty($res['company_facebook']))
                    {
                ?>
              <img src="<?= base_url('assets/portfolio/') ?>assets/Facebook@2x.png" alt="" class="social_icon">
              <?php
                    }else{
              ?>
              <a href="<?= $res['company_facebook'] ?>" target="_blank"><img src="<?= base_url('assets/portfolio/') ?>assets/Facebook@2x.png" alt="" class="social_icon"></a>
              <?php } ?>
              <?php
                    if(empty($res['company_linkedin']))
                    {
                ?>
              <img src="<?= base_url('assets/portfolio/') ?>assets/Linkedin@2x.png" alt="" class="social_icon">
              <?php
                    }else{
              ?>
              <a href="<?= $res['company_linkedin'] ?>" target="_blank"><img src="<?= base_url('assets/portfolio/') ?>assets/Linkedin@2x.png" alt="" class="social_icon"></a>
              <?php } ?>
              
              
           </div>
         </div>
      </div>
    </div>
  </body>
</html>
