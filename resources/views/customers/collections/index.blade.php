@extends('layouts.app')

@section('content')

<div class="row">
  <div class="col-md-12">
      <div class="card ">
          {{-- <div class="card-header px-0"> --}}
            <div class="col-md-2 mt-2">
              <form action="{{route('milk_entries.index')}}" accept="" role="form" method="GET">
                <div class="form-group">
                    <label>Filter By Date</label>
                    <input type="text" class="form-control datepicker" value="{{isset($_GET['filter_date']) ? $_GET['filter_date'] : date('Y-m-d')}}" name="filter_date" required>
                    <button type="submit" class="btn btn-info btn-round">Filter</button>                    
                    <a href="{{config('app.url')}}/milk_entries" class="btn btn-dark btn-round">Reload</a> 
                </div>
              </form>
            </div>
          {{-- </div> --}}
          <form action="{{route('milk_entries.store')}}" accept="" role="form" method="post" id="milk_sold_form">
              @csrf
              <div class="card-body">
                      <div class="row mb-4">
                          <div class="col-md-2">
                              <div class="form-group">
                                  <label>Sold Date</label>
                                  <input type="text" class="form-control datepicker" value="{{$next_date}}" name="sold_date" required>
                              </div>
                          </div>                          
                      </div>
                      <input type="hidden" name="filter_date" value="{{isset($_GET['filter_date']) ? $_GET['filter_date'] : ''}}">
                      <div class="row">
                          <div class="col-xl-5">
                            <h3 class="text-center">User Entry</h3>
                              <div class="row">
                                  <div class="col-md-2">
                                  </div>
                                  <div class="col-md-10">
                                      <input type="text" value="Morning" class="clabelstyle">
                                      <input type="text" value="Evening" class="clabelstyle">
                                      <input type="text" value="Total" class="clabelstyle">
                                  </div>
                                  @foreach($milkusers as $row)
                                      <div class="col-md-2">
                                          <p class="my-2">{{$row->name}}</p>
                                      </div>
                                      <div class="col-md-10">
                                          <input type="hidden" name="user_id[]" value="{{$row->id}}">
                                          <input type="number" value="{{$row->morning}}" name="u_morning[]" step="1" min="0" class="sold_me_cust_class usr_litre{{$row->id}} user_mlitres user_mlitre form-control" onkeyup="milk_sum(this,{{$row->id}})" onchange="milk_sum(this,{{$row->id}},'.usr_litre','.user_total')" required>
                                          <input type="number" value="{{$row->evening}}" name="u_evening[]" step="1" min="0" class="sold_me_cust_class usr_litre{{$row->id}} user_elitres user_elitre form-control" onkeyup="milk_sum(this,{{$row->id}})" onchange="milk_sum(this,{{$row->id}},'.usr_litre','.user_total')" required>
                                          <input type="text" value="{{$row->morning + $row->evening}}" readonly class="sold_me_cust_class user_total{{$row->id}} form-control">
                                      </div>
                                  @endforeach
                                  <div class="col-md-2 my-3">
                                      <p class="my-2"><b>Total</b></p>
                                  </div>
                                  <div class="col-md-10 my-3">
                                      <input type="text" class="sold_me_cust_class form-control" id="final_um_total" readonly>
                                      <input type="text" class="sold_me_cust_class form-control" id="final_ue_total" readonly>
                                      <input type="text" class="sold_me_cust_class form-control" id="final_utotal" readonly>
                                  </div>
                                  <div class="col-md-2">
                                    <p class="my-2">U.21</p>
                                  </div>
                                  <div class="col-md-10">
                                      <input type="hidden" name="ext_type[]" value="u21">
                                      <input type="hidden" name="ext_id[]" value="{{isset($ext_collU21->id) ? $ext_collU21->id : ''}}">
                                      <input type="number" value="{{isset($ext_collU21->morning) ? $ext_collU21->morning : '0'}}" id="u21_morning" name="ext_morning[]" step="1" min="0" class="sold_me_cust_class user_mlitres form-control" required>
                                      <input type="number" value="{{isset($ext_collU21->evening) ? $ext_collU21->evening : '0'}}" id="u21_evening" name="ext_evening[]" step="1" min="0" class="sold_me_cust_class user_elitres form-control" required>
                                      <input type="text" id="u21_total" value="{{isset($ext_collU21->total_litres) ? $ext_collU21->total_litres : '0'}}" readonly class="sold_me_cust_class form-control">
                                  </div>
                                  <div class="col-md-2">
                                      <p class="my-2">Fridge</p>
                                  </div>
                                  <div class="col-md-10">
                                      <input type="hidden" name="ext_type[]" value="fridge_used">
                                      <input type="hidden" name="ext_id[]" value="{{isset($ext_collF->id) ? $ext_collF->id : ''}}">
                                      <?php $mor = isset($_GET['filter_date']) ? (isset($ext_collF->morning) ? $ext_collF->morning : '0') : (isset($ext_collF->evening) ? $ext_collF->evening : '0')  ?>
                                      <input type="number" value="{{$mor}}" id="f_morning" name="ext_morning[]" step="1" min="0" class="sold_me_cust_class user_mlitres form-control" required>
                                      <input type="number" value="{{isset($ext_collF->evening) ? $ext_collF->evening : '0'}}" id="f_evening" name="ext_evening[]" step="1" min="0" class="sold_me_cust_class user_elitres form-control" required>
                                      <input type="text" id="fu_total" value="{{isset($ext_collF->total_litres) ? $ext_collF->total_litres : '0'}}" readonly class="sold_me_cust_class form-control">
                                  </div>
                                  <div class="col-md-2">
                                      <p class="my-2">Bazaar</p>
                                  </div>
                                  <div class="col-md-10">
                                      <input type="hidden" name="ext_type[]" value="bazaar">
                                      <input type="hidden" name="ext_id[]" value="{{isset($ext_collB->id) ? $ext_collB->id : ''}}">
                                      <input type="number" value="{{isset($ext_collB->morning) ? $ext_collB->morning : '0'}}" name="ext_morning[]" id="b_morning" step="1" min="0" value="0" class="sold_me_cust_class user_mlitres form-control" required>
                                      <input type="number" value="{{isset($ext_collB->evening) ? $ext_collB->evening : '0'}}" name="ext_evening[]" id="b_evening" step="1" min="0" value="0" class="sold_me_cust_class user_elitres form-control" required>
                                      <input type="text" id="b_total" value="{{isset($ext_collB->total_litres) ? $ext_collB->total_litres : '0'}}" readonly class="sold_me_cust_class form-control">
                                  </div>
                                  
                                  <div class="col-md-2 mt-3">
                                      <p class="my-2"><b>Final Total</b></p>
                                  </div>
                                  <div class="col-md-10 mt-3">
                                      <input type="text" class="sold_me_cust_class form-control" id="final_um_gtotal" readonly>
                                      <input type="text" class="sold_me_cust_class form-control" id="final_ue_gtotal" readonly>
                                      <input type="text" class="sold_me_cust_class form-control" id="final_ugtotal" readonly>
                                  </div>
                              </div>
                          </div>
                          <div class="col-xl-7 mt-4 mt-xl-0 mt-md-4">
                              <h3 class="text-center">Customer Entry</h3>
                              <div class="row">
                                  <div class="col-md-2">
                                  </div>
                                  <div class="col-md-10">
                                      <input type="text" value="Morning" class="clabelstyle">
                                      <input type="text" value="Evening" class="clabelstyle">
                                      <input type="text" value="Total" class="clabelstyle">
                                      <input type="text" value="Rate" class="clabelstyle">
                                  </div>
                                  @foreach ($customers as $row)
                                      <div class="col-md-2">
                                          <p class="my-2">{{$row->customer_name}}</p>
                                      </div>
                                      <div class="col-md-10">
                                          <input type="hidden" name="customer_id[]" value="{{$row->id}}">
                                          <input type="number" value="{{$row->morning}}" id="c_morning" name="c_morning[]" step="1" min="0" class="sold_me_cust_class cust_mlitres cust_litre{{$row->id}} form-control" onkeyup="milk_sum(this,{{$row->id}})" onchange="milk_sum(this,{{$row->id}},'.cust_litre','.cust_total')" required>
                                          <input type="number" value="{{$row->evening}}" id="c_evening" name="c_evening[]" step="1" min="0" class="sold_me_cust_class cust_elitres cust_litre{{$row->id}} form-control" onkeyup="milk_sum(this,{{$row->id}})" onchange="milk_sum(this,{{$row->id}},'.cust_litre','.cust_total')" required>
                                          <input type="number" value="{{$row->morning + $row->evening}}" readonly class="sold_me_cust_class cust_total{{$row->id}} form-control" required>
                                          <input type="number" value="{{$row->milk_rate}}" name="milk_rate[]" step="1" min="0" class="sold_me_cust_class form-control" required>
                                      </div>
                                  @endforeach
                                  <div class="col-md-2 mt-3">
                                      <p class="my-2"><b>Total</b></p>
                                  </div>
                                  <div class="col-md-10 mt-3">
                                      <input type="text" class="sold_me_cust_class form-control" id="final_cm_total" name="final_cm_total" readonly>
                                      <input type="text" class="sold_me_cust_class form-control" id="final_ce_total" name="final_ce_total" readonly>
                                      <input type="text" class="sold_me_cust_class form-control" id="final_ctotal" name="final_ctotal" readonly>
                                  </div>
                                  <div class="col-md-2 mt-3">
                                      <p class="my-2"><b>Fridge</b></p>
                                  </div>
                                  <div class="col-md-10 mt-3">
                                      <input type="hidden" name="ext_type[]" value="fridge_stock">
                                      <input type="hidden" name="ext_id[]" value="{{isset($ext_collFS->id) ? $ext_collFS->id : ''}}">
                                      <input type="text" name="ext_morning[]" class="sold_me_cust_class form-control" id="frm_total" readonly>
                                      <input type="text" name="ext_evening[]" class="sold_me_cust_class form-control" id="fre_total" readonly>
                                      <input type="text" name="frc_total" class="sold_me_cust_class form-control" id="frc_total" readonly>
                                  </div>
                                  <div class="col-md-2 mt-3">
                                      <p class="my-2"><b>Final Total</b></p>
                                  </div>
                                  <div class="col-md-10 mt-3">
                                      <input type="text" class="sold_me_cust_class form-control" id="final_cm_gtotal" readonly>
                                      <input type="text" class="sold_me_cust_class form-control" id="final_ce_gtotal" readonly>
                                      <input type="text" class="sold_me_cust_class form-control" id="final_cgtotal" readonly>
                                  </div>
                              </div>
                          </div>
                      </div>
                      {{-- <div class="row mt-3">
                          <div class="col-md-3">
                              <div class="form-group">
                                  <label>Total</label>
                                  <input type="text" class="form-control" id="get_allme_values">
                              </div>                            
                          </div>
                      </div>--}}
              </div>
              <div class="card-footer">
                  <button type="submit" class="btn btn-info btn-round">Submit</button>
                  <a href="{{config('app.url')}}/milk_entries" class="btn btn-danger btn-round ml-2">Cancel</a>
              </div>
          </form>
      </div>
  </div>
</div>

<div class="row">
  <div class="col-md-12 mx-auto">
    <div class="card">
      <div class="card-body ">
        <ul class="nav nav-pills nav-pills-primary nav-pills-icons justify-content-center" role="tablist">    
          <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#sold" role="tablist">
              <i class="now-ui-icons shopping_shop"></i>
              Milk Sold
            </a>
          </li> 
          <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#internal" role="tablist">
              <i class="now-ui-icons shopping_shop"></i>
              Internal Collection
            </a>
          </li>      
          <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#external" role="tablist">
              <i class="now-ui-icons shopping_shop"></i>
              External Collection
            </a>
          </li>
        </ul>

        <div class="tab-content tab-space tab-subcategories">  
          
          <div class="tab-pane active" id="sold">
            <div class="card">
              {{-- <div class="card-header">
                @can('all-access')
                  <a href="{{route('milk_entries.create')}}" class="btn btn-primary">Add Data</a>            
                @endcan
              </div> --}}
              <div class="card-body">
                <table id="group5dt" class="table table-striped table-bordered" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th>Sr.No</th>
                      <th>Customer Name</th>
                      <!-- {{-- <th>Customer Type</th> --}} -->
                      <th>Rate</th>
                      <th>Morning</th>
                      <th>Evening</th>
                      <th>Sold Date</th>
                      <th>Total Litres</th>
                      <!-- {{-- <th>Amount Paid</th> --}}
                      {{-- <th>Pending Amount</th>                   --}} -->
                      <th>Total Amount</th>
                      <!-- {{-- @can('all-access')
                        <th class="disabled-sorting text-right">Actions</th>
                      @endcan --}} -->
                    </tr>
                  </thead>
                   <tbody>
                    @foreach($soldsdata as $row)
                      <tr>
                        <td>{{$row->id}}</td>                  
                        <td>{{$row->customer_name}}</td>
                        <!-- {{-- <td>{{$row->type}}</td> --}} -->
                        <td>{{$row->milk_rate}}</td>
                        <td>{{$row->morning}}</td>
                        <td>{{$row->evening}}</td>
                        <td>{{ date('M j Y',strtotime($row->sold_date)) }}</td>                  
                        <td>{{$row->total_litres}}</td>
                        <!-- {{-- <td>{{$row->amount_paid ? $row->amount_paid : 0}}</td> --}}
                        {{-- <td>{{$row->pending_amount ? $row->pending_amount : 0}}</td> --}} -->
                        <td>{{$row->total_amount ? $row->total_amount : '-'}}</td>
                        <!-- {{-- <td class="text-right">      
                          <a href="{{route('milk_entries.edit', $row->id)}}" class="btn btn-sm btn-warning edit"><i class="fa fa-edit"></i></a>                    
                        </td> --}} -->
                      </tr>
                    @endforeach
                  </tbody>        
                </table>
              </div>
            </div>        
          </div>

          <div class="tab-pane" id="internal">
            <div class="card">
              <div class="card-body">
                <table id="datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th>Sr.No</th>
                      <th>Collection Date</th>
                      <th>Morning</th>
                      <th>Evening</th>
                      <th>Total</th>
                      {{-- <th>Given</th> --}}
                      {{-- <th>GivenReturn</th> --}}
                      {{-- <th>Taken</th>  --}}
                      {{-- <th>TakenReturn</th> --}}
                      {{-- <th>Final Total</th> --}}
                      {{-- @can("all-access")
                        <th>Action</th>
                      @endcan --}}
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($icollections as $row)
                      <tr>
                        <td>{{$row->id}}</td>                  
                        <td>{{$row->collection_date}}</td>
                        <td>{{$row->morning}}</td>
                        <td>{{$row->evening}}</td>         
                        <td>{{$row->total_litres}}</td>
                      </tr>
                    @endforeach
                  </tbody>    
                </table>
              </div>
            </div>        

            <div class="modal fade" id="collection-modal">
              <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <form action="{{route('milk_collection.store')}}" accept="" role="form" method="post" id="edit_milk_collection_form">
                    @csrf
                    <div class="modal-body">
                      <span class="text-danger">
                        Note: Calculate Grand Total Manually After editing Given, GivenReturn, Taken, TakenReturn
                      </span>
                        <div class="row">
                          <div class="col-md-12">
                            <div class="form-group">
                              <label>Collection Date</label>
                              <input type="text" id="collection_date" name="collection_date" class="form-control" placeholder="Enter ..." readonly>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label>Morning</label>
                              <input type="text" name="morning" id="morning" class="form-control" placeholder="Enter ..." readonly>                      
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label>Evening</label>
                              <input type="text" name="evening" id="evening" class="form-control" placeholder="Enter ..." readonly>                      
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label>Given</label>
                              <input type="text" name="given" id="given" class="form-control" placeholder="Enter ...">                      
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label>GivenReturn</label>
                              <input type="text" name="givenreturn" id="givenreturn" class="form-control" placeholder="Enter ...">                      
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label>Taken</label>
                              <input type="text" name="taken" id="taken" class="form-control" placeholder="Enter ...">                      
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label>TakenReturn</label>
                              <input type="text" name="takenreturn" id="takenreturn" class="form-control" placeholder="Enter ...">                      
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label>Total Litres</label>
                              <input type="text" name="total_litres" id="total_litres" class="form-control" placeholder="Enter ...">                      
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label>Grand Total</label>
                              <input type="text" name="grand_total" id="grand_total" class="form-control" placeholder="Enter ...">                      
                            </div>
                          </div>
                        </div>                        				            
                    </div>
                    <div class="modal-footer">
                      <input type="hidden" name="hidden_collection_id" id="hidden_collection_id">
                      <input type="submit" class="btn btn-info btn-round pull-left" id="insert" value="Update">
                      <a href="{{config('app.url')}}" class="btn btn-danger btn-round">Cancel</a>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>

          <div class="tab-pane" id="external">
              <div class="card">
               {{--  <div class="card-header">            
                @can('all-access')
                    <a href="{{route('milk_collection.create')}}" class="btn btn-primary">Add External Collection</a>            
                @endcan
                </div> --}}
                <div class="card-body">
                <table id="datatable1" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>Sr.No</th>
                        <th>Date</th>
                        <th>Collection Type</th>
                        {{-- <th>Party Name</th> --}}
                        <th>Morning</th>
                        <th>Evening</th>
                        <th>Total</th>
                        {{-- <th>Rate</th> --}}
                        {{-- <th>Total Amount</th> --}}
                        {{-- <th>Cash</th> --}}
                        {{-- @can("all-access")          
                        <th class="disabled-sorting text-right">Actions</th>
                        @endcan --}}
                    </tr>
                    </thead>       
                    <tbody>
                      @foreach($ecollections as $row)
                        <tr>
                          <td>{{$row->id}}</td>                  
                          <td>{{$row->date}}</td>
                          <td>{{$row->type}}</td>
                          <td>{{$row->morning}}</td>         
                          <td>{{$row->evening}}</td>         
                          <td>{{$row->total_litres}}</td>
                        </tr>
                      @endforeach
                    </tbody>           
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

@section('milk_scripts')
    <script type="text/javascript">
       /*  function total_collection() {
            var me_data = [];
            $(".getme_data").each(function() {
                me_data.push(Number($(this).val()));
            })
            var set_allme_values = me_data.reduce((total, values) => total + values, 0);
            $("#get_allme_values").val(set_allme_values);
        }
        total_collection();

        $(document).on('keyup change', '.getme_data', function() {
            total_collection();
        }) */
                       
        function milk_sum(e,id,cls,tid) {
            var userarr = [];
            $(cls+id).each(function() {
                userarr.push(Number($(this).val()));
            })
            var usr_total = userarr.reduce((total, values) => total + values, 0);
            $(tid+id).val(usr_total);
        }
        
        function METotal(clas,tcls) {
            var data = [];
            $(clas).each(function() {
                data.push(Number($(this).val()));
            })
            var final_values = data.reduce((total, values) => total + values, 0);
            $(tcls).val(final_values);
            totlCalc();
            calcFridgeTotal();
            totalValidation();
        }

        // For User Morning Total
        METotal(".user_mlitre","#final_um_total")
        $(document).on('keyup change', '.user_mlitre', function() {
            METotal(".user_mlitre","#final_um_total")            
        })

        // For User Evening Total
        METotal(".user_elitre","#final_ue_total")
        $(document).on('keyup change', '.user_elitre', function() {
            METotal(".user_elitre","#final_ue_total")
        })

        // For User Morning Final Total
        METotal(".user_mlitres","#final_um_gtotal")
        $(document).on('keyup change', '.user_mlitres', function() {
            METotal(".user_mlitres","#final_um_gtotal")            
        })

        // For User Evening Final Total
        METotal(".user_elitres","#final_ue_gtotal")
        $(document).on('keyup change', '.user_elitres', function() {
            METotal(".user_elitres","#final_ue_gtotal")
        })

        // For Customer Morning Total
        METotal(".cust_mlitres","#final_cm_total")
        $(document).on('keyup change', '.cust_mlitres', function() {
            METotal(".cust_mlitres","#final_cm_total")            
        })

        // For Customer Evening Total
        METotal(".cust_elitres","#final_ce_total")
        $(document).on('keyup change', '.cust_elitres', function() {
            METotal(".cust_elitres","#final_ce_total")
        })

        // For Customer Morning Final Total
        METotal(".cust_mlitres","#final_cm_gtotal")
        $(document).on('keyup change', '.cust_mlitres', function() {
            METotal(".cust_mlitres","#final_cm_gtotal")            
        })

        // For Customer Evening Final Total
        METotal(".cust_elitres","#final_ce_gtotal")
        $(document).on('keyup change', '.cust_elitres', function() {
            METotal(".cust_elitres","#final_ce_gtotal")
        })
        
        $(document).on('keyup change', '#u21_morning,#u21_evening', function() {
            $("#u21_total").val(parseInt($("#u21_morning").val()) + parseInt($("#u21_evening").val()))
        })

        $(document).on('keyup change', '#f_morning,#f_evening', function() {
            $("#fu_total").val(parseInt($("#f_morning").val()) + parseInt($("#f_evening").val()))
        })
        
        // $("#b_total").val(parseInt($("#b_morning").val()) + parseInt($("#b_evening").val()))
        $(document).on('keyup change', '#b_morning,#b_evening', function() {
            $("#b_total").val(parseInt($("#b_morning").val()) + parseInt($("#b_evening").val()))
        })

       
        totlCalc();
        function totlCalc() {
            $("#final_utotal").val(parseInt($("#final_um_total").val()) + parseInt($("#final_ue_total").val()))
            $("#final_ugtotal").val(parseInt($("#final_um_gtotal").val()) + parseInt($("#final_ue_gtotal").val()))
            $("#final_ctotal").val(parseInt($("#final_cm_total").val()) + parseInt($("#final_ce_total").val()))
            $("#final_cm_gtotal").val(parseInt($("#final_cm_total").val()) + parseInt($("#frm_total").val()))
            $("#final_ce_gtotal").val(parseInt($("#final_ce_total").val()) + parseInt($("#fre_total").val()))
            $("#final_cgtotal").val(parseInt($("#final_ctotal").val()) + parseInt($("#frc_total").val()))
        }

        calcFridgeTotal();
        function calcFridgeTotal() {
            $("#frm_total").val(parseInt($("#final_um_gtotal").val()) - parseInt($("#final_cm_total").val()))
            $("#fre_total").val(parseInt($("#final_ue_gtotal").val()) - parseInt($("#final_ce_total").val()))
            $("#frc_total").val(parseInt($("#final_ugtotal").val()) - parseInt($("#final_ctotal").val()))
        }

        // check for Total Validation
        function totalValidation() {
            var final_um_gtotal = parseInt($("#final_um_gtotal").val());
            var final_ue_gtotal = parseInt($("#final_ue_gtotal").val());
            var final_ugtotal = parseInt($("#final_ugtotal").val());

            var final_cm_total = parseInt($("#final_cm_total").val());
            var final_ce_total = parseInt($("#final_ce_total").val());
            var final_ctotal = parseInt($("#final_ctotal").val());
            
            if((final_cm_total > final_um_gtotal) || (final_ce_total > final_ue_gtotal) || (final_ctotal > final_ugtotal)) {
                // alert('Sold Total Cannot be Greater than Collection Total');                
                return false;
            }
        }
        
              
    </script>
@endsection