@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card ">
            <div class="card-header">
                <h4 class="card-title">Edit Ghabhan</h4>
            </div>
            <form action="{{route('ghabhan.store')}}" accept="" role="form" method="post" id="ghabhan_form">
                @csrf        
                <div class="card-body">                  
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Product Name</label>
                                <input type="text" value="{{ucfirst($pregnant->product_name)}}" name="product_name" class="form-control" readonly>                                
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Product No</label>
                                <input type="text" value="{{ucfirst($pregnant->product_name)}} {{$pregnant->product_no}}" name="product_name" class="form-control" readonly>
                            </div>
                        </div>                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Processing Date</label>
                                <input type="text" value="{{date('M j Y',strtotime($pregnant->processing_date))}}" class="form-control" readonly>
                            </div> 
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Medical Date</label>
                                <input type="text" value="{{date('M j Y',strtotime($pregnant->actual_medical_date))}}" class="form-control" readonly>
                            </div> 
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Delivery Date</label>
                                <input type="text" value="{{date('M j Y',strtotime($pregnant->delivery_date))}}" class="form-control" readonly>
                            </div> 
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Select Status</label>
                                <select class="form-control" name="status" id="status" required>
                                    <option value="" disabled selected>--select--</option>                                    
                                    <option value="send_salves">Send To Salves</option>      
                                    <option value="back_process">Back to Process</option>                          
                                </select>
                            </div>
                        </div>
                        {{-- <div class="col-md-6">
                            <div class="form-group">
                                <label>Send To Salves</label>
                                <div class="form-check" >
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input" id="send_to_salves_check" name="salve_check" value="no">
                                        <span class="form-check-sign"></span>                                        
                                    </label>
                                </div>
                            </div>
                        </div>  --}}                       
                    </div>
                    <div class="row" id="show_on_salve_tick" style="display: none;">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Date</label>
                                <input type="text" class="form-control datepicker" id="salves_date" name="salves_date">
                            </div> 
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Salve Name</label>
                                <select class="form-control" name="salve_name" id="salve_name">
                                    <option value="" disabled selected>--select--</option>
                                    @foreach ($salves_name as $name)
                                        <option value="{{$name->salve_name}}">{{$name->salve_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Salve Location</label>
                                <select class="form-control" name="salve_location" id="salve_location">    
                                    <option value="" disabled selected>--select--</option>   
                                    @foreach ($salves_location as $location)
                                        <option value="{{$location->location}}">{{$location->location}}</option>
                                    @endforeach                             
                                </select>
                            </div>
                        </div>
                    </div> 
                    <div class="row" id="show_on_process" style="display: none;">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Note</label>
                                <input type="text" class="form-control" id="note" name="note">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Date</label>
                                <input type="text" class="form-control datepicker" id="back_to_process_date" name="back_to_process_date">
                            </div>
                        </div>
                    </div>                                                
                </div>
                <div class="card-footer">
                    <input name="processing_date" type="hidden" value="{{$pregnant->processing_date}}">
                    <input name="medical_date" type="hidden" value="{{$pregnant->actual_medical_date}}">
                    <input name="delivery_date" type="hidden" value="{{$pregnant->delivery_date}}">
                    <input name="product_id" id="product_id" type="hidden" value="{{$pregnant->product_id}}">
                    <input name="product_stock_id" id="product_stock_id" type="hidden" value="{{$pregnant->product_stock_id}}">
                    <input name="processing_id" id="processing_id" type="hidden" value="{{$pregnant->processing_id}}">
                    <input name="medical_id" id="medical_id" type="hidden" value="{{$pregnant->id}}">
                    <input name="product_no" id="product_no" type="hidden" value="{{$pregnant->product_no}}">
                    <button type="submit" class="btn btn-info btn-round" disabled>Submit</button>
                    <a href="{{config('app.url')}}" class="btn btn-danger btn-round ml-2">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection