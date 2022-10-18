@extends('layouts.app')

@section('title', 'Edit Milk Collection')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card ">
            <div class="card-header">
                <h4 class="card-title">Edit External Collection</h4>
            </div>
            <form action="{{route('milk_collection.update',$collection->id)}}" accept="" role="form" method="post" id="external_collection_edit_form">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Collection Type</label><br>
                                <div class="form-check-radio form-check-inline">
                                    <label class="form-check-label">
                                      <input @if($collection->type == 'given') checked @endif class="form-check-input" type="radio" name="collection_type" id="given" value="given">
                                      Given
                                      <span class="form-check-sign"></span>
                                    </label>
                                </div>
                                <div class="form-check-radio form-check-inline">
                                    <label class="form-check-label">
                                      <input @if($collection->type == 'taken') checked @endif class="form-check-input" type="radio" name="collection_type" id="taken" value="taken">
                                      Taken
                                      <span class="form-check-sign"></span>
                                    </label>
                                </div>
                                <div class="form-check-radio form-check-inline">
                                    <label class="form-check-label">
                                      <input @if($collection->type == 'givenreturn') checked @endif class="form-check-input" type="radio" name="collection_type" id="givenreturn" value="givenreturn">
                                      GivenReturn
                                      <span class="form-check-sign"></span>
                                    </label>
                                </div>
                                <div class="form-check-radio form-check-inline">
                                    <label class="form-check-label">
                                      <input @if($collection->type == 'takenreturn') checked @endif class="form-check-input" type="radio" name="collection_type" id="takenreturn" value="takenreturn">
                                      TakenReturn
                                      <span class="form-check-sign"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Select Customer</label>
                                <select class="form-control" name="party_name" title="Select Customer">
                                    <option value="" selected>--Select--</option>
                                    @foreach ($customers as $customer)
                                        <option @if($collection->party_name == $customer->customer_name) selected @endif value="{{$customer->customer_name}}">{{$customer->customer_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group" >
                                <label>External Party Name</label>
                                <input type="text" name="ext_party_name" value="{{$collection->ext_party_name}}" class="form-control">
                            </div>
                        </div>                   
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Morning</label>
                                <input type="number" name="morning" value="{{$collection->morning}}" class="form-control" step="0.1" min="0">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Evening</label>
                                <input type="number" name="evening" value="{{$collection->evening}}" class="form-control" step="0.1" min="0">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Rate</label>
                                <input type="number" name="rate" value="{{$collection->rate}}" class="form-control" step="0.1" min="0">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Date</label>
                                <input type="text" class="form-control datepicker" name="external_collection_date" value="{{$collection->date}}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Cash</label>
                                <input type="number" class="form-control" value="{{$collection->amount_paid ? $collection->amount_paid : 0}}" name="amount_paid" required>
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