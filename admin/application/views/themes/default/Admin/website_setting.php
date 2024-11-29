<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$info = $this->db->get('website_settings')->row();
?>
<?php my_load_view($this->setting->theme, 'header')?>
<div class="container-fluid">
  <h1 class="h3 mb-4 text-gray-800">Website Settings</h1>
  <?php echo form_open_multipart(base_url('admin/website_setting_action/'), ['method'=>'POST']); ?>
  <input type="hidden" id="base_url" name="base_url" value="<?=base_url()?>">
  <div class="row">
    <div class="col-lg-8">
	  <?php my_load_view($this->setting->theme, 'Generic/show_flash_card');?>
	  <div class="card shadow mb-4">
	    <div class="card-header py-3">
		  <h6 class="m-0 font-weight-bold text-primary">Website Settings</h6>
        </div>
        <div class="card-body">
		  <!--<input type="hidden" name="act" value="user_setting">-->
		  <div class="row form-group mb-4">
		    <div class="col-lg-6">
			  <label> Home Slider Caption</label>
			  <input type="text" class="form-control" name="home_slider_caption" value="<?= $info->home_slider_caption ?>">
			</div>
                      <div class="col-lg-6">
			  <label>Support Email</label>
                          <input type="mail" class="form-control" name="support_mail" value="<?= $info->support_mail ?>">
			</div>
		  </div>

                  <div class="row form-group mb-4">
		    <div class="col-lg-6">
			  <label>Android Link</label>
                          <input type="text" class="form-control" name="android_link" value="<?= $info->android_link ?>">
			</div>
		    <div class="col-lg-6">
			  <label>ios Link</label>
			  <input type="text" class="form-control" name="ios_link" value="<?= $info->ios_link ?>">
			</div>
		  </div>
                  <div class="row form-group mb-4">
		    <div class="col-lg-6">
			  <label>Facebook Link</label>
                          <input type="text" class="form-control" name="fb_link" value="<?= $info->fb_link ?>">
			</div>
		    <div class="col-lg-6">
			  <label>Linkedin Link</label>
			  <input type="text" class="form-control" name="in_link" value="<?= $info->in_link ?>">
			</div>
		  </div>
                  <div class="row form-group mb-4">
		    <div class="col-lg-6">
			  <label>Youtube Link</label>
                          <input type="text" class="form-control" name="yt_link" value="<?= $info->yt_link ?>">
			</div>
		    <div class="col-lg-6">
			  <label>Map Link</label>
			  <input type="text" class="form-control" name="map_link" value="<?= $info->map_link ?>">
			</div>
		  </div>
		  <div class="row form-group mb-4">
		    <div class="col-lg-6">
			  <label>Address<span class="text-danger">*</span></label>
                          <textarea class="form-control" name="address" rows="5" required=""><?= $info->address ?></textarea>
			</div>
		    <div class="col-lg-6">
			  <label>About</label>
			  <textarea class="form-control" name="about" rows="5"><?= $info->about ?></textarea>
			</div>
		  </div>
            <div class="row form-group mb-4">
                <div class="col-lg-12">
			  <label>Featured Members<span class="text-danger">*</span></label>
                          <select class="form-control selectpicker" data-live-search="true" name="highlighted_users[]" id="highlighted_users" multiple="">
                              <?php
                                $str = explode(',', $info->highlighted_users);
                                $ui = $this->db->where('user_delete','1')->where('membership_type','2')->get('user')->result();
