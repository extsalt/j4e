<?php
  defined('BASEPATH') OR exit('No direct script access allowed'); 
?>
      </div>
	  <footer class="sticky-footer bg-white">
        <div class="container my-auto">
         
         <div class="row">
             <div class="col-md-4">
                 <div class="copyright text-center my-auto">
                   <strong style="float: left;">©Powered by  <a href="http://applexinfotech.com/" target="_blank">  Applex Infotech. </a></strong>
                 </div>  
             </div>
             <div class="col-md-4">
                  <div class="copyright text-center my-auto">
                    <strong><?=my_caption('menu_footer_copyright')?> v<?=my_esc_html($this->setting->version)?></strong>
                  </div>
             </div>
             <div class="col-md-4">
                 <div class="copyright text-center my-auto">
                     <strong style="float: right;"><a href="<?=base_url();?>infopages/privacypolicy" >Privacy Policy </a> |
                     <a href="<?=base_url();?>infopages/terms_condition" >Terms & Condition </a> |
                     <a href="<?=base_url();?>infopages/faq" >FAQ's </a></strong>
                  </div>
                 
                 
                 
                 
             </div>
         </div>
         
         
         
         
          
        </div>
      </footer>
	  <?php
	    $global_caption = my_caption('global_view') . '||';
		$global_caption .= my_caption('global_edit') . '||';	
		$global_caption .= my_caption('global_delete') . '||';
		$global_caption .= my_caption('global_delete') . '||';
		$global_caption .= my_caption('global_not_revert');
		$language = get_cookie('site_lang', TRUE);
		if (!$language) {
			$language = $this->config->item('language');
			my_set_language_cookie($language);
		}
	  ?>
	  <input type="hidden" name="global_base_url" id="global_base_url" value="<?=base_url()?>">
	  <input type="hidden" name="global_user_identifier" id="global_user_identifier" value="<?=my_esc_html($_SESSION['user_ids'])?>">
	  <input type="hidden" name="global_site_language" id="global_site_language" value="<?=my_esc_html($language)?>">
	  <input type="hidden" name="global_caption" id="global_caption" value="<?=my_esc_html($global_caption)?>">
	  <input type="hidden" name="timezone_offset" id="timezone_offset" value="<?=my_timezone_offset($this->config->item('time_reference'), $this->user_timezone)?>">
	  <input type="hidden" name="user_dateformat" id="user_dateformat" value="<?=my_esc_html($this->user_date_format)?>">
	  <input type="hidden" name="user_timeformat" id="user_timeformat" value="<?=my_esc_html($this->user_time_format)?>">
    </div>
  </div>
  <a class="scroll-to-top rounded" href="#wrapper">
    <i class="fas fa-angle-up"></i>
  </a>
  
  <script src="<?=base_url()?>assets/themes/default/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?=base_url()?>assets/themes/default/vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="<?=base_url()?>assets/themes/default/vendor/bootstrap-select/js/bootstrap-select.min.js"></script>
  <script src="<?=base_url()?>assets/themes/default/vendor/blockui/jquery.blockUI.js"></script>
  <script src="<?=base_url()?>assets/themes/default/vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="<?=base_url()?>assets/themes/default/vendor/datatables/dataTables.bootstrap4.min.js"></script>
  <script src="<?=base_url()?>assets/themes/default/vendor/chart.js/Chart.min.js"></script>
  <script src="<?=base_url()?>assets/themes/default/js/sb-admin-2.min.js"></script>
  <script src="<?=base_url()?>assets/themes/default/vendor/sweetalert2/sweetalert2.min.js"></script>
  <script src="<?=base_url()?>assets/themes/default/vendor/summernote/summernote.min.js"></script>
  <script src="<?=base_url()?>assets/themes/default/vendor/momentjs/moment.min.js"></script>
  <script src="<?=base_url()?>assets/themes/default/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
  
  <script src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.print.min.js"></script>
  
 






  
  
  
  <?php if (!empty($this->setting->dashboard_custom_javascript)) { ?>
	<script src="<?=$this->setting->dashboard_custom_javascript?>"></script>
  <?php 
    }
    if ($this->setting->google_analytics_id != '') {
  ?>
  <!-- Global site tag (gtag.js) - Google Analytics -->
    <input type="hidden" id="google_analytics_id" name="google_analytics_id" value="<?=my_esc_html($this->setting->google_analytics_id)?>">
    <script async src="https://www.googletagmanager.com/gtag/js?id=<?=my_esc_html($this->setting->google_analytics_id)?>"></script>
  <?php
	}
  ?>
  <script src="<?=base_url()?>assets/themes/default/js/app.js?v=<?=$this->setting->version?>"></script>
 <!--
  <script
  src="https://code.jquery.com/ui/1.12.0-rc.1/jquery-ui.min.js"
  integrity="sha256-mFypf4R+nyQVTrc8dBd0DKddGB5AedThU73sLmLWdc0="
  crossorigin="anonymous"></script>-->
  
  <script>
     $(document).ready(function() {
         
         $('.exampletable').DataTable( {
            "order": [[ 1, "asc" ]]
        } );
         
         /* buttons: [
            'csv', 'excel', 'pdf', 'print'
        ]*/
    $("#reset_btn").addClass("btn-danger");
    $("#cancel_btn").addClass("btn-success");     
         
    
} );

