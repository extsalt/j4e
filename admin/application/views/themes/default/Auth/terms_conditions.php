<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$tc_array = json_decode($setting->terms_conditions, TRUE);

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="<?=my_caption('tc_html_description')?>">
  <meta name="author" content="<?=my_caption('global_html_author')?>">
  <title><?php echo my_caption('tc_html_title') . ' - ' . $setting->sys_name; ?></title>
  <link rel="shortcut icon" href="<?=base_url()?>upload/favicon.ico" type="image/x-icon">
  <link href="<?=base_url()?>assets/themes/default/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link href="<?=base_url()?>assets/themes/default/css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body class="bg-gradient-primary">

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-xl-10 col-lg-12 col-md-9">
        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0 min-height-880">
            <div class="row mb-5 mt-5">
			  <div class="col-lg-10 offset-1">
			    <h3 class="ml-4"><?=my_esc_html($tc_array['title'])?></h3>
			  </div>
			</div>
			<hr>
            <div class="row mt-5">
			  <div class="col-lg-10 offset-1 mb-5">
			    <p class="ml-4"><?=my_esc_html($tc_array['body'])?></p>
			  </div>
			</div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php my_load_view($setting->theme, 'Auth/footer')?>
</body>

</html>