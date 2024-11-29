
<?php  
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php  my_load_view($this->setting->theme, 'header')?>
    <link href="<?=base_url()?>assets/themes/default/vendor/dropzone/dropzone.min.css" type="text/css" rel="stylesheet" />
    
    <!--<link href="<?=base_url()?>assets/dropzone/dropzone.min.css" type="text/css" rel="stylesheet" />-->
    <script src="<?=base_url()?>assets/dropzone/dropzone.min.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/dropzone/dropzone.custom.min.js"></script>   
<?php 

if(isset($img_info))
{
   $eventsid = $img_info->img_typeid;
}
elseif(isset($eventid) && $eventid !='')
{
   $eventsid =$eventid;
}



$page_uri = $this->uri->segment(3);
if(!isset($evt_info))
{
    $page_name = 'Event Create';
    $formurl = base_url('events/managesevent/'.$eventsid);
    $btnnms = my_caption('menu_new_create_button');
    
    $evt_titles = '';
    $evt_catids = '';
    (set_value('evt_desc') == '') ? $blog_body = '' : $blog_body = set_value('evt_desc');  
    $evt_addresss = '';
    $event_start_dates = '';
    $event_start_times = '';
    $event_end_dates = '';
    $event_end_times = '';
    $evt_qtys = '';
    $evt_fees = '';
    $evt_guest_fees = ''; 
    $evt_permission = array();
    $chapterid = 0;
     
}
else
{
    $page_name = 'Event Edit';
    $formurl = base_url('events/managesevent/'.$evt_info->event_id);
    $btnnms = my_caption('menu_update_button');
    
    //echo date("g:i a", strtotime(substr($evt_info->event_enddate,17,19)));  
   
    
    $evt_titles = $evt_info->event_title;
    $evt_catids = $evt_info->event_cat_id;
    (set_value('evt_desc') == '') ? $blog_body = $evt_info->event_description : $blog_body = set_value('evt_desc');  
    $evt_addresss = $evt_info->event_address;
    $event_start_dates = date("Y-m-d",strtotime(substr($evt_info->event_startdate,4,12)));
    $event_start_times = date("H:i", strtotime(substr($evt_info->event_startdate,17,19)));  
    $event_end_dates = date("Y-m-d",strtotime(substr($evt_info->event_enddate,4,12)));
    $event_end_times = date("H:i", strtotime(substr($evt_info->event_enddate,17,19))); 
    $evt_qtys = $evt_info->event_ticketqty;
    $evt_fees = $evt_info->event_fees;
    $evt_guest_fees = $evt_info->event_guestfees;
    $evt_permission = explode(',',$evt_info->event_permission);
    $chapterid = $evt_info->event_organizeby;
}

