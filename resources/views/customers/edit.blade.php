@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card ">
            <div class="card-header">
                <h4 class="card-title">Edit Customer</h4>
            </div>
            <form action="{{route('customer.update',$customer->id)}}" accept="" role="form" method="post">
                @csrf        
                <div class="card-body">               
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Customer Name</label>
                                    <input type="text" value="{{$customer->customer_name}}" name="c_name" class="form-control" required>
                                </div>
                            </div>
                            {{-- <div class="col-md-4">
                                <div class="form-group">
                                    <label>Customer Type</label>
                                    <select class="form-control" name="c_type" id="c_type">                         
                                        <option @if($customer->customer_type == 'Regular Customer') selected @endif value="Regular Customer">Regular Customer</option>
                                        <option @if($customer->customer_type == 'Home Customer') selected @endif value="Home Customer">Home Customer</option>
                                    </select>
                                </div> 
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Bill Period</label>
                                    <select class="form-control" name="bill_period" id="bill_period">                         
                                        <option @if($customer->customer_type == 'weekly') selected @endif value="weekly" selected>Weekly</option>
                                        <option @if($customer->customer_type == 'monthly') selected @endif value="monthly">Monthly</option>                                    
                                    </select>
                                </div>
                            </div> --}}
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Customer Location</label>
                                    <input type="text" value="{{$customer->customer_location}}" name="c_location" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Description</label>
                                    <input type="text" value="{{$customer->description}}" class="form-control" name="c_description">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Milk Rate</label>
                                    <input type="number" value="{{$customer->milk_rate}}" name="milk_rate" class="form-control" step=".01" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Morning</label>
                                    <input type="number" value="{{$customer->morning}}" name="morning" class="form-control" step=".01" min="0" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Evening</label>
                                    <input type="number" value="{{$customer->evening}}" name="evening" class="form-control" step=".01" min="0" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Mobile No.</label>
                                    <input type="text" value="{{$customer->mobile_no}}" name="mobile_no" class="form-control" maxlength="10" minlength="10">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Email Id</label>
                                    <input type="email" value="{{$customer->email}}" name="c_email" class="form-control">
                                </div> 
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Select Status</label>
                                    <select class="form-control" name="c_status" required>                        
                                        <option @if($customer->status == 'active') checked @endif value="active">Active</option>
                                        <option @if($customer->status == 'inactive') checked @endif value="inactive">Inactive</option>
                                    </select>
                                </div>     
                            </div>    
                        </div>     
                </div>
                <div class="card-footer">
                    <input name="_method" type="hidden" value="PUT">
                    <button type="submit" class="btn btn-info btn-round">Submit</button>
                    <a href="{{config('app.url')}}" class="btn btn-danger btn-round ml-2">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection