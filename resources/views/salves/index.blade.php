@extends('layouts.app')

@section('title', 'Salves')

@section('content')

<div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">            
          @can('all-access')
            <a href="{{route('salves.create')}}" class="btn btn-primary">Add Salves</a>
          @endcan
        </div>
        <div class="card-body">
          <?php $count=1 ?>
        {{-- @if(count($salves) > 0) --}}
          <table id="datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th>Sr.No</th>
                <th>Location</th>         
                <th>Description</th>       
                <th>Salves Name</th>
                <th>Contact Person</th>
                <th>Mobile No.</th>
                @can('all-access')
                  <th class="disabled-sorting text-right">Actions</th>
                @endcan
              </tr>
            </thead>
            <tbody>
              @foreach($salves as $salve)
                <tr>
                  <td>{{$count}}</td>
                  <td>{{ucfirst($salve->location)}}</td>
                  <td>{{$salve->description}}</td>
                  <td>{{ucfirst($salve->salve_name)}}</td>
                  <td>{{$salve->contact_person}}</td>
                  <td>{{$salve->mobile_no}}</td>
                  <td class="text-right">
                    {{-- {!! Form::open(['action' => ['App\Http\Controllers\Salve\SalveController@destroy', $salve->id] , 'method' => 'POST', 'style' => 'display:inline']) !!}
                      {{Form::hidden ('_method','DELETE')}}
                      {{Form::submit('X', ['class' => 'btn btn-sm btn-danger'])}}
                    {!! Form::close() !!} --}}
                    @can('all-access')
                      <a id="{{$salve->id}}" class="btn btn-sm btn-danger delete_all" url="salve"><i class="fa fa-times"></i></a>                    
                      <a href="{{route('salves.edit', $salve->id)}}" class="btn btn-sm btn-warning edit"><i class="fa fa-edit"></i></a>                    
                    @endcan
                  </td>
                </tr>  
                <?php $count++ ?>            
              @endforeach
            </tbody>
          </table>
          {{-- @endif --}}
        </div><!-- end content-->
      </div><!--  end card  -->
    
    </div> <!-- end col-md-12 -->
  </div> <!-- end row -->

@endsection