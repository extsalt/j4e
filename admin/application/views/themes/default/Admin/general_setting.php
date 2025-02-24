<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php my_load_view($this->setting->theme, 'header')?>
<div class="container-fluid">
  <h1 class="h3 mb-4 text-gray-800"><?=my_caption('gs_title')?></h1>
  <?php echo form_open_multipart(base_url('admin/general_setting_action/'), ['method'=>'POST']); ?>
  <input type="hidden" id="base_url" name="base_url" value="<?=base_url()?>">
  <div class="row">
    <div class="col-lg-8">
	  <?php my_load_view($this->setting->theme, 'Generic/show_flash_card');?>
	  <div class="card shadow mb-4">
	    <div class="card-header py-3">
		  <h6 class="m-0 font-weight-bold text-primary"><?=my_caption('gs_title')?></h6>
        </div>
        <div class="card-body">
		  <input type="hidden" name="act" value="user_setting">
		  <div class="row form-group mb-4">
		    <div class="col-lg-6">
			  <label><span class="text-danger">*</span> <?=my_caption('gs_system_name')?></label>
			  <?php
			    (set_value('system_name') == '') ? $system_name = $this->setting->sys_name : $system_name  = set_value('system_name');
			    $data = array(
				  'name' => 'system_name',
				  'id' => 'system_name',
				  'value' => $system_name,
				  'class' => 'form-control'
				);
				echo form_input($data);
				echo form_error('system_name', '<small class="text-danger">', '</small>');
			  ?>
			</div>
                      <div class="col-lg-6">
			  <label>Support No.<span class="text-danger">*</span></label>
                          <input type="text" class="form-control" name="support_no" value="<?= $this->setting->support_no ?>">
			</div>
<!--		    <div class="col-lg-6">
			  <label><?=my_caption('gs_theme')?></label>
			  <?php
			    (set_value('system_theme') == '') ? $system_theme = $this->setting->theme : $system_theme  = set_value('system_theme');
			    $options = array (
				  'default' => 'SB Admin 2'
				);
				$data = array(
				  'class' => 'form-control selectpicker'
				);
				echo form_dropdown('system_theme', $options, $system_theme, $data);
			  ?>
			</div>-->
		  </div>
