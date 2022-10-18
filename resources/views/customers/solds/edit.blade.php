@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card ">
            <div class="card-header">
                <h4 class="card-title">Edit Data</h4>
            </div>
            <form action="{{route('milk_entries.update',$sold->id)}}" accept="" role="form" method="post" id="milk_sold_form">
                @csrf        
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Customer Type</label>
                                <select class="form-control" id="customer_type" name="dcustomer_type" disabled>                 
                                    <option @if($sold->type == 'Regular Customer') selected @endif value="Regular Customer">Regular Customer</option>
                                    <option @if($sold->type == 'Normal Customer') selected @endif value="Normal Customer">Normal Customer</option>
                                </select>
                            </div>
                            <input type="hidden" name="customer_type" value="{{$sold->type}}">
                        </div>
                        <div class="col-md-6 show_on_normal">
                            <div class="form-group">
                                <label>Customer Name</label>
                                <input type="text" value="{{$sold->normal_customer_name}}" name="normal_customer_name" id="remove_normal_c_name" class="form-control">
                            </div> 
                        </div>
                        <div class="col-md-6 hide_on_normal">
                            <div class="form-group">
                                <label>Select Customer</label>                                
                                <select class="form-control" name="customer_name" title="Select Customer" id="remove_regular_c_name">
                                    <option value="">Select</option>
                                    @foreach ($customers as $customer)
                                        <option @if($sold->customer_id == $customer->id) selected @endif value="{{$customer->id}}">{{$customer->customer_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        {{-- <div class="col-md-12 hide_on_normal" id="show_select" style="display: none">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input" id="select_on_change" >
                                    <span class="form-check-sign"></span>
                                    Select If Any Change
                                </label>
                            </div>
                        </div>--}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Rate</label>
                                <input type="number" id="milk_rate" value="{{$sold->milk_rate}}" name="milk_rate"  step="0.1" min="0" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Morning</label>
                                <input type="number" id="morning" value="{{$sold->morning}}" name="morning"  step="0.1" min="0" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Evening</label>
                                <input type="number" id="evening" value="{{$sold->evening}}" name="evening"  step="0.1" min="0" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Sold Date</label>
                                <input type="text" value="{{$sold->sold_date}}" class="form-control datepicker" name="sold_date">
                            </div>
                        </div>
                        <div class="col-md-6 show_on_normal">
                            <div class="form-group">
                                <label>Amount Paid</label>
                            <input type="number" value="{{$sold->amount_paid}}" name="amount_paid" id="remove_amount_paid"  class="form-control">
                            </div>
                        </div>
                    </div>
                    {{-- <div class="form-group">
                        <label>Pending Amount</label>
                        <input type="text" value="{{$sold->pending_amount}}" name="pending_amount"  class="form-control">
                    </div>--}}
                </div>
                <div class="card-footer">
                    <input name="_method" type="hidden" value="PUT">
                    {{-- <input name="customer_type" type="hidden" value="{{$sold->type}}"> --}}
                    {{-- <input name="sold_date" type="hidden" value="{{$sold->sold_date}}"> --}}
                    <button type="submit" class="btn btn-info btn-round">Submit</button>
                    <a href="{{config('app.url')}}" class="btn btn-danger btn-round ml-2">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection