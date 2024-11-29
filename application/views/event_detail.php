<?php include 'header.php'; ?>
<?php include 'menu1.php'; ?>
<!-- START -->
<section class=" eve-deta-pg eve-deta-pg1">
    <div class="container">
        
        <div class="eve-deta-pg-main">
            <?php
                if($this->session->flashdata('message'))
                {
            ?>
            <div class="log-suc"><p><?= $this->session->flashdata('message') ?></p></div>
            <?php
                }
            ?>
                         <div class="lhs">
                <div class="img">
                    <img src="<?= base_url('admin/upload/events/'.$event_info->event_thumbnil) ?>" alt="" loading="lazy">
                    <span class="dat"><b><?= date('M',strtotime($event_info->event_date)) ?></b> <?= date('d',strtotime($event_info->event_date)) ?></span>
                </div>
                
            </div>
        </div>
    </div>
</section>
<!--END-->

<!-- START -->
<section class=" eve-deta-body">
    <div class="container">
        <div class="eve-deta-body-main">
            <div class="lhs">
               <div class="head">
<!--                   <div class="eve-bred-crum">
                        <ul>
                        <li><a href="<?= base_url('assets/') ?>">Home</a></li>
                        <li><a href="<?= base_url('assets/') ?>events">All Events</a></li>
                        <li><a href="#">places to hang out in new york</a></li>
                        </ul>
                    </div>-->
                    <h1><?= $event_info->event_title ?></h1>
                </div>
                <?= $event_info->event_description ?><br><br>
                <?php
                    if ($this->session->userdata('isLogIn'))
                    {
                        if($event_info->event_date > date('Y-m-d'))
                        {
                            $booking_info = $this->db->where(array('booking_userid'=>$this->session->userdata('userid'),'booking_eventid'=>$event_info->event_id))->get('event_booking')->result();
                            if(empty($booking_info))
                            {
                ?>
                <form action="<?= base_url('event_detail/'.$event_info->event_id) ?>" method="post">
                    <input type="hidden" name="event_id" value="<?= $event_info->event_id ?>">
                    <div class="list-sh">
                        <button class="share-new" id="rzp-button1" type="submit"> Book now</button>
                    </div>
                </form>
                <?php
                            }
                        }
                    }
                ?>
                
            </div>
            <div class="rhs">
                <div class="sec-1">
                    <h4>Event information:</h4>
                    <ul>
                        <li><b>Category</b>: <?= empty($event_info->event_cat_id)?'-':$this->db->where('event_cat_id',$event_info->event_cat_id)->get('event_category')->row()->event_cat_name ?></li>
                        <li><b>Start Date</b>: <?= $event_info->event_startdate ?></li>
                        <li><b>End Date</b>: <?= $event_info->event_startdate ?></li>
                        <li><b>Address</b>: <?= $event_info->event_address ?></li>
                        <li><b>Event Fees</b>: <?= '₹'.$event_info->event_fees ?></li>
                        <li><b>Guest Fees</b>: <?= '₹'.$event_info->event_guestfees ?></li>
                        <?php
                            if($this->session->userdata('isLogIn'))
                            {
                                $booking_info = $this->db->where(array('booking_userid'=>$this->session->userdata('userid'),'booking_eventid'=>$event_info->event_id))->get('event_booking')->result();
                                if(empty($booking_info))
                                {
                        ?>
                        <li><b>Status</b>: Not Registered</li>
                        <?php
                                }
                                else
                                {
                        ?>
                        <li><b>Status</b>: Registered</li>
                        <?php
                                }
                            }
                        ?>
                                                </ul>
                </div>
<!--                <div class="sec-2">
                    <h4>Location</h4>
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d387193.305935303!2d-74.25986548248684!3d40.69714941932609!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c24fa5d33f083b%3A0xc80b8f06e177fe62!2sNew%20York%2C%20NY%2C%20USA!5e0!3m2!1sen!2sin!4v1637035426847!5m2!1sen!2sin" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>-->
<!--                <div class="sec-3">
                    <div class="pro-bad-sml">
                        <img
                            src="<?= base_url('assets/') ?>images/user/22287pexels-evg-culture-1055691.jpg" alt="" loading="lazy">
                        <h4>Joney Kenady</h4>
                        <b>Joined on 16, Nov 2021</b>
                        <a target="_blank"
                           href="<?= base_url('assets/') ?>profile/joney-kenady"
                           class="fclick">&nbsp;</a>
                    </div>
                </div>-->
            </div>
        </div>
        <?php
            $events = $this->db->where(array('event_status'=>1,'event_publish_status'=>1,'event_cat_id'=>$event_info->event_cat_id,'event_id !='=>$event_info->event_id))->get('events')->result();
            if(!empty($events))
            {
        ?>
        <div class="pro-rel-events">
            <h4>Related Events</h4>
            <div class="event-body">
                <div class="us-ppg-com">
                    <ul>
                        <?php
                            foreach($events as $val)
                        {
                ?>
                                        <li class="events-item">
                            <div class="eve-box">
                                <div>
                                    <a href="<?= base_url('event_detail/'.$val->event_id) ?>">
                                        <img src="<?= base_url('admin/upload/events/'.$val->event_thumbnil) ?>"
                                             alt="" loading="lazy">
                                    <span><?= date('M',strtotime($val->event_date)) ?>                                        <b><?= date('d',strtotime($val->event_date)) ?></b></span>
                                    </a>
                                </div>
                                <div>
                                    <h4>
                                        <a href="<?= base_url('event_detail/'.$val->event_id) ?>"><?= $val->event_title ?></a>
                                    </h4>
                                    <span
                                        class="addr">Address: <?= $val->event_address ?></span>
                                    <!--<span class="pho"><?= $val->event_date ?></span>-->
                                </div>
<!--                                <div>
                                    <div class="auth">
                                        <img
                                            src="<?= base_url('assets/') ?>images/user/1.jpg" alt="" loading="lazy">
                                        <b>Hosted by</b><br>
                                        <h4>Richflayer</h4>
                                        <a target="_blank"
                                           href="https://bizbookdirectorytemplate.com/profile/richflayer"
                                           class="fclick"></a>
                                    </div>
                                </div>-->
                            </div>
                        </li>
                        <?php
                        }
                          ?>  
                            
                    </ul>
                </div>
            </div>
        </div>
        <?php
            }
        ?>
    </div>
</section>
<!--END-->
<?php
    if($_POST)
    {
?>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<!--<form name='razorpayform' action="verify.php" method="POST">
    <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id">
    <input type="hidden" name="razorpay_signature"  id="razorpay_signature" >
</form>-->
<script>
// Checkout details as a json
var options = {
    "key"               : "<?= $key ?>",
    "amount"            : "<?= $amount ?>",
    "name"              : "J4E",
    "description"       : "J4E",
    "image"             : "https://cdn.razorpay.com/logos/FFATTsJeURNMxx_medium.png",
    "callback_url"      : "<?= base_url('home/book_event/'.$event_info->event_id) ?>",
    "prefill"           : {
    "name"              : "<?= $customer_info->first_name." ".$customer_info->last_name ?>",
    "email"             : "<?= $customer_info->email_address ?>",
    "contact"           : "<?= $customer_info->phone ?>"
    },
    "notes"             : {
    "address"           : "Hello World",
    "merchant_order_id" : "12312321"
    },
    "theme"             : {
    "color"             : "#99cc33"
    },
    "order_id"          : "<?= $order_data['id'] ?>"
};

/**
* The entire list of checkout fields is available at
* https://docs.razorpay.com/docs/checkout-form#checkout-fields
*/
//options.handler = function (response){
//    document.getElementById('razorpay_payment_id').value = response.razorpay_payment_id;
//    document.getElementById('razorpay_signature').value = response.razorpay_signature;
//    document.razorpayform.submit();
//};

// Boolean whether to show image inside a white frame. (default: true)
//options.theme.image_padding = false;

var rzp = new Razorpay(options);

document.getElementById('rzp-button1').onclick = function(e){
    rzp.open();
    e.preventDefault();
};
document.getElementById('rzp-button1').onclick();
</script>
<?php
    }
?>
   <?php include 'footer.php'; ?>     