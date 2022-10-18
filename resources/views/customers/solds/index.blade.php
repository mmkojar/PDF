@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">            
          @can('all-access')
            <a href="{{route('milk_sold.create')}}" class="btn btn-primary">Add Data</a>
          @endcan
        </div>
        <div class="card-body">
          <?php $count=1 ?>
          <table id="datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th>Sr.No</th>
                <th>Customer Name</th>
                <th>Customer Type</th>
                <th>Rate</th>
                <th>Morning</th>
                <th>Evening</th>
                <th>Total Litres</th>
                <th>Sold Date</th> 
                <th>Amount Paid</th>
                <th>Pending Amount</th>                  
                <th>Total Amount</th>
                @can('all-access')
                <th class="disabled-sorting text-right">Actions</th>
                @endcan
              </tr>
            </thead>
            <tbody>
              @foreach($solds as $sold)
                <tr>
                  <td>{{$count}}</td>
                  <td>{{ucfirst($sold->customer_id ? $sold->rcustomer_name : $sold->normal_customer_name)}}</td>  
                  <td>{{$sold->type}}</td>
                  <td>{{$sold->milk_rate}}</td>
                  <td>{{$sold->morning ? $sold->morning : 0}}</td>
                  <td>{{$sold->evening ? $sold->evening : 0}}</td>                
                  <td>{{$sold->total_litres}}</td>
                  <td>{{date('M j Y',strtotime($sold->sold_date))}}</td>              
                  <td>{{$sold->amount_paid ? $sold->amount_paid : 0}}</td>
                  <td>{{$sold->pending_amount ? $sold->pending_amount : 0}}</td>
                  <td>{{$sold->total_amount ? $sold->total_amount : 0}}</td>        
                  @can('all-access')              
                  <td class="text-right">
                    {{-- {!! Form::open(['action' => ['App\Http\Controllers\Customer\MilkSoldController@destroy', $sold->id] , 'method' => 'POST', 'style' => 'display:inline']) !!}
                      {{Form::hidden ('_method','DELETE')}}
                      {{Form::submit('X', ['class' => 'btn btn-sm btn-danger'])}}
                    {!! Form::close() !!} --}}
                    {{-- <a id="{{$sold->id}}" class="btn btn-sm btn-danger delete_all" url="sold"><i class="fa fa-times"></i></a> --}}                    
                      <a href="{{route('milk_sold.edit', $sold->id)}}" class="btn btn-sm btn-warning edit"><i class="fa fa-edit"></i></a>
                  </td>
                  @endcan
                </tr>
                <?php $count++ ?>
              @endforeach
            </tbody>
          </table>
        </div><!-- end content-->
      </div><!--  end card  -->
    
    </div> <!-- end col-md-12 -->
  </div> <!-- end row -->

@endsection