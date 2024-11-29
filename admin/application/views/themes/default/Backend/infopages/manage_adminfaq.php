
<?php  
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php  my_load_view($this->setting->theme, 'header')?>
    
<?php 

$page_uri = $this->uri->segment(3);
if(!isset($data_info))
{
    $page_name = "FAQ's Add";
    $formurl = base_url('infopages/managesfaq');
    $btnnms = my_caption('menu_new_create_button');
    
    $faq_name_eng = '';
    
    $dec_engs = '';
    $dec_mrts = '';
    
}
else
{
    $page_name = "FAQ's Edit";
    $formurl = base_url('infopages/managesfaq/'.$data_info->faq_id);
    $btnnms = my_caption('menu_update_button');
    
    $faq_name_eng = $data_info->faq_que;
   
    $dec_engs = $data_info->faq_ans;
   
     
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
			  <label><span class="text-danger">*</span> Question</label>
			  <?php
			    (!empty(set_value('name_eng'))) ? $name_eng = set_value('name_eng') : $name_eng = $faq_name_eng;
			    
			    $data = array(
				  'name' => 'name_eng',
				  'id' => 'name_eng',
				  'value' => $name_eng,
				  'class' => 'form-control'
				);
				echo form_input($data);
				echo form_error('name_eng', '<small class="text-danger">', '</small>');
			  ?>
			  
			</div>
		    
		    
		  </div>
		  
		  <div class="row form-group mb-4">
		    
		    <div class="col-lg-12">
			  <label><span class="text-danger">*</span> Answer</label>
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
