<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php my_load_view($this->setting->theme, 'header')?>
<div class="container-fluid">
  <?php echo form_open(base_url('globalfile/updatepermission/'.$role), ['method'=>'POST']); ?>
  <div class="row">
    <div class="col-lg-6 text-left">
	  <h1 class="h3 mb-4 text-gray-800"><?=my_caption('rp_permission_title')?></h1>
	</div>
    <div class="col-lg-6 text-right">
	  <button type="submit" class="btn btn-success mr-3"><?=my_caption('rp_permission_update_button')?></button>
	</div>
  </div>
  <div class="row">
    <div class="col-lg-12">
	  <?php
	    my_load_view($this->setting->theme, 'Generic/show_flash_card');
	  ?>
	  <div class="table-responsive mt-3">
	    <table class="table table-bordered">
		  <thead>
		    <tr>
			  <th width="20%">Menu Name</th>
			  <th>View Permission</th>
			  <th>Edit Permission</th>
			  <th>Delete Permission</th>
			</tr>
          </thead>
          <tbody>
		    
		    <?php
		    foreach($menu_data as $valmenu)
		    {
		       $checkper = $this->Global_model->check_permission($valmenu['menu_id'],$role);
		    ?>
		     <tr>
		         <td>
		             <input type="hidden" name="menuid" value="<?=$valmenu['menu_id'];?>" />
		             <?=$valmenu['menu_name'];?>
		         </td>
		         <td>
		             
		             <input type="checkbox" id="vewper" name="vewper_<?=$valmenu['menu_id'];?>"  <?php if($checkper['view_per'] == '1') { echo "checked";}?> >
                     <label for="vewper"></label>
		         </td>
		         <td>
		             
		             <input type="checkbox" id="edtper" name="edtper_<?=$valmenu['menu_id'];?>"  <?php if($checkper['edit_per'] == '1') { echo "checked";}?> >
                     <label for="edtper"></label>
		         </td>
		         <td>
		             
		             <input type="checkbox" id="delper" name="delper_<?=$valmenu['menu_id'];?>"  <?php if($checkper['delete_per'] == '1') { echo "checked";}?> >
                     <label for="delper"></label>
		         </td>
		         
		     </tr>
		    <?php
		    } 
		    ?>
		   
		  </tbody>
		</table>
	  </div>
	</div>
  </div>
  <?php echo form_close(); ?>
</div>
<?php my_load_view($this->setting->theme, 'footer');?>
<?php my_load_view($this->setting->theme, 'Generic/simple_input_modal');?>