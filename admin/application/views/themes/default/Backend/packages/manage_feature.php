
<?php  
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php  my_load_view($this->setting->theme, 'header')?>
    
<?php 

$page_uri = $this->uri->segment(3);
if(!isset($fet_info))
{
    $page_name = my_caption('fet_add_title');
    $formurl = base_url('packages/managesfeature');
    $btnnms = my_caption('menu_new_create_button');
    
    $fet_names = '';
    $fet_prcs = '';
    $fet_description = '';
}
else
{
    $page_name = my_caption('fet_edt_title');
    $formurl = base_url('packages/managesfeature/'.$fet_info->ids);
    $btnnms = my_caption('menu_update_button');
    $fet_description = $fet_info->fet_description;
    $fet_names = $fet_info->fet_name;
    
}

?>
<div class="container-fluid">
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
			  <label><span class="text-danger">*</span> <?=my_caption('fet_name');?></label>
			  <?php
			    (!empty(set_value('fet_name'))) ? $fet_name = set_value('fet_name') : $fet_name = $fet_names;
			    
			    $data = array(
				  'name' => 'fet_name',
				  'id' => 'fet_name',
				  'value' => $fet_name,
				  'class' => 'form-control'
				);
				echo form_input($data);
				echo form_error('fet_name', '<small class="text-danger">', '</small>');
			  ?>
			  
			</div>
		    
		   
		  </div>
		  
		  <!--<hr>-->
                  <div class="row form-group mb-4">
		    
		    <div class="col-lg-12">
			  <label><span class="text-danger">*</span> Feature Description <a title="Please do not remove {##var##}.It will be used to show count"><i class="fa fa-info-circle"></i></a></label>
			  <?php
			    (!empty(set_value('fet_description'))) ? $fet_description = set_value('fet_description') : $fet_description = $fet_description;
			    
			    $data = array(
				  'name' => 'fet_description',
				  'id' => 'blog_body1',
				  'value' => $fet_description,
				  'class' => 'form-control'
				);
				echo form_textarea($data);
				echo form_error('fet_description', '<small class="text-danger">', '</small>');
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
			  ?><a href="#" onclick="window.location.reload(true);"><button type="button" id="reset_btn" class="btn mr-2">Reset</button></a>
			    <a href="javascript:window.history.go(-1);"><button type="button" id="cancel_btn" class="btn mr-2">Cancel</button></a>
			</div>
		  </div>
		  <?php echo form_close(); ?>
		</div>
      </div>
	</div>
  </div>
</div>

<?php my_load_view($this->setting->theme, 'footer')?>
