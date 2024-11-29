<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>
<?php
  my_load_view($this->setting->theme, 'header');
 
?>
<style>
        .draggable-cursor * {
	cursor: move !important; /* fallback: no `url()` support or images disabled */
	cursor: -webkit-grabbing !important; /* Chrome 1-21, Safari 4+ */
	cursor:    -moz-grabbing !important; /* Firefox 1.5-26 */
	cursor:         grabbing !important; /* W3C standards syntax, should come least */
}
    </style>
        
    
    
    
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    
    <script type="text/javascript">

jQuery.noConflict();
  jQuery(function($) {
   $(window).on("load", function (e){  
      
var fixHelperModified = function(e, tr) {
    var $originals = tr.children();
    var $helper = tr.clone();
    $helper.children().each(function(index) {
        $(this).width($originals.eq(index).width());
        $(this).css('background-color', '#3b76a0');
    });
    return $helper;
},
    updateIndex = function(e, ui) {
        $('td.index', ui.item.parent()).each(function (i) {
            var res=$(this).html();
            var id1 = res.substring(72);
            var id = id1.split("-");
            var sno = i + 1;
            change_sqno(sno,id[0],'testimonials');
            $(this).html(sno);             
        });
        window.location.reload();
    };

$("#sort tbody").sortable({
    helper: fixHelperModified,
    start: function (evt) {
		$('html').addClass("draggable-cursor");
	},
    stop: updateIndex,
    handle: "i"
    
//	stop: function (evt) {
//		$('html').removeClass("draggable-cursor");
//	}
}).disableSelection();

    });
});
</script>
<input type="hidden" id="user_ids" name="user_ids" value="<?=my_uri_segment(3)?>">
<div class="container-fluid">
 <?php
  my_load_view($this->setting->theme, 'breadcum');
 
?>
 
  

  <div class="row">
    <div class="col-lg-12">
	  <?php my_load_view($this->setting->theme, 'Generic/show_flash_card');?>
	  <div class="card shadow mb-4">
	    <div class="card-header py-3">
		  <div class="row">
            <div class="col-lg-4 text-left">
              <h3 class="m-0 font-weight-bold text-primary">FAQ's List</h3>    
        	  
        	</div>
            <div class="col-lg-8 text-right">
        	  
        	  <button type="button" class="btn btn-primary mr-2" onclick="window.location.href='<?=base_url('infopages/managesfaq')?>'">Add FAQ's</button>
        	  
            </div>
          </div>
		  
		  
        </div>
        <div class="card-body">
		  <div class="table-responsive">
		    <table id="sort" class="table table-bordered exampletable">
			  <thead>
			    <tr>
			      <th style="width: 2%;">#</th>
			      <th style="width:4%;">Sr No</th>  
			      <th>Questions</th>
			      
				  <th style="width: 6%;"><?=my_caption('menu_actions')?></th>
			    </tr>
			  </thead>
			  <tbody>
			      <?php foreach($info_data as $key => $valdata){
			      $link = $valdata->faq_id;
			      ?>
			       <tr>
			            <td class="index" style="text-align: center;"><i class='fa fa-th'></i>  <?php echo "<div style='display:none;'>".$valdata->faq_id."-".$valdata->faq_sort."</div>"?></td>
			           <td><center><?=($key+'1'); ?></center></td>
			           <td><?=$valdata->faq_que;?></td>
			           
			           
			           <td>
			               <div class="btn-group">
				    	    
				    	       <a href="<?=base_url('infopages/managesfaq/'.$link)?>" class="btn btn-success btn-flat btn-sm"><i class="fa fa-edit"></i></a>
						     
						       <a href="javascript:void(0)" class="btn btn-danger btn-flat btn-sm" onclick="actionQuery('Delete', 'Are you sure delete this Faq?', '<?=base_url('infopages/deletefaq/'.$link)?>')"><i class="fa fa-trash"></i></a>
						     
						   </div>
			            
			           </td>
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

<script type="text/javascript">
//$('#datetimepicker1').datetimepicker({
//    format:'Y-m-d H:i',
//});
function change_sqno(str,str1,str2)
{
      //alert(str);
    $.ajax({       

	  url  : "<?= base_url();?>infopages/SortFaq/" +str2+ "/" + str +"/" + str1,
	 
	  success : function(data){
			  
			   window.location.reload();
		      
	  }	   
	  
   });    
      
      
      
      
      
      
      
      
     
}

</script>