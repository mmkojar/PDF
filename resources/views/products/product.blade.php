@extends('layouts.app')

@section('title', 'Categories')

@section('content')

<div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          @can('all-access')
            <a data-toggle="modal" id="show-cat-modal" class="text-white btn btn-primary">Add Categories</a>
          @endcan
        </div>
        <div class="card-body">
          <?php $count=1 ?>
          <table id="datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th>Sr.No</th>
                <th>Category Name</th>
                <th>Status</th>
                @can('all-access')
                <th class="disabled-sorting text-right">Actions</th>
                @endcan
              </tr>
            </thead>
            <tbody>
              @foreach($products as $product)
                <tr>
                  <td>{{$count}}</td>
                  <td>{{ucfirst($product->product_name)}}</td>
                  <td>{{ucfirst($product->status)}}</td>
                  @can('all-access')
                  <td class="text-right">
                    {{-- {!! Form::open(['action' => ['App\Http\Controllers\Product\ProductController@destroy', $product] , 'method' => 'POST', 'style' => 'display:inline']) !!}
                      {{Form::hidden ('_method','DELETE')}}
                      {{Form::submit('X', ['class' => 'btn btn-sm btn-danger'])}}
                    {!! Form::close() !!} --}}                    
                      <a id="{{$product->id}}" class="btn btn-sm btn-danger delete_all" url="product"><i class="fa fa-times"></i></a>                    
                      <a id="{{$product->id}}" class="btn btn-sm btn-warning edit_product"><i class="fa fa-edit"></i></a>                                        
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
        <div class="modal fade" id="cat-modal">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form action="{{route('categories.store')}}" accept="" role="form" method="post" id="add_product_form">
                @csrf
                <div class="modal-body">
                    <div class="box-body">
                      <div class="form-group">
                        <label>Category Name</label>
                        <input type="text" id="p_name" name="p_name" class="form-control check_unq_name" tb-name="products" tb-col="product_name" placeholder="Enter ..." required>
                        <span class="error-unq-name text-danger"></span>
                      </div>
                      <div class="form-group" id="show_status">
                        <label>Status</label>
                        <select class="form-control" name="status" id="status">
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                      </div>
                      {{-- <div class="form-group">
                        <label>Product Description</label>
                        <input type="text" id="p_description" name="p_description" class="form-control" placeholder="Enter ...">
                      </div> --}}
                    </div>					            
                </div>
                <div class="modal-footer">
                  <input type="hidden" name="hidden_prod_id" id="hidden_prod_id">
                  <input type="submit" class="btn btn-info btn-round pull-left disable_on_unq_name" id="insert" value="Submit">
                  <a href="{{config('app.url')}}/categories" class="btn btn-danger btn-round">Cancel</a>
                </div>
              </form>
            </div>
          </div>
        </div>

    </div> <!-- end col-md-12 -->
  </div> <!-- end row -->

@endsection