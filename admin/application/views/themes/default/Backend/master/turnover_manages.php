
<?php  
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php  my_load_view($this->setting->theme, 'header')?>
    <link href="<?=base_url()?>assets/themes/default/vendor/dropzone/dropzone.min.css" type="text/css" rel="stylesheet" />
    
    <!--<link href="<?=base_url()?>assets/dropzone/dropzone.min.css" type="text/css" rel="stylesheet" />-->
    <script src="<?=base_url()?>assets/dropzone/dropzone.min.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/dropzone/dropzone.custom.min.js"></script>   
<?php 

if(isset($img_info))
{
   $eventsid = $img_info->img_typeid;
}
elseif(isset($eventid) && $eventid !='')
{
   $eventsid =$eventid;
}



$page_uri = $this->uri->segment(3);
if(!isset($turnover_info))
{
    $page_name = 'Turn Over Create';
    $formurl = base_url('turnover/manage/'.$eventsid);
    $btnnms = my_caption('menu_new_create_button');
    
    $evt_titles = '';
    
}
else
{
    $page_name = 'Turn Over Edit';
    $formurl = base_url('turnover/manage/'.$turnover_info->turn_over_id);
    $btnnms = my_caption('menu_update_button');
    
    $evt_titles = $turnover_info->turn_over_value;
    
}

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
			  <label><span class="text-danger">*</span> Title</label>
			  <?php
			    (!empty(set_value('event_title'))) ? $event_title = set_value('event_title') : $event_title = $evt_titles;
			    
			    $data = array(
				  'name' => 'event_title',
				  'id' => 'event_title',
				  'value' => $event_title,
				  'class' => 'form-control'
				);
				echo form_input($data);
				echo form_error('event_title', '<small class="text-danger">', '</small>');
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
