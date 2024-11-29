<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php
  my_load_view($this->setting->theme, 'header');
 
?>

    
    
 
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
		  <div class="row">
            <div class="col-lg-10 text-left">
        	  <h3 class="m-0 font-weight-bold text-primary">J4E Rate & Review List</h3>
        	</div>
            
          </div>
        </div>
        <div class="card-body">
		  <div class="table-responsive">
		    <table id="sort" class="table table-bordered exampletables">
			  <thead>
			    <tr>
			      <th class="no-sort" style="width:4%!important;"><?=my_caption('srno_data')?></th>  
			      <th style="width:20%!important;">Full Name (Username)</th>
				  <th style="width:5%!important;">Rating</th>
				  <th >Review</th>
				  <th style="width:12%!important;"><?=my_caption('creatat_data')?></th>
				  <th style="width:3%!important;">Status</th>
				  <th class="no-sort" style="width:8%!important;"><?=my_caption('menu_actions')?></th>
			    </tr>
			  </thead>
			  <tbody>
			      <?php foreach($info_data as $key => $valdata){
			      $link = $valdata->id;
			      
			     
			      
			      ?>
			       <tr id="<?=$valdata->id;?>">
			           <td ><center><?= ($key + 1);?></center></td> 
			            
			           <td ><?= ucwords($valdata->full_name);?></td>
			           <td ><center><?=$valdata->ratings;?></center></td>
			           <td ><?php if($valdata->review_note != ''){ echo ucwords($valdata->review_note); } else { echo "N/A"; };?></td>
			           
			           <td ><?=$valdata->review_date .'<br>'.$valdata->review_time;?></td>
			           <td>
			               <?php if($valdata->status == '1'){?>
			                   Active
				    	    
			                   
			               <?php } else {?>
			                  Inactive
				    	    
			               <?php } ?>
			           </td>
			           <td>
			               <?php if($valdata->status == '1'){?>
			                   <a class="btn btn-warning mr-2" href="javascript:void(0)" onclick="actionQuery('Deactivate', 'Are you sure Deactive this J4E Review and Rate?', '<?=base_url('rating_review/updatestatus/'.$link.'/2')?>')">Deactivate</a>
				    	    
			                   
			               <?php } else {?>
			                  <a class="btn btn-danger mr-2" href="javascript:void(0)" onclick="actionQuery('Activate', 'Are you sure Active this J4E Review and Rate?', '<?=base_url('rating_review/updatestatus/'.$link.'/1')?>')">Activate</a>
				    	    
			               <?php } ?>
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