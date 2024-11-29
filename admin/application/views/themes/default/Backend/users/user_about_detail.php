<?php   
defined('BASEPATH') OR exit('No direct script access allowed');
$ci=& get_instance();
?>
<?php my_load_view($this->setting->theme, 'header')?>
<div class="container-fluid">
  <?php
  my_load_view($this->setting->theme, 'breadcum');
 
?>
  <div class="row">
    <div class="col-lg-12">
	  <?php
	    my_load_view($this->setting->theme, 'Generic/show_flash_card');
		(my_uri_segment(3) == '') ? $seg3 = 'all' : $seg3 = my_uri_segment(3);
		(my_uri_segment(4) == '') ? $seg4 = 'all' : $seg4 = my_uri_segment(4);
	  ?>
	</div>
  </div>
  <div class="row">
    <div class="col-lg-3">
	  <div class="card mb-4 py-3 border-left-primary">
	    <div class="card-body">
		  
		   <!--
		   <hr class="dotted">
		    <a class="btn btn-light btn-block" href="<?=base_url('users/managesdetail/'.$userids)?>">User Detail</a>-->
		   <hr class="dotted">
		    <a class="btn btn-primary btn-block" href="<?=base_url('users/managesaboutus/'.$userids)?>">About Us </a>
		   <hr class="dotted">
		    <a class="btn btn-light btn-block" href="<?=base_url('users/managescontactus/'.$userids)?>">Contact Us</a>
		   <hr class="dotted">
		   <hr class="dotted">
		    <a class="btn btn-light btn-block" href="<?=base_url('users/managesgallery/'.$userids)?>">Gallery</a>
		   <hr class="dotted">
		   <hr class="dotted">
		    <a class="btn btn-light btn-block" href="<?=base_url('users/managesratereview/'.$userids)?>">Reviews</a>
		   <hr class="dotted">
		   
		  
		  
		</div>
      </div>
	</div>
	<div class="col-lg-9">
	     <div class="card shadow mb-4">
	    <div class="card-header py-3">
		  
		  <div class="row">
            <div class="col-lg-6 text-left">
        	  <h6 class="m-0 font-weight-bold text-primary">View About Detail</h6>
        	</div>
            <div class="col-lg-6 text-right">
        	  
        	  
            </div>
          </div>
		  
		  
		  
		  
        </div>
        <div class="card-body">
		  <div class="">
		    
		    <div class="row">
		        <div class="col-md-12">
		            
                    <table>
		            <tr>
		                <td style="width:40%;"><label class="control-label"><strong>About </strong></label></td>
		                <td style="width:5%;"><label class="control-label"><strong> : </strong></label></td>
		                <td style="width:55%;">
		                    <span class="">
                                <?= ucwords($info_data->about_company);?>                    
                            </span>
		                </td>
		            </tr>
		            <tr>
		                <td style="width:40%;"><label class="control-label"><strong>Company Name </strong></label></td>
		                <td style="width:5%;"><label class="control-label"><strong> : </strong></label></td>
		                <td style="width:55%;">
		                    <span class="">
                                <?= $info_data->company;?>                    
                            </span>
		                </td>
		            </tr> 
		            <tr>
		                <td style="width:40%;"><label class="control-label"><strong>Business Entity </strong></label></td>
		                <td style="width:5%;"><label class="control-label"><strong> : </strong></label></td>
		                <td style="width:55%;">
		                    <span class="">
                                <?= $info_data->business_entity;?>                    
                            </span>
		                </td>
		            </tr>   
		            <tr>
		                <td style="width:40%;"><label class="control-label"><strong>Business Type </strong></label></td>
		                <td style="width:5%;"><label class="control-label"><strong> : </strong></label></td>
		                <td style="width:55%;">
		                    <span class="">
                                <?= $info_data->business_type;?>                    
                            </span>
		                </td>
		            </tr> 
		            <tr>
		                <td style="width:40%;"><label class="control-label"><strong>Business Expertise </strong></label></td>
		                <td style="width:5%;"><label class="control-label"><strong> : </strong></label></td>
		                <td style="width:55%;">
		                    <span class="">
                                <?= $info_data->business_experties;?>                    
                            </span>
		                </td>
		            </tr>   
		            
		            <tr>
		                <td style="width:40%;"><label class="control-label"><strong>Working From </strong></label></td>
		                <td style="width:5%;"><label class="control-label"><strong> : </strong></label></td>
		                <td style="width:55%;">
		                    <span class="">
                                <?= $info_data->working_from;?>                    
                            </span>
		                </td>
		            </tr> 
		            <tr>
		                <td style="width:40%;"><label class="control-label"><strong>No of Employees </strong></label></td>
		                <td style="width:5%;"><label class="control-label"><strong> : </strong></label></td>
		                <td style="width:55%;">
		                    <span class="">
                                <?= $info_data->title;?>                    
                            </span>
		                </td>
		            </tr> 
		            <tr>
		                <td style="width:40%;"><label class="control-label"><strong>Expected Turnover </strong></label></td>
		                <td style="width:5%;"><label class="control-label"><strong> : </strong></label></td>
		                <td style="width:55%;">
		                    <span class="">
                                <?= $info_data->turn_over_value;?>                    
                            </span>
		                </td>
		            </tr>      
		            <tr>
		                <td style="width:40%;"><label class="control-label"><strong>What is Your Target Audience </strong></label></td>
		                <td style="width:5%;"><label class="control-label"><strong> : </strong></label></td>
		                <td style="width:55%;">
		                    <span class="">
                                <?= $info_data->target_audiance;?>                    
                            </span>
		                </td>
		            </tr> 
		            
		            <?php 
		            if($info_data->membership_type == '' OR $info_data->membership_type == '1')
                    {
                        $membership_name = 'Guest Member';
                    }
                    else
                    {
                        $packages_ids = $info_data->packages_id;
                        $getpackage = $this->db->select('pack_name')->where('pack_id',$packages_ids)->get('packages')->row();
                        $membership_name = $getpackage->pack_name;
                    }
		            ?>
		            
		            <tr>
		                <td style="width:40%;"><label class="control-label"><strong>Type Of Membership </strong></label></td>
		                <td style="width:5%;"><label class="control-label"><strong> : </strong></label></td>
		                <td style="width:55%;">
		                    <span class="">
                                <?= $membership_name;?>                    
                            </span>
		                </td>
		            </tr> 
		        </table>
                    
                    
		        </div>
		        
		    </div>
		    
		    
		    
		    
		    
          </div>
		</div>
      </div>
	</div> 
  </div>
</div>

<?php my_load_view($this->setting->theme, 'footer')?>