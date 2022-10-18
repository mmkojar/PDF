@extends('layouts.app')


@section('content')

<div class="row">
  <div class="col-md-12 mx-auto">
    {{-- <div class="card"> --}}
      {{-- <div class="card-body "> --}}
        <div class="card">
            <div class="card-header">            
            @can('all-access')
                <a href="{{route('milk_collection.create')}}" class="btn btn-primary">Add External Collection</a>            
            @endcan
            </div>
            <div class="card-body">
            <table id="external_datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th>Sr.No</th>
                    <th>Date</th>
                    <th>Collection Type</th>
                    <th>Party Name</th>
                    <th>Morning</th>
                    <th>Evening</th>
                    <th>Rate</th>
                    <th>Total Amount</th>
                    <th>Cash</th>
                    @can("all-access")          
                    <th class="disabled-sorting text-right">Actions</th>
                    @endcan
                </tr>
                </thead>               
            </table>
            </div>
        </div>
      {{-- </div> --}}
    {{-- </div> --}}
    {{-- <tbody>
      @foreach($external as $data)
        <tr>
          <td>{{$data->id}}</td>
          <td>{{date('M j Y',strtotime($data->date))}}</td>
          <td>{{$data->type}}</td>
          <td>{{$data->party_name}}</td>
          <td>{{$data->morning}}</td>
          <td>{{$data->evening}}</td>
          <td>{{$data->rate}}</td>
          <td>{{$data->total_amount}}</td>
          <td>{{$data->amount_paid}}</td>
          <td class="text-right">      
            <a href="{{route('milk_collection.edit', $data->id)}}" class="btn btn-sm btn-warning edit"><i class="fa fa-edit"></i></a>
          </td>
        </tr>
      @endforeach
    </tbody>  --}}
  </div>
</div>

@endsection