@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card ">
            <div class="card-header">
                <h4 class="card-title">Add Data</h4>
            </div>
            <form action="{{route('salve.transfer.store')}}" accept="" role="form" method="post">
                @csrf        
                <div class="card-body">                  
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Select Product</label>
                                <select class="form-control" name="product_id" title="Select Product" id="get_stock_name_on_change">
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
                                <label>Select Location</label>
                                <select class="form-control" name="location" title="Select Location">
                                    @foreach ($locations as $location)
                                            <option value="{{$location->location}}">{{$location->location}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Select Salve Name</label>
                                <select class="form-control" name="salve_name" title="Select Salve Name">
                                    @foreach ($snames as $sname)
                                            <option value="{{$sname->salve_name}}">{{$sname->salve_name}}</option>
                                    @endforeach
                                </select>
                            </div> 
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Date</label>
                                <input type="text" name="date" class="form-control datepicker">
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