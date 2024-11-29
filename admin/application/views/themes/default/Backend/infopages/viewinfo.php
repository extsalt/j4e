
<?php  
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php  my_load_view($this->setting->theme, 'header')?>
 <style>
     .accordion-container{
  position: relative;
  max-width: 500px;
  height: auto;
  margin: 10px auto;
}
.accordion-container > h2{
  text-align: center;
  color: #fff;
  padding-bottom: 5px;
  margin-bottom: 20px;
  padding-bottom: 15px;
  border-bottom: 1px solid #ddd;
}
.set{
  position: relative;
  width: 100%;
  height: auto;
  background-color: #f5f5f5;
}
.set > a{
  display: block;
  padding: 10px 15px;
  text-decoration: none;
  color: #555;
  font-weight: 600;
  border-bottom: 1px solid #ddd;
  -webkit-transition:all 0.2s linear;
  -moz-transition:all 0.2s linear;
  transition:all 0.2s linear;
}
.set > a i{
  float: right;
  margin-top: 2px;
}
.set > a.active{
  background-color:#3399cc;
  color: #fff;
}
.content{
  background-color: #fff;
  border-bottom: 1px solid #ddd;
  display:none;
}
.content p{
  padding: 10px 15px;
  margin: 0;
  color: #333;
}
 </style>   
<?php 

$page_uri = $this->uri->segment(3);

    
    
    
     


?>
<div class="container-fluid">
  

  <div class="row">
    <div class="col-lg-12">
	  	  <div class="card shadow mb-4">
        	    <div class="card-header py-3"> 
        		  <center><h3 class="m-0 font-weight-bold text-primary"><?=$page_title?></h3></center>
                </div>
                
                <div class="card-body">
        		   <?php if($page_type == '1'){
        		       $dec_engs = $data_info->infpg_desc_eng;
        		         echo $dec_engs;
        		         }
        		         else {
        		   ?>
        		        <div class="accordion-container">
                         <?php foreach($data_info as $val_info){?> 
                          <div class="set">
                            <a href="#">
                              <?=$val_info->faq_que;?>
                              <i class="fa fa-plus"></i>
                            </a>
                            <div class="content">
                             <?=$val_info->faq_ans;?>
                            </div>
                          </div>
                         <?php }?>
                        </div>
        		   <?php } ?>
        		</div>
          </div>
	</div>
  </div>









  
</div>

<?php my_load_view($this->setting->theme, 'footer')?>
<script>
    $(document).ready(function() {
  $(".set > a").on("click", function() {
    if ($(this).hasClass("active")) {
      $(this).removeClass("active");
      $(this)
        .siblings(".content")
        .slideUp(200);
      $(".set > a i")
        .removeClass("fa-minus")
        .addClass("fa-plus");
    } else {
      $(".set > a i")
        .removeClass("fa-minus")
        .addClass("fa-plus");
      $(this)
        .find("i")
        .removeClass("fa-plus")
        .addClass("fa-minus");
      $(".set > a").removeClass("active");
      $(this).addClass("active");
      $(".content").slideUp(200);
      $(this)
        .siblings(".content")
        .slideDown(200);
    }
  });
});

</script>
