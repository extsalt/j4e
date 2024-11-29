<script type="text/javascript">
    (function (window, document, $, undefined) {

        $(function () {
            // For some browsers, `attr` is undefined; for others,
            // `attr` is false.  Check for both.
            if (ttable) {
                var newAtt = $("#" + attr).attr('id');
                var dtable = '[id=' + ttable + ']';
            } else {
                var dtable = '[id^=DataTables]';
            }


            var total_header = ($('table#DataTables th:last').index());
            var testvar = [];
            for (var i = 0; i < total_header; i++) {
                testvar[i] = i;
            }
            var length_options = [10, 25, 50, 100];
            var length_options_names = [10, 25, 50, 100];

            var tables_pagination_limit =<?= config_item('tables_pagination_limit')?>;
            tables_pagination_limit = parseFloat(tables_pagination_limit);

            if ($.inArray(tables_pagination_limit, length_options) == -1) {
                length_options.push(tables_pagination_limit);
                length_options_names.push(tables_pagination_limit)
            }
            length_options.sort(function (a, b) {
                return a - b;
            });
            length_options_names.sort(function (a, b) {
                return a - b;
            });

            table = $(dtable).dataTable({
                'responsive': true,  // Table pagination
                "processing": true,
                "serverSide": true,
                //"bInfo" : false,
                "pageLength": tables_pagination_limit,
                "aLengthMenu": [length_options, length_options_names],
                'dom': 'lBfrtip',  // Bottom left status text
                buttons: [
                    {
                        extend: 'print',
                        text: "<i class='fa fa-print'> </i>",
                        className: 'btn btn-danger btn-sm mr',
                        titleAttr: 'Print',
                        exportOptions: {
                            columns: [testvar[0], testvar[1], testvar[2], testvar[3], testvar[4], testvar[5]]
                        }
                    },
                    {
                        extend: 'print',
                        titleAttr: 'Print Selected',
                        text: "<i class='fa fa-print'> </i> &nbsp;<?= lang('selected')?>",
                        className: 'btn btn-success mr btn-sm',
                        exportOptions: {
                            modifier: {
                                selected: true,
                                columns: [testvar[0], testvar[1], testvar[2], testvar[3], testvar[4], testvar[5]]
                            }
                        }

                    },
                    {
                        extend: 'excel',
                        titleAttr: 'Excel',
                        text: '<i class="fa fa-file-excel-o"> </i>',
                        className: 'btn btn-purple mr btn-sm',
                        exportOptions: {
                            columns: [testvar[0], testvar[1], testvar[2], testvar[3], testvar[4], testvar[5]]
                        }
                    },
                    {
                        extend: 'csv',
                        titleAttr: 'CSV',
                        text: '<i class="fa fa-file-excel-o"> </i>',
                        className: 'btn btn-primary mr btn-sm',
                        exportOptions: {
                            columns: [testvar[0], testvar[1], testvar[2], testvar[3], testvar[4], testvar[5]]
                        }
                    },
                    {
                        extend: 'pdf',
                        titleAttr: 'PDF',
                        text: '<i class="fa fa-file-pdf-o"> </i>',
                        className: 'btn btn-info mr btn-sm',
                        exportOptions: {
                            columns: [testvar[0], testvar[1], testvar[2], testvar[3], testvar[4], testvar[5]]
                        }
                    },
                ],
                select: true,
                "order": [],
                "ajax": {
                    url: list,
                    type: "POST",
                    error: function (xhr, error, thrown) {
                        console.log(xhr.responseText);
                    },
                    data: function (d) {
                        d.csrf_token = getCookie('csrf_cookie');
                    },

                },
                'fnCreatedRow': function (nRow, aData, iDataIndex) {
                    $(nRow).attr('id', 'table_' + iDataIndex); // or whatever you choose to set as the id
                },
                // Text translation options
                // Note the required keywords between underscores (e.g _MENU_)
                oLanguage: {
                    sSearch: "<?= lang('search_all_column')?>",
                    sLengthMenu: "_MENU_",
                    zeroRecords: "<?= lang('nothing_found_sorry')?>",
                    infoEmpty: "<?= lang('no_record_available')?>",
//                    infoFiltered: "(<?= lang('filtered_from')?> _MAX_ <?= lang('total')?> <?= lang('records')?>)"
                    infoFiltered: ""
                }


            });

        });

    })(window, document, window.jQuery);

    function getCookie(name) {
        var cookieValue = null;
        if (document.cookie && document.cookie != '') {
            var cookies = document.cookie.split(';');
            for (var i = 0; i < cookies.length; i++) {
                var cookie = jQuery.trim(cookies[i]);
                // Does this cookie string begin with the name we want?
                if (cookie.substring(0, name.length + 1) == (name + '=')) {
                    cookieValue = decodeURIComponent(cookie.substring(name.length + 1));
                    break;
                }
            }
        }
        return cookieValue;
    }
    function reload_table() {
        table.api().ajax.reload();
    }
    function table_url(url) {
        table.api().ajax.url(url).load();
    }