$(document).ready(function() {
    $('.exampletables').DataTable( {
        dom: 'lBfrtip', 
        
        buttons: [
          {
             extend: 'print',
             exportOptions: {
                columns: 'th:not(:last-child)'
             }
          },
          {
             extend: 'csv',
             exportOptions: {
                columns: 'th:not(:last-child)'
             }
          }
       ],
        "columnDefs": [ {
          "targets": 'no-sort',
          "orderable": false,
    } ]
        
    } );
} );

$("#sidebarToggles").on('click', function(e) { //alert('hi');
    $("body").toggleClass("sidebar-toggled");
    $(".sidebar").toggleClass("toggled");
    if ($(".sidebar").hasClass("toggled")) {
      $('.sidebar .collapse').collapse('hide');
    };
  });

$('.numberonly').keypress(function (e) {    
    
                var charCode = (e.which) ? e.which : event.keyCode    
    
                if (String.fromCharCode(charCode).match(/[^0-9]/g))    
    
                    return false;                        
    
            });  
$(".datechoosen").keydown(function (e) {
         return false;
});

 </script> 

<?php
$get_event_data = $this->db->get('event_category')->result_array();


$get_pack_data = $this->db->get('packages')->result_array();

?>


<script src="<?= base_url() ?>assets/plugins/raphael/raphael.min.js"></script>
 <script src="<?= base_url() ?>assets/plugins/morris/morris.min.js"></script>
<!-- / Chart.js Script -->
<script src="<?= base_url() ?>assets/themes/default/js/chart.min.js" type="text/javascript"></script> 
<script src="https://eshopweb.store/assets/admin/chart.js/Chart.min.js"></script> 
 
 <?php $page_uri = $this->uri->segment(1);
  if($page_uri == 'dashboard'){
 ?>
        <script type="text/javascript">

          // Load the Visualization API and the piechart package.
          google.load('visualization', '1.0', {'packages':['corechart']});

          // Set a callback to run when the Google Visualization API is loaded.
          google.setOnLoadCallback(drawChart);

          // Callback that creates and populates a data table,
          // instantiates the pie chart, passes in the data and
          // draws it.
          function drawChart() {

            // Create the data table.
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Topping');    
            data.addColumn('number', 'Slices');
            data.addRows([
              <?php
                foreach($get_pack_data as $val_event)
               {
                    $eventcatid = $val_event['pack_id']; 
                    $user_data = $this->db->where('packages_id',$eventcatid)->get('user')->result();
                    $users = array();
                    if(!empty($user_data))
                    {
                        foreach($user_data as $val)
                        {
                            array_push($users, $val->id);
                        }
                    }
                    if(!empty($users))
                    {
                        $this->db->where_in('booking_userid',$users);
                    }
                    if($_POST)
           {
               $sd = date('Y-m-d',strtotime($this->input->post('start_date')));
                $ed = date('Y-m-d',strtotime($this->input->post('end_date')));
                $event_data = $this->db->where('bookin_attedance','1')->where('date(booking_creatat) >=',$sd)->where('date(booking_creatat) <=',$ed)->get('event_booking')->num_rows();
           }else{
                    $event_data = $this->db->where('bookin_attedance','1')->get('event_booking')->num_rows();
           }
                    
                    echo "['".$val_event['pack_name']."', $event_data],";
                }
            ?>
            ]);
            // Create the data table.
            var data2 = new google.visualization.DataTable();
            data2.addColumn('string', 'Topping');
            data2.addColumn('number', 'Slices');
            data2.addRows([
              <?php
                foreach($get_pack_data as $val_pack)
               {
                    $eventcatid = $val_pack['pack_id']; 
                    if($_POST)
           {
               $sd = date('Y-m-d',strtotime($this->input->post('start_date')));
                $ed = date('Y-m-d',strtotime($this->input->post('end_date')));
                $event_data = $this->db->where('packages_id',$eventcatid)->where('date(created_time) >=',$sd)->where('date(created_time) <=',$ed)->get('user')->num_rows();
           }
           else
           {
                    $event_data = $this->db->where('packages_id',$eventcatid)->get('user')->num_rows();
           }
                    echo "['".$val_pack['pack_name']."', $event_data],";
                }
            ?>
            ]);

            

            // Set chart options
            var options = {'title':'',
                           'width':600,
                           'height':500,
                is3D: true,
            };
            // Set chart options
            var options2 = {'title':'',
                           'width':600,
                           'height':500,
                is3D: true,
            };
            // Set chart options
            

            // Instantiate and draw our chart, passing in some options.
            var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
            chart.draw(data, options);
            var chart2 = new google.visualization.PieChart(document.getElementById('chart_div2'));
            chart2.draw(data2, options2);
            

          }
        </script>
      
  
  
  <script type="text/javascript">
            $(function () {

                "use strict";
                //DONUT CHART
                var donut = new Morris.Donut({
                    element: 'sales-chart',
                    resize: true,
                    colors: ["#00a65a", "#f56954"],
                    data: [
                        {
                            label: "Offline", value:<?php
                            $total_vincome = 0;
                            if(!empty($offline_count))
                            {
                                $total_vincome = $offline_count->total_offline;
                            }
                            /*if (!empty($income_expense)):foreach ($income_expense as $v_income_expense):
                            if ($v_income_expense->type == 'Income') {

                            $total_vincome += $v_income_expense->amount;
                            ?>

                            <?php
                            }
                            endforeach;
                            endif;*/
                            echo $total_vincome;
                            ?>
                        },
                        {
                            label: "Online", value: <?php
                            $total_vexpense = 0;
                            /*if (!empty($income_expense)):foreach ($income_expense as $v_income_expense):
                            if ($v_income_expense->type == 'Expense') {
                            $total_vexpense += $v_income_expense->amount;
                            ?>

                            <?php
                            }
                            endforeach;
                            endif;*/
                            echo $total_vexpense = $online_count->total_online;
                            ?>},
                    ],
                    hideHover: 'auto'
                });
            });
            
            
            
//    $( document ).ready(function() {        
//            $.ajax({
//        url: '<?=base_url();?>dashboard/fetch_sales',    
//        type: 'GET',
//        dataType: 'json',
//        success: function (result) {
//            console.log(result[1].week);
//            console.log(result[1].total_sale);
//
//            $(window).on,
//                function (e, t, a) {
//                    "use strict";
//                    var n, s, i, o, r, l, h, c;
//                    n = function (e, t, a) {
//                        var n = new Chartist.Line("#" + e, {
//                            labels: t,
//                            series: [a]
//                        }, {
//                            lineSmooth: Chartist.Interpolation.simple({
//                                divisor: 2
//                            }),
//                            fullWidth: !0,
//                            chartPadding: {
//                                right: 25
//                            },
//                            series: {
//                                "series-1": {
//                                    showArea: !1
//                                }
//                            },
//                            axisX: {
//                                showGrid: !1
//                            },
//                            axisY: {
//                                labelInterpolationFnc: function (e) {
//                                    return e / 1e3 + "K"
//                                },
//                                scaleMinSpace: 40
//                            },
//                            // plugins: [Chartist.plugins.tooltip()],
//                            low: 0,
//                            showPoint: !1,
//                            height: 300
//                        });
//                        n.on("created", (function (t) {
//                            var a = t.svg.querySelector("defs") || t.svg.elem("defs"),
//                                n = (t.svg.width(), t.svg.height(), a.elem("filter", {
//                                    x: 0,
//                                    y: "-10%",
//                                    id: "shadow" + e
//                                }, "", !0));
//                            return n.elem("feGaussianBlur", {
//                                in: "SourceAlpha",
//                                stdDeviation: "24",
//                                result: "offsetBlur"
//                            }), n.elem("feOffset", {
//                                dx: "0",
//                                dy: "32"
//                            }), n.elem("feBlend", {
//                                in: "SourceGraphic",
//                                mode: "multiply"
//                            }), a.elem("linearGradient", {
//                                id: e + "-gradient",
//                                x1: 0,
//                                y1: 0,
//                                x2: 1,
//                                y2: 0
//                            }).elem("stop", {
//                                offset: 0,
//                                "stop-color": "rgba(22, 141, 238, 1)"
//                            }).parent().elem("stop", {
//                                offset: 1,
//                                "stop-color": "rgba(98, 188, 246, 1)"
//                            }), a
//                        })).on("draw", (function (t) {
//                            "line" === t.type ? t.element.attr({
//                                filter: "url(#shadow" + e + ")"
//                            }) : "point" === t.type && new Chartist.Svg(t.element._node.parentNode).elem("line", {
//                                x1: t.x,
//                                y1: t.y,
//                                x2: t.x + .01,
//                                y2: t.y,
//                                class: "ct-point-content"
//                            }), "line" !== t.type && "area" != t.type || t.element.animate({
//                                d: {
//                                    begin: 1e3 * t.index,
//                                    dur: 1e3,
//                                    from: t.path.clone().scale(1, 0).translate(0, t.chartRect.height()).stringify(),
//                                    to: t.path.clone().stringify(),
//                                    easing: Chartist.Svg.Easing.easeOutQuint
//                                }
//                            })
//                        }))
//                    },
//                        s = result[2].day, i = {
//                            name: "series-1",
//                            data: result[2].total_sale
//                        },
//                        o = result[1].week,
//                        r = {
//                            name: "series-1",
//                            data: result[1].total_sale
//                        },
//                        l = result[0].month_name,
//                        h = {
//                            name: "series-1",
//                            data: result[0].total_sale
//                        }, (c = function (e) {
//                            switch ((e || a("#ecommerceChartView .chart-action").find(".active")).attr("href")) {
//                                case "#scoreLineToDay":
//                                    n("scoreLineToDay", s, i);
//                                    break;
//                                case "#scoreLineToWeek":
//                                    n("scoreLineToWeek", o, r);
//                                    break;
//                                case "#scoreLineToMonth":
//                                    n("scoreLineToMonth", l, h)
//                            }
//                        })(), a(".chart-action li a").on("click", (function () {
//                            c(a(this))
//                        }))
//                }(window, document, jQuery);
//        }
//    });
//    });        
//            
//     $( document ).ready(function() {        
//            $.ajax({
//        url: '<?=base_url();?>dashboard/fetch_lead_shared',    
//        type: 'GET',
//        dataType: 'json',
//        success: function (result) {
//            console.log(result[1].week);
//            console.log(result[1].total_sale);
//
//            $(window).on,
//                function (e, t, a) {
//                    "use strict";
//                    var n, s, i, o, r, l, h, c;
//                    n = function (e, t, a) {
//                        var n = new Chartist.Line("#" + e, {
//                            labels: t,
//                            series: [a]
//                        }, {
//                            lineSmooth: Chartist.Interpolation.simple({
//                                divisor: 2
//                            }),
//                            fullWidth: !0,
//                            chartPadding: {
//                                right: 25
//                            },
//                            series: {
//                                "series-1": {
//                                    showArea: !1
//                                }
//                            },
//                            axisX: {
//                                showGrid: !1
//                            },
//                            axisY: {
//                                labelInterpolationFnc: function (e) {
//                                    return e / 1e3 
//                                },
//                                scaleMinSpace: 40
//                            },
//                            // plugins: [Chartist.plugins.tooltip()],
//                            low: 0,
//                            showPoint: !1,
//                            height: 300
//                        });
//                        n.on("created", (function (t) {
//                            var a = t.svg.querySelector("defs") || t.svg.elem("defs"),
//                                n = (t.svg.width(), t.svg.height(), a.elem("filter", {
//                                    x: 0,
//                                    y: "-10%",
//                                    id: "shadow" + e
//                                }, "", !0));
//                            return n.elem("feGaussianBlur", {
//                                in: "SourceAlpha",
//                                stdDeviation: "24",
//                                result: "offsetBlur"
//                            }), n.elem("feOffset", {
//                                dx: "0",
//                                dy: "32"
//                            }), n.elem("feBlend", {
//                                in: "SourceGraphic",
//                                mode: "multiply"
//                            }), a.elem("linearGradient", {
//                                id: e + "-gradient",
//                                x1: 0,
//                                y1: 0,
//                                x2: 1,
//                                y2: 0
//                            }).elem("stop", {
//                                offset: 0,
//                                "stop-color": "rgba(22, 141, 238, 1)"
//                            }).parent().elem("stop", {
//                                offset: 1,
//                                "stop-color": "rgba(98, 188, 246, 1)"
//                            }), a
//                        })).on("draw", (function (t) {
//                            "line" === t.type ? t.element.attr({
//                                filter: "url(#shadow" + e + ")"
//                            }) : "point" === t.type && new Chartist.Svg(t.element._node.parentNode).elem("line", {
//                                x1: t.x,
//                                y1: t.y,
//                                x2: t.x + .01,
//                                y2: t.y,
//                                class: "ct-point-content"
//                            }), "line" !== t.type && "area" != t.type || t.element.animate({
//                                d: {
//                                    begin: 1e3 * t.index,
//                                    dur: 1e3,
//                                    from: t.path.clone().scale(1, 0).translate(0, t.chartRect.height()).stringify(),
//                                    to: t.path.clone().stringify(),
//                                    easing: Chartist.Svg.Easing.easeOutQuint
//                                }
//                            })
//                        }))
//                    },
//                        s = result[2].day, i = {
//                            name: "series-1",
//                            data: result[2].total_sale
//                        },
//                        o = result[1].week,
//                        r = {
//                            name: "series-1",
//                            data: result[1].total_sale
//                        },
//                        l = result[0].month_name,
//                        h = {
//                            name: "series-1",
//                            data: result[0].total_sale
//                        }, (c = function (e) {
//                            switch ((e || a("#ecommerceChartView .chart-action").find(".active")).attr("href")) {
//                                case "#LeadSharedToDay":
//                                    n("LeadSharedToDay", s, i);
//                                    break;
//                                case "#LeadSharedToWeek":
//                                    n("LeadSharedToWeek", o, r);
//                                    break;
//                                case "#LeadSharedToMonth":
//                                    n("LeadSharedToMonth", l, h)
//                            }
//                        })(), a(".chart-action li a").on("click", (function () {
//                            c(a(this))
//                        }))
//                }(window, document, jQuery);
//        }
//    });
//    });          
            
            
            
            
            
        </script>
   
<script>
        $(document).ready(function () {
            showGraph();
            showMonthwiseLead();
            showWeekwiseLead();
            showdayswiseLead();
            showdayswisebusinesstransaction();
            showweekswisebusinesstransaction();
            showmonthswisebusinesstransaction();
        });


        function showGraph()
        {
        	var name = [];
            var marks = [];

                <?php foreach($top_rank as $key=>$val_rank){
                    if($key < '10'){
                    ?>
                        name.push("<?=$val_rank['full_name'];?>");
                        marks.push("<?=$val_rank['total_point'];?>");
                    <?php } }?>

            var chartdata = {
                labels: name,
                datasets: [
                    {
                        label: 'Reward Point',
                        backgroundColor: '#49e2ff',
                        borderColor: '#46d5f1',
                        hoverBackgroundColor: '#CCCCCC',
                        hoverBorderColor: '#666666',
                        data: marks
                    }
                ]
            };

            var graphTarget = $("#graphCanvas");

            var barGraph = new Chart(graphTarget, {
                type: 'bar',
                data: chartdata
            });
        }
        
      
        function showMonthwiseLead()
        {
        	var name = [];
            var marks = [];

                <?php for($i=0;$i<count($month_wise_lead_month_name);$i++){   //echo $month_wise_lead_total_sale[$i];
                    
                    ?>
                        name.push("<?=$month_wise_lead_month_name[$i];?>");
                        
                    <?php  }?>
                    <?php for($i=0;$i<count($month_wise_lead_total_sale);$i++){   //echo $month_wise_lead_total_sale[$i];
                    
                    ?>
                        marks.push("<?=$month_wise_lead_total_sale[$i];?>");
                        
                    <?php  }?>
                       
                       

            var leadchartdata = {
                labels: name,
                datasets: [
                    {
                        label: 'Lead Shared',
                        backgroundColor: '#ffa600',
                        borderColor: '#46d5f1',
                        hoverBackgroundColor: '#CCCCCC',
                        hoverBorderColor: '#666666',
                        data: marks
                    }
                ]
            };

            var leadgraphTarget = $("#leadgraphCanvas");

            var leadbarGraph = new Chart(leadgraphTarget, {
                type: 'bar',
                data: leadchartdata
            });
        }
        
        function showWeekwiseLead()
        {
        	var name = [];
            var marks = [];

                <?php for($i=0;$i<count($week_wise_lead_month_name);$i++){   //echo $month_wise_lead_total_sale[$i];
                    
                    ?>
                        name.push("<?=$week_wise_lead_month_name[$i];?>");
                        
                    <?php  }?>
                    <?php for($i=0;$i<count($week_wise_lead_total_sale);$i++){   //echo $month_wise_lead_total_sale[$i];
                    
                    ?>
                        marks.push("<?=$week_wise_lead_total_sale[$i];?>");
                        
                    <?php  }?>
                       
                       

            var leadweekchartdata = {
                labels: name,
                datasets: [
                    {
                        label: 'Lead Shared',
                        backgroundColor: '#bc5090',
                        borderColor: '#46d5f1',
                        hoverBackgroundColor: '#CCCCCC',
                        hoverBorderColor: '#666666',
                        data: marks
                    }
                ]
            };

            var leadweekgraphTarget = $("#leadweekgraphCanvas");

            var leadweekbarGraph = new Chart(leadweekgraphTarget, {
                type: 'bar',
                data: leadweekchartdata
            });
        }
        
        
        function showdayswiseLead()
        {
        	var name = [];
            var marks = [];

                <?php for($i=0;$i<count($day_wise_lead_month_name);$i++){   //echo $month_wise_lead_total_sale[$i];
                    
                    ?>
                        name.push("<?=$day_wise_lead_month_name[$i];?>");
                        
                    <?php  }?>
                    <?php for($i=0;$i<count($day_wise_lead_total_sale);$i++){   //echo $month_wise_lead_total_sale[$i];
                    
                    ?>
                        marks.push("<?=$day_wise_lead_total_sale[$i];?>");
                        
                    <?php  }?>
                       
                       

            var leaddaychartdata = {
                labels: name,
                datasets: [
                    {
                        label: 'Lead Shared',
                        backgroundColor: '#ff6361',
                        borderColor: '#46d5f1',
                        hoverBackgroundColor: '#CCCCCC',
                        hoverBorderColor: '#666666',
                        data: marks
                    }
                ]
            };

            var leaddaygraphTarget = $("#leaddaygraphCanvas");

            var leaddaybarGraph = new Chart(leaddaygraphTarget, {
                type: 'bar',
                data: leaddaychartdata
            });
        }
        
        
        
        function showdayswisebusinesstransaction()
        {
        	var name = [];
            var marks = [];

                <?php for($i=0;$i<count($day_wise_day_business_transaction);$i++){   //echo $month_wise_lead_total_sale[$i];
                    
                    ?>
                        name.push("<?=$day_wise_day_business_transaction[$i];?>");
                        
                    <?php  }?>
                    <?php for($i=0;$i<count($day_wise_total_business_transaction);$i++){   //echo $month_wise_lead_total_sale[$i];
                    
                    ?>
                        marks.push("<?=$day_wise_total_business_transaction[$i];?>");
                        
                    <?php  }?>
                       
                       

            var transdaychartdata = {
                labels: name,
                datasets: [
                    {
                        label: 'Business Transaction',
                        backgroundColor: '#ff6361',
                        borderColor: '#46d5f1',
                        hoverBackgroundColor: '#CCCCCC',
                        hoverBorderColor: '#666666',
                        data: marks
                    }
                ]
            };

            var transdaygraphTarget = $("#business_trans_day_chart");

            var transdaybarGraph = new Chart(transdaygraphTarget, {
                type: 'bar',
                data: transdaychartdata
            });
        }
        
        function showweekswisebusinesstransaction()
        {
        	var name = [];
            var marks = [];

                <?php for($i=0;$i<count($week_wise_day_business_transaction);$i++){   //echo $month_wise_lead_total_sale[$i];
                    
                    ?>
                        name.push("<?=$week_wise_day_business_transaction[$i];?>");
                        
                    <?php  }?>
                    <?php for($i=0;$i<count($week_wise_total_business_transaction);$i++){   //echo $month_wise_lead_total_sale[$i];
                    
                    ?>
                        marks.push("<?=$week_wise_total_business_transaction[$i];?>");
                        
                    <?php  }?>
                       
                       

            var transweekchartdata = {
                labels: name,
                datasets: [
                    {
                        label: 'Business Transaction',
                        backgroundColor: '#ff6361',
                        borderColor: '#46d5f1',
                        hoverBackgroundColor: '#CCCCCC',
                        hoverBorderColor: '#666666',
                        data: marks
                    }
                ]
            };

            var transweekgraphTarget = $("#business_trans_week_chart");

            var transweekbarGraph = new Chart(transweekgraphTarget, {
                type: 'bar',
                data: transweekchartdata
            });
        }
        
        function showmonthswisebusinesstransaction()
        {
        	var name = [];
            var marks = [];

                <?php for($i=0;$i<count($month_wise_business_transaction);$i++){   //echo $month_wise_lead_total_sale[$i];
                    
                    ?>
                        name.push("<?=$month_wise_business_transaction[$i];?>");
                        
                    <?php  }?>
                    <?php for($i=0;$i<count($month_wise_total_business_transaction);$i++){   //echo $month_wise_lead_total_sale[$i];
                    
                    ?>
                        marks.push("<?=$month_wise_total_business_transaction[$i];?>");
                        
                    <?php  }?>
                       
                       

            var transmonthchartdata = {
                labels: name,
                datasets: [
                    {
                        label: 'Business Transaction',
                        backgroundColor: '#ff6361',
                        borderColor: '#46d5f1',
                        hoverBackgroundColor: '#CCCCCC',
                        hoverBorderColor: '#666666',
                        data: marks
                    }
                ]
            };

            var transmonthgraphTarget = $("#business_trans_month_chart");

            var transweekbarGraph = new Chart(transmonthgraphTarget, {
                type: 'bar',
                data: transmonthchartdata
            });
        }
       
        
        
        
        </script>

<?php } ?>
   


  
</body>
</html>