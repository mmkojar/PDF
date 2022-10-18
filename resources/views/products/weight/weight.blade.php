@extends('layouts.app')


@section('content')

<div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          @can('all-access')
            <form action="{{route('weight.store')}}" accept="" role="form" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                        <label>Select Product</label>
                        <select class="form-control" name="product_name" title="Select Product" id="get_stock_name_on_change" required>
                            <option value="" disabled selected>--Select--</option>
                            @foreach ($products as $product)
                                <option value="{{$product->id}}">{{$product->product_name}}</option>
                            @endforeach
                        </select>
                    </div>
                  </div>
                  <div class="col-md-4">
                      <div class="form-group">
                          <label>Select Product Stock</label>
                          <select class="form-control" name="product_no[]" title="Select Product Stock" id="get_stock_options" multiple required>
                          </select>
                      </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                        <label>Date</label>
                        <input type="text" name="weight_date" class="form-control datepicker" required>
                    </div>
                </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <input type="submit" class="btn btn-info btn-round pull-left" id="submit" value="Submit">                  
                  </div>
                </div>
            </form>
          @endcan
        </div>
        <div class="card-body">
            <?php $count=1 ?>
            <table id="weight_datatable" class="table table-striped table-bordered" width="100%">
                <thead>
                <tr>
                    <th>Sr.No</th>
                    <th>Product Name</th>                
                    <th>Product No</th>
                    <th>Morning</th>
                    <th>Evening</th>
                    <th>Date</th>
                    @can('all-access')
                    <th class="disabled-sorting text-right hide_on_print">Actions</th>
                    @endcan
                </tr>
                </thead>
                <tbody>
                    @foreach($weights as $weight)
                        <tr>
                            <td>{{$count}}</td>
                            <td>{{$weight->product_name}}</td>
                            <td>{{$weight->product_name}} {{$weight->product_no}}</td>
                            <td>{{$weight->morning}}</td>
                            <td>{{$weight->evening}}</td>
                            <td>{{date('M j Y',strtotime($weight->date))}}</td>
                            @can('all-access')
                            <td class="text-center hide_on_print">
                              <a id="{{$weight->id}}" class="btn btn-sm btn-danger delete_all" url="weight"><i class="fa fa-times"></i></a>
                              <a id="{{$weight->id}}" class="btn btn-sm btn-warning edit_weight"><i class="fa fa-edit"></i></a>                    
                            </td>             
                            @endcan                                       
                        </tr>
                        <?php $count++ ?>
                    @endforeach            
                </tbody>
            </table>
        </div><!-- end content-->
      </div><!--  end card  -->

      <div class="modal fade" id="weight-modal">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="{{route('weight.store')}}" accept="" role="form" method="post" id="edit_weight_form">
              @csrf
              <div class="modal-body">
                  <div class="box-body">
                    <div class="form-group">
                      <label>Product Name</label>
                      <input type="text" id="product_name" class="form-control" placeholder="Enter ..." readonly>                     
                    </div>
                    <div class="form-group">
                        <label>Product No</label>
                        <input type="text" id="product_no" name="product_no" class="form-control" placeholder="Enter ..." readonly>                      
                    </div>
                    <div class="form-group">
                        <label>Morning</label>
                        <input type="text" id="morning" name="morning" class="form-control" placeholder="Enter ...">                      
                    </div>
                    <div class="form-group">
                        <label>Evening</label>
                        <input type="text" id="evening" name="evening" class="form-control" placeholder="Enter ...">                      
                    </div>
                  </div>					            
              </div>
              <div class="modal-footer">
                <input type="hidden" name="hidden_weight_id" id="hidden_weight_id">
                <input type="hidden" id="product_id" name="product_name" class="form-control" placeholder="Enter ..." readonly>
                <input type="submit" class="btn btn-info btn-round pull-left disable_on_unq_name" id="insert" value="Update">
                <a href="{{config('app.url')}}" class="btn btn-danger btn-round">Cancel</a>
              </div>
            </form>
          </div>
        </div>
      </div>

    
    </div> <!-- end col-md-12 -->
  </div> <!-- end row -->

@endsection