<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php my_load_view($this->setting->theme, 'header')?>
<div class="container-fluid">
  <h1 class="h3 mb-4 text-gray-800"><?=my_caption('company_list_new_user')?></h1>

  <div class="row">
    <div class="col-lg-8">
	  <?php
	    my_load_view($this->setting->theme, 'Generic/show_flash_card');
	  ?>
	  <div class="card shadow mb-4">
	    <div class="card-header py-3">
		  <h6 class="m-0 font-weight-bold text-primary"><?=my_caption('company_list_new_user')?></h6>
        </div>
        <div class="card-body">
		  <?php
		    echo form_open(base_url('company/new_company_action/'), ['method'=>'POST']);
		  ?>
		  <input type="hidden" id="base_url" name="base_url" value="<?=base_url()?>">
		  <div class="row form-group mb-4">
		    <div class="col-lg-12">
			  <label><span class="text-danger">*</span> <?=my_caption('company_name')?></label>
			  <?php
			    (!empty(set_value('cmp_name'))) ? $cmp_name = set_value('cmp_name') : $cmp_name = '';
			    $data = array(
				  'name' => 'cmp_name',
				  'id' => 'cmp_name',
				  'value' => $cmp_name,
				  'class' => 'form-control'
				);
				echo form_input($data);
				echo form_error('cmp_name', '<small class="text-danger">', '</small>');
			  ?>
			</div>
		    
		  </div>
		  <div class="row form-group mb-4">
			<div class="col-lg-6">
			  <label><span class="text-danger">*</span> <?=my_caption('global_email_address')?></label>
			  <?php
			    (!empty(set_value('email_address'))) ? $email_address = set_value('email_address') : $email_address = '';
			    $data = array(
				  'name' => 'email_address',
				  'id' => 'email_address',
				  'value' => $email_address,
				  'class' => 'form-control'
				);
				echo form_input($data);
				echo form_error('email_address', '<small class="text-danger">', '</small>');
			  ?>
			</div>
			<div class="col-lg-6">
			   
			    <label><span class="text-danger">*</span> Phone Number</label>
			  <?php
			    (!empty(set_value('ph_no'))) ? $ph_no = set_value('ph_no') : $ph_no = '';
			    $data = array(
				  'name' => 'ph_no',
				  'id' => 'ph_no',
				  'value' => $ph_no,
				  'class' => 'form-control'
				);
				echo form_input($data);
				echo form_error('ph_no', '<small class="text-danger">', '</small>');
			  ?>
			  
			</div>
		  </div>
		  <div class="row form-group mb-4">
		    <div class="col-lg-6">
			  <label><span class="text-danger">*</span> <?=my_caption('signup_confirm_label')?></label>
			  <?php
			    (!empty(set_value('password'))) ? $password = set_value('password') : $password = '';
			    $data = array(
				  'name' => 'password',
				  'id' => 'password',
				  'value' => $password,
				  'class' => 'form-control'
				);
				echo form_password($data);
				echo form_error('password', '<small class="text-danger">', '</small>');
			  ?>
			</div>
		    <div class="col-lg-6">
			  <label><span class="text-danger">*</span> <?=my_caption('cp_new_password_confirm_label')?></label>
			  <?php
			    (!empty(set_value('confirm_password'))) ? $confirm_password = set_value('confirm_password') : $confirm_password = '';
			    $data = array(
				  'name' => 'confirm_password',
				  'id' => 'confirm_password',
				  'value' => $confirm_password,
				  'class' => 'form-control'
				);
				echo form_password($data);
				echo form_error('confirm_password', '<small class="text-danger">', '</small>');
			  ?>
			</div>
		  </div>
		  
		  <div class="row form-group mb-4">
			<div class="col-lg-12">
			  <label><span class="text-danger">*</span> Address</label>
			  <textarea name="address" id="address" class="form-control"><?= (!empty(set_value('address'))) ? $address = set_value('address') : $address = '';
    			    $data = array(
    				  
    				  'value' => $address,
    				  
    				);?></textarea>
			  <?php
    			   
    				
				echo form_error('address', '<small class="text-danger">', '</small>');
			  ?>
			  
			</div>
		  </div>
		  
		  <div class="row form-group mb-4">
			<div class="col-lg-4">
			  <label><span class="text-danger">*</span> City</label>
			  <?php
			    (!empty(set_value('city'))) ? $city = set_value('city') : $city = '';
			    $data = array(
				  'name' => 'city',
				  'id' => 'city',
				  'value' => $city,
				  'class' => 'form-control'
				);
				echo form_input($data);
				echo form_error('city', '<small class="text-danger">', '</small>');
			  ?>
			</div>
			<div class="col-lg-4">
			  <label><span class="text-danger">*</span> City</label>
			  <?php
			    (!empty(set_value('state'))) ? $state = set_value('state') : $state = '';
			    $data = array(
				  'name' => 'state',
				  'id' => 'state',
				  'value' => $state,
				  'class' => 'form-control'
				);
				echo form_input($data);
				echo form_error('state', '<small class="text-danger">', '</small>');
			  ?>
			</div>
			<div class="col-lg-4">
			  <label><span class="text-danger">*</span> Country</label>
			  <?php
			    (!empty(set_value('country'))) ? $country = set_value('country') : $country = '';
			    $data = array(
				  'name' => 'country',
				  'id' => 'country',
				  'value' => $country,
				  'class' => 'form-control'
				);
				echo form_input($data);
				echo form_error('country', '<small class="text-danger">', '</small>');
			  ?>
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
				  'value' => my_caption('user_new_create_button'),
				  'class' => 'btn btn-primary mr-2'
			    );
			    echo form_submit($data);
			  ?>
			</div>
		  </div>
		  <?php echo form_close(); ?>
		</div>
      </div>
	</div>
  </div>
</div>
<?php my_load_view($this->setting->theme, 'footer')?>