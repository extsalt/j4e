<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$data['checkper'] = checkpermissions('28');    
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
  <div class="row">
    <div class="col-lg-4 text-left">
	  <h1 class="h3 mb-4 text-gray-800"><?=my_caption('reward_list_title')?></h1>
	</div>
    <div class="col-lg-8 text-right">
	 <?php if($data['checkper']['create_per'] == '1'){?>
	  <button type="button" class="btn btn-primary mr-2" onclick="window.location.href='<?=base_url('rewards/managesrewards')?>'"><?=my_caption('reward_new_button')?></button>
	 <?php } ?> 
    </div>
  </div>

  <div class="row">
    <div class="col-lg-12">
	  <?php my_load_view($this->setting->theme, 'Generic/show_flash_card');?>
	  <div class="card shadow mb-4">
	    <div class="card-header py-3">
		  <h6 class="m-0 font-weight-bold text-primary"><?=my_caption('reward_list_title')?></h6>
        </div>
        <div class="card-body">
		  <div class="table-responsive">
		    <table id="sort" class="table table-bordered">
			  <thead>
			    <tr>
			      <th>Sr No</th>  
				  <th><?=my_caption('reward_title')?></th>
				  <th><?=my_caption('reward_point')?></th>
				  <th><?=my_caption('reward_days')?></th>
				  <th><?=my_caption('menu_actions')?></th>
			    </tr>
			  </thead>
			  <tbody>
			      <?php foreach($info_data as $key => $valpack){
			      $link = $valpack->rewards_id;
			      ?>
			       <tr>
			           <td><?= ($key + 1);?></td>
			           <td><?=$valpack->rewards_title;?></td>
			           <td><?=$valpack->rewards_point;?></td>
			           <td><?=$valpack->rewards_days;?></td>
			           <td>
			              <div class="btn-group">
				    	    <?php if($data['checkper']['edit_per'] == '1'){?>
				    	      <a href="<?=base_url('rewards/managesrewards/'.$link)?>" class="btn btn-success btn-flat btn-sm"><i class="fa fa-edit mr-2"></i></a>
				    	    <?php } if($data['checkper']['delete_per'] == '1'){?>
				    	      <a href="javascript:void(0)" class="btn btn-danger btn-flat btn-sm" onclick="actionQuery('Delete', 'Are you sure delete this reward?', '<?=base_url('rewards/deletereward/'.$link)?>')"><i class="fa fa-trash mr-2"></i></a>
				    	    <?php } ?>
				    	    
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
