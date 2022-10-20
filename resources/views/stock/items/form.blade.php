@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">{{isset($item->id) ? 'Edit' : 'Add'}} Items</h4>
            </div>
            <form action="{{route('stock.items.store')}}" accept="" role="form" method="post">
                @csrf        
                <div class="card-body">                  
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" class="form-control"  
                                value="{{isset($item->name) ? $item->name : ''}}" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <input type="hidden" name="hidden_id" value="{{isset($item->id) ? $item->id : ''}}">
                    <button type="submit" class="btn btn-info btn-round">Submit</button>
                    <a href="{{config('app.url')}}/stock" class="btn btn-danger btn-round ml-2">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection