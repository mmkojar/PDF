@extends('layouts.app')


@section('content')

<div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">         
          @can('all-access')   
            <a href="{{route('medical.create')}}" class="btn btn-primary">Add Medical Stock</a>
          @endcan
        </div>
        <div class="card-body">
          <?php $count=1 ?>
          <table id="datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th>Sr.No</th>
                <th>Description</th>
                <th>Buy From</th>
                <th>Units</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Amount</th>
                <th>Date</th>
                @can('all-access')   
                <th class="disabled-sorting text-right">Actions</th>
                @endcan
              </tr>
            </thead>
            <tbody>
              @foreach($medicals as $medical)
                <tr>
                  <td>{{$count}}</td>
                  <td>{{$medical->description}}</td>
                  <td>{{$medical->buy_from}}</td>
                  <td>{{$medical->units}}</td>                  
                  @if($medical->units == 'units')
                    <td>{{$medical->quantity.' Units'}}</td>
                  @endif
                  @if($medical->units == 'litres')
                    <td>{{$medical->quantity.' litres'}}</td>
                  @endif
                  @if($medical->units == 'boxes')
                    <td>{{$medical->quantity.' boxes'}}</td>
                  @endif                  
                  <td>{{$medical->price}}</td>
                  <td>{{$medical->amount}}</td>
                  <td>{{$medical->date}}</td>
                  @can('all-access')   
                  <td>
                    {{-- {!! Form::open(['action' => ['App\Http\Controllers\Expenses\MedicalController@destroy', $medical->id] , 'method' => 'POST', 'style' => 'display:inline']) !!}
                      {{Form::hidden ('_method','DELETE')}}
                      {{Form::submit('X', ['class' => 'btn btn-sm btn-danger'])}}
                    {!! Form::close() !!} --}}
                    <a id="{{$medical->id}}" class="btn btn-sm btn-danger delete_all" url="medical"><i class="fa fa-times"></i></a>
                    <a href="{{route('medical.edit', $medical->id)}}" class="btn btn-sm btn-warning edit"><i class="fa fa-edit"></i></a>                    
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