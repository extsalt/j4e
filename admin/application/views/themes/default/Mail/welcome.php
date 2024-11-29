<?php include 'header.php'; ?>

<table data-outer-table border="0" align="center" cellpadding="0" cellspacing="0" class="outer-table row" width="640" style="width:640px;max-width:640px;" data-module="blue-header">
  <!-- blue-header -->
  <tr>
    <td align="center" class="img-responsive container-padding">
        <img class="auto-width" style="display:block;width:100%;max-width:100%;border:0px;" data-image-edit data-url data-label="Header image" width="640" src="<?= base_url('assets/images/') ?>Welcome.jpg" border="0" editable="true" alt="picture">
    </td>
  </tr>
  <!-- blue-header -->
</table>

<table data-outer-table border="0" align="center" cellpadding="0" cellspacing="0" class="outer-table row" role="presentation" width="640" style="width:640px;max-width:640px;" data-module="blue-preface-1">
  <!-- blue-preface-1 -->
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
                  THANKS FOR JOINING US
                </div>
              </singleline>
          </td>
        </tr>
        <tr data-element="blue-headline" data-label="Headlines">
          <td class="center-text" data-text-style="Headlines" align="center" style="font-family:'Barlow',Arial,Helvetica,sans-serif;font-size:48px;line-height:54px;font-weight:900;font-style:normal;color:#222222;text-decoration:none;letter-spacing:0px;">
              <singleline>
                <div mc:edit data-text-edit>
                  Welcome aboard!
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
        <tr data-element="blue-header-paragraph" data-label="Paragraphs">
          <td height="25" style="font-size:25px;line-height:25px;" data-height="Spacing under paragraph">&nbsp;</td>
        </tr>
        <tr data-element="blue-button" data-label="Buttons">
          <td align="center">
            <!-- Button -->
            <table border="0" cellspacing="0" cellpadding="0" role="presentation" align="center" class="center-float">
              <tr>
                <td align="center" data-border-radius-default="0,6,36" data-border-radius-custom="Buttons" data-bgcolor="Buttons" bgcolor="#024153" style="border-radius: 0px;">
            <!--[if (gte mso 9)|(IE)]>
              <table border="0" cellpadding="0" cellspacing="0" align="center">
                <tr>
                  <td align="center" width="35"></td>
                  <td align="center" height="50" style="height:50px;">
                  <![endif]-->
                    <singleline>
                      <a href="#" mc:edit data-button data-text-style="Buttons" style="font-family:'Barlow',Arial,Helvetica,sans-serif;font-size:16px;line-height:20px;font-weight:700;font-style:normal;color:#FFFFFF;text-decoration:none;letter-spacing:0px;padding: 15px 35px 15px 35px;display: inline-block;"><span>GET STARTED</span></a>
                    </singleline>
                  <!--[if (gte mso 9)|(IE)]>
                  </td>
                  <td align="center" width="35"></td>
                </tr>
              </table>
            <![endif]-->
                </td>
              </tr>
            </table>
            <!-- Buttons -->
          </td>
        </tr>
      </table>
      <!-- content -->
    </td>
  </tr>
  <tr>
    <td height="40" style="font-size:40px;line-height:40px;" data-height="Spacing bottom">&nbsp;</td>
  </tr>
</table>

    </td>
  </tr>
  <!-- blue-preface-1 -->
</table>

<table data-outer-table border="0" align="center" cellpadding="0" cellspacing="0" class="outer-table row" role="presentation" width="640" style="width:640px;max-width:640px;" data-module="blue-basic-message-1">
  <!-- blue-basic-message-1 -->
  <tr>
    <td align="center" bgcolor="#FFFFFF" data-bgcolor="BgColor" class="container-padding">
<?php
    $intro_screen1 = $this->db->where('screen_id',1)->get('intro_screen')->row();
    $intro_screen2 = $this->db->where('screen_id',2)->get('intro_screen')->row();
    $intro_screen3 = $this->db->where('screen_id',3)->get('intro_screen')->row();
    $intro_screen4 = $this->db->where('screen_id',4)->get('intro_screen')->row();
?>
<!-- Content -->
<table data-inner-table border="0" align="center" cellpadding="0" cellspacing="0" class="inner-table row" role="presentation" width="580" style="width:580px;max-width:580px;">
  <tr>
    <td height="40" style="font-size:40px;line-height:40px;" data-height="Spacing top">&nbsp;</td>
  </tr>
  <tr data-element="blue-basic-message-1-titles" data-label="Titles">
    <td class="center-text" data-text-style="Titles" align="center" style="font-family:'Barlow',Arial,Helvetica,sans-serif;font-size:36px;line-height:42px;font-weight:700;font-style:normal;color:#222222;text-decoration:none;letter-spacing:0px;">
        <singleline>
          <div mc:edit data-text-edit>
            What's next 
          </div>
        </singleline>
    </td>
  </tr>
  <tr data-element="blue-basic-message-1-titles" data-label="Titles">
    <td height="30" style="font-size:30px;line-height:30px;" data-height="Spacing under titles">&nbsp;</td>
  </tr>
  <tr>
    <td align="center">

<!-- rwd-col -->
<table border="0" cellpadding="0" cellspacing="0" align="center" width="75%" style="width:75%;max-width:75%;">
  <tr>
    <td class="rwd-col" align="center" width="33.33%" style="width:33.33%;max-width:33.33%;">

    <!-- column -->
    <table border="0" align="center" cellpadding="0" cellspacing="0" role="presentation" width="100%" style="width:100%;max-width:100%;">
      <tr>
        <td align="center" class="img-responsive">
          <img class="auto-width" style="display:block;width:100%;max-width:100%;border:0px;border-radius:100%;" data-image-edit data-url data-border-radius-default="0,6,36" data-border-radius-custom="Picture" data-label="Picture" width="160" src="<?= base_url($intro_screen1->screen_image) ?>" border="0" editable="true" alt="picture">
        </td>
      </tr>
    </table>
    <!-- column -->

    </td>
    <td class="rwd-col" align="center" width="4.17%" height="30" style="width:4.17%;max-width:4.17%;height:30px;">&nbsp;</td>
    <td class="rwd-col" align="center" width="62.5%" style="width:62.5%;max-width:62.5%;">

      <!-- column -->
      <table border="0" align="center" cellpadding="0" cellspacing="0" role="presentation" class="row" width="100%" style="width:100%;max-width:100%;">
        <tr data-element="blue-basic-message-1-titles" data-label="Titles">
          <td class="center-text" data-text-style="Titles" align="left" style="font-family:'Barlow',Arial,Helvetica,sans-serif;font-size:18px;line-height:24px;font-weight:700;font-style:normal;color:#024153;text-decoration:none;letter-spacing:0px;">
              <singleline>
                <div mc:edit data-text-edit>
                  <?= $intro_screen1->screen_title ?>
                </div>
              </singleline>
          </td>
        </tr>
        <tr data-element="blue-basic-message-1-titles" data-label="Titles">
          <td height="10" style="font-size:10px;line-height:10px;" data-height="Spacing under titles">&nbsp;</td>
        </tr>
        <tr data-element="blue-basic-message-1-paragraph" data-label="Paragraphs">
          <td class="center-text" data-text-style="Paragraphs" align="left" style="font-family:'Barlow',Arial,Helvetica,sans-serif;font-size:14px;line-height:24px;font-weight:400;font-style:normal;color:#333333;text-decoration:none;letter-spacing:0px;">
              <singleline>
                <div mc:edit data-text-edit>
                  <?= $intro_screen1->screen_desc ?>
                </div>
              </singleline>
          </td>
        </tr>
        <tr data-element="blue-basic-message-1-paragraph" data-label="Paragraphs">
          <td height="20" style="font-size:20px;line-height:20px;" data-height="Spacing under paragraphs">&nbsp;</td>
        </tr>
        <tr data-element="blue-basic-message-1-button" data-label="Links">
          <td align="center">
            <table border="0" cellpadding="0" cellspacing="0" align="left" class="center-float">
              <tr data-element="blue-basic-message-1-button" data-label="Links">
                <td align="left" class="center-text" data-border-color="Underline border" style="border-bottom: 4px solid #024153;">
                  <!-- Links -->
                    <singleline>
                      <a href="#" mc:edit data-button data-text-style="Links" style="font-family:'Barlow',Arial,Helvetica,sans-serif;font-size:13px;line-height:24px;font-weight:500;font-style:normal;color:#024153;text-decoration:none;letter-spacing:0px;display:inline-block;vertical-align:middle;"><span>LEARN MORE</span></a>
                    </singleline>
                  <!-- Links -->
                </td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
      <!-- column -->

    </td>
  </tr>
