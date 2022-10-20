@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card ">
            <div class="card-header">
                <h4 class="card-title">Edit Employee</h4>
            </div>
            <form action="{{route('employee.update',$employee->id)}}" accept="" role="form" method="post">
                @csrf        
                <div class="card-body">               
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" value="{{$employee->name}}" name="name" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Mobile No.</label>
                                    <input type="text" value="{{$employee->mobile_no}}" name="mobile_no" class="form-control" maxlength="10" minlength="10" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Location</label>
                                    <input type="text" value="{{$employee->location}}" name="location" class="form-control" required>
                                </div>
                            </div>                           
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Salary</label>
                                    <input type="text" value="{{$employee->salary}}" name="salary" class="form-control" required>
                                </div>
                            </div>      
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Select Status</label>
                                    <select class="form-control" name="status" required>                        
                                        <option @if($employee->status == 'active') checked @endif value="active">Active</option>
                                        <option @if($employee->status == 'inactive') checked @endif value="inactive">Inactive</option>
                                    </select>
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