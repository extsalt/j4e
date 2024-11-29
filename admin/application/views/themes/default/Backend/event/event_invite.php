<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$ci=& get_instance();

if($event_types == '1')
{
    $pages = "View Internal Guest Invites Event List";
    $btn_1 = "primary";
    $btn_2 = "light";
}
else
{
    $pages = "View External Guest Invites Event List";
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
		    <a class="btn btn-light btn-block" href="<?=base_url('events/manageinvitestatus/'.$event_ids)?>">Guest Invite Approval (<?= $ci->geteventapproval($event_ids);?>)</a>
		   <hr class="dotted">
		   <hr class="dotted">
		    <a class="btn btn-<?=$btn_1;?> btn-block" href="<?=base_url('events/managesinvite/'.$event_ids.'/1')?>">Event Invited <br>(Internal User) (<?= $ci->geteventtotalinvite($event_ids,1);?>)</a>
		   <hr class="dotted">
		   <hr class="dotted">
		    <a class="btn btn-<?=$btn_2;?> btn-block" href="<?=base_url('events/managesinvite/'.$event_ids.'/2')?>">Event Invited <br>(External User) (<?= $ci->geteventtotalinvite($event_ids,2);?>)</a>
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
            <div class="col-lg-6 text-left">
        	  <h6 class="m-0 font-weight-bold text-primary"><?=$pages;?></h6>
        	</div>
            <div class="col-lg-6 text-right">
        	  
        	  
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
				  <th>To User Name</th>
				  <th>Mobile Number</th>
				  <th>Email</th>
				  <th>Company Name</th>
				  <th>Designation</th>
				  <th>Creat At</th>
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