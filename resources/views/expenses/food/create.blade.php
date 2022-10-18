@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card ">
            <div class="card-header">
                <h4 class="card-title">Add Total Stock</h4>
            </div>
            <form action="{{route('food.store')}}" accept="" role="form" method="post">
                @csrf
                <div class="card-body">                               
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Item Name</label>
                                <input type="text" name="item_name" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Party Name</label>
                                <input type="text" name="party_name" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Amount</label>
                                <input type="text" name="amount" class="form-control" >
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Quantity</label>
                                <input type="text" name="quantity" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">                                
                            <div class="form-group">
                                <label>Date</label>
                                <input type="text" name="date" class="form-control datepicker">
                            </div> 
                        </div>
                        <div class="col-md-4">                                
                            <div class="form-group">
                                <label>Month</label>
                                <input type="text" name="month" class="form-control monthpicker">
                            </div> 
                        </div>
                    </div>       
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-info btn-round">Submit</button>
                    <a href="{{config('app.url')}}/food" class="btn btn-danger btn-round ml-2">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection