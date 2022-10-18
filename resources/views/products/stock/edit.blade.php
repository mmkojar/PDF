@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card ">
            <div class="card-header">
                <h4 class="card-title">Edit Product Stock</h4>
            </div>
            <form action="{{route('product.stock.update',$stock->id)}}" accept="" role="form" method="post" id="prod_stock_form">
                @csrf        
                <div class="card-body">                    
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Select Product</label>
                                    <select class="form-control" name="product_listing" title="Select Product" disabled>
                                    <option value="{{$stock->product_id}}">{{$stock->product_name}}</option>
                                        @foreach ($products as $product)
                                            <option value="{{$product->id}}">{{$product->product_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Product No.</label>
                                    <input type="text" value="{{$stock->product_no ? $stock->product_no : ''}}" id="product_no" name="product_no" class="form-control" {{$stock->product_no ? 'readonly' : ''}} required>
                                    <span id="check_prod_no" class="text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>location Name</label>
                                    <select class="form-control get_khillno_on_change" name="location_id" id="location_id" required>
                                        <option value="" selected disabled>--select--</option>
                                        @foreach($locations as $location)
                                            <option @if($stock->lname == $location->name) selected @endif value="{{$location->id}}">{{$location->name}}</option>
                                        @endforeach
                                    </select>
                                  </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Khilla No</label>
                                    <select class="form-control get_khilla_options" name="khilla_no" required>
                                        {{-- @if($stock->khilla_no !== '') --}}
                                        <option value="{{$stock->khilla_no}}">{{$stock->khilla_no}}</option>          
                                        <option value="">--select--</option>                
                                        {{-- @endif --}}
                                    </select>
                                  </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Enter Extra Khilla No</label>
                                    <input type="text" value="{{$stock->extra_khilla_no}}" name="extra_khilla_no" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Select Gender</label>
                                    <select class="form-control" name="gender" title="Select Gender" required>
                                        <option @if($stock->gender == 'male') selected @endif value="male">Male</option>
                                        <option @if($stock->gender == 'female') selected @endif value="female">Female</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Purchase From</label>
                                    <input type="text" value="{{$stock->purchase_from}}" name="ps_purchase_from" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Purchase Date</label>
                                    <input type="text" value="{{$stock->purchase_date}}" disabled class="form-control datepicker" name="ps_purchase_date" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Party Name</label>
                                    <input type="text" value="{{$stock->party_name}}" name="ps_party_name" class="form-control" required>
                                </div> 
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Select Status</label>
                                    <select class="form-control" name="ps_purchase_status" required>                   
                                        <option @if($stock->gender == 'active') selected @endif value="active">Active</option>
                                        <option @if($stock->gender == 'inactive') selected @endif value="inactive">Inactive</option>
                                        {{-- <option @if($stock->gender == 'kasai') selected @endif value="kasai">Send to Kasai</option>
                                        <option @if($stock->gender == 'salve') selected @endif value="salve">Send to salve</option> --}}
                                    </select>
                                </div>
                            </div>
                        </div>           
                        {{-- <div class="form-group">
                            <label>Quantity</label>
                            <input type="number" value="{{$stock->quantity}}" name="ps_quantity" class="form-control">
                        </div> --}}                                                                                                           
                </div>
                <div class="card-footer">
                    <input name="_method" type="hidden" value="PUT">
                    <input type="hidden" name="product_id" value="{{$stock->product_id}}">
                    <input type="hidden" name="purchase_date" value="{{$stock->purchase_date}}">
                    <button type="submit" class="btn btn-info btn-round" id="insert">Submit</button>
                    <a href="{{config('app.url')}}" class="btn btn-danger btn-round ml-2">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection