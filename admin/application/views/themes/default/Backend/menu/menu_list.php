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
	  <h1 class="h3 mb-4 text-gray-800"><?=my_caption('menu_list_title')?></h1>
	</div>
    <div class="col-lg-8 text-right">
	 
	  <button type="button" class="btn btn-primary mr-2" onclick="window.location.href='<?=base_url('Globalfile/managesmenu')?>'"><?=my_caption('menu_list_new_menu')?></button>
	  
    </div>
  </div>

  <div class="row">
    <div class="col-lg-12">
	  <?php my_load_view($this->setting->theme, 'Generic/show_flash_card');?>
	  <div class="card shadow mb-4">
	    <div class="card-header py-3">
		  <h6 class="m-0 font-weight-bold text-primary"><?=my_caption('menu_list_title')?></h6>
        </div>
        <div class="card-body">
		  <div class="table-responsive">
		    <table id="" class="table table-bordered">
			  <thead>
			    <tr>
				  <th><?=my_caption('menu_name')?></th>
				  <th><?=my_caption('parent_menu_name')?></th>
				  <th><?=my_caption('menu_link')?></th>
				  <th><?=my_caption('menu_actions')?></th>
			    </tr>
			  </thead>
			  <tbody>
			      <?php foreach($menu_data as $valmenu){?>
			       <tr>
			           <td><?=$valmenu['menu_name'];?></td>
			           <?php if($valmenu['menu_parent'] == '0'){ echo "<td>--</td>";}
			                 else { $get_menuname = $this->db->get_where('menu',array('menu_id'=>$valmenu['menu_parent']))->row_array();?>
			           <td><?=$get_menuname['menu_name'];?></td>
			           <?php } ?>
			           <td><?=$valmenu['menu_link'];?></td>
			           <td>
			               <div class="btn-group" role="group">
			                   <button id="btnGroupDrop" type="button" class="btn btn-light btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-h text-gray-500"></i></button>
			                   <div class="dropdown-menu" aria-labelledby="btnGroupDrop" style="">
			                       <a class="dropdown-item" href="<?=base_url('Globalfile/managesmenu/'.$valmenu['ids'])?>"><i class="fa fa-edit text-gray-500 mr-2"></i> Edit</a>
			                       <a class="dropdown-item" href="javascript:void(0)" onclick="actionQuery('Delete', 'Are you sure delete this menu?', '<?=base_url('Globalfile/deletesmenu/'.$valmenu['ids'])?>')"><i class="fa fa-trash text-gray-500 mr-2"></i> Delete</a>
			                   </div>
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
