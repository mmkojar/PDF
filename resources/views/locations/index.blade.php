@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          @can('all-access')          
          <a data-toggle="modal" id="show-insert-modal" class="text-white btn btn-primary">Add Locations</a>
          @endcan
        </div>
        <div class="card-body">
          <?php $count=1 ?>
          <table id="datatable" class="table table-striped table-bordered show-insert-modal" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th>Sr.No</th>
                <th>Location Name</th>            
                <th>Status</th>
                @can('all-access')
                <th class="disabled-sorting text-right">Actions</th>
                @endcan
              </tr>
            </thead>
            <tbody>
              @foreach($locations as $location)
                <tr>
                  <td>{{$count}}</td>
                  <td>{{ucfirst($location->name)}}</td>
                  <td>{{ucfirst($location->status)}}</td>
                  @can('all-access')
                  <td class="text-right">
                    {{-- {!! Form::open(['action' => ['App\Http\Controllers\Location\Khilla_location@destroy', $location] , 'method' => 'POST', 'style' => 'display:inline']) !!}
                      {{Form::hidden ('_method','DELETE')}}
                      {{Form::submit('X', ['class' => 'btn btn-sm btn-danger'])}}
                    {!! Form::close() !!} --}}                    
                    <a id="{{$location->id}}" class="btn btn-sm btn-danger delete_all" url="location"><i class="fa fa-times"></i></a>                    
                    <a id="{{$location->id}}" class="btn btn-sm btn-warning edit_location"><i class="fa fa-edit"></i></a>                                       
                  </td>
                  @endcan
                </tr>         
                <?php $count++ ?>
              @endforeach
            </tbody>
          </table>
        </div><!-- end content-->
      </div><!--  end card  -->      
      <!-- Modal -->
        <div class="modal fade" id="modal-default">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Location</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form action="{{route('location.store')}}" method="post" accept="" role="form" id="add_location_form">
                @csrf
                <div class="modal-body">
                    <div class="box-body">
                      <div class="form-group">
                        <label>location Name</label>
                        <input type="text" id="name" name="name" class="form-control check_unq_name" tb-name="locations" tb-col="name" placeholder="Enter ..." required>
                        <span class="error-unq-name text-danger"></span>
                      </div>
                      <div class="form-group" id="show_status">
                        <label>Status</label>
                        <select class="form-control" name="status" id="status">
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                      </div>	                                                             
                    </div>					            
                </div>
                <div class="modal-footer">
                  <input type="submit" id="insert" class="btn btn-info btn-round pull-left disable_on_unq_name" value="">
                  <input type="hidden" name="hidden_loc_id" id="hidden_loc_id">
                  <a href="{{config('app.url')}}/location" class="btn btn-danger btn-round">Cancel</a>
                </div>
              </form>
            </div>
          </div>
        </div>

    </div> <!-- end col-md-12 -->
  </div> <!-- end row -->

@endsection