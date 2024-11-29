<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php my_load_view($this->setting->theme, 'header')?>
<div class="container-fluid">
  <h1 class="h3 mb-4 text-gray-800">Company Detail</h1>
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
		  
		  <hr class="dotted">
		    <a class="btn btn-primary btn-block" href="<?=base_url('company/details'.$ids)?>">Detail</a>
		  <hr class="dotted">
		    <a class="btn btn-light btn-block" href="<?=base_url('company/menu_allocation/'.$ids)?>">Menu Allocation</a>
		  <hr class="dotted">
		  
		</div>
      </div>
	</div>
	<div class="col-lg-9">
	  
	</div>
  </div>
</div>

<?php my_load_view($this->setting->theme, 'footer')?>