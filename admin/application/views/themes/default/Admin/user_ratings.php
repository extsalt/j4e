<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php
  my_load_view($this->setting->theme, 'header');
  $caption_list_user = my_caption('global_are_you_sure') . '||';
  $caption_list_user .= my_caption('user_impersonate_confirm') . '||';
  $caption_list_user .= my_caption('user_sheet_signin');
?>
<input type="hidden" id="caption_list_user" name="caption_list_user" value="<?=my_esc_html($caption_list_user)?>">
<input type="hidden" id="user_ids" name="user_ids" value="<?=my_uri_segment(3)?>">
<div class="container-fluid">
  <div class="row">
    <div class="col-lg-4 text-left">
	  <h1 class="h3 mb-4 text-gray-800"><?=my_caption('user_ratings')?></h1>
	</div>
    <div class="col-lg-8 text-right">
	  
    </div>
  </div>

  <div class="row">
    <div class="col-lg-12">
	  <?php my_load_view($this->setting->theme, 'Generic/show_flash_card');?>
	  <div class="card shadow mb-4">
	    <div class="card-header py-3">
		  <h6 class="m-0 font-weight-bold text-primary"><?=my_caption('user_ratings')?></h6>
        </div>
        <div class="card-body">
		  <div class="table-responsive">
		    <table id="dataTable_user_ratings" class="table table-bordered">
			  <thead>
			    <tr>
				  <th><?=my_caption('user_sheet_status')?></th>
				  <th><?=my_caption('global_username')?></th>
				  <th><?=my_caption('average_ratings')?></th>
				  <th><?=my_caption('number_of_review')?></th>
				  <th><?=my_caption('global_actions')?></th>
			    </tr>
			  </thead>
			</table>
          </div>
		</div>
      </div>
	</div>
  </div>
</div>
<?php my_load_view($this->setting->theme, 'footer')?>
