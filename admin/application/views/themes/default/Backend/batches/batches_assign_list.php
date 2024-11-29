<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$data['checkper'] = checkpermissions('32');    
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
		  <div class="row">
    
            <div class="col-lg-4 text-left">
              <h3 class="m-0 font-weight-bold text-primary">Badge Assign List</h3>        
        	  
        	</div>
            <div class="col-lg-8 text-right">
        	 <?php if($data['checkper']['create_per'] == '1'){?>
        	  <button type="button" class="btn btn-primary mr-2" onclick="window.location.href='<?=base_url('badge/managesassign')?>'">Badge Assign</button>
        	 <?php } ?> 
            </div>
          
    
   
  </div>
        </div>
        <div class="card-body">
		  <div class="table-responsive">
		    <table id="sort" class="table table-bordered exampletables">
			  <thead>
			    <tr>
			      <th class="no-sort" style="width:4%!important;"><?=my_caption('srno_data')?></th>   
			      <th>Usre Name</th>
				  <th>Badge For</th>
				  <th class="no-sort" style="width:8%!important;"><?=my_caption('menu_actions')?></th>
			    </tr>
			  </thead>
			  <tbody>
			      <?php foreach($info_data as $key => $valdata){
			      $link = $valdata->assign_id;
			      $ci=& get_instance();
			      ?>
			       <tr id="<?=$valdata->assign_id;?>">
			           <td ><center><?= ($key + 1);?></center></td>
			           <td ><?= $ci->getusername($valdata->assign_userid);?></td>
			           <td ><?= $valdata->badge_title;?></td>
			           
			           <td> 
			              <?php if($data['checkper']['edit_per'] == '1'){?>
			               <div class="btn-group">
				    	    <a class="btn btn-danger btn-flat btn-sm" href="javascript:void(0)" onclick="actionQuery('Delete', 'Are you sure delete this Badge?', '<?=base_url('badge/deletebadgeassign/'.$link)?>')"><i class="fa fa-trash  mr-2"></i></a>
						   </div>
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