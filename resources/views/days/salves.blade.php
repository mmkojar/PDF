@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-md-6">
        <div class="card ">
            <div class="card-header">
                <h4 class="card-title">Days in Salve</h4>
            </div>
            <form action="{{route('days.store')}}" accept="" role="form" method="post">
                @csrf        
                <div class="card-body"> 
                    <div class="form-group">
                        <label>No of Days</label>
                        @if($day->isEmpty())
                            <input type="number" name="days_in_salves" class="form-control">
                        @else
                            <input type="number" value="{{$day[0]->days_in_salves}}" name="days_in_salves" class="form-control">
                        @endif
                        
                    </div>  
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-info btn-round">Submit</button>
                    <input type="hidden" name="salves_id" value="salves_id">
                    <a href="{{config('app.url')}}" class="btn btn-danger btn-round ml-2">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection