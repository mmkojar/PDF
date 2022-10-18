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
                <div class="row">
                    @foreach ($emps as $res)                        
                        
                        <div class="col-md-6">
                            <h4>{{$res->name}}</h4>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Full Day</label>
                                <input type="radio" name="select_entry[{{$res->id}}]" class="select_entry" value="1">
                            </div>
                            <div class="form-group">
                                <label>Half Day</label>
                                <input type="radio" name="select_entry[{{$res->id}}]" class="select_entry" value="0.5">
                            </div>
                            <div class="form-group">
                                <label>Absent</label>
                                <input type="radio" name="select_entry[{{$res->id}}]" class="select_entry" value="0">
                            </div>
                        </div>
                    @endforeach
                </div>
        </div><!-- end content-->
      </div><!--  end card  -->
    
    </div> <!-- end col-md-12 -->
  </div> <!-- end row -->

@endsection