<!--		  <div class="row form-group mb-4">
		    <div class="col-lg-6">
			  <label><?=my_caption('gs_google_analytics')?></label>
			  <?php
			    (set_value('google_analytics_id') == '') ? $google_analytics_id = $this->setting->google_analytics_id : $google_analytics_id  = set_value('google_analytics_id');
			    $data = array(
				  'name' => 'google_analytics_id',
				  'id' => 'google_analytics_id',
				  'value' => $google_analytics_id,
				  'class' => 'form-control',
				  'placeholder' => my_caption('gs_google_analytics_placeholder')
				);
				echo form_input($data);
				echo form_error('google_analytics_id', '<small class="text-danger">', '</small>');
			  ?>
			</div>
			
			<div class="col-lg-4">
			  <label><span class="text-danger">*</span> No. of Free Invite</label>
			  <?php
			    (set_value('no_free_invite') == '') ? $no_free_invite = $this->setting->no_of_free_invite : $no_free_invite  = set_value('no_free_invite');
			    $data = array(
				  'name' => 'no_free_invite',
				  'id' => 'no_free_invite',
				  'value' => $no_free_invite,
				  'class' => 'form-control numberonly'
				);
				echo form_input($data);
				echo form_error('no_free_invite', '<small class="text-danger">', '</small>');
			  ?>
			</div>
			<div class="col-lg-2">
			  <label>Need Approval For one or more invite</label>
			  <div class="custom-control custom-checkbox">
			    <?php
				  (set_value('enabled_approval') == '') ? $checked = $this->setting->invite_approval : $checked = set_value('enabled_approval');
				  $data = array(
				    'name' => 'enabled_approval',
					'id' => 'enabled_approval',
					'value' => '1',
					'checked' => $checked,
					'class' => 'custom-control-input'
				  );
				  echo form_checkbox($data);
				?>
                <label class="custom-control-label" for="enabled_approval"><?=my_caption('global_enabled')?></label>
              </div>
			</div>
			
		  </div>
		  <div class="row form-group mb-4">
		    <div class="col-lg-6">
			  <label><?=my_caption('gs_default_role')?></label>
			  <?php
			    (set_value('default_role') == '') ? $default_role = $this->setting->default_role : $default_role  = set_value('default_role');
			    $options = my_role_list();
			    $data = array(
			      'class' => 'form-control selectpicker'
			    );
			    echo form_dropdown('default_role', $options, $default_role, $data);
			    echo form_error('default_role', '<small class="text-danger">', '</small>');
			  ?>
			</div>
		    <div class="col-lg-6">
			  <label><?=my_caption('gs_default_package')?></label>
			  <?php
			    (set_value('default_package') == '') ? $default_package = $this->setting->default_package : $default_package  = set_value('default_package');
			    $options = array('0' => 'None');
				$options += my_get_all_payment_items(TRUE);
			    $data = array(
			      'class' => 'form-control selectpicker'
			    );
			    echo form_dropdown('default_package', $options, $default_package, $data);
			    echo form_error('default_package', '<small class="text-danger">', '</small>');
			  ?>
			</div>
		  </div>
		  <div class="row form-group mb-4">
		    <div class="col-lg-6">
			  <label><?=my_caption('gs_psr')?></label>
			  <?php
			    (set_value('psr') == '') ? $psr = $this->setting->psr : $psr  = set_value('psr');
			    $options = array(
				  'low' => my_caption('gs_psr_low'),
				  'normal' => my_caption('gs_psr_normal'),
				  'medium' => my_caption('gs_psr_medium'),
				  'strong' => my_caption('gs_psr_strong')
				);
			    $data = array(
			      'class' => 'form-control selectpicker'
			    );
			    echo form_dropdown('psr', $options, $psr, $data);
			    echo form_error('psr', '<small class="text-danger">', '</small>');
			  ?>
			</div>
		    <div class="col-lg-6">
			  <label><?=my_caption('gs_2FA')?></label>
			  <?php
			    (set_value('two_FA') == '') ? $two_FA = $this->setting->two_factor_authentication : $two_FA  = set_value('two_FA');
			    $options = array(
				  'disabled' => 'Disabled',
				  'email' => 'Email'
				);
			    $data = array(
			      'class' => 'form-control selectpicker'
			    );
			    echo form_dropdown('two_FA', $options, $two_FA, $data);
			    echo form_error('two_FA', '<small class="text-danger">', '</small>');
			  ?>
			</div>
		  </div>
		  <div class="row form-group mb-4">
		    <div class="col-lg-6">
			  <label><?=my_caption('gs_throttling_policy')?></label>
			  <?php
			    (set_value('throttling_policy') == '') ? $throttling_policy = $this->setting->throttling_policy : $throttling_policy  = set_value('throttling_policy');
			    $options = array(
				  'off' => my_caption('gs_throttling_policy_off'),
				  'normal' => my_caption('gs_throttling_policy_normal'),
				  'strict' => my_caption('gs_throttling_policy_strict')
				);
			    $data = array(
			      'class' => 'form-control selectpicker'
			    );
			    echo form_dropdown('throttling_policy', $options, $throttling_policy, $data);
			    echo form_error('throttling_policy', '<small class="text-danger">', '</small>');
			  ?>
			</div>
		    <div class="col-lg-6">
			  <label><?=my_caption('gs_throttling_unlock_time')?></label>
			  <?php
			    (set_value('throttling_unlock_time') == '') ? $throttling_unlock_time = $this->setting->throttling_unlock_time : $throttling_unlock_time  = set_value('throttling_unlock_time');
			    $options = array(
				  '15' => my_caption('gs_throttling_unlock_time_15'),
				  '30' => my_caption('gs_throttling_unlock_time_30'),
				  '60' => my_caption('gs_throttling_unlock_time_60'),
				  '1440' => my_caption('gs_throttling_unlock_time_1440')
				);
			    $data = array(
			      'class' => 'form-control selectpicker'
			    );
			    echo form_dropdown('throttling_unlock_time', $options, $throttling_unlock_time, $data);
			    echo form_error('throttling_unlock_time', '<small class="text-danger">', '</small>');
			  ?>
			</div>
		  </div>
		  <div class="row form-group mb-4">
		    <div class="col-lg-6">
			  <label><?=my_caption('gs_xss_clean')?></label>
			  <?php
			    (set_value('xss_clean') == '') ? $xss_clean = $this->setting->xss_clean : $xss_clean  = set_value('xss_clean');
			    $options = array(
				  '0' => my_caption('global_off'),
				  '1' => my_caption('global_on')
				);
			    $data = array(
			      'class' => 'form-control selectpicker'
			    );
			    echo form_dropdown('xss_clean', $options, $xss_clean, $data);
			    echo form_error('xss_clean', '<small class="text-danger">', '</small>');
			  ?>
			</div>
		    <div class="col-lg-6">
			  <label><?=my_caption('gs_html_purify')?></label>
			  <?php
			    (set_value('html_purify') == '') ? $html_purify = $this->setting->html_purify : $html_purify  = set_value('html_purify');
			    $options = array(
				  '0' => my_caption('global_off'),
				  '1' => my_caption('global_on')
				);
			    $data = array(
			      'class' => 'form-control selectpicker'
			    );
			    echo form_dropdown('html_purify', $options, $html_purify, $data);
			    echo form_error('html_purify', '<small class="text-danger">', '</small>');
			  ?>
			</div>
		  </div>
		  <div class="row form-group mb-4">
		    <div class="col-lg-6">
			  <label><?=my_caption('gs_custom_setting_css')?></label>
			  <?php
			    (set_value('dashboard_custom_css') == '') ? $dashboard_custom_css = $this->setting->dashboard_custom_css : $dashboard_custom_css  = set_value('dashboard_custom_css');
			    $data = array(
				  'name' => 'dashboard_custom_css',
				  'id' => 'dashboard_custom_css',
				  'value' => $dashboard_custom_css,
				  'class' => 'form-control',
				  'placeholder' => my_caption('gs_custom_setting_css_placheholder')
				);
				echo form_input($data);
				echo form_error('dashboard_custom_css', '<small class="text-danger">', '</small>');
			  ?>
			</div>
		    <div class="col-lg-6">
			  <label><?=my_caption('gs_custom_setting_js')?></label>
			  <?php
			    (set_value('dashboard_custom_javascript') == '') ? $dashboard_custom_javascript = $this->setting->dashboard_custom_javascript : $dashboard_custom_javascript  = set_value('dashboard_custom_javascript');
			    $data = array(
				  'name' => 'dashboard_custom_javascript',
				  'id' => 'dashboard_custom_javascript',
				  'value' => $dashboard_custom_javascript,
				  'class' => 'form-control',
				  'placeholder' => my_caption('gs_custom_setting_js_placheholder')
				);
				echo form_input($data);
				echo form_error('dashboard_custom_javascript', '<small class="text-danger">', '</small>');
			  ?>
			</div>
		  </div>-->
