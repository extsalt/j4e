<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$data['checkper'] = checkpermissions('3');    
if($data['checkper']['view_per'] == '2')
{
   redirect(base_url('dashboard'));
   exit();
}

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
		  <h3 class="m-0 font-weight-bold text-primary"><?=my_caption('post_list_title')?></h3>
		  
        </div>
        <div class="card-body">
		  <div class="table-responsive">
		    <table id="sort" class="table table-bordered exampletables">
			  <thead>
			    <tr>
			      <th class="no-sort" style="width:4%!important;"><?=my_caption('srno_data')?></th>   
			      <th style="width:10%!important;"><?=my_caption('post_image')?></th>
				  <th style=""><?=my_caption('post_list_name')?></th>
				  <th style="width:18%!important;"><?=my_caption('creatby_data')?></th>
				  <th style="width:12%!important;"><?=my_caption('creatat_data')?></th>
				  <th style="width:3%!important;">Status</th>
				  <th class="no-sort" style="width:8%!important;"><?=my_caption('menu_actions')?></th>
			    </tr>
			  </thead>
			  <tbody>
			      <?php foreach($req_data as $key => $valpack){
			      $link = $valpack->post_id;
			      
			     
			      
			      ?>
			       <tr id="<?=$valpack->post_id;?>">
			           <td ><?= ($key + 1);?></td> 
			            <td ><?php if($valpack->post_image == ''){?> <img src="<?=base_url().'upload/no_image.jpg'?>" style="height:100px;width:100%"/> <?php } else {?><img src="<?=base_url().'upload/post/'.$valpack->post_image;?>" style="height:100px;width:100%"/><?php } ?></td>
			           <td ><?=substr($valpack->post_description, 0, 200)?>....    <!--<?=$valpack->post_description;?>--></td>
			           <td ><?=$valpack->full_name;?></td>
			           <td ><?=$valpack->post_date .'<br>'.$valpack->post_time;?></td>
			           
			           <td>
			              
			             <?php
			                  if($valpack->post_status == '1') { echo "Active";} else { echo "Inactive";}
			               
			               ?>
			               
			               
			           </td>
			           
			           
			           <td>
			              <div class="btn-group">
				    	    
				    	    <a href="<?=base_url('post/managesdetail/'.$link)?>" class="btn btn-success btn-flat btn-sm"><i class="fa fa-eye ui-sortable-handle"></i></a>
				    	   
				    	    <?php if($data['checkper']['edit_per'] == '1'){?>

			               <?php if($valpack->post_status == '1'){?>
			                   <a class="btn btn-warning mr-2" href="javascript:void(0)" onclick="actionQuery('Deactivate', 'Are you sure Deactive this Post?', '<?=base_url('post/updatestatus/'.$link.'/2')?>')">Deactivate</a>
				    	    
			                   
			               <?php } else {?>
			                  <a class="btn btn-danger mr-2" href="javascript:void(0)" onclick="actionQuery('Activate', 'Are you sure Active this Post?', '<?=base_url('post/updatestatus/'.$link.'/1')?>')">Activate</a>
				    	    
			               <?php } }
			               else 
			               {
			                  if($valpack->post_status == '1') { echo "Active";} else { echo "Inactive";}
			               }
			               ?>
				    	    
				    	    
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