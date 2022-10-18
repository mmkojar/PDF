@extends('layouts.app')


@section('content')

<div class="row">
  <div class="col-md-12 mx-auto">
    {{-- <div class="card"> --}}
      {{-- <div class="card-body "> --}}
                  
            <div class="card">        
              <div class="card-header">            
                  <a></a>
              </div>
              <div class="card-body">
                <table id="internal_datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th>Sr.No</th>
                      <th>Collection Date</th>
                      <th>Morning</th>
                      <th>Evening</th>
                      <th>Total</th>
                      <th>Given</th>
                      <th>GivenReturn</th>
                      <th>Taken</th> 
                      <th>TakenReturn</th>
                      <th>Final Total</th>
                      @can("all-access")
                        <th>Action</th>
                      @endcan
                    </tr>
                  </thead>                 
                </table>
              </div>
            </div>        

            <div class="modal fade" id="collection-modal">
              <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <form action="{{route('milk_collection.store')}}" accept="" role="form" method="post" id="edit_milk_collection_form">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                          <div class="col-md-12">
                            <div class="form-group">
                              <label>Collection Date</label>
                              <input type="text" id="collection_date" name="collection_date" class="form-control" placeholder="Enter ..." readonly>                     
                            </div>
                          </div>
                        </div>
                        <div class="row">                         
                          <div class="col-md-6">
                            <div class="form-group">
                              <label>Morning</label>
                              <input type="text" name="morning" id="morning" class="form-control" placeholder="Enter ..." readonly>                      
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label>Evening</label>
                              <input type="text" name="evening" id="evening" class="form-control" placeholder="Enter ..." readonly>                      
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label>Given</label>
                              <input type="text" name="given" id="given" class="form-control" placeholder="Enter ...">                      
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label>GivenReturn</label>
                              <input type="text" name="givenreturn" id="givenreturn" class="form-control" placeholder="Enter ...">                      
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label>Taken</label>
                              <input type="text" name="taken" id="taken" class="form-control" placeholder="Enter ...">                      
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label>TakenReturn</label>
                              <input type="text" name="takenreturn" id="takenreturn" class="form-control" placeholder="Enter ...">                      
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label>Total Litres</label>
                              <input type="text" name="total_litres" id="total_litres" class="form-control" placeholder="Enter ...">                      
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label>Grand Total</label>
                              <input type="text" name="grand_total" id="grand_total" class="form-control" placeholder="Enter ...">                      
                            </div>
                          </div>
                        </div>                        				            
                    </div>
                    <div class="modal-footer">
                      <input type="hidden" name="hidden_collection_id" id="hidden_collection_id">
                      <input type="submit" class="btn btn-info btn-round pull-left" id="insert" value="Update">
                      <a href="{{config('app.url')}}" class="btn btn-danger btn-round">Cancel</a>
                    </div>
                  </form>
                </div>
              </div>
            </div>

            {{-- <tbody>
              @foreach($internal as $data)
                <tr>
                  <td>{{$data->id}}</td>
                  <td>{{date('M j Y',strtotime($data->collection_date))}}</td>
                  <td>{{$data->morning}}</td>
                  <td>{{$data->evening}}</td>
                  <td>{{$data->grand_total}}</td>
                  <td>{{$data->given}}</td>                  
                  <td>{{$data->givenreturn}}</td>
                  <td>{{$data->taken}}</td>
                  <td>{{$data->takenreturn}}</td>
                  <td>{{$data->total_litres}}</td>
                  <td class="text-right">
                    <a id="{{$data->id}}" class="btn btn-sm btn-warning edit_collection"><i class="fa fa-edit"></i></a>                    
                  </td>
                </tr>
              @endforeach
            </tbody>  --}}
      {{-- </div> --}}
    {{-- </div> --}}
  </div>
</div>

@endsection