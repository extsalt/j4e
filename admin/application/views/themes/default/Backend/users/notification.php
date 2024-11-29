<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php
  my_load_view($this->setting->theme, 'header');
 
?>

    
    
 
<input type="hidden" id="user_ids" name="user_ids" value="<?=my_uri_segment(3)?>">
<div class="container-fluid">
  <div class="row">
    <div class="col-lg-4 text-left">
	  <h1 class="h3 mb-4 text-gray-800">Notification List</h1>
	</div>
   <div class="col-lg-8 text-right">
	 
	  <button type="button" class="btn btn-primary mr-2" onclick="window.location.href='<?=base_url('users/notifications')?>'">Add Notification</button>
	  
    </div>
  </div>

  <div class="row">
    <div class="col-lg-12">
	  <?php my_load_view($this->setting->theme, 'Generic/show_flash_card');?>
	  <div class="card shadow mb-4">
	    <div class="card-header py-3">
		  <h6 class="m-0 font-weight-bold text-primary">Notification List</h6>
        </div>
        <div class="card-body">
		  <div class="table-responsive">
		    <table id="sort" class="table table-bordered exampletables">
			  <thead>
			    <tr>
			      <th>Sr No</th>  
			      <th>Request For</th>
			      <th>Title</th>
			      <th>From User</th>
			      <th>To User</th>
			      <th>Creat At</th>
			    </tr>
			  </thead>
			  <tbody>
			      <?php foreach($info_data as $key => $valdata){
			      $link = $valdata->id;
			      $ci=& get_instance();
			     
			      
			      ?>
			       <tr id="<?=$valdata->id;?>">
			           <td ><?= ($key + 1);?></td>
			           <td><?=$valdata->request_for;?></td>
			           <td><?=$valdata->subject;?></td>
			           <td ><?= $ci->getusername($valdata->by_user_ids);?></td>
			           <td ><?= $ci->getusername($valdata->to_user_ids);?></td>
			           <td><?= date("d M Y", strtotime(substr($valdata->created_time,0,10)));?></td>
			           
			           
			          
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