<link href="<?= base_url() ?>assets/plugins/morris/morris.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://eshopweb.store/assets/admin/css/chartist.css">

<script src="https://cdn.jsdelivr.net/chartist.js/latest/chartist.min.js"></script>
    <link href="https//cdn.jsdelivr.net/chartist.js/latest/chartist.min.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="//cdn.jsdelivr.net/jquery/1/jquery.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />

<?php
defined('BASEPATH') OR exit('No direct script access allowed');




//print_r($rating_datas);exit();
/*
 $rating_data = array(
 array('Employee', 'Rating'),
 array('J4E Event',10),
 array('J4E Business Networking',0),
 array('Rahul',37),
 array('Lucky',71),
 array('Pooja',11),
 array('Manoj',49)
);*/

 $encoded_data = json_encode($rating_data);


?>
<script src="https://www.google.com/jsapi"></script>
    <style>
        .pie-chart {
            width: 600px;
            height: 400px;
            margin: 0 auto;
        }
        .text-center{
            text-align: center;
        }
    </style>
  <div class="row">
    
    <div class="col-xl-3 col-md-6 mb-4">
	  <div class="card border-left-primary shadow h-100 py-2">
	    <div class="card-body">
		  <div class="row no-gutters align-items-center">
		    <div class="col mr-2">
			  <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"><a href="<?=base_url('events/manageevent')?>">Events</a></div>
			  <div class="h5 mb-0 font-weight-bold text-gray-800"><?=my_esc_html($event_count)?></div>
            </div>
            <div class="col-auto">
              <img src="<?= base_url() ?>upload/icons/Events.svg" style="height: 30px;background: gray;">
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <div class="col-xl-3 col-md-6 mb-4">
	  <div class="card border-left-warning shadow h-100 py-2">
	    <div class="card-body">
		  <div class="row no-gutters align-items-center">
		    <div class="col mr-2">
			  <div class="text-xs font-weight-bold text-warning text-uppercase mb-1"><a href="<?=base_url('post/managepost')?>">Posts</a></div>
			  <div class="h5 mb-0 font-weight-bold text-gray-800"><?=my_esc_html($post_count)?></div>
			</div>
			<div class="col-auto">
			  <img src="<?= base_url() ?>upload/icons/Posts.svg" style="height: 30px;background: gray;">
			</div>
		  </div>
        </div>
      </div>
    </div>
    
    
    <div class="col-xl-3 col-md-6 mb-4">
	  <div class="card border-left-info shadow h-100 py-2">
	    <div class="card-body">
		  <div class="row no-gutters align-items-center">
		    <div class="col mr-2">
			  <div class="text-xs font-weight-bold text-info text-uppercase mb-1"><a href="<?=base_url('requirement/managerequirement')?>">Leads / Requirement</a></div>
			  <div class="h5 mb-0 font-weight-bold text-gray-800"><?=my_esc_html($lead_count)?></div>
			</div>
			<div class="col-auto">
			  <img src="<?= base_url() ?>upload/icons/leads.svg" style="height: 30px;background: gray;">
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-success text-uppercase mb-1"><a href="<?=base_url('recognition/managerecognition')?>">Recognition</a></div>
                <div class="h5 mb-0 font-weight-bold text-gray-800"><?=my_esc_html($recognition_count)?></div>
              </div>
            <div class="col-auto">
              <img src="<?= base_url() ?>upload/icons/Recognitions.svg" style="height: 30px;background: gray;">
            </div>
          </div>
        </div>
      </div>
    </div> 
      
      <div class="col-xl-3 col-md-6 mb-4">
	  <div class="card border-left-primary shadow h-100 py-2">
	    <div class="card-body">
		  <div class="row no-gutters align-items-center">
		    <div class="col mr-2">
			  <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"><a href="<?=base_url('referral/managereferral')?>">Referrals</a></div>
			  <div class="h5 mb-0 font-weight-bold text-gray-800"><?=my_esc_html($referral_count)?></div>
            </div>
            <div class="col-auto">
              <img src="<?= base_url() ?>upload/icons/Events.svg" style="height: 30px;background: gray;">
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <div class="col-xl-3 col-md-6 mb-4">
	  <div class="card border-left-warning shadow h-100 py-2">
	    <div class="card-body">
		  <div class="row no-gutters align-items-center">
		    <div class="col mr-2">
			  <div class="text-xs font-weight-bold text-warning text-uppercase mb-1"><a href="<?=base_url('users/managebusinesstransaction')?>">Business Transaction</a></div>
			  <div class="h5 mb-0 font-weight-bold text-gray-800"><?=my_esc_html($business_transaction_count)?></div>
			</div>
			<div class="col-auto">
			  <img src="<?= base_url() ?>upload/icons/Posts.svg" style="height: 30px;background: gray;">
			</div>
		  </div>
        </div>
      </div>
    </div>
    
    
    <div class="col-xl-3 col-md-6 mb-4">
	  <div class="card border-left-info shadow h-100 py-2">
	    <div class="card-body">
		  <div class="row no-gutters align-items-center">
		    <div class="col mr-2">
			  <div class="text-xs font-weight-bold text-info text-uppercase mb-1"><a href="<?=base_url('users/ratereview')?>">Reviews</a></div>
			  <div class="h5 mb-0 font-weight-bold text-gray-800"><?=my_esc_html($review_count)?></div>
			</div>
			<div class="col-auto">
			  <img src="<?= base_url() ?>upload/icons/leads.svg" style="height: 30px;background: gray;">
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-success text-uppercase mb-1"><a href="<?=base_url('buddymeet/manages')?>">Buddy Meet</a></div>
                <div class="h5 mb-0 font-weight-bold text-gray-800"><?=my_esc_html($buddy_meet_count)?></div>
              </div>
            <div class="col-auto">
              <img src="<?= base_url() ?>upload/icons/Recognitions.svg" style="height: 30px;background: gray;">
            </div>
          </div>
        </div>
      </div>
    </div> 
    
    
    
    <div class="col-xl-3 col-md-6 mb-4">
	  <div class="card border-left-primary shadow h-100 py-2">
	    <div class="card-body">
		  <div class="row no-gutters align-items-center">
		    <div class="col mr-2">
			  <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"><a href="<?=base_url('admin/list_users')?>">Users</a></div>
			  <div class="h5 mb-0 font-weight-bold text-gray-800"><?=my_esc_html($user_count)?></div>
            </div>
            <div class="col-auto">
              <img src="<?= base_url() ?>upload/icons/Connections.svg" style="height: 30px;background: gray;">
            </div>
          </div>
        </div>
      </div>
    </div>
    
	
	<div class="col-xl-3 col-md-6 mb-4">
	  <div class="card border-left-warning shadow h-100 py-2">
	    <div class="card-body">
		  <div class="row no-gutters align-items-center">
		    <div class="col mr-2">
			  <div class="text-xs font-weight-bold text-warning text-uppercase mb-1"><a href="<?=base_url('admin/list_user/today')?>"><?=my_caption('dashboard_signup_today')?></a></div>
			  <div class="h5 mb-0 font-weight-bold text-gray-800"><?=my_esc_html($user_today_amount)?></div>
			</div>
			<div class="col-auto">
			  <img src="<?= base_url() ?>upload/icons/badge.png" style="height: 30px;background: gray;">
            </div>
          </div>
        </div>
      </div>
    </div>
      <div class="col-xl-6 col-md-6 mb-4">
	  <div class="card border-left-danger shadow h-100 py-2">
	    <div class="card-body">
                <form action="<?= base_url('dashboard') ?>" method="POST">
                <div class="row ">
                    
                    <div class="col-md-5">
                        <div class="text-xs font-weight-bold text-primary">Start Date</div>
                <input type="date" name="start_date" value="<?php if($_POST){ echo $_POST['start_date']; } ?>" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <div class="text-xs font-weight-bold text-primary">End Date</div>
                <input type="date" name="end_date" value="<?php if($_POST){ echo $_POST['end_date']; } ?>" class="form-control">
                    </div>
                    <div class="col-md-1">
                        <div class="text-xs font-weight-bold text-primary" style="visibility: hidden;">a</div>
                        <button type="submit" class="btn btn-primary btn-flat btn-sm"><i class="fa fa-filter"></i></button></div>
                    <div class="col-md-2">
                        <div class="text-xs font-weight-bold text-primary" style="visibility: hidden;">a</div>
                        <a href="<?= base_url('dashboard') ?>" class="btn btn-danger btn-flat btn-sm">Reset</a></div>
                    
                </div>
                    </form>
        </div>
      </div>
    </div>
