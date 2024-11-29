<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php my_load_view($this->setting->theme, 'header')?>
<div class="container-fluid">
  <h1 class="h3 mb-4 text-gray-800">Manage Package</h1>

  <div class="row">
    <div class="col-lg-8">
	  <?php my_load_view($this->setting->theme, 'Generic/show_flash_card');?>
	  <div class="card shadow mb-4">
	    <div class="card-header py-3">
		  <h6 class="m-0 font-weight-bold text-primary">Manage Package</h6>
        </div>
        <div class="card-body">
		  <?php
		    echo form_open(base_url('admin/manage_package_action/'), ['method'=>'POST']);
			$user_info = $this->db->where('id',$user_id)->get('user')->row();
                        $package_info = $this->db->get('packages')->result();
		  ?>
		  <div class="row form-group mb-4">
                      <input type="hidden" name="user_id" value="<?= $user_id ?>">
		    <div class="col-lg-12 mb-4">
			  <label> Current Membership</label>
                          <select class="form-control" name="current_membership" readonly>
                              <?php
                                if(!empty($package_info))
                                {
                                    foreach ($package_info as $val)
                                    {
                                        if($val->pack_id == $user_info->packages_id){
                            ?>
                              <option value="<?= $val->pack_id ?>"><?= $val->pack_name ?></option>
                            <?php  
                                        }
                                    }
                                }
                              ?>
                              
                          </select>
			</div>
                      <div class="col-lg-12 mb-4">
			  <label><span class="text-danger">*</span> New Membership</label>
                          <select class="form-control" name="new_membership" required="">
                              <option value="">Select</option>
                              <?php
                                if(!empty($package_info))
                                {
                                    foreach ($package_info as $val)
                                    {
                                        if($val->pack_id != $user_info->packages_id){
                            ?>
                              <option value="<?= $val->pack_id ?>"><?= $val->pack_name ?></option>
                            <?php  
                                        }
                                    }
                                }
                              ?>
                              
                          </select>
			</div>
                        <div class="col-lg-12">
			  <label><span class="text-danger">*</span> Start Date</label>
                          <input type="date" class="form-control" name="start_date" value="<?= date('Y-m-d') ?>" >
                        </div>
		  </div>
		  
		  
		  <hr>
		  <div class="row">
			
			<div class="col-lg-12 text-right">
			  <?php
			    $data = array(
				  'type' => 'submit',
				  'name' => 'btn_change',
				  'id' => 'btn_change',
				  'value' => my_caption('global_save_changes'),
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
