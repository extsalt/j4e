<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$ci=& get_instance();

if($event_types == '1')
{
    $pages = "View Guest Invite Pending Approval List";
    $btn_1 = "primary";
    $btn_2 = "light";
}
else
{
    $pages = "View Guest Invite Pending Approval List";
    $btn_1 = "light";
    $btn_2 = "primary";
}




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
		  
		   <hr class="dotted">
		    <a class="btn btn-light btn-block" href="<?=base_url('events/managesdetail/'.$event_ids)?>">Event Detail</a>
		   <hr class="dotted">
		    <a class="btn btn-light btn-block" href="<?=base_url('events/managesbooking/'.$event_ids)?>">Event Booked (<?= $ci->geteventtotalbook($event_ids);?>)</a>
		   <hr class="dotted">
		    <a class="btn btn-light btn-block" href="<?=base_url('events/managesratereview/'.$event_ids)?>">Event Review & Rate (<?= $ci->geteventtotalcomment($event_ids);?>)</a>
		   <hr class="dotted">
		   <hr class="dotted">
		    <a class="btn btn-primary btn-block" href="<?=base_url('events/manageinvitestatus/'.$event_ids)?>">Guest Invite Approval (<?= $ci->geteventapproval($event_ids);?>)</a>
		   <hr class="dotted">
		   <hr class="dotted">
		    <a class="btn btn-light btn-block" href="<?=base_url('events/managesinvite/'.$event_ids.'/1')?>">Event Invited <br>(Internal User) (<?= $ci->geteventtotalinvite($event_ids,1);?>)</a>
		   <hr class="dotted">
		   <hr class="dotted">
		    <a class="btn btn-light btn-block" href="<?=base_url('events/managesinvite/'.$event_ids.'/2')?>">Event Invited <br>(External User) (<?= $ci->geteventtotalinvite($event_ids,2);?>)</a>
		   <hr class="dotted">
		   <hr class="dotted">
		    <a class="btn btn-light btn-block" href="<?=base_url('events/managesattendingstatus/'.$event_ids.'/1')?>">Event Interested (<?= $ci->geteventtotalattend($event_ids,1);?>)</a>
		   <hr class="dotted">
		   <hr class="dotted">
		    <a class="btn btn-light btn-block" href="<?=base_url('events/managesattendingstatus/'.$event_ids.'/2')?>">Event Attending (<?= $ci->geteventtotalattend($event_ids,2);?>)</a>
		   <hr class="dotted">
		   <hr class="dotted">
		    <a class="btn btn-light btn-block" href="<?=base_url('events/managesattendingstatus/'.$event_ids.'/3')?>">Event Maybe (<?= $ci->geteventtotalattend($event_ids,3);?>)</a>
		   <hr class="dotted">
		  
		  
		</div>
      </div>
	</div>
	<div class="col-lg-9">
	     <div class="card shadow mb-4">
	    <div class="card-header py-3">
		  
		  <div class="row">
		    <div class="col-lg-8 text-left">
              <h6 class="m-0 font-weight-bold text-primary">Guest Invite Pending Approval List</h6>
            </div>
            <div class="col-lg-4 text-right">
               <?php
               $data = array(
				  'type' => 'submit',
				  'name' => 'btn_submit_block',
				  'id' => 'btn_submit_block',
				  'value' => 'Submit',
				  'class' => 'btn btn-primary mr-2'
			    );
               ?>
            </div>
		  </div>
		  
		  
        </div>
        <div class="card-body">
		  <div class="table-responsive">
		    <table id="sort" class="table table-bordered">
			  <thead>
			    <tr>
			      <th>Sr No</th>  
				  <th>By User Name</th>
				  <th>Guest User Name</th>
				  <th>Guest Mobile Number</th>
				  <th>Guest Email</th>
				  <th>Guest Company Name</th>
				  <th>Guest Designation</th>
				  
				  <th>Creat At</th>
				  <th>Action</th>
			    </tr>
			  </thead>
			  <tbody>
			      <?php foreach($info_data as $key=>$valdata){
			        $link = $valdata->event_invite_id;
			        
			       
			        
			      ?>
			       <tr>
			           <td ><?= ($key + 1);?></td>
			           <td ><?= $ci->getusername($valdata->event_invite_byuserid);?></td>  
			           <td><?= $valdata->username;?></td>
			           <td><?= $valdata->mobileno;?></td>
			           <td><?= $valdata->emails;?></td>
			           <td><?= $valdata->cmpname;?></td>
			           <td><?= $valdata->designations;?></td>
			           
			           <td><?= $valdata->event_invite_creatdate;?>, <?= $valdata->event_invite_creattime;?></td>
			           <td>
			               <div class="btn-group">
			                   <a class="btn btn-primary " href="<?=base_url('events/updateinvitestatus/'.$link.'/'.$event_ids);?>">Activate</a>
    				    	    
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