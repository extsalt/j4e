<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="<?=my_caption('twofa_html_description')?>">
  <meta name="author" content="<?=my_caption('global_html_author')?>">
  <title><?php echo my_caption('twofa_html_title') . ' - ' . $this->setting->sys_name; ?></title>
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
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block bg-password-image"></div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-2"><?=my_caption('twofa_welcome_message')?></h1>
                    <p class="mb-4 text-left"><?=my_caption('twofa_notice_message')?></p>
                  </div>
				  <?php
				    my_load_view($this->setting->theme, 'Generic/show_flash_card');
				    echo form_open(base_url('auth/two_factor_authentication_action/'), ['method'=>'POST', 'class'=>'user']);
				  ?>
                    <div class="form-group">
					  <?php
					    $data = array(
						  'name' => 'code',
						  'id' => 'code',
						  'value' => set_value('code'),
						  'class' => 'form-control form-control-user',
						  'placeholder' => my_caption('twofa_code_placeholder')
						);
						echo form_input($data);
						echo form_error('code', '<small class="text-danger">', '</small>');
					  ?>
					</div>
                    <div class="form-group">
                      <div class="custom-control custom-checkbox small">
						<?php
						  if ($this->router->fetch_method() == 'two_factor_authentication') {
							  $checked  = 'checked';
						  }
						  else {
							  (set_value('remember') == '') ? $checked = '' : $checked = 'checked';
						  }
						  $data = array(
						    'name' => 'remember',
							'id' => 'remember',
							'value' => 1,
							'checked' => $checked,
							'class' => 'custom-control-input'
						  );
						  echo form_checkbox($data);
						?>
                        <label class="custom-control-label" for="remember"><?=my_caption('twofa_remember')?></label>
                      </div>
                    </div>
				    <?php
					  $data = array(
					    'type' => 'submit',
					    'name' => 'btn_submit',
					    'id' => 'btn_submit',
						'value' => my_caption('global_confirm'),
					    'class' => 'btn btn-primary btn-user btn-block'
					  );
					  echo form_submit($data);
					?>
                  <?php echo form_close(); ?>
                  <hr>
				  <?php
				    if ($this->setting->forget_enabled) {
				  ?>
                  <div class="text-center">
                    <a class="small" href="<?=base_url()?>auth/forget/"><?=my_caption('auth_forget_link')?></a>
                  </div>
				  <?php
				    }
				    if ($this->setting->signup_enabled) {
				  ?>
                  <div class="text-center">
                    <a class="small" href="<?=base_url()?>auth/signup/"><?=my_caption('auth_signup_link')?></a>
                  </div>
					<?php } ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php my_load_view($this->setting->theme, 'Auth/footer')?>
</body>

</html>