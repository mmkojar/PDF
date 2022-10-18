@extends('layouts.app')


@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card ">
            <div class="card-header">
                <h4 class="card-title">Edit Data</h4>
            </div>
            <form action="{{route('rent.update',$rent->id)}}" accept="" role="form" method="post">
                @csrf        
                <div class="card-body">   
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Customer Name</label>
                                    <input type="text" value="{{$rent->customer_name}}" name="customer_name" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Total Rent</label>
                                    <input type="text" value="{{$rent->rent}}" name="rent" class="form-control">
                                </div>
                            </div>
                        </div>                                                  
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Rent Paid</label>
                                    <input type="text" value="{{$rent->rent_paid}}" name="rent_paid" class="form-control" >
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Deposit</label>
                                    <input type="text" value="{{$rent->deposit}}" name="deposit" class="form-control">
                                </div>
                            </div>
                        </div>            
                        <div class="row">
                            <div class="col-md-6">            
                                <div class="form-group">
                                    <label>Date</label>
                                    <input type="text" value="{{$rent->date}}" name="date" class="form-control datepicker">
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