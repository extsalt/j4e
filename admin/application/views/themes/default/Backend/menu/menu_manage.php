
<?php  
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php  my_load_view($this->setting->theme, 'header')?>
    
<?php 

$page_uri = $this->uri->segment(3);
if(!isset($menu_info))
{
    $page_name = my_caption('menu_add_title');
    $formurl = base_url('Globalfile/managesmenu');
    $btnnms = my_caption('menu_new_create_button'); 
}
else
{
    $page_name = my_caption('menu_edit_title');
    $formurl = base_url('Globalfile/managesmenu/'.$menu_info['ids']);
    $btnnms = my_caption('menu_update_button');
}

?>
<div class="container-fluid">
  <h1 class="h3 mb-4 text-gray-800"><?=$page_name?></h1>

  <div class="row">
    <div class="col-lg-8">
	  <?php
	    my_load_view($this->setting->theme, 'Generic/show_flash_card');
	  ?>
	  <div class="card shadow mb-4">
	    <div class="card-header py-3">
		  <h6 class="m-0 font-weight-bold text-primary"><?=$page_name;?></h6>
        </div>
        <div class="card-body">
		  <?php
		    echo form_open($formurl, ['method'=>'POST']);
		  ?>
		  
		  <input type="hidden" id="base_url" name="base_url" value="<?=base_url()?>">
		  <div class="row form-group mb-4">
		    
		    <div class="col-lg-6">
			  <label><span class="text-danger">*</span> Menu Label</label>
			  <input type="text" class="form-control" name="menu_name" value="<?php if(isset($menu_info)){ echo $menu_info['menu_name']; }?>" required/>
			</div>
		    
		    <div class="col-lg-6">
			  <label><span class="text-danger">*</span> Menu Link</label>
			  <input type="text" class="form-control" name="links" value="<?php if(isset($menu_info)){ echo $menu_info['menu_link']; }?>" required/>
			</div>
		  </div>
		  <div class="row form-group mb-4">
			
		    <div class="col-lg-6">
			  <label><span class="text-danger">*</span> Menu Icon</label>
			  <input class="form-control icp icp-auto" data-input-search="true" value="fas fa-th-list" type="text" required/>
			    <div class="panel-footer" style="display:none;">
                    <button class="btn btn-danger action-destroy_iconss">Destroy instances</button>
                    <button class="btn btn-default action-create_iconss">Create instances</button>
                </div>
			</div>
			<div class="col-lg-6">
			  <label> Menu Parent</label>
			  <select class="form-control selectpicker"  name="parents">
			      <option value=""></option>
			      <?php foreach($menu_data as $valmenu){?>
			      <option value="<?=$valmenu['menu_id'];?>" <?php if(isset($menu_info)){ if($menu_info['menu_parent'] == $valmenu['menu_id']){ echo "selected"; } }?> ><?=$valmenu['menu_name'];?></option>
			      <?php }?>
			  </select>
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

<?php my_load_view($this->setting->theme, 'footer')?>
<script src="<?=base_url();?>FONTDATA/dist/js/fontawesome-iconpicker.js"></script>
<script>
  $(function () {
    $('.action-destroy_iconss').on('click', function () {
      $.iconpicker.batch('.icp.iconpicker-element', 'destroy');
    });
    // Live binding of buttons
    $(document).on('click', '.action-placement', function (e) {
      $('.action-placement').removeClass('active');
      $(this).addClass('active');
      $('.icp-opts').data('iconpicker').updatePlacement($(this).text());
      e.preventDefault();
      return false;
    });
    $('.action-create_iconss').on('click', function () {
      $('.icp-auto').iconpicker();

      $('.icp-dd').iconpicker({
        //title: 'Dropdown with picker',
        //component:'.btn > i'
      });
      $('.icp-opts').iconpicker({
        title: 'With custom options',
        icons: [
          {
            title: "fab fa-github",
            searchTerms: ['repository', 'code']
          },
          {
            title: "fas fa-heart",
            searchTerms: ['love']
          },
          {
            title: "fab fa-html5",
            searchTerms: ['web']
          },
          {
            title: "fab fa-css3",
            searchTerms: ['style']
          }
        ],
        selectedCustomClass: 'label label-success',
        mustAccept: true,
        placement: 'bottomRight',
        showFooter: true,
        // note that this is ignored cause we have an accept button:
        hideOnSelect: true,
        // fontAwesome5: true,
        templates: {
          footer: '<div class="popsover-footer">' +
          '<div style="text-align:left; font-size:12px;">Placements: \n\
<a href="#" class=" action-placement">inline</a>\n\
<a href="#" class=" action-placement">topLeftCorner</a>\n\
<a href="#" class=" action-placement">topLeft</a>\n\
<a href="#" class=" action-placement">top</a>\n\
<a href="#" class=" action-placement">topRight</a>\n\
<a href="#" class=" action-placement">topRightCorner</a>\n\
<a href="#" class=" action-placement">rightTop</a>\n\
<a href="#" class=" action-placement">right</a>\n\
<a href="#" class=" action-placement">rightBottom</a>\n\
<a href="#" class=" action-placement">bottomRightCorner</a>\n\
<a href="#" class=" active action-placement">bottomRight</a>\n\
<a href="#" class=" action-placement">bottom</a>\n\
<a href="#" class=" action-placement">bottomLeft</a>\n\
<a href="#" class=" action-placement">bottomLeftCorner</a>\n\
<a href="#" class=" action-placement">leftBottom</a>\n\
<a href="#" class=" action-placement">left</a>\n\
<a href="#" class=" action-placement">leftTop</a>\n\
</div><hr></div>'
        }
      }).data('iconpicker').show();
    }).trigger('click');


    // Events sample:
    // This event is only triggered when the actual input value is changed
    // by user interaction
    $('.icp').on('iconpickerSelected', function (e) {
      $('.lead .picker-target').get(0).className = 'picker-target fa-3x ' +
        e.iconpickerInstance.options.iconBaseClass + ' ' +
        e.iconpickerInstance.options.fullClassFormatter(e.iconpickerValue);
    });
  });
</script>