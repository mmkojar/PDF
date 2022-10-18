@extends('layouts.app')

@section('title', 'Salves')

@section('content')

<div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">            
          @can('all-access')
            <a href="{{route('stock.items.form')}}" class="btn btn-primary">Add Items</a>
          @endcan
        </div>
        <div class="card-body">
          <?php $count=1 ?>
        {{-- @if(count($salves) > 0) --}}
          <table id="datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th>Sr.No</th>
                <th>Name</th>
                <th>Date</th>
                @can('all-access')
                  <th class="disabled-sorting text-right">Actions</th>
                @endcan
              </tr>
            </thead>
            <tbody>
              @foreach($items as $row)
                <tr>
                  <td>{{$count}}</td>
                  <td>{{ucfirst($row->name)}}</td>
                  <td>{{date('M j Y',strtotime($row->created_at))}}</td>
                  <td>                    
                    @can('all-access')
                      <a id="{{$row->id}}" class="btn btn-sm btn-danger delete_all" url="stock/items"><i class="fa fa-times"></i></a>
                      <a href="{{route('stock.items.form', $row->id)}}" class="btn btn-sm btn-warning edit"><i class="fa fa-edit"></i></a>
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