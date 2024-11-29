
<?php  
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php  my_load_view($this->setting->theme, 'header')?>
    <!--<link href="<?=base_url()?>assets/themes/default/vendor/dropzone/dropzone.min.css" type="text/css" rel="stylesheet" />-->
    
    <!--<link href="<?=base_url()?>assets/dropzone/dropzone.min.css" type="text/css" rel="stylesheet" />-->
    <!--<script src="<?=base_url()?>assets/dropzone/dropzone.min.js"></script>-->
    <!--<script type="text/javascript" src="<?=base_url()?>assets/dropzone/dropzone.custom.min.js"></script>-->   
<?php 





$page_uri = $this->uri->segment(3);

    $page_name = 'Reward Point Edit';
    $formurl = base_url('rewardpoint/managesrewardpoint/'.$pack_info->id);
    $btnnms = my_caption('menu_update_button');
    
    $evt_titles = $pack_info->activity;
    $evt_titles1 = $pack_info->description;
    $evt_titles2 = $pack_info->point;
    


?>
<div class="container-fluid">
  <!--<h1 class="h3 mb-4 text-gray-800"><?=$page_name?></h1>-->

   <?php
  my_load_view($this->setting->theme, 'breadcum');
 
?>


  <div class="row">
    <div class="col-lg-12">
	  <?php
	    my_load_view($this->setting->theme, 'Generic/show_flash_card');
	  ?>
	  <div class="card shadow mb-4">
	    <div class="card-header py-3">
		  <h3 class="m-0 font-weight-bold text-primary"><?=$page_name;?></h3>
        </div>
        <div class="card-body">
		  <?php
		    //echo form_open($formurl, ['method'=>'POST']);
		    echo form_open_multipart($formurl, ['method'=>'POST']);
		  ?>
		  
		  <input type="hidden" id="base_url" name="base_url" value="<?=base_url()?>">
		  <div class="row form-group mb-4">
		    
		    <div class="col-lg-12">
			  <label><span class="text-danger">*</span> Activity</label>
			  <?php
			    (!empty(set_value('activity'))) ? $event_title = set_value('activity') : $event_title = $evt_titles;
			    
			    $data = array(
				  'name' => 'activity',
				  'id' => 'activity',
				  'value' => $event_title,
				  'class' => 'form-control'
				);
				echo form_input($data);
				echo form_error('activity', '<small class="text-danger">', '</small>');
			  ?>
			  
			</div>
                      <div class="col-lg-12">
			  <label><span class="text-danger">*</span> Description</label>
			  <?php
			    (!empty(set_value('description'))) ? $event_title1 = set_value('description') : $event_title1 = $evt_titles1;
			    
			    $data = array(
				  'name' => 'description',
				  'id' => 'description',
				  'value' => $event_title1,
				  'class' => 'form-control'
				);
				echo form_input($data);
				echo form_error('description', '<small class="text-danger">', '</small>');
			  ?>
			  
			</div>
                      <div class="col-lg-12">
			  <label><span class="text-danger">*</span> Point</label>
			  <?php
			    (!empty(set_value('point'))) ? $event_title2 = set_value('point') : $event_title2 = $evt_titles2;
			    
			    $data = array(
				  'name' => 'point',
				  'id' => 'point',
				  'value' => $event_title2,
				  'class' => 'form-control'
				);
				echo form_input($data);
				echo form_error('point', '<small class="text-danger">', '</small>');
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

<?php my_load_view($this->setting->theme, 'footer');