<!--    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-info text-uppercase mb-1"><a href="<?=base_url('group/mange')?>">Groups</a></div>
                <div class="h5 mb-0 font-weight-bold text-gray-800"><?=my_esc_html($groups_count)?></div>
              </div>
            <div class="col-auto">
              <img src="<?= base_url() ?>upload/icons/Connections.svg" style="height: 30px;background: gray;">
            </div>
          </div>
        </div>
      </div>
    </div> -->
  </div>  
  
  <div class="row">
    <div class="col-xl-8">
	  <div class="card shadow mb-4 min-height-666">
	    <div class="card-header py-3">
                <div class="row">
                    <div class="col-sm-8">
                        <h6 class="m-0 font-weight-bold text-primary"><a href="#">Business Transaction</a></h6>
                    </div>
<!--                    <div class="col-sm-4">
                        <select class="form-control" name="business_transaction" onchange="get_business_transaction1(this.value)">
                          <option value="all">All</option>
                          <?php
                            for($i=date('Y');$i>2021;$i--)
                            {
                           ?>
                          <option value="<?= $i ?>" <?php if($i == date('Y')){ echo 'selected'; } ?>><?= $i ?></option>
                          <?php
                            }
                          ?>
                      </select>
                    </div>-->
                </div>
		  
                  
		</div>
        <div class="card-body">
		    
		    <div class="container">
              <div class="row">
                <div class="col-md-12">
                  
            
            			<div class="tabbable-panel">
            				<div class="tabbable-line">
            					
            					<ul class="nav nav-tabs nav-pills nav-pills-rounded chart-action float-right btn-group" role="group">
                                <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#tab_default_day_1">Day</a></li>
                                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tab_default_week_2">Week</a></li>
                                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tab_default_month_3">Year</a></li>
                            </ul>
            					
            				
            					<div class="tab-content">
            						<div class="tab-pane active" id="tab_default_day_1">
            							<div id="chart-container">
                                            <canvas id="business_trans_day_chart"></canvas>
                                        </div>
            						</div>
            						<div class="tab-pane" id="tab_default_week_2">
            							<div id="chart-container">
                                            <canvas id="business_trans_week_chart"></canvas>
                                        </div>
            						</div>
            						<div class="tab-pane" id="tab_default_month_3">
            							<div id="chart-container">
                                            <canvas id="business_trans_month_chart"></canvas>
                                        </div>
            						</div>
            						
            
            						</div>
            					</div>
            				</div>
            			</div>
            
                </div>
              </div>
            
		    
		    
		    
        </div>
      </div>
    </div>
	
	
	
	<div class="col-xl-4">
	  <div class="card shadow mb-4 min-height-666">
	    <div class="card-header py-3">
		  <div class="row">
                    <div class="col-sm-7">
                        <h6 class="m-0 font-weight-bold text-primary"><a href="#">Business Transaction</a></h6>
                    </div>
