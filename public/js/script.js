if (pathname == 'expense' || pathname == 'rent') {
    $.fn.dataTableExt.afnFiltering.push(
        function(oSettings, aData, iDataIndex) {
            var iFini = document.getElementById('min').value;
            var iFfin = document.getElementById('max').value;
            var iStartDateCol = 2;
            var iEndDateCol = 2;
            
            iFini = iFini.substring(6, 10) + iFini.substring(3, 5) + iFini.substring(0, 2);
            iFfin = iFfin.substring(6, 10) + iFfin.substring(3, 5) + iFfin.substring(0, 2);
            
            var datofini = aData[iStartDateCol].substring(6, 10) + aData[iStartDateCol].substring(3, 5) + aData[
                iStartDateCol].substring(0, 2);
            var datoffin = aData[iEndDateCol].substring(6, 10) + aData[iEndDateCol].substring(3, 5) + aData[
                iEndDateCol].substring(0, 2);

            if (iFini === "" && iFfin === "") {
                return true;
            } else if (iFini <= datofini && iFfin === "") {
                return true;
            } else if (iFfin >= datoffin && iFini === "") {
                return true;
            } else if (iFini <= datofini && iFfin >= datoffin) {
                return true;
            }
            return false;
        }
    );
}

$(document).ready(function() {

    // DataBase Backup
    /* var proxyurl = "https://cors-anywhere.herokuapp.com/";
    var apiUrl = `https://mkdesignarts.in/Db_backup?dbname=fms&&user=root&pass=""`;
    $.ajax({
        url: proxyurl + apiUrl,
        method:"GET",
        dataType:'json',
        headers:{
            'Access-Control-Allow-Origin': '*',
            'Content-Type':'application/json'
        },
        success:function(res)
        {
            console.log(res);            
        }, 
        error:function(err){
            console.log(err);
        }
    }) */    

    $("form").addClass('form_reset');
    //Go back
    $(".goback").on('click',() => {        
        $(".form_reset")[0].reset()
        window.history.go(-1)        
    })
    var listItems = $(".sidebar-wrapper .nav .collapse .nav li a");
        listItems.each(function(idx, li) {
        if($(this).attr('href') == window.location.href) {
            $(this).parent().addClass('active');
            $(this).parent().parent().closest('li').addClass('active');
        }
        else {
            var href = $(this).attr('href').split('/').at(-1);
            var windowhref = window.location.href.split('/').at(-2);
            if(href == windowhref) {
                $(this).parent().addClass('active');
                $(this).parent().parent().closest('li').addClass('active');        
            }
        }
    });   
    
    if (pathname == '' || pathname == 'dashboard') {
        const COLORS = [
            '#b8d8d8',
            '#d5e5a3',
            '#f53e3e6b',
            '#d6c1ab',
            '#F3BB45',
            '#FFD662',
        ];

        var dcards = document.getElementById('dashboard-cards').getElementsByClassName('card');
        // console.log(COLORS[Math.floor(Math.random() * COLORS.length)]);
        var count = 0;
        for (var i = 0; i < dcards.length; i++) {
            dcards[i].style.backgroundColor = COLORS[count % COLORS.length];
            count++;
        }
    }
    
    if (pathname !== '' || pathname !== 'dashboard') {

        /* var table = $('#milk_sold_datatable').DataTable({
            "processing": true,
            "language": {
                processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> '
            },
            "serverSide": true,
            "responsive": true,
            deferRender: true,
            ajax: base_url+"/milk_entries",  
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            columns: [
                {data: 'id', name: 'id'},
                {data: 'customer_name', name: 'customer_name'},
                // {data: 'type', name: 'type'},
                {data: 'milk_rate', name: 'milk_rate'},
                {data: 'morning', name: 'morning'},
                {data: 'evening', name: 'evening'},
                {data: 'sold_date', name: 'sold_date'},
                {data: 'total_litres', name: 'total_litres'},
                // {data: 'amount_paid', name: 'amount_paid'},
                // {data: 'pending_amount', name: 'pending_amount'},
                {data: 'total_amount', name: 'total_amount'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
            "columnDefs": [
                { "visible": false, "targets": 5 }
            ],
            "order":false,
            "drawCallback": function ( settings ) {
                var api = this.api();
                var rows = api.rows( {page:'current'} ).nodes();
                var last=null;
     
                api.column(5, {page:'current'} ).data().each( function ( group, i ) {
                    if ( last !== group ) {
                        $(rows).eq( i ).before(
                            '<tr class="group"><td colspan="12"><b>'+group+'</b></td></tr>'
                        );
     
                        last = group;
                    }
                } );
            },
            dom: 'lBfrtip',
            buttons: [
                'pdf'
            ], 
        }); */

        /* $('#internal_datatable').DataTable({
            "processing": true,
            "language": {
                processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>'
            },
            "serverSide": true,
             deferRender: true,
            ajax: base_url+"/milk_collection/internal",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            columns: [
                {data: 'id', name: 'id'},
                {data: 'collection_date', name: 'collection_date'},
                {data: 'morning', name: 'morning'},
                {data: 'evening', name: 'evening'},
                // {data: 'grand_total', name: 'grand_total'},
                // {data: 'given', name: 'given'},
                // {data: 'givenreturn', name: 'givenreturn'},
                // {data: 'taken', name: 'taken'},
                // {data: 'takenreturn', name: 'takenreturn'},
                {data: 'total_litres', name: 'total_litres'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ], 
            "order":false,       
            dom: 'lBfrtip',
            buttons: [
                'pdf'
            ],
            responsive: true,
            // "pagingType": "simple",
        }); */

        /* $('#external_datatable').DataTable({
           "processing": true,
            "language": {
                processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> '
            },
            "serverSide": true,
             deferRender: true,
            ajax: base_url+"/milk_collection/external",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            columns: [
                {data: 'id', name: 'id'},
                {data: 'date', name: 'date'},
                {data: 'type', name: 'type'},
                // {data: 'party_name', name: 'party_name'},
                {data: 'morning', name: 'morning'},
                {data: 'evening', name: 'evening'},
                {data: 'total_litres', name: 'total_litres'},
                // {data: 'rate', name: 'rate'},
                // {data: 'total_amount', name: 'total_amount'},
                // {data: 'amount_paid', name: 'amount_paid'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ], 
            "order":false,
            dom: 'lBfrtip',
            buttons: [
                'pdf'
            ],
            responsive: true,
            "pagingType": "simple",
        });  */  

        $('#footer_datatable1,#footer_datatable2,#footer_datatable3').DataTable({
            "footerCallback": function(row, data, start, end, display) {
                var api = this.api(),
                    data;
                
                // Remove the formatting to get integer data for summation
                var intVal = function(i) {
                    return typeof i === 'string' ?
                        i.replace(/[\$,]/g, '') * 1 :
                        typeof i === 'number' ?
                        i : 0;
                };

                // Total over all pages
                total = api
                    .column(3)
                    .data()
                    .reduce(function(a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                // Total over this page
                pageTotal = api
                    .column(3, {
                        page: 'current'
                    })
                    .data()
                    .reduce(function(a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                // Update footer
                $(api.column(3).footer()).html(
                    'â‚¹' + pageTotal + ' ( â‚¹' + total + ' total)'
                );
            },
            dom: 'lBfrtip',
            buttons: [
                'pdf'
            ],
            responsive: true,
            "pagingType": "simple"
        });
    
        var table = $('#footer_datatable1,#footer_datatable3').DataTable();

        // Add event listeners to the two range filtering inputs
        if (pathname !== 'milk_collection') {
            $("#min,#max").on('keyup change', () => {
                table.draw();
            })
            $('#min').datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true,
                todayHighlight: true
            })
            $('#max').datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true,
                todayHighlight: true
            })
            $(".datepicker").datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true,
                todayHighlight: true,
            }).datepicker('update');

            $(".monthpicker").datepicker({
                viewMode: "months",
                minViewMode: "months",
                format: 'MM yyyy',
                autoclose: true,
            })

           /*  $('body').on('focus', ".datepicker", function() {
                $(this).datepicker({
                    format: 'yyyy-mm-dd',
                    autoclose: true,
                    todayHighlight: true,
                }).datepicker('update');
                $(this).attr('autocomplete', 'off');
            }); */
        }

        $('#weight_datatable,#food_amount_table,#category_amount_table').DataTable({
                order: [[5,'desc']],
                rowGroup: {
                    dataSrc: [5]
                },
                columnDefs: [{
                    targets: [5],
                    visible: false
                }],
                dom: 'lBfrtip',
                buttons: [
                    'pdf', 'print'
                ],
                responsive: true,
                "pagingType": "simple",

        });
        $('#group5dt').DataTable({
                rowGroup: {
                    dataSrc: [5]
                },
                columnDefs: [{
                    targets: [5],
                    visible: false
                }],
                dom: 'lBfrtip',
                buttons: [
                    'pdf', 'print'
                ],
                responsive: true,
                "pagingType": "simple",

        });

        $('#total_food_table').DataTable({
            order: [
                [6, 'asc'],
                [5, 'asc']
            ],
            rowGroup: {
                dataSrc: [6, 5]
            },
            columnDefs: [{
                targets: [5, 6],
                visible: false
            }],
            dom: 'lBfrtip',
            buttons: [
                'pdf'
            ],
            responsive: true,
            "pagingType": "simple"
        });

        $('#cat_manage_table').DataTable({
            order: [
                [5, 'asc'],
                [4, 'asc']
            ],
            rowGroup: {
                dataSrc: [5, 4]
            },
            columnDefs: [{
                targets: [4, 5],
                visible: false
            }],
            dom: 'lBfrtip',
            buttons: [
                'pdf'
            ],
            responsive: true,
            "pagingType": "simple"
        });

        $('#datatable,#datatable1,#datatable2').DataTable({
            dom: 'lBfrtip',
            buttons: [
                'pdf'
            ],
            "order": [],
            responsive: true,
            // "pagingType": "simple"
        });

        // var date = new Date();
        // var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());
        // var end = new Date(date.getFullYear(), date.getMonth(), date.getDate());

        $(".delete_all").html('<i class="fa fa-trash"></i>');

        $(".content .row .card .card-header a").addClass('float-right');
        $("<a href="+base_url+" class='btn btn-danger float-right'>Back to Dashboard</a>").insertBefore(".content .row .card .card-header a")
        // $("#datatable").wrap('<div class="table-responsive"></div>')
        // $("#datatable1").wrap('<div class="table-responsive"></div>')

        // For Modal Popups
        $("#show-insert-modal").on('click', function() {
            $("#modal-default").modal('show');
            $("#show_status").hide();
            $("#name").val('');
            $("#status").val('');
            $("#insert").val('Submit');
            $("#hidden_loc_id").val('');
        });

        $("#show-khilla-modal").on('click', function() {
            $("#modal-default1").modal('show');
            $("#modal-default1 .show_on_edit").hide();
            $("#modal-default1 .show_on_add").show();
            $("#location_id").val('');
            $("#khilla_no").val('');
            $("#modal-default1 #status").val('');
            $("#modal-default1 #insert").val('Submit');
            $("#hidden_khilla_id").val('');
        });

        $("#show-cat-modal").on('click', function() {
            $("#cat-modal").modal('show');
            $("#cat-modal #show_status").hide();
            $("#cat-modal #p_name").val('');
            $("#cat-modal #status").val('');
            $("#cat-modal #insert").val('Submit');
            $("#hidden_prod_id").val('');
        });

        // For Location
        $(document).on('click', '.edit_location', function() {
            var id = $(this).attr("id");
            $("#show_status").show();
            $.ajax({
                url: base_url+"/location/" + id + "/edit",
                method: 'GET',
                data: {
                    id: id
                },
                dataType: "json",
                success: function(data) {
                    console.log(data);
                    $("#modal-default").modal('show');
                    $("#hidden_loc_id").val(id);
                    $("#name").val(data.location.name);
                    $("#status").val(data.location.status);
                    $("#insert").val('Update');
                }
            });
        });

        // For Khilla
        $(document).on('click', '.edit_khilla', function() {
            var id = $(this).attr("id");
            $("#modal-default1 .show_on_edit").show();
            $("#modal-default1 .show_on_add").hide();
            $("#modal-default1 #show_textboxes").find('.col-md-4').remove();
            $.ajax({
                url: base_url+"/location/khilla/" + id + "/edit",
                method: 'GET',
                data: {
                    id: id
                },
                dataType: "json",
                success: function(data) {
                    // console.log(data);
                    $("#modal-default1").modal('show');
                    $("#hidden_khilla_id").val(id);
                    $("#location_id").val(data.khillas.location_id);
                    $("#khilla_no").val(data.khillas.khilla_no);
                    $("#modal-default1 #status").val(data.khillas.status);
                    $("#modal-default1 #insert").val('Update');
                    $("#modal-default1 #edit_khilla_label").text('Khilla No.');

                    $("#khilla_no").on('keyup', function() {
                        $("#preloader").show();
                        var no = $(this).val();
                        var id = $("#location_id").val();
                        $.ajax({
                            url: base_url+"/location/api/" + id +
                                '/' + no,
                            method: "GET",
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: {
                                no: no
                            },
                            contentType: false,
                            processData: false,
                            success: function(res) {
                                $("#preloader").hide();
                                if (res.status == -1) {
                                    $("#modal-default1 #check_no").text(
                                        res.msg);
                                    $("#modal-default1 #insert").attr(
                                        'disabled', true);
                                } else {
                                    $("#modal-default1 #check_no").text(
                                        res.msg);
                                    $("#modal-default1 #insert").attr(
                                        'disabled', false);
                                }

                            }
                        })
                    })
                }
            });
        });

        // For Add Khilla Button
        var count = 0;

        function add_khilla_no_text() {
            count += 1;
            var html = '';
            html += '<div class="col-md-4">';
            html += '<input type="number" id="khilla_no_' + count +
                '" name="khilla_no[]" class="form-control check_khilla_no" placeholder="Enter ...">';
            html += '<div class="delete_row_icon text-center text-danger"><i class="fa fa-trash"></i></div>';
            html += '</div>';
            $('#show_textboxes').append(html);
        }

        $(document).on('click', '.insert_khilla', function() {

            var allkhillaNos = [];
            $(".check_khilla_no").each(function() {
                allkhillaNos.push($(this).val())
            })
            var sorted_arr = allkhillaNos.sort();
            for (var i = 0; i < allkhillaNos.length - 1; i++) {
                if (sorted_arr[i + 1] == sorted_arr[i]) {
                    alert("Please enter different Khilla No. in each TextBox.");
                    return false;
                }
            }
        });

        $(document).on('click', '.add_row_icon', function(e) {
            add_khilla_no_text();
        });

        $(document).on('click', '.delete_row_icon', function(e) {
            $(this).closest('.col-md-4').remove();
        });

        // For Add Location In Product Stock Button
        var count = 0;

        function add_PLk_in_product_stock() {
            count += 1;
            var html = '';
            html += '<div class="row">';
            html += '<div class="col-md-3">';
            html += '<input type="text" id="product_no_' + count +
                '" name="product_no[]" class="form-control dnproduct_no" required placeholder="Product No.">';
            html += '</div>';
            html += '<div class="col-md-3">';
            html +=
                '<select class="form-control get_all_location get_dynamic_khillno_on_change dnlocation_id" name="location_id[]" data-loc-id="' +
                count + '" id="location_id_' + count + '" required>';
            html += get_d_location();
            html += '</select>';
            html += '</div>';
            html += '<div class="col-md-3">';
            html +=
                '<select class="form-control get_dynamic_khilla_options dnkhilla_no" name="khilla_no[]" id="dynamic_khilla_no' +
                count + '" required>';
            html += '</select>';
            html += '</div>';
            html += '<div class="col-md-3">';
            html += '<div class="btn btn-sm btn-danger delete_row_icon1"><i class="fa fa-trash"></i></div>';
            html += '</div>';
            html += '</div>';
            $('#show_textboxes1').append(html);
        }
        
        $(document).on('click', '.add_row_icon1', function(e) {
            add_PLk_in_product_stock();
        });
        
        // For Dynamic Product Stock khilla        
        $(document).on('change', '.get_dynamic_khillno_on_change', function(e) {
            var id = $(this).val();
            var didcount = $(this).attr('data-loc-id');
            $.ajax({
                url: base_url+"/product/stock/api/" + id,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method: "GET",
                data: {
                    id: id
                },
                contentType: false,
                processData: false,
                success: function(res) {
                    var html = '';
                    html += '<option value="" selected disabled>--select--</option>';
                    var pkhilla = [];
                    for (var k in res.data2) {
                        pkhilla[k] = res.data2[k].khilla_no;
                    }
                    var mkhilla = [];
                    for (var l in res.data) {
                        mkhilla[l] = res.data[l].khilla_no;
                    }
                    var newkhilla = mkhilla.filter(r => !pkhilla.includes(r));
                    if (newkhilla.length > 0) {
                        for (var i in newkhilla) {
                            html +=
                                `<option value="${newkhilla[i]}">${newkhilla[i]}</option>`;
                        }
                    } else {
                        html +=
                            `<option value="" selected disabled>No Khilla Available</option>`;
                    }

                    $("#dynamic_khilla_no" + didcount).html(html);
                }
            })
        });

        function get_d_location() {
            $.ajax({
                url: base_url+"/product/stock/pkl_api",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method: "GET",
                contentType: false,
                processData: false,
                success: function(res) {
                    console.log(res);
                    var html = '';
                    html += '<option value="" selected disabled>--select--</option>';
                    for (var i in res) {
                        html += '<option value="' + res[i].id + '">' + res[i].name + '</option>';
                    }
                    $(".get_all_location").html(html);
                    // return html;
                }
            })
        }


        $(document).on('click', '.insert_product_stock', function() {

            var allProductNos = [];
            $(".dnproduct_no").each(function() {
                allProductNos.push($(this).val())
            })
            var sorted_arr = allProductNos.sort();
            for (var i = 0; i < allProductNos.length - 1; i++) {
                if (sorted_arr[i + 1] == sorted_arr[i]) {
                    alert("Please enter different Product No. in each TextBox.");
                    return false;
                }
            }
        });


        $(document).on('click', '.delete_row_icon1', function(e) {
            $(this).closest('.row').remove();
        });

        // For Dynamic External collection
       /*  var count = 0;

        function add_ext_col_rows() {
            count += 1;
            var html = '';
            html += '<tr>';
            // html += '<td><input type="text" class="form-control datepicker" id="external_collection_date_' + count + '" name="external_collection_date[]" required></td>';
            html += '<td><select class="form-control" name="collection_type[]" id="collection_type_' + count +
                '">';
            html +=
                '<option value="given">Given</option><option value="taken">Taken</option><option value="givenreturn">GivenReturn</option><option value="takenreturn">TakenReturn</option>';
            html += '</select></td>';
            html += '<td><select class="form-control get_all_party_name" name="party_name[]" id="party_name_' +
                count + '">';
            html += get_party_name();
            html += '</select></td>';
            html += '<td><input type="text" class="form-control" id="ext_party_name_' + count +
                '" name="ext_party_name[]"></td>';
            html += '<td><input type="text" class="form-control" id="ext_morning_' + count +
                '" name="ext_morning[]" step="0.1" min="0" value="0" required></td>';
            html += '<td><input type="text" class="form-control" id="ext_evening_' + count +
                '" name="ext_evening[]" step="0.1" min="0" value="0" required></td>';
            html += '<td><input type="text" class="form-control" id="ext_rate_' + count +
                '" name="ext_rate[]" step="0.1" min="0" value="0" required></td>';
            html += '<td><input type="text" class="form-control" id="amount_paid_' + count +
                '" name="amount_paid[]" value="0" required></td>';
            html +=
                '<td><div class="btn btn-sm btn-danger del_ext_col_rows text-center"><i class="fa fa-minus"></i></div></td></tr>';
            $('#append_ext_col_rows').append(html);
        }

        // add_ext_col_rows();

        function get_party_name() {
            $.ajax({
                url: base_url+"/sold/api",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method: "GET",
                contentType: false,
                processData: false,
                success: function(res) {
                    var html = '';
                    html += '<option value=" " selected>--select--</option>';
                    for (var i in res) {
                        html += '<option value="' + res[i].customer_name + '">' + res[i]
                            .customer_name + '</option>';
                    }
                    $(".get_all_party_name").html(html);

                }
            })
        }


        $(document).on('click', '.add_ext_col_rows', function(e) {
            add_ext_col_rows();
        });

        $(document).on('click', '.del_ext_col_rows', function() {
            $(this).closest('tr').remove();
        }); */        

        // For Dynamic Normal Customer
        /* var count = 0;

        function add_nor_cust_rows() {
            count += 1;
            var html = '';
            html += '<tr>';
            html += '<td><input type="text" class="form-control" id="normal_customer_name_' + count +
                '" name="normal_customer_name[]" required></td>';
            html += '<input type="hidden" class="form-control" id="customer_type_' + count +
                '" name="ncustomer_type[]" value="Normal Customer" required>';
            html += '<td><input type="text" class="form-control getme_data get_me_nr_data" id="morning_' + count +
                '" name="nmorning[]" value="0" min="0" value="0" required></td>';
            html += '<td><input type="text" class="form-control getme_data get_me_nr_data" id="evening_' + count +
                '" name="nevening[]" step="0.1" min="0" value="0" required></td>';
            html += '<td><input type="text" class="form-control" id="milk_rate_' + count +
                '" name="nmilk_rate[]" step="0.1" min="0" value="0" required></td>';
            html +=
                '<td><div class="btn btn-sm btn-danger del_nor_cust_rows text-center"><i class="fa fa-minus"></i></div></td></tr>';
            $('#append_nor_cust_rows').append(html);
        }

        // add_nor_cust_rows();

        $(document).on('click', '.add_nor_cust_rows', function(e) {
            add_nor_cust_rows();
        });

        $(document).on('click', '.del_nor_cust_rows', function() {
            $(this).closest('tr').remove();
            $(this).closest('tr').find('.get_me_nr_data').each(function() {
                $(this).val('0');
                total_collection();
            })
        }); */


        // For Categories
        $(document).on('click', '.edit_product', function() {
            var id = $(this).attr("id");
            $("#cat-modal #show_status").show();
            $.ajax({
                url: base_url+"/categories/" + id + "/edit",
                method: 'GET',
                data: {
                    id: id
                },
                dataType: "json",
                success: function(data) {
                    $("#cat-modal").modal('show');
                    $("#hidden_prod_id").val(id);
                    $("#cat-modal #p_name").val(data.product.product_name);
                    $("#cat-modal #status").val(data.product.status);
                    $("#cat-modal #insert").val('Update');
                }
            });
        });

        // For WEight
        $(document).on('click', '.edit_weight', function() {
            var id = $(this).attr("id");
            $.ajax({
                url: base_url+"/weight/" + id + "/edit",
                method: 'GET',
                data: {
                    id: id
                },
                dataType: "json",
                success: function(data) {
                    console.log(data);
                    $("#weight-modal").modal('show');
                    $("#hidden_weight_id").val(id);
                    $("#weight-modal #product_id").val(data.weights.pid);
                    $("#weight-modal #product_name").val(data.weights.product_name);
                    $("#weight-modal #product_no").val(data.weights.product_no);
                    $("#weight-modal #morning").val(data.weights.morning);
                    $("#weight-modal #evening").val(data.weights.evening);
                }
            });
        });

        // For External Collection
        $(document).on('click', '.edit_collection', function() {
            var id = $(this).attr("id");
            $.ajax({
                url: base_url+"/external_collection/" + id + "/edit/" + 1,
                method: 'GET',
                data: {
                    id: id
                },
                dataType: "json",
                success: function(data) {
                    console.log(data);
                    $("#collection-modal").modal('show');
                    $("#hidden_collection_id").val(id);
                    $("#collection-modal #collection_date").val(data.collection.collection_date);
                    $("#collection-modal #morning").val(data.collection.morning);
                    $("#collection-modal #evening").val(data.collection.evening);
                    $("#collection-modal #given").val(data.collection.given);
                    $("#collection-modal #givenreturn").val(data.collection.givenreturn);
                    $("#collection-modal #taken").val(data.collection.taken);
                    $("#collection-modal #takenreturn").val(data.collection.takenreturn);
                    $("#collection-modal #total_litres").val(data.collection.total_litres);
                    $("#collection-modal #grand_total").val(data.collection.grand_total);
                }
            });
        });

        // For Deleting All
        $(document).on('click', '.delete_all', function(e) {
           
            e.preventDefault();
            var id = $(this).attr('id');
            var url = $(this).attr('url');
            var param = $(this).attr('tbname');
            var qty = $(this).attr('qty');
            if(url == "billing" || url == 'stock/in') {
                var deleteurl = `${base_url}/${url}/delete/${id}/${param}`; 
            }
            else if(url == 'stock/out') {
                var deleteurl = `${base_url}/${url}/delete/${id}/${param}/${qty}`;
            }
            else {
                var deleteurl = `${base_url}/${url}/delete/${id}`;
            }
            Swal.fire({
                title: 'Are you sure you want to delete?(શું તમે ખરેખર કાઢી નાખવા માંગો છો?)',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#FE6774',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {
                    $("#preloader").show();
                    $.ajax({
                        // url: base_url+"/" + url + "/" + "delete/" + id,
                        url : deleteurl,
                        method: "DELETE",
                        data: {
                            id: id
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        dataType: 'json',
                        success: function(res) {
                            $("#preloader").hide();
                            if (res.status == 1) {
                                Swal.fire(
                                    'Deleted!',
                                    'Successfully Deleted',
                                    'success',
                                    window.location.href = window.location.pathname,
                                )
                            }
                            else {
                                Swal.fire(
                                    'Error!',
                                    res.msg,
                                    'error',
                                )
                            }
                        }
                    });
                }
            });
        });


        // For Collection
        if ($("#change_type").val() == 'Internel') {
            $("#show_on_external").hide();
        }
        $("#change_type").on('change', function() {
            if ($(this).val() == 'External') {
                $("#show_on_external").show();
            } else {
                $("#remove_party_name").val('');
                $("#show_on_external").hide();
            }
        })

        // For Sold
        if ($("#customer_type").val() == 'Regular Customer') {
            $("#show_select").show();
            $(".show_on_normal").hide();
            // $("#milk_rate,#morning,#evening").attr('readonly',true)
            $("#remove_normal_c_name").val('');
        }
        if ($("#customer_type").val() == 'Normal Customer') {
            $("#remove_regular_c_name").val('');
            $(".hide_on_normal").hide();
        }
        $("#customer_type").on('change', function() {
            if ($(this).val() == 'Normal Customer') {
                $("#customer_name").val('');
                $(".show_on_normal").show();
                $(".hide_on_normal").hide();
                $("#milk_rate,#morning,#evening").attr('readonly', false)
                $("#milk_rate").val('');
                $("#morning,#evening").val(0);
                $("#select_on_change").attr('checked', false);
                $("#remove_regular_c_name").val('');
            } else {
                $("#milk_rate,#morning,#evening").attr('readonly', true)
                $("#remove_normal_c_name").val('');
                $("#remove_amount_paid").val('');
                $(".show_on_normal").hide();
                $(".hide_on_normal").show();
            }
        })

        // For Milk Sold
        /* $("#milk_sold_form #customer_name").on('change', function() {
            var id = $(this).val();                
            $.ajax({
                url:base_url+"/sold/api/"+id,
                method:"GET",
                data:{id:id},
                contentType:false,
                processData:false,
                success:function(res)
                {
                    $("#show_select").show();
                    $("#milk_rate").val(res[0].milk_rate);
                    $("#morning").val(res[0].morning);
                    $("#evening").val(res[0].evening);
                    $("#milk_rate,#morning,#evening").attr('readonly',true)
                    
                }
            })        
        }); */

        // For Sold On Tick
        $("#milk_sold_form #select_on_change").click(function() {
            if ($(this).is(':checked')) {
                $("#milk_rate,#morning,#evening").attr('readonly', false)
            } else {
                $("#milk_rate,#morning,#evening").attr('readonly', true)
            }
        })


        // For Medical
        $("#medical_units").on('change', function() {
            $("#show_on_units").show();
            var name = $(this).val();
            if (name == 'units') {
                $(".change_on_units").text('Units')
            }
            if (name == 'boxes') {
                $(".change_on_units").text('Boxes')
            }
            if (name == 'litres') {
                $(".change_on_units").text('Litres')
            }
        });

        // For Food        
        var map = {};
        $('#food_stock_use_form .item_name option').each(function() {
            if (map[this.value]) {
                $(this).remove()
            }
            map[this.value] = true;
        })

        $("#get_month_on_change").on('change', function() {
            var id = $(this).val();
            var url = $(this).attr('url');
            $.ajax({
                url: base_url+"" + url + id,
                method: "GET",
                data: {
                    id: id
                },
                contentType: false,
                processData: false,
                success: function(res) {
                    var html = ''
                    html = '<option value="" disabled selected>--Select--</option>';
                    for (var i in res.data) {
                        html += '<option value="' + res.data[i].month + '">' + res.data[i]
                            .month + '</option>'
                    }
                    $("#get_month_options").html(html);
                }
            })
        });

        // For Product Stock
        $("#get_stock_name_on_change").on('change', function() {
            var id = $(this).val();
            $.ajax({
                url: base_url+"/salve/api/" + id,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method: "GET",
                data: {
                    id: id
                },
                contentType: false,
                processData: false,
                success: function(res) {
                    var html = ''
                    html = '<option value="" disabled selected>--Select--</option>';
                    for (var i in res.data) {
                        html += '<option value="' + res.data[i].product_no + '">' + res
                            .data[i].stock_p_name + ' ' + res.data[i].product_no +
                            '</option>'
                    }
                    $("#get_stock_options").html(html);
                }
            })
        });

        // For Product Stock khilla        
        $(document).on('change', '.get_khillno_on_change', function(e) {
            var id = $(this).val();
            $.ajax({
                url: base_url+"/product/stock/api/" + id,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method: "GET",
                data: {
                    id: id
                },
                contentType: false,
                processData: false,
                success: function(res) {
                    var html = '';
                    html += '<option value="" selected disabled>--select--</option>';
                    var pkhilla = [];
                    for (var k in res.data2) {
                        pkhilla[k] = res.data2[k].khilla_no;
                    }
                    var mkhilla = [];
                    for (var l in res.data) {
                        mkhilla[l] = res.data[l].khilla_no;
                    }
                    var newkhilla = mkhilla.filter(r => !pkhilla.includes(r));
                    if (newkhilla.length > 0) {
                        for (var i in newkhilla) {
                            html +=
                                `<option value="${newkhilla[i]}">${newkhilla[i]}</option>`;
                        }
                    } else {
                        html +=
                            `<option value="" selected disabled>No Khilla Available</option>`;
                    }

                    $(".get_khilla_options").html(html);
                }
            })
        });

        // For product stock No
        $("#prod_stock_form #product_no").on('keyup', function() {
            $("#preloader").show();
            var no = $(this).val();
            $.ajax({
                url: base_url+"/product/api/" + no,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method: "GET",
                data: {
                    no: no
                },
                contentType: false,
                processData: false,
                success: function(res) {
                    $("#preloader").hide();
                    if (res.status == '0') {
                        $("#prod_stock_form #check_prod_no").text(res.msg);
                        $("#prod_stock_form #insert").attr('disabled', true);
                    } else {
                        $("#prod_stock_form #check_prod_no").text(res.msg);
                        $("#prod_stock_form #insert").attr('disabled', false);
                    }

                }
            })
        })

        // For Unique Name
        $(".check_unq_name").on('keyup', function() {
            $("#preloader").show();
            var name = $(this).val();
            var table = $(this).attr('tb-name');
            var col = $(this).attr('tb-col');
            $.ajax({
                url: base_url+"/common/api/" + name + '/' + table + '/' + col,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method: "GET",
                data: {
                    name: name,
                    table: table,
                    col: col
                },
                contentType: false,
                processData: false,
                success: function(res) {
                    $("#preloader").hide();
                    if (res.status == -1) {
                        $(".error-unq-name").text(res.msg);
                        $(".disable_on_unq_name").attr('disabled', true);
                    } else {
                        $(".error-unq-name").text(res.msg);
                        $(".disable_on_unq_name").attr('disabled', false);
                    }
                }
            })
        })

        // For Processing Validation
        $(".p_submit").on('click', function() {

            var select_length = [];
            var note = '';
            var afdate = '';
            $('.select_process:checked').not(":disabled").each(function() {
                select_length.push($(this).val())
                note = $(this).closest('tr').find('.note').val();
                afdate = $(this).closest('tr').find('.afdate').val();
            });
            if (select_length.length > 0) {
                if (afdate == '') {
                    if ($(".is_processed_or_not").val() == 'yes') {
                        $("#process_alert strong").text('Please Enter Acutal Processing Date');
                    }
                    if ($(".is_processed_or_not").val() == 'no') {
                        $("#process_alert strong").text('Please Enter Further Processing Date');
                    }
                    $("#process_alert").addClass('d-block');
                    $("#process_alert").removeClass('d-none');
                    return false;
                } else if (note == '') {
                    $("#process_alert strong").text('Please Enter Notes');
                    $("#process_alert").addClass('d-block');
                    $("#process_alert").removeClass('d-none');
                    return false;
                } else {
                    return true;
                }
            } else {
                $("#process_alert strong").text('Please Select Atleast One Checkbox');
                $("#process_alert").addClass('d-block');
                $("#process_alert").removeClass('d-none');
                return false;
            }
        });

        // For Medical Validation 
        $(".m_submit").on('click', function() {
            var select_length = [];
            var note = '';
            var deliverydate = '';
            $('.select_process:checked').not(":disabled").each(function() {
                select_length.push($(this).val())
                note = $(this).closest('tr').find('.note').val();
                deliverydate = $(this).closest('tr').find('.deliverydate').val();
            });
            if (select_length.length > 0) {
                if ($(".is_pregnant_or_not").val() == 'yes') {
                    if (deliverydate == '') {
                        $("#process_alert strong").text('Please Enter Delivery Date');
                        $("#process_alert").addClass('d-block');
                        $("#process_alert").removeClass('d-none');
                        return false;
                    } else if (note == '') {
                        $("#process_alert strong").text('Please Enter Notes');
                        $("#process_alert").addClass('d-block');
                        $("#process_alert").removeClass('d-none');
                        return false;
                    } else {
                        return true;
                    }
                }

            } else {
                $("#process_alert strong").text('Please Select Atleast One Checkbox');
                $("#process_alert").addClass('d-block');
                $("#process_alert").removeClass('d-none');
                return false;
            }
        });

        // For Send to Salve checkbox  
        $("#ghabhan_form #status").on('change', function() {
            $("#ghabhan_form button").attr('disabled', false);
            if ($(this).val() == 'send_salves') {
                $("#show_on_salve_tick").show();
                $("#show_on_process").hide();
                $("#show_on_salve_tick #salve_name,#show_on_salve_tick #salve_location,#show_on_salve_tick #salves_date")
                    .attr('required', true);

            } else {
                $("#show_on_salve_tick #salve_name,#show_on_salve_tick #salve_location,#show_on_salve_tick #salves_date")
                    .attr('required', false);
            }
            if ($(this).val() == 'back_process') {
                $("#show_on_salve_tick").hide();
                $("#show_on_process").show();
                $("#show_on_process #note,#show_on_process #back_to_process_date").attr('required',
                    true);
            } else {
                $("#show_on_process #note,#show_on_process #back_to_process_date").attr('required',
                    false);
            }
        });
        /* $("#ghabhan_form #send_to_salves_check").click(function()  {          
            if($(this).is(':checked')) {
                $("#show_on_salve_tick").show();
                $(this).attr('value','yes');
                $("#show_on_salve_tick #salve_name,#show_on_salve_tick #salve_location,#show_on_salve_tick #salves_date").attr('required',true);
                $("#ghabhan_form button").attr('disabled',false);
            }
            else {
                $("#show_on_salve_tick").hide();
                $(this).attr('value','no');
                $("#show_on_salve_tick #salve_name,#show_on_salve_tick #salve_location,#show_on_salve_tick #salves_date").attr('required',false);
                $("#ghabhan_form button").attr('disabled',true);
            }
        }); */

        // For back to mumbai
        $("#ghabhan_salve_form #status").click(function() {
            if ($("#ghabhan_salve_form #status").val() === 'mumbai') {
                $("#ghabhan_salve_form #show_on_mumbai").css('display', 'block');
                $("#ghabhan_salve_form #back_to_mumbai_date,#ghabhan_salve_form #location_id,#ghabhan_salve_form #khilla_no")
                    .attr('required', true)
            } else {
                $("#ghabhan_salve_form #show_on_mumbai").css('display', 'none');
                $("#ghabhan_salve_form #back_to_mumbai_date,#ghabhan_salve_form #location_id,#ghabhan_salve_form #khilla_no")
                    .attr('required', false)
            }
        });

        /*$("#processing_form").on('submit', function(e) { 
            e.preventDefault();            

            var getdate = $("#date").val();
            $.ajax({
                url:base_url+"/processing/api",
                method:"GET",
                success:function(res)
                {
                    let current_date = new Date(getdate);
                    let medical_date = new Date(current_date.setDate(current_date.getDate() + res.data[0].medical_days1));                    
                    $("#processing_form #medical_date").val(medical_date.toISOString().split('T')[0]);
                    let process_id = $("#process_id").val();
                    if(process_id) {
                        $.ajax({
                            url:"<?php echo route('processing.store'); ?>"+'/'+process_id,
                            method:"POST",
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data:{
                                '_method': 'PUT',
                                product_id:$("#processing_form #get_stock_name_on_change").val(),
                                product_stock_id:$("#processing_form #get_stock_options").val(),
                                date:$("#processing_form #date").val(),
                                medical_date:medical_date.toISOString().split('T')[0]
                            },
                            dataType:"json",
                            success:function(res)
                            {                    
                                $("#process_alert strong").text(res.msg);
                                $("#process_alert").addClass('d-block');
                                $("#process_alert").removeClass('d-none');                                
                                setTimeout(() => {
                                    window.location.href = "<?php echo route('processing.index'); ?>";
                                }, 1000);
                            },
                            error:function(error){
                                console.log(error);
                            }
                        })  
                    }
                    else {
                        $.ajax({
                            url:"<?php echo route('processing.store'); ?>",
                            method:"POST",
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data:{
                                product_id:$("#processing_form #get_stock_name_on_change").val(),
                                product_stock_id:$("#processing_form #get_stock_options").val(),
                                date:$("#processing_form #date").val(),
                                medical_date:medical_date.toISOString().split('T')[0]
                            },
                            dataType:"json",
                            success:function(res)
                            {                    
                                $("#process_alert strong").text(res.msg);
                                $("#process_alert").addClass('d-block');
                                $("#process_alert").removeClass('d-none');
                                setTimeout(() => {
                                    window.location.href = "<?php echo route('processing.index'); ?>";
                                }, 1000);
                            },
                            error:function(error){
                                console.log(error);
                            }
                        })  
                    }
                
                },
                error:function(error){
                    console.log(error);
                }
            }) 
        });*/

        /* $("#billing_detail_form .selectpicker").on('change', function() {
            console.log($(this).val());            
            if($(this).val().indexOf('select_all') !== -1) {
                $("#billing_detail_form .dropdown .dropdown-menu .inner ul li").addClass('selected');
                $("#billing_detail_form .dropdown .dropdown-menu .inner ul li a").addClass('selected')  
            }   
            else {
                $("#billing_detail_form .dropdown .dropdown-menu .inner ul li").removeClass('selected');
                $("#billing_detail_form .dropdown .dropdown-menu .inner ul li a").removeClass('selected')  
            }        
        }) */

        $('body').delegate('#open_cash_modal', 'click', function() {
            
            $("#preloader").show();

            $.ajax({
                url: base_url+"/billing/customer_api/0/",
                method: "GET",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(res) {
                    console.log(res);
                    var html_table = '';
                    html_table += `
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-2">
                                <h6 class="float-left">Customer Name</h6>
                            </div>
                            <div class="col-md-10 tca_tag">
                                <span class="cash_entry_class">Total Milk</span>
                                <span class="cash_entry_class">Total Amount</span>
                                <span class="cash_entry_class">Amount Paid</span>
                                <span class="cash_entry_class">Balance</span>
                                <span class="cash_entry_class">Cash</span>
                                <span class="cash_entry_class">Date</span>
                            </div>
                        </div>
                        <br><br>
                        <div class="row">`;
                                var countitem = 1;
                                for (var i in res.data) {
                                    countitem++;
                                    var set_total_amt = res.data[i].total_amount;
                                    // var set_amount_paid_adjusted = Number(res.data[i].amount_paid) + Number(res.data[i].adjusted);
                                    var set_amount_paid = Number(res.data[i].amount_paid);
                                    html_table += `
                                        <div class="col-md-2">
                                            <h6>${res.data[i].customer_name}</h6>
                                        </div>
                                        <div class="col-md-10">
                                            <input type="hidden" name="hidden_customer_id[]" value="${res.data[i].customer_id}">
                                            <input type="hidden" name="hidden_bill_no[]" value="${res.data[i].bill_no}">
                                            <input type="hidden" name="hidden_week_id[]" value="${res.data[i].id}">
                                            <input type="hidden" name="from_date[]" value="${res.data[i].from_date}">
                                            <input type="hidden" name="to_date[]" value="${res.data[i].to_date}">
                                            <input type="hidden" id="valid_amt_pending" class="valid_amt_pending" data-sub_item="${countitem}" value="${res.data[i].pending_amount}">
                                            <input type="date" name="cash_date[]" class="cash_entry_class form-control datepicker" ${set_total_amt==set_amount_paid ? 'readonly' : ''} required>
                                            <input type="number" value="0" name="amount_paid[]" step="0.1" min="0" class="cash_entry_class validate_cash form-control" Bal="${res.data[i].pending_amount}" data-sub_item="${res.data[i].customer_name}" id="validate_cash" ${set_total_amt==set_amount_paid ? 'readonly' : ''} >
                                            <input type="text" value="${res.data[i].pending_amount}" class="cash_entry_class form-control" disabled>
                                            <input type="text" value="${set_amount_paid}" class="cash_entry_class form-control" disabled>
                                            <input type="number" value="${set_total_amt}" name="total_amount[]" class="cash_entry_class form-control" readonly>
                                            <input type="number" value="${res.data[i].total_litres}" name="total_litres[]" class="cash_entry_class form-control" readonly>
                                        </div>
                                    `;
                                }       
                                // <input type="number" value="0"  name="adjusted[]" step="0.1" min="0" class="cash_entry_class form-control" id="validate_adj" ${set_total_amt==set_amount_paid_adjusted ? 'readonly' : ''} ></input>
                                // <input type="hidden" id="valid_total_amt" class="valid_total_amt" data-sub_item="${countitem}" value="${set_total_amt}"></input>
                            html_table += `                            
                        </div>
                    </div>`;
                    $("#cash_modal").modal('show');
                    $("#preloader").hide();
                    $("#cash_modal #billing_paginate_data").html(html_table);
                }
            });
        });
        
        $('body').delegate('#submit_cash_entry', 'click', function(e) {
            e.preventDefault()            
            $("#preloader").show();
            var errorlgt = '';
            $('.validate_cash').each(function() {
                var Balance = $(this).attr('Bal');
                var cust = $(this).data('sub_item');
                $("#preloader").hide();
                if($(this).val() > Balance){
                    errorlgt += 'Error';
                    Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: 'Cash Entry should be less than or equal to '+Balance+' For Customer '+cust,
                        showConfirmButton: true,
                  })
                }
                else {
                    errorlgt += '';
                }
            })
            if(errorlgt == '') {
                var dataSerialize = new FormData($('#cash_entry_form')[0]);
                 $.ajax({
                    url: base_url+"/billing/store",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    method: "POST",
                    data : dataSerialize,
                    contentType: false,
                    processData: false,
                    success: function(res) {
                        $("#show_cn_entry").hide();
                        // $("#cn_cash_entry").val('');
                        $("#preloader").hide();
                        Swal.fire({
                          position: 'center',
                          icon: 'success',
                          title: res.msg,
                          showConfirmButton: true,
                          timer: 1500,                          
                        })
                        window.location.href = window.location.pathname
                    }
                })
            }
            /*var a = $("#cash_entry_form #validate_cash").val();
            var b = $("#cash_entry_form #valid_amt_pending").val();
            var c = $("#cash_entry_form #validate_adj").val();
            var d = $("#cash_entry_form #valid_total_amt").val() - $("#cash_entry_form #valid_amt_paid").val() - a;
            
             if(!$("#cn_cash_entry").val()) {
                $("#preloader").hide();
                alert('Select Customer');
            }
            else 
            if(a > b ) {
                $("#preloader").hide();
                Swal.fire({
                      position: 'center',
                      icon: 'error',
                      title: 'Cash Entry should be less than or equal to '+b,
                      showConfirmButton: true,
                })
            }
            else if (c > d) {
                $("#preloader").hide();
                Swal.fire({
                      position: 'center',
                      icon: 'error',
                      title: 'Adjusted Entry should be less than or equal to '+d,
                      showConfirmButton: true,
                })
            } */
        })

        /* $('body').delegate('#cn_cash_entry', 'change', function() {
            
            $("#preloader").show();
            var cust_id = $(this).val();
            console.log(cust_id);
            
            $.ajax({
                url: base_url+"/billing/customer_api/1/"+cust_id,
                method: "GET",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    param1: cust_id,
                },
                contentType: false,
                processData: false,
                success: function(res) {
                    $("#preloader").hide();
                    console.log(res);
                    var html = '';
                    if(res.status == '1') {
                        var set_total_amt = res.data.total_amount;
                        var set_amount_paid_adjusted = Number(res.data.amount_paid) + Number(res.data.adjusted);
                        
                        html += `
                             <input type="hidden" name="hidden_customer_id[]" value="${res.data.customer_id}">
                            <input type="hidden" name="hidden_bill_no[]" value="${res.data.bill_no}">
                            <input type="hidden" name="hidden_week_id[]" value="${res.data.id}">
                            <input type="hidden" name="from_date[]" value="${res.data.from_date}">
                            <input type="hidden" name="to_date[]" value="${res.data.to_date}">
                            <input type="hidden" id="valid_total_amt" value="${set_total_amt}">
                            <input type="hidden" id="valid_amt_paid" value="${set_amount_paid_adjusted}">
                            <input type="text" name="cash_date[]" class="cash_entry_class form-control datepicker" ${set_total_amt==set_amount_paid_adjusted ? 'readonly' : ''}>
                            <input type="number" value="0"  name="adjusted[]" step="0.1" min="0" class="cash_entry_class form-control" id="validate_adj" ${set_total_amt==set_amount_paid_adjusted ? 'readonly' : ''} >
                            <input type="number" value="0"  name="amount_paid[]" step="0.1" min="0" class="cash_entry_class form-control" id="validate_cash" ${set_total_amt==set_amount_paid_adjusted ? 'readonly' : ''} >
                            <input type="text" value="${res.data.amount_paid}" class="cash_entry_class form-control" disabled>
                            <input type="number" value="${res.data.total_amount}" name="total_amount[]" class="cash_entry_class form-control" readonly><br>                        
                        `;
                    }
                    else {
                        html +='No Data Found';
                    }
                    $("#show_cn_entry").show();
                    $("#show_cn_entry").html(html);
                }
            });
        }); */
        
        // old cash entry method
        /*$('body').delegate('#open_cash_modal2', 'click', function() {

            $("#preloader").show();
            var xdate = $(this).attr('fdate');
            var ydate = $(this).attr('tdate');
            console.log(xdate, ydate);

            $.ajax({
                url: base_url+"/billing/customer_api" + '/' + 5 + '/' + xdate + '/' +
                    ydate,
                method: "GET",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    date1: xdate,
                    date2: ydate,
                },
                contentType: false,
                processData: false,
                success: function(res) {

                    var html_table = '';
                    // var idcount = 1;
                    html_table += `
                <div class="col-md-12">
                <div class="row">
                <div class="col-md-2">
                <h6 class="float-left">Regular Customer</h6>
                </div>
                <div class="col-md-10 tca_tag">
                <span>Total</span>
                <span>Paid</span>
                <span>Cash</span>
                <span>Adjusted</span>
                <span>Date</span>
                </div>
                </div>
                <br>
                <div id="for_regular_customer">`;
                    for (var i = 0; i < res.data.length; i++) {
                        if (res.data[i].customer_type == 'Regular Customer') {
                            var set_total_amt = res.data[i].total_amount;
                            var set_amount_paid_adjusted = Number(res.data[i].amount_paid) +
                                Number(res.data[i].adjusted);
                            html_table += `
                        <div class="row">
                        <div class="col-md-2">
                        <p>${res.data[i].customer_name}</p>
                        </div>
                        <div class="col-md-10">
                        <input type="hidden" name="hidden_customer_id[]" value="${res.data[i].customer_id}">
                        <input type="hidden" name="hidden_bill_no[]" value="${res.data[i].bill_no}">
                        <input type="hidden" name="hidden_week_id[]" value="${res.data[i].id}">
                        <input type="hidden" name="from_date[]" value="${res.data[i].from_date}">
                        <input type="hidden" name="to_date[]" value="${res.data[i].to_date}">
                        <input type="text" name="cash_date[]" class="cash_entry_class form-control datepicker" ${set_total_amt==set_amount_paid_adjusted ? 'readonly' : ''}>
                        <input type="number" value="0"  name="adjusted[]" step="0.1" min="0" class="cash_entry_class form-control" max="${set_total_amt - res.data[i].amount_paid}" ${set_total_amt==set_amount_paid_adjusted ? 'readonly' : ''} >
                        <input type="number" value="0"  name="amount_paid[]" step="0.1" min="0" class="cash_entry_class form-control" max="${set_total_amt - res.data[i].amount_paid}" ${set_total_amt==set_amount_paid_adjusted ? 'readonly' : ''} >
                        <input type="text" value="${res.data[i].amount_paid}" class="cash_entry_class form-control" disabled>
                        <input type="number" value="${res.data[i].total_amount}" name="total_amount[]" class="cash_entry_class form-control" readonly><br>
                        </div>
                        </div>`
                        }
                        // idcount++;
                    }
                    html_table += `</div>
                </div>
                <br>
                <div class="col-md-12">
                <div class="row">
                <div class="col-md-2">
                <h6 class="float-left">Home Customer</h6>
                </div>
                <div class="col-md-10 tca_tag">
                <span>Total</span>
                <span>Cash</span>
                <span>Adjusted</span>
                <span>Date</span>
                </div>
                </div>
                <br>
                <div id="for_regular_customer">`;
                    for (var i = 0; i < res.data.length; i++) {
                        if (res.data[i].customer_type == 'Home Customer') {
                            var set_total_amt1 = res.data[i].total_amount;
                            var set_amount_paid_adjusted1 = Number(res.data[i]
                                .amount_paid) + Number(res.data[i].adjusted);
                            html_table += `
                        <div class="row">
                        <div class="col-md-3">
                        <p>${res.data[i].customer_name}</p>
                        </div>
                        <div class="col-md-9">
                        <input type="hidden" name="hidden_customer_id[]" value="${res.data[i].customer_id}">
                        <input type="hidden" name="hidden_bill_no[]" value="${res.data[i].bill_no}">
                        <input type="hidden" name="hidden_week_id[]" value="${res.data[i].id}">
                        <input type="hidden" name="from_date[]" value="${res.data[i].from_date}">
                        <input type="hidden" name="to_date[]" value="${res.data[i].to_date}">
                        <input type="text" name="cash_date[]" class="cash_entry_class form-control datepicker" ${set_total_amt==set_amount_paid_adjusted ? 'readonly' : ''}>
                        <input type="number" value="0" id="adjusted_${idcount}" name="adjusted[]" step="0.1" min="0" class="cash_entry_class form-control" ${set_total_amt1==set_amount_paid_adjusted1 ? 'readonly' : ''}>
                        <input type="number" value="0" id="amount_paid_${idcount}" name="amount_paid[]" step="0.1" min="0" class="cash_entry_class form-control" max="${set_total_amt1}" ${set_total_amt1==set_amount_paid_adjusted1 ? 'readonly' : ''}>
                        <input type="text" value="${res.data[i].total_amount}" name="total_amount[]" class="cash_entry_class form-control" readonly><br>
                        </div>
                        </div>`
                        }
                        // idcount++;
                    }
                    html_table += `</div>
                        </div>`;
                    $("#cash_modal").modal('show');
                    $("#preloader").hide();
                    $("#cash_modal #billing_paginate_data").html(html_table);
                }
            });
        });*/

        /* $('body').delegate('#open_print_modal1', 'click', function() {

            $("#preloader").show();

            var xdate = $(this).attr('fdate');
            var ydate = $(this).attr('tdate');
            var wm_data = $(this).attr('wm-data');
            var main_count = $(this).attr('main_count');
            var get_search_data = [];
            var get_rate = '';
            var get_weekly_pending_amount = [];
            var get_total_customer_data = [];
            var get_weekly_amount_paid = [];

            $.ajax({
                url: base_url+"/billing/customer_api" + '/' + 0 + '/' + xdate + '/' +
                    ydate,
                method: "GET",
                data: {
                    id: 0,
                    date1: xdate,
                    date2: ydate,
                },
                contentType: false,
                processData: false,
                success: function(res) {

                    $.ajax({
                        url: base_url+"/billing/customer_api" + '/' + 1 +
                            '/' + xdate + '/' + ydate,
                        method: "GET",
                        data: {
                            id: 1,
                            date1: xdate,
                            date2: ydate,
                        },
                        contentType: false,
                        processData: false,
                        success: function(res1) {

                            $.ajax({
                                url: base_url+"/billing/customer_api" +
                                    '/' + 2 + '/' + xdate + '/' + ydate,
                                method: "GET",
                                data: {
                                    id: 1,
                                    date1: xdate,
                                    date2: ydate,
                                },
                                contentType: false,
                                processData: false,
                                success: function(res2) {

                                    // For Res2
                                    for (var i in res2.data) {
                                        res2.data[i].amount_paid =
                                            Number(res2.data[i]
                                                .amount_paid);
                                        res2.data[i].adjusted =
                                            Number(res2.data[i]
                                                .adjusted);
                                        res2.data[i]
                                            .pending_amount =
                                            Number(res2.data[i]
                                                .pending_amount);
                                        get_weekly_amount_paid[i] =
                                            res2.data[i];
                                    }
                                    console.log(res2);                                   
                                    const weeklyfilterdData1 =
                                        get_weekly_amount_paid
                                        .reduce((a2, c2) => {
                                            let filteredP = a2
                                                .filter(el => el
                                                    .customer_id ===
                                                    c2
                                                    .customer_id
                                                );
                                            if (filteredP
                                                .length > 0) {
                                                a2[a2.indexOf(
                                                        filteredP[
                                                            0
                                                        ]
                                                    )]
                                                    .amount_paid +=
                                                    +c2
                                                    .amount_paid;
                                                a2[a2.indexOf(
                                                        filteredP[
                                                            0
                                                        ]
                                                    )]
                                                    .adjusted +=
                                                    +c2
                                                    .adjusted;
                                                a2[a2.indexOf(
                                                        filteredP[
                                                            0
                                                        ]
                                                    )]
                                                    .pending_amount +=
                                                    +c2
                                                    .pending_amount;
                                            } else {
                                                a2.push(c2);
                                            }
                                            return a2;
                                        }, []);

                                    // For Res1
                                    for (var i in res1.data) {
                                        res1.data[i]
                                            .pending_amount =
                                            Number(res1.data[i]
                                                .pending_amount);
                                        get_weekly_pending_amount[
                                            i] = res1.data[i];
                                    }
                                    // For Pending Amount
                                    const get_total_pending_amount =
                                        get_weekly_pending_amount
                                        .map(results => Number(
                                            results
                                            .pending_amount))
                                        .reduce((total, litres) =>
                                            total + litres, 0);

                                    const weeklyfilterdData =
                                        get_weekly_pending_amount
                                        .reduce((a1, c1) => {
                                            let filteredP = a1
                                                .filter(el => el
                                                    .customer_id ===
                                                    c1
                                                    .customer_id
                                                );
                                            if (filteredP
                                                .length > 0) {
                                                a1[a1.indexOf(
                                                        filteredP[
                                                            0
                                                        ]
                                                    )]
                                                    .pending_amount +=
                                                    +c1
                                                    .pending_amount;
                                            } else {
                                                a1.push(c1);
                                            }
                                            return a1;
                                        }, []);

                                    // For Res0

                                    for (var i in res.data) {
                                        res.data[i].total_amount =
                                            Number(res.data[i]
                                                .total_amount);
                                        res.data[i].total_litres =
                                            Number(res.data[i]
                                                .total_litres);
                                        get_total_customer_data[i] =
                                            res.data[i];
                                    }
                                    const
                                        get_total_customer_litres =
                                        get_total_customer_data
                                        .map(results => Number(
                                            results.total_litres
                                        ))
                                        .reduce((total, litres) =>
                                            total + litres, 0);

                                    const
                                        get_total_customer_amount =
                                        get_total_customer_data
                                        .map(results => Number(
                                            results.total_amount
                                        ))
                                        .reduce((total, amount) =>
                                            total + amount, 0);

                                    const filterdData =
                                        get_total_customer_data
                                        .reduce((a, c) => {
                                            let filtered = a
                                                .filter(el => el
                                                    .customer_id ===
                                                    c
                                                    .customer_id
                                                );
                                            if (filtered
                                                .length > 0) {
                                                a[a.indexOf(filtered[
                                                        0
                                                    ])]
                                                    .total_amount +=
                                                    +c
                                                    .total_amount;
                                                a[a.indexOf(filtered[
                                                        0
                                                    ])]
                                                    .total_litres +=
                                                    +c
                                                    .total_litres;
                                            } else {
                                                a.push(c);
                                            }
                                            return a;
                                        }, []);

                                    console.log(weeklyfilterdData);

                                    for (var x in filterdData) {
                                        if (weeklyfilterdData
                                            .length > 0) {
                                            for (var y in
                                                    weeklyfilterdData) {
                                                if (filterdData[x]
                                                    .customer_id ==
                                                    weeklyfilterdData[
                                                        y]
                                                    .customer_id) {
                                                    filterdData[x]
                                                        .newprevious_balance =
                                                        weeklyfilterdData[
                                                            y]
                                                        .pending_amount;
                                                    // filterdData[x].newtotal_amount = filterdData[x].total_amount+weeklyfilterdData[y].pending_amount;                                                   
                                                }
                                            }
                                        } else {
                                            // filterdData[x].newtotal_amount = filterdData[x].total_amount;
                                            filterdData[x]
                                                .newprevious_balance =
                                                0;
                                        }

                                    }

                                    for (var x in filterdData) {
                                        if (weeklyfilterdData1
                                            .length > 0) {
                                            for (var y in
                                                    weeklyfilterdData1) {
                                                if (filterdData[x]
                                                    .customer_id ==
                                                    weeklyfilterdData1[
                                                        y]
                                                    .customer_id) {
                                                    filterdData[x]
                                                        .remaining_bal =
                                                        weeklyfilterdData1[
                                                            y]
                                                        .pending_amount;
                                                    filterdData[x]
                                                        .newamount_paid =
                                                        weeklyfilterdData1[
                                                            y]
                                                        .amount_paid;
                                                    filterdData[x]
                                                        .newadjusted =
                                                        weeklyfilterdData1[
                                                            y]
                                                        .adjusted;
                                                    // filterdData[x].getadju_amtpaid = weeklyfilterdData1[y].amount_paid+weeklyfilterdData1[y].adjusted;                                                
                                                }
                                            }
                                        } else {
                                            filterdData[x]
                                                .newamount_paid = 0;
                                            filterdData[x]
                                                .newadjusted = 0;
                                            // filterdData[x].getadju_amtpaid = 0;
                                        }
                                    }

                                    var html_table = '';
                                    var count = 1;
                                    var getFooterResult = [];
                                    html_table += `
                                <div class="container bootstrap snippets bootdeys">
                                <div class="row">
                                <div class="col-md-12">
                                <div class="panel panel-default invoice" id="invoice">
                                <div class="panel-body">
                                <div class="row">
                                <div class="col-12">
                                <p><span class="mr-2">Sr.No: ${main_count}</span> Date : ${moment(xdate).format('DD-MMM-YYYY')} - ${moment(ydate).format('DD-MMM-YYYY')}</p>
                                </div>
                                </div>
                                <div class="row">
                                <div class="col-sm-12">
                                <table class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                <th scope="col">Sr.No</th>
                                <th scope="col">Customer Name<br> (àª—à«àª°àª¾àª¹àª• àª¨à«àª‚ àª¨àª¾àª®)</th>
                                <th scope="col">Total Litres<br> (àª•à«àª² àª²àª¿àªŸàª°)</th>
                                <th scope="col">Amount<br> (àª•à«àª² àª°àª•àª®)</th>
                                <th scope="col">Previous Balance<br> (àª¬àª¾àª•à«€ àª°àª•àª®)</th>
                                <th scope="col">Total Amount</th>
                                <th scope="col">Amount Paid</th>
                                <th scope="col">Remaining Balance</th>
                                <th scope="col">Adjusted</th>
                                </tr>
                                </thead>
                                <tbody>`;
                                    for (var i = 0; i < filterdData
                                        .length; i++) {
                                        if (filterdData[i]
                                            .bill_period ==
                                            'weekly' && wm_data ==
                                            'weekly') {
                                            getFooterResult[i] =
                                                filterdData[i];
                                            html_table += `<tr>
                                    <th scope="row">${count}</th>
                                    <td>${filterdData[i].customer_name}</td>                                                                            
                                    <td>${filterdData[i].total_litres}</td>
                                    <td>${filterdData[i].total_amount}</td>
                                    <td>${filterdData[i].newprevious_balance ? filterdData[i].newprevious_balance : 0}</td>                                                                            
                                    <td>${(filterdData[i].total_amount + (filterdData[i].newprevious_balance ? filterdData[i].newprevious_balance : 0)) ? (filterdData[i].total_amount + (filterdData[i].newprevious_balance ? filterdData[i].newprevious_balance : 0)) : 0}</td>
                                    <td>${filterdData[i].newamount_paid ? filterdData[i].newamount_paid : 0}</td>                                                                            
                                    <td>${filterdData[i].remaining_bal ? filterdData[i].remaining_bal : (filterdData[i].total_amount+(filterdData[i].newprevious_balance ? filterdData[i].newprevious_balance : 0))-((filterdData[i].newamount_paid ? filterdData[i].newamount_paid : 0)+(filterdData[i].newadjusted ? filterdData[i].newadjusted : 0))}</td>
                                    <td>${filterdData[i].newadjusted ? filterdData[i].newadjusted : 0}</td>
                                    </tr>`;
                                            count++;
                                        }
                                        if (filterdData[i]
                                            .bill_period ==
                                            'monthly' && wm_data ==
                                            'monthly') {
                                            getFooterResult[i] =
                                                filterdData[i];
                                            html_table += `<tr>
                                    <th scope="row">${count}</th>                                                                                
                                    <td>${filterdData[i].customer_name}</td>
                                    <td>${filterdData[i].total_litres}</td>
                                    <td>${filterdData[i].total_amount}</td>
                                    <td>${filterdData[i].newprevious_balance ? filterdData[i].newprevious_balance : 0}</td>                                                                            
                                    <td>${(filterdData[i].total_amount + (filterdData[i].newprevious_balance ? filterdData[i].newprevious_balance : 0)) ? (filterdData[i].total_amount + (filterdData[i].newprevious_balance ? filterdData[i].newprevious_balance : 0)) : 0}</td>
                                    <td>${filterdData[i].newamount_paid ? filterdData[i].newamount_paid : 0}</td>                                                                            
                                    <td>${filterdData[i].remaining_bal ? filterdData[i].remaining_bal : (filterdData[i].total_amount+(filterdData[i].newprevious_balance ? filterdData[i].newprevious_balance : 0))-((filterdData[i].newamount_paid ? filterdData[i].newamount_paid : 0)+(filterdData[i].newadjusted ? filterdData[i].newadjusted : 0))}</td>
                                    <td>${filterdData[i].newadjusted ? filterdData[i].newadjusted : 0}</td>
                                    </tr>`;
                                            count++;
                                        }
                                    }

                                    var getFooterTotalLitres =
                                        getFooterResult
                                        .map(results => Number(
                                            results.total_litres
                                        ))
                                        .reduce((total, litres) =>
                                            total + litres, 0);

                                    var getFooterAmount =
                                        getFooterResult
                                        .map(results => Number(
                                            results.total_amount
                                        ))
                                        .reduce((total, amount) =>
                                            total + amount, 0);

                                    var getFooterPreviousBalance =
                                        getFooterResult
                                        .map(results => Number(
                                            results
                                            .newprevious_balance ?
                                            results
                                            .newprevious_balance :
                                            0))
                                        .reduce((total, prevBal) =>
                                            total + prevBal, 0);

                                    var getFooterTotalAmount =
                                        getFooterResult
                                        .map(results => Number((
                                            results
                                            .total_amount +
                                            (results
                                                .newprevious_balance ?
                                                results
                                                .newprevious_balance :
                                                0)) ? (
                                            results
                                            .total_amount +
                                            (results
                                                .newprevious_balance ?
                                                results
                                                .newprevious_balance :
                                                0)) : 0))
                                        .reduce((total, prevBal) =>
                                            total + prevBal, 0);

                                    var getFooterAmountPaid =
                                        getFooterResult
                                        .map(results => Number(
                                            results
                                            .newamount_paid ?
                                            results
                                            .newamount_paid : 0
                                        ))
                                        .reduce((total, prevBal) =>
                                            total + prevBal, 0);

                                    var getFooterRemainBal =
                                        getFooterResult
                                        .map(results => Number(
                                            results
                                            .remaining_bal ?
                                            results
                                            .remaining_bal : (
                                                results
                                                .total_amount +
                                                (results
                                                    .newprevious_balance ?
                                                    results
                                                    .newprevious_balance :
                                                    0)) - ((
                                                results
                                                .newamount_paid ?
                                                results
                                                .newamount_paid :
                                                0) + (
                                                results
                                                .newadjusted ?
                                                results
                                                .newadjusted :
                                                0))))
                                        .reduce((total, prevBal) =>
                                            total + prevBal, 0);

                                    var getFooterAdjusted =
                                        getFooterResult
                                        .map(results => Number(
                                            results
                                            .newadjusted ?
                                            results
                                            .newadjusted : 0))
                                        .reduce((total, prevBal) =>
                                            total + prevBal, 0);

                                    html_table += `<tr>
                            <td></td>
                            <th>Total:-</th>
                            <th>${getFooterTotalLitres}</th>
                            <th>${getFooterAmount}</th>
                            <th>${getFooterPreviousBalance}</th>
                            <th>${getFooterTotalAmount}</th>
                            <th>${getFooterAmountPaid}</th>
                            <th>${getFooterRemainBal}</th>
                            <th>${getFooterAdjusted}</th>

                            </tr>`;

                                    `</tbody>
                            </table> 
                            <div class="col-sm-12">
                            </div>                                                                                                                                                                          
                            </div>
                            </div>
                            </div>                                                                                                                                                                          
                            </div>
                            </div>`;

                                    $("#print_modal1").modal(
                                        'show');
                                    $("#preloader").hide();
                                    $("#print_modal1 #get_billing_table1")
                                        .html(html_table);
                                }
                            });

                        }
                    });

                }
            });

        }); */
        
        $('body').delegate('#open_print_modal', 'click', function() {

            $("#preloader").show();
            var bill_type = $(this).attr('bill_type');
            var bill_id = $(this).attr('bill_id'); 
            var xdate = $(this).attr('fdate');
            var ydate = $(this).attr('tdate');
            var customer_id = $(this).attr('cid');
            var bill_customer_name = $(this).attr('cname');
            var bill_customer_mobile = $(this).attr('cmobile');
            var bill_no = $(this).attr('bno');
            var get_search_data = [];
            var get_rate = '';

            $.ajax({
                url: `${base_url}/billing/api/1/${customer_id}/${xdate}/${ydate}`,
                method: "GET",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                /* data: {
                    id: 1,
                    cid: customer_id,
                    date1: xdate,
                    date2: ydate,
                }, */
                contentType: false,
                processData: false,
                success: function(res) {
                    
                    if (res.data.length > 0) {
                        for (var i in res.data) {
                            get_search_data[i] = res.data[i];
                            get_rate = Number(res.data[0].milk_rate).toFixed(2);
                            // bill_type = res.data[0].bill_period;
                        }
                        const get_total_litres = get_search_data
                            .map(results => Number(results.total_litres))
                            .reduce((total, litres) => total + litres, 0);

                        const get_total_amount = get_search_data
                            .map(results => Number(results.total_amount))
                            .reduce((total, amount) => total + amount, 0);

                        const get_morning_litres = get_search_data
                            //    .filter((item) => item.timing=="Morning")
                            .map(results => Number(results.morning))
                            .reduce((total, amount) => total + amount, 0);

                        const get_evening_litres = get_search_data
                            //    .filter((item) => item.timing=="Evening")
                            .map(results => Number(results.evening))
                            .reduce((total, amount) => total + amount, 0);
                        const ysum = get_morning_litres + get_evening_litres;


                        if (res.status == 1) {
                            
                            var html_table = '';
                            var search_pending_amount = [];
                            $.ajax({
                                url: `${base_url}/billing/api/3/${customer_id}/${xdate}/${ydate}/${bill_id}`,
                                // url: `${base_url}/billing/api/"+ 3+'/'+customer_id+'/'+xdate+'/'+ydate`,
                                method: "GET",
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                /* data: {
                                    id: 3,
                                    cid: customer_id,
                                    date1: xdate,
                                    date2: ydate
                                }, */
                                contentType: false,
                                processData: false,
                                success: function(res3) {
                                    console.log(res3);
                                    $.ajax({
                                        url: `${base_url}/billing/api/4/${customer_id}/${xdate}/${ydate}`,
                                        method: "GET",
                                        headers: {
                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                        },
                                        /* data: {
                                            id: 3,
                                            cid: customer_id,
                                            date1: xdate,
                                            date2: ydate
                                        }, */
                                        contentType: false,
                                        processData: false,
                                        success: function(res4) {

                                        /*  for (var i in res3.data) {
                                                search_pending_amount[i] = res3.data[i];
                                            }
                                            const get_pending_amount = search_pending_amount.map(results => Number(results.pending_amount))
                                                                                    .reduce((total, litres) => total + litres,0); */

                                            // const get_grand_total_amount = get_total_amount + get_pending_amount;
                                            const get_pending_amount = res3.data.pending_amount ? Number(res3.data.pending_amount) : 0;
                                            const get_grand_total_amount = get_total_amount + get_pending_amount;
                                            /* if (res.data.length >= 10 && res.data.length <= 31 ) {
                                                html_table += `
                                                <div class="container bootstrap snippets bootdeys">
                                                <div class="row">
                                                <div class="col-md-12">
                                                <div class="panel panel-default invoice" id="invoice">
                                                <div class="panel-body">
                                                    <div class="row">
                                                        <div class="col-sm-12 text-center">
                                                            <h4>OVESH UMAR BHAI</h4>
                                                            <p>Aarey Milk Colony, Unit No:19, Goregaon (E), Mumbai-400065 (Mobile no: +91-9867835569/36)</p>
                                                        </div>
                                                    </div>
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <table class="table table-striped table-bordered">
                                                            <tbody>
                                                                <tr>
                                                                   <td>Buyer's Name</td> 
                                                                   <td>Invoice No</td> 
                                                                </tr>
                                                            </tbody>
                                                        </tale>                                                                                                            
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                <div class="col-sm-6">
                                                    <p class="lead marginbottom">${bill_customer_name.toUpperCase()}</p>
                                                </div>
                                                <div class="col-sm-6 text-right payment-details">
                                                    <p><b>Last Payment:-</b><b>Rs.${res3.data.last_payment ? res3.data.last_payment : '0'}/-</b></p>
                                                    <p>Date : ${moment().format('DD-MMM-YYYY')}</p>
                                                    <p>Bill Period :<br> ${moment(xdate).format("DD-MMM-YYYY")} to ${moment(ydate).format("DD-MMM-YYYY")}</p>
                                                </div>
                                                </div>
                                                <div class="row table-row">
                                                <div class="col-sm-12">
                                                    <table class="table table-striped table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th>Dates</th>
                                                                <th>Morning</th>
                                                                <th>Evening</th>
                                                                <th>Dates</th>
                                                                <th>Morning</th>
                                                                <th>Evening</th>
                                                            </tr>
                                                        </thead>
                                                <tbody>`;
                                                let first15res = [];
                                                if (res.data.length == '30' || res.data.length == '29') {
                                                    for (var i = 0; i < res.data.length; i += 15) {
                                                        var sliced = res.data.slice(i,i + 15);
                                                        first15res.push(sliced);
                                                    }
                                                } else if (res.data.length == '31') {
                                                    for (var i =0; i < res.data.length; i += 16) {
                                                        var sliced = res.data.slice(i,i +16);
                                                        first15res.push(sliced);
                                                    }
                                                } else if (res.data.length == '28') {
                                                    for (var i = 0; i <
                                                        res.data.length; i +=14) {
                                                        var sliced = res.data.slice(i,i + 14);
                                                        first15res.push(sliced);
                                                    }
                                                } else {
                                                    var check = res.data.length
                                                    if (check % 2 == 0) {
                                                        var clength = check / 2;
                                                    } else {
                                                        var clength = (check / 2) + 0.5;
                                                    }
                                                    for (var i = 0; i < res.data.length; i += clength) {
                                                        var sliced = res.data.slice( i, i + clength);
                                                        first15res.push(sliced);
                                                    }
                                                }
                                                console.log(first15res);
                                                first15res[1].push(Object.create({
                                                        sold_date: '',
                                                        morning: '',
                                                        evening: ''
                                                    })
                                                );

                                                for (var i = 0; i < first15res[0].length; i++) {
                                                    html_table += `<tr>
                                                            <td><b>${moment(first15res[0][i].sold_date).format("DD-MMM-YYYY")}</b></td>
                                                            <td><b>${first15res[0][i].morning}</b></td>
                                                            <td><b>${first15res[0][i].evening}</b></td>
                                                            <td><b>${first15res[1][i].sold_date ? (moment(first15res[1][i].sold_date).format("DD-MMM-YYYY")) : ''}</b></td>
                                                            <td><b>${first15res[1][i].morning}</b></td>
                                                            <td><b>${first15res[1][i].evening}</b></td>
                                                    </tr>`;
                                                }
                                                html_table += `
                                                                <tr>
                                                                    <td class="text-right"></td>
                                                                    <td class="text-right">Morning: ${get_morning_litres}</td>
                                                                    <td class="text-right">Evening: ${get_evening_litres}</td>
                                                                    <td class="text-right">Total: ${ysum}</td>
                                                                    <td class="text-right"></td>
                                                                    <td class="text-right"></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        </div>
                                                    </div>
                                                        <div class="row table-row">
                                                            <div class="col-sm-6 margintop">
                                                                <p class="marginbottom">THANK YOU! <span style=" font-size: 12px;">(Rs.${res4.adjusted}/-&nbsp;&nbsp;Bhool/Bhav Pher)</span></p>
                                                                <p></p>
                                                                <p id="number_in_words">Amount (in words):
                                                                    <br> ${RsPaise(Math.round((get_grand_total_amount)*100)/100)}</p>
                                                            </div>
                                                            <div class="col-sm-2 text-center">
                                                                <p>Rate : ${get_rate}</p>
                                                            </div>
                                                            <div class="col-sm-4 text-right invoice-total">
                                                                <p>Total : ${get_total_amount}</p>
                                                                <p>Previous Bal : ${get_pending_amount} </p>
                                                                <p>Grand Total : ${get_grand_total_amount} </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    </div>
                                                    </div>
                                                    </div>
                                                    </div>`;
                                            } */
                                            // else {
                                                html_table += `
                                                <div class="container bootstrap snippets bootdeys">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="panel panel-default invoice" id="invoice">
                                                                <div class="panel-body">
                                                                    <div class="row">
                                                                        <div class="col-sm-12 text-center">
                                                                            <h3>OVESH UMARBHAI SULLYA</h3>
                                                                            <p>Aarey Milk Colony, Unit No:19, Goregaon (E), Mumbai-400065 (Mobile no: +91-9867835569/36)</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-sm-12">
                                                                            <table class="table table-striped table-bordered">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <th>Buyer's Name</th> 
                                                                                        <th>Invoice No</th>
                                                                                        <td>${bill_no}</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>${bill_customer_name.toUpperCase()}</td>
                                                                                        <th>Invoice Date</th>
                                                                                        <td>${moment().format('DD-MMM-YYYY')}</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>Mumbai</td>
                                                                                        <th>Period</th>
                                                                                        <td>${moment(xdate).format("DD-MMM-YYYY")} to ${moment(ydate).format("DD-MMM-YYYY")}</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>MOBILE - ${bill_customer_mobile}</td>
                                                                                        <td></td>
                                                                                        <td></td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>                                                                                                            
                                                                        </div>
                                                                    </div>
                                                                    <div class="row no-gutters">
                                                                        <div class="col-sm-6 text-center">
                                                                            <table class="table table-striped table-bordered">
                                                                                <tr>
                                                                                    <th colspan="4"><h5 class="mb-0">DESCRIPTION OF GOODS</h5></th>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td colspan="4">Quantity of Milk supplied in litres</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td style="width:25%">Dates</td>
                                                                                    <td style="width:25%">Morning</td>
                                                                                    <td style="width:25%">Evening</td>
                                                                                    <td style="width:25%">Total</td>                                                                    
                                                                                </tr>
                                                                                `;
                                                                                for (var i = 0; i < res.data.length; i++) {
                                                                                    html_table += `
                                                                                        <tr>
                                                                                            <td style="width:25%">${moment(res.data[i].sold_date).format("DD-MMM-YYYY")}</td>                                                                                
                                                                                            <td style="width:25%">${res.data[i].morning}</td>
                                                                                            <td style="width:25%">${res.data[i].evening}</td>
                                                                                            <th style="width:25%">${res.data[i].total_litres}</th>                                                                            
                                                                                        </tr>
                                                                                        `;
                                                                                }
                                                                                html_table += `
                                                                                <tr>
                                                                                    <th colspan="3">Grand Total</th>
                                                                                    <th>${ysum}</th>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td colspan="4"><h4 class="my-0">BANK DETAILS</h4></td>
                                                                                </tr>
                                                                                <tr class="text-justify">
                                                                                    <td colspan="4">
                                                                                        <span>Bank Name: HDFC Bank</span><br>
                                                                                        <span>Account No: 59209867835569 / 59209867835536</span><br>
                                                                                        <span>IFSC Code: HDFC0001425</span>
                                                                                    </td>
                                                                                </tr>
                                                                            </table>
                                                                        </div>
                                                                        <div class="col-sm-6 text-center">
                                                                            <table class="table table-striped table-bordered">
                                                                                <tr>
                                                                                    <th colspan="8"><h5 class="mb-0">CALCULATION</h5></th>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th style="height:76px;width:60%">TOTAL QUANTITY IN LITRES</th>
                                                                                    <td>${ysum}</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th style="height:76px;width:60%">RATE</th>
                                                                                    <td>${get_rate}</td>
                                                                                </tr>                                                                                
                                                                                <tr>
                                                                                    <th style="height:76px;width:60%">NET AMOUNT</th>
                                                                                    <td>${get_total_amount}</td>
                                                                                </tr>                                                                                
                                                                                <tr>
                                                                                    <th style="height:76px;width:60%">BALANCE</th>
                                                                                    <td>${get_pending_amount}</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th style="height:76px;width:60%">GROSS AMOUNT</th>
                                                                                    <td>${get_grand_total_amount}</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td style="height:131px" colspan="2"><h4 class="my-0">OVESH UMARBHAI SULLYA</h4></td>
                                                                                </tr>
                                                                            </table>
                                                                        </div>
                                                                    </div>                                                                    
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>`;
                                            // }
                                            $("#print_modal").modal('show');
                                            $("#preloader").hide();
                                            $("#print_modal  #get_billing_table").html(html_table);
                                        }
                                    });
                                }
                            });
                        }
                    }
                },
                error: function(error) {
                    console.log(error);
                }
            })
        });

        if(pathname == 'billing') {
            $.ajax({
                url: base_url+"/billing/customer_api/4",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method: "GET",
                contentType: false,
                processData: false,
                success: function(res) {
                                    
                    for(var i in res) {
                        res[i].total_litres = Number(res[i].total_litres);
                        res[i].amount = Number(res[i].amount);
                        res[i].previous_balance = Number(res[i].previous_balance);
                        res[i].total_amount = Number(res[i].total_amount);
                        res[i].amount_paid = Number(res[i].amount_paid);
                        res[i].pending_amount = Number(res[i].pending_amount);
                        res[i].adjusted = Number(res[i].adjusted);
                    }
                    var helper = {};
                    var result = res.reduce(function(r, o) {
                        var key = o.from_date + '-' + o.to_date;
                        
                        if(!helper[key]) {
                            helper[key] = Object.assign({}, o); 
                            r.push(helper[key]);
                        }
                        else {
                            helper[key].total_litres += o.total_litres;
                            helper[key].amount += o.amount;
                            helper[key].previous_balance += o.previous_balance;
                            helper[key].total_amount += o.total_amount;
                            helper[key].amount_paid += o.amount_paid;
                            helper[key].pending_amount += o.pending_amount;
                            helper[key].adjusted += o.adjusted;
                        }
                        return r;
                    }, []);
                    console.log(result);
                    var html = '';
                    var sr_no = 1;
                    html += `
                        <thead>
                            <tr>
                                <th>Sr.No</th>
                                <th>Print</th>
                                <th>Bill Period</th>
                                <th>From Date</th>
                                <th>To Date</th>
                                <th>Total litres</th>
                                <th>Amount</th>
                                <th>Previous Balance</th>
                                <th>Total Amount</th>
                                <th>Amount Paid</th>
                                <th>Remaining Balance</th>
                                <th>Adjusted</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                            </tr>
                        </thead>
                        <tbody>
                    `;
                    for(var i in result) {
                        var date1 = new Date(result[i].from_date);
                        var date2 = new Date(result[i].to_date);
                        var diffDays = parseInt((date2 - date1) / (1000 * 60 * 60 * 24), 10); 
                        console.log(diffDays);
                        if(diffDays == '27' || diffDays == '28' || diffDays == '29'|| diffDays == '30'|| diffDays == '31') {
                            diffDays = 'Monthly';
                        }
                        else if (diffDays == '9' || diffDays == '10' || diffDays == '11') {
                            diffDays = 'Ten Days';
                        }
                        else if(diffDays == '6' || diffDays == '7' || diffDays == '8') {
                            diffDays = 'Weekly';
                        }
                        else {
                            diffDays = diffDays+' days';
                        }
                        html += `
                            <tr>
                                <td>${sr_no}</td>
                                <td>
                                    <a class="btn btn-sm btn-primary" fdate="${result[i].from_date}" tdate="${result[i].to_date}" 
                                    id="open_total_billing_modal"><i class="fa fa-print"></i></a>
                                </td>
                                <td>${diffDays}</td>
                                <td>${moment(result[i].from_date).format('MMM D YYYY')}</td>
                                <td>${moment(result[i].to_date).format('MMM D YYYY')}</td>
                                <td>${result[i].total_litres}</td>
                                <td>${result[i].amount}</td>
                                <td>${result[i].previous_balance}</td>
                                <td>${result[i].total_amount}</td>
                                <td>${result[i].amount_paid}</td>
                                <td>${result[i].pending_amount}</td>
                                <td>${result[i].adjusted}</td>
                                <td>${moment(result[i].created_at).format('MMM D YYYY')}</td>
                                <td>${result[i].updated_at ? moment(result[i].updated_at).format('MMM D YYYY') : '-'}</td>
                            </tr>
                        `;
                        sr_no++;
                    }
                    html += `</tbody>`;
                    $("#total_billing_datatable").html(html);
                    $("#total_billing_datatable").DataTable({
                        order: [[2,'desc']],
                        rowGroup: {
                            dataSrc: [2]
                        },
                        columnDefs: [{
                            targets: [2],
                            visible: false
                        }],
                        dom: 'lBfrtip',
                        buttons: [
                            'pdf'
                        ],
                        // "order": [],
                        responsive: true,
                        "pagingType": "simple"
                    })
                }
            });
        }
        

        $('body').delegate('#open_total_billing_modal', 'click', function() {

            $("#preloader").show();
            
            var xdate = $(this).attr('fdate');
            var ydate = $(this).attr('tdate');
            
                $.ajax({
                    url: `${base_url}/billing/customer_api/3/${xdate}/${ydate}`,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    method: "GET",
                    contentType: false,
                    processData: false,
                    success: function(res) {
                        console.log(res);
                        var result = res.data;
                        var html = '';
                        var sr_no = 1;
                        html += `
                        <div class="container bootstrap snippets bootdeys">
                        <div class="row">
                        <div class="col-md-12">
                        <div class="panel panel-default invoice" id="invoice">
                        <div class="panel-body">
                        <div class="row">
                        <div class="col-md-12">
                        <p>Date : ${moment(xdate).format('DD-MMM-YYYY')} - ${moment(ydate).format('DD-MMM-YYYY')}</p>
                        </div>
                        </div>
                        <div class="row">
                        <div class="col-md-12">
                        <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                            <th scope="col">Sr.No</th>
                            <th scope="col">Customer Name<br> (ગ્રાહક નું નામ)</th>
                            <th scope="col">Total Litres<br> (કુલ લિટર)</th>
                            <th scope="col">Amount<br> (રકમ)</th>
                            <th scope="col">Previous Balance<br> (અગાઉનું બેલેન્સ)</th>
                            <th scope="col">Total Amount</th>
                            <th scope="col">Amount Paid</th>
                            <th scope="col">Remaining Balance</th>
                            <th scope="col">Adjusted</th>
                            </tr>
                        </thead>
                        <tbody>
                        `;
                        for(var i in result) {
                            html += `
                                <tr>
                                    <td>${sr_no}</td>
                                    <td>${result[i].customer_name}</td>
                                    <td>${result[i].total_litres}</td>
                                    <td>${result[i].amount}</td>
                                    <td>${result[i].previous_balance}</td>
                                    <td>${result[i].total_amount}</td>
                                    <td>${result[i].amount_paid}</td>
                                    <td>${result[i].pending_amount}</td>
                                    <td>${result[i].adjusted}</td>
                                </tr>
                            `;
                            sr_no++;
                        }
                        const total_bill_litres = result
            						.map(results => Number(results.total_litres))
            						.reduce((total, count) => total + count, 0);
                        const total_bill_amount = result
            						.map(results => Number(results.amount))
            						.reduce((total, count) => total + count, 0);
                        const total_bill_previous_balance = result
            						.map(results => Number(results.previous_balance))
            						.reduce((total, count) => total + count, 0);
                        const total_bill_total_amount = result
            						.map(results => Number(results.total_amount))
            						.reduce((total, count) => total + count, 0);
                        const total_bill_amount_paid = result
            						.map(results => Number(results.amount_paid))
            						.reduce((total, count) => total + count, 0);
                        const total_bill_pending_amount = result
            						.map(results => Number(results.pending_amount))
            						.reduce((total, count) => total + count, 0);
                        const total_bill_adjusted = result
            						.map(results => Number(results.adjusted))
            						.reduce((total, count) => total + count, 0);
                        html += `
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td></td>
                                    <td>Total:</td>
                                    <td><b>${total_bill_litres}</b></td>
                                    <td><b>${total_bill_amount}</b></td>
                                    <td><b>${total_bill_previous_balance}</b></td>
                                    <td><b>${total_bill_total_amount}</b></td>
                                    <td><b>${total_bill_amount_paid}</b></td>
                                    <td><b>${total_bill_pending_amount}</b></td>
                                    <td><b>${total_bill_adjusted}</b></td>
                                </tr>
                            </tfoot>
                            </table>
                        </div>
                        </div>
                        </div>
                        </div>
                        </div>
                        </div>
                        </div>`;
                        
                        $("#preloader").hide();
                        $("#total_billing_modal").modal('show');
                        $("#get_total_billing_detail").html(html);
                    }
                });
        });

        function Rs(amount) {
            var words = new Array();
            words[0] = 'Zero';
            words[1] = 'One';
            words[2] = 'Two';
            words[3] = 'Three';
            words[4] = 'Four';
            words[5] = 'Five';
            words[6] = 'Six';
            words[7] = 'Seven';
            words[8] = 'Eight';
            words[9] = 'Nine';
            words[10] = 'Ten';
            words[11] = 'Eleven';
            words[12] = 'Twelve';
            words[13] = 'Thirteen';
            words[14] = 'Fourteen';
            words[15] = 'Fifteen';
            words[16] = 'Sixteen';
            words[17] = 'Seventeen';
            words[18] = 'Eighteen';
            words[19] = 'Nineteen';
            words[20] = 'Twenty';
            words[30] = 'Thirty';
            words[40] = 'Forty';
            words[50] = 'Fifty';
            words[60] = 'Sixty';
            words[70] = 'Seventy';
            words[80] = 'Eighty';
            words[90] = 'Ninety';
            var op;
            amount = amount.toString();
            var atemp = amount.split('.');
            var number = atemp[0].split(',').join('');
            var n_length = number.length;
            var words_string = '';
            if (n_length <= 9) {
                var n_array = new Array(0, 0, 0, 0, 0, 0, 0, 0, 0);
                var received_n_array = new Array();
                for (var i = 0; i < n_length; i++) {
                    received_n_array[i] = number.substr(i, 1);
                }
                for (var i = 9 - n_length, j = 0; i < 9; i++, j++) {
                    n_array[i] = received_n_array[j];
                }
                for (var i = 0, j = 1; i < 9; i++, j++) {
                    if (i == 0 || i == 2 || i == 4 || i == 7) {
                        if (n_array[i] == 1) {
                            n_array[j] = 10 + parseInt(n_array[j]);
                            n_array[i] = 0;
                        }
                    }
                }
                value = '';
                for (var i = 0; i < 9; i++) {
                    if (i == 0 || i == 2 || i == 4 || i == 7) {
                        value = n_array[i] * 10;
                    } else {
                        value = n_array[i];
                    }
                    if (value != 0) {
                        words_string += words[value] + ' ';
                    }
                    if ((i == 1 && value != 0) || (i == 0 && value != 0 && n_array[i + 1] == 0)) {
                        words_string += 'Crores ';
                    }
                    if ((i == 3 && value != 0) || (i == 2 && value != 0 && n_array[i + 1] == 0)) {
                        words_string += 'Lakhs ';
                    }
                    if ((i == 5 && value != 0) || (i == 4 && value != 0 && n_array[i + 1] == 0)) {
                        words_string += 'Thousand ';
                    }
                    if (i == 6 && value != 0 && (n_array[i + 1] != 0 && n_array[i + 2] != 0)) {
                        words_string += 'Hundred and ';
                    } else if (i == 6 && value != 0) {
                        words_string += 'Hundred ';
                    }
                }
                words_string = words_string.split(' ').join(' ');
            }
            return words_string;
        }

        function RsPaise(n) {
            nums = n.toString().split('.')
            var whole = Rs(nums[0])
            if (nums[1] == null) nums[1] = 0;
            if (nums[1].length == 1) nums[1] = nums[1] + '0';
            if (nums[1].length > 2) {
                nums[1] = nums[1].substring(2, length - 1)
            }
            if (nums.length == 2) {
                if (nums[0] <= 9) {
                    nums[0] = nums[0] * 10
                } else {
                    nums[0] = nums[0]
                };
                var fraction = Rs(nums[1])
                if (whole == '' && fraction == '') {
                    op = 'Zero only';
                }
                if (whole == '' && fraction != '') {
                    op = 'paise ' + fraction + ' only';
                }
                if (whole != '' && fraction == '') {
                    op = 'Rupees ' + whole + ' only';
                }
                if (whole != '' && fraction != '') {
                    op = 'Rupees ' + whole + 'and paise ' + fraction + ' only';
                }
                // amt = document.getElementById('amt').value;
                // if (amt > 999999999.99) {
                //     op = 'Oops!!! The amount is too big to convert';
                // }
                // if (isNaN(amt) == true) {
                //     op = 'Error : Amount in number appears to be incorrect. Please Check.';
                // }
                // document.getElementById('op').innerHTML = op;
                return op;
            }
        }

        /* $(document).on('click', '.pagination a', function(event){        
                $("#preloader").show();
                event.preventDefault();
                var page = $(this).attr('href').split('page=')[1];            
                fetch_data(page);
                $("#preloader").hide();
            });

            function fetch_data(page)
            {
                $.ajax({
                url:base_url+"/billing/pagination?page="+page,
                success:function(data)
                {
                    console.log(data);
                    $('#billing_paginate_data').html(data);
                }
            });
        } */



        window.onafterprint = function() {
            window.location.reload(true);
        }

        $('body').delegate('#invoice-print', 'click', function() {
            var printContents = document.getElementById("get_billing_table").innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
            window.close();
        })

        $('body').delegate('#invoice-print1', 'click', function() {
            var printContents = document.getElementById("get_total_billing_detail").innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
            window.close();
        })
    }
    
});