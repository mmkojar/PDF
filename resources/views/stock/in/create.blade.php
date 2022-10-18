@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card ">
            <div class="card-header">
                <h4 class="card-title">Stock In</h4>
            </div>
            <form action="{{route('stock.in.store')}}" accept="" role="form" method="post">
                @csrf
                <div class="card-body">                  
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Item Name</label>
                                <select class="form-control" name="item_id" required> 
                                    <option value="" selected disabled>Select</option>
                                    @foreach($items as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Party Name</label>
                                <input type="text" name="party_name" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Qty</label>
                                <input type="number" name="qty" class="form-control" min="1" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Select Unit</label>
                                <select class="form-control" name="unit" required>
                                    <option value="" selected disabled>Select</option>
                                    <option value="GRAM">GRAM</option>
                                    <option value="KG">KG</option>
                                    <option value="LTR">LTR</option>
                                    <option value="BOX">BOX</option>
                                    <option value="PCS">PCS</option>
                                </select>
                            </div> 
                        </div>                    
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Purchase Rate</label>
                                <input type="number" min="1" name="rate" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Date</label>
                                <input type="text" name="date" class="datepicker form-control" required>
                            </div>
                        </div>                        
                    </div>                                                
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-info btn-round">Submit</button>
                    <a href="{{config('app.url')}}/stock" class="btn btn-danger btn-round ml-2">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection