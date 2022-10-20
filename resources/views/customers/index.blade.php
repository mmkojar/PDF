@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">        
          @can('all-access')    
            <a href="{{route('customer.create')}}" class="btn btn-primary">Add Customer</a>
          @endcan
        </div>
        <div class="card-body">
          <?php $count=1 ?>
          <table id="datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th>Sr.No</th>
                <th>Customer Name</th>
                {{-- <th>Customer Type</th> --}}
                {{-- <th>Bill Period</th> --}}
                <th>Customer Location</th>
                <th>Description</th>
                <th>Milk Rate</th>
                <th>Morning</th>
                <th>Evening</th>
                <th>Mobile No.</th>
                <th>Email</th>
                <th>Status</th>
                @can('all-access')
                  <th class="disabled-sorting text-right">Actions</th>
                @endcan
              </tr>
            </thead>
            <tbody>
              @foreach($customers as $customer)
                <tr>
                  <td>{{$count}}</td>
                  <td>{{ucfirst($customer->customer_name)}}</td>
                  {{-- <td>{{ucfirst($customer->customer_type)}}</td> --}}
                  {{-- <td>{{ucfirst($customer->bill_period)}}</td> --}}
                  <td>{{ucfirst($customer->customer_location)}}</td>
                  <td>{{$customer->description ? $customer->description : '-'}}</td>
                  <td>{{$customer->milk_rate}}</td>
                  <td>{{$customer->morning}}</td>
                  <td>{{$customer->evening}}</td>
                  <td>{{$customer->mobile_no}}</td>
                  <td>{{$customer->email ? $customer->email : '-'}}</td>
                  <td class="{{($customer->status === 'active' ? 'font-weight-bold text-success' : 'font-weight-bold text-danger') }}">{{ucfirst($customer->status ? $customer->status : '-')}}</td>
                  @can('all-access')
                  <td class="text-right">
                    {{-- {!! Form::open(['action' => ['App\Http\Controllers\Customer\CustomerController@destroy', $customer->id] , 'method' => 'POST', 'style' => 'display:inline']) !!}
                      {{Form::hidden ('_method','DELETE')}}
                      {{Form::submit('X', ['class' => 'btn btn-sm btn-danger'])}}
                    {!! Form::close() !!} --}}
                      <a id="{{$customer->id}}" class="btn btn-sm btn-danger delete_all" url="customer"><i class="fa fa-times"></i></a>                    
                      <a href="{{route('customer.edit', $customer->id)}}" class="btn btn-sm btn-warning edit"><i class="fa fa-edit"></i></a>
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