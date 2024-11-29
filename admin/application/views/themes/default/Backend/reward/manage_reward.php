
<?php  
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php  my_load_view($this->setting->theme, 'header')?>
    
<?php 

$page_uri = $this->uri->segment(3);
if(!isset($info_data))
{
    $page_name = my_caption('reward_add_title');
    $formurl = base_url('rewards/managesrewards');
    $btnnms = my_caption('menu_new_create_button');
    
    $reward_names = '';
    $reward_points = '';
    $reward_days = '';
    $Description = '';
}
else
{
    $page_name = my_caption('reward_edt_title');
    $formurl = base_url('rewards/managesrewards/'.$info_data->rewards_id);
    $btnnms = my_caption('menu_update_button');
    
    $reward_names = $info_data->rewards_title;
    $reward_points = $info_data->rewards_point;
    $reward_days = $info_data->rewards_days;
    (set_value('Description') == '') ? $Description = html_escape($info_data->rewards_description) : $Description = set_value('Description'); 
    
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
		    
		    <div class="col-lg-6">
			  <label><span class="text-danger">*</span> <?=my_caption('reward_name');?></label>
			  <?php
			    (!empty(set_value('reward_name'))) ? $reward_name = set_value('reward_name') : $reward_name = $reward_names;
			    
			    $data = array(
				  'name' => 'reward_name',
				  'id' => 'reward_name',
				  'value' => $reward_name,
				  'class' => 'form-control'
				);
				echo form_input($data);
				echo form_error('reward_name', '<small class="text-danger">', '</small>');
			  ?>
			  
			</div>
			
			<div class="col-lg-3">
			  <label><span class="text-danger">*</span> <?=my_caption('reward_point');?></label>
			  <?php
			    (!empty(set_value('reward_point'))) ? $reward_point = set_value('reward_point') : $reward_point = $reward_points;
			    
			    $data = array(
				  'name' => 'reward_point',
				  'id' => 'reward_point',
				  'value' => $reward_point,
				  'class' => 'form-control numberonly'
				);
				echo form_input($data);
				echo form_error('reward_point', '<small class="text-danger">', '</small>');
			  ?>
			  
			</div>
		    
		    <div class="col-lg-3">
			  <label><span class="text-danger">*</span> <?=my_caption('reward_day');?></label>
			  <?php
			    (!empty(set_value('reward_day'))) ? $reward_day = set_value('reward_day') : $reward_day = $reward_days;
			    
			    $data = array(
				  'name' => 'reward_day',
				  'id' => 'reward_day',
				  'value' => $reward_day,
				  'class' => 'form-control'
				);
				echo form_input($data);
				echo form_error('reward_day', '<small class="text-danger">', '</small>');
			  ?>
			  
			</div>
		   
		  </div>
		  
		  
		  
		  <div class="row form-group mb-4">
		    
		    <div class="col-lg-6">
			  <label><span class="text-danger">*</span> Description</label>
			  <input type="hidden" name="tc_body" id="tc_body_value" value="<?=my_esc_html($Description)?>">
			  <textarea id="tc_body" name="Description"></textarea>
			  <?=form_error('Description', '<small class="text-danger">', '</small>')?>
			  
			  
			</div>
		    
		    
		    <div class="row col-lg-6">	
			
			    <div class="col-lg-6">
    			
    			   <label><?php if(!isset($info_data)){ ?><span class="text-danger">*</span> <?php } ?>Image (only jpeg/jpg/png)</label> <br>
        		  
        		  <div class="custom-file">
                     <input accept="image/x-png,image/jpeg" id="infopic" onchange="frontcoverName()"  name="infopic" type="file">
                     <label for="Image" id="fcoverlabel" class="form-control"  style="overflow:auto;display:none;">Image</label>
                     <br>
                     <span style="color:red;font-size:10px;">Max. File Size : 1MB</span>
                  </div>
                  <?=form_error('infopic', '<small class="text-danger">', '</small>')?>
			    </div>
			    
			    <div class="col-md-6">
			        <?php  if(isset($info_data) && $info_data->reward_thumbnil != ''){ ?>
			          <div class="image-area">
    			          <img id="fcover" src="<?=base_url().$info_data->reward_thumbnil;?>" style="width: 150px;height:150px;border: 1px solid black;" class="obj-fit-cov">
    			          <a href="javascript:void(0)" class="btn btn-danger  btn-flat btn-sm remove-image" onclick="actionQuery('Delete', 'Are you sure delete this Image?', '<?=base_url('rewards/removeimage/'.$info_data->rewards_id)?>')"><i class="fa fa-times"></i></a><br>
    			      </div>    
			             
			        <?php } else {?>
			         <img id="fcover" src="<?=base_url();?>upload/no_image.jpg" style="width: 150px;height:150px;border: 1px solid black;" class="obj-fit-cov">
                    <?php } ?>
			        
			        
			        
			        
                        
			    </div>
			</div>
		
           </div>
		    
		    
		   
		  </div>
		  
		  <hr>
		  <div class="row">
			<div class="col-lg-6 offset-6 text-right mb-4">
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


<?php my_load_view($this->setting->theme, 'footer')?>

<script type="text/javascript">
document.getElementById("infopic").onchange = function () {
var reader = new FileReader();

reader.onload = function (e) {
 // get loaded data and render thumbnail.
 document.getElementById("fcover").src = e.target.result;
 var fullPath=document.getElementById("infopic").value;
 var filename = fullPath.replace(/^.*[\\\/]/,'');
     
 document.getElementById("fcoverlabel").innerHTML = filename;
};

 // read the image file as a data URL.
 reader.readAsDataURL(this.files[0]);
};

function frontcoverName() 
{
  var fullPath = document.getElementById("infopic").src;
  var filename = fullPath.replace(/^.*[\\\/ '']/, '');
  document.getElementById("fcoverlabel").innerHTML = filename;
}
</script>  
