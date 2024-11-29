<?php include 'header.php'; ?>
<?php
    $user_info = $this->db->where('id',$recognition->recognition_userid)->get('user')->row();
?>
<table data-outer-table border="0" align="center" cellpadding="0" cellspacing="0" class="outer-table row" width="640" style="width:640px;max-width:640px;" data-module="blue-header">
  <!-- blue-header -->
  <tr>
    <td align="center" class="img-responsive container-padding">
        <img class="auto-width" style="display:block;width:100%;max-width:100%;border:0px;" data-image-edit data-url data-label="Header image" width="640" src="<?= base_url('assets/images/') ?>knowledge sharing.jpg" border="0" editable="true" alt="picture">
    </td>
  </tr>
  <!-- blue-header -->
</table>

<table data-outer-table border="0" align="center" cellpadding="0" cellspacing="0" class="outer-table row" role="presentation" width="640" style="width:640px;max-width:640px;" data-module="blue-preface-8">
  <!-- blue-preface-8 -->
  <tr>
    <td align="center" bgcolor="#FFFFFF" data-bgcolor="BgColor" class="container-padding">

<table data-inner-table border="0" align="center" cellpadding="0" cellspacing="0" role="presentation" class="inner-table row" width="580" style="width:580px;max-width:580px;">
  <tr>
    <td height="40" style="font-size:40px;line-height:40px;" data-height="Spacing top">&nbsp;</td>
  </tr>
  <tr>
    <td align="center" data-bgcolor="BgColor" bgcolor="#FFFFFF">
      <!-- content -->
      <table border="0" align="center" cellpadding="0" cellspacing="0" role="presentation" width="100%" style="width:100%;max-width:100%;">
        <tr data-element="blue-subline" data-label="Sublines">
          <td class="center-text" data-text-style="Sublines" align="center" style="font-family:'Barlow',Arial,Helvetica,sans-serif;font-size:14px;line-height:24px;font-weight:900;font-style:normal;color:#024153;text-decoration:none;letter-spacing:1px;">
              <singleline>
                <div mc:edit data-text-edit>
                  <?= date('d M Y',strtotime($recognition->recognition_creatdate)) ?>
                </div>
              </singleline>
          </td>
        </tr>
        <tr data-element="blue-headline" data-label="Headlines">
          <td class="center-text" data-text-style="Headlines" align="center" style="font-family:'Barlow',Arial,Helvetica,sans-serif;font-size:48px;line-height:54px;font-weight:900;font-style:normal;color:#222222;text-decoration:none;letter-spacing:0px;">
              <singleline>
                <div mc:edit data-text-edit>
                  <?= $recognition->recognition_title ?>
                </div>
              </singleline>
          </td>
        </tr>
        <tr data-element="blue-headline" data-label="Headlines">
          <td height="15" style="font-size:15px;line-height:15px;" data-height="Spacing under headline">&nbsp;</td>
        </tr>
        <tr data-element="blue-paragraph" data-label="Paragraphs">
          <td class="center-text" data-text-style="Paragraphs" align="center" style="font-family:'Barlow',Arial,Helvetica,sans-serif;font-size:16px;line-height:26px;font-weight:400;font-style:normal;color:#333333;text-decoration:none;letter-spacing:0px;">
              <singleline>
                <div mc:edit data-text-edit>
                  <?= $template->body ?>
                </div>
              </singleline>
          </td>
        </tr>
      </table>
      <!-- content -->
    </td>
  </tr>
  <tr>
    <td height="20" style="font-size:20px;line-height:20px;" data-height="Spacing bottom">&nbsp;</td>
  </tr>
</table>

    </td>
  </tr>
  <!-- blue-preface-8 -->
</table>


<!--<table data-outer-table border="0" align="center" cellpadding="0" cellspacing="0" class="outer-table row" role="presentation" width="640" style="width:640px;max-width:640px;" data-module="blue-title">
   blue-title 
  <tr>
    <td height="20" style="font-size:20px;line-height:20px;" data-height="Spacing top">&nbsp;</td>
  </tr>
  <tr>
    <td align="center" bgcolor="#FFFFFF" data-bgcolor="BgColor" class="container-padding">
     Content 
    <table border="0" align="center" cellpadding="0" cellspacing="0" role="presentation" width="100%" style="width:100%;max-width:100%;">
      <tr data-element="blue-title-titles" data-label="Titles">
        <td class="center-text" data-text-style="Titles" align="center" style="font-family:'Barlow',Arial,Helvetica,sans-serif;font-size:24px;line-height:36px;font-weight:700;font-style:normal;color:#024153;text-decoration:none;letter-spacing:0px;">
            <singleline>
              <div mc:edit data-text-edit>
                Featured Speakers 
              </div>
            </singleline>
        </td>
      </tr>
    </table>
     Content 
    </td>
  </tr>
  <tr>
    <td height="10" style="font-size:10px;line-height:10px;" data-height="Spacing bottom">&nbsp;</td>
  </tr>
</table>
 blue-title -->

