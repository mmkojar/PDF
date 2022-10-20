@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card ">
            <div class="card-header">
                <h4 class="card-title">Edit Stock In</h4>
            </div>
            <form action="{{route('stock.in.update')}}" accept="" role="form" method="post">
                @csrf
                <div class="card-body">                  
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Item Name</label>
                                <select class="form-control" name="ditem_id" disabled>                                     
                                    <option value="">Select</option>
                                    @foreach($items as $item)
                                        <option value="{{$item->id}}" {{$data->item_id === $item->id ? 'selected' : ''}}>{{$item->name}}</option>
                                    @endforeach
                                </select>
                                <input type="hidden" name="item_id" value="{{$data->item_id}}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Party Name</label>
                                <input type="text" name="party_name" class="form-control" value="{{$data->party_name}}">
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
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Purchase Rate</label>
                                <input type="number" min="0"  name="rate" class="form-control" value="{{$data->rate}}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Total Amount</label>
                                <input type="text"  name="total_amount" class="form-control" value="{{$data->total_amount}}" readonly>
                            </div>
                        </div>
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