<?php
  defined('BASEPATH') OR exit('No direct script access allowed'); 
  require_once('menu_builder.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title><?php /*echo my_caption('dashboard_html_title') . ' - ' .*/ echo $this->setting->sys_name; ?></title>
   <link rel="shortcut icon" href="<?=base_url().$this->setting->favicon;?>" type="image/x-icon">
  <link href="<?=base_url()?>assets/themes/default/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="<?=base_url();?>FONTDATA/dist/css/fontawesome-iconpicker.min.css" rel="stylesheet">
  <link href="<?=base_url()?>assets/themes/default/vendor/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link href="<?=base_url()?>assets/themes/default/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
   <link href="<?=base_url()?>assets/themes/default/css/sb-admin-2.min.css" rel="stylesheet">
  <link href="<?=base_url()?>assets/themes/default/vendor/sweetalert2/sweetalert2.min.css" rel="stylesheet">
  <link href="<?=base_url()?>assets/themes/default/vendor/summernote/summernote.min.css" rel="stylesheet">
  <link href="<?=base_url()?>assets/themes/default/vendor/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
  <link href="<?=base_url()?>assets/themes/default/css/custom.css?v=<?=$this->setting->version?>" rel="stylesheet">
  
  <!--<link href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css" rel="stylesheet">-->
  <link href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css" rel="stylesheet">
  
 <style>
 .image-area {
  position: relative;
  width: 50%;
  background: #333;
}
.image-area img{
  max-width: 100%;
  height: auto;
}
.remove-image {
/*display: none;*/
position: absolute;
top: -10px;
right: -10px;
border-radius: 10em;
padding: 2px 6px 3px;
text-decoration: none;
font: 700 21px/20px sans-serif;
background: #555;
border: 3px solid #fff;
color: #FFF;
box-shadow: 0 2px 6px rgba(0,0,0,0.5), inset 0 2px 4px rgba(0,0,0,0.3);
  text-shadow: 0 1px 2px rgba(0,0,0,0.5);
  -webkit-transition: background 0.5s;
  transition: background 0.5s;
}
.remove-image:hover {
 background: #E54E4E;
  padding: 3px 7px 5px;
  top: -11px;
right: -11px;
}
.remove-image:active {
 background: #E54E4E;
  top: -10px;
right: -11px;
}
 
 
 .card-header
 {
     background-color : #D3D3D3 !important;
 }
 
 
.removeimages
{
    position: absolute;
    bottom: 2px;
    right: 98px;
}
#myImg {
  border-radius: 5px;
  cursor: pointer;
  transition: 0.3s;
}

#myImg:hover {opacity: 0.7;}

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 5; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
}

/* Modal Content (image) */
.modal-content {
  margin: auto;
  display: block;
  width: 80%;
  max-width: 700px;
}

/* Caption of Modal Image */
#caption {
  margin: auto;
  display: block;
  width: 80%;
  max-width: 700px;
  text-align: center;
  color: #ccc;
  padding: 10px 0;
  height: 150px;
}

/* Add Animation */
.modal-content, #caption {  
  -webkit-animation-name: zoom;
  -webkit-animation-duration: 0.6s;
  animation-name: zoom;
  animation-duration: 0.6s;
}

@-webkit-keyframes zoom {
  from {-webkit-transform:scale(0)} 
  to {-webkit-transform:scale(1)}
}

@keyframes zoom {
  from {transform:scale(0)} 
  to {transform:scale(1)}
}

/* The Close Button */
.close {
  position: absolute;
  top: 15px;
  right: 35px;
  color: #f1f1f1;
  font-size: 40px;
  font-weight: bold;
  transition: 0.3s;
}

.close:hover,
.close:focus {
  color: #bbb;
  text-decoration: none;
  cursor: pointer;
}

/* 100% Image Width on Smaller Screens */
@media only screen and (max-width: 700px){
  .modal-content {
    width: 100%;
  }
}
  </style>  
  
<?php
 $query_user = $this->db->where('ids', $_SESSION['user_ids'])->get('user', 1)->row();
 $query_role = $this->db->where('ids', $query_user->role_ids)->get('role', 1)->row();
?>
 <style>
 .scrollbaru
{
	
	/*height: 300px;
	width: 65px;*/
	background: #F5F5F5;
	overflow-y: scroll;
	margin-bottom: 25px;
}

.force-overflow
{
	max-height:500px!important;overflow:auto!important;
}
.style-8::-webkit-scrollbar-track
{
	-webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
	background-color: #F5F5F5;
	
}

.style-8::-webkit-scrollbar
{
	width: 5px;
	background-color: #F5F5F5;
}

.style-8::-webkit-scrollbar-thumb
{
	
	background-color: #0ae;
	
	background-image: -webkit-gradient(linear, 0 0, 0 100%,
	                   color-stop(.5, rgba(255, 255, 255, .2)),
					   color-stop(.5, transparent), to(transparent));
}

.sidesnav {
  height: 100%;
  width: 270px !important;
  position: sticky;
  z-index: 1;
  top: 0;
  left: 0;
  background-color: #111;
  overflow-x: hidden;
  padding-top: 20px;
}

.sidesnav aq {
  padding: 6px 8px 6px 16px;
  text-decoration: none;
  font-size: 25px;
  color: #818181;
  display: block;
}


.main {
  margin-left: 160px; /* Same as the width of the sidesnav */
  
  padding: 0px 10px;
}


@media screen and (max-height: 450px) {
  .sidesnav {padding-top: 15px;}
  
}


table.datatable thead th.no-sort {
    background: none;
    pointer-events: none;
}

.table thead,
.table th {text-align: center;}


 </style>
  
  <?php if (!empty($this->setting->dashboard_custom_css)) { ?>
    <link type="text/css" href="<?=$this->setting->dashboard_custom_css?>" rel="stylesheet">
  <?php } ?>
  <script src="<?=base_url()?>assets/themes/default/vendor/jquery/jquery.min.js"></script>
</head>

<body id="page-top">
  <div id="wrapper">
    <!--<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">-->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion force-overflow style-8 sidesnav" id="accordionSidebar" style="max-height:700px!important;overflow:auto!important;">
    
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="javascript:void(0)">
        <div class="sidebar-brand-icon">
          <img src="<?=base_url($this->setting->cmp_logo)?>" class="icon-view" style="height: 50px!important; width: 200px!important;">
        </div>
        <!--<div class="sidebar-brand-text mx-3"><?=my_esc_html($this->setting->sys_name)?></div>-->
      </a>
      <hr class="sidebar-divider my-0">
	 
	  
	 <?php my_load_view($this->setting->theme, 'sidebar_menu')?>
	  
	  
	  <?php ($this->router->fetch_class() == 'dashboard') ? $active = ' active' : $active = ''; ?>
     <!--  <li class="nav-item<?=my_esc_html($active)?>">
        <a class="nav-link" href="<?=base_url('dashboard')?>">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span><?php  my_caption('menu_sidebar_dashboard')?></span></a>
      </li> -->
	  <?php
	    if ($this->front_end) { ?>
          <li class="nav-item">
            <a class="nav-link" href="<?=base_url('home')?>">
            <i class="fab fa-artstation"></i>
            <span><?=my_caption('menu_sidebar_website')?></span></a>
          </li>
      <?php } ?>
	  <!-- <hr class="sidebar-divider"> -->
     <!--  <div class="sidebar-heading">
        <?=my_caption('menu_sidebar_user_panel')?>
      </div> -->
	  <?php
	    // show user panel
	    // echo my_menu_display($menu_user_panel, 'user_panel');
	    //show admin panel
		if ($menu_admin_panel_display == 1) {
			// $admin_panel_header = '<hr class="sidebar-divider"><div class="sidebar-heading">' . my_caption('menu_sidebar_admin_panel') . '</div>';
			// echo my_esc_html($admin_panel_header . my_menu_display($menu_admin_panel, 'admin_panel'));
		}
	  ?>
	  
      <!-- <hr class="sidebar-divider d-none d-md-block"> -->
      <li class="nav-item">
        <a class="nav-link" href="javascript:void(0)" onclick="actionQuery('<?=my_caption('global_signout_query_title')?>', '<?=my_caption('global_signout_query_text')?>', '', '<?=base_url('generic/sign_out')?>')">
          <i class="fa fa-sign-out-alt" style="color:white"></i>
          <span><?=my_caption('menu_sidebar_topbar_signout')?></span>
		</a>
      </li>
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>
    </ul>
	
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
          <i class="fa fa-bars" aria-hidden="true" id="sidebarToggles" style="    font-size: 23px;"></i>
          <div class="sidebar-brand-text mx-3"><h2><?=my_esc_html($this->setting->sys_name)?></h2></div>
          
          <!--
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>
		  <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="input-group">
              <input type="text" id="keyword" name="keyword" class="form-control bg-light border-0 small" placeholder="Search something..." aria-label="Search" aria-describedby="basic-addon2">
              <div class="input-group-append">
                <button class="btn btn-primary" type="button">
                  <i class="fas fa-search fa-sm"></i>
                </button>
              </div>
            </div>
		  </form>
		  -->
		  <?php
		  if ($this->setting->maintenance_mode) {?>
		    <span class="text-danger font-weight-bold"><?=my_caption('menu_topbar_maintenance_mode')?></span>
          <?php } 
		  if (!empty($_SESSION['impersonate'])) {
		  ?>
		    <span class="text-danger font-weight-bold"><?=my_caption('user_impersonate_impersonating')?>, <a href="<?=base_url('admin/stop_impersonating')?>" class="text-danger font-weight-bold"><u><?=my_caption('user_impersonate_return')?></u></a></span>
		  <?php } ?>
		  <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown no-arrow d-sm-none">
              <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
              </a>
              <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                  <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="<?=my_caption('menu_topbar_search_placeholder')?>" aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="button">
                        <i class="fas fa-search fa-sm"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </li>
            <!--<li class="nav-item dropdown no-arrow mx-1">
              <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-bell"></i>
				  <?php
				    if ($this->new_notification_tag) {
						echo '<span class="badge badge-danger badge-counter">New</span>';
					}
				  ?>
              </a>
              <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header">
                  <?=my_caption('menu_sidebar_notification')?>
                </h6>
				<?php
				if (!empty($this->rs_notification)) {
				  foreach ($this->rs_notification as $row) {
				?>
                <a class="dropdown-item d-flex align-items-center" href="<?=base_url('user/my_notification_view/' . $row->ids)?>">
                  <div class="mr-3">
                    <div class="icon-circle bg-primary">
                      <i class="fas fa-file-alt text-white"></i>
                    </div>
                  </div>
                  <div>
                    <div class="small text-gray-500"><?=my_conversion_from_server_to_local_time($row->created_time, $this->user_timezone, $this->user_dtformat)?></div>
                    <span class="font-weight-bold"><?=my_esc_html($row->subject)?></span>
                  </div>
                </a>
                <?php
				  }
				}
				$img_url = base_url('upload/avatar/' . $this->user_avatar) . '?dummy=' . random_string('alnum', 6);
				?>
                <a class="dropdown-item text-center small text-gray-500" href="<?=base_url('user/my_notification')?>"><?=my_caption('menu_topbar_show_all_notifications')?></a>
              </div>
            </li>-->
            <div class="topbar-divider d-none d-sm-block"></div>
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<img class="img-profile rounded-circle mr-3" src="<?=my_esc_html($img_url)?>">
				<!--<span class="mr-2 d-none d-lg-inline text-gray-600 small">  <?php echo my_caption('menu_topbar_welcome_back') . ', ' . $_SESSION['full_name']?></span>-->
				
				<span class="mr-2 d-none d-lg-inline text-gray-600 small">  <?php echo 'Welcome , <br>' . $_SESSION['full_name']?></span>
				
				
			  </a>
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item mb-2" href="<?=base_url('user/my_profile')?>">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  <?=my_caption('menu_sidebar_topbar_my_profile')?>
                </a>
                <a class="dropdown-item mb-2" href="<?=base_url('user/change_password')?>">
                  <i class="fa fa-key fa-sm fa-fw mr-2 text-gray-400"></i>
                  <?=my_caption('menu_sidebar_topbar_change_password')?>
                </a>
                <a class="dropdown-item mb-2" href="<?=base_url('user/my_activity_log')?>">
                  <i class="fa fa-table fa-sm fa-fw mr-2 text-gray-400"></i>
                  <?=my_caption('menu_sidebar_topbar_my_activity_log')?>
                </a>
                <div class="dropdown-divider"></div>
                <a href="javascript:void(0)" class="dropdown-item" onclick="actionQuery('<?=my_caption('global_signout_query_title')?>', '<?=my_caption('global_signout_query_text')?>', '', '<?=base_url('generic/sign_out')?>')">
                  <i class="fa fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  <?=my_caption('menu_sidebar_topbar_signout')?>
                </a>
              </div>
            </li>
			<div class="topbar-divider d-none d-sm-block"></div>
          </ul>
		  <!--<div> 
		    <?php
			  $language = get_cookie('site_lang', TRUE);
			  if (!$language) {
				  $language = $this->config->item('language');
				  my_set_language_cookie($language);
			  }
			  $data = array(
			    'id' => 'language_switcher',
			    'class' => 'form-control selectpicker'
			  );
			  echo form_dropdown('language_switcher', my_supported_language(), ucfirst(my_esc_html($language)), $data);
			?>
          </div>-->
        </nav>