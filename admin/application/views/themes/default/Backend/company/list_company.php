<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php
  my_load_view($this->setting->theme, 'header');
  
?>

<div class="container-fluid">
  <div class="row">
    <div class="col-lg-4 text-left">
	  <h1 class="h3 mb-4 text-gray-800"><?=my_caption('Company_list_title')?></h1>
	</div>
    <div class="col-lg-8 text-right">
	  
	  <button type="button" class="btn btn-primary mr-2" onclick="window.location.href='<?=base_url('company/new_company')?>'"><?=my_caption('company_list_new_user')?></button>
	 
    </div>
  </div>

  <div class="row">
    <div class="col-lg-12">
	  <?php my_load_view($this->setting->theme, 'Generic/show_flash_card');?>
	  <div class="card shadow mb-4">
	    <div class="card-header py-3">
		  <h6 class="m-0 font-weight-bold text-primary"><?=my_caption('Company_list_title')?></h6>
        </div>
        <div class="card-body">
		  <div class="table-responsive">
		    <table id="" class="table table-bordered">
			  <thead>
			    <tr>
				  <th>Sr No</th>
				  <th>Name</th>
				  <th>Email</th>
				  <th>Ph No</th>
				  <th>Action</th>
			    </tr>
			  </thead>
			  <tbody>
			      <?php 
			        $sr_no = '1';
			       foreach($companydata as $key => $val_cmp){?>
			       <tr>
			           <td><?=$sr_no;?></td>
			           <td><?=$val_cmp->cmp_name;?></td>
			           <td><?=$val_cmp->email_address;?></td>
			           <td><?=$val_cmp->phone;?></td>
			           <td>
			               <div class="btn-group" role="group">
			                   <button id="btnGroupDrop" type="button" class="btn btn-light btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-h text-gray-500"></i></button>
			                   <div class="dropdown-menu" aria-labelledby="btnGroupDrop" style="">
			                       <a class="dropdown-item" href="<?=base_url('company/details/'.$val_cmp->cmp_ids)?>"><i class="fa fa-edit text-gray-500 mr-2"></i> Detail</a>
			                       <a class="dropdown-item" href="javascript:void(0)" onclick="actionQuery('Delete', 'Are you sure delete this menu?', '<?=base_url('company/deletecompany/'.$val_cmp->cmp_ids)?>')"><i class="fa fa-trash text-gray-500 mr-2"></i> Delete</a>
			                   </div>
			               </div>
			           </td>
			       </tr>
			      <?php $sr_no++;} ?>
			  </tbody>
			</table>
          </div>
		</div>
      </div>
	</div>
  </div>
</div>
<?php my_load_view($this->setting->theme, 'footer')?>
