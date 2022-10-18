@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">            
            <a href="{{route('salve.transfer.create')}}" class="btn btn-primary">Add Data</a>
        </div>
        <div class="card-body">
          <?php $count=1 ?>
        @if(count($transfers) > 0)
          <table id="datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th>Sr.No</th>                
                <th>Product Name</th>
                <th>Product No.</th>
                <th>Location</th>                
                <th>Salve Name</th>
                <th>Date</th>
                <th class="disabled-sorting text-right">Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach($transfers as $transfer)
                <tr>
                  <td>{{$count}}</td>                  
                  <td>{{$transfer->product_name}}</td>
                  <td>{{$transfer->product_name}} {{$transfer->product_stock_id}}</td>
                  <td>{{$transfer->location}}</td>
                  <td>{{$transfer->salve_name}}</td>
                  <td>{{$transfer->date}}</td>
                  <td class="text-right">
                    {{-- {!! Form::open(['action' => ['App\Http\Controllers\Salve\SalveController@delete_transfer', $transfer->id] , 'method' => 'POST', 'style' => 'display:inline']) !!}
                      {{Form::hidden ('_method','DELETE')}}
                      {{Form::submit('X', ['class' => 'btn btn-sm btn-danger'])}}
                    {!! Form::close() !!} --}}
                    <a id="{{$transfer->id}}" class="btn btn-sm btn-danger delete_all" url="salve/transfer"><i class="fa fa-times"></i></a>                    
                    <a href="{{route('salve.transfer.edit', $transfer->id)}}" class="btn btn-sm btn-warning edit"><i class="fa fa-edit"></i></a>                    
                  </td>
                </tr>  
                <?php $count++ ?>            
              @endforeach
              
            </tbody>
          </table>
          @endif
        </div><!-- end content-->
      </div><!--  end card  -->
    
    </div> <!-- end col-md-12 -->
  </div> <!-- end row -->

@endsection