//                                echo $this->db->last_query();die;
                                if(!empty($ui))
                                {
                                    foreach($ui as $val)
                                    {
                              ?>
                              <option value="<?= $val->id ?>" <?php if(in_array($val->id, $str)){ echo 'selected'; } ?>><?= $val->first_name." ".$val->last_name ?></option>
                              <?php
                                    }
                                }
                              ?>
                              
                          </select>
			</div>
            </div>
                  <div class="row form-group mb-4">
		    
			
			<div class="col-lg-6 ">
			   
    			   <label><?php if(!isset($info->home_slider)){ ?><span class="text-danger">*</span> <?php } ?>Home Slider (only jpeg/jpg/png)</label> 
        		  
        		  <div class="custom-file">
                     <input type='file' id="userfile1" name="userfile1" class="mb-3" accept="*"><br>
			    <?php echo form_error('userfile1', '<small class="text-danger">', '</small>'); ?>
		             <span style="color:red;font-size:10px;">Max. File Size : 1MB</span>
                  </div>
                 
                  <?=form_error('userfile1', '<small class="text-danger">', '</small>')?>
			    
			</div>
			<div class="col-lg-6 ">
			    <?php  if($info->home_slider != ''){ ?>
			          <div class="image-area">
    			          <img id="fcover" src="<?=base_url().$info->home_slider;?>" style="width: 200px;height:200px;border: 1px solid black;" class="obj-fit-cov">
    			          <a href="javascript:void(0)" class="btn btn-danger  btn-flat btn-sm remove-image" onclick="actionQuery('Delete', 'Are you sure delete this Image?', '<?=base_url('admin/removehomesliderimage/')?>')"><i class="fa fa-times"></i></a><br>
    			      </div>    
			             
			        <?php } else {?>
			         <img id="fcover" src="<?=base_url();?>upload/no_image.jpg" style="width: 200px;height:200px;border: 1px solid black;" class="obj-fit-cov">
                    <?php } ?>
			    <!--<img id="img" src="<?=base_url().$this->setting->membership_image;?>" class="avatar" style="border-radius:0px!important;width: 200px;height:200px;border: 1px solid black;" class="obj-fit-cov"><br>-->
			</div>
			
			
		    
		  </div>
            
                  <div class="row form-group mb-4">
		    
			
			<div class="col-lg-6 ">
			   
    			   <label><?php if(!isset($info->advertise2)){ ?><span class="text-danger">*</span> <?php } ?>Advertisement1 (only jpeg/jpg/png)</label> 
        		  
        		  <div class="custom-file">
                     <input type='file' id="userfile2" name="userfile2" class="mb-3" accept="*"><br>
			    <?php echo form_error('userfile2', '<small class="text-danger">', '</small>'); ?>
		             <span style="color:red;font-size:10px;">Max. File Size : 1MB</span>
                  </div>
                 
                  <?=form_error('userfile2', '<small class="text-danger">', '</small>')?>
			    
			</div>
			<div class="col-lg-6 ">
			    <?php  if($info->advertise2 != ''){ ?>
			          <div class="image-area">
    			          <img id="fcover" src="<?=base_url().$info->advertise2;?>" style="width: 200px;height:200px;border: 1px solid black;" class="obj-fit-cov">
    			          <a href="javascript:void(0)" class="btn btn-danger  btn-flat btn-sm remove-image" onclick="actionQuery('Delete', 'Are you sure delete this Image?', '<?=base_url('admin/removeadvertise2image/')?>')"><i class="fa fa-times"></i></a><br>
    			      </div>    
			             
			        <?php } else {?>
			         <img id="fcover" src="<?=base_url();?>upload/no_image.jpg" style="width: 200px;height:200px;border: 1px solid black;" class="obj-fit-cov">
                    <?php } ?>
			    <!--<img id="img" src="<?=base_url().$this->setting->membership_image;?>" class="avatar" style="border-radius:0px!important;width: 200px;height:200px;border: 1px solid black;" class="obj-fit-cov"><br>-->
			</div>
			
			
		    
		  </div>
            
                  <div class="row form-group mb-4">
		    
			
			<div class="col-lg-6 ">
			   
    			   <label><?php if(!isset($info->advertise3)){ ?><span class="text-danger">*</span> <?php } ?>Advertisement2 (only jpeg/jpg/png)</label> 
        		  
        		  <div class="custom-file">
                     <input type='file' id="userfile3" name="userfile3" class="mb-3" accept="*"><br>
			    <?php echo form_error('userfile3', '<small class="text-danger">', '</small>'); ?>
		             <span style="color:red;font-size:10px;">Max. File Size : 1MB</span>
                  </div>
                 
                  <?=form_error('userfile3', '<small class="text-danger">', '</small>')?>
			    
			</div>
			<div class="col-lg-6 ">
			    <?php  if($info->advertise3 != ''){ ?>
			          <div class="image-area">
    			          <img id="fcover" src="<?=base_url().$info->advertise3;?>" style="width: 200px;height:200px;border: 1px solid black;" class="obj-fit-cov">
    			          <a href="javascript:void(0)" class="btn btn-danger  btn-flat btn-sm remove-image" onclick="actionQuery('Delete', 'Are you sure delete this Image?', '<?=base_url('admin/removeadvertise3image/')?>')"><i class="fa fa-times"></i></a><br>
    			      </div>    
			             
			        <?php } else {?>
			         <img id="fcover" src="<?=base_url();?>upload/no_image.jpg" style="width: 200px;height:200px;border: 1px solid black;" class="obj-fit-cov">
                    <?php } ?>
			    <!--<img id="img" src="<?=base_url().$this->setting->membership_image;?>" class="avatar" style="border-radius:0px!important;width: 200px;height:200px;border: 1px solid black;" class="obj-fit-cov"><br>-->
			</div>
			
			
		    
		  </div>
            
                  <div class="row form-group mb-4">
		    
			
			<div class="col-lg-6 ">
			   
    			   <label><?php if(!isset($info->advertise4)){ ?><span class="text-danger">*</span> <?php } ?>Advertisement3 (only jpeg/jpg/png)</label> 
        		  
        		  <div class="custom-file">
                     <input type='file' id="userfile4" name="userfile4" class="mb-3" accept="*"><br>
			    <?php echo form_error('userfile4', '<small class="text-danger">', '</small>'); ?>
		             <span style="color:red;font-size:10px;">Max. File Size : 1MB</span>
                  </div>
                 
                  <?=form_error('userfile4', '<small class="text-danger">', '</small>')?>
			    
			</div>
			<div class="col-lg-6 ">
			    <?php  if($info->advertise4 != ''){ ?>
			          <div class="image-area">
    			          <img id="fcover" src="<?=base_url().$info->advertise4;?>" style="width: 200px;height:200px;border: 1px solid black;" class="obj-fit-cov">
    			          <a href="javascript:void(0)" class="btn btn-danger  btn-flat btn-sm remove-image" onclick="actionQuery('Delete', 'Are you sure delete this Image?', '<?=base_url('admin/removeadvertise4image/')?>')"><i class="fa fa-times"></i></a><br>
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