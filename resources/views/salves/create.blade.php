@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card ">
            <div class="card-header">
                <h4 class="card-title">Add Salves</h4>
            </div>
            <form action="{{route('salves.store')}}" accept="" role="form" method="post">
                @csrf        
                <div class="card-body">                  
                    <div class="row">                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Location</label>
                                <input type="text" name="location" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Description</label>
                                <input type="text" name="description" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Salves Name</label>
                                <input type="text" name="salve_name" class="form-control" required>
                            </div> 
                        </div>                    
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Contact Person</label>
                                <input type="text" name="contact_person" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Mobile No.</label>
                                <input type="number" name="mobile_no" class="form-control" required>
                            </div>
                        </div>
                        {{-- <div class="col-md-6">
                            <div class="form-group">
                                <label>No. Of Days</label>
                                <input type="text" name="no_of_days" class="form-control" required>
                            </div>
                        </div> --}}
                    </div>                                                
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-info btn-round">Submit</button>
                    <a href="{{config('app.url')}}/salves" class="btn btn-danger btn-round ml-2">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection