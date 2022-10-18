@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card" id="hide_on_print">
            <div class="card-header">
                <h4 class="card-title">Create Invoice</h4>
            </div>
            <form action="{{route('billing.store')}}" method="POST" id="billing_detail_form" enctype="multipart/form-data">
                @csrf        
                <div class="card-body">
                    <div class="alert d-none" role="alert"></div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Select Customer</label>
                            <select class="form-control selectpicker" name="customer_id[]" id="get_customer_id" data-size="7" title="Select Customer" multiple required>
                                {{-- <option value="select_all">Select All</option> --}}
                                @foreach ($customers as $customer)
                                    <option value="{{$customer->id}}">{{$customer->customer_name}}<!--  - {{$customer->bill_period}} --></option>
                                @endforeach
                            </select>
                        </div>    
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>From Date</label>
                                <input type="text" name="from_date" id="from_date" class="form-control datepicker" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>To Date</label>
                                <input type="text" name="to_date" id="to_date" class="form-control datepicker" required>
                            </div>
                        </div>    
                    </div>                   
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-info btn-round">Submit</button>
                    <a href="{{config('app.url')}}/billing" class="btn btn-danger btn-round ml-2">Cancel</a>
                </div>
            </form>
        </div>
        
    </div>
</div>

@endsection