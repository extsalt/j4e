
<?php  
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php  my_load_view($this->setting->theme, 'header')?>
    
<?php 

$page_uri = $this->uri->segment(3);

    $page_name = 'Badge Assign';
    $formurl = base_url('badge/managesassign');
    $btnnms = my_caption('menu_new_create_button');

?>
<style>.multiselect {
  width: 200px;
}

.selectBox {
  position: relative;
}

.selectBox select {
  width: 100%;
  font-weight: bold;
}

.overSelect {
  position: absolute;
  left: 0;
  right: 0;
  top: 0;
  bottom: 0;
}

#checkboxes {
  display: none;
  padding-left: 14px;
  border: 1px #dadada solid;
}

#checkboxes label {
  display: block;
}

#checkboxes label:hover {
  background-color: #1e90ff;
}</style>
<div class="container-fluid">
  <?php
  my_load_view($this->setting->theme, 'breadcum');
 
?>

  
  
  <div class="row">
    <div class="col-lg-12">
	  <?php
	    my_load_view($this->setting->theme, 'Generic/show_flash_card');
	  ?>
	  <div class="card shadow mb-4">
	    <div class="card-header py-3">
		  <h3 class="m-0 font-weight-bold text-primary"><?=$page_name;?></h3>
        </div>
        <div class="card-body">
		  <?php
		    //echo form_open($formurl, ['method'=>'POST']);
		    echo form_open_multipart($formurl, ['method'=>'POST']);
		  ?>
		  
		  <input type="hidden" id="base_url" name="base_url" value="<?=base_url()?>">
		  <div class="row form-group mb-4">
		    
		       <div class="col-lg-6">
    			  <label><span class="text-danger">*</span>Select Badge</label>
    			  <select class="form-control selectpicker" name="badge_id" id="badge_id" data-live-search="true">
    			      <option value="0">Select Badge</option>
    			      <?php foreach($badge_data as $val_badge){?>
    			        
    			         <option value="<?=$val_badge['badge_id'];?>" ><?=$val_badge['badge_title'];?></option>
    			      <?php  }?>
    			  </select>
    			  <?php echo form_error('badge_id', '<small class="text-danger">', '</small>');?>
    			
    			 
    			</div>
		      
		        <div class="col-lg-6">
    			  <label><span class="text-danger">*</span>Select Users</label>
    			  <select class="form-control selectpicker" name="user_id" id="user_id" data-live-search="true">
    			      <option value="0">Select Users</option>
    			      <?php 
    			      
    			      foreach($user_data as $valuser){?>
    			        
    			         <option value="<?=$valuser['id'];?>" >
    			            <div class="row">
                                <div class="col-md-12"> 
                                    <span><img src="<?=base_url();?>upload/avatar/<?=$valuser['avatar'];?>" style="height:50px;width:50px;"/>
                                    <?= ucwords($valuser['full_name']);?><br> 
                                    <span>(<?=$valuser['designation'];?>)</span><br>
                                    <span>(<?=$valuser['company'];?>)</span>
                                    <hr>
                                </div>
                            </div>
                    
    			         
    			         
    			             
    			         </option>
    			      <?php  }?>
    			  </select>
    			  <?php echo form_error('user_id', '<small class="text-danger">', '</small>');?>
    			
    			 
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
			  <a href="#" onclick="window.location.reload(true);"><button type="button" id="reset_btn" class="btn mr-2">Reset</button></a>
			    <a href="javascript:window.history.go(-1);"><button type="button" id="cancel_btn" class="btn mr-2">Cancel</button></a>
			</div>
		  </div>
		  <?php echo form_close(); ?>
		</div>
      </div>
	</div>
  </div>
</div>

<?php my_load_view($this->setting->theme, 'footer')?>
<script type="text/javascript">
  
$( document ).ready(function() {
    $('select#sub_type_show').prop('disabled', 'disabled');
    $('select#sub_for_show').prop('disabled', 'disabled');
    $('input#cat_show').prop('disabled', 'disabled');
    $('select#tim_pr').prop('disabled', 'disabled');
});




$('select#sub_subtype').on('change', function() {
    var val_sub_subtyp =  $(this).val(); 
    if(val_sub_subtyp == '1')   // ONE TIME
    {  
      
      $('select#sub_for').removeAttr("disabled");
      $('select#cat').prop('disabled', 'disabled');
      $('select#tim_pr').prop('disabled', 'disabled'); 
    }
    else if(val_sub_subtyp == '2')  // SUBSCRIBTION BASE
    {
      
      $('select#sub_for').removeAttr("disabled");
      $('select#cat').prop('disabled', 'disabled');
      $('select#tim_pr').removeAttr("disabled"); 
    }
    else
    {
       
       $('select#sub_for').prop('disabled', 'disabled');
       $('select#cat').prop('disabled', 'disabled');
       $('select#tim_pr').prop('disabled', 'disabled');
    }
    
    $('select#sub_for').val("0");
    $('select#cat').val("0");
    $('select#tim_pr').val("0");
    
});    

$('select#sub_for').on('change', function() {
    var val_for =  $(this).val(); 
    var sub_type =  $("#sub_type").val();
    
    $('select#cat').val("0");
    
    if(val_for == '8')
    {
       $('select#tim_pr').removeAttr("disabled"); 
       $('select#cat').prop('disabled', 'disabled');
    }
    else
    {
        $.ajax({
            type : "ajax",
            url  : "<?=base_url()?>userdetail/getcategories/"+sub_type+"/"+val_for,
            dataType : "JSON",
            data : {sub_type:sub_type,val_for:val_for},
            success : function(data){
                   $('select#cat').removeAttr("disabled");  
                   var html = '';
                   var i;
                   html += '<option value="0">Select Name</option>';
                   for(i=0; i<data.length; i++)
                   {
                     html += '<option value=' +data[i].catid+'>'+data[i].catname+'</option>';
                   }
                   $('.catshow').html(html); 
                        
                
                
                  }
             });
    }
});    

var expanded = false;

function showCheckboxes() {
  var checkboxes = document.getElementById("checkboxes");
  if (!expanded) {
    checkboxes.style.display = "block";
    expanded = true;
  } else {
    checkboxes.style.display = "none";
    expanded = false;
  }
}
 
</script>