</script>

<script type="text/javascript">
    $(document).ready(function () {
        $('#datatable_action1').dataTable({
//            paging: false,
//            "bSort": false,
            'dom': 'lBfrtip',  // Bottom left status text
            buttons: [
                {
                    extend: 'print',
                    titleAttr: 'Print',
                    text: "<i class='fa fa-print'> </i>",
                    className: 'btn btn-danger btn-sm mr',
                },
                {
                    extend: 'print',
                    titleAttr: 'Print Selected',
                    text: "<i class='fa fa-print'> </i> &nbsp;<?= lang('selected')?>",
                    className: 'btn btn-success mr btn-sm',

                },
                {
                    extend: 'excel',
                    titleAttr: 'Excel',
                    text: '<i class="fa fa-file-excel-o"> </i>',
                    className: 'btn btn-purple mr btn-sm',
                },
                {
                    extend: 'csv',
                    titleAttr: 'CSV',
                    text: '<i class="fa fa-file-excel-o"> </i>',
                    className: 'btn btn-primary mr btn-sm',
                },
                {
                    extend: 'pdf',
                    titleAttr: 'PDF',
                    text: '<i class="fa fa-file-pdf-o"> </i>',
                    className: 'btn btn-info mr btn-sm',
                }
            ],
        //scrollX: true
//            select: true,
        });
        $('#datatable_action3').dataTable({
//            paging: false,
//            "bSort": false,
            'dom': 'lBfrtip',  // Bottom left status text
            buttons: [
                {
                    extend: 'print',
                    titleAttr: 'Print',
                    text: "<i class='fa fa-print'> </i>",
                    className: 'btn btn-danger btn-sm mr',
                },
                {
                    extend: 'print',
                    titleAttr: 'Print Selected',
                    text: "<i class='fa fa-print'> </i> &nbsp;<?= lang('selected')?>",
                    className: 'btn btn-success mr btn-sm',

                },
                {
                    extend: 'excel',
                    titleAttr: 'Excel',
                    text: '<i class="fa fa-file-excel-o"> </i>',
                    className: 'btn btn-purple mr btn-sm',
                },
                {
                    extend: 'csv',
                    titleAttr: 'CSV',
                    text: '<i class="fa fa-file-excel-o"> </i>',
                    className: 'btn btn-primary mr btn-sm',
                },
                {
                    extend: 'pdf',
                    titleAttr: 'PDF',
                    text: '<i class="fa fa-file-pdf-o"> </i>',
                    className: 'btn btn-info mr btn-sm',
                }
            ],
        //scrollX: true
//            select: true,
        });
        $('#datatable_action2').dataTable({
//            paging: false,
            "bSort": false,
            'dom': 'lBfrtip',  // Bottom left status text
            buttons: [
                {
                    extend: 'print',
                    titleAttr: 'Print',
                    text: "<i class='fa fa-print'> </i>",
                    className: 'btn btn-danger btn-sm mr',
                },
                {
                    extend: 'print',
                    titleAttr: 'Print Selected',
                    text: "<i class='fa fa-print'> </i> &nbsp;<?= lang('selected')?>",
                    className: 'btn btn-success mr btn-sm',

                },
                {
                    extend: 'excel',
                    titleAttr: 'Excel',
                    text: '<i class="fa fa-file-excel-o"> </i>',
                    className: 'btn btn-purple mr btn-sm',
                },
                {
                    extend: 'csv',
                    titleAttr: 'CSV',
                    text: '<i class="fa fa-file-excel-o"> </i>',
                    className: 'btn btn-primary mr btn-sm',
                },
                {
                    extend: 'pdf',
                    titleAttr: 'PDF',
                    text: '<i class="fa fa-file-pdf-o"> </i>',
                    className: 'btn btn-info mr btn-sm',
                }
            ],
        //scrollX: true
//            select: true,
        });
         $('#example1').dataTable();
         $('#example2').dataTable();
         $('#example3').dataTable();
         $('#example4').dataTable();
         $('#example5').dataTable();
         $('#example6').dataTable();
         $('#example7').dataTable();
         $('#example8').dataTable();
         $('#example9').dataTable();
          $('#example11').dataTable( {
//          paging: false,
//            "bSort": false,
            'dom': 'lBfrtip',  // Bottom left status text
            buttons: [
                {
                    extend: 'print',
                    titleAttr: 'Print',
                    text: "<i class='fa fa-print'> </i>",
                    className: 'btn btn-danger btn-sm mr',
                },
                {
                    extend: 'print',
                    titleAttr: 'Print Selected',
                    text: "<i class='fa fa-print'> </i> &nbsp;<?= lang('selected')?>",
                    className: 'btn btn-success mr btn-sm',

                },
                {
                    extend: 'excel',
                    titleAttr: 'Excel',
                    text: '<i class="fa fa-file-excel-o"> </i>',
                    className: 'btn btn-purple mr btn-sm',
                },
                {
                    extend: 'csv',
                    titleAttr: 'CSV',
                    text: '<i class="fa fa-file-excel-o"> </i>',
                    className: 'btn btn-primary mr btn-sm',
                },
                {
                    extend: 'pdf',
                    titleAttr: 'PDF',
                    text: '<i class="fa fa-file-pdf-o"> </i>',
                    className: 'btn btn-info mr btn-sm',
                }
            ],
        //scrollX: true
//            select: true,
        initComplete: function () {
            this.api().columns([7,8,9]).every( function () {
                var column = this;
                var select = $('<select><option value=""></option></select>')
                    .appendTo( $(column.footer()).empty() )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
 
                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );
 
                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
            } );
        }
        
    } );
    });
    
</script>

<script>
    
    $(document).ready(function() {
    $('#idelusertable').DataTable();
} );
    
    
    
</script>
<script>
    $(document).ready(function() {
    var table = $('#reporttable').DataTable( {
            paging: true,
            "bSort": true,
            
            'dom': 'Bfrtip',  // Bottom left status text
            buttons: [
                {
                    extend: 'print',
                    titleAttr: 'Print',
                    text: "<i class='fa fa-print'> </i>",
                    className: 'btn btn-danger btn-sm mr',
                },
                
                {
                    extend: 'excel',
                    titleAttr: 'Excel',
                    text: '<i class="fa fa-file-excel-o"> </i>',
                    className: 'btn btn-purple mr btn-sm',
                },
                {
                    extend: 'csv',
                    titleAttr: 'CSV',
                    text: '<i class="fa fa-file-excel-o"> </i>',
                    className: 'btn btn-primary mr btn-sm',
                },
                
            ],
            

    } );
 
    table.buttons().container()
        .appendTo( '#example_wrapper .col-md-6:eq(0)' );
} );
</script>