<table data-outer-table border="0" align="center" cellpadding="0" cellspacing="0" class="outer-table row" role="presentation" width="640" style="width:640px;max-width:640px;" data-module="blue-webinar-speaker-box-1">
   <!--blue-webinar-speaker-box-1--> 
  <tr>
    <td height="10" style="font-size:10px;line-height:10px;" data-height="Spacing top">&nbsp;</td>
  </tr>
  <tr>
    <td align="center" bgcolor="#FFFFFF" data-bgcolor="BgColor" class="container-padding">
     <!--Content--> 
    <table border="0" align="center" cellpadding="0" cellspacing="0" role="presentation" width="100%" style="width:100%;max-width:100%;">
      <tr data-element="blue-arrow-divider" data-label="Arrow">
        <td align="center">
          <img style="width:50px;border:0px;display: inline!important;" src="<?= base_url('assets/images/') ?>arrow.png" width="50" border="0" editable="true" data-icon data-image-edit data-url data-label="Arrow" data-image-width alt="arrow">
        </td>
      </tr>
      <tr>
        <td align="center" bgcolor="#F8F8F8" data-bgcolor="Inner BgColor"> 

         <!--rwd-col--> 
        <table border="0" cellpadding="0" cellspacing="0" align="center" class="row container-padding" width="90.63%" style="width:90.63%;max-width:90.63%;">
          <tr>
            <td height="20" style="font-size:20px;line-height:20px;">&nbsp;</td>
          </tr>
          <tr data-element="blue-webinar-speaker-box-1-author-1" data-label="1st Author">
            <td align="center" bgcolor="#F8F8F8" data-bgcolor="Author Light BgColor" data-border-radius-default="0,6,36" data-border-radius-custom="1st Author" style="border-radius: 0;">
               <!--Author Content--> 
              <table border="0" align="center" cellpadding="0" cellspacing="0" role="presentation" width="100%" style="width:100%;max-width:100%;">
                <tr>
                  <td colspan="3" height="15" style="font-size:15px;line-height:15px;">&nbsp;</td>
                </tr>
                <tr>
                  <td class="rwd-col" align="center" width="17.85%" style="width:17.85%;max-width:17.85%;">
                    <img class="auto-width" style="display:block;width:100%;max-width:140px;border:6px solid #FFFFFF;border-radius:100%;" data-image-edit data-url data-border-radius-default="0,6,36" data-border-radius-custom="Picture" data-label="Picture" width="100" src="<?= base_url('upload/avatar/'.$user_info->avatar) ?>" border="0" editable="true" alt="picture">
                  </td>
                  <td class="rwd-col" align="center" width="1.78%" height="15" style="width:1.78%;max-width:1.78%; height: 15px;"></td>
                  <td class="rwd-col autoheight" align="center" width="80.35%" height="100" style="width:80.35%;max-width:80.35%;height: 100px;">
                     <!--Author Details--> 
                    <table border="0" align="center" cellpadding="0" cellspacing="0" role="presentation" width="93.33%" style="width:93.33%;max-width:93.33%;">
                      <tr data-element="blue-webinar-speaker-box-1-author-name" data-label="Author Name">
                        <td class="center-text" data-text-style="Author Name" align="left" style="font-family:'Barlow',Arial,Helvetica,sans-serif;font-size:24px;line-height:32px;font-weight:700;font-style:normal;color:#333333;text-decoration:none;letter-spacing:0px;">
                          <singleline>
                            <div mc:edit data-text-edit>
                              <?= $user_info->first_name." ".$user_info->last_name ?>
                            </div>
                          </singleline>
                        </td>
                      </tr>
                      <tr data-element="blue-webinar-speaker-box-1-author-occupation" data-label="Author Occupation">
                        <td class="center-text" data-text-style="Author Occupation" align="left" style="font-family:'Barlow',Arial,Helvetica,sans-serif;font-size:21px;line-height:24px;font-weight:400;font-style:normal;color:#333333;text-decoration:none;letter-spacing:0px;">
                          <singleline>
                            <div mc:edit data-text-edit>
                              <?= $user_info->designation ?>
                            </div>
                          </singleline>
                        </td>
                      </tr>
                    </table>
                     <!--Author Details--> 
                  </td>
                </tr>
                <tr>
                  <td colspan="3" height="15" style="font-size:15px;line-height:15px;">&nbsp;</td>
                </tr>
                <tr data-element="blue-webinar-speaker-box-1-author-info" data-label="Author Info">
                  <td colspan="3" class="center-text" data-text-style="Author Info" align="left" style="font-family:'Barlow',Arial,Helvetica,sans-serif;font-size:16px;line-height:24px;font-weight:400;font-style:normal;color:#000000;text-decoration:none;letter-spacing:0px;">
                      <singleline>
                        <div mc:edit data-text-edit>
                          <?= $recognition->recognition_description ?>
                        </div>
                      </singleline>
                  </td>
                </tr>
                <tr>
                  <td colspan="3" height="15" style="font-size:15px;line-height:15px;">&nbsp;</td>
                </tr>
              </table>
               <!--Author Content--> 
            </td>
          </tr>
          <tr>
            <td height="20" style="font-size:20px;line-height:20px;">&nbsp;</td>
          </tr>
        </table>
         <!--rwd-col--> 

        </td>
      </tr>
    </table>
     <!--Content--> 
    </td>
  </tr>
  <tr>
    <td height="20" style="font-size:20px;line-height:20px;" data-height="Spacing bottom">&nbsp;</td>
  </tr>
   <!--blue-webinar-speaker-box-1--> 
</table>




<?php include 'footer.php'; ?>