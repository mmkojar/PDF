@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card ">
            <div class="card-header">
                <h4 class="card-title">Add Paid Amount</h4>
            </div>
            <form action="{{route('food.amountpaid.store')}}" accept="" role="form" method="post" id="food_stock_use_form">
                @csrf        
                <div class="card-body">                               
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Party Name</label>
                                <select class="form-control item_name" name="party_name" id="get_month_on_change" url="/food/amount/api/">    
                                    <option value="" disabled selected>--select--</option>
                                    @foreach ($items as $item)
                                        <option value="{{$item->party_name}}">{{ucwords($item->party_name)}}</option>
                                    @endforeach
                                </select>
                            </div>                                                   
                        </div>
                        {{-- <div class="col-md-4">
                            <div class="form-group">
                                <label>Item Name</label>
                                <select class="form-control item_name" name="item_name">    
                                    <option value="" disabled selected>--select--</option>   
                                    @foreach ($items as $item)
                                        <option value="{{$item->item_name}}">{{ucwords($item->item_name)}}</option>
                                    @endforeach                             
                                </select>
                            </div>                                                   
                        </div> --}}
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Description</label>
                                <input type="text" name="description" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Enter Amount</label>
                                <input type="text" name="amount_paid" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Month</label>
                                <select class="form-control item_name1" id="get_month_options" name="month">    
                                    {{-- <option value="" disabled selected>--select--</option>
                                    @foreach ($items as $data)
                                        <option value="{{$data->month}}">{{$data->month}}</option>
                                    @endforeach --}}
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Date</label>
                                <input type="text" name="date" class="form-control datepicker" required>
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