<?php   
defined('BASEPATH') OR exit('No direct script access allowed');
$ci=& get_instance();
//$total_rate_review = 0;
$star_one = ($one_star*100)/$total_rate_review;  
$star_two = ($two_star*100)/$total_rate_review;  
$star_three = ($three_star*100)/$total_rate_review;  
$star_four = ($four_star*100)/$total_rate_review;  
$star_five = ($five_star*100)/$total_rate_review;  
?>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
* {
  box-sizing: border-box;
}


.fa {
  font-size: 25px;
}

.checked {
  color: orange;
}

/* Three column layout */
.side {
  float: left;
  width: 15%;
  margin-top:10px;
}

.middle {
  margin-top:10px;
  float: left;
  width: 70%;
}

/* Place text to the right */
.right {
  text-align: right;
}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}

/* The bar container */
.bar-container {
  width: 100%;
  background-color: #f1f1f1;
  text-align: center;
  color: white;
}

/* Individual bars */
.bar-5 {width: <?=$star_five;?>%; height: 18px; background-color: #04AA6D;}
.bar-4 {width: <?=$star_four;?>%; height: 18px; background-color: #2196F3;}
.bar-3 {width: <?=$star_three;?>%; height: 18px; background-color: #00bcd4;}
.bar-2 {width: <?=$star_two;?>%; height: 18px; background-color: #ff9800;}
.bar-1 {width: <?=$star_one;?>%; height: 18px; background-color: #f44336;}

/* Responsive layout - make the columns stack on top of each other instead of next to each other */
@media (max-width: 400px) {
  .side, .middle {
    width: 100%;
  }
  .right {
    display: none;
  }
}
.main-section{
background:#FFFFFF;
width:80%;
margin: 0 auto;
padding: 10px;
margin-top:50px;
box-shadow:0px 2px 7px 1px #aa9191;
}
.hedding-title h1{
margin:0px;
padding:0px 0px 10px 0px;
font-size:25px;
}
.average-rating{
float:left;
text-align: center;
width:30%;
}
.average-rating h2{
margin:0px;
font-size:80px;
}
.average-rating p{
margin:0px;
font-size:20px;
}
.fa-star,.fa-star-o,.fa-star-half-o{
color:#FDC91B;
font-size:25px !important;
}
.progress,.progress-2,.progress-3,.progress-4,.progress-5{
background:#F5F5F5;
border-radius: 13px;
height:18px;
width:97%;
padding:3px;
margin:5px 0px 3px 0px;
}
.progress:after,.progress-2:after,.progress-3:after,.progress-4:after,.progress-5:after{
content: '';
display: block;
background: #337AB7;
width:80%;
height: 100%;
border-radius: 9px;
}
.progress-2:after{
width: 60%;
}
.progress-3:after{
width:40%;
}
.progress-4:after{
width:20%;
}
.progress-5:after{
width:10%;
}
.loder-ratimg{
display: inline-block;
width:40%;
}
.start-part{
float:right;
width:30%;
text-align: center;
}
.start-part span{
color:#337AB7;
font-size:23px;
}
.reviews h1{
margin:10px 0px 20px 30px;
}
.user-img img{
height: 80px;
width: 80px;
border:1px solid blue;
border-radius: 50%;
}
.user-img-part{
width:100%;
float:left;
}
.user-img{
width:48%;
float:left;
text-align: center;
}
.user-text{
float:left;
}
.user-text h4,.user-text p{
margin:0px 0px 5px 0px;
}
.user-text p{
font-size: 20px;
font-weight: bold;
}
.user-text h4,.user-text span{
color:#B3B5B4;
}
.comment{
/*width:68%;
float:right;
width:*/
}
</style>
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
		  
		  <!--
		   <hr class="dotted">
		    <a class="btn btn-light btn-block" href="<?=base_url('users/managesdetail/'.$userids)?>">User Detail</a>-->
		   <hr class="dotted">
		    <a class="btn btn-light btn-block" href="<?=base_url('users/managesaboutus/'.$userids)?>">About Us </a>
		   <hr class="dotted">
		    <a class="btn btn-light btn-block" href="<?=base_url('users/managescontactus/'.$userids)?>">Contact Us</a>
		   <hr class="dotted">
		   <hr class="dotted">
		    <a class="btn btn-light btn-block" href="<?=base_url('users/managesgallery/'.$userids)?>">Gallery</a>
		   <hr class="dotted">
		   <hr class="dotted">
		    <a class="btn btn-primary btn-block" href="<?=base_url('users/managesratereview/'.$userids)?>">Reviews</a>
		   <hr class="dotted">
		   
		  
		  
		</div>
      </div>
	</div>
	<div class="col-lg-9">
	     <div class="card shadow mb-4">
	    <div class="card-header py-3">
		  
		  <div class="row">
            <div class="col-lg-6 text-left">
        	  <h6 class="m-0 font-weight-bold text-primary">View User Rate Review</h6>
        	</div>
            <div class="col-lg-6 text-right">
        	  
        	  
            </div>
          </div>
		  
		  
		  
		  
        </div>
        <div class="card-body">
		  <div class="">
		    
		    <div class="row">
		        <div class="col-md-12">
		            
                    <span class="heading">User Rating</span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star"></span>
                    <p><?= $avegare_rat;?> average based on <?= $total_rate_review;?> reviews.</p>
                    <hr style="border:3px solid #f1f1f1">
                    
                    <div class="row">
                      <div class="side">
                        <div>5 star</div>
                      </div>
                      <div class="middle">
                        <div class="bar-container">
                          <div class="bar-5"></div>
                        </div>
                      </div>
                      <div class="side right">
                        <div><?=$five_star;?> / <?= $total_rate_review;?></div>
                      </div>
                      <div class="side">
                        <div>4 star</div>
                      </div>
                      <div class="middle">
                        <div class="bar-container">
                          <div class="bar-4"></div>
                        </div>
                      </div>
                      <div class="side right">
                        <div><?=$four_star;?> / <?= $total_rate_review;?></div>
                      </div>
                      <div class="side">
                        <div>3 star</div>
                      </div>
                      <div class="middle">
                        <div class="bar-container">
                          <div class="bar-3"></div>
                        </div>
                      </div>
                      <div class="side right">
                        <div><?=$three_star;?> / <?= $total_rate_review;?></div>
                      </div>
                      <div class="side">
                        <div>2 star</div>
                      </div>
                      <div class="middle">
                        <div class="bar-container">
                          <div class="bar-2"></div>
                        </div>
                      </div>
                      <div class="side right">
                        <div><?=$two_star;?> / <?= $total_rate_review;?></div>
                      </div>
                      <div class="side">
                        <div>1 star</div>
                      </div>
                      <div class="middle">
                        <div class="bar-container">
                          <div class="bar-1"></div>
                        </div>
                      </div>
                      <div class="side right">
                        <div><?=$one_star;?> / <?= $total_rate_review;?></div>
                      </div>
                    </div>
                    
                    
		        </div>
		        
		    </div>
		    
		    <div class="row">
		        <div class="col-md-12">
		           <hr> 
                   <div class="reviews"><h3>Reviews</h3></div>
                      <?php foreach($review_note as $val_note){?>
                       <div class="comment-part">
                           <div class="user-img-part">
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="user-img">
                                           <img src="<?= $val_note['profile_img'];?>">
                                        </div> <div style="clear: both;"></div><br>
                                        <h6><?= $val_note['review_time'];?></h6>
                                    </div>
                                    <div class="col-md-10">
                                        <div class="user-text">
                                          <p><?= $val_note['reviewed_by'];?></p>    
                                          
                                           <div class="comment">
                                                <i aria-hidden="true" class="fa fa-star"></i>
                                                <i aria-hidden="true" class="fa fa-star"></i>
                                                <i aria-hidden="true" class="fa fa-star"></i>
                                                <i aria-hidden="true" class="fa fa-star"></i>
                                                <i aria-hidden="true" class="fa fa-star-o"></i>
                                                <p><?= ucwords($val_note['review_note']);?></p>
                                           </div>
                                           
                                        </div>
                                    </div>
                                </div>
                                
                                
                                
                                
                                
                                
                               
                           </div>
                           
                       
                      </div>
                      <div style="clear: both;"></div>
                      <hr>
                      <?php } ?>
                </div>

		    </div>
		    
		    
		    
          </div>
		</div>
      </div>
	</div> 
  </div>
</div>

<?php my_load_view($this->setting->theme, 'footer')?>