<!--		  <div class="row form-group mb-5">
			<div class="col-lg-12">
			  <label><span class="text-danger">*</span> <?=my_caption('gs_maintenance_information')?></label>
			  <?php
			    (set_value('maintenance_information') == '') ? $maintenance_information = $this->setting->maintenance_message : $maintenance_information  = set_value('maintenance_information');
			    $data = array(
				  'name' => 'maintenance_information',
				  'id' => 'maintenance_information',
				  'value' => $maintenance_information,
				  'class' => 'form-control'
				);
				echo form_input($data);
				echo form_error('maintenance_information', '<small class="text-danger">', '</small>');
			  ?>
			</div>
		  </div>-->
                  <div class="row form-group mb-4">
		    <div class="col-lg-6">
			  <label>App Version</label>
                          <input type="text" class="form-control" name="app_version" value="<?= $this->setting->app_version ?>">
			</div>
		    <div class="col-lg-6">
			  <label>App Version Title</label>
			  <input type="text" class="form-control" name="app_version_title" value="<?= $this->setting->app_version_title ?>">
			</div>
		  </div>
                  <div class="row form-group mb-4">
		    <div class="col-lg-6">
			  <label>Razorpay Key</label>
                          <input type="text" class="form-control" name="razorpay_key" value="<?= $this->setting->razorpay_key ?>">
			</div>
		    <div class="col-lg-6">
			  <label>Razorpay Secret</label>
			  <input type="text" class="form-control" name="razorpay_secret" value="<?= $this->setting->razorpay_secret ?>">
			</div>
		  </div>
<!--		  <div class="row form-group mb-5">
			<div class="col-lg-12">
			  <label><span class="text-danger">*</span> <?=my_caption('gs_maintenance_information')?></label>
			  <?php
			    (set_value('maintenance_information') == '') ? $maintenance_information = $this->setting->maintenance_message : $maintenance_information  = set_value('maintenance_information');
			    $data = array(
				  'name' => 'maintenance_information',
				  'id' => 'maintenance_information',
				  'value' => $maintenance_information,
				  'class' => 'form-control'
				);
				echo form_input($data);
				echo form_error('maintenance_information', '<small class="text-danger">', '</small>');
			  ?>
			</div>
		  </div>
		  <div class="row form-group mb-5">
			<div class="col-lg-6">
			  <label><?=my_caption('gs_maintenance_mode')?></label>
			  <div class="custom-control custom-checkbox">
			    <?php
				  (set_value('maintenance_mode') == '') ? $checked = $this->setting->maintenance_mode : $checked = set_value('maintenance_mode');
				  $data = array(
				    'name' => 'maintenance_mode',
					'id' => 'maintenance_mode',
					'value' => '1',
					'checked' => $checked,
					'class' => 'custom-control-input'
				  );
				  echo form_checkbox($data);
				?>
                <label class="custom-control-label" for="maintenance_mode"><?=my_caption('global_enabled')?></label>
              </div>
			</div>
			<div class="col-lg-6">
			  <label><?=my_caption('gs_enabled_signup')?></label>
			  <div class="custom-control custom-checkbox">
			    <?php
				  (set_value('enabled_signup') == '') ? $checked = $this->setting->signup_enabled : $checked = set_value('enabled_signup');
				  $data = array(
				    'name' => 'enabled_signup',
					'id' => 'enabled_signup',
					'value' => '1',
					'checked' => $checked,
					'class' => 'custom-control-input'
				  );
				  echo form_checkbox($data);
				?>
                <label class="custom-control-label" for="enabled_signup"><?=my_caption('global_enabled')?></label>
              </div>
			</div>
		  </div>
		  <div class="row form-group mb-5">
			<div class="col-lg-6">
			  <label><?=my_caption('gs_show_terms_conditions')?></label>
			  <div class="custom-control custom-checkbox">
			    <?php
				  (set_value('terms_conditions') == '') ? $checked = $this->setting->tc_show : $checked = set_value('terms_conditions');
				  $data = array(
				    'name' => 'terms_conditions',
					'id' => 'terms_conditions',
					'value' => '1',
					'checked' => $checked,
					'class' => 'custom-control-input'
				  );
				  echo form_checkbox($data);
				?>
                <label class="custom-control-label" for="terms_conditions"><?=my_caption('global_show')?></label>
				<span class="ml-2">[<u><a href="<?=base_url('admin/general_setting_tc')?>"><?=my_caption('gs_tc_edit')?></a></u>]</span>
              </div>
			</div>
			<div class="col-lg-6">
			  <label><?=my_caption('gs_require_signup_email_verification')?></label>
			  <div class="custom-control custom-checkbox">
			    <?php
				  (set_value('email_verification_required') == '') ? $checked = $this->setting->email_verification_required : $checked = set_value('email_verification_required');
				  $data = array(
				    'name' => 'email_verification_required',
					'id' => 'email_verification_required',
					'value' => '1',
					'checked' => $checked,
					'class' => 'custom-control-input'
				  );
				  echo form_checkbox($data);
				?>
                <label class="custom-control-label" for="email_verification_required"><?=my_caption('global_require')?></label>
              </div>
			</div>
		  </div>
		  <div class="row form-group mb-5">
			<div class="col-lg-6">
			  <label><?=my_caption('gs_allow_signin_before_email_verification')?></label>
			  <div class="custom-control custom-checkbox">
			    <?php
				  (set_value('allow_signin_before_verification') == '') ? $checked = $this->setting->signin_before_verified : $checked = set_value('allow_signin_before_verification');
				  $data = array(
				    'name' => 'allow_signin_before_verification',
					'id' => 'allow_signin_before_verification',
					'value' => '1',
					'checked' => $checked,
					'class' => 'custom-control-input'
				  );
				  echo form_checkbox($data);
				?>
                <label class="custom-control-label" for="allow_signin_before_verification"><?=my_caption('global_allow')?></label>
              </div>
			</div>
			<div class="col-lg-6">
			  <label><?=my_caption('gs_allow_remember')?></label>
			  <div class="custom-control custom-checkbox">
			    <?php
				  (set_value('allow_remember') == '') ? $checked = $this->setting->remember : $checked = set_value('allow_remember');
				  $data = array(
				    'name' => 'allow_remember',
					'id' => 'allow_remember',
					'value' => '1',
					'checked' => $checked,
					'class' => 'custom-control-input'
				  );
				  echo form_checkbox($data);
				?>
                <label class="custom-control-label" for="allow_remember"><?=my_caption('global_allow')?></label>
              </div>
			</div>
		  </div>
		  <div class="row form-group mb-5">
			<div class="col-lg-6">
			  <label><?=my_caption('gs_allow_reset_password')?></label>
			  <div class="custom-control custom-checkbox">
			    <?php
				  (set_value('allow_reset') == '') ? $checked = $this->setting->forget_enabled : $checked = set_value('allow_reset');
				  $data = array(
				    'name' => 'allow_reset',
					'id' => 'allow_reset',
					'value' => '1',
					'checked' => $checked,
					'class' => 'custom-control-input'
				  );
				  echo form_checkbox($data);
				?>
                <label class="custom-control-label" for="allow_reset"><?=my_caption('global_allow')?></label>
              </div>
			</div>
			<div class="col-lg-6">
			  <label><?=my_caption('gs_api')?></label>
			  <div class="custom-control custom-checkbox">
			    <?php
				  (set_value('enabled_api') == '') ? $checked = $this->setting->api_enabled : $checked = set_value('enabled_api');
				  $data = array(
				    'name' => 'enabled_api',
					'id' => 'enabled_api',
					'value' => '1',
					'checked' => $checked,
					'class' => 'custom-control-input'
				  );
				  echo form_checkbox($data);
				?>
                <label class="custom-control-label" for="enabled_api"><?=my_caption('gs_api')?></label>
              </div>
			</div>
		  </div>-->
		  
		  <div class="row form-group mb-4">
		    
			
			<div class="col-lg-6 ">
			   
    			   <label><?php if(!isset($data_info)){ ?><span class="text-danger">*</span> <?php } ?>Company Logo (only jpeg/jpg/png/svg)</label> 
        		  
        		  <div class="custom-file">
                     <input accept="image/x-png,image/jpeg" id="infopic" onchange="frontcoverName()"  name="infopic" type="file"><br>
                     <label for="Image" id="fcoverlabel" class="form-control"  style="overflow:auto;display:none;">Image</label>
                     <span style="color:red;font-size:10px;">Max. File Size : 1MB</span>
                     
                     
                  </div>
                 
                  <?=form_error('infopic', '<small class="text-danger">', '</small>')?>
			    
			</div>
			<div class="col-lg-6 ">
			    <img id="fcover" src="<?=base_url().$this->setting->cmp_logo;?>" style="width: 300px;height:100px;border: 1px solid black;" class="obj-fit-cov">
			</div>
			
			
		    
		  </div>
		  
		  <div class="row form-group mb-4">
		    
			
			<div class="col-lg-6 ">
			   
    			   <label><?php if(!isset($data_info)){ ?><span class="text-danger">*</span> <?php } ?>Auth. Page Image (only jpeg/jpg/png/svg)</label> 
        		  
        		  <div class="custom-file">
                     <input accept="image/x-png,image/jpeg" id="infopic1" onchange="frontcoverName1()"  name="infopic1" type="file">
                     <label for="Image" id="fcover1label" class="form-control"  style="overflow:auto;display:none;">Image</label><br>
                     <span style="color:red;font-size:10px;">Max. File Size : 1MB</span>
                     
                     
                  </div>
                 
                  <?=form_error('infopic1', '<small class="text-danger">', '</small>')?>
			    
			</div>
			<div class="col-lg-6 ">
			    <img id="fcover1" src="<?=base_url().$this->setting->login_page_logo;?>" style="width: 200px;height:200px;border: 1px solid black;" class="obj-fit-cov">
			</div>
			
			
		    
		  </div>
		  
		  <div class="row form-group mb-4">
		    
			
			<div class="col-lg-6 ">
			   
    			   <label><?php if(!isset($data_info)){ ?><span class="text-danger">*</span> <?php } ?>System ICON / Favicon (only jpeg/jpg/png/svg)</label> 
        		  
        		  <div class="custom-file">
                     <input type='file' id="userfile" name="userfile" class="mb-3" accept="*"><br>
			    <?php echo form_error('userfile', '<small class="text-danger">', '</small>'); ?>
		             <span style="color:red;font-size:10px;">Max. File Size : 1MB</span>
                  </div>
                 
                  <?=form_error('infopic1', '<small class="text-danger">', '</small>')?>
			    
			</div>
			<div class="col-lg-6 ">
			    
			    <img id="img" src="<?=base_url().$this->setting->favicon;?>" class="avatar" style="border-radius:0px!important;width: 200px;height:200px;border: 1px solid black;" class="obj-fit-cov"><br>
			</div>
			
			
		    
		  </div>

                  <div class="row form-group mb-4">
		    
			
			<div class="col-lg-6 ">
			   
    			   <label><?php if(!isset($data_info)){ ?><span class="text-danger">*</span> <?php } ?>Membership Image (only jpeg/jpg/png)</label> 
        		  
        		  <div class="custom-file">
                     <input type='file' id="userfile1" name="userfile1" class="mb-3" accept="*"><br>
			    <?php echo form_error('userfile1', '<small class="text-danger">', '</small>'); ?>
		             <span style="color:red;font-size:10px;">Max. File Size : 1MB</span>
                  </div>
                 
                  <?=form_error('userfile1', '<small class="text-danger">', '</small>')?>
			    
			</div>
			<div class="col-lg-6 ">
			    <?php  if($this->setting->membership_image != ''){ ?>
			          <div class="image-area">
    			          <img id="fcover" src="<?=base_url().$this->setting->membership_image;?>" style="width: 200px;height:200px;border: 1px solid black;" class="obj-fit-cov">
    			          <a href="javascript:void(0)" class="btn btn-danger  btn-flat btn-sm remove-image" onclick="actionQuery('Delete', 'Are you sure delete this Image?', '<?=base_url('admin/removemembershipimage/')?>')"><i class="fa fa-times"></i></a><br>
    			      </div>    
			             
			        <?php } else {?>
			         <img id="fcover" src="<?=base_url();?>upload/no_image.jpg" style="width: 200px;height:200px;border: 1px solid black;" class="obj-fit-cov">
                    <?php } ?>
			    <!--<img id="img" src="<?=base_url().$this->setting->membership_image;?>" class="avatar" style="border-radius:0px!important;width: 200px;height:200px;border: 1px solid black;" class="obj-fit-cov"><br>-->
			</div>
			
			
		    
		  </div>
		  
		  
		  <hr>
		  <div class="row">
			<div class="col-lg-6 offset-6 text-right">
			  <?php
			    $data = array(
				  'type' => 'submit',
				  'name' => 'btn_submit_block',
				  'id' => 'btn_submit_block',
				  'value' => my_caption('global_save_changes'),
				  'class' => 'btn btn-primary mr-2'
			    );
			    echo form_submit($data);
			  ?>
			</div>
		  </div>
		</div>
      </div>
	</div>
	<!-- <div class="col-lg-4">
	  <div class="card shadow mb-4">
	    <div class="card-header py-3">
		  <h6 class="m-0 font-weight-bold text-primary"> </h6>
        </div>
        <div class="card-body">
		  <div class="row">
		    <div class="col-lg-12 mb-4">
			  <?php $img_url = base_url('upload/favicon.ico') . '?dummy=' . random_string('alnum', 6); ?>
		      <img id="img" src="<?=base_url().$this->setting->favicon;?>" class="avatar"><br>
		      <span style="color:red;font-size:10px;">Max. File Size : 1MB</span>
		    </div>
		  </div>
		  <div class="row mb-2">
		    <div class="col-lg-12">
		      <input type='file' id="userfile" name="userfile" class="mb-3" accept="*">
			  <?php echo form_error('userfile', '<small class="text-danger">', '</small>'); ?>
		    </div>
		  </div>
		</div>
	  </div>
    </div> -->
  </div>
  <?php echo form_close(); ?>
</div>
<?php my_load_view($this->setting->theme, 'footer')?>

<script type="text/javascript">
document.getElementById("infopic1").onchange = function () {
var reader = new FileReader();

reader.onload = function (e) {
 // get loaded data and render thumbnail.
 document.getElementById("fcover1").src = e.target.result;
 var fullPath=document.getElementById("infopic1").value;
 var filename = fullPath.replace(/^.*[\\\/]/,'');
     
 document.getElementById("fcover1label").innerHTML = filename;
};

 // read the image file as a data URL.
 reader.readAsDataURL(this.files[0]);
};

function frontcoverName1() 
{
  var fullPath = document.getElementById("infopic1").src;
  var filename = fullPath.replace(/^.*[\\\/ '']/, '');
  document.getElementById("fcover1label").innerHTML = filename;
}
</script> 