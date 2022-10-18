@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card ">
            <div class="card-header">
                <h4 class="card-title">Edit Invoice</h4>
            </div>            
            <form action="{{route('billing.update',$weekly_billing->id)}}" accept="" role="form" method="post">
                @csrf        
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Bill No</label>
                            <input type="text" value="{{$weekly_billing->bill_no}}" readonly name="bill_no" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group" id="hide_on_normal">
                                <label>Customer Name</label>
                                <input type="text" value="{{$weekly_billing->customer_name}}" readonly class="form-control">
                                <input type="hidden" value="{{$weekly_billing->customer_id}}" name="customer_id">
                            </div>  
                        </div>    
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>From Date</label>
                                <input type="text" value="{{$weekly_billing->from_date}}" readonly name="from_date"  class="form-control datepicker">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>To Date</label>
                                <input type="text" value="{{$weekly_billing->to_date}}" readonly name="to_date"  class="form-control datepicker">
                            </div>
                        </div>    
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Total Litres</label>
                                <input type="text" value="{{$weekly_billing->total_litres}}" readonly name="total_litres" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Total Amount</label>
                                <input type="text" value="{{$weekly_billing->total_amount}}" readonly name="total_amount" class="form-control">
                            </div>
                        </div>    
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Amount Paid</label>
                                <input type="text" value="{{$weekly_billing->amount_paid}}" name="amount_paid" class="form-control">
                            </div>
                        </div> 
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Adjusted</label>
                                <input type="text" value="{{$weekly_billing->adjusted}}" name="adjusted" class="form-control">
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