
<?php  
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php  my_load_view($this->setting->theme, 'header')?>
    
<?php 

$page_uri = $this->uri->segment(3);
if(!isset($info_data))
{
    $page_name = 'Advertise2 Add';
    $formurl = base_url('pages/managesadvertise2');
    $btnnms = my_caption('menu_new_create_button');
    
    $names = '';
    
}
else
{
    $page_name = 'Advertise2 Edit';
    $formurl = base_url('pages/managesadvertise2/'.$info_data->id);
    $btnnms = my_caption('menu_update_button');
    
    $names = $info_data->title;
//    $descs = $info_data->description;
    
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
			  <label><span class="text-danger">*</span> Title</label>
			  <input type="text" class="form-control" name="title" id="title" value="<?= $info_data->title ?>">
			  
			</div>
			
<!--			<div class="col-lg-12">
			  <label><span class="text-danger">*</span> Description</label>
                          <input type="text" class="form-control" name="description" id="blog_body" value="<?= $info_data->description ?>">
			  <textarea id="blog_body" name="description"><?= $info_data->description ?></textarea>
			</div>
                        <div class="col-lg-12">
			  <label><span class="text-danger">*</span> Date</label>
                          <input type="date" class="form-control" name="date" id="date" value="<?= $info_data->date ?>">
			  
			</div>-->
		   
		  </div>
		  
		  
		  
		  <div class="row form-group mb-4">
		   
			    
			    
			    
			    
			    
			    
			    <div class="col-lg-3">
    			
    			   <label><?php if(!isset($info_data)){ ?><span class="text-danger">*</span> <?php } ?>Image (only jpeg/jpg/png)</label> <br>
        		  
        		  <div class="custom-file">
                     <input accept="image/x-png,image/jpeg" id="infopic" onchange="frontcoverName()"  name="infopic" type="file">
                     <label for="Image" id="fcoverlabel" class="form-control"  style="overflow:auto;display:none;">Image</label><br>
                     <span style="color:red;font-size:10px;">Max. File Size : 1MB</span>
                  </div>
                  <?=form_error('infopic', '<small class="text-danger">', '</small>')?>
			    </div>
			    
			    <div class="col-lg-6">
			        
			        <?php  if(isset($info_data) && $info_data->image != ''){ ?>
			          <div class="image-area">
    			          <img id="fcover" src="<?=base_url().$info_data->image;?>" style="width: 150px;height:150px;border: 1px solid black;" class="obj-fit-cov">
    			          <a href="javascript:void(0)" class="btn btn-danger  btn-flat btn-sm remove-image" onclick="actionQuery('Delete', 'Are you sure delete this Image?', '<?=base_url('pages/removeimage4/'.$info_data->id)?>')"><i class="fa fa-times"></i></a><br>
    			      </div>    
			             
			        <?php } else {?>
			         <img id="fcover" src="<?=base_url();?>upload/no_image.jpg" style="width: 150px;height:150px;border: 1px solid black;" class="obj-fit-cov">
                    <?php } ?>
			        
			        
			        
			       
                        
			    </div>
		
		
           </div>
		    
		    
		   
		  </div>
		  
		  <hr>
		  <div class="row">
			<div class="col-lg-6 offset-6 text-right mb-2">
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
