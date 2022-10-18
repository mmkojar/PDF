@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card ">
            <div class="card-header">
                <h4 class="card-title">Edit Salves Stock </h4>
            </div>
            <form action="{{route('ghabhan.salve.update',$g_salves->id)}}" accept="" role="form" method="post" id="ghabhan_salve_form">
                @csrf        
                <div class="card-body">                  
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Product Name</label>
                                <input type="text" value="{{ucfirst($g_salves->product_name)}}" name="product_name" class="form-control" readonly>                                
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Product No</label>
                                <input type="text" value="{{ucfirst($g_salves->product_name)}} {{$g_salves->product_no}}" name="product_name" class="form-control" readonly>
                            </div>
                        </div>                        
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Processing Date</label>
                                <input type="text" value="{{date('M j Y',strtotime($g_salves->processing_date))}}" class="form-control" readonly>
                            </div> 
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Medical Date</label>
                                <input type="text" value="{{date('M j Y',strtotime($g_salves->medical_date))}}" class="form-control" readonly>
                            </div> 
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Salves Date</label>
                                <input type="text" value="{{date('M j Y',strtotime($g_salves->salves_date))}}" class="form-control" readonly>
                            </div> 
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Delivery Date</label>
                                <input type="text" value="{{date('M j Y',strtotime($g_salves->delivery_date))}}" class="form-control" readonly>
                            </div> 
                        </div>  
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Salve Name</label>
                                <input type="text" value="{{ucfirst($g_salves->salve_name)}}" name="salve_name" class="form-control" readonly>                            
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Salve Location</label>
                                <input type="text" value="{{ucfirst($g_salves->salve_location)}}" name="salve_location" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Status</label>
                                <select class="form-control" name="status" id="status" required>
                                    <option value="" disabled selected>--select--</option>
                                    <option value="mumbai">Back to Mumbai</option>
                                    <option value="inactive">Inactive</option>                                
                                </select>
                            </div>
                        </div>                                               
                    </div>
                    <div id="show_on_mumbai" style="display:none">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Back to Mumbai Date</label>
                                    <input type="text" name="back_to_mumbai_date" id="back_to_mumbai_date" class="form-control datepicker">  
                                </div>
                            </div>                        
                            {{-- <div class="col-md-4">
                                <div class="form-group">
                                    <label>Product No.</label>
                                    <input type="text" id="product_no" name="product_no" class="form-control" required>
                                    <span id="check_prod_no" class="text-danger"></span>
                                </div>
                            </div> --}}
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>location Name</label>
                                    <select class="form-control get_khillno_on_change" name="location_id" id="location_id">
                                        <option value="" selected disabled>--select--</option>
                                        @foreach($locations as $location)
                                            <option value="{{$location->id}}">{{$location->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Khilla No</label>
                                    <select class="form-control get_khilla_options" name="khilla_no" id="khilla_no">                                   
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <input type="hidden" method="_PUT">
                    <input name="processing_id" id="processing_id" type="hidden" value="{{$g_salves->processing_id}}">
                    <input name="product_stock_id" id="product_stock_id" type="hidden" value="{{$g_salves->product_stock_id}}">
                    <input name="medical_id" id="medical_id" type="hidden" value="{{$g_salves->medical_id}}">
                    {{-- <input name="processing_date" type="hidden" value="{{$g_salves->processing_date}}">
                    <input name="medical_date" type="hidden" value="{{$g_salves->medical_date}}">
                    <input name="salves_date" type="hidden" value="{{$g_salves->salves_date}}">
                    <input name="delivery_date" type="hidden" value="{{$g_salves->delivery_date}}">
                    <input name="product_id" id="product_id" type="hidden" value="{{$g_salves->product_id}}">
                                        
                    <input name="product_no" id="product_no" type="hidden" value="{{$g_salves->product_no}}"> --}}
                    <button type="submit" class="btn btn-info btn-round" id="insert">Submit</button>
                    <a href="{{config('app.url')}}" class="btn btn-danger btn-round ml-2">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection