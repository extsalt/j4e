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
		  <h3 class="m-0 font-weight-bold text-primary"><?=my_caption('offline_list_title')?></h3>
		  
        </div>
        <div class="card-body">
		  <div class="table-responsive">
		    <table id="sort" class="table table-bordered exampletables">
			  <thead>
			    <tr>
			      <th class="no-sort" style="width:4%!important;"><?=my_caption('srno_data')?></th>     
			      <th><?=my_caption('offlinelead_type')?></th>
			      <th style="width:15%!important;"><?=my_caption('offlinelead_title')?></th>
			      <th style="width:20%!important;"><?=my_caption('offlinelead_to_name')?></th>
				  <th style="width:20%!important;"><?=my_caption('offlinelead_from_name')?></th>
				  <th style="width:12%!important;"><?=my_caption('offlinelead_amount')?></th>
				  <th style="width:15%!important;"><?=my_caption('offlinelead_remark')?></th>
				  <th style="width:12%!important;"><?=my_caption('creatat_data')?></th>
			    </tr>
			  </thead>
			  <tbody>
			      <?php foreach($info_data as $key => $valdata){
			      $link = $valdata->lead_id;
			      $ci=& get_instance();
			     
			      
			      ?>
			       <tr id="<?=$valdata->lead_id;?>">
			           <td ><center><?= ($key + 1);?></center></td> 
			           <td ><?=$valdata->lead_type;?></td>
			           <td ><?= ucwords($valdata->lead_title);?></td>
			           <td ><?= ucwords($ci->getusername($valdata->lead_touser))?></td>
			           <td ><?= ucwords($ci->getusername($valdata->lead_byuser))?></td>
			           <td ><span style="float: right;"><i class='fas fa-rupee-sign fa-fw fa-1x'></i> <?= number_format($valdata->lead_amount,2);?></span></td>
			           <td ><?= ucwords($valdata->lead_remark);?></td>
			           <td ><?=$valdata->lead_date;?></td>
			           
			           
			           <!--<td>
			               <div class="btn-group" role="group">
			                   <button id="btnGroupDrop" type="button" class="btn btn-light btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-h text-gray-500"></i></button>
			                   <div class="dropdown-menu" aria-labelledby="btnGroupDrop" style="">
			                       <a class="dropdown-item" href="<?=base_url('packages/managesfeature/'.$link)?>"><i class="fa fa-edit text-gray-500 mr-2"></i> Edit</a>
			                       <a class="dropdown-item" href="javascript:void(0)" onclick="actionQuery('Delete', 'Are you sure delete this features?', '<?=base_url('packages/deletefeature/'.$link)?>')"><i class="fa fa-trash text-gray-500 mr-2"></i> Delete</a>
			                   </div>
			               </div>
			           </td>-->
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