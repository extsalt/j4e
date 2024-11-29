
<?php  
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php  my_load_view($this->setting->theme, 'header')?>
    
<?php 

$page_uri = $this->uri->segment(3);

    $page_name = 'Privacy Policy';
    $formurl = base_url('infopages/manageprivacypolicy');
    $btnnms = my_caption('menu_update_button');
    
    
    $dec_engs = $abt_info->infpg_desc_eng;
     


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
	        <h3 class="m-0 font-weight-bold text-primary"><?=$page_name;?></h3>
		  
        </div>
        <div class="card-body">
		  <?php
		    echo form_open_multipart($formurl, ['method'=>'POST']);
		  ?>
		  
		  <input type="hidden" id="base_url" name="base_url" value="<?=base_url()?>">
		  
		  
		  <div class="row form-group mb-4">
		    
		    <div class="col-lg-12">
			  
			  <?php
			    (!empty(set_value('dec_eng'))) ? $dec_eng = set_value('dec_eng') : $dec_eng = $dec_engs;
			    
			    $data = array(
				  'name' => 'dec_eng',
				  'id' => 'blog_body1',
				  'value' => $dec_eng,
				  'class' => 'form-control'
				);
				echo form_textarea($data);
				echo form_error('dec_eng', '<small class="text-danger">', '</small>');
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
			</div>
		  </div>
		  <?php echo form_close(); ?>
		</div>
      </div>
	</div>
  </div>
</div>

<?php my_load_view($this->setting->theme, 'footer')?>
