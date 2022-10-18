@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-md-6">
        <div class="card ">
            <div class="card-header">
                <h4 class="card-title">Medical Days 2</h4>
            </div>
            <form action="{{route('days.store')}}" accept="" role="form" method="post">
                @csrf        
                <div class="card-body"> 
                    <div class="form-group">
                        <label>No of Days</label>
                        @if($day->isEmpty())
                            <input type="number" name="medical_days2" class="form-control">
                        @else
                            <input type="number" value="{{$day[0]->medical_days2}}" name="medical_days2" class="form-control">
                        @endif
                        
                    </div>  
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-info btn-round">Submit</button>
                    <input type="hidden" name="medical_id2" value="medical_id2">
                    <a href="{{config('app.url')}}" class="btn btn-danger btn-round ml-2">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection