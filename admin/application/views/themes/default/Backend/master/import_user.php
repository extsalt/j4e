
<?php  
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php  my_load_view($this->setting->theme, 'header')?>
    
<?php 

 

$page_uri = $this->uri->segment(3);

    $page_name = 'Import User';
    $formurl = base_url('globalfile/import_user');
    $btnnms = my_caption('menu_new_create_button');
    
    
?>
<div class="container-fluid">
  <?php
  my_load_view($this->setting->theme, 'breadcum');
 
?>
  <div class="row">
    <div class="col-lg-12">
	  <?php
	    my_load_view($this->setting->theme, 'Generic/show_flash_card');
	  ?>
            <?php 
//        print_r($_SESSION);die;
            if(!empty($_SESSION['total_rows'])){
        ?>
        <div class="alert alert-defult alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i> Import Successful..!!</h4>
                <h5><strong>Total No. of Rows :</strong></h5> <?= $_SESSION['total_rows']; ?> <br> <h5><strong>No. of Rows Imported :</strong></h5> <?= $_SESSION['total_imported']; ?> <br> <h5><strong>No. of Rows Skipped :</strong></h5> <?= $_SESSION['total_skipped']; ?> <br> <h5><strong>Rows Skipped :</strong></h5> <?= $_SESSION['rows_skipped']; ?>
              </div>
        <?php
            }
        ?>
	  <div class="card shadow mb-4">
	    <div class="card-header py-3">
		  <div class="row">
            <div class="col-lg-4 text-left">
        	   <h3 class="m-0 font-weight-bold text-primary"><?=$page_name;?></h3>
        	</div>
            <div class="col-lg-8 text-right">
        	 
                <a href="<?=base_url();?>upload/import_j4e_user.xlsx" download class="btn btn-primary mr-2">Download Demo File</a>
        	  
            </div>
          </div>
		  
		  
		 
        </div>
        <div class="card-body">
		  <?php
		    //echo form_open($formurl, ['method'=>'POST']);
		    echo form_open_multipart($formurl, ['method'=>'POST']);
		  ?>
		  
		  <input type="hidden" id="base_url" name="base_url" value="<?=base_url()?>">
		  <div class="row form-group mb-4">
		    
            <div class="col-lg-4">
			  <label><span class="text-danger">*</span> Package</label>
                          <select name="package_id" class="form-control selectpicker" required="" data-live-search="true">
                              <option value="">Select</option>
			      <?php foreach($package_data as $val_data){?>
			         <option value="<?=$val_data->pack_id;?>"><?=$val_data->pack_name;?></option>
			      <?php } ?>
			      
			  </select>
			  
			</div> 		    
		    
		    <div class="col-lg-6">
			  <label><span class="text-danger">*</span> File</label><br>
			  <input type="file" name="upload_file"/>
			  
			</div>
		    
		  </div>
		  
		  
		  
		  
		  <hr>
		  <div class="row">
			<div class="col-lg-6 offset-6 text-right">
			  <?php
			    $data = array(
				  'type' => 'submit',
				  'name' => 'btn_submit_block',
				  'id' => 'btn_submit_block',
				  'value' => $btnnms,
				  'class' => 'btn btn-primary mr-2'
			    );
			    echo form_submit($data);
			  ?>
			</div>
		  </div>
		  <?php echo form_close(); ?>
		</div>
      </div>
	</div>
  </div>
</div>
<?php
//    unset($_SESSION['file_name']);
    unset($_SESSION['total_rows']);
    unset($_SESSION['total_imported']);
    unset($_SESSION['total_skipped']);
    unset($_SESSION['rows_skipped']);
//    unset($_SESSION['import_date']);
?>
<?php my_load_view($this->setting->theme, 'footer')?>
<script>
    $(document).ready(function(){
     
     var functionalsetting = $('input[name="areasetting"]:checked').val(); //alert(functionalsetting);
     
     if(functionalsetting == '1')
     {
        $(".functional_areas").hide();   
        $(".number_of_person_per_area").hide(); 
     }
     else if(functionalsetting == '2')
     {
         $(".functional_areas").show();   
         $(".number_of_person_per_area").hide();
     }
     else if(functionalsetting == '3')
     {
         $(".functional_areas").hide();   
         $(".number_of_person_per_area").show();
     }
     
     
     
     
     
     

    
 });
 
 
 $("input[name='areasetting']").change(function(){
    var functionalsetting = $('input[name="areasetting"]:checked').val(); 
     
     if(functionalsetting == '1')
     {
        $(".functional_areas").hide();   
        $(".number_of_person_per_area").hide(); 
     }
     else if(functionalsetting == '2')
     {
         $(".functional_areas").show();   
         $(".number_of_person_per_area").hide();
     }
     else if(functionalsetting == '3')
     {
         $(".functional_areas").hide();   
         $(".number_of_person_per_area").show();
     }
    });
 
 
</script>