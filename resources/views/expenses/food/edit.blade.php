@extends('layouts.app')


@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card ">
            <div class="card-header">
                <h4 class="card-title">Edit Food Stock</h4>
            </div>
            <form action="{{route('food.update',$food->id)}}" accept="" role="form" method="post">
                @csrf        
                <div class="card-body">        
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Item Name</label>
                                <input type="text" value="{{$food->item_name}}" name="item_name" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Party Name</label>
                                <input type="text" value="{{$food->party_name}}" name="party_name" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Amount</label>
                                <input type="text" value="{{$food->amount}}" name="amount" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Quantity</label>
                                <input type="text" value="{{$food->quantity}}" name="quantity" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">                                
                            <div class="form-group">
                                <label>Date</label>
                                <input type="text" value="{{$food->date}}" name="date" class="form-control datepicker">
                            </div> 
                        </div>
                        <div class="col-md-4">                                
                            <div class="form-group">
                                <label>Month</label>
                                <input type="text" name="month" value="{{$food->month}}" class="form-control monthpicker">
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