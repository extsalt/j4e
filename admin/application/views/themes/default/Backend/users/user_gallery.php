<?php   
defined('BASEPATH') OR exit('No direct script access allowed');
$ci=& get_instance();
?>
<?php my_load_view($this->setting->theme, 'header')?>
<div class="container-fluid">
  <?php
  my_load_view($this->setting->theme, 'breadcum');
 
?>
  <div class="row">
    <div class="col-lg-12">
	  <?php
	    my_load_view($this->setting->theme, 'Generic/show_flash_card');
		(my_uri_segment(3) == '') ? $seg3 = 'all' : $seg3 = my_uri_segment(3);
		(my_uri_segment(4) == '') ? $seg4 = 'all' : $seg4 = my_uri_segment(4);
	  ?>
	</div>
  </div>
  <div class="row">
    <div class="col-lg-3">
	  <div class="card mb-4 py-3 border-left-primary">
	    <div class="card-body">
		  
		   <!--
		   <hr class="dotted">
		    <a class="btn btn-light btn-block" href="<?=base_url('users/managesdetail/'.$userids)?>">User Detail</a>-->
		   <hr class="dotted">
		    <a class="btn btn-light btn-block" href="<?=base_url('users/managesaboutus/'.$userids)?>">About Us </a>
		   <hr class="dotted">
		    <a class="btn btn-light btn-block" href="<?=base_url('users/managescontactus/'.$userids)?>">Contact Us</a>
		   <hr class="dotted">
		   <hr class="dotted">
		    <a class="btn btn-primary btn-block" href="<?=base_url('users/managesgallery/'.$userids)?>">Gallery</a>
		   <hr class="dotted">
		   <hr class="dotted">
		    <a class="btn btn-light btn-block" href="<?=base_url('users/managesratereview/'.$userids)?>">Reviews</a>
		   <hr class="dotted">
		   
		  
		  
		</div>
      </div>
	</div>
	<div class="col-lg-9">
	     <div class="card shadow mb-4">
	    <div class="card-header py-3">
		  
		  <div class="row">
            <div class="col-lg-6 text-left">
        	  <h6 class="m-0 font-weight-bold text-primary">View User Gallery</h6>
        	</div>
            <div class="col-lg-6 text-right">
        	  
        	  
            </div>
          </div>
		  
		  
		  
		  
        </div>
        <div class="card-body">
		  <div class="">
		    
		    <div class="row">
		        <?php foreach($info_data as $val_data){
		              $link = $val_data->id;
		        ?>
		        <div class="fm-file-box col-md-4">
		            <div class="fm-file">
		                <img id="XkVq8yMAB5d0576d5806765826a44bbacd4459e6ayGfBcgVdI" class="fm-list-image" src="<?=base_url();?>upload/gallery/profile/<?=$val_data->image;?>">
    		            <div class="fm-file-introduction">
    		                <center><a href="javascript:void(0)" class="btn btn-danger btn-flat btn-sm" onclick="actionQuery('Delete', 'Are you sure delete this Gallery Image?', '<?=base_url('users/deletegallery/'.$link.'/'.$userids)?>')"><i class="fa fa-trash" data-toggle="tooltip" title="Delete"></i></a></center>
    		            </div>
    		       </div>
    		   </div>
		        <?php } ?>
		    </div>
		    
		    
		    
		    
		    
          </div>
		</div>
      </div>
	</div> 
  </div>
</div>

<?php my_load_view($this->setting->theme, 'footer')?>