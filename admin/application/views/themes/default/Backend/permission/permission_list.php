<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php my_load_view($this->setting->theme, 'header')?>
<div class="container-fluid">
  <?php echo form_open(base_url('admin/permission_update/'), ['method'=>'POST']); ?>
  <div class="row">
    <div class="col-lg-6 text-left">
	  <h1 class="h3 mb-4 text-gray-800"><?=my_caption('rp_permission_title')?></h1>
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
			  <th width="20%">Role Name</th>
			  <th width="15%"><?=my_caption('global_actions')?></th>
			</tr>
          </thead>
          <tbody>
		    
		    <?php
		    foreach($role_data as $valrole)
		    {
		        if($valrole['id'] != '1'){
		    ?>
		     <tr>
		         <td><?=str_replace('_', ' ', $valrole['name'])?></td>
		         <td>
		             <a href="<?=base_url('globalfile/managespermission/' . $valrole['id'].'/'. $valrole['ids']);?>" class="btn btn-success btn-flat btn-sm"><i class="fa fa-edit"></i></a>
		         </td>
		     </tr>
		    <?php
		    } }
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