<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php my_load_view($this->setting->theme, 'header')?>
<script src="http://applexindia.com/cms/assets/themes/default/vendor/jquery/jquery.min.js"></script>
<div class="container-fluid">
  <h1 class="h3 mb-4 text-gray-800">Menu Allocation</h1>
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
		    <a class="btn btn-light btn-block" href="<?=base_url('company/details/'.$ids)?>">Detail</a>
		  <hr class="dotted">
		    <a class="btn btn-primary btn-block" href="<?=base_url('company/menu_allocation/'.$ids)?>">Menu Allocation</a>
		  <hr class="dotted">
		  
		</div>
      </div>
	</div>
	<div class="col-lg-9">
	   <?php echo form_open(base_url('company/updatemenuallocation/'.$ids), ['method'=>'POST']); ?>
	    <div class=" text-right">
    	  <button type="submit" class="btn btn-success mr-3">Update Menu</button>
    	</div>
    	
    	<table class="table table-striped" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>
                            <div class="checkbox c-checkbox ">
                                <label class="needsclick" data-toggle="tooltip" data-placement="top"
                                       title="select all permission">
                                    <input id="select_all" type="checkbox">
                                    
                                    <strong>Menu Name</strong>
                                </label>
                            </div>
                        </th>
                        <th>
                            <div class="checkbox c-checkbox ">
                                <label class="needsclick" data-toggle="tooltip" data-placement="top"
                                       title="View Help">
                                    <input id="select_all_view" type="checkbox">
                                    
                                    <strong>Permission</strong>
                                </label>
                            </div>
                        </th>
                        
                        
                       
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $menu_info = $this->db->where('menu_status !=', 2)->order_by('menu_id')->get('menu')->result();  //$checkper = $this->Global_model->check_permission($valmenu['menu_id'],$role);
                    foreach ($menu_info as $items) {
                        $menu['parents'][$items->menu_parent][] = $items;   
                        ?>
                        <script type="text/javascript">
                            $(document).ready(function () {
                               
                               <?php if($items->menu_name == 'Dashboard' ){?>
                                $('#<?= $items->menu_id?>').prop('checked', true);
                                $('.<?= $items->menu_id?>').prop('checked', true);
                                $('.<?= $items->menu_id?>').prop('disabled', true);
                                $('.view .<?= $items->menu_id?>').prop('disabled', false);
                                $(".<?= $items->menu_id?>").next().css('display', 'none');
                                $(".view .<?= $items->menu_id?>").next().css('display', 'block');
                                <?php }?>
                                $('#select_all').change(function () {
                                    var c = this.checked;
                                    $(':checkbox').prop('checked', c);
                                });

                                //select select_all_view
                                $("#select_all_view").change(function () {  //"select all" change
                                    $(".view > input").prop('checked', $(this).prop("checked")); //change all ".checkbox" checked status
                                    var values = $(".view > input").map(function () {
                                        if ($(".view > input").is(":checked")) {
                                            $("#" + this.value).prop('checked', true);
                                        } else {
                                            if ($('.' + this.value + ':checked').length == 0) {
                                                $("#" + this.value).prop('checked', false);
                                            }
                                        }
                                    }).get();
                                });
                                
                                //select all checkboxes
                                $("#<?= $items->menu_id;?>").change(function () {  //"select all" change
                                    $(".<?= $items->menu_id;?>").prop('checked', $(this).prop("checked")); //change all ".checkbox" checked status
                                });
                                if ($("input#<?= $items->menu_id;?>").is(':checked')) {
                                    $('.c_<?= $items->menu_id;?>').show();
                                    $("#parent_<?= $items->menu_id;?>").addClass('minus');
                                    $("#parent_<?= $items->menu_id;?>").removeClass('plus');
                                }
                                $("#parent_<?= $items->menu_id;?>").click(function () {
                                    $("#parent_<?= $items->menu_id;?>").toggleClass('minus');
                                    $("#parent_<?= $items->menu_id;?>").toggleClass('plus');
                                    $('.c_<?= $items->menu_id;?>').slideToggle('fast');
                                });
                                //".checkbox" change
                                $('.<?= $items->menu_id;?>').change(function () {
                                    //check "select all" if all checkbox items are checked
                                    if ($('.<?= $items->menu_id;?>:checked').length) {
                                        $("#<?= $items->menu_id;?>").prop('checked', true);
                                    }
                                    if ($('.<?= $items->menu_id;?>:checked').length == 0) {
                                        $("#<?= $items->menu_id;?>").prop('checked', false); //change "select all" checked status to false
                                    }
                                });
                            });
                        </script>

                    <?php }
                    $CI =& get_instance();  
                    $all_menus = $CI->buildChild(0, $menu);
                    if (!empty($all_menus)) {
                        foreach ($all_menus as $parent => $v_parent) { 
                            
                            $menuidget = $this->db->get_where('menu',array('menu_name'=>$parent))->row_array();
                            $check_menu = $this->company_model->checkMenuAllocation($menuidget['menu_id'],$ids); 
                            
                            
                            if (is_array($v_parent)) { // if this have child
                                if (!empty($v_parent)) {
                                    foreach ($v_parent as $parent_id => $v_child) { ?>
                                        <style type="text/css">
                                            .plus {
                                                background: url(https://applexindia.com/finalvrspms/asset/img/icon_plus.png) no-repeat 4px 5px;
                                                background-size: 8px 8px;
                                            }

                                            .minus {
                                                background: url(https://applexindia.com/finalvrspms/asset/img/icon_minus.png) no-repeat 4px 8px;
                                                background-size: 8px 2px;
                                            }

                                            .parent {
                                                width: 100%;
                                                margin-top: 6px;
                                                cursor: pointer;
                                            }

                                            .parent span {
                                                visibility: hidden;
                                            }

                                            .child {
                                                display: none
                                            }
                                        </style>
                                        <tr style="background: #e2e2e2;">
                                            <th>
                                                
                                                <div class="row">
                                                    <div class="col-md-1">
                                                        <div id="parent_<?= $parent_id; ?>" class="parent plus pull-left">
                                                    <span>X</span></div>
                                                    </div>
                                                    <div class="col-md-11" style="margin-left: -4%;">
                                                        <div class="checkbox c-checkbox pull-left">
                                                    <label class="needsclick " data-toggle="tooltip"
                                                           data-placement="top"
                                                           title="Select All">
                                                        <input <?php
                                                        if (!empty($roll[$parent_id])) {
                                                            echo $roll[$parent_id] ? 'checked' : '';
                                                        }
                                                        ?> id="<?php if (!empty($parent_id)) {
                                                            echo $parent_id;
                                                        } ?>" type="checkbox" name="menu[]" value="<?= $parent_id; ?>">
                                                        
                                                        <strong><?=$parent;?></strong>
                                                    </label>
                                                </div>
                                                    </div>
                                                </div>
                                                
                                                
                                                
                                                
                                            </th>
                                            <th>
                                                <div class="checkbox c-checkbox ">
                                                    <label class="needsclick view" data-toggle="tooltip"
                                                           data-placement="top"
                                                           title="Select All">
                                                        <input id="all_vewper_<?php if (!empty($parent_id)) {
                                                            echo $parent_id;
                                                        } ?>" class="<?php if (!empty($parent_id)) {
                                                            echo $parent_id;
                                                        } ?>" type="checkbox" name="vewper_<?= $parent_id ?>"
                                                               value="<?= $parent_id ?>"      >
                                                        
                                                    </label>
                                                </div>
                                            </th>
                                            
                                        </tr>
                                        <?php
                                        if (!empty($v_child)) {
                                            foreach ($v_child as $child => $v_sub_child) {  
                                                
                                                $menuidgets = $this->db->get_where('menu',array('menu_name'=>$child))->row_array();  
                                                
                                                $check_menu = $this->company_model->checkMenuAllocation($menuidgets['menu_id'],$ids);  
                                                 
                                                if (is_array($v_sub_child)) {
                                                    foreach ($v_sub_child as $sub_chld => $v_sub_chld) { ?>
                                                        <tr style="background: #eeeeee">
                                                            <td style="display: block;padding-left: 70px;">
                                                                <div id="parent_<?= $sub_chld; ?>"
                                                                     class="parent plus pull-left">
                                                                    <span>X</span></div>
                                                                <div class="checkbox c-checkbox pull-left">
                                                                    <label class="needsclick " data-toggle="tooltip"
                                                                           data-placement="top"
                                                                           title="Select All">
                                                                        <input  class="<?= $parent_id; ?>"
                                                                           id="<?= $sub_chld; ?>" type="checkbox"
                                                                           name="menu[]" value="<?= $sub_chld; ?>"  >
                                                                        
                                                                        <strong><?=$child;?></strong>
                                                                    </label>
                                                                </div>
                                                            </td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                        <?php
                                                        foreach ($v_sub_chld as $sub_chld_name => $sub_chld_id) {
                                                            if (is_array($sub_chld_id)) {
                                                                foreach ($sub_chld_id as $sub_chld_1 => $v_sub_chld_1) { ?>
                                                                    <tr style="background: #e2e2e2">
                                                                        <td style="display: block;padding-left: 60px;">
                                                                            <div id="parent_<?= $sub_chld_1; ?>"
                                                                                 class="parent plus pull-left">
                                                                                <span>X</span></div>
                                                                            <div class="checkbox c-checkbox pull-left">
                                                                                <label class="needsclick "
                                                                                       data-toggle="tooltip"
                                                                                       data-placement="top"
                                                                                       title="Select All">
                                                                                    <input
                                                                                        
                                                                                        class="<?= $parent_id . ' ' . $sub_chld; ?>"
                                                                                        id="<?= $sub_chld_1; ?>"
                                                                                        type="checkbox" name="menu[]"
                                                                                        value="<?= $sub_chld_1; ?>">
                                                                                        
                                                                                    
                                                                                    <strong><?= $sub_chld_name; ?></strong>
                                                                                </label>
                                                                            </div>
                                                                        </td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                    </tr>
                                                                    <?php
                                                                    foreach ($v_sub_chld_1 as $sub_chld_name_1 => $v_sub_chld_2) {
                                                                        if (is_array($v_sub_chld_2)) {
                                                                            foreach ($v_sub_chld_2 as $sub_chld_name_2 => $v_sub_chld_3) {
                                                                                ?>
                                                                                <tr style="background: #eeeeee">
                                                                                    <td style="display: block;padding-left: 85px;">
                                                                                        <div
                                                                                            id="parent_<?= $sub_chld_name_2; ?>"
                                                                                            class="parent plus pull-left">
                                                                                            <span>X</span></div>
                                                                                        <div
                                                                                            class="checkbox c-checkbox pull-left">
                                                                                            <label class="needsclick "
                                                                                                   data-toggle="tooltip"
                                                                                                   data-placement="top"
                                                                                                   title="Select All">
                                                                                                <input
                                                                                                    
                                                                                                    class="<?= $parent_id . ' ' . $sub_chld . ' ' . $sub_chld_1; ?>"
                                                                                                    id="<?= $sub_chld_name_2; ?>"
                                                                                                    type="checkbox"
                                                                                                    name="menu[]"
                                                                                                    value="<?= $sub_chld_name_2; ?>">
                                                                                                    
                                                                                        <span
                                                                                            class="fa fa-check"></span>
                                                                                                <strong><?= $sub_chld_name_1; ?></strong>
                                                                                            </label>
                                                                                        </div>
                                                                                    </td>
                                                                                    <td></td>
                                                                                    <td></td>
                                                                                    <td></td>
                                                                                </tr>
                                                                                <?php
                                                                                foreach ($v_sub_chld_3 as $sub_chld_name_3 => $v_sub_chld_4) {
                                                                                    if (is_array($v_sub_chld_4)) {

                                                                                    } else {
                                                                                        ?>
                                                                                        <tr class="child c_<?= $sub_chld_name_2; ?>">
                                                                                            <td style="display: block;padding-left: 110px">
                                                                                                <div
                                                                                                    class="checkbox c-checkbox">
                                                                                                    <label
                                                                                                        class="needsclick "
                                                                                                        data-toggle="tooltip"
                                                                                                        data-placement="top"
                                                                                                        title="Select">
                                                                                                        <input id="<?= $v_sub_chld_4; ?>"
                                                                                                           class="<?= $parent_id . ' ' . $sub_chld . ' ' . $sub_chld_name_2 . ' ' . $sub_chld_1; ?>"
                                                                                                           type="checkbox"
                                                                                                           name="menu[]"
                                                                                                           value="<?= $v_sub_chld_4; ?>">
                                                                                                
                                                                                                        <strong><?= $sub_chld_name_3; ?></strong>
                                                                                                    </label>
                                                                                                </div>
                                                                                            </td>
                                                                                            <td>
                                                                                                <div
                                                                                                    class="checkbox c-checkbox ">
                                                                                                    <label
                                                                                                        class="needsclick view"
                                                                                                        data-toggle="tooltip"
                                                                                                        data-placement="top"
                                                                                                        title="View Help">
                                                                                                        <input
                                                                                                            
                                                                                                            class="<?= $sub_chld . ' ' . $v_sub_chld_4 . ' ' . $sub_chld_name_2 . ' ' . $parent_id . ' ' . $sub_chld_1; ?>"
                                                                                                            type="checkbox"
                                                                                                            name="vewper_<?= $v_sub_chld_4; ?>"
                                                                                                            value="<?= $v_sub_chld_4; ?>">
                                                                                                
                                                                                                    </label>
                                                                                                </div>
                                                                                            </td>
                                                                                            <td>
                                                                                                <div
                                                                                                    class="checkbox c-checkbox ">
                                                                                                    <label
                                                                                                        class="needsclick create"
                                                                                                        data-toggle="tooltip"
                                                                                                        data-placement="top"
                                                                                                        title="Can Create">
                                                                                                        <input
                                                                                                            class="<?= $sub_chld . ' ' . $v_sub_chld_4 . ' ' . $sub_chld_name_2 . ' ' . $parent_id . ' ' . $sub_chld_1; ?>"
                                                                                                            type="checkbox"
                                                                                                            name="created_<?= $v_sub_chld_4; ?>"
                                                                                                            value="<?= $v_sub_chld_4; ?>">
                                                                                                
                                                                                                    </label>
                                                                                                </div>
                                                                                            </td>
                                                                                            <td>
                                                                                                <div
                                                                                                    class="checkbox c-checkbox">
                                                                                                    <label
                                                                                                        class="needsclick edit"
                                                                                                        data-toggle="tooltip"
                                                                                                        data-placement="top"
                                                                                                        title="Can Edit">
                                                                                                        <input 
                                                                                                            class="<?= $sub_chld . ' ' . $v_sub_chld_4 . ' ' . $sub_chld_name_2 . ' ' . $parent_id . ' ' . $sub_chld_1; ?>"
                                                                                                            type="checkbox"
                                                                                                            name="edtper_<?= $v_sub_chld_4; ?>"
                                                                                                            value="<?= $v_sub_chld_4; ?>">
                                                                                                
                                                                                                    </label>
                                                                                                </div>
                                                                                            </td>
                                                                                            <td>
                                                                                                <div
                                                                                                    class="checkbox c-checkbox">
                                                                                                    <label
                                                                                                        class="needsclick delete"
                                                                                                        data-toggle="tooltip"
                                                                                                        data-placement="top"
                                                                                                        title="Can Delete">
                                                                                                        <input class="<?= $sub_chld . ' ' . $v_sub_chld_4 . ' ' . $sub_chld_name_2 . ' ' . $parent_id . ' ' . $sub_chld_1; ?>"
                                                                                                           type="checkbox"
                                                                                                           name="delper_<?= $v_sub_chld_4; ?>"
                                                                                                           value="<?= $v_sub_chld_4; ?>">
                                                                                                
                                                                                                    </label>
                                                                                                </div>
                                                                                            </td>
                                                                                        </tr>
                                                                                        <?php
                                                                                    }
                                                                                }
                                                                            }
                                                                        } else { ?>
                                                                            <tr class="child c_<?= $sub_chld_1; ?>">
                                                                                <td style="display: block;padding-left: 85px">
                                                                                    <div class="checkbox c-checkbox ">
                                                                                        <label class="needsclick "
                                                                                               data-toggle="tooltip"
                                                                                               data-placement="top"
                                                                                               title="Select">
                                                                                            <input  id="<?= $v_sub_chld_2; ?>"
                                                                                               class="<?= $parent_id . ' ' . $sub_chld . ' ' . $sub_chld_1; ?>"
                                                                                               type="checkbox"
                                                                                               name="menu[]"
                                                                                               value="<?= $v_sub_chld_2; ?>">
                                                                                        <span
                                                                                            class="fa fa-check"></span>
                                                                                            <strong><?= $sub_chld_name_1; ?></strong>
                                                                                        </label>
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="checkbox c-checkbox ">
                                                                                        <label class="needsclick view"
                                                                                               data-toggle="tooltip"
                                                                                               data-placement="top"
                                                                                               title="View Help">
                                                                                            <input 
                                                                                                class="<?= $sub_chld . ' ' . $parent_id . ' ' . $v_sub_chld_2 . ' ' . $sub_chld_1; ?>"
                                                                                                type="checkbox"
                                                                                                name="vewper_<?= $v_sub_chld_2; ?>"
                                                                                                value="<?= $v_sub_chld_2; ?>">
                                                                                        <span
                                                                                            class="fa fa-check"></span>
                                                                                        </label>
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="checkbox c-checkbox ">
                                                                                        <label class="needsclick create"
                                                                                               data-toggle="tooltip"
                                                                                               data-placement="top"
                                                                                               title="Can Create">
                                                                                            <input 
                                                                                                class="<?= $sub_chld . ' ' . $parent_id . ' ' . $v_sub_chld_2 . ' ' . $sub_chld_1; ?>"
                                                                                                type="checkbox"
                                                                                                name="created_<?= $v_sub_chld_2; ?>"
                                                                                                value="<?= $v_sub_chld_2; ?>">
                                                                                        <span
                                                                                            class="fa fa-check"></span>
                                                                                        </label>
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="checkbox c-checkbox">
                                                                                        <label class="needsclick edit"
                                                                                               data-toggle="tooltip"
                                                                                               data-placement="top"
                                                                                               title="Can Edit">
                                                                                            <input class="<?= $sub_chld_1 . ' ' . $sub_chld . ' ' . $v_sub_chld_2 . ' ' . $parent_id; ?>"
                                                                                               type="checkbox"
                                                                                               name="edtper_<?= $v_sub_chld_2; ?>"
                                                                                               value="<?= $v_sub_chld_2; ?>">
                                                                                        <span
                                                                                            class="fa fa-check"></span>
                                                                                        </label>
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="checkbox c-checkbox">
                                                                                        <label class="needsclick delete"
                                                                                               data-toggle="tooltip"
                                                                                               data-placement="top"
                                                                                               title="Can Delete">
                                                                                            <input 
                                                                                                class="<?= $sub_chld_1 . ' ' . $sub_chld . ' ' . $v_sub_chld_2 . ' ' . $parent_id; ?>"
                                                                                                type="checkbox"
                                                                                                name="delper_<?= $v_sub_chld_2; ?>"
                                                                                                value="<?= $v_sub_chld_2; ?>">
                                                                                        <span
                                                                                            class="fa fa-check"></span>
                                                                                        </label>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                            <?php
                                                                        }
                                                                    }
                                                                }
                                                            } else { ?>
                                                                <tr class="child c_<?= $sub_chld; ?>">
                                                                    <td style="display: block;padding-left: 60px">
                                                                        <div class="checkbox c-checkbox ">
                                                                            <label class="needsclick "
                                                                                   data-toggle="tooltip"
                                                                                   data-placement="top"
                                                                                   title="Select">
                                                                                <input id="<?= $sub_chld_id; ?>"
                                                                                   class="<?= $parent_id . ' ' . $sub_chld; ?>"
                                                                                   type="checkbox"
                                                                                   name="menu[]"
                                                                                   value="<?= $sub_chld_id; ?>">
                                                                                
                                                                                <strong><?= $sub_chld_name; ?></strong>
                                                                            </label>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="checkbox c-checkbox ">
                                                                            <label class="needsclick view"
                                                                                   data-toggle="tooltip"
                                                                                   data-placement="top"
                                                                                   title="View Help">
                                                                                <input class="<?= $sub_chld . ' ' . $sub_chld_id . ' ' . $parent_id; ?>"
                                                                                   type="checkbox"
                                                                                   name="vewper_<?= $sub_chld_id; ?>"
                                                                                   value="<?= $sub_chld_id; ?>">
                                                                                
                                                                            </label>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="checkbox c-checkbox ">
                                                                            <label class="needsclick create"
                                                                                   data-toggle="tooltip"
                                                                                   data-placement="top"
                                                                                   title="Can Create">
                                                                                <input 
                                                                                    class="<?= $sub_chld . ' ' . $sub_chld_id . ' ' . $parent_id; ?>"
                                                                                    type="checkbox"
                                                                                    name="created_<?= $sub_chld_id; ?>"
                                                                                    value="<?= $sub_chld_id; ?>">
                                                                                
                                                                            </label>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="checkbox c-checkbox">
                                                                            <label class="needsclick edit"
                                                                                   data-toggle="tooltip"
                                                                                   data-placement="top"
                                                                                   title="Can Edit">
                                                                                <input 
                                                                                    class="<?= $sub_chld . ' ' . $sub_chld_id . ' ' . $parent_id; ?>"
                                                                                    type="checkbox"
                                                                                    name="edtper_<?= $sub_chld_id; ?>"
                                                                                    value="<?= $sub_chld_id; ?>">
                                                                                
                                                                            </label>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="checkbox c-checkbox">
                                                                            <label class="needsclick delete"
                                                                                   data-toggle="tooltip"
                                                                                   data-placement="top"
                                                                                   title="Can Delete">
                                                                                <input 
                                                                                    class="<?= $sub_chld . ' ' . $sub_chld_id . ' ' . $parent_id; ?>"
                                                                                    type="checkbox"
                                                                                    name="delper_<?= $sub_chld_id; ?>"
                                                                                    value="<?= $sub_chld_id; ?>">
                                                                                
                                                                            </label>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <?php
                                                            }
                                                        }
                                                    }
                                                } else { ?>
                                                    <tr class="child c_<?= $parent_id; ?>">
                                                        <td style="display: block;padding-left: 70px;">
                                                            <div class="checkbox c-checkbox ">
                                                                <label class="needsclick " data-toggle="tooltip"
                                                                       data-placement="top"
                                                                       title="Select">
                                                                    <input  id="<?= $v_sub_child; ?>"
                                                                       <?php if($check_menu == '1') { echo "checked"; }?>
                                                                       class="<?= $parent_id; ?>"
                                                                       type="checkbox"
                                                                       name="menu[]" value="<?= $v_sub_child; ?>">
                                                                    
                                                                    <strong><?=$child;?></strong>
                                                                </label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="checkbox c-checkbox ">
                                                                <label class="needsclick view" data-toggle="tooltip"
                                                                       data-placement="top"
                                                                       title="View Help">
                                                                    <input  class="<?= $parent_id . ' ' . $v_sub_child; ?>"
                                                                    
                                                                    <?php if($check_menu == '1') { echo "checked"; }?>
                                                                     
                                                                       type="checkbox"
                                                                       name="vewper_<?= $v_sub_child; ?>"
                                                                       value="<?= $v_sub_child; ?>">
                                                                    
                                                                </label>
                                                            </div>
                                                        </td>
                                                        
                                                    </tr>
                                                <?php }
                                            }
                                        } ?>

                                    <?php }
                                }
                            } else { ?>
                                <tr>
                                    <td>
                                        <div class="checkbox c-checkbox ">
                                            <label class="needsclick " data-toggle="tooltip" data-placement="top"
                                                   title="Select">
                                                <input id="<?= $v_parent; ?>" type="checkbox" name="menu[]"
                                                       value="<?= $v_parent; ?>"
                                                       <?php if($check_menu == '1') { echo "checked";}?>
                                                >
                                                
                                                <strong><?=$parent;?></strong>
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="checkbox c-checkbox ">
                                            <label class="needsclick view" data-toggle="tooltip"
                                                   data-placement="top"
                                                   title="View Help">
                                                <input id="<?= $v_parent; ?>"
                                                    <?php if($check_menu == '1') { echo "checked";}?>
                                                       class="<?= $v_parent; ?>" type="checkbox"
                                                       name="vewper_<?= $v_parent; ?>"
                                                       value="<?= $v_parent; ?>">
                                                
                                            </label>
                                        </div>
                                    </td>
                                    
                                </tr>
                            <?php }
                        }
                    }
                    ?>

                    </tbody>
                </table>
    	<?php echo form_close(); ?>
    	
    	
	</div>
  </div>
</div>

<?php my_load_view($this->setting->theme, 'footer')?>