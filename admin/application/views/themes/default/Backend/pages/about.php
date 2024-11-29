
<?php  
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php  my_load_view($this->setting->theme, 'header')?>
    
<?php 

$page_uri = $this->uri->segment(3);

    $page_name = 'About Us';
    $formurl = base_url('pages/manageaboutus');
    $btnnms = my_caption('menu_update_button');
    
    $contactnos = $abt_info->phonenumber;
    $whatsappnos = $abt_info->whatsappnumber;
    $emails = $abt_info->email;
    $websites = $abt_info->website;
    $lat = $abt_info->latitude;
    $long = $abt_info->longitude;
    $maplinks= $abt_info->maplink;
    
    $facebooks= $abt_info->facebook;
    $twitters= $abt_info->twitter;
    $linkdins= $abt_info->linkdin;
     
    (set_value('vision') == '') ? $vision = html_escape($abt_info->vision) : $vision = set_value('vision'); 
    (set_value('mission') == '') ? $mision = html_escape($abt_info->mission) : $mision = set_value('mission');    
    (set_value('achievement') == '') ? $achievement = html_escape($abt_info->achievement) : $achievement = set_value('achievement');    
    (set_value('aboutdetail') == '') ? $aboutdetail = html_escape($abt_info->details) : $aboutdetail = set_value('aboutdetail');
    (set_value('shortaboutdetail') == '') ? $shortaboutdetail = html_escape($abt_info->shortabout) : $shortaboutdetail = set_value('shortaboutdetail');
    (set_value('address') == '') ? $address = html_escape($abt_info->address) : $address = set_value('address');
    

?>
<div class="container-fluid">
  
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
			  <label><span class="text-danger">*</span> Vision</label>
			  <input type="hidden" name="blog_body_value" id="blog_body_value" value="<?=my_esc_html($vision)?>">
			  <textarea id="blog_body" name="vision"></textarea>
			  <?=form_error('vision', '<small class="text-danger">', '</small>')?>
			  
			</div>
		    
		    <div class="col-lg-6">
			  <label><span class="text-danger">*</span> Mission</label>
			   <input type="hidden" name="blog_body_value1" id="blog_body_value1" value="<?=my_esc_html($mision)?>">
			  <textarea id="blog_body1" name="mission"></textarea>
			  <?=form_error('mission', '<small class="text-danger">', '</small>')?>
			  
			</div>
		   
		  </div>
		  
		  
		  <div class="row form-group mb-4">
		    
		    <div class="col-lg-6">
			  <label><span class="text-danger">*</span> About Us</label>
			  <input type="hidden" name="tc_body" id="tc_body_value" value="<?=my_esc_html($aboutdetail)?>">
			  <textarea id="tc_body" name="aboutdetail"></textarea>
			  <?=form_error('aboutdetail', '<small class="text-danger">', '</small>')?>
			  
			  
			</div>
		    
		    <div class="col-lg-6">
			  <label><span class="text-danger">*</span> Achievement</label>
			   <input type="hidden" name="notification_body" id="notification_body_value" value="<?=my_esc_html($achievement)?>">
			  <textarea id="notification_body" name="achievement"></textarea>
			  <?=form_error('achievement', '<small class="text-danger">', '</small>')?>
			  
			  
			</div>
		   
		  </div>
		  
		 
		  <div class="row form-group mb-4">
		    
		    <div class="col-lg-6">
			  <label><span class="text-danger">*</span> Contact Number</label>
			  <?php
			    (!empty(set_value('contactno'))) ? $contactno = set_value('contactno') : $contactno = $contactnos;
			    
			    $data = array(
				  'name' => 'contactno',
				  'id' => 'contactno',
				  'value' => $contactno,
				  'class' => 'form-control'
				);
				echo form_input($data);
				echo form_error('contactno', '<small class="text-danger">', '</small>');
			  ?>
			  
			</div>
		    
		    <div class="col-lg-6">
			  <label><span class="text-danger">*</span> Whatsapp No</label>
			  <?php
			    (!empty(set_value('whatsappno'))) ? $whatsappno = set_value('whatsappno') : $whatsappno = $whatsappnos;
			    $data = array(
				  'name' => 'whatsappno',
				  'id' => 'whatsappno',
				  'value' => $whatsappno,
				  'class' => 'form-control'
				);
				echo form_input($data);
				echo form_error('whatsappno', '<small class="text-danger">', '</small>');
			  ?>
			</div>
		  </div>
		  
		  <div class="row form-group mb-4">
		    
		    <div class="col-lg-6">
			  <label><span class="text-danger">*</span> Email</label>
			  <?php
			    (!empty(set_value('email'))) ? $email = set_value('email') : $email = $emails;
			    
			    $data = array(
				  'name' => 'email',
				  'id' => 'email',
				  'value' => $email,
				  'class' => 'form-control'
				);
				echo form_input($data);
				echo form_error('email', '<small class="text-danger">', '</small>');
			  ?>
			  
			</div>
		    
		    <div class="col-lg-6">
			  <label><span class="text-danger">*</span> Websites</label>
			  <?php
			    (!empty(set_value('website'))) ? $website = set_value('website') : $website = $websites;
			    $data = array(
				  'name' => 'website',
				  'id' => 'website',
				  'value' => $website,
				  'class' => 'form-control'
				);
				echo form_input($data);
				echo form_error('website', '<small class="text-danger">', '</small>');
			  ?>
			</div>
		  </div>
		  
		  <div class="row form-group mb-4">
		    
		    <div class="col-lg-6">
			  <label><span class="text-danger">*</span> Longitude</label>
			  <?php
			    (!empty(set_value('longitude'))) ? $longitude = set_value('longitude') : $longitude = $long;
			    
			    $data = array(
				  'name' => 'longitude',
				  'id' => 'longitude',
				  'value' => $longitude,
				  'class' => 'form-control'
				);
				echo form_input($data);
				echo form_error('longitude', '<small class="text-danger">', '</small>');
			  ?>
			  
			</div>
		    
		    <div class="col-lg-6">
			  <label><span class="text-danger">*</span> Latitude</label>
			  <?php
			    (!empty(set_value('latitude'))) ? $latitude = set_value('latitude') : $latitude = $lat;
			    $data = array(
				  'name' => 'latitude',
				  'id' => 'latitude',
				  'value' => $latitude,
				  'class' => 'form-control'
				);
				echo form_input($data);
				echo form_error('latitude', '<small class="text-danger">', '</small>');
			  ?>
			</div>
		  </div>
		  
		  <div class="row form-group mb-4">
		    
		    <div class="col-lg-12">
			  <label><span class="text-danger">*</span> Map Link <span style="color:red">( Enter Embadded Map Link )</span></label>
			  <?php
			    (!empty(set_value('maplink'))) ? $maplink = set_value('maplink') : $maplink = $maplinks;
			    
			    $data = array(
				  'name' => 'maplink',
				  'id' => 'maplink',
				  'value' => $maplink,
				  'class' => 'form-control'
				);
				echo form_input($data);
				echo form_error('maplink', '<small class="text-danger">', '</small>');
			  ?>
			  
			</div>
		    
		    
		  </div>
		  
		  
		  <div class="row form-group mb-4">
		    
		    <div class="col-lg-6">
			  <label><span class="text-danger">*</span> Facebook</label>
			  <?php
			    (!empty(set_value('facebook'))) ? $facebook = set_value('facebook') : $facebook = $facebooks;
			    
			    $data = array(
				  'name' => 'facebook',
				  'id' => 'facebook',
				  'value' => $facebook,
				  'class' => 'form-control'
				);
				echo form_input($data);
				echo form_error('facebook', '<small class="text-danger">', '</small>');
			  ?>
			  
			</div>
		    
		    <div class="col-lg-6">
			  <label><span class="text-danger">*</span> Twitter</label>
			  <?php
			    (!empty(set_value('twitter'))) ? $twitter = set_value('twitter') : $twitter = $twitters;
			    $data = array(
				  'name' => 'twitter',
				  'id' => 'twitter',
				  'value' => $twitter,
				  'class' => 'form-control'
				);
				echo form_input($data);
				echo form_error('twitter', '<small class="text-danger">', '</small>');
			  ?>
			</div>
		  </div>
		  <div class="row form-group mb-4">
		    
		    <div class="col-lg-6">
			  <label><span class="text-danger">*</span> Linkdin</label>
			  <?php
			    (!empty(set_value('linkdin'))) ? $linkdin = set_value('linkdin') : $linkdin = $linkdins;
			    
			    $data = array(
				  'name' => 'linkdin',
				  'id' => 'linkdin',
				  'value' => $linkdin,
				  'class' => 'form-control'
				);
				echo form_input($data);
				echo form_error('linkdin', '<small class="text-danger">', '</small>');
			  ?>
			  
			</div>
		    
		    
		  </div>
		  
		  
		  
		  <div class="row form-group mb-4">
		    
		    <div class="col-lg-6">
			  <label><span class="text-danger">*</span>Short Discription for About Us</label>
			  <input type="hidden" name="documentation_body1" id="documentation_body1" value="<?=my_esc_html($shortaboutdetail)?>">
			  <textarea id="documentation_body" name="shortaboutdetail"></textarea>
			  <?=form_error('shortaboutdetail', '<small class="text-danger">', '</small>')?>
			  
			  
			</div>
		    
		    
		    
		    <div class="col-lg-6">
			  <label><span class="text-danger">*</span> Address</label>
			  <input type="hidden" name="email_body" id="email_body_value" value="<?=my_esc_html($address)?>">
			  <textarea id="email_body" name="address"></textarea>
			  <?=form_error('address', '<small class="text-danger">', '</small>')?>
			  
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

<?php my_load_view($this->setting->theme, 'footer')?>
