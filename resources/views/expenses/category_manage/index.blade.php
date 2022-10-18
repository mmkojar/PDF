@extends('layouts.app')


@section('content')

<div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
          <ul class="nav nav-pills nav-pills-primary nav-pills-icons justify-content-center" role="tablist">    
            <li class="nav-item">
              <a class="nav-link active" data-toggle="tab" href="#manage_cat" role="tablist">
                <i class="now-ui-icons shopping_shop"></i>
                Manage Category
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="tab" href="#amount_paid" role="tablist">
                <i class="now-ui-icons shopping_shop"></i>
                Amount Paid
              </a>
            </li>
          </ul>
          <div class="tab-content tab-space tab-subcategories">
            <div class="tab-pane active" id="manage_cat">
              <div class="card">
                <div class="card-header">       
                  @can('all-access')     
                    <a href="{{route('category_management.create')}}" class="btn btn-primary">Add</a>
                  @endcan
                </div>
                <div class="card-body">
                    <?php $count=1 ?>
                    <table id="cat_manage_table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th>Sr.No</th>
                          <th>Category Name</th>
                          <th>Total Amount</th>
                          <th>Quantity</th>
                          <th>Month</th>
                          <th>Party Name</th>
                          <th>Date</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($category_manage as $data)
                          <tr>
                            <td>{{$count}}</td>
                            <td>{{$data->category_name}}</td>
                            <td>{{$data->amount}}</td>
                            <td>{{$data->quantity}}</td>
                            <td>{{$data->month}} <p style="float:right">Total Amount:({{$data->total_amount_by_month}}) Amount Paid:({{$data->total_amount_paid_by_month}})  Pending Amount({{$data->total_amount_by_month - $data->total_amount_paid_by_month}})</p></td>
                            <td>{{ucfirst($data->party_name)}} <p style="float:right">Total Amount:({{$data->total_amount_by_customer}})</p></td>
                            <td>{{date('M j Y',strtotime($data->date))}}</td>
                            {{-- @can('all-access')    --}}
                           {{--  <td>                              
                              <a href="{{route('food.edit', $food->id)}}" class="btn btn-sm btn-warning edit"><i class="fa fa-edit"></i></a>                    
                            </td> --}}
                            {{-- @endcan --}}
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
                  @if(count($category_manage) > 0)
                    @can('all-access')
                      <a href="{{route('cat_manage.amount.create')}}" class="btn btn-primary">Add</a>
                    @endcan
                  @endif
                </div>
                <div class="card-body">
                    <?php $count=1 ?>
                    <table id="category_amount_table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th>Sr.No</th>                 
                          <th>Description</th>
                          <th>Amount Paid</th>                          
                          <th>Month</th>
                          <th>Date</th>                          
                          <th>Party Name</th>
                          {{-- <th class="disabled-sorting text-right">Actions</th> --}}
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($category_manage_amount as $data)
                          <tr>
                            <td>{{$count}}</td>                     
                            <td>{{$data->description}}</td>
                            <td>{{$data->amount_paid}}</td>                        
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