<!--                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="datefilter1" value="">
                    </div>-->
                </div>
		</div>
        <div class="card-body">
		  <div class="chart" id="sales-chart" style="height: 300px; position: relative;"></div>
        </div>
      </div>
    </div>
 
    <div class="col-xl-6">
	  <div class="card shadow mb-4 min-height-666">
	    <div class="card-header py-3">
		  <div class="row">
                    <div class="col-sm-6">
                        <h6 class="m-0 font-weight-bold text-primary"><a href="#">Event Attendance</a></h6>
                    </div>
<!--                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="datefilter2" value="">
                    </div>-->
                </div>
		</div>
        <div class="card-body">
		  <div id="chart_div"></div>
        </div>
      </div>
    </div>
 
    <div class="col-xl-6">
	  <div class="card shadow mb-4 min-height-666">
	    <div class="card-header py-3">
		  <div class="row">
                    <div class="col-sm-6">
                        <h6 class="m-0 font-weight-bold text-primary"><a href="#">Subscription's Detail</a></h6>
                    </div>
<!--                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="datefilter3" value="">
                    </div>-->
                </div>
		</div>
        <div class="card-body">
		  <div id="chart_div2"></div>
        </div>
      </div>
    </div>
    
    
    <div class="col-xl-12">
	  <div class="card shadow mb-4 min-height-666">
	    <div class="card-header py-3">
                  <div class="row">
                    <div class="col-sm-8">
                        <h6 class="m-0 font-weight-bold text-primary"><a href="#">Top'10 User Point</a></h6>
                    </div>
<!--                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="datefilter4" value="">
                    </div>-->
                </div>
		</div>
        <div class="card-body">
		    <div id="chart-container">
                <canvas id="graphCanvas"></canvas>
            </div>
        </div>
      </div>
    </div>
    
    
    
    
    
     <div class="col-xl-12">
	  <div class="card shadow mb-4 min-height-666">
	    <div class="card-header py-3">
		  
                  <div class="row">
                    <div class="col-sm-9">
                        <h6 class="m-0 font-weight-bold text-primary"><a href="#">Leads Shared</a></h6>
                    </div>
<!--                    <div class="col-sm-3">
                        <select class="form-control" name="leads_shared">
                          <option value="all">All</option>
                          <?php
                            for($i=date('Y');$i>2021;$i--)
                            {
                           ?>
                          <option value="<?= $i ?>"><?= $i ?></option>
                          <?php
                            }
                          ?>
                      </select>
                    </div>-->
                </div>
		</div>
        <div class="card-body">
		    
		    <div class="container">
              <div class="row">
                <div class="col-md-12">
                  
            
            			<div class="tabbable-panel">
            				<div class="tabbable-line">
            					
            					<ul class="nav nav-tabs nav-pills nav-pills-rounded chart-action float-right btn-group" role="group">
                                <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#tab_default_1">Day</a></li>
                                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tab_default_2">Week</a></li>
                                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tab_default_3">Month</a></li>
                            </ul>
            					
            				
            					<div class="tab-content">
            						<div class="tab-pane active" id="tab_default_1">
            							<div id="chart-container">
                                            <canvas id="leaddaygraphCanvas"></canvas>
                                        </div>
            						</div>
            						<div class="tab-pane" id="tab_default_2">
            							<div id="chart-container">
                                            <canvas id="leadweekgraphCanvas"></canvas>
                                        </div>
            						</div>
            						<div class="tab-pane" id="tab_default_3">
            							<div id="chart-container">
                                            <canvas id="leadgraphCanvas"></canvas>
                                        </div>
            						</div>
            						
            
            						</div>
            					</div>
            				</div>
            			</div>
            
                </div>
              </div>
            
		    
		    
		    
        </div>
      </div>
    </div>
    
    
    
 
  </div>
  
  
    <script>
        $(function() {

  $('input[name="datefilter1"]').daterangepicker({
      autoUpdateInput: false,
      locale: {
          cancelLabel: 'Clear'
      }
  });

  $('input[name="datefilter1"]').on('apply.daterangepicker', function(ev, picker) {
      $(this).val(picker.startDate.format('YYYY-MM-DD') + '/' + picker.endDate.format('YYYY-MM-DD'));
      get_business_transaction($(this).val());
  });

  $('input[name="datefilter1"]').on('cancel.daterangepicker', function(ev, picker) {
      $(this).val('');
      get_business_transaction($(this).val());
  });
  
  $('input[name="datefilter2"]').daterangepicker({
      autoUpdateInput: false,
      locale: {
          cancelLabel: 'Clear'
      }
  });

  $('input[name="datefilter2"]').on('apply.daterangepicker', function(ev, picker) {
      $(this).val(picker.startDate.format('YYYY-MM-DD') + '/' + picker.endDate.format('YYYY-MM-DD'));
      get_event_attendance($(this).val());
  });

  $('input[name="datefilter2"]').on('cancel.daterangepicker', function(ev, picker) {
      $(this).val('');
      get_event_attendance($(this).val());
  });
  
  $('input[name="datefilter3"]').daterangepicker({
      autoUpdateInput: false,
      locale: {
          cancelLabel: 'Clear'
      }
  });

  $('input[name="datefilter3"]').on('apply.daterangepicker', function(ev, picker) {
      $(this).val(picker.startDate.format('YYYY-MM-DD') + '/' + picker.endDate.format('YYYY-MM-DD'));
      get_subscription($(this).val());
  });

  $('input[name="datefilter3"]').on('cancel.daterangepicker', function(ev, picker) {
      $(this).val('');
      get_subscription($(this).val());
  });
  
  $('input[name="datefilter4"]').daterangepicker({
      autoUpdateInput: false,
      locale: {
          cancelLabel: 'Clear'
      }
  });

  $('input[name="datefilter4"]').on('apply.daterangepicker', function(ev, picker) {
      $(this).val(picker.startDate.format('YYYY-MM-DD') + '/' + picker.endDate.format('YYYY-MM-DD'));
      get_user_point($(this).val());
  });

  $('input[name="datefilter4"]').on('cancel.daterangepicker', function(ev, picker) {
      $(this).val('');
      get_user_point($(this).val());
  });

});

