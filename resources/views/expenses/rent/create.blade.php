@extends('layouts.app')


@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card ">
            <div class="card-header">
                <h4 class="card-title">Add Data</h4>
            </div>
            <form action="{{route('rent.store')}}" accept="" role="form" method="post">
                @csrf        
                <div class="card-body">  
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Customer Name</label>
                                    <input type="text" name="customer_name" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Total Rent</label>
                                    <input type="text" name="rent" class="form-control">
                                </div>
                            </div>
                        </div>                                                  
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Rent Paid</label>
                                    <input type="text" name="rent_paid" class="form-control" >
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Deposit</label>
                                    <input type="text" name="deposit" class="form-control">
                                </div>
                            </div>
                        </div>            
                        <div class="row">
                            <div class="col-md-6">            
                                <div class="form-group">
                                    <label>Date</label>
                                    <input type="text" name="date" class="form-control datepicker">
                                </div>  
                            </div>
                        </div>         
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-info btn-round">Submit</button>
                    <a href="{{config('app.url')}}/rent" class="btn btn-danger btn-round ml-2">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection