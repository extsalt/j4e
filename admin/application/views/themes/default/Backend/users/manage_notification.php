
<?php  
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php  my_load_view($this->setting->theme, 'header')?>
    
<?php 

$page_uri = $this->uri->segment(3);
if(!isset($fet_info))
{
    $page_name = my_caption('rewards_add_title');
    $formurl = base_url('users/notifications');
    $btnnms = my_caption('menu_new_create_button');
    
    $titles = '';
    (set_value('desc') == '') ? $blog_body = '' : $blog_body = set_value('desc');  
    
}


?>
<div class="container-fluid">
  <h1 class="h3 mb-4 text-gray-800"><?=$page_name?></h1>

  <div class="row">
    <div class="col-lg-12">
	  <?php
	    my_load_view($this->setting->theme, 'Generic/show_flash_card');
	  ?>
	  <div class="card shadow mb-4">
	    <div class="card-header py-3">
		  <h6 class="m-0 font-weight-bold text-primary"><?=$page_name;?></h6>
        </div>
        
        <div class="card-body">
		  <?php
		    //echo form_open($formurl, ['method'=>'POST']);
		    echo form_open_multipart($formurl, ['method'=>'POST']);
		  ?>
		  
		  <input type="hidden" id="base_url" name="base_url" value="<?=base_url()?>">
		 
		  <div class="row form-group mb-4">
		    
		    <div class="col-lg-12">
			  <label><span class="text-danger">*</span> Title</label>
			  <?php
			    (!empty(set_value('title'))) ? $title = set_value('title') : $title = $titles;
			    
			    $data = array(
				  'name' => 'title',
				  'id' => 'title',
				  'value' => $title,
				  'class' => 'form-control'
				);
				echo form_input($data);
				echo form_error('title', '<small class="text-danger">', '</small>');
			  ?>
			  
			</div>
		    
		    
		    
		  </div>
		  
		  <div class="row form-group mb-4">
		    
		    <div class="col-lg-12">
			  <label><span class="text-danger">*</span> Description</label>
			  <input type="hidden" name="blog_body_value" id="blog_body_value" value="<?=my_esc_html($blog_body)?>">
			  <textarea id="blog_body" name="dec_eng"></textarea>
			  <?=form_error('dec_eng', '<small class="text-danger">', '</small>')?>
			</div>
		    
		    
		  </div>
		  
		 <!--
		 
		  <div class="row form-group mb-4">
		    
		    <div class="col-lg-6">
			  <label><span class="text-danger">*</span> User Name</label>
			  <select class="form-control" name="user_name" id="user_name">
			      <option value="0">Select UserName</option>
			      <?php foreach($user_data as $val_user){?>
			      <option value="<?=$val_user->id;?>"><?=$val_user->full_name;?></option>
			      <?php } ?>
			  </select>
			  <?php echo form_error('sub_subtype', '<small class="text-danger">', '</small>');?>
			 
			
			 
			</div><div class="col-lg-6">
			  <label><span class="text-danger">*</span> Rewards</label>
			  <select class="form-control" name="rewardid" id="rewardid">
			      <option value="0">Select Rewards</option>
			      <?php foreach($reward_data as $val_reward){?>
			      <option value="<?=$val_reward->rewards_id;?>"><?=$val_reward->rewards_title;?></option>
			      <?php } ?>
			  </select>
			  <?php echo form_error('sub_subtype', '<small class="text-danger">', '</small>');?>
			 
			
			 
			</div>
		    
		    
		    <div class="col-lg-6 mt-3">
			  <label><span class="text-danger">*</span> Start Date</label>
			  <?php
			    (!empty(set_value('start_date'))) ? $start_date = set_value('start_date') : $start_date = $start_dates;
			    
			    $data = array(
				  'name' => 'start_date',
				  'type'=>'date',
				  'id' => 'start_date',
				  'value' => $start_dates,
				  'class' => 'form-control'
				);
				echo form_input($data);
				echo form_error('start_date', '<small class="text-danger">', '</small>');
			  ?>
			  
			</div>
		    
		   
		  </div>
		  -->
		  <hr>
		  <div class="row">
			<div class="col-lg-6 offset-6 text-right">
			  <?php
			    $data = array(
				  'type' => 'submit',
				  'name' => 'btn_submit_block',
				  'id' => 'btn_submit_block',
				  'value' => $btnnms,
				  'class' => 'btn btn-primary mr-2'
			    );
			    echo form_submit($data);
			  ?>
			  <a href="#" onclick="window.location.reload(true);"><button type="button" id="reset_btn" class="btn mr-2">Reset</button></a>
			    <a href="javascript:window.history.go(-1);"><button type="button" id="cancel_btn" class="btn mr-2">Cancel</button></a>
			</div>
		  </div>
		  
		  <?php echo form_close(); ?>
		</div>
      </div>
	</div>
  </div>
</div>
<div class="clearfix"></div>
<?php my_load_view($this->setting->theme, 'footer')?>
