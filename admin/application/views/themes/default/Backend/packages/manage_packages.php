
<?php  
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php  my_load_view($this->setting->theme, 'header')?>
    <style>
        .nav-tabs {
     border-bottom: 0px !important; 
}
    </style>
<?php 

$page_uri = $this->uri->segment(3);
if(!isset($pack_info))
{
    $page_name = my_caption('pack_add_title');
    $formurl = base_url('packages/managespackage');
    $btnnms = my_caption('menu_new_create_button');
    
    $pack_name = '';
    $pack_prcs = '';
    $pack_desc = '';
    $pack_duration = '';
}
else
{
    $page_name = my_caption('pack_edt_title');
    $formurl = base_url('packages/managespackage/'.$pack_info->ids);
    $btnnms = my_caption('menu_update_button');
    
    $pack_name = $pack_info->pack_name;
    $pack_desc = $pack_info->pack_desc; 
    $pack_prcs = $pack_info->pack_price;
    $pack_duration = $pack_info->pack_duration;
    $pack_type = $pack_info->pack_type;
    $pack_fets = explode("/",$pack_info->pack_fet);
}

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
	  <div class="card shadow mb-4">
	    <div class="card-header py-3">
		  <div class="row">
		      <div class="col-md-6">
		          <h3 class="m-0 font-weight-bold text-primary"><?=$page_name;?></h3>
		          
		      </div>
		      <div class="col-md-6">
		              <ul class="nav nav-tabs" id="myTab" role="tablist" style="float: right;">
                        <li class="nav-item">
                          <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Package</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Feature Selection</a>
                        </li>
                       
                      </ul>
		      </div>
		  </div>
		  
		  
		  
        </div>
        
        <div class="card-body">
              <?php
		    //echo form_open($formurl, ['method'=>'POST']);
		    echo form_open_multipart($formurl, ['method'=>'POST']);
		  ?>
		  
              
              <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                  <h4>Package</h4>
                  
                  <div class="card-body">
                   
		     		  <input type="hidden" id="base_url" name="base_url" value="<?=base_url()?>">
		     		  <div class="row form-group mb-4">
		    
                		    <div class="col-lg-6">
                			  <label><span class="text-danger">*</span> <?=my_caption('pack_name');?></label>
                			  <?php
                			    (!empty(set_value('pack_name'))) ? $pack_name = set_value('pack_name') : $pack_name = $pack_name;
                			    
                			    $data = array(
                				  'name' => 'pack_name',
                				  'id' => 'pack_name',
                				  'value' => $pack_name,
                				  'class' => 'form-control'
                				);
                				echo form_input($data);
                				echo form_error('pack_name', '<small class="text-danger">', '</small>');
                			  ?>
                			  
                			</div>
                		    
                		    <div class="col-lg-6">
                			  <label><span class="text-danger">*</span> <?=my_caption('pack_price');?></label>
                			  <?php
                			    (!empty(set_value('pack_price'))) ? $pack_price = set_value('pack_price') : $pack_price = $pack_prcs;
                			    $data = array(
                				  'name' => 'pack_price',
                				  'id' => 'pack_price',
                				  'value' => $pack_price,
                				  'class' => 'form-control numberonly'
                				);
                				echo form_input($data);
                				echo form_error('pack_price', '<small class="text-danger">', '</small>');
                			  ?>
                			</div>
                
                			<div class="col-lg-6">
                			  <label><span class="text-danger">*</span> <?=my_caption('pack_duration');?></label>
                			  <?php
                			    (!empty(set_value('pack_duration'))) ? $pack_duration = set_value('pack_duration') : $pack_duration = $pack_duration;
                			    $data = array(
                				  'name' => 'pack_duration',
                				  'id' => 'pack_duration',
                				  'value' => $pack_duration,
                				  'class' => 'form-control numberonly datechoosen',
                				  'type' => 'number',
                				   'min'=>'1',
                				   'max'=>'60'
                				);
                				echo form_input($data);
                				echo form_error('pack_duration', '<small class="text-danger">', '</small>');
                			  ?>
                			</div>
                                      
                                      <div class="col-lg-6">
                			  <label><span class="text-danger">*</span> Package Type</label>
                                          <select class="form-control selectpicker" name="pack_type" required data-live-search="true"> 
                                              <option value="">Select</option>
                                              <option value="1" <?php if($pack_type == "1"){ echo 'selected'; }  ?>>Guest</option>
                                              <option value="2" <?php if($pack_type == "2"){ echo 'selected'; }  ?>>Paid</option>
                                          </select>
                			</div>
		     		  
		     		  </div>
                      <div class="row form-group mb-4">	
            			<div class="col-lg-12 mb-2">
            			  <label><span class="text-danger">*</span><?=my_caption('pack_desc')?></label>
            			  <div>
            			    <textarea id="blog_body" name="pack_desc"><?=$pack_desc;?></textarea>
            			    <?=form_error('pack_desc', '<small class="text-danger">', '</small>')?>
            			  </div>
            			</div>
		  
		  
		    
		  </div>
                  
                </div>
                </div>
                
                
                
                
                
                
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                  <h1>Feature Selection</h1>
                  <div class="card-body">
                      <div class="row form-group mb-4">	
			            <label><?=my_caption('pack_fet')?></label><br>
			  
        			         <div class="col-md-12 row">
                                             <table class="table table-responsive">
                                                 <thead>
                                                 <th class="col-sm-2 text-center">Sr.No.</th>
                                                    <th class="col-sm-6">Feature Name</th>
                                                    <th class="col-sm-2">Yes/No</th>
                                                    <th class="col-sm-2">Count <a title="Use 0 for Unlimited Access"><i class="fa fa-info-circle"></i></a></th>
                                                 </thead>
                                                 <tbody>
                                                     
                                                 
                			  	 <?php                
                                                 $c = 1;
                			  	 // print_r($pack_fets);
                                    foreach($fet_info as $key => $val_fet)
                                    {
                                        $info = $this->db->where(array('package_id'=>$pack_info->pack_id,'feature_id'=>$val_fet->fet_id))->get('package_features')->row();
//                                    	echo "<div class='col-lg-6 mb-2 '>";
//                                    	if(!empty($pack_fets))
//                                    	{
//                                    	if(in_array($val_fet->fet_id, $pack_fets))
//                                    	{
//                                    		echo "<input type='checkbox' name='feature[]'  value='".$val_fet->fet_id."' checked>&nbsp;&nbsp;".$val_fet->fet_name."<br>";	
//                                    	}
//                                    	else
//                                    	{
//                                    		echo "<input type='checkbox' name='feature[]'  value='".$val_fet->fet_id."'>&nbsp;&nbsp;".$val_fet->fet_name."<br>";	
//                                    	}
//                                    	}
//                                    	else
//                                    	{
//                                    		echo "<input type='checkbox' name='feature[]' value='".$val_fet->fet_id."'>&nbsp;&nbsp;".$val_fet->fet_name."<br>";
//                                    	}
//                                    	echo "</div>";
                                        
                                        ?>
                                                     <tr>
                                                         <td class="text-center"><?= $c ?></td>
                                                         <td><?= $val_fet->fet_name ?><input type="hidden" name="feature[]" value="<?= $val_fet->fet_id ?>"></td>
                                                         <td>
                                                             <select class="form-control" name="is_allowed[]">
                                                                 <option value="0" <?php if($info->is_allowed == 0){ echo 'selected'; } ?>>No</option>
                                                                 <option value="1" <?php if($info->is_allowed == 1){ echo 'selected'; } ?>>Yes</option> 
                                                             </select>
                                                         </td>
                                                         <td><input class="form-control numinput" type="text" name="count_allowed[]" value="<?= empty($info)?0:$info->count_allowed ?>"></td>
                                                     </tr>          
                                    <?php
                                        $c++;
                                       }
                                     ?>
                                                     </tbody>
                                             </table>
        			  	     </div>  
                      </div>
                      
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
			    <?php
			    echo form_close();
			  ?>
			</div>     
                      
		     		  </div>
		     	  </div>	  
                
               
              </div>
              <button type="button" class="prevtab prevtabs btn btn-danger">Prev</button>
              <button type="button" class="nexttab nexttabs btn btn-primary">Next</button>

        </div>
        
        
        
        
      </div>
    </div>
  </div>
        	
</div>
        
      

<?php my_load_view($this->setting->theme, 'footer')?>
<script type="text/javascript">
      /* -------------------------------------------------------------
            bootstrapTabControl
        ------------------------------------------------------------- */
        function bootstrapTabControl(){
            var i, panealss = $('.tab-pane') , items = $('.nav-link');          //alert(panealss.length);
            // next
            $('.nexttabs').on('click', function(){  
                for(i = 0; i < panealss.length; i++){
                    if($(panealss[i]).hasClass('active') == true){
                        break;
                    }
                }
                if(i < panealss.length - 1){
                    
                    // for pane 
                    $(panealss[i]).removeClass('show active');     
                    $(panealss[i+1]).addClass('show active');  
                }

            });
            
            $('.nexttab').on('click', function(){
                for(i = 0; i < items.length; i++){
                    if($(items[i]).hasClass('active') == true){
                        break;
                    }
                }
                if(i < items.length - 1){
                    // for tab
                    $(items[i]).removeClass('active');  //alert(items[i]);
                    $(items[i+1]).addClass('active');
                    
                }

            });
            
            
            
            // Prev
            $('.prevtabs').on('click', function(){
                for(i = 0; i < panealss.length; i++){
                    if($(panealss[i]).hasClass('active') == true){
                        break;
                    }
                }
                if(i != 0){
                    // for tab
                    
                    // for pane
                    $(panealss[i]).removeClass('show active'); 
                    $(panealss[i-1]).addClass('show active');
                }
            });
            
            $('.prevtab').on('click', function(){
                for(i = 0; i < items.length; i++){
                    if($(items[i]).hasClass('active') == true){
                        break;
                    }
                }
                if(i != 0){
                    // for tab
                    $(items[i]).removeClass('active');
                    $(items[i-1]).addClass('active');
                    // for pane
                    $(pane[i]).removeClass('show active'); 
                    $(pane[i-1]).addClass('show active');
                }
            });
        }
        bootstrapTabControl();
        $('.numinput').on('input', function() {
      this.value = this.value.replace(/(?!^-)[^0-9.]/g, "").replace(/(\..*)\./g, '$1'); 
});
    </script>