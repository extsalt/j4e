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
  <?php
  my_load_view($this->setting->theme, 'breadcum');
 
?>

  <div class="row">
    <div class="col-lg-12">
	  <?php my_load_view($this->setting->theme, 'Generic/show_flash_card');?>
	  <div class="card shadow mb-4">
	    <div class="card-header py-3">
		  <h3 class="m-0 font-weight-bold text-primary"><?=my_caption('user_list_title')?></h3>
        </div>
        <div class="card-body">
		  <div class="table-responsive">
		    <!--<table id="dataTable_list_user" class="table table-bordered">-->
		    <table id="sort" class="table table-bordered exampletables">
			  <thead>
			    <tr>
			      <th class="no-sort" style="width:4%!important;"><?=my_caption('srno_data')?></th> 
				  <th style="width:20%!important;"><?=my_caption('user_sheet_fullname')?></th>
				  <th>Email</th>
				  <th>Phone Number</th>
				  <th>Membership Type</th>
				  <th>Since</th>
				  
				  <th class="no-sort" style="width:8%!important;"><?=my_caption('menu_actions')?></th>
			    </tr>
			  </thead>
			  <tbody>
			      <?php foreach($info_user as $key => $valusers){
			      $link = $valusers->id;
			      if($valusers->membership_type == '1')
			      {
			          $membership = 'Guest';
			      }
			      else
			      {
			         $membership = 'Paid'; 
			      }
			      
			      $creatat = substr($valusers->created_time, 0,10);
			      $flag = 1;
                              $check1 = $this->db->where('assign_userid',$link)->get('badge_assign')->result();
                              $check2 = $this->db->where('user_id',$link)->or_where('buddy_id',$link)->get('buddies')->result();
                              $check3 = $this->db->where('buddy_meet_touserid',$link)->or_where('buddy_meet_withuserid',$link)->get('buddy_meet')->result();
                              $check4 = $this->db->where('bns_trans_touser',$link)->or_where('bns_trans_byuser',$link)->get('business_transaction')->result();
                              $check5 = $this->db->where('request_to',$link)->or_where('request_from',$link)->get('connection')->result();
                              $check6 = $this->db->where('attend_userid',$link)->get('event_attending_status')->result();
                              $check7 = $this->db->where('user_id',$link)->get('event_booking')->result();
                              $check8 = $this->db->where('event_invite_byuserid',$link)->or_where('event_invite_touserid',$link)->get('event_invite')->result();
                              $check9 = $this->db->where('user_id',$link)->get('event_ratings_reviews')->result();
                              $check10 = $this->db->where('followup_byuserid',$link)->or_where('followup_touserid',$link)->get('followup')->result();
                              $check11 = $this->db->where('userid',$link)->get('j4e_ratings_reviews')->result();
                              $check12 = $this->db->where('by_user_ids',$link)->or_where('to_user_ids',$link)->get('notification')->result();
                              $check13 = $this->db->where('lead_touser',$link)->or_where('lead_byuser',$link)->get('offline_lead')->result();
                              $check14 = $this->db->where('post_userid',$link)->get('postdetail')->result();
                              $check15 = $this->db->where('post_cmt_userid',$link)->get('post_comment')->result();
                              $check16 = $this->db->where('post_like_dislike_userid',$link)->get('post_like_dislike')->result();
                              $check17 = $this->db->where('user_id',$link)->get('ratings_reviews')->result();
                              $check18 = $this->db->where('recognition_userid',$link)->get('recognition')->result();
                              $check19 = $this->db->where('userid',$link)->or_where('recomend_by',$link)->get('recomendation')->result();
                              $check20 = $this->db->where('user_id',$link)->get('requirements')->result();
                              $check21 = $this->db->where('req_user_status_userid',$link)->or_where('req_user_status_addedby',$link)->get('requirements_user_status')->result();
                              $check22 = $this->db->where('userid',$link)->get('reward_user_point')->result();
                              $check23 = $this->db->where('userid',$link)->get('users_group')->result();
                              $check24 = $this->db->where('reward_userdid',$link)->get('user_reward')->result();
                              $check25 = $this->db->where("FIND_IN_SET( '$link' , event_permission) ")->get('events')->result();
                              if(!empty($check1)||!empty($check2)||!empty($check3)||!empty($check4)||!empty($check5)||!empty($check6)||!empty($check7)||!empty($check8)||!empty($check9)||!empty($check10)||!empty($check11)||!empty($check12)||!empty($check13)||!empty($check14)||!empty($check15)||!empty($check16)||!empty($check17)||!empty($check18)||!empty($check19)||!empty($check20)||!empty($check21)||!empty($check22)||!empty($check23)||!empty($check24)||!empty($check25))
                              {
                                  $flag = 0;
                              }
			      ?>
			         <tr>
			             <td><center><?=$key+1;?></center></td>
			             <td><?=$valusers->full_name;?></td>
			             <td><?=$valusers->email_address;?></td>
			             <td><?=$valusers->phone;?></td>
			             <td><?=$membership;?></td>
			             <td><?=date('M y', strtotime($creatat));?></td>
			            <td>
			              <div class="btn-group">
				    	    <?php
	    if(empty($valusers->firebase_uid)){
	  ?>
	  <!--<a class="btn btn-sm btn-info" style="color:#fff;" href="<?= base_url('admin/firebase_registration1/'.$valusers->id) ?>"><i class="fa fa-cloud" data-toggle="tooltip" title="Firebase Registration"></i></a>-->
	  <?php } ?>
                                          <a href="<?=base_url('users/managesdetail/'.$link)?>" class="btn btn-success btn-flat btn-sm" title="View Details"><i class="fa fa-eye ui-sortable-handle"></i></a>
				    	    <?php //if($data['checkper']['edit_per'] == '1'){?>
                                            <a href="<?=base_url('users/managespackage/'.$link)?>" class="btn btn-info btn-flat btn-sm" title="Change Mambership"><i class="fa fa-edit mr-2"></i></a>
				    	    <?php //} ?>
                                            <?php if($valusers->user_delete == '1'){?>
			                   <a class="btn btn-warning " href="javascript:void(0)" onclick="actionQuery('Deactivate', 'Are you sure Deactive this User?', '<?=base_url('admin/updatestatus/'.$link.'/2')?>')">Deactivate</a>
				    	    
			                   
			               <?php } else {?>
			                  <a class="btn btn-danger " href="javascript:void(0)" onclick="actionQuery('Activate', 'Are you sure Active this User?', '<?=base_url('admin/updatestatus/'.$link.'/1')?>')">Activate</a>
				    	    
			               <?php }?>
                                          <?php if($flag == 1){?>
                                          <a href="javascript:void(0)" class="btn btn-danger btn-flat btn-sm" onclick="actionQuery('Delete', 'Are you sure delete this User?', '<?=base_url('admin/remove_member/'.$link)?>')"><i class="fa fa-trash" data-toggle="tooltip" title="Delete"></i></a>
					<?php } ?>	 
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
