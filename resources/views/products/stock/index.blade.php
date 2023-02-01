@extends('layouts.app')

@section('title', 'Product Stock')

@section('content')

<div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">            
          @can('all-access')
            <a href="{{route('product.stock.create')}}" class="btn btn-primary">Add Stock</a>
          @endcan
        </div>
        <div class="card-body">
          <?php $count=1 ?>
          <table id="datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th>Sr.No</th>
                <th>Product Name</th>
                {{-- <th>Product No.</th>           
                <th>Location Name</th>
                <th>Khilla No.</th>--}}
                <th>Gender</th>
                <th>Purchase From</th>
                <th>Purchase Date</th>
                <th>Party Name</th>
                <th>Status</th>
                @can('all-access')
                  <th class="disabled-sorting text-right">Actions</th>
                @endcan
              </tr>
            </thead>
            <tbody>
              @foreach($stocks as $stock)
                <tr class="{{$stock->status == 'inactive' ? 'red-bgcolor' : ''}}">
                  <td>{{$count}}</td>                  
                  <td>{{ucfirst($stock->product_name)}}</td>
                  {{-- <td>{{$stock->product_no ? $stock->product_no : '-'}}</td>
                  <td>{{ucfirst($stock->lname ? $stock->lname : '-')}}</td>
                  @if($stock->khilla_no !== null)
                    <td>{{$stock->khilla_no ? $stock->khilla_no : '-'}}</td>
                    @else
                    <td>{{$stock->extra_khilla_no}}</td>
                  @endif --}}
                  <td>{{ucfirst($stock->gender)}}</td>
                  <td>{{$stock->purchase_from}}</td>
                  <td>{{date('M j Y',strtotime($stock->purchase_date))}}</td>
                  <td>{{ucfirst($stock->party_name)}}</td>
                  <td>{{ucfirst($stock->status ? $stock->status : '-')}}</td>
                  @can('all-access')
                    <td class="text-right">
                      {{-- {!! Form::open(['action' => ['App\Http\Controllers\Product\ProductController@destroy_stock', $stock->id] , 'method' => 'POST', 'style' => 'display:inline']) !!}
                        {{Form::hidden ('_method','DELETE')}}
                        {{Form::submit('X', ['class' => 'btn btn-sm btn-danger'])}}
                      {!! Form::close() !!} --}}
                        {{-- @if($stock->status == 'active') --}}
                          <a id="{{$stock->id}}" class="btn btn-sm btn-danger delete_all" url="product/stock"><i class="fa fa-times"></i></a>
                          <a href="{{route('product.stock.edit', $stock->id)}}" class="btn btn-sm btn-warning edit"><i class="fa fa-edit"></i></a>                    
                        {{-- @endif --}}
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