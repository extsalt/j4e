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
		  
		   <hr class="dotted">
		    <a class="btn btn-primary btn-block" href="<?=base_url('post/managesdetail/'.$poost_ids)?>">Post Detail</a>
		   <hr class="dotted">
		    <a class="btn btn-light btn-block" href="<?=base_url('post/manageslike/'.$poost_ids)?>">Post Likes (<?= $ci->getpostliketotal($poost_ids);?>)</a>
		   <hr class="dotted">
		    <a class="btn btn-primary btn-block" href="<?=base_url('post/managescomment/'.$poost_ids)?>">Post Comments (<?= $ci->getpostcommenttotal($poost_ids);?>)</a>
		   <hr class="dotted">
		    
		  
		  
		</div>
      </div>
	</div>
	<div class="col-lg-9">
	     <div class="card shadow mb-4">
	    <div class="card-header py-3">
		  
		  <div class="row">
            <div class="col-lg-6 text-left">
        	  <h6 class="m-0 font-weight-bold text-primary">View Post Likes List</h6>
        	</div>
            <div class="col-lg-6 text-right">
        	  
        	  
            </div>
          </div>
		  
		  
		  
		  
        </div>
        <div class="card-body">
		  <div class="table-responsive">
		    <table id="sort" class="table table-bordered">
			  <thead>
			    <tr>
			      <th>Sr No</th>  
				  <th>User Name</th>
			    </tr>
			  </thead>
			  <tbody>
			      <?php foreach($info_data as $key=>$valdata){
			        $link = $valdata->post_like_dislike_id;
			        
			      ?>
			       <tr>
			           <td ><?= ($key + 1);?></td>
			           <td ><?= $ci->getusername($valdata->post_like_dislike_userid);?></td>
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