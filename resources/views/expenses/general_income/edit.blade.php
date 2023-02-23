@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card ">
            <div class="card-header">
                <h4 class="card-title">Edit General Income</h4>
            </div>
            <form action="{{route('income_expense.update',$income->id)}}" accept="" role="form" method="post">
                @csrf        
                <div class="card-body">                               
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Description</label>
                                <input type="text" name="description" value="{{$income->description}}" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Amount</label>
                                <input type="text" name="amount" value="{{$income->amount}}" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">                                
                            <div class="form-group">
                                <label>Date</label>
                                <input type="text" name="date" value="{{$income->date}}" class="form-control datepicker">
                            </div> 
                        </div>
                    </div>       
                </div>
                <div class="card-footer">
                    <input name="_method" type="hidden" value="PUT">
                    <button type="submit" class="btn btn-info btn-round">Submit</button>
                    <a href="{{config('app.url')}}/income_expense" class="btn btn-danger btn-round ml-2">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection