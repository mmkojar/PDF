@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card ">
            <div class="card-header">
                <h4 class="card-title">Edit Salves</h4>
            </div>
            <form action="{{route('salves.update',$salve->id)}}" accept="" role="form" method="post">
                @csrf        
                <div class="card-body">      
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Location</label>
                                <input type="text" value="{{$salve->location}}" name="location" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Description</label>
                                <input type="text" value="{{$salve->description}}" name="description" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Salves Name</label>
                                <input type="text" value="{{$salve->salve_name}}" name="salve_name" class="form-control" required>
                            </div> 
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Contact Person</label>
                                <input type="text" value="{{$salve->contact_person}}"  name="contact_person" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Mobile No.</label>
                                <input type="number" value="{{$salve->mobile_no}}" name="mobile_no" class="form-control" required>
                            </div>
                        </div>
                        {{-- <div class="col-md-6">
                            <div class="form-group">
                                <label>No. Of Days</label>
                                <input type="text" value="{{$salve->no_of_days}}" name="no_of_days" class="form-control">
                            </div>
                        </div> --}}
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