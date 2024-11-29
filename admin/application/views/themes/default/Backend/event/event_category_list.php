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
            <div class="col-lg-4 text-left">
                <h3 class="m-0 font-weight-bold text-primary"><?=my_caption('event_cat_list_title')?></h3>
        	  
        	</div>
            <div class="col-lg-8 text-right">
        	 
        	  <button type="button" class="btn btn-primary mr-2" onclick="window.location.href='<?=base_url('events/managescategory')?>'">New Category</button>
        	  
            </div>
          </div>
        </div>
        <div class="card-body">
		  <div class="table-responsive">
		    <table id="sort" class="table table-bordered exampletables">
			  <thead>
			    <tr>
			      <th class="no-sort" style="width:4%!important;"><?=my_caption('srno_data')?></th>    
			      <th><?=my_caption('event_cat_name')?></th>
			      <th style="width:15%!important;">Is J4E Meet</th>
				  <th class="no-sort" style="width:8%!important;"><?=my_caption('menu_actions')?></th>
				  
			    </tr>
			  </thead>
			  <tbody>
			      <?php foreach($info_data as $key => $valdata){
			      $link = $valdata->event_cat_id;
			      
			     
			      
			      ?>
			       <tr id="<?=$valdata->event_cat_id;?>">
			           <td ><center><?= ($key + 1);?></center></td> 
			           <td ><?=$valdata->event_cat_name;?></td>
			           <td ><?php if($valdata->event_j4e_meet == '1'){ echo "YES"; }else{ echo "NO"; };?></td>
			            
			           <td>
			               <div class="btn-group" role="group">
			                   
			                   
			                       <a class="btn btn-success" href="<?=base_url('events/managescategory/'.$link)?>"><i class="fa fa-edit"></i></a>
			                       <a class="btn btn-danger" href="javascript:void(0)" onclick="actionQuery('Delete', 'Are you sure delete this Category?', '<?=base_url('events/deletecategory/'.$link)?>')"><i class="fa fa-trash"></i></a>
			                   
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