function get_subscription(str)
{
    $.ajax({
        url: '<?=base_url();?>dashboard/fetch_subscription/'+str,    
        type: 'GET',
        dataType: 'json',
        success: function (result) {
            
            var data2 = new google.visualization.DataTable();
            data2.addColumn('string', 'Topping');
            data2.addColumn('number', 'Slices');
            data2.addRows(result);
            var options2 = {'title':'',
                           'width':600,
                           'height':500,
                is3D: true,
            };
            var chart2 = new google.visualization.PieChart(document.getElementById('chart_div2'));
            chart2.draw(data2, options2);
        }
    });
}
function get_business_transaction(str)
{
    $.ajax({
        url: '<?=base_url();?>dashboard/fetch_business_transaction/'+str,    
        type: 'GET',
//        dataType: 'json',
        success: function (result) {
            var res = result.split('#');
            $('#sales-chart').html('');
            $(function () {

                "use strict";
                //DONUT CHART
                var donut = new Morris.Donut({
                    element: 'sales-chart',
                    resize: true,
                    colors: ["#00a65a", "#f56954"],
                    data: [
                        {
                            label: "Offline", value:res[0]
                        },
                        {
                            label: "Online", value:res[1] },
                    ],
                    hideHover: 'auto'
                });
            });
        }
    });
}
function get_business_transaction1(str)
{
    $.ajax({
        url: '<?=base_url();?>dashboard/fetch_business_transaction1/'+str,    
        type: 'GET',
//        dataType: 'json',
        success: function (result) {
            var res = result.split('#');
            $('#sales-chart').html('');
            $(function () {

                "use strict";
                //DONUT CHART
                var donut = new Morris.Donut({
                    element: 'sales-chart',
                    resize: true,
                    colors: ["#00a65a", "#f56954"],
                    data: [
                        {
                            label: "Offline", value:res[0]
                        },
                        {
                            label: "Online", value:res[1] },
                    ],
                    hideHover: 'auto'
                });
            });
        }
    });
}
function get_event_attendace(str)
{
    $.ajax({
        url: '<?=base_url();?>dashboard/fetch_event_attendance/'+str,    
        type: 'GET',
        dataType: 'json',
        success: function (result) {
            
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Topping');    
            data.addColumn('number', 'Slices');
            data.addRows(result);
            var options = {'title':'',
                           'width':600,
                           'height':500,
                is3D: true,
            };
            var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
            chart.draw(data, options);
        }
    });
}
function get_user_point(str)
{
    $.ajax({
        url: '<?=base_url();?>dashboard/fetch_user_point/'+str,    
        type: 'GET',
        dataType: 'json',
        success: function (result) {
            $('#graphCanvas').html('');
            var name1 = [];
            var marks1 = [];
for(let i = 0; i < result.length; i++) {
    let obj = result[i];
name1.push(obj.full_name);
marks1.push(obj.total_point);
}
                
                   

            var chartdata1 = {
                labels: name1,
                datasets: [
                    {
                        label: 'Reward Point',
                        backgroundColor: '#49e2ff',
                        borderColor: '#46d5f1',
                        hoverBackgroundColor: '#CCCCCC',
                        hoverBorderColor: '#666666',
                        data: marks1
                    }
                ]
            };

            var graphTarget1 = $("#graphCanvas");

            var barGraph1 = new Chart(graphTarget1, {
                type: 'bar',
                data: chartdata1
            });
           
        }
    });
}
        </script>