@extends('layouts.app')

@section('content')
<div class="alert alert-success alert-dismissible fade d-none show" id="process_alert" role="alert">
    <strong></strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button>
  </div>
<div class="row">
    <div class="col-md-12">
        <div class="card ">
            <div class="card-header">
                <h4 class="card-title">Add Data</h4>
            </div>
            <form accept="" role="form" method="post" id="processing_form1">
                @csrf        
                <div class="card-body">                  
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Select Product</label>
                                <select class="form-control" name="product_id"  title="Select Product" id="get_stock_name_on_change">
                                    <option value="" disabled selected>--Select--</option>
                                    @foreach ($products as $product)
                                        <option value="{{$product->id}}">{{$product->product_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Select Product Stock</label>
                                <select class="form-control" name="product_stock_id" title="Select Product Stock" id="get_stock_options">
                                    {{-- <option value="" disabled selected>--Select--</option> --}}
                                    {{-- @foreach ($product_stocks as $product_stock)
                                        <option value="{{$product_stock->id}}">{{$product_stock->stock_p_name}} {{$product_stock->id}}</option>
                                    @endforeach --}}
                                </select>
                            </div>
                        </div>                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Date</label>
                                {{-- id="get_medical_date_on_change" --}}
                                <input type="text" name="date" class="form-control datepicker" id="date">
                            </div> 
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Medical Date</label>
                                <input type="text" name="medical_date" id="medical_date" class="form-control" disabled>
                            </div> 
                        </div>
                    </div>                                                
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-info btn-round">Submit</button>
                    <a href="{{config('app.url')}}" class="btn btn-danger btn-round ml-2">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection