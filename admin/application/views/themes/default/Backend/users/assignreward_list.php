<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$ci=& get_instance();
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
        	  <h3 class="m-0 font-weight-bold text-primary"><?=my_caption('reward_list_title')?></h3>
        	</div>
            <div class="col-lg-8 text-right">
        	 
        	  <button type="button" class="btn btn-primary mr-2" onclick="window.location.href='<?=base_url('users/manageassignreward')?>'"><?=my_caption('rewards_new_button')?></button>
        	  
            </div>
          </div>
		 
        </div>
        <div class="card-body">
		  <div class="table-responsive">
		    <table id="sort" class="table table-bordered exampletables">
			  <thead>
			    <tr>
			      <th>Sr No</th>  
				  <th><?=my_caption('rewards_title')?></th>
				  <th><?=my_caption('rewards_username')?></th>
				  <th><?=my_caption('rewards_startdate')?></th>
				  <th><?=my_caption('rewards_enddate')?></th>
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
			           <td ><?= $ci->getusername($valpack->reward_userdid);?></td>
			           <td><?=$valpack->reward_startdate;?></td>
			           <td><?=$valpack->reward_enddate;?></td>
			           
			           <td>
			              
			              
			              <div class="btn-group">
				    	    <a href="<?=base_url('rewards/managesrewards/'.$link)?>" class="btn btn-success btn-flat btn-sm"><i class="fa fa-edit ui-sortable-handle"></i></a>
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
