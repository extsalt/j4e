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
		  
		   <hr class="dotted">
		    <a class="btn btn-primary btn-block" href="<?=base_url('events/managesdetail/'.$event_ids)?>">Event Detail</a>
		   <hr class="dotted">
		    <a class="btn btn-light btn-block" href="<?=base_url('events/managesbooking/'.$event_ids)?>">Event Booked (<?= $ci->geteventtotalbook($event_ids);?>)</a>
		   <hr class="dotted">
		    <a class="btn btn-light btn-block" href="<?=base_url('events/managesratereview/'.$event_ids)?>">Event Review & Rate (<?= $ci->geteventtotalcomment($event_ids);?>)</a>
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
        	  <h6 class="m-0 font-weight-bold text-primary">View Event Detail</h6>
        	</div>
            <div class="col-lg-6 text-right">
        	  
        	  
            </div>
          </div>
		  
		  
		  
		  
        </div>
        <div class="card-body">
		  <div class="table-responsive">
		    <table id="sort" class="table table-bordered">
			  
			  <tbody>
			      <tr>
			          <td>Title</td>
			          <td>:</td>
			          <td><?=$event_data->event_title;?></td>
			      </tr>
			      <tr>
			          <td>Category</td>
			          <td>:</td>
			          <td><?=$event_data->event_cat_name;?></td>
			      </tr>
			      <tr>
			          <td>Description</td>
			          <td>:</td>
			          <td><?=$event_data->event_description;?></td>
			      </tr>
			      <tr> 
			          <td>Address</td>
			          <td>:</td>
			          <td><?=$event_data->event_address;?></td>
			      </tr>
			      <tr> 
			          <td>Member Fees</td>
			          <td>:</td>
			          <td><?=$event_data->event_fees;?></td>
			      </tr>
			      <tr> 
			          <td>Guest Fees</td>
			          <td>:</td>
			          <td><?=$event_data->event_guestfees;?></td>
			      </tr>
			      <tr> 
			          <td>Ticket Qty</td>
			          <td>:</td>
			          <td><?=$event_data->event_ticketqty;?></td>
			      </tr>
			      <tr> 
			          <td>Start Date & Time</td>
			          <td>:</td>
			          <td><?=$event_data->event_startdate;?></td>
			      </tr>
			      <tr> 
			          <td>End Date & Time</td>
			          <td>:</td>
			          <td><?=$event_data->event_enddate;?></td>
			      </tr>
			      <tr> 
			          <td>Event Image</td>
			          <td>:</td>
			          <td><img src="<?=base_url().'upload/events/'.$event_data->event_thumbnil;?>" style="width:300px;height:200px;"></td>
			      </tr>
			      
			  </tbody>
			  
			  
			</table>
          </div>
		</div>
      </div>
	</div> 
  </div>
</div>

<?php my_load_view($this->setting->theme, 'footer')?>