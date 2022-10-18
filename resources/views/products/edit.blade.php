@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-md-6">
        <div class="card ">
          <div class="card-header ">
            <h4 class="card-title">Edit Form</h4>
          </div>
          {!! Form::open(['action' => ['App\Http\Controllers\Product\ProductController@update', $product->id] , 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
            @csrf
            <div class="card-body ">
                {{Form::label('p_name', 'Product Name')}}
                <div class="form-group">                    
                    {{Form::text('p_name', $product->product_name, ['class' => 'form-control'])}}
                </div>
                {{-- {{Form::label('p_name', 'Product Description')}}
                <div class="form-group">                    
                    {{Form::text('p_description', $product->product_description, ['class' => 'form-control'])}}
                </div> --}}
                <div class="form-group">
                    <label>Select Status</label>
                    <select class="form-control" name="p_status">                                                                                          
                    <option value="{{$product->status}}">{{$product->status}}</option>                        
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>
            </div>
            <div class="card-footer ">
                {{Form::hidden ('_method','PUT')}}
                {{Form::submit('Update', ['class' => 'btn btn-info btn-round pull-left'])}}
                <a href="{{config('app.url')}}" class="btn btn-danger btn-round ml-2">Cancel</a>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>


@endsection