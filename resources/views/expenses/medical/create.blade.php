@extends('layouts.app')


@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card ">
            <div class="card-header">
                <h4 class="card-title">Add Medical Stock</h4>
            </div>
            <form action="{{route('medical.store')}}" accept="" role="form" method="post">
                @csrf        
                <div class="card-body">                     
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Description</label>
                                <input type="text" name="description" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Buy From</label>
                                <input type="text" name="buy_from" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Select</label>
                                <select class="form-control" name="units" id="medical_units">
                                    <option value="" selected disabled>Select</option>
                                    <option value="units">No. of Units</option>
                                    <option value="boxes">No. of Boxes</option>
                                    <option value="litres">No. of litres</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6" id="show_on_units" style="display:none">
                            <div class="form-group">
                                <label class="change_on_units"></label>
                                <input type="text" name="quantity" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Price</label>
                                <input type="text" name="price" class="form-control">
                            </div>
                        </div>
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
                    <a href="{{config('app.url')}}/medical" class="btn btn-danger btn-round ml-2">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection