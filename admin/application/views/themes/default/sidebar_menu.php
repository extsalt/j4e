<?php $site_url = $this->uri->segment(1).'/'.$this->uri->segment(2); 
   //echo $menu_page;  
?>   
   
   
        <li class="nav-item <?php if($menu_page == 'Dashboard'){ echo "active";} ?>">
         <a class="nav-link" href="<?=base_url();?>dashboard">
           <img src="<?= base_url()?>upload/icons/home.svg" style="height: 18px;"> 
          <span>Dashboard</span>
         </a>
        </li>
	

 
 <?php 
    $query_user = $this->db->where('ids', $_SESSION['user_ids'])->get('user', 1)->row();
    $query_role = $this->db->where('ids', $query_user->role_ids)->get('role', 1)->row();
    
	$menu_query = $this->Global_model->get_menu(0)->result_array();  
	
       
	if($query_role->name == "Super_Admin")
	{
	?>  
	    
        
        <?php
        $i = '2';
        foreach($menu_query as $val_menu)
    	{  //echo $val_menu['menu_name'];
    	     $parent_id = $val_menu['menu_id'];
    		 $sub_menu_query = $this->Global_model->get_menu($parent_id)->result_array();
    		    
    		 if(count($sub_menu_query) == '0')     
    	     {   
    	      ?>
    	      <li class="nav-item <?php if($menu_page == $val_menu['menu_name']){ echo "active";} ?>">
                <a class="nav-link" href="<?=base_url($val_menu['menu_link'])?>">
                  <img src="<?= base_url().'upload/icons/'.$val_menu['menu_icon']; ?>" style="height: 18px;"> 
                  <span><?php echo $val_menu['menu_name']; ?></span></a>
              </li>
    	      
    	      
    	      
    	     
    	     <?php 
    	      }
    	  
    	      else
    	      {  
    	      ?> 
    	      <li class="nav-item <?php if($menu_page == $val_menu['menu_name']){ echo "active";} ?>">
    			<a class="nav-link <?php if($menu_page != $val_menu['menu_name']){ echo "collapsed";} ?>" href="#" data-toggle="collapse" data-target="#collapsePages_admin_panel_<?=$i;?>" aria-expanded="true" aria-controls="collapsePages_admin_panel_<?=$i;?>">
    			    <img src="<?= base_url().'upload/icons/'.$val_menu['menu_icon']; ?>" style="height: 18px;"> 
    			    <span><?php echo $val_menu['menu_name']; ?></span>
    		    </a>
    		    <div id="collapsePages_admin_panel_<?=$i;?>" class="collapse <?php if($menu_page == $val_menu['menu_name']){ echo "show";} ?>" aria-labelledby="headingPages" data-parent="#accordionSidebar">
    				<div class="bg-white py-2 collapse-inner rounded">
    				   
    				   <?php 
    				      foreach($sub_menu_query as $submenu)
    				      {
    				   ?>
    				           <a class="collapse-item <?php if($site_url == $submenu['menu_link']){ echo "active";} ?>" href="<?=base_url($submenu['menu_link'])?>"><?=$submenu['menu_name'];?></a>
    				   <?php
    				      } 
    				   ?>
    				</div>
    			</div>
    		 </li>
    	     
    	     <?php
    	      }  
    	     ?>
    	  
    	  <?php
    	   $i++;
    	   } 
        
	    ?>
	    <li class="nav-item">
		   <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapsePages_admin_panel_1" aria-expanded="false" aria-controls="collapsePages_admin_panel_1">
			   <i class="fas fa-cog" style="color:white"></i>
			   <span>Site Setting</span>
		   </a>
		   <div id="collapsePages_admin_panel_1" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar" style="">
			   <div class="bg-white py-2 collapse-inner rounded">
			       
			       <a class="collapse-item" href="<?=base_url();?>globalfile/managemenu">Menu</a>
			       <a class="collapse-item" href="<?=base_url();?>admin/role">Role</a>
			       <a class="collapse-item" href="<?=base_url();?>admin/general_setting">General Setting</a>
                               <a class="collapse-item" href="<?=base_url();?>admin/website_setting">Website Setting</a>
			       <a class="collapse-item" href="<?=base_url();?>infopages/manageprivacypolicy">Privacy Policy</a>
			       <a class="collapse-item" href="<?=base_url();?>infopages/managetermcondition">Terms & Condition</a>
			       <a class="collapse-item" href="<?=base_url();?>infopages/managefaq">FAQ's</a>
			       <a class="collapse-item" href="<?=base_url();?>users/notification">Notification</a>
			       <a class="collapse-item" href="<?=base_url();?>admin/smtp_setting">SMTP Setting</a>
			       <a class="collapse-item" href="<?=base_url();?>admin/email_template">Email Template</a>
			       <a class="collapse-item" href="<?=base_url();?>admin/auth_integration">Auth Integration</a>
			       <a class="collapse-item" href="<?=base_url();?>admin/list_user">Backend Users</a>
			       <a class="collapse-item" href="<?=base_url();?>admin/users_activity_log">Users Activity Log</a>
                               <a class="collapse-item" href="<?=base_url();?>admin/otp_log">OTP Log</a>
			       <a class="collapse-item" href="<?=base_url();?>admin/database_backup">Database Backup</a>
			   </div>
		   </div>
		</li>
	    <?php
	}
	else
	{
	    $i = '1';
	    
	    
	    
    	foreach($menu_query as $val_menu)
    	{
    	    $parent_id = $val_menu['menu_id'];
    		  
    		  $sub_menu_query = $this->Global_model->get_menu($parent_id)->result_array();
    		  
    	      if(count($sub_menu_query) == '0' )     
    	      {   
    	     
    	          
    	     
    	       $checkper = $this->Global_model->check_permission($parent_id,$query_user->role_ids) ;    
    	       if($checkper['view_per'] == '1' && count($checkper) != '0')
    	       {
    	  ?>
    	  
    	      <li class="nav-item">
                <a class="nav-link" href="<?=base_url($val_menu['menu_link'])?>">
                  <img src="<?= base_url().'upload/icons/'.$val_menu['menu_icon']; ?>" style="height: 18px;"> 
                  <span><?php echo $val_menu['menu_name']; ?></span></a>
              </li>
    	  <?php } 
    	      }
    	  
    	      else {
    	         
    	         $checkpers = $this->Global_model->check_permission($parent_id,$query_user->role_ids) ;   // echo $checkper['view_per'].'-'.$parent_id.'-'.$query_user->role_ids;
    	         
    	         if(($checkpers['view_per'] == '1' && count($checkpers) != '0' ) )
    	         
    	         {
    	     ?>
    	     <li class="nav-item <?php if($menu_page == $val_menu['menu_name']){ echo "active";} ?>">
    			<a class="nav-link <?php if($menu_page != $val_menu['menu_name']){ echo "collapsed";} ?>" href="#" data-toggle="collapse" data-target="#collapsePages_admin_panel_<?=$i;?>" aria-expanded="true" aria-controls="collapsePages_admin_panel_<?=$i;?>">
    			    <img src="<?= base_url().'upload/icons/'.$val_menu['menu_icon']; ?>" style="height: 18px;"> 
    			    <span><?php echo $val_menu['menu_name']; ?></span>
    		    </a>
    		    <div id="collapsePages_admin_panel_<?=$i;?>" class="collapse <?php if($menu_page == $val_menu['menu_name']){ echo "show";} ?>" aria-labelledby="headingPages" data-parent="#accordionSidebar">
    				<div class="bg-white py-2 collapse-inner rounded">
    				   
    				   <?php 
    				   
    				         foreach($sub_menu_query as $submenu)
    				         {
    				             
    				               $checkperss = $this->Global_model->check_permission($submenu['menu_id'],$query_user->role_ids) ;   
                        	       if($checkperss['view_per'] == '1' )
                        	       
                        	       {
    				   ?>
    				           <a class="collapse-item <?php if($site_url == $submenu['menu_link']){ echo "active";} ?>" href="<?=base_url($submenu['menu_link'])?>"><?=$submenu['menu_name'];?></a>
    				   <?php
    				         } }
    				    
    				    ?>
    				</div>
    			</div>
    		 </li>
    	     
    	     <?php
    	     } } 
    	  
    	  
    	  ?>
    	  
    	  <?php
    	   $i++;
    	   } 
   	}
   	
   	
   	
   	
	
?>
	  
