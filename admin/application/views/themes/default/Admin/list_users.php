<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php
  my_load_view($this->setting->theme, 'header');
  $caption_list_user = my_caption('global_are_you_sure') . '||';
  $caption_list_user .= my_caption('user_impersonate_confirm') . '||';
  $caption_list_user .= my_caption('user_sheet_signin');
?>
<input type="hidden" id="caption_list_user" name="caption_list_user" value="<?=my_esc_html($caption_list_user)?>">
<input type="hidden" id="user_ids" name="user_ids" value="<?=my_uri_segment(3)?>">
<div class="container-fluid">
  <div class="row">
    <div class="col-lg-4 text-left">
	  <h1 class="h3 mb-4 text-gray-800"><?=my_caption('user_list_title')?></h1>
	</div>
    <div class="col-lg-8 text-right">
	  
	  <button type="button" class="btn btn-primary mr-2" onclick="window.location.href='<?=base_url('admin/new_user')?>'"><?=my_caption('user_list_new_user')?></button>
	  <!--
	  <button type="button" class="btn btn-info mr-2" onclick="window.location.href='<?=base_url('admin/invite_user')?>'"><?=my_caption('user_list_invite_user')?></button>
	  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?=my_caption('global_toggle')?></button>
      <div class="dropdown-menu animated--fade-in" aria-labelledby="dropdownMenuButton">
	    <a class="dropdown-item" href="<?=base_url('admin/list_user')?>"><?=my_caption('user_sheet_all_users')?></a>
		<a class="dropdown-item" href="<?=base_url('admin/list_user/active')?>"><?=my_caption('user_sheet_active_users')?></a>
		<a class="dropdown-item" href="<?=base_url('admin/list_user/today')?>"><?=my_caption('user_sheet_signup_today')?></a>
		<a class="dropdown-item" href="<?=base_url('admin/list_user/pending')?>"><?=my_caption('user_sheet_pending_users')?></a>
		<a class="dropdown-item" href="<?=base_url('admin/list_user/deactived')?>"><?=my_caption('user_sheet_deactivated_users')?></a>
	  </div>
	  -->
    </div>
  </div>

  <div class="row">
    <div class="col-lg-12">
	  <?php my_load_view($this->setting->theme, 'Generic/show_flash_card');?>
	  <div class="card shadow mb-4">
	    <div class="card-header py-3">
		  <h6 class="m-0 font-weight-bold text-primary"><?=my_caption('user_list_title')?></h6>
        </div>
        <div class="card-body">
		  <div class="table-responsive">
		    <table id="" class="table table-bordered exampletables">
			  <thead>
			    <tr>
			      <th>#</th>  
			      <th><?=my_caption('user_sheet_fullname')?></th>
			      <th><?=my_caption('rp_role_name')?></th>
			      <!--<th><?=my_caption('global_username')?></th>-->
			      <th><?=my_caption('user_sheet_email_address')?></th>
				  <th><?=my_caption('user_sheet_status')?></th>
				  <th><?=my_caption('user_sheet_created_date')?></th>
				  <th><?=my_caption('global_actions')?></th>
			    </tr>
			  </thead>
			  <tbody>
			      <?php foreach($info_user as $key => $valuser){
			      $link = $valuser->ids;
			      ?>
			        <tr>
			            <td><?=($key+'1');?></td>
			            <td><?=$valuser->first_name;?>&nbsp;<?=$valuser->last_name;?></td>
			            <td><?=str_replace('_', ' ', $this->Global_model->getrolename($valuser->role_ids))?></td>
			            <!--<td><?=$valuser->username;?></td>-->
			            <td><?=$valuser->email_address;?></td>
			            <td>
			                <?php if($valuser->status == '1'){?>
			                <span class="badge badge-success">Active</span>
			                <?php } else {?>
			                <span class="badge badge-danger">Inactive</span>
			                <?php } ?>
			            </td>
			            <td><?=$valuser->created_time;?></td>
			            <td>
			              <div class="btn-group">
			                  <?php
	    if(empty($valuser->firebase_uid)){
	  ?>
	  <!--<a class="btn btn-sm btn-info" style="color:#fff;" href="<?= base_url('admin/firebase_registration/'.$valuser->id) ?>"><i class="fa fa-cloud" data-toggle="tooltip" title="Firebase Registration"></i></a>-->
	  <?php } ?>
            			    <?php if($this->Global_model->getrolename($valuser->role_ids) != 'Super_Admin'){?>
            			    <a href="<?=base_url('admin/edit_user/'.$link)?>" class="btn btn-success btn-flat btn-sm"><i class="fa fa-edit" data-toggle="tooltip" title="Edit"></i></a>
            			    <!--<a href="<?=base_url('admin/signin_as_user/'.$link)?>" class="btn btn-primary btn-flat btn-sm"><i class="fa fa-sign-in-alt" data-toggle="tooltip" title=" Impersonation"></i></a>-->
            			    <a href="javascript:void(0)" class="btn btn-danger btn-flat btn-sm" onclick="actionQuery('Delete', 'Are you sure delete this Users?', '<?=base_url('admin/remove_user/'.$link)?>')"><i class="fa fa-trash" data-toggle="tooltip" title="Delete"></i></a>
            			    <?php }?>
            			  </div>
			            </td>
			        </tr>
			      <?php } ?>
			  </tbody>
			  
			  
			</table>
          </div>
		</div>
      </div>
	</div>
  </div>
</div>
<?php my_load_view($this->setting->theme, 'footer')?>
