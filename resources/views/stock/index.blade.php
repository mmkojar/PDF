@extends('layouts.app')


@section('content')

<div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">         
          <div class="tab-content tab-space tab-subcategories">

            <div class="tab-pane active" id="stockavail">
              <div class="card">               
                <div class="card-body">
                    <?php $count=1 ?>
                    <table id="main_stock" class="table table-striped table-bordered" cellspacing="0" width="100%">
                      {{-- <thead>
                        <tr>
                            <th>Sr.No</th>
                            <th>Item Name</th>
                            <th>Unit</th>
                            <th>Qty Remaining</th>
                            <th>Purcahse Rate</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($stocksavail as $row)
                          <tr>
                            <td>{{$count}}</td>                          
                            <td><a id="show_stock_modal" data-item_name={{$row->item_name}} item-id={{$row->item_id}}>{{$row->item_name}}</a></td>
                            <td>{{$row->unit}}</td>
                            <td>{{$row->qty}}</td>
                            <td>{{$row->rate}}</td>
                          </tr>
                        @endforeach
                      </tbody> --}}
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
                  {{-- action="{{route('stock.store')}}" --}}
                    @csrf
                    <div class="card-body">                       
                        <div class="row">
                            {{-- <div class="col-md-6">
                                <div class="form-group">
                                    <label>Item Name</label>
                                    <select class="form-control" name="item_id" required> 
                                        <option value="" selected disabled>Select</option>
                                        @foreach($items as $item)
                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div> --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Stock Option</label>
                                    <select class="form-control" name="stock_option" id="stock_option"> 
                                        {{-- <option value="" selected disabled>Select</option> --}}
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
                                        {{-- <option value="" selected disabled>Select</option> --}}
                                        <option value="GRAM" selected>GRAM</option>
                                        <option value="KG">KG</option>
                                        <option value="LTR">LTR</option>
                                        <option value="BOX">BOX</option>
                                        <option value="PCS">PCS</option>
                                    </select>
                                </div> 
                            </div>                    
                            <div class="col-md-6" id="purchase_rate_col">
                                <div class="form-group">
                                    <label>Purchase Rate</label>
                                    <input type="number" min="1" name="rate" id="rate" class="form-control">
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

            <div class="tab-pane active" id="stockin">
              <div class="card">                
                <div class="card-body">
                    <?php $count=1 ?>
                    <table id="stockin_dt" class="table table-striped table-bordered" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                            <th>Sr.No</th>
                            <th>Party Name</th>
                            <th>Item Name</th>
                            <th>Unit</th>
                            <th>Qty</th>
                            <th>Purchase Rate</th>
                            <th>Total Amount</th>
                            <th>Date</th>
                            @can('all-access')
                            <th>Action</th>
                            @endcan
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($stockin as $row)
                          <tr>
                            <td>{{$count}}</td>
                            <td>{{$row->party_name}}</td>
                            <td>{{$row->item_name}}</td>
                            <td>{{$row->unit}}</td>
                            <td>{{$row->qty}}</td>
                            <td>{{$row->rate}}</td>
                            <td>{{$row->total_amount}}</td>
                            <td>{{date('M j Y',strtotime($row->date))}}</td>
                            @can('all-access')   
                            <td>                              
                              <a href="{{route('stock.in.edit', $row->id)}}" class="btn btn-sm btn-warning edit"><i class="fa fa-edit"></i></a>   
                              <a id="{{$row->id}}" class="btn btn-sm btn-danger delete_all" tbname="{{$row->item_id}}" url="stock/in"><i class="fa fa-times"></i></a>
                            </td>
                            @elsecan('no-access')
                            <td></td>
                            @endcan
                          </tr>
                          <?php $count++ ?>
                        @endforeach
                      </tbody>
                      <tfoot>
                        <tr>
                          <th colspan="4" style="text-align:right">Total:</th>
                          <th></th>
                          <th colspan="4"></th>
                        </tr>
                      </tfoot>
                    </table>
                </div>
              </div>
            </div>
            
            <div class="tab-pane active" id="stockout">
              <div class="card">               
                <div class="card-body">
                    <?php $count=1 ?>
                    <table id="stockout_dt" class="table table-striped table-bordered" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                            <th>Sr.No</th>
                            <th>Item Name</th>
                            <th>Qty Sell</th>
                            <th>Unit</th>
                            {{-- <th>Rate</th> --}}
                            {{-- <th>Total Amount</th> --}}
                            <th>Date</th>
                            @can('all-access')   
                                <th>Action</th>
                            @endcan
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($stockout as $row)
                          <tr>
                            <td>{{$count}}</td>
                            <td>{{$row->item_name}}</td>        
                            <td class="font-weight-bold">{{$row->qty}}</td>
                            <td>{{$row->unit}}</td>
                            {{-- <td>{{$row->rate}}</td> --}}
                            {{-- <td>{{$row->total_amount}}</td> --}}
                            <td>{{date('M j Y',strtotime($row->date))}}</td>
                            @can('all-access')
                            <td>
                              <a id="{{$row->id}}" class="btn btn-sm btn-danger delete_all" tbname="{{$row->item_id}}" qty="{{$row->qty}}" url="stock/out"><i class="fa fa-times"></i></a>                    
                              <a href="{{route('stock.out.edit', $row->id)}}" class="btn btn-sm btn-warning edit"><i class="fa fa-edit"></i></a>                    
                            </td>
                            @elsecan('no-access')
                            <td></td>
                            @endcan
                          </tr>
                          <?php $count++ ?>
                        @endforeach
                      </tbody>
                      <tfoot>
                        <tr>
                          <th colspan="1" style="text-align:right">Total:</th>
                          <th></th>
                          <th colspan="4"></th>
                        </tr>
                      </tfoot>
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
  <script type="text/javascript">

$(document).ready(function() {
        
        $(document).on('click', '#show_stock_modal', function() {
            var item_id = $(this).attr("item-id");
            var item_name = $(this).data("item_name");
            $("#hidden_item_id").val(item_id);
            $("#modal_title").text(item_name.toUpperCase());
            $("#party_name_col, #purchase_rate_col").show();
            $('#qty,#hidden_qty,#rate,#party_name').val('');
            $('#stock_option').val('purchase');
            $("#stock_entry_form .alert").hide();
            $('#qty').removeAttr('max');
            $('#qty,#unit').attr('disabled',false);
            var today = new Date();
            document.querySelector("#date").value = today.getFullYear() + '-' + ('0' + (today.getMonth() + 1)).slice(-2) + '-' + ('0' + today.getDate()).slice(-2);
            $("#stock-modal").modal('show');           
        });

        $(document).on('change', '#stock_option', function() {
            if($(this).val() == "use") {
              $("#party_name_col, #purchase_rate_col").hide();
              $("#preloader").show();
              var item_id = $("#hidden_item_id").val();
              $.ajax({
                url:base_url+"/stock/out/api/"+item_id,
                method:"GET",
                dataType:'json',
                success:function(res)
                {
                  console.log(res);
                    $("#preloader").hide();
                    if(res.length > 0) {
                      var res = res[0];
                      $('#unit').val(res.unit);
                      $('#qty').val(res.qty);
                      $('#qty').attr('max',res.qty);
                      $('#hidden_qty').val(res.qty);
                    }
                    else {
                        $('<div class="alert alert-danger alert-dismissible"><h6 class="my-0" data-dismiss="alert">Purhcase Item Cannot be 0</h6></div>').insertBefore('#stock_entry_form .card-body .row');
                        $('#qty,#unit').attr('disabled',true);
                    }                    
                }
              })
            }
            else {
              $('#qty,#unit').attr('disabled',false);
              $("#stock_entry_form .alert").hide();
              $("#party_name_col, #purchase_rate_col").show();
              $('#unit,#qty,#hidden_qty,#rate').val('');
              $('#qty').removeAttr('max');
            }
        })

        $('body').delegate('#stock_entry_button', 'click', function(e) {
          e.preventDefault();
          console.log($("#stock_option").val());
            /* if($("#stock_option").val() == 'purchase') {
              if($("#party_name").val() == '' || $("#qty").val() == '' || $("#rate").val() == '' || $("#date").val() == '') {
                $('<div class="alert alert-danger alert-dismissible"><h6 class="my-0" data-dismiss="alert">All fields are required</h6></div>').insertBefore('#stock_entry_form .card-body .row');
              }
            }
            else if($("#stock_option").val() == 'use') {
              if($("#qty").val() == '' || $("#date").val() == '') {
                $('<div class="alert alert-danger alert-dismissible"><h6 class="my-0" data-dismiss="alert">All fields are required</h6></div>').insertBefore('#stock_entry_form .card-body .row');
              }
            } */
            // else {
                
                var dataSerialize = new FormData($('#stock_entry_form')[0]);
                $("#preloader").show();
                $.ajax({
                  url: base_url+"/stock/in/store",
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
                      stock_calculation();
                  }
                }) 
            // }
           
        });

        // For Stock Availability 
        stock_calculation();
        function stock_calculation() {       
          $.ajax({
            url:base_url+"/stock/api",
            method:"GET",
            dataType:'json',
            success:function(res)
            {
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
                console.log(response);
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
            }
          })
        }
        $('#stockin_dt').DataTable({
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
              responsive: true,
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

        $('#stockout_dt').DataTable({
              order: [[1,'desc']],
              rowGroup: {
                  dataSrc: [1]
              },
              columnDefs: [{
                  targets: [1],
                  visible: false
              }],
              dom: 'lBfrtip',
              buttons: [
                  'pdf'
              ],
              responsive: true,
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
      })
      
  </script>
@endsection