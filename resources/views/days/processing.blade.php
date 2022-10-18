@extends('layouts.app')


@section('content')

<div class="row">
    <div class="col-md-4 col-sm-6">
        <div class="card blue-bgcolor">
            <div class="card-header">
                <h4 class="card-title">Processing Days</h4>
            </div>
            <form action="{{route('days.store')}}" accept="" role="form" method="post">
                @csrf        
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label>No of Days</label>
                                <input type="number" value="{{$day[0]->processing_days}}" name="processing_days" class="form-control">                        
                            </div> 
                        </div>
                        <div class="col-6">
                            <div class="form-group mt-3">
                                @can('all-access')
                                    <button type="submit" class="btn btn-info btn-round">Update</button>
                                @endcan
                                <input type="hidden" name="hidden_id" value="{{$day[0]->id}}">
                                <input type="hidden" name="processing_id" value="processing_id">
                            </div> 
                        </div>
                    </div>                    
                </div>
            </form>
        </div>
    </div>
    <div class="col-md-4 col-sm-6">
        <div class="card green-bgcolor">
            <div class="card-header">
                <h4 class="card-title">Medical Days</h4>
            </div>
            <form action="{{route('days.store')}}" accept="" role="form" method="post">
                @csrf        
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label>No of Days</label>                      
                                <input type="number" value="{{$day[0]->medical_days1}}" name="medical_days1" class="form-control">
                            </div> 
                        </div>
                        <div class="col-6">
                            <div class="form-group mt-3">
                                @can('all-access')
                                    <button type="submit" class="btn btn-info btn-round">Update</button>
                                @endcan    
                                <input type="hidden" name="hidden_id" value="{{$day[0]->id}}">
                                <input type="hidden" name="medical_id1" value="medical_id1">
                            </div> 
                        </div>
                    </div> 
                </div>
            </form>
        </div>
    </div>
    <div class="col-md-4 col-sm-6">
        <div class="card red-bgcolor">
            <div class="card-header">
                <h4 class="card-title">Days in Salves</h4>
            </div>
            <form action="{{route('days.store')}}" accept="" role="form" method="post">
                @csrf        
                <div class="card-body"> 
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label>No of Days</label>                        
                                <input type="number" value="{{$day[0]->days_in_salves}}" name="days_in_salves" class="form-control">                       
                            </div>  
                        </div>
                        <div class="col-6">
                            <div class="form-group mt-3">
                                @can('all-access')
                                    <button type="submit" class="btn btn-info btn-round">Update</button>
                                @endcan    
                                <input type="hidden" name="hidden_id" value="{{$day[0]->id}}">
                                <input type="hidden" name="salves_id" value="salves_id">
                            </div> 
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection