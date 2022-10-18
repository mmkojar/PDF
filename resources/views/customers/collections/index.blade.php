@extends('layouts.app')

@section('content')

<div class="row">
  <div class="col-md-12 mx-auto">
    <div class="card">
      <div class="card-body ">
        <ul class="nav nav-pills nav-pills-primary nav-pills-icons justify-content-center" role="tablist">    
          <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#sold" role="tablist">
              <i class="now-ui-icons shopping_shop"></i>
              Milk Sold
            </a>
          </li> 
          <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#internal" role="tablist">
              <i class="now-ui-icons shopping_shop"></i>
              Internal Collection
            </a>
          </li>      
          <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#external" role="tablist">
              <i class="now-ui-icons shopping_shop"></i>
              External Collection
            </a>
          </li>
        </ul>

        <div class="tab-content tab-space tab-subcategories">  
          
          <div class="tab-pane active" id="sold">
            <div class="card">
              <div class="card-header">
                @can('all-access')
                  <a href="{{route('milk_entries.create')}}" class="btn btn-primary">Add Data</a>            
                @endcan
              </div>
              <div class="card-body">
                <table id="milk_sold_datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th>Sr.No</th>
                      <th>Customer Name</th>
                      <th>Customer Type</th>
                      <th>Rate</th>
                      <th>Morning</th>
                      <th>Sold Date</th>
                      <th>Evening</th>
                      <th>Total Litres</th>
                      <th>Amount Paid</th>
                      <th>Pending Amount</th>                  
                      <th>Total Amount</th>
                      @can('all-access')
                        <th class="disabled-sorting text-right">Actions</th>
                      @endcan
                    </tr>
                  </thead>
                   {{-- <tbody>
                    @foreach($solds as $collection)
                      <tr>
                        <td>{{$collection->id}}</td>                  
                        <td>{{$collection->rcustomer_name}}</td>
                        <td>{{$collection->type}}</td>
                        <td>{{$collection->milk_rate}}</td>
                        <td>{{$collection->morning}}</td>
                        <td>{{$collection->sold_date}}</td>                  
                        <td>{{$collection->evening}}</td>
                        <td>{{$collection->total_litres}}</td>
                        <td>{{$collection->amount_paid ? $collection->amount_paid : 0}}</td>
                        <td>{{$collection->pending_amount ? $collection->pending_amount : 0}}</td>
                        <td>{{ucfirst($collection->total_amount ? $collection->total_amount : '-')}}</td>
                        <td class="text-right">      
                          <a href="{{route('milk_entries.edit', $collection->id)}}" class="btn btn-sm btn-warning edit"><i class="fa fa-edit"></i></a>                    
                        </td>
                      </tr>
                    @endforeach
                  </tbody> --}}        
                </table>
              </div>
            </div>        
          </div>

          <div class="tab-pane" id="internal">
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
                      <span class="text-danger">
                        Note: Calculate Grand Total Manually After editing Given, GivenReturn, Taken, TakenReturn
                      </span>
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
          </div>

          <div class="tab-pane" id="external">
              <div class="card">
                <div class="card-header">            
                @can('all-access')
                    <a href="{{route('milk_collection.create')}}" class="btn btn-primary">Add External Collection</a>            
                @endcan
                </div>
                <div class="card-body">
                <table id="external_datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>Sr.No</th>
                        <th>Date</th>
                        <th>Collection Type</th>
                        <th>Party Name</th>
                        <th>Morning</th>
                        <th>Evening</th>
                        <th>Rate</th>
                        <th>Total Amount</th>
                        <th>Cash</th>
                        @can("all-access")          
                        <th class="disabled-sorting text-right">Actions</th>
                        @endcan
                    </tr>
                    </thead>               
                </table>
                </div>
              </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>

@endsection