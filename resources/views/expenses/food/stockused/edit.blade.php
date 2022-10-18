@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card ">
            <div class="card-header">
                <h4 class="card-title">Edit Food Stock</h4>
            </div>
            <form action="{{route('food.stock.update',$food->id)}}" accept="" role="form" method="post">
                @csrf        
                <div class="card-body">                               
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Item Name</label>
                                <input type="text" name="item_name"  value="{{$food->item_name}}" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Quantity</label>
                                <input type="text" name="quantity"  value="{{$food->quantity}}" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="col-md-4">                                
                            <div class="form-group">
                                <label>Date</label>
                                <input type="text" name="date"  value="{{$food->date}}" class="form-control datepicker" readonly>
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