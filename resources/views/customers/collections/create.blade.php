@extends('layouts.app')

@section('content')


<div class="row">
    <div class="col-md-12">
        <div class="card ">
            <div class="card-header">
                <h4 class="card-title">Add External Collection</h4>
            </div>
            <form action="{{route('milk_collection.store')}}" accept="" role="form" method="post" id="milk_collection_form">
                @csrf        
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Collection Type</label><br>
                                <div class="form-check-radio form-check-inline">
                                    <label class="form-check-label">
                                      <input class="form-check-input" type="radio" name="collection_type" id="given" value="given">
                                      Given
                                      <span class="form-check-sign"></span>
                                    </label>
                                </div>
                                <div class="form-check-radio form-check-inline">
                                    <label class="form-check-label">
                                      <input class="form-check-input" type="radio" name="collection_type" id="taken" value="taken">
                                      Taken
                                      <span class="form-check-sign"></span>
                                    </label>
                                </div>
                                <div class="form-check-radio form-check-inline">
                                    <label class="form-check-label">
                                      <input class="form-check-input" type="radio" name="collection_type" id="givenreturn" value="givenreturn">
                                      GivenReturn
                                      <span class="form-check-sign"></span>
                                    </label>
                                </div>
                                <div class="form-check-radio form-check-inline">
                                    <label class="form-check-label">
                                      <input class="form-check-input" type="radio" name="collection_type" id="takenreturn" value="takenreturn">
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
                                        <option value="{{$customer->customer_name}}">{{$customer->customer_name}}</option>
                                    @endforeach
                                </select>
                            </div> 
                        </div>
                        <div class="col-md-6">
                            <div class="form-group" >
                                <label>External Party Name</label>
                                <input type="text" name="ext_party_name" class="form-control">
                            </div>                            
                        </div>                   
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Morning</label>
                                <input type="number" name="morning" class="form-control" step="0.1" min="0" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Evening</label>
                                <input type="number" name="evening" class="form-control" step="0.1" min="0" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Rate</label>
                                <input type="number" name="rate" class="form-control" step="0.1" min="0" required>
                            </div>
                        </div>                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Date</label>
                                <input type="text" class="form-control datepicker" name="external_collection_date" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Cash</label>
                                <input type="number" class="form-control" name="amount_paid" required>
                            </div>
                        </div> 
                    </div>      
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-info btn-round">Submit</button>
                    <a href="{{config('app.url')}}/milk_entries" class="btn btn-danger btn-round ml-2">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection