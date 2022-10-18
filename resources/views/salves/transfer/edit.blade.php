@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card ">
            <div class="card-header">
                <h4 class="card-title">Add Data</h4>
            </div>
            <form action="{{route('salve.transfer.update',$transfer->id)}}" accept="" role="form" method="post">
                @csrf        
                <div class="card-body">                  
                    <div class="row">         
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Select Product</label>
                                <select class="form-control" name="product_id" title="Select Product" id="get_stock_name_on_change">
                                    <option value="{{$transfer->pid}}">{{$transfer->product_name}}</option>
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
                                    <option value="{{$transfer->stock_id}}">{{$transfer->product_name}} {{$transfer->stock_id}}</option>                                
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
                                    <option value="{{$transfer->location}}">{{$transfer->location}}</option>
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
                                    <option value="{{$transfer->salve_name}}">{{$transfer->salve_name}}</option>
                                    @foreach ($snames as $sname)
                                            <option value="{{$sname->salve_name}}">{{$sname->salve_name}}</option>
                                    @endforeach
                                </select>
                            </div> 
                        </div>
                    </div>                                                
                </div>
                <div class="card-footer">
                    {{-- <input name="product_id" type="hidden" value="{{$transfer->product_id}}"> --}}
                    <input name="old_stock_id" type="hidden" value="{{$transfer->stock_id}}">
                    <input name="_method" type="hidden" value="PUT">
                    <button type="submit" class="btn btn-info btn-round">Submit</button>
                    <a href="{{config('app.url')}}" class="btn btn-danger btn-round ml-2">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection