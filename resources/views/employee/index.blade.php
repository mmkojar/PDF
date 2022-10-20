@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">        
          @can('all-access')    
            <a href="{{route('employee.create')}}" class="btn btn-primary">Add Employee</a>
          @endcan
        </div>
        <div class="card-body">
          <?php $count=1 ?>
          <table id="datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th>Sr.No</th>
                <th>Name</th>
                <th>Mobile No.</th>
                <th>Location</th>                
                <th>Salary</th>
                <th>Status</th>
                @can('all-access')
                  <th class="disabled-sorting text-right">Actions</th>
                @endcan
              </tr>
            </thead>
            <tbody>
              @foreach($employee as $row)
                <tr>
                  <td>{{$count}}</td>
                  <td>{{ucfirst($row->name)}}</td>
                  <td>{{ucfirst($row->mobile_no)}}</td>
                  <td>{{$row->location ? $row->location : '-'}}</td>                  
                  <td>{{$row->salary}}</td>
                  <td class="{{($row->status === 'active' ? 'font-weight-bold text-success' : 'font-weight-bold text-danger') }}">{{ucfirst($row->status ? $row->status : '-')}}</td>
                  @can('all-access')
                  <td class="text-right">                   
                      <a id="{{$row->id}}" class="btn btn-sm btn-danger delete_all" url="employee"><i class="fa fa-times"></i></a>                    
                      <a href="{{route('employee.edit', $row->id)}}" class="btn btn-sm btn-warning edit"><i class="fa fa-edit"></i></a>
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