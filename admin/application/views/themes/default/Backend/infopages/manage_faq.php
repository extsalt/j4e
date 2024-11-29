
<?php  
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php  my_load_view($this->setting->theme, 'header')?>
    
<?php 

$page_uri = $this->uri->segment(3);
if(!isset($data_info))
{
    $page_name = my_caption('faq_add_title');
    $formurl = base_url('globalfile/managesfaq');
    $btnnms = my_caption('menu_new_create_button');
    
    $faq_name_eng = '';
    $faq_name_mrt = '';
    $dec_engs = '';
    $dec_mrts = '';
    
    (set_value('dec_eng') == '') ? $blog_body = '' : $blog_body = set_value('dec_eng');   
    (set_value('dec_mrt') == '') ? $blog_body1 = '' : $blog_body1 = set_value('dec_mrt');  
    
}
else
{
    $page_name = my_caption('faq_edt_title');
    $formurl = base_url('globalfile/managesfaq/'.$data_info->faq_id);
    $btnnms = my_caption('menu_update_button');
    
    $faq_name_eng = $data_info->faq_name_eng;
    $faq_name_mrt = $data_info->faq_name_mrt;
    $dec_engs = $data_info->faq_desc_eng;
    $dec_mrts = $data_info->faq_desc_mrt;
    
    (set_value('dec_eng') == '') ? $blog_body = html_escape($data_info->faq_desc_eng) : $blog_body = set_value('dec_eng');  
    (set_value('dec_mrt') == '') ? $blog_body1 = html_escape($data_info->faq_desc_mrt) : $blog_body1 = set_value('dec_mrt'); 
     
}

?>
<div class="container-fluid">
  <?php  my_load_view($this->setting->theme, 'breadcum')?>
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
		    
		    <div class="col-lg-6">
			  <label><span class="text-danger">*</span> <?=my_caption('faq_name_eng');?></label>
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
		    
		    <div class="col-lg-6">
			  <label><span class="text-danger">*</span> <?=my_caption('faq_name_mrt');?></label>
			  <?php
			    (!empty(set_value('name_mrt'))) ? $name_mrt = set_value('name_mrt') : $name_mrt = $faq_name_mrt;
			    $data = array(
				  'name' => 'name_mrt',
				  'id' => 'name_mrt',
				  'value' => $name_mrt,
				  'class' => 'form-control'
				);
				echo form_input($data);
				echo form_error('name_mrt', '<small class="text-danger">', '</small>');
			  ?>
			</div>
		  </div>
		  
		  <div class="row form-group mb-4">
		    
		    <div class="col-lg-6">
			  <label><span class="text-danger">*</span> <?=my_caption('faq_dec_eng');?></label>
			  <input type="hidden" name="blog_body_value" id="blog_body_value" value="<?=my_esc_html($blog_body)?>">
			  <textarea id="blog_body" name="dec_eng"></textarea>
			  <?=form_error('dec_eng', '<small class="text-danger">', '</small>')?>
			  
			</div>
		    
		    <div class="col-lg-6">
			  <label><span class="text-danger">*</span> <?=my_caption('faq_dec_mrt');?></label>
			  <input type="hidden" name="blog_body_value1" id="blog_body_value1" value="<?=my_esc_html($blog_body1)?>">
			  <textarea id="blog_body1" name="dec_mrt"></textarea>
			  <?=form_error('dec_mrt', '<small class="text-danger">', '</small>')?>
			  
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
