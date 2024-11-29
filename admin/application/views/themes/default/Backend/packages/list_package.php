<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$data['checkper'] = checkpermissions('8');    
if($data['checkper']['view_per'] == '2')
{
   redirect(base_url('dashboard'));
   exit();
}

?>
<?php
  my_load_view($this->setting->theme, 'header');
 
?>

<style>
    .drag:hover {
    cursor:move;
}
</style>   
    
 
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
        	  
        	  <h3 class="m-0 font-weight-bold text-primary">Package List</h3>
        	</div>
            <div class="col-lg-8 text-right">
        	  <?php if($data['checkper']['create_per'] == '1'){?>
        	  <button type="button" class="btn btn-primary mr-2" onclick="window.location.href='<?=base_url('packages/managespackage')?>'">Add Package</button>
        	 <?php } ?> 
            </div>
          </div>
        </div>
        <div class="card-body">
		  <div class="table-responsive">
		    <table id="CategoryList" class="table table-bordered">
			  <thead>
			    <tr>
			      <th class="no-sort" style="width:4%!important;"><?=my_caption('srno_data')?></th> 
                              <th></th>
				  <th><?=my_caption('pack_name')?></th>
				  <th style="width:25%!important;"><?=my_caption('pack_price')?></th>
                                  <th style="width:15%!important;">Package Type</th>
				  <th class="no-sort" style="width:8%!important;"><?=my_caption('menu_actions')?></th>
			    </tr>
			  </thead>
			  <tbody>
			      <?php foreach($pack_data as $key => $valpack){
			      $link = $valpack->ids;
			      ?>
			       <tr>
                                   <td class="drag"> <?= $valpack->seq_no;?></td>
                    <td><?= $valpack->pack_id ?></td>
			           <td><?=$valpack->pack_name;?></td>
			           <td ><span style="float: right;"><i class='fas fa-rupee-sign fa-fw fa-1x'></i> <?= number_format($valpack->pack_price,2);?></span></td>
                                   <td>
                                       <?php
                                            if($valpack->pack_type == "1")
                                            {
                                                echo 'Guest';
                                            }
                                            else if($valpack->pack_type == "2")
                                            {
                                                echo 'Paid';
                                            }
                                            else
                                            {
                                                echo '-';
                                            }
                                       ?>
                                   </td>
                                   <td>
			              <div class="btn-group">
				    	    <?php if($data['checkper']['edit_per'] == '1'){?>
				    	      <a href="<?=base_url('packages/managespackage/'.$link)?>" class="btn btn-success btn-flat btn-sm"><i class="fa fa-edit mr-2"></i></a>
				    	    <?php } if($data['checkper']['delete_per'] == '1'){?>
				    	      <a href="javascript:void(0)" class="btn btn-danger btn-flat btn-sm" onclick="actionQuery('Delete', 'Are you sure delete this package?', '<?=base_url('packages/deletepackage/'.$link)?>')"><i class="fa fa-trash mr-2"></i></a>
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
<script>
    $(document).ready(function() {
        var base_url = '<?= base_url() ?>';
         "use strict";
    var table = $('#CategoryList').DataTable({ 
        responsive: true, 
        rowReorder: true,
        dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>tp", 
        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]], 
        "columnDefs": [
            {
                "targets": [ 1 ],
                "visible": false,
                "searchable": false
            }
        ],
        
        select: true,
        buttons: [  
//            {extend: 'copy', className: 'btn-sm prints'}, 
            {extend: 'csv', title: 'ExampleFile', className: 'btn-sm prints'}, 
//            {extend: 'excel', title: 'ExampleFile', className: 'btn-sm prints'}, 
//            {extend: 'pdf', title: 'ExampleFile', className: 'btn-sm prints'}, 
            {extend: 'print', className: 'btn-sm prints'} 
        ] 
    });
    table.on( 'row-reorder', function ( e, diff, edit ) {
        var result = 'Reorder started on row: '+edit.triggerRow.data()[1]+'<br>';
        const d = [];
        for ( var i=0, ien=diff.length ; i<ien ; i++ ) {
            var rowData = table.row( diff[i].node ).data();
 
            result += rowData[1]+' updated to be in position '+
                diff[i].newData+' (was '+diff[i].oldData+')<br>';
        d[i] = {pack_id:rowData[1],new_seq:diff[i].newData}; 
        
        }
        $.ajax
        ({
             type: "POST",
             url: base_url+"packages/update_package_sequence",
             data: {seq:d},
             cache: false,
             async:false,
             success: function(data)
             {
                 //$('#subcategory_id').html(data);

             } 
         });
//        alert(result);
//        $('#result').html( 'Event result:<br>'+result );
    } );
    } );
    </script>
<script src="https://cdn.datatables.net/rowreorder/1.2.8/js/dataTables.rowReorder.min.js"></script>