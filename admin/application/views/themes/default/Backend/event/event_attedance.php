<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$ci=& get_instance();
$formurl = base_url().'events/managesattadance/'.$event_ids;
?>
<?php
  my_load_view($this->setting->theme, 'header');
 
?>

    
    
 
<input type="hidden" id="user_ids" name="user_ids" value="<?=my_uri_segment(3)?>">
<div class="container-fluid">
  <div class="row">
    <div class="col-lg-4 text-left">
	  <h1 class="h3 mb-4 text-gray-800">Attendance Event List</h1>
	</div>
    <div class="col-lg-8 text-right">
	 
	   <button type="button" class="btn btn-primary mr-2" onclick="window.location.href='<?=base_url('events/managesbooking/'.$event_ids)?>'">Back to Event</button> 
	  
    </div>
  </div>

    <?php
		    
	    echo form_open_multipart($formurl, ['method'=>'POST']);
	 ?>
  <div class="row">
    <div class="col-lg-12">
	  <?php my_load_view($this->setting->theme, 'Generic/show_flash_card');?>
	  <div class="card shadow mb-4">
	    <div class="card-header py-3">
		  
		  <div class="row">
		    <div class="col-lg-4 text-left">
              <h6 class="m-0 font-weight-bold text-primary">Attendance Event List</h6>
            </div>
            <div class="col-lg-8 text-right">
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
			      <th rowspan="2">Sr No</th>  
				  <th rowspan="2">User Name</th>
				  <th rowspan="2">Amount</th>
				  <th rowspan="2">Company Name</th>
				  <th rowspan="2">Email</th>
				  <th rowspan="2">Phone Number</th>
				  <th rowspan="2">Booking At</th>
				  <th colspan="2">Attendance</th>
				  
			    </tr>
                <tr>
                  <th>Present</th>
				  <th>Absent</th>
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
			           <td ><?= $ci->getusername($valdata->booking_userid);?>
			           <input type="hidden" name="booking_id<?=$valdata->booking_id;?>" value="<?=$valdata->booking_id;?>" />
			           <input type="hidden" name="user_id<?=$valdata->booking_id;?>" value="<?=$valdata->booking_userid;?>" />
			           </td>  
			           <td><?= $valdata->booking_amount;?></td>
			           <td><?= $valdata->booking_cmpname;?></td>
			           <td><?= $valdata->booking_useremail;?></td>
			           <td><?= $valdata->booking_userphno;?></td>
			           <td><?= $valdata->booking_creatdate;?><br><?= $valdata->booking_creattime;?></td>
			           <td>
			               <input type="radio" id="<?=$key;?>" name="booking_status<?=$valdata->booking_id;?>" value="1" <?php if($valdata->bookin_attedance == '1'){echo "checked";} ?> >
			           </td>
			           <td>
			               <input type="radio" id="<?=$key;?>" name="booking_status<?=$valdata->booking_id;?>" value="2" <?php if($valdata->bookin_attedance == '2'){echo "checked";} ?> >
			           </td>
			       </tr>
			      <?php } ?>
			  </tbody>
			  
			  
			</table>
          </div>
		</div>
	
      </div>
      	<?php
		   echo form_submit($data);
		   echo form_close();
		?>
	</div>
  </div>
</div>
<?php my_load_view($this->setting->theme, 'footer')?>
<script>
// $(document).ready(function(){



 $('tbody').sortable({
  placeholder : "ui-state-highlight",
  update : function(event, ui)
  {
   var page_id_array = new Array();
   // alert($(this).attr('id'));
   $('tbody tr').each(function(){
    page_id_array.push($(this).attr('id'));
   });

   $.ajax({
    url:"<?php echo base_url('packages/reorderfeature'); ?>",
    method:"POST",
    data:{page_id_array:page_id_array},
    success:function(data)
    {
     // load_data();
     // alert(data);
    }
   })
  }
 });

// });
</script>