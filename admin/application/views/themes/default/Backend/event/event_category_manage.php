
<?php  
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php  my_load_view($this->setting->theme, 'header')?>
   
<?php 


$page_uri = $this->uri->segment(3);
if(!isset($info_data))
{
    $page_name = 'Event Category Create';
    $formurl = base_url('events/managescategory/');
    $btnnms = my_caption('menu_new_create_button');
    
    $evt_titles = '';
   
     
}
else
{
    $page_name = 'Event Category Edit';
    $formurl = base_url('events/managescategory/'.$info_data->event_cat_id);
    $btnnms = my_caption('menu_update_button');
    
    $evt_titles = $info_data->event_cat_name;
   
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
			  <label><span class="text-danger">*</span> Category Name</label>
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
		    
		    <div class="col-lg-12">
			  <label><span class="text-danger">*</span> Is J4E Meet</label><br>
			    <?php if(isset($info_data)){?>  
			    <input type="radio" id="html" name="is_global" value="1"  <?php if($info_data->event_j4e_meet == '1'){echo "checked";}?> >
                <label for="html">Yes</label><br>
                <input type="radio" id="css" name="is_global" value="2" <?php if($info_data->event_j4e_meet == '2'){echo "checked";}?> >
                <label for="2">No</label><br>
			  
			    <?php } else { ?>
			    <input type="radio" id="html" name="is_global" value="1">
                <label for="html">Yes</label><br>
                <input type="radio" id="css" name="is_global" value="2" checked>
                <label for="2">No</label><br>
			    <?php } ?>
			  
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
			  <a href="#" onclick="window.location.reload(true);"><button type="button" id="reset_btn" class="btn mr-2">Reset</button></a>
			    <a href="javascript:window.history.go(-1);"><button type="button" id="cancel_btn" class="btn mr-2">Cancel</button></a>
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
<script>   
Dropzone.autoDiscover = false;//var myDropzone = new Dropzone("div#myDrop", { url: "/file/post"});


var newfileif = '<?php echo $fileranno;?>';  

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
                    thumbnailWidth: 80,
                    thumbnailHeight: 80,
                    parallelUploads: 20,
                    previewTemplate: previewTemplate,
                    dictDefaultMessage: '<h2>Drag files to upload<br>(or click)<h2>',
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

            });
        </script>
		