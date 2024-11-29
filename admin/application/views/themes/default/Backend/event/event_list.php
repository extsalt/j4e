<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$data['checkper'] = checkpermissions('5');    
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
        	  
        	  <h3 class="m-0 font-weight-bold text-primary"><?=my_caption('event_list_title')?></h3> 
        	</div>
            <div class="col-lg-8 text-right">
        	 <?php if($data['checkper']['create_per'] == '1'){?>
        	  <button type="button" class="btn btn-primary mr-2" onclick="window.location.href='<?=base_url('events/managesevent')?>'">Create Event</button>
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
			      <th style="width:10%!important;"><?=my_caption('event_image')?></th>
				  <th><?=my_caption('event_list_name')?></th>
				  <th><?=my_caption('event_list_catname')?></th>
				  <th style="width:12%!important;"><?=my_caption('event_fees')?></th>
				  <th style="width:18%!important;"><?=my_caption('creatby_data')?></th>
				  <th style="width:15%!important;"><?=my_caption('event_start')?></th>
				  <th style="width:15%!important;"><?=my_caption('event_end')?></th>
				  <th style="width:3%!important;">Publish Status</th>
				  <th style="width:3%!important;">Status</th>
				  <th class="no-sort" style="width:8%!important;"><?=my_caption('menu_actions')?></th>
			    </tr>
			  </thead>
			  <tbody>
			      <?php foreach($event_data as $key => $valevent){
			      $link = $valevent->event_id;
			      
			     
			      
			      ?>
			       <tr id="<?=$valevent->event_id;?>">
			           <td ><center><?= ($key + 1);?></center></td> 
			            <td ><img src="<?=base_url().'upload/events/'.$valevent->event_thumbnil;?>" style="height:100px;width:150px"/></td>
			           <td ><?=$valevent->event_title;?></td>
			           <td ><?=$valevent->event_cat_name;?></td>
			           
			           <td style="width:15%!important;"><span style="float: right;"><i class='fas fa-rupee-sign fa-fw fa-1x'></i> <?= number_format($valevent->event_fees,2);?></span></td>
			           <td style="width:15%!important;"><?=$valevent->full_name;?></td>
			           <td style="width:15%!important;"><?= substr($valevent->event_startdate,0,3);?><br><?= substr($valevent->event_startdate,4,12);?><br><?= substr($valevent->event_startdate,17,18);?></td>
			           <td style="width:15%!important;"><?= substr($valevent->event_enddate,0,3);?><br><?= substr($valevent->event_enddate,4,12);?><br><?= substr($valevent->event_enddate,17,18);?></td>
			           
			           <td>
			              <?php
			                  if($valevent->event_publish_status == '1') { echo "Published";} else { echo "Created";}
			               
			               ?>
			            
			             
			           </td>
			           <td>
			              <?php if($data['checkper']['edit_per'] == '1'){?>
			               <?php if($valevent->event_status == '1'){?>
			                   Active
				    	    
			                   
			               <?php } else {?>
			                  Inactive
				    	    
			               <?php } }
			               else 
			               {
			                  if($valevent->event_status == '1') { echo "Active";} else { echo "Inactive";}
			               }
			               ?>
			            
			             
			           </td>
			           
			           <td>
			              <div class="btn-group">
				    	    <?php if($valevent->event_status == '1'){?>
			                   <a href="<?=base_url('events/managesevent/'.$link)?>" class="btn btn-primary btn-flat btn-sm"><i class="fa fa-edit ui-sortable-handle"></i></a>
				    	    <?php } ?>
				    	    <a href="<?=base_url('events/managesdetail/'.$link)?>" class="btn btn-success btn-flat btn-sm"><i class="fa fa-eye ui-sortable-handle"></i></a><br>
				    	    <?php if($data['checkper']['edit_per'] == '1'){?>
    			               <?php if($valevent->event_status == '1'){?>
    			                   <a class="btn btn-warning " href="javascript:void(0)" onclick="actionQuery('Deactivate', 'Are you sure Deactive this Event?', '<?=base_url('events/updatestatus/'.$link.'/2')?>')">Deactivate</a>
    				    	    
    			                   
    			               <?php } else {?>
    			                  <a class="btn btn-danger " href="javascript:void(0)" onclick="actionQuery('Activate', 'Are you sure Active this Event?', '<?=base_url('events/updatestatus/'.$link.'/1')?>')">Activate</a>
    				    	    
    			               <?php } }
    			               else 
    			               {
    			                  if($valevent->event_status == '1') { echo "Active";} else { echo "Inactive";}
    			               }
    			               ?>
    			               
    			                <?php if($data['checkper']['edit_per'] == '1'){?>
    			               <?php   
    			               $beforedate = date('m/d/Y',strtotime("-1 days"));    
    			               if($valevent->event_publish_status == '2' && $valevent->event_date > ".'$beforedate'."){?>
    			                   <a class="btn btn-info mr-2" href="javascript:void(0)" onclick="actionQuery('Delete', 'Are you sure Published this Event?', '<?=base_url('events/updatepublishstatus/'.$link.'/1')?>')">Published</a>
    				    	    
    			                   
    			               <?php }  }
    			               
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