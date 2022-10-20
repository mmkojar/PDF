@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card ">
            <div class="card-header">
                <h4 class="card-title">Add Customer</h4>
            </div>
            <form action="{{route('customer.store')}}" accept="" role="form" method="post">
                @csrf        
                <div class="card-body">                
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Customer Name</label>
                                <input type="text" name="c_name" class="form-control" required>
                            </div>
                        </div>
                        {{-- <div class="col-md-4">
                            <div class="form-group">
                                <label>Customer Type</label>
                                <select class="form-control" name="c_type" id="c_type">                         
                                    <option value="Regular Customer" selected>Regular Customer</option>
                                    <option value="Home Customer">Home Customer</option>
                                </select>
                            </div> 
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Bill Period</label>
                                <select class="form-control" name="bill_period" id="bill_period">                         
                                    <option value="weekly" selected>Weekly</option>
                                    <option value="monthly">Monthly</option>                                    
                                </select>
                            </div>
                        </div> --}}
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Customer Location</label>
                                <input type="text" name="c_location" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Description</label>
                                <input type="text" class="form-control" name="c_description" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Milk Rate</label>
                                <input type="number" name="milk_rate" class="form-control" step=".01" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Morning</label>
                                <input type="number" name="morning" class="form-control" step=".01" min="0" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Evening</label>
                                <input type="number" name="evening" class="form-control" step=".01" min="0" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Mobile No.</label>
                                <input type="text" name="mobile_no" class="form-control" maxlength="10" minlength="10" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Email Id</label>
                                <input type="email" name="c_email" class="form-control">
                            </div>
                        </div>
                    </div>          
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-info btn-round">Submit</button>
                    <a href="{{config('app.url')}}/customer" class="btn btn-danger btn-round ml-2">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection