<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$ci=& get_instance();

$data['checkper'] = checkpermissions('5');    
if($data['checkper']['view_per'] == '2')
{
   redirect(base_url('dashboard'));
   exit();
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
		    <a class="btn btn-primary btn-block" href="<?=base_url('events/managesbooking/'.$event_ids)?>">Event Booked (<?= $ci->geteventtotalbook($event_ids);?>)</a>
		   <hr class="dotted">
		    <a class="btn btn-light btn-block" href="<?=base_url('events/managesratereview/'.$event_ids)?>">Event Review & Rate (<?= $ci->geteventtotalcomment($event_ids);?>)</a>
		   <hr class="dotted">
		   <hr class="dotted">
		    <a class="btn btn-light btn-block" href="<?=base_url('events/manageinvitestatus/'.$event_ids)?>">Guest Invite Approval (<?= $ci->geteventapproval($event_ids);?>)</a>
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
            <div class="col-lg-6 text-left">
        	  <h6 class="m-0 font-weight-bold text-primary">View Event Booking List</h6>
        	</div>
            <div class="col-lg-6 text-right">
        	  <?php if($data['checkper']['edit_per'] == '1'){?>
        	    <button type="button" class="btn btn-success mr-2" onclick="window.location.href='<?=base_url('events/managesattedance/'.$event_ids)?>'">Attendance Mark</button>
	          <?php } ?>
	        </div>
          </div>
		  
		  
		  
		  
        </div>
        <div class="card-body">
		  <div class="table-responsive">
		    <table id="sort" class="table table-bordered">
			  <thead>
			    <tr>
			      <th>Sr No</th>  
				  <th>User Name</th>
				  <th>Amount</th>
				  <th>Company Name</th>
				  <th>Email</th>
				  <th>Phone Number</th>
				  <th>Booking At</th>
				  <th>Attendance</th>
			    </tr>
			  </thead>
			  <tbody>
			      <?php foreach($info_data as $key=>$valdata){
			        $link = $valdata->booking_id;
			        
			        if($valdata->bookin_attedance == '1')
			        {
			           $status_attens = "Present"; 
			        }
			        elseif($valdata->bookin_attedance == '2')
			        {
			           $status_attens = "Absent";  
			        }
			        else
			        {
			           $status_attens = "";  
			        }
			        
			        
			      ?>
			       <tr>
			           <td ><?= ($key + 1);?></td>
			           <td ><?= $ci->getusername($valdata->booking_userid);?></td>  
			           <td><?= $valdata->booking_amount;?></td>
			           <td><?= $valdata->booking_cmpname;?></td>
			           <td><?= $valdata->booking_useremail;?></td>
			           <td><?= $valdata->booking_userphno;?></td>
			           <td><?= $valdata->booking_creatdate;?><br><?= $valdata->booking_creattime;?></td>
			           
			           <td><?=$status_attens;?></td>
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