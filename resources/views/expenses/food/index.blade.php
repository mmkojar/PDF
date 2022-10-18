@extends('layouts.app')


@section('content')

<div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
          <ul class="nav nav-pills nav-pills-primary nav-pills-icons justify-content-center" role="tablist">    
            <li class="nav-item">
              <a class="nav-link active" data-toggle="tab" href="#total_stock" role="tablist">
                <i class="now-ui-icons shopping_shop"></i>
                Total Food Collection
              </a>
            </li>      
            <li class="nav-item">
              <a class="nav-link" data-toggle="tab" href="#stock_use" role="tablist">
                <i class="now-ui-icons shopping_shop"></i>
                Food Used
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="tab" href="#amount_paid" role="tablist">
                <i class="now-ui-icons shopping_shop"></i>
                Food Amount
              </a>
            </li>
          </ul>
          <div class="tab-content tab-space tab-subcategories">
            <div class="tab-pane active" id="total_stock">
              <div class="card">
                <div class="card-header">       
                  @can('all-access')     
                    <a href="{{route('food.create')}}" class="btn btn-primary">Add</a>
                  @endcan
                </div>
                <div class="card-body">
                    <?php $count=1 ?>
                    <table id="total_food_table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th>Sr.No</th>
                          <th>Item Name</th>
                          <th>Total Amount</th>
                          {{-- <th>Amount Paid</th> --}}
                          {{-- <th>Pending Amount</th> --}}
                          <th>Quantity Balance</th>
                          <th>Total Quantity</th>                          
                          <th>Month</th>
                          <th>Party Name</th>
                          <th>Date</th>
                          {{-- @can('all-access')     
                          <th class="disabled-sorting text-right">Actions</th>
                          @endcan --}}
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($foods as $food)
                          <tr>
                            <td>{{$count}}</td>
                            <td>{{$food->item_name}}</td>
                            <td>{{$food->amount}}</td>
                            {{-- <td>{{$food->amount_paid ? $food->amount_paid : 0}}</td> --}}
                            {{-- <td>{{$food->amount - $food->amount_paid}}</td> --}}
                            <td>{{$food->quantity}}</td>
                            <td>{{$food->total_quantity}}</td>
                            <td>{{$food->month}} <p style="float:right">Total Amount:({{$food->total_amount_by_month}}) Amount Paid:({{$food->total_amount_paid_by_month}})  Pending Amount({{$food->total_amount_by_month - $food->total_amount_paid_by_month}})</p></td>
                            <td>{{ucfirst($food->party_name)}} <p style="float:right">Total Amount:({{$food->total_amount_by_customer}})</p></td>
                            {{-- <td>{{$food->month}} Total Amount:({{$food->total_amount_by_month}}) Amount Paid:({{$food->total_amount_paid_by_month}})  Pending Amount({{$food->total_amount_by_month - $food->total_amount_paid_by_month}})</td> --}}
                            {{-- <td>{{ucfirst($food->party_name)}} Total Amount:({{$food->total_amount_by_customer}})</td> --}}
                            <td>{{date('M j Y',strtotime($food->date))}}</td>
                            @can('all-access')   
                           {{--  <td>                              
                              <a href="{{route('food.edit', $food->id)}}" class="btn btn-sm btn-warning edit"><i class="fa fa-edit"></i></a>                    
                            </td> --}}
                            @endcan
                          </tr>
                          <?php $count++ ?>
                        @endforeach
                      </tbody>
                    </table>
                </div>
              </div>
            </div>

            <div class="tab-pane" id="stock_use">
              <div class="card">
                <div class="card-header">
                  @if(count($foods) > 0)
                    @can('all-access')
                      <a href="{{route('food.stock.create')}}" class="btn btn-primary">Add</a>
                    @endcan
                  @endif
                </div>
                <div class="card-body">
                    <?php $count=1 ?>
                    <table id="datatable1" class="table table-striped table-bordered" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th>Sr.No</th>
                          <th>Item Name</th>
                          <th>Quantity</th>
                          <th>Date</th>
                          {{-- @can('all-access')   
                          <th class="disabled-sorting text-right">Actions</th>
                          @endcan --}}
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($stock_use as $stock)
                          <tr>
                            <td>{{$count}}</td>
                            <td>{{$stock->item_name}}</td>        
                            <td>{{$stock->quantity}}</td>
                            <td>{{date('M j Y',strtotime($stock->date))}}</td>
                            @can('all-access')   
                            {{-- <td>
                              <a id="{{$stock->id}}" class="btn btn-sm btn-danger delete_all" url="food/stockUse"><i class="fa fa-times"></i></a>                    
                              <a href="{{route('food.stock.edit', $stock->id)}}" class="btn btn-sm btn-warning edit"><i class="fa fa-edit"></i></a>                    
                            </td> --}}
                            @endcan
                          </tr>
                          <?php $count++ ?>
                        @endforeach
                      </tbody>
                    </table>
                </div>
              </div>
            </div>

            <div class="tab-pane" id="amount_paid">
              <div class="card">
                <div class="card-header">
                  @if(count($foods) > 0)
                    @can('all-access')
                      <a href="{{route('food.amountpaid.create')}}" class="btn btn-primary">Add</a>
                    @endcan
                  @endif
                </div>
                <div class="card-body">
                    <?php $count=1 ?>
                    <table id="food_amount_table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th>Sr.No</th>                          
                          {{-- <th>Item Name</th> --}}
                          <th>Description</th>
                          <th>Amount Paid</th>                          
                          <th>Month</th>
                          <th>Date</th>                          
                          <th>Party Name</th>
                          {{-- <th class="disabled-sorting text-right">Actions</th> --}}
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($food_amount as $data)
                          <tr>
                            <td>{{$count}}</td>                          
                            {{-- <td>{{$data->item_name}}</td> --}}
                            <td>{{$data->description}}</td>
                            <td>{{$data->amount_paid}}</td>
                            {{-- <td>{{$data->taken_date}}</td> --}}                            
                            <td>{{$data->month}}</td>
                            <td>{{date('M j Y',strtotime($data->date))}}</td>
                            <td>{{ucfirst($data->party_name)}}</td>                          
                            {{-- <td> --}}
                              {{-- <a id="{{$data->id}}" class="btn btn-sm btn-danger delete_all" url="food/amount"><i class="fa fa-times"></i></a>                     --}}
                              {{-- <a href="{{route('food.amountpaid.edit', $data->id)}}" class="btn btn-sm btn-warning edit"><i class="fa fa-edit"></i></a>                     --}}
                            {{-- </td> --}}
                          </tr>
                          <?php $count++ ?>
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