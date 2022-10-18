@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">          
          @can('all-access')
            <a data-toggle="modal" id="show-khilla-modal" class="text-white btn btn-primary">Add Khilla</a>
          @endcan
        </div>
        <div class="card-body">
          <?php $count=1 ?>
          <table id="datatable" class="table table-striped table-bordered show-khilla-modal" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th>Sr.No</th>
                <th>Location Name</th>  
                <th>Khilla No.</th>          
                <th>Status</th>
                <th>Available Status</th>
                @can('all-access')
                <th class="disabled-sorting text-right">Actions</th>
                @endcan
              </tr>
            </thead>
            <tbody>
              @foreach($khillas as $khilla)
                <tr>
                  <td>{{$count}}</td>
                  <td>{{ucfirst($khilla->lname)}}</td>
                  <td>{{$khilla->khilla_no ? $khilla->khilla_no : '-'}}</td>
                  <td>{{ucfirst($khilla->status)}}</td>
                  <td class="font-weight-bold {{($khilla->status2 == 'free' ? 'text-success' : 'text-danger')}}">{{ucfirst($khilla->status2)}}</td>
                  @can('all-access')
                  <td class="text-right">
                    {{-- {!! Form::open(['action' => ['App\Http\Controllers\Location\Khilla_location@destroy_khilla', $khilla->id] , 'method' => 'POST', 'style' => 'display:inline']) !!}
                      {{Form::hidden ('_method','DELETE')}}
                      {{Form::submit('X', ['class' => 'btn btn-sm btn-danger'])}}
                    {!! Form::close() !!} --}}
                    <a id="{{$khilla->id}}" class="btn btn-sm btn-danger delete_all" url="location/khilla"><i class="fa fa-times"></i></a>                    
                    <a id="{{$khilla->id}}" class="btn btn-sm btn-warning edit_khilla"><i class="fa fa-edit"></i></a>                                        
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
        <div class="modal fade" id="modal-default1">
          <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Khilla</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form action="{{route('location.khilla.store')}}" method="post" accept="" role="form">
                @csrf
                <div class="modal-body">
                    <div class="box-body">
                      <div class="form-group">
                        <label>location Name</label>
                        <select class="form-control" name="location_id" id="location_id" required>
                            <option value="" selected disabled>--select--</option>
                            @foreach($locations as $location)
                                <option value="{{$location->id}}">{{$location->name}}</option>
                            @endforeach
                        </select>
                      </div>
                      <div class="form-group show_on_edit">
                        <label id="edit_khilla_label">Khilla</label>
                        <input type="number" id="khilla_no" name="khilla_no" class="form-control" placeholder="Enter ...">						
                          <span id="check_no" class="text-danger"></span>
                      </div>
                      <div class="show_on_add">
                          <div class="btn btn-sm btn-primary add_row_icon"><i class="fa fa-plus"></i></div>							
                      </div>
                      <div class="form-group show_on_add">
                          <div class="row" id="show_textboxes">
                          </div>
                      </div>
                      <div class="form-group show_on_edit">
                        <label>Status</label>
                        <select class="form-control" name="status" id="status">
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                      </div>	                                                             
                    </div>					            
                </div>
                <div class="modal-footer">
                  <input type="submit" id="insert" class="btn btn-info btn-round pull-left insert_khilla" value="">
                  <input type="hidden" name="hidden_khilla_id" id="hidden_khilla_id">
                  <a href="{{config('app.url')}}/khilla" class="btn btn-danger btn-round">Cancel</a>
                </div>
              </form>
            </div>
          </div>
        </div>

    </div> <!-- end col-md-12 -->
  </div> <!-- end row -->

@endsection