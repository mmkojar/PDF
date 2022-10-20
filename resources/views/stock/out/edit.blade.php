@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card ">
            <div class="card-header">
                <h4 class="card-title">Edit Stock Out</h4>
            </div>
            <form action="{{route('stock.out.update')}}" accept="" role="form" method="post">
                @csrf
                <div class="card-body">                  
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Item Name</label>
                                <select class="form-control" name="item_id">
                                    <option value="{{$data->item_id}}">{{$data->item_name}}</option>                                   
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Qty</label>
                                <input type="number" name="qty" class="form-control" min="1" value="{{$data->qty}}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Select Unit</label>
                                <select class="form-control" name="unit" required>
                                    <option value="GRAM" {{$data->unit === 'GRAM' ? 'selected' : ''}}>GRAM</option>
                                    <option value="KG" {{$data->unit === 'KG' ? 'selected' : ''}}>KG</option>
                                    <option value="LTR" {{$data->unit === 'LTR' ? 'selected' : ''}}>LTR</option>
                                    <option value="BOX" {{$data->unit === 'BOX' ? 'selected' : ''}}>BOX</option>
                                    <option value="PCS" {{$data->unit === 'PCS' ? 'selected' : ''}}>PCS</option>
                                    <option value="GUNI" {{$data->unit === 'GUNI' ? 'selected' : ''}}>GUNI</option>
                                </select>
                            </div> 
                        </div>                    
                        {{-- <div class="col-md-6">
                            <div class="form-group">
                                <label>Selling Rate</label>
                                <input type="number" min="1" name="rate" class="form-control" value="{{$data->rate}}" required>
                            </div>
                        </div> --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Date</label>
                                <input type="text" name="date" class="form-control datepicker" value="{{$data->date}}" required>
                            </div>
                        </div>                        
                    </div>                                                
                </div>
                <div class="card-footer">
                    <input name="_method" type="hidden" value="PUT">
                    <input name="hidden_id" type="hidden" value="{{$hidden_id}}}">
                    <button type="submit" class="btn btn-info btn-round">Submit</button>
                    <a href="{{config('app.url')}}/stock" class="btn btn-danger btn-round ml-2">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection