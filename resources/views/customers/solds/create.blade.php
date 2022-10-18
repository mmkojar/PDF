@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card ">
            {{-- <div class="card-header">
                <h4 class="card-title">Add Data</h4>
            </div> --}}
            <form action="{{route('milk_entries.store')}}" accept="" role="form" method="post" id="milk_sold_form">
                @csrf
                <div class="card-body">
                        <div class="row">
                            {{-- <div class="col-md-6">
                                <div class="form-group">
                                    <label>Customer Type</label>
                                    <select class="form-control" name="customer_type" id="customer_type">                         
                                        <option value="Regular Customer" selected>Regular Customer</option>
                                        <option value="Home Customer">Home Customer</option>
                                        <option value="Normal Customer">Normal Customer</option>
                                    </select>
                                </div>  
                            </div> --}}
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Sold Date</label>
                                    <input type="text" class="form-control datepicker" value="{{$next_date}}" name="sold_date" required>
                                </div>
                            </div>
                        </div>
                        <div class="row my-4">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-5">
                                        <h6 class="float-left">Regular Customer</h6>
                                    </div>
                                    <div class="col-md-7 rme_tag">
                                        <span>Morning</span>
                                        <span>Evening</span>
                                        <span>Rate</span>
                                    </div>
                                </div>
                                <br>
                                @foreach ($customers as $customer)
                                    <div class="row">
                                        <div class="col-md-4">
                                            <p>{{$customer->customer_name}}</p>
                                        </div>
                                        <div class="col-md-8">
                                            <input type="hidden" name="customer_name[]" value="{{$customer->id}}">
                                            <input type="hidden" name="customer_type[]" value="Regular Customer">
                                            <input type="number" value="{{$customer->milk_rate}}" name="milk_rate[]" step="0.1" min="0" class="sold_me_cust_class form-control" required>
                                            <input type="number" value="{{$customer->evening}}" id="evening" name="evening[]" step="0.1" min="0" class="sold_me_cust_class getme_data form-control" required>
                                            <input type="number" value="{{$customer->morning}}" id="morning" name="morning[]" step="0.1" min="0" class="sold_me_cust_class getme_data form-control" required><br>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            {{-- <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-5">
                                        <h6 class="float-left">Home Customer</h6>
                                    </div>
                                    <div class="col-md-7 rme_tag">
                                        <span>Morning</span>
                                        <span>Evening</span>
                                        <span>Rate</span>
                                    </div>
                                </div>
                                <br>
                                @foreach ($customers2 as $customer)
                                    <div class="row">
                                        <div class="col-md-4">
                                            <p>{{$customer->customer_name}}</p>
                                        </div>
                                        <div class="col-md-8">
                                            <input type="hidden" name="customer_name[]" value="{{$customer->id}}">
                                            <input type="hidden" name="customer_type[]" value="{{$customer->customer_type}}">
                                            <input type="number" value="{{$customer->milk_rate}}" name="milk_rate[]" step="0.1" min="0" class="sold_me_cust_class form-control" required>                                    
                                            <input type="number" value="{{$customer->evening}}" id="evening" name="evening[]" step="0.1" min="0" class="sold_me_cust_class getme_data form-control" required>
                                            <input type="number" value="{{$customer->morning}}" id="morning" name="morning[]" step="0.1" min="0" class="sold_me_cust_class getme_data form-control" required><br>
                                        </div>
                                    </div>
                                @endforeach
                            </div> --}}
                            <div class="col-md-6 mt-3"> 
                                <h6 class="float-left">Normal Customer</h6>
                                <table class="table table-striped table-bordered table-responsive-md" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Customer Name</th>
                                            <th>Morning</th>
                                            <th>Evening</th>
                                            <th>Rate</th>
                                            <th width="50px">
                                                <div class="btn btn-sm btn-primary add_nor_cust_rows text-center"><i class="fa fa-plus"></i></div>
                                            </th>                                                        
                                        </tr>
                                    </thead>
                                    <tbody id="append_nor_cust_rows">
                                    </tbody>
                                </table>
                            </div>                            
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Total</label>
                                    <input type="text" class="form-control" id="get_allme_values">
                                </div>                            
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="external_collection"><b>Add External Collection:</b></label>
                                </div>
                                <div class="table-responsive-md" id="external_collection">
                                    <table class="table table-striped table-bordered table-responsive-md" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>Collection Type</th>
                                                <th>Customer</th>
                                                <th>External Party Name</th>
                                                <th>Morning</th>
                                                <th>Evening</th>
                                                <th>Rate</th>
                                                <th>Cash</th>
                                                <th width="50px">
                                                    <div class="btn btn-sm btn-primary add_ext_col_rows text-center"><i class="fa fa-plus"></i></div>
                                                </th>                                                        
                                            </tr>
                                        </thead>
                                        <tbody id="append_ext_col_rows">
                                        </tbody>
                                    </table>     
                                </div>                                                       
                            </div>
                        </div>
                        {{-- <div class="row">                            
                            <div class="col-md-12 hide_on_normal" id="show_select" style="display: none">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input" id="select_on_change" >
                                        <span class="form-check-sign"></span>
                                        Select If Any Change
                                    </label>
                                </div>
                            </div>        
                            <div class="col-md-6 show_on_normal">
                                <div class="form-group">
                                    <label>Customer Name</label>
                                    <input type="text" name="normal_customer_name" id="remove_normal_c_name" class="form-control">
                                </div>
                            </div>                                                
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Rate</label>
                                    <input type="number" id="milk_rate" name="milk_rate" step="0.1" min="0" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Morning</label>
                                    <input type="number" id="morning" name="morning" step="0.1" min="0" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Evening</label>
                                    <input type="number" id="evening" name="evening" step="0.1" min="0" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6 show_on_normal">
                                <div class="form-group">
                                    <label>Amount Paid</label>
                                    <input type="number" name="amount_paid" id="remove_amount_paid" step="0.1" class="form-control">
                                </div>
                            </div>
                        </div> --}}
                        {{-- <div class="form-group">
                            <label>Pending Amount</label>
                            <input type="text" name="pending_amount"  class="form-control">
                        </div>       --}}
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