?>
<div class="container-fluid">
  <!--<h1 class="h3 mb-4 text-gray-800"><?=$page_name?></h1>-->

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
		    
		    <div class="col-lg-12">
			  <label><span class="text-danger">*</span>Event Title</label>
			  <?php
			    (!empty(set_value('event_title'))) ? $event_title = set_value('event_title') : $event_title = $evt_titles;
			    
			    $data = array(
				  'name' => 'event_title',
				  'id' => 'event_title',
				  'value' => $event_title,
				  'class' => 'form-control'
				);
				echo form_input($data);
				echo form_error('event_title', '<small class="text-danger">', '</small>');
			  ?>
			  
			</div>
		    
		    
		    
		  </div>
		  
		  
		  <div class="row form-group mb-4">
		    
		    <div class="col-lg-3">
			  <label><span class="text-danger">*</span>Type to Event</label>
			  <select class="form-control selectpicker" name="event_cat_id" id="event_cat_id" data-live-search="true">
			      <option value="0">Select Type to Event</option>
			      <?php foreach($cat_data as $val_evt){?>
			        <?php
                                
			         if(set_value('event_cat_id')){?>
			         <option value="<?=$val_evt['event_cat_id'];?>" <?php if(!empty(set_value('event_cat_id'))) { if(set_value('event_cat_id') == $val_evt['event_cat_id']) { echo "selected"; }}   ?> ><?=$val_evt['event_cat_name'];?></option>
			         
			         <?php }
			         
			         elseif(isset($evt_catids) && $evt_catids !=''){?>
			         <option value="<?=$val_evt['event_cat_id'];?>" <?php if($evt_catids == $val_evt['event_cat_id']) { echo "selected"; }  ?> ><?=$val_evt['event_cat_name'];?></option>
			         <?php }
			         else {?>
			         <option value="<?=$val_evt['event_cat_id'];?>" ><?=$val_evt['event_cat_name'];?></option>
			      <?php } }?>
			  </select>
			  <?php echo form_error('event_cat_id', '<small class="text-danger">', '</small>');?>
			
			 
			</div>
		    
		    <div class="col-lg-3">
			  <label><span class="text-danger">*</span> Member Fees</label>
			  <?php
			    (!empty(set_value('evt_fee'))) ? $evt_fee = set_value('evt_fee') : $evt_fee = $evt_fees;
			    
			    $data = array(
				  'name' => 'evt_fee',
				  'id' => 'evt_fee',
				  'value' => $evt_fee,
				  'class' => 'form-control numberonly'
				);
				echo form_input($data);
				echo form_error('evt_fee', '<small class="text-danger">', '</small>');
			  ?>
			  
			</div>
			
			<div class="col-lg-3">
			  <label><span class="text-danger">*</span> Guest Fees</label>
			  <?php
			    (!empty(set_value('evt_guest_fee'))) ? $evt_guest_fee = set_value('evt_guest_fee') : $evt_guest_fee = $evt_guest_fees;
			    
			    $data = array(
				  'name' => 'evt_guest_fee',
				  'id' => 'evt_guest_fee',
				  'value' => $evt_guest_fee,
				  'class' => 'form-control numberonly'
				);
				echo form_input($data);
				echo form_error('evt_guest_fee', '<small class="text-danger">', '</small>');
			  ?>
			  
			</div>
			
			
		    
		    <div class="col-lg-3">
			  <label><span class="text-danger">*</span> Ticket Qty</label>
			  <?php
			    (!empty(set_value('evt_qty'))) ? $evt_qty = set_value('evt_qty') : $evt_qty = $evt_qtys;
			    $data = array(
				  'name' => 'evt_qty',
				  'id' => 'evt_qty',
				  'value' => $evt_qty,
				  'class' => 'form-control numberonly'
				);
				echo form_input($data);
				echo form_error('evt_qty', '<small class="text-danger">', '</small>');
			  ?>
			</div>
		  </div>
		  
		  
		  
		  <div class="row form-group mb-4">
		    
		    <div class="col-lg-3">
			  <label><span class="text-danger">*</span> Start Date</label>
			  <?php
			    (!empty(set_value('event_start_date'))) ? $event_start_date = set_value('event_start_date') : $event_start_date = $event_start_dates;
			    $data = array(
				  'name' => 'event_start_date',
				  'id' => 'event_start_date',
				  'value' => $event_start_date,
				  'type'=>'date',
				  'class' => 'form-control datechoosen'
				);
				echo form_input($data);
				echo form_error('event_start_date', '<small class="text-danger">', '</small>');
			  ?>
			</div>
			
			<div class="col-lg-3">
			  <label><span class="text-danger">*</span> Start Time</label>
			  <?php
			    (!empty(set_value('event_start_time'))) ? $event_start_time = set_value('event_start_time') : $event_start_time = $event_start_times;
			    $data = array(
				  'name' => 'event_start_time',
				  'id' => 'event_start_time',
				  'value' => $event_start_time,
				  'type'=>'time',
				  'class' => 'form-control datechoosen'
				);
				echo form_input($data);
				echo form_error('event_start_time', '<small class="text-danger">', '</small>');
			  ?>
			</div>
			
		    <div class="col-lg-3">
			  <label><span class="text-danger">*</span> End Date</label>
			  <?php
			    (!empty(set_value('event_end_date'))) ? $event_end_date = set_value('event_end_date') : $event_end_date = $event_end_dates;
			    $data = array(
				  'name' => 'event_end_date',
				  'id' => 'event_end_date',
				  'value' => $event_end_date,
				  'type'=>'date',
				  'class' => 'form-control datechoosen'
				);
				echo form_input($data);
				echo form_error('event_end_date', '<small class="text-danger">', '</small>');
			  ?>
			</div>
		
			<div class="col-lg-3">
			  <label><span class="text-danger">*</span> End Time</label>
			  <?php
			    (!empty(set_value('event_end_time'))) ? $event_end_time = set_value('event_end_time') : $event_end_time = $event_end_times;
			    $data = array(
				  'name' => 'event_end_time',
				  'id' => 'event_end_time',
				  'value' => $event_end_time,
				  'type'=>'time',
				  'class' => 'form-control datechoosen'
				);
				echo form_input($data);
				echo form_error('event_end_time', '<small class="text-danger">', '</small>');
			  ?>
			</div>
			
		  
		  </div>
		  
		  <div class="row form-group mb-4">
		    
		    <div class="col-lg-6">
			  <label><span class="text-danger">*</span> Venue</label>
			  <?php
			    (!empty(set_value('evt_address'))) ? $evt_address = set_value('evt_address') : $evt_address = $evt_addresss;
			    
			    $data = array(
				  'name' => 'evt_address',
				  'id' => 'evt_address',
				  'value' => $evt_address,
				  'class' => 'form-control'
				);
				echo form_input($data);
				echo form_error('evt_address', '<small class="text-danger">', '</small>');
			  ?>
			</div>
			
			<div class="col-lg-6">
			  <label><span class="text-danger">*</span> Event Permission </label>
			  <select name="event_permisssion[]" id="ep" class="form-control" multiple required>
			      <?php
			        $package_info = $this->db->get('packages')->result();
			        if(!empty($package_info))
			        {
			            foreach($package_info as $val)
			            {
			     ?>
			     <option value="<?= $val->pack_id ?>" <?= (in_array($val->pack_id,$evt_permission))?'selected':'' ?>><?= $val->pack_name ?></option>
			     <?php
			            }
			        }
			      ?>
			  </select>
			</div>
		    
		    
		  </div>
		  
		  
		  
		  <div class="row form-group mb-4">
		    
		    <div class="col-lg-12">
			  <label><span class="text-danger">*</span> Description</label>
			  <input type="hidden" name="blog_body_value" id="blog_body_value" value="<?=my_esc_html($blog_body)?>">
			  <textarea id="blog_body" name="dec_eng"></textarea>
			  <?=form_error('dec_eng', '<small class="text-danger">', '</small>')?>
			</div>
		    
		    
		  </div>
		  
		  
		  
		  <div class="row form-group mb-4">	
			
			<div class="col-lg-6 row">
    			<div class="col-md-6">
    			   <label><?php if(!isset($evt_info)){ ?><span class="text-danger">*</span> <?php } ?>Event Image (only jpeg/jpg/png/svg)</label> 
        		  
        		  <div class="custom-file">
                     <input accept="image/x-png,image/jpeg" id="infopic" onchange="frontcoverName()"  name="infopic" type="file">
                     <label for="Image" id="fcoverlabel" class="form-control"  style="overflow:auto;display:none;">Image</label>
                     <span style="color:red;font-size:10px;">Max. File Size : 1MB</span>
                  </div>
                  <?=form_error('infopic', '<small class="text-danger">', '</small>')?>
			    </div>
			    
			    <div class="col-md-6">
			        <?php  if(isset($evt_info) && $evt_info->event_thumbnil != ''){ ?>
			          <div class="image-area">
    			          <img id="fcover" src="<?=base_url().'upload/events/'.$evt_info->event_thumbnil;?>" style="width: 150px;height:150px;border: 1px solid black;" class="obj-fit-cov">
    			          <a href="javascript:void(0)" class="btn btn-danger  btn-flat btn-sm remove-image" onclick="actionQuery('Delete', 'Are you sure delete this Image?', '<?=base_url('events/removesingleeventimage/'.$evt_info->event_id)?>')"><i class="fa fa-times"></i></a><br>
    			      </div>    
			             
			        <?php } else {?>
			         <img id="fcover" src="<?=base_url();?>upload/no_image.jpg" style="width: 150px;height:150px;border: 1px solid black;" class="obj-fit-cov">
                    <?php } ?>
                        
			    </div>
			</div>
		
           </div>
		  
		  
		  
		  
		  
		  <div class="form-group">
                    <div class="col-sm-12">
                        <div id="file-dropzone" class="dropzone mb15">

                        </div>
                        <div id="file-dropzone-scrollbar">
                            <div id="file-previews" class="row">
                                <div id="file-upload-row" class="col-sm-2 mt file-upload-row">
                                    <div class="preview box-content pr-lg" style="width:100px;">
                                        <img data-dz-thumbnail class="upload-thumbnail-sm"/>
                                        <div class="mb progress progress-striped upload-progress-sm active mt-sm"
                                             role="progressbar" aria-valuemin="0" aria-valuemax="100"
                                             aria-valuenow="0">
                                            <div class="progress-bar progress-bar-success" style="width:0%;"
                                                 data-dz-uploadprogress></div>
                                        </div>
                                    </div>
                                    <div class="box-content">
                                        <p class="clearfix mb0 p0">
                                            <span class="name pull-left" data-dz-name></span>
                                    <span data-dz-remove class="pull-right" style="cursor: pointer">
                                    <i class="fa fa-times"></i>
                                </span>
                                        </p>
                                        <p class="clearfix mb0 p0">
                                            <span class="size" data-dz-size></span>
                                        </p>
                                        <strong class="error text-danger" data-dz-errormessage style="font-size:10px!important;"></strong>
                                        <input class="file-count-field" type="hidden" name="files[]" value=""/>
                               
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
		  
		  
		  <?php if(isset($img_info)){?>
		  <div class="row form-group mb-4">	
			
			
    			
    			   <?php foreach($img_info as $val_img){?>
    			      <div class=" col-md-3 mb-4">
    			        <div class="image-area">
        			        <img id="" src="<?=base_url().'upload/events/event_details/'.$val_img->event_gallery_image;?>" style="position: relative;  width: 200px;height:150px;border: 1px solid black;" class="obj-fit-cov">
    			            <a href="javascript:void(0)" class="btn btn-danger btn-flat btn-sm remove-image" onclick="actionQuery('Delete', 'Are you sure delete this Image?', '<?=base_url('events/removeeventimage/'.$val_img->event_gallery_id.'/'.$evt_info->event_id)?>')"><i class="fa fa-times"></i></a>
    				    </div>
			          </div>
			       <?php } ?>    
			    
			    
			    
			
		
           </div> 
		  <?php } ?>
		  
		  
		  
		  
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
			    <a href="<?=base_url('events/manageevent');?>"><button type="button" id="cancel_btn" class="btn mr-2">Cancel</button></a>
			</div>
		  </div>
		  <?php echo form_close(); ?>
		</div>
      </div>
	</div>
  </div>
</div>

<?php my_load_view($this->setting->theme, 'footer');


$newdata = $this->session->set_userdata('filerandomno',my_random());    
// $this->session->set_userdata($session_array);
$fileranno = $_SESSION['filerandomno'];
?>

<?php  $image_limit = '0';
if(isset($img_info))
{
    $image_limit = count($img_info);
}
else
{
   $image_limit = '0';
}

?>



<script>   
Dropzone.autoDiscover = false;//var myDropzone = new Dropzone("div#myDrop", { url: "/file/post"});


var newfileif = '<?php echo $fileranno;?>';  
var finalimagecount = '10' - <?=$image_limit;?>;


         $(document).ready(function () {    
                fileSerial = 0;
                // Get the template HTML and remove it from the doumenthe template HTML and remove it from the doument
                var previewNode = document.querySelector("#file-upload-row");
                previewNode.id = "";
                var previewTemplate = previewNode.parentNode.innerHTML;
                previewNode.parentNode.removeChild(previewNode);
                Dropzone.autoDiscover = false;
                
                var base_url_use = $("input#base_url").val(); 
                
                var projectFilesDropzone = new Dropzone("div#file-dropzone", {  
                    url  : "<?= base_url();?>globalfile/upload_file/",
                    maxFiles: '10' - <?=$image_limit;?>,
                    acceptedFiles: ".jpeg,.jpg,.png,.gif,.svg",
                    thumbnailWidth: 80,
                    thumbnailHeight: 80,
                    parallelUploads: 10,
                    previewTemplate: previewTemplate,
                    dictDefaultMessage: '<h2>Add Gallery Image<br>(only jpeg / jpg / png / svg)<br>(or click)<h2>',
                    autoQueue: true,
                    previewsContainer: "#file-previews",
                    clickable: true,
                    accept: function (file, done) {
                        console.log(file);

                

                    var str1 = file.name;
                    var str2 = newfileif; 
                    var filenewname = str2.concat(str1);
               
                        if (filenewname.length > 200) {
                            done("Filename is too long.");
                            $(file.previewTemplate).find(".description-field").remove();
                        }
                        //validate the file
                        
                        
                        $.ajax({
                            url: "<?= base_url()?>globalfile/validate_project_file",
                            data: {file_name: filenewname, file_size: file.size, base_url:base_url_use},
                            cache: false,
                            type: 'POST',
                            dataType: "json",
                            success: function (response) {
                                if (response.success) {
                                    fileSerial++;  
                                    $(file.previewTemplate).append("<input type='hidden' name='file_name_" + fileSerial + "' value='" + filenewname + "' />\n\
                                     <input type='hidden' name='file_size_" + fileSerial + "' value='" + file.size + "' />");
                                    $(file.previewTemplate).find(".file-count-field").val(fileSerial);
                                    done();
                                } else {
                                    $(file.previewTemplate).find("input").remove();
                                    done(response.message);
                                }
                            }
                        });
                        
                    },
                    processing: function () {
                        //$("#file-save-btn").prop("disabled", true);
                    },
                    queuecomplete: function () {
                        //$("#file-save-btn").prop("disabled", false);
                    },
                    fallback: function () {
                        //add custom fallback;
                        $("body").addClass("dropzone-disabled");
                        //$('.modal-dialog').find('[type="submit"]').removeAttr('disabled');

                        $("#file-dropzone").hide();

                        $("#file-modal-footer").prepend("<button id='add-more-file-button' type='button' class='btn  btn-default pull-left'><i class='fa fa-plus-circle'></i> " + "<?php echo lang("add_more"); ?>" + "</button>");

                        $("#file-modal-footer").on("click", "#add-more-file-button", function () {
                            var newFileRow = "<div class='file-row pb pt10 b-b mb10'>"
                                + "<div class='pb clearfix '><button type='button' class='btn btn-xs btn-danger pull-left mr remove-file'><i class='fa fa-times'></i></button> <input class='pull-left' type='file' name='manualFiles[]' /></div>"
                                + "</div>";
                            $("#file-previews").prepend(newFileRow);
                        });
                        $("#add-more-file-button").trigger("click");
                        $("#file-previews").on("click", ".remove-file", function () {
                            $(this).closest(".file-row").remove();
                        });
                    },
                    success: function (file) {
                        setTimeout(function () {
                            $(file.previewElement).find(".progress-striped").removeClass("progress-striped").addClass("progress-bar-success");
                        }, 1000);
                    }
                });

                document.querySelector(".start-upload").onclick = function () {
                    projectFilesDropzone.enqueueFiles(projectFilesDropzone.getFilesWithStatus(Dropzone.ADDED));
                };
                document.querySelector(".cancel-upload").onclick = function () {
                    projectFilesDropzone.removeAllFiles(true);
                };
                initScrollbar("#file-dropzone-scrollbar", {setHeight: 280});
                
                $('#ep').selectpicker({
                });

            });
        </script>
<script type="text/javascript">
document.getElementById("infopic").onchange = function () {
var reader = new FileReader();

reader.onload = function (e) {
 // get loaded data and render thumbnail.
 document.getElementById("fcover").src = e.target.result;
 var fullPath=document.getElementById("infopic").value;
 var filename = fullPath.replace(/^.*[\\\/]/,'');
     
 document.getElementById("fcoverlabel").innerHTML = filename;
};

 // read the image file as a data URL.
 reader.readAsDataURL(this.files[0]);
};

function frontcoverName() 
{
  var fullPath = document.getElementById("infopic").src;
  var filename = fullPath.replace(/^.*[\\\/ '']/, '');
  document.getElementById("fcoverlabel").innerHTML = filename;
}
</script>  


