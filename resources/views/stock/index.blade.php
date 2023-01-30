@extends('layouts.app')


@section('content')

  <div class="row" id="stock_page">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">         
            <div class="tab-content">

              <div class="tab-pane active">
                <div class="card">
                  {{-- <div class="card-header">
                    <form action="" accept="" role="form" method="post" id="filter_stock">
                      @csrf
                        <div class="form-group">
                            <label>Date</label>
                            <input type="text" name="date" id="filter_date" class="datepicker form-control">
                        </div>
                    </form>
                  </div> --}}
                  <div class="card-body">
                      <?php $count=1 ?>
                      <table id="main_stock" class="table table-striped table-bordered" cellspacing="0" width="100%">                      
                      </table>
                  </div>
                </div>
              </div>
              
                <!-- Modal -->
              <div class="modal fade" id="stock-modal">
                <div class="modal-dialog modal-md">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="modal_title"></h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <form action="" accept="" role="form" method="post" id="stock_entry_form">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Stock Option</label>
                                        <select class="form-control" name="stock_option" id="stock_option"> 
                                            <option value="purchase" selected>Purchase</option>
                                            <option value="use">Use</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6" id="party_name_col">
                                    <div class="form-group">
                                        <label>Party Name</label>
                                        <input type="text" name="party_name" id="party_name" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Qty</label>
                                        <input type="number" name="qty" id="qty" class="form-control" min="1">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Select Unit</label>
                                        <select class="form-control" name="unit" id="unit">
                                            {{-- <option value="GRAM">GRAM</option>
                                            <option value="KG">KG</option>
                                            <option value="LTR">LTR</option>
                                            <option value="BOX">BOX</option>
                                            <option value="PCS">PCS</option> --}}
                                            <option value="GUNI">GUNI</option>
                                        </select>
                                    </div> 
                                </div>                    
                                <div class="col-md-6" id="purchase_rate_col">
                                    <div class="form-group">
                                        <label>Purchase Rate</label>
                                        <input type="number" name="rate" value="0" id="rate" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Date</label>
                                        <input type="text" name="date" id="date" class="datepicker form-control">
                                    </div>
                                </div>                        
                            </div>
                        </div>
                        <div class="card-footer">
                          <input type="hidden" name="item_id" id="hidden_item_id">
                          <input type="hidden" id="hidden_qty" name="hidden_qty" class="form-control" />
                          <button type="submit" class="btn btn-info btn-round" id="stock_entry_button">Submit</button>
                          <button type="button" class="btn btn-dark btn-round" data-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                  </div>
                </div>
              </div>

              <div class="tab-pane active">
                <div class="card">
                  <div class="card-body">                      
                      <a class="btn btn-info btn-round" data-toggle="modal" data-target="#item-modal">Add Items</a>
                      <h3 class="text-success font-weight-bold mb-2">Items</h3>
                      <table id="datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                          <tr>
                            <th>Sr.No</th>
                            <th>Name</th>
                            <th>Date</th>
                            @can('all-access')
                              <th class="disabled-sorting text-right">Actions</th>
                            @endcan
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($items as $row)
                            <tr>
                              <td>{{$count}}</td>
                              <td>{{ucfirst($row->name)}}</td>
                              <td>{{date('M j Y',strtotime($row->created_at))}}</td>
                              <td>                    
                                @can('all-access')
                                <a href="{{route('stock.items.form', $row->id)}}" class="btn btn-sm btn-warning edit"><i class="fa fa-edit"></i></a>
                                <a id="{{$row->id}}" class="btn btn-sm btn-danger delete_all" url="stock/items"><i class="fa fa-times"></i></a>
                                @endcan
                              </td>
                            </tr>  
                            <?php $count++ ?>            
                          @endforeach
                        </tbody>
                      </table>
                  </div>
                </div>
                 <!-- Add item Modal -->
                <div class="modal fade" id="item-modal">
                  <div class="modal-dialog modal-md">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5>Add Item</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <form action="{{route('stock.items.store')}}" accept="" role="form" method="post">
                          @csrf
                          <div class="card-body">                  
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" name="name" id="name" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-info btn-round">Submit</button>
                            <button type="button" class="btn btn-dark btn-round" data-dismiss="modal">Cancel</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>

              <div class="tab-pane active">
                <div class="card">
                  <div class="card-body">
                      <h3 class="text-success font-weight-bold mb-2">Purchase</h3>
                      <table id="stockin_dt" class="table table-striped table-bordered" cellspacing="0" width="100%">                     
                      </table>
                  </div>
                </div>
              </div>
              
              <div class="tab-pane active">
                <div class="card">
                  <div class="card-body">
                      <h3 class="text-success font-weight-bold mb-2">Use</h3>
                      <table id="stockout_dt" class="table table-striped table-bordered" cellspacing="0" width="100%">                      
                      </table>
                  </div>
                </div>
              </div>
              
            </div>
          </div>
        </div>
        
      </div> 
</div> 

@endsection

@section('stock_script')
  <script src="{{ asset('js/api.js') }}"></script>
  <script type="text/javascript">

      $(document).ready(function() {
          
          $(document).on('click', '#show_stock_modal', function() {
              var item_id = $(this).attr("item-id");
              var item_name = $(this).data("item_name");
              $("#hidden_item_id").val(item_id);
              $("#modal_title").text(item_name.toUpperCase());
              $("#party_name_col, #purchase_rate_col").show();
              $('#hidden_qty,#party_name,#qty').val('');
              $('#stock_option').val('purchase');
              $("#stock_entry_form .alert").hide();
              $('#qty,#unit,#stock_entry_button').attr('disabled',false);
              var today = new Date();
              document.querySelector("#date").value = today.getFullYear() + '-' + ('0' + (today.getMonth() + 1)).slice(-2) + '-' + ('0' + today.getDate()).slice(-2);
              $("#stock-modal").modal('show');           
          });

          $(document).on('change', '#stock_option', function() {
              if($(this).val() == "use") {
                $("#party_name_col, #purchase_rate_col").hide();
                $("#preloader").show();
                var item_id = $("#hidden_item_id").val();

                ajaxGetApi("/stock/out/api/"+item_id, function(res) {
                    $("#preloader").hide();
                    if(res.length > 0) {
                      var res = res[0];
                      $('#unit').val(res.unit);
                      $('#qty').val(res.qty);
                      $('#hidden_qty').val(res.qty);
                    }
                    else {
                        $('#qty').val('');
                        $('<div class="alert alert-danger alert-dismissible"><h6 class="my-0" data-dismiss="alert">Stock Not available</h6></div>').insertBefore('#stock_entry_form .card-body .row');
                        $('#qty,#unit,#stock_entry_button').attr('disabled',true);
                    }
                }, function (data) {
                    console.log(data);
                })
              }
              else {
                $('#qty,#unit,#stock_entry_button').attr('disabled',false);
                $("#stock_entry_form .alert").hide();
                $("#party_name_col, #purchase_rate_col").show();
                $('#hidden_qty,#party_name,#qty').val('');
              }
          })

          $('body').delegate('#stock_entry_button', 'click', function(e) {
                e.preventDefault();                       

                var errors = [];
                if($("#stock_option").val() == 'use') {
                    var hqty = Number($("#hidden_qty").val());
                    var qty = Number($("#qty").val());
                    if(qty > hqty) {
                      $('<div class="alert alert-danger alert-dismissible"><h6 class="my-0" data-dismiss="alert">Quantity should be lesser or equal to '+hqty+'</h6></div>').insertBefore('#stock_entry_form .card-body .row');                      
                        errors.push('error');
                    }
                    errors.push();
                }
                if(qty == 0) {
                  $('<div class="alert alert-danger alert-dismissible"><h6 class="my-0" data-dismiss="alert">Minimum Qty should be 1</h6></div>').insertBefore('#stock_entry_form .card-body .row');
                  errors.push('error');
                }
                else {
                  errors.push();
                }
                
                if(errors.length == '0') {
                    var dataSerialize = new FormData($('#stock_entry_form')[0]);
                    $("#preloader").show();
                    $.ajax({
                      url: base_url+"/stock/insert",
                      headers: {
                          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                      },
                      method: "POST",
                      data : dataSerialize,
                      contentType: false,
                      processData: false,
                      success: function(res) {
                          $("#preloader").hide();
                          Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: res.msg,
                            showConfirmButton: true,
                            timer: 1500
                          })
                          $("#stock-modal").modal('hide');
                          stock_calculation();
                          $('#stockin_dt').DataTable().destroy();
                          stock_in();
                          $('#stockout_dt').DataTable().destroy();
                          stock_out();
                      }, 
                      error:function(err) {
                        $("#preloader").hide();
                      }
                    })   
                }    
          });

          // For Stock Availability 
          /* $("#filter_date").on('change', () => {
            var date = $("#filter_date").val();
            stock_calculation(date);
          }) */

          stock_calculation();
          function stock_calculation() {
            $("#preloader").show();
            // var url = id ? base_url+"/stock/api/"+id : base_url+"/stock/api";

            ajaxGetApi("/stock/api", function(res) {
                $("#preloader").hide();
                const concatresult = [...res.purchase,...res.use];
                
                for(var i in concatresult) {
                    if(concatresult[i].pqty) {
                      concatresult[i].pqty = Number(concatresult[i].pqty);
                      concatresult[i].uqty = 0;
                    }
                    if(concatresult[i].uqty) {
                      concatresult[i].uqty = Number(concatresult[i].uqty);
                      concatresult[i].pqty = 0;
                    }                
                    concatresult[i].pqty == null ? (concatresult[i].pqty = 0) : '';
                    concatresult[i].uqty == null ? (concatresult[i].uqty = 0) : '';
                    
                }
                var response = concatresult.reduce((a2, c2) => {
                    let filteredP = a2.filter(el => el.item_name === c2.item_name)
                    if (filteredP.length > 0) {
                        a2[a2.indexOf(filteredP[0])].pqty += +c2.pqty;
                        a2[a2.indexOf(filteredP[0])].uqty += +c2.uqty;
                    } else {
                        a2.push(c2);
                    }
                    return a2;
                }, []);
               
                var html = '';     
                html += `<thead><tr><th></th>`    
                for(var i in response) {
                    html += `
                        <th><a id="show_stock_modal" data-item_name=${response[i].item_name} item-id=${response[i].item_id}>${response[i].item_name}</a></th>
                    `;
                }
                html += ` </tr>
                    </thead>
                    <tbody>                    
                        <tr><td>Purchase</td>           
                    `;
                for(var i in response) {
                    html += `                     
                          <td>${response[i].pqty}</td>
                    `;
                }
                html += `                 
                        </tr> <tr><td>Use</td>           
                    `;
                for(var i in response) {
                    html += `                     
                          <td>${response[i].uqty}</td>
                    `;
                }
                html += `                  
                        </tr> <tr><td>Stock</td>           
                    `;
                for(var i in response) {
                    html += `
                          <td>${response[i].pqty - response[i].uqty}</td>
                    `;
                }   
                html += `</tr></tbody>`
                $("#main_stock").html(html);
            },
            function (data) {
                console.log(data);
            })
          }

          stock_in();
          function stock_in() {       
            $("#preloader").show();            
            ajaxGetApi("/stock/api", function(res) {
              $("#preloader").hide();
              var resp = res.stockin;
              var html = '';
              var sr_no = 1;
              html += `
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Party Name</th>
                            <th>Item Name</th>
                            <th>Unit</th>
                            <th>Qty</th>
                            <th>Purchase Rate</th>
                            <th>Total Amount</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                      </thead>
                    <tbody>
              `;
              for(var i in resp) {
                  html += `
                        <tr>
                          <td>${resp[i].id}</td>
                          <td>${resp[i].party_name ? resp[i].party_name : '-'}</td>
                          <td>${resp[i].item_name}</td>
                          <td>${resp[i].unit}</td>
                          <td>${resp[i].qty}</td>
                          <td>${resp[i].rate}</td>
                          <td>${resp[i].total_amount}</td>
                          <td>${moment(resp[i].created_at).format("DD-MMM-YYYY")}</td>
                          <td>
                            <a href="{{config('app.url')}}/stock/in/${resp[i].id}/edit" class="btn btn-sm btn-warning edit"><i class="fa fa-edit"></i></a>   
                            <a id="${resp[i].id}" class="btn btn-sm btn-danger delete_all" tbname="${resp[i].item_id}" url="stock/in"><i class="fa fa-times"></i></a>
                          </td>
                      </tr>
                  `;
                  sr_no++;
              }
              html += `
              </tbody>
                <tfoot>
                  <tr>
                    <th colspan="4" style="text-align:right">Total:</th>
                    <th></th>
                    <th colspan="4"></th>
                  </tr>
                </tfoot>
              ` ;
              $('#stockin_dt').html(html);
              $('#stockin_dt').DataTable({
                    order: [[0,'desc']],
                  /*  order: [[1,'desc']],
                    rowGroup: {
                        dataSrc: [1]
                    }, */
                    columnDefs: [{
                        targets: [0],
                        visible: false,
                    }],
                    dom: 'lBfrtip',
                    buttons: [
                        'pdf'
                    ],
                    responsive: true,                    
                    "pagingType": "simple",
                    footerCallback: function (row, data, start, end, display) {
                      var api = this.api();
                      
                      // Remove the formatting to get integer data for summation
                      var intVal = function (i) {
                        return typeof i === 'string' ? i.replace(/[\$,]/g, '') * 1 : typeof i === 'number' ? i : 0;
                      };
                
                      // Total over all pages
                      total = api
                        .column(4)
                        .data()
                        .reduce(function (a, b) {
                          return intVal(a) + intVal(b);
                        }, 0);
                
                      // Total over this page
                      pageTotal = api
                        .column(4, { page: 'current' })
                        .data()
                        .reduce(function (a, b) {
                          return intVal(a) + intVal(b);
                        }, 0);
                
                      // Update footer
                      $(api.column(4).footer()).html(pageTotal + ' ( ' + total + ' total)');
                    },
              });
            },
            function (data) {
                console.log(data);
            })
          }
          
          stock_out();
          function stock_out() {
            $("#preloader").show();
            ajaxGetApi("/stock/api", function(res) {
                $("#preloader").hide();
                var resp = res.stockout;
                var html = '';
                var sr_no = 1;
                html += `
                      <thead>
                          <tr>
                              <th>Id</th>
                              <th>Item Name</th>
                              <th>Qty</th>
                              <th>Unit</th>
                              <th>Date</th>
                              <th>Action</th>
                          </tr>
                        </thead>
                      <tbody>
                `;
                for(var i in resp) {
                    html += `
                          <tr>
                            <td>${resp[i].id}</td>
                            <td>${resp[i].item_name}</td>
                            <td>${resp[i].qty}</td>
                            <td>${resp[i].unit}</td>
                            <td>${moment(resp[i].created_at).format("DD-MMM-YYYY")}</td>
                            <td>
                              <a href="{{config('app.url')}}/stock/out/${resp[i].id}/edit" class="btn btn-sm btn-warning edit"><i class="fa fa-edit"></i></a>   
                              <a id="${resp[i].id}" class="btn btn-sm btn-danger delete_all" tbname="${resp[i].item_id}" qty="${resp[i].qty}" url="stock/out"><i class="fa fa-times"></i></a>
                            </td>
                        </tr>
                    `;
                    sr_no++;
                }
                html += `
                </tbody>
                  <tfoot>
                    <tr>
                      <th colspan="2" style="text-align:right">Total:</th>
                      <th></th>
                      <th colspan="3"></th>
                    </tr>
                  </tfoot>
                ` ;
                $('#stockout_dt').html(html);
                $('#stockout_dt').DataTable({
                      order: [[0,'desc']],
                    /*  order: [[0,'desc']],
                      rowGroup: {
                          dataSrc: [0]
                      },*/
                      columnDefs: [{
                          targets: [0],
                          visible: false,
                      }],
                      dom: 'lBfrtip',
                      buttons: [
                          'pdf'
                      ],
                      responsive: true,
                      "pagingType": "simple",
                      footerCallback: function (row, data, start, end, display) {
                        var api = this.api();
                  
                        // Remove the formatting to get integer data for summation
                        var intVal = function (i) {
                          return typeof i === 'string' ? i.replace(/[\$,]/g, '') * 1 : typeof i === 'number' ? i : 0;
                        };
                  
                        // Total over all pages
                        total = api
                          .column(2)
                          .data()
                          .reduce(function (a, b) {
                            return intVal(a) + intVal(b);
                          }, 0);
                  
                        // Total over this page
                        pageTotal = api
                          .column(2, { page: 'current' })
                          .data()
                          .reduce(function (a, b) {
                            return intVal(a) + intVal(b);
                          }, 0);
                          
                        // Update footer
                        $(api.column(2).footer()).html(pageTotal + ' ( ' + total + ' total)');
                      },
                });
            }, 
            function (data) {
                console.log(data);
            });
          }
        
      })
        
  </script>
@endsection