</table>
<!-- rwd-col -->

    </td>
  </tr>
  <tr>
    <td height="30" style="font-size:30px;line-height:30px;" data-height="Spacing bottom">&nbsp;</td>
  </tr>
</table>
<!-- Content -->

    </td>
  </tr>
  <!-- blue-basic-message-1 -->
</table>

<table data-outer-table border="0" align="center" cellpadding="0" cellspacing="0" class="outer-table row" role="presentation" width="640" style="width:640px;max-width:640px;" data-module="blue-basic-message-2">
  <!-- blue-basic-message-2 -->
  <tr>
    <td align="center" bgcolor="#FFFFFF" data-bgcolor="BgColor" class="container-padding">

<!-- Content -->
<table data-inner-table border="0" align="center" cellpadding="0" cellspacing="0" class="inner-table row" role="presentation" width="580" style="width:580px;max-width:580px;">
  <tr>
    <td height="30" style="font-size:30px;line-height:30px;" data-height="Spacing top">&nbsp;</td>
  </tr>
  <tr>
    <td align="center">

<!-- rwd-col -->
<table border="0" cellpadding="0" cellspacing="0" align="center" width="75%" style="width:75%;max-width:75%;">
  <tr>
    <td class="rwd-col" align="center" width="33.33%" style="width:33.33%;max-width:33.33%;">

    <!-- column -->
    <table border="0" align="center" cellpadding="0" cellspacing="0" role="presentation" width="100%" style="width:100%;max-width:100%;">
      <tr>
        <td align="center" class="img-responsive">
          <img class="auto-width" style="display:block;width:100%;max-width:100%;border:0px;border-radius:100%;" data-image-edit data-url data-border-radius-default="0,6,36" data-border-radius-custom="Picture" data-label="Picture" width="160" src="<?= base_url($intro_screen2->screen_image) ?>" border="0" editable="true" alt="picture">
        </td>
      </tr>
    </table>
    <!-- column -->

    </td>
    <td class="rwd-col" align="center" width="4.17%" height="30" style="width:4.17%;max-width:4.17%;height:30px;">&nbsp;</td>
    <td class="rwd-col" align="center" width="62.5%" style="width:62.5%;max-width:62.5%;">

      <!-- column -->
      <table border="0" align="center" cellpadding="0" cellspacing="0" role="presentation" class="row" width="100%" style="width:100%;max-width:100%;">
        <tr data-element="blue-basic-message-2-titles" data-label="Titles">
          <td class="center-text" data-text-style="Titles" align="left" style="font-family:'Barlow',Arial,Helvetica,sans-serif;font-size:18px;line-height:24px;font-weight:700;font-style:normal;color:#024153;text-decoration:none;letter-spacing:0px;">
              <singleline>
                <div mc:edit data-text-edit>
                  <?= $intro_screen2->screen_title ?>
                </div>
              </singleline>
          </td>
        </tr>
        <tr data-element="blue-basic-message-2-titles" data-label="Titles">
          <td height="10" style="font-size:10px;line-height:10px;" data-height="Spacing under titles">&nbsp;</td>
        </tr>
        <tr data-element="blue-basic-message-2-paragraph" data-label="Paragraphs">
          <td class="center-text" data-text-style="Paragraphs" align="left" style="font-family:'Barlow',Arial,Helvetica,sans-serif;font-size:14px;line-height:24px;font-weight:400;font-style:normal;color:#333333;text-decoration:none;letter-spacing:0px;">
              <singleline>
                <div mc:edit data-text-edit>
                  <?= $intro_screen2->screen_desc ?>
                </div>
              </singleline>
          </td>
        </tr>
        <tr data-element="blue-basic-message-2-paragraph" data-label="Paragraphs">
          <td height="20" style="font-size:20px;line-height:20px;" data-height="Spacing under paragraphs">&nbsp;</td>
        </tr>
        <tr data-element="blue-basic-message-2-button" data-label="Links">
          <td align="center">
            <table border="0" cellpadding="0" cellspacing="0" align="left" class="center-float">
              <tr data-element="blue-basic-message-2-button" data-label="Links">
                <td align="left" class="center-text" data-border-color="Underline border" style="border-bottom: 4px solid #024153;">
                  <!-- Links -->
                    <singleline>
                      <a href="#" mc:edit data-button data-text-style="Links" style="font-family:'Barlow',Arial,Helvetica,sans-serif;font-size:13px;line-height:24px;font-weight:500;font-style:normal;color:#024153;text-decoration:none;letter-spacing:0px;display:inline-block;vertical-align:middle;"><span>LEARN MORE</span></a>
                    </singleline>
                  <!-- Links -->
                </td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
      <!-- column -->

    </td>
  </tr>
</table>
<!-- rwd-col -->

    </td>
  </tr>
  <tr>
    <td height="20" style="font-size:20px;line-height:20px;" data-height="Spacing bottom">&nbsp;</td>
  </tr>
</table>
<!-- Content -->

    </td>
  </tr>
  <!-- blue-basic-message-2 -->
</table>

<table data-outer-table border="0" align="center" cellpadding="0" cellspacing="0" class="outer-table row" role="presentation" width="640" style="width:640px;max-width:640px;" data-module="blue-basic-message-3">
  <!-- blue-basic-message-3 -->
  <tr>
    <td align="center" bgcolor="#FFFFFF" data-bgcolor="BgColor" class="container-padding">

<!-- Content -->
<table data-inner-table border="0" align="center" cellpadding="0" cellspacing="0" class="inner-table row" role="presentation" width="580" style="width:580px;max-width:580px;">
  <tr>
    <td height="30" style="font-size:30px;line-height:30px;" data-height="Spacing top">&nbsp;</td>
  </tr>
  <tr>
    <td align="center">

<!-- rwd-col -->
<table border="0" cellpadding="0" cellspacing="0" align="center" width="75%" style="width:75%;max-width:75%;">
  <tr>
    <td class="rwd-col" align="center" width="33.33%" style="width:33.33%;max-width:33.33%;">

    <!-- column -->
    <table border="0" align="center" cellpadding="0" cellspacing="0" role="presentation" width="100%" style="width:100%;max-width:100%;">
      <tr>
        <td align="center" class="img-responsive">
          <img class="auto-width" style="display:block;width:100%;max-width:100%;border:0px;border-radius:100%;" data-image-edit data-url data-border-radius-default="0,6,36" data-border-radius-custom="Picture" data-label="Picture" width="160" src="<?= base_url($intro_screen3->screen_image) ?>" border="0" editable="true" alt="picture">
        </td>
      </tr>
    </table>
    <!-- column -->

    </td>
    <td class="rwd-col" align="center" width="4.17%" height="30" style="width:4.17%;max-width:4.17%;height:30px;">&nbsp;</td>
    <td class="rwd-col" align="center" width="62.5%" style="width:62.5%;max-width:62.5%;">

      <!-- column -->
      <table border="0" align="center" cellpadding="0" cellspacing="0" role="presentation" class="row" width="100%" style="width:100%;max-width:100%;">
        <tr data-element="blue-basic-message-3-titles" data-label="Titles">
          <td class="center-text" data-text-style="Titles" align="left" style="font-family:'Barlow',Arial,Helvetica,sans-serif;font-size:18px;line-height:24px;font-weight:700;font-style:normal;color:#024153;text-decoration:none;letter-spacing:0px;">
              <singleline>
                <div mc:edit data-text-edit>
                  <?= $intro_screen3->screen_title ?>
                </div>
              </singleline>
          </td>
        </tr>
        <tr data-element="blue-basic-message-3-titles" data-label="Titles">
          <td height="10" style="font-size:10px;line-height:10px;" data-height="Spacing under titles">&nbsp;</td>
        </tr>
        <tr data-element="blue-basic-message-3-paragraph" data-label="Paragraphs">
          <td class="center-text" data-text-style="Paragraphs" align="left" style="font-family:'Barlow',Arial,Helvetica,sans-serif;font-size:14px;line-height:24px;font-weight:400;font-style:normal;color:#333333;text-decoration:none;letter-spacing:0px;">
              <singleline>
                <div mc:edit data-text-edit>
                  <?= $intro_screen3->screen_desc ?>
                </div>
              </singleline>
          </td>
        </tr>
        <tr data-element="blue-basic-message-3-paragraph" data-label="Paragraphs">
          <td height="20" style="font-size:20px;line-height:20px;" data-height="Spacing under paragraphs">&nbsp;</td>
        </tr>
        <tr data-element="blue-basic-message-3-button" data-label="Links">
          <td align="center">
            <table border="0" cellpadding="0" cellspacing="0" align="left" class="center-float">
              <tr data-element="blue-basic-message-3-button" data-label="Links">
                <td align="left" class="center-text" data-border-color="Underline border" style="border-bottom: 4px solid #024153;">
                  <!-- Links -->
                    <singleline>
                      <a href="#" mc:edit data-button data-text-style="Links" style="font-family:'Barlow',Arial,Helvetica,sans-serif;font-size:13px;line-height:24px;font-weight:500;font-style:normal;color:#024153;text-decoration:none;letter-spacing:0px;display:inline-block;vertical-align:middle;"><span>LEARN MORE</span></a>
                    </singleline>
                  <!-- Links -->
                </td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
      <!-- column -->

    </td>
  </tr>
</table>
<!-- rwd-col -->

    </td>
  </tr>
  <tr>
    <td height="20" style="font-size:20px;line-height:20px;" data-height="Spacing bottom">&nbsp;</td>
  </tr>
</table>
<!-- Content -->

    </td>
  </tr>
  <!-- blue-basic-message-3 -->
</table>

<table data-outer-table border="0" align="center" cellpadding="0" cellspacing="0" class="outer-table row" role="presentation" width="640" style="width:640px;max-width:640px;" data-module="blue-basic-message-3">
  <!-- blue-basic-message-3 -->
  <tr>
    <td align="center" bgcolor="#FFFFFF" data-bgcolor="BgColor" class="container-padding">

<!-- Content -->
<table data-inner-table border="0" align="center" cellpadding="0" cellspacing="0" class="inner-table row" role="presentation" width="580" style="width:580px;max-width:580px;">
  <tr>
    <td height="30" style="font-size:30px;line-height:30px;" data-height="Spacing top">&nbsp;</td>
  </tr>
  <tr>
    <td align="center">

<!-- rwd-col -->
<table border="0" cellpadding="0" cellspacing="0" align="center" width="75%" style="width:75%;max-width:75%;">
  <tr>
    <td class="rwd-col" align="center" width="33.33%" style="width:33.33%;max-width:33.33%;">

    <!-- column -->
    <table border="0" align="center" cellpadding="0" cellspacing="0" role="presentation" width="100%" style="width:100%;max-width:100%;">
      <tr>
        <td align="center" class="img-responsive">
          <img class="auto-width" style="display:block;width:100%;max-width:100%;border:0px;border-radius:100%;" data-image-edit data-url data-border-radius-default="0,6,36" data-border-radius-custom="Picture" data-label="Picture" width="160" src="<?= base_url($intro_screen4->screen_image) ?>" border="0" editable="true" alt="picture">
        </td>
      </tr>
    </table>
    <!-- column -->

    </td>
    <td class="rwd-col" align="center" width="4.17%" height="30" style="width:4.17%;max-width:4.17%;height:30px;">&nbsp;</td>
    <td class="rwd-col" align="center" width="62.5%" style="width:62.5%;max-width:62.5%;">

      <!-- column -->
      <table border="0" align="center" cellpadding="0" cellspacing="0" role="presentation" class="row" width="100%" style="width:100%;max-width:100%;">
        <tr data-element="blue-basic-message-3-titles" data-label="Titles">
          <td class="center-text" data-text-style="Titles" align="left" style="font-family:'Barlow',Arial,Helvetica,sans-serif;font-size:18px;line-height:24px;font-weight:700;font-style:normal;color:#024153;text-decoration:none;letter-spacing:0px;">
              <singleline>
                <div mc:edit data-text-edit>
                  <?= $intro_screen4->screen_title ?>
                </div>
              </singleline>
          </td>
        </tr>
        <tr data-element="blue-basic-message-3-titles" data-label="Titles">
          <td height="10" style="font-size:10px;line-height:10px;" data-height="Spacing under titles">&nbsp;</td>
        </tr>
        <tr data-element="blue-basic-message-3-paragraph" data-label="Paragraphs">
          <td class="center-text" data-text-style="Paragraphs" align="left" style="font-family:'Barlow',Arial,Helvetica,sans-serif;font-size:14px;line-height:24px;font-weight:400;font-style:normal;color:#333333;text-decoration:none;letter-spacing:0px;">
              <singleline>
                <div mc:edit data-text-edit>
                  <?= $intro_screen4->screen_desc ?>
                </div>
              </singleline>
          </td>
        </tr>
        <tr data-element="blue-basic-message-3-paragraph" data-label="Paragraphs">
          <td height="20" style="font-size:20px;line-height:20px;" data-height="Spacing under paragraphs">&nbsp;</td>
        </tr>
        <tr data-element="blue-basic-message-3-button" data-label="Links">
          <td align="center">
            <table border="0" cellpadding="0" cellspacing="0" align="left" class="center-float">
              <tr data-element="blue-basic-message-3-button" data-label="Links">
                <td align="left" class="center-text" data-border-color="Underline border" style="border-bottom: 4px solid #024153;">
                  <!-- Links -->
                    <singleline>
                      <a href="#" mc:edit data-button data-text-style="Links" style="font-family:'Barlow',Arial,Helvetica,sans-serif;font-size:13px;line-height:24px;font-weight:500;font-style:normal;color:#024153;text-decoration:none;letter-spacing:0px;display:inline-block;vertical-align:middle;"><span>LEARN MORE</span></a>
                    </singleline>
                  <!-- Links -->
                </td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
      <!-- column -->

    </td>
  </tr>
</table>
<!-- rwd-col -->

    </td>
  </tr>
  <tr>
    <td height="20" style="font-size:20px;line-height:20px;" data-height="Spacing bottom">&nbsp;</td>
  </tr>
</table>
<!-- Content -->

    </td>
  </tr>
  <!-- blue-basic-message-3 -->
</table>

<!--<table data-outer-table border="0" align="center" cellpadding="0" cellspacing="0" class="outer-table row" role="presentation" width="640" style="width:640px;max-width:640px;" data-module="blue-cta-1">
   blue-cta-1 
  <tr>
    <td align="center" bgcolor="#FFFFFF" data-bgcolor="BgColor" class="container-padding">

     Button 
    <table border="0" cellspacing="0" cellpadding="0" role="presentation" align="center" class="center-float">
      <tr>
        <td height="40" style="font-size:40px;line-height:40px;" data-height="Spacing top">&nbsp;</td>
      </tr>
      <tr>
        <td align="center" data-border-radius-default="0,6,36" data-border-radius-custom="Buttons" data-bgcolor="Buttons" bgcolor="#024153" style="border-radius: 0px;">
    [if (gte mso 9)|(IE)]>
      <table border="0" cellpadding="0" cellspacing="0" align="center">
        <tr>
          <td align="center" width="35"></td>
          <td align="center" height="50" style="height:50px;">
          <![endif]
            <singleline>
              <a href="#" mc:edit data-button data-text-style="Buttons" style="font-family:'Barlow',Arial,Helvetica,sans-serif;font-size:16px;line-height:20px;font-weight:700;font-style:normal;color:#FFFFFF;text-decoration:none;letter-spacing:0px;padding: 15px 35px 15px 35px;display: inline-block;"><span>Tutorials & Tips</span></a>
            </singleline>
          [if (gte mso 9)|(IE)]>
          </td>
          <td align="center" width="35"></td>
        </tr>
      </table>
    <![endif]
        </td>
      </tr>
      <tr>
        <td height="60" style="font-size:60px;line-height:60px;" data-height="Spacing bottom">&nbsp;</td>
      </tr>
    </table>
     Buttons 

    </td>
  </tr>
   blue-cta-1 
</table>-->

<?php include 'footer.php'; ?>