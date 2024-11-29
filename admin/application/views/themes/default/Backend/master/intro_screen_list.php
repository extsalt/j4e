<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$data['checkper'] = checkpermissions('35');    
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
        	  <h3 class="m-0 font-weight-bold text-primary">Intro Screen</h3>
        	</div>
            <div class="col-lg-8 text-right">
        	 
        	  <button type="button" class="btn btn-primary mr-2" onclick="window.location.href='<?=base_url('intro_screen/managesintroscreen')?>'">Add Intro Screen</button>
        	  
            </div>
          </div>
		  
		  
		  
        </div>
        <div class="card-body">
		  <div class="table-responsive">
		    <table id="sort" class="table table-bordered exampletables">
			  <thead>
			    <tr>
			      <th class="no-sort" style="width:4%!important;"><?=my_caption('srno_data')?></th> 
				  <th>Title</th>
				   <th>Description</th>
				  <th class="no-sort" style="width:8%!important;"><?=my_caption('menu_actions')?></th>
			    </tr>
			  </thead>
			  <tbody>
			      <?php foreach($info_data as $key => $valdata){
			      $link = $valdata->screen_id;
			      
			      
			      
			      ?>
			       <tr id="<?=$valdata->screen_id;?>">
			           <td ><center><?= ($key + 1);?></center></td>
			           <td ><?=$valdata->screen_title;?></td>
			           
			           <td>
			                <?= $valdata->screen_desc ?>
			           </td>
			           
			           <td>
			             <?php if($data['checkper']['edit_per'] == '1'){?>   
			              <div class="btn-group">
				    	    
				    	    <?php if($data['checkper']['edit_per'] == '1'){?>  
                                          <a href="<?=base_url('intro_screen/managesintroscreen/'.$link)?>" class="btn btn-success btn-flat btn-sm"><i class="fa fa-edit ui-sortable-handle"></i></a>
                                           <a class="btn btn-danger" href="javascript:void(0)" onclick="actionQuery('Delete', 'Are you sure delete this?', '<?=base_url('intro_screen/deleteintro_screen/'.$link)?>')"><i class="fa fa-trash"></i></a>
			               <?php }
			               
			               ?>
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