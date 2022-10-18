@extends('layouts.app')

@section('content')
<?php $main_count = 1; ?>
<div class="row">
   <div class="col-md-12">
      
      <ul class="nav nav-pills nav-pills-primary nav-pills-icons justify-content-center" role="tablist">    
         <li class="nav-item">
           <a class="nav-link active" data-toggle="tab" href="#bills" role="tablist">
             <i class="now-ui-icons shopping_shop"></i>
             Bills
           </a>
         </li>         
         <li class="nav-item">
           <a class="nav-link" data-toggle="tab" href="#amount" role="tablist">
             <i class="now-ui-icons shopping_shop"></i>
             Amount
           </a>
         </li> 
       </ul>
       <div class="tab-content tab-space tab-subcategories">    

         <div class="tab-pane active" id="bills">
           <div class="card">
             <div class="card-header">
               @can('all-access')
                  @if(count($total_billings) > 0)
                     <button type="button" class="btn btn-primary" id="open_cash_modal">Cash Entry</button>
                  @endif
                  <a href="{{route('billing.create')}}" class="btn btn-primary">Create Invoice</a>
               @endcan
             </div>
             <div class="card-body">
                  <?php $count=1 ?>
                  @if(count($total_billings) > 0)
                  <table id="week_billing_datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                     <thead>
                        <tr>
                           <th>Sr.No</th>
                           @can('all-access')
                              <th>Print</th>
                           @endcan
                           <th>Customer Name</th>
                           <th>Bill No</th>                  
                           <th>Total litres</th>
                           <th>Dates</th>
                           <th>Amount</th>
                           <th>Previous Balance</th>
                           <th>Total Amount</th>
                           <th>Amount Paid</th>
                           <th>Remaining Balance</th>
                           <th>Adjusted</th>
                           <th>Created At</th>
                           <th>Updated At</th>
                           @can('all-access')
                           <th class="disabled-sorting text-right">Actions</th>
                           @endcan
                        </tr>
                     </thead>
                     <tbody>
                        @foreach($total_billings as $weekly_billing)
                        <tr>
                           <td>{{$count}}</td>
                           @can('all-access')
                              <td><a class="btn btn-sm btn-primary" bill_type="{{$weekly_billing->bill_period}}" bill_id="{{$weekly_billing->id}}" bno="{{$weekly_billing->bill_no}}" cid="{{$weekly_billing->customer_id}}" cname="{{$weekly_billing->customer_name}}" fdate="{{$weekly_billing->from_date}}" tdate="{{$weekly_billing->to_date}}" 
                                 id="open_print_modal"><i class="fa fa-print"></i></a>
                              </td>
                           @endcan
                           <td>{{$weekly_billing->customer_name}}</td>
                           <td>{{$weekly_billing->bill_no}}</td>                        
                           <td>{{$weekly_billing->total_litres}}</td>
                           <td><a id="open_cash_modals" fdate="{{$weekly_billing->from_date}}" tdate="{{$weekly_billing->to_date}}">{{date('M j Y',strtotime($weekly_billing->from_date)).' to '.date('M j Y',strtotime($weekly_billing->to_date))}}</a></td>
                           <td>{{$weekly_billing->amount}}</td>
                           <td>{{$weekly_billing->previous_balance}}</td>
                           <td>{{$weekly_billing->total_amount}}</td>
                           <td>{{$weekly_billing->amount_paid ? $weekly_billing->amount_paid : 0}}</td>
                           <td>{{$weekly_billing->pending_amount ? $weekly_billing->pending_amount : 0}}</td>
                           <td>{{$weekly_billing->adjusted ? $weekly_billing->adjusted : 0}}</td>
                           <td>{{date('M j Y',strtotime($weekly_billing->created_at))}}</td>
                           <td>{{$weekly_billing->updated_at ? date('M j Y',strtotime($weekly_billing->updated_at)) : '-'}}</td>
                           @can('all-access')
                           <td class="text-right">
                              <a id="{{$weekly_billing->id}}" class="btn btn-sm text-white btn-danger delete_all" url="billing" tbname="weekly_billing"><i class="fa fa-trash"></i></a>                    
                              <a href="{{route('billing.edit', $weekly_billing->id)}}" class="btn btn-sm btn-warning edit"><i class="fa fa-edit"></i></a>                    
                           </td>
                           @endcan
                        </tr>
                        <?php $count++ ?>
                        @endforeach
                     </tbody>
                  </table>
                  @endif
             </div>
           </div>  
           
            <!-- Print Modal -->
            <div class="modal fade" id="print_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
               <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
                  <div class="modal-content">
                     <div class="modal-header">
                        <button class="btn btn-success" id="invoice-print"><i class="fa fa-print"></i> Print Invoice</button>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                     </div>
                     <div class="modal-body">
                        <div class="card" id="get_billing_detail">
                           <div class="card-body">
                              <div id="get_billing_table">
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>

            <!-- Cash Modal -->
            <div class="modal fade" id="cash_modal" tabindex="-1" aria-labelledby="cash_modalLabel" aria-hidden="true">
               <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
                  <div class="modal-content">
                     <div class="modal-header">
                        <h3 class="mb-0">Cash Entry</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                           <span aria-hidden="true">&times;</span>
                        </button>
                     </div>
                     <div class="modal-body" style="padding:0.5rem">
                        <div class="card">
                              <form action="" accept="" role="form" method="post" id="cash_entry_form">
                                 @csrf        
                                 <div class="card-body">
                                         {{-- <div class="row">                                             
                                             <div class="col-md-6">
                                                 <div class="form-group">
                                                     <label>From Date</label>
                                                     <input type="text" class="form-control datepicker" name="from_date" required>
                                                 </div>
                                             </div>
                                             <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>To Date</label>
                                                    <input type="text" class="form-control datepicker" name="to_date" required>
                                                </div>
                                            </div>
                                         </div> --}}
                                         <div class="row" id="billing_paginate_data">
                                             <!-- {{-- @include('billings.paginate')--}} -->
                                                   
                                             <div class="col-md-12 pagination">
                                                <!-- {{-- {{ $weekly_billings_for_cash->links() }} --}} -->
                                             </div>
                                         </div>                                                                                 
                                 </div>
                                 <div class="card-footer">
                                     <button type="submit" class="btn btn-info btn-round" id="submit_cash_entry">Submit</button>
                                     <a href="{{config('app.url')}}/billing" class="btn btn-danger btn-round ml-2">Cancel</a>
                                 </div>
                              </form>
                        </div>
                     </div>
                  </div>
               </div>
            </div>               
            
            {{-- All Billing --}}
            <h4>Total Billing</h4>
            <div class="card">
               <div class="card-body">
                    <table id="total_billing_datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">

                    </table>
               </div>
            </div>

            {{-- Total Billing Modal --}}
            <div class="modal fade" id="total_billing_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
               <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
                  <div class="modal-content">
                     <div class="modal-header">
                        <button class="btn btn-success" id="invoice-print1"><i class="fa fa-print"></i> Print Invoice</button>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                     </div>
                     <div class="modal-body">
                        <div class="card">
                           <div class="card-body">
                              <div id="get_total_billing_detail">
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>

            <!-- {{-- <h4>Weekly</h4>
            <div class="card">
               <div class="card-body">
                    <?php //$count=1 ?>
                    @if(count($weekly_billings_all) > 0)
                    <table id="datatable1" class="table table-striped table-bordered" cellspacing="0" width="100%">
                       <thead>
                          <tr>
                             <th>Sr.No</th>
                             @can('all-access')
                                <th>Print</th>
                                @endcan
                             <th>From Date</th>
                             <th>To Date</th>
                             <th>Total litres</th>
                             <th>Amount</th>
                             <th>Previous Balance</th>
                             <th>Total Amount</th>
                             <th>Amount Paid</th>
                             <th>Remaining Balance</th>
                             <th>Adjusted</th>
                             <th>Created At</th>
                             <th>Updated At</th>
                          </tr>
                       </thead>
                       <tbody>
                          @foreach($weekly_billings_all as $data)
                          <tr>
                             <td>{{$count}}</td>
                             @can('all-access')
                                <td><a class="btn btn-sm btn-primary" main_count="{{$main_count++}}" wm-data="weekly" fdate="{{$data->from_date}}" tdate="{{$data->to_date}}" 
                                   id="open_print_modal1"><i class="fa fa-print"></i></a> 
                                </td>
                             @endcan
                             <td>{{date('M j Y',strtotime($data->from_date))}}</td>
                             <td>{{date('M j Y',strtotime($data->to_date))}}</td>
                             <td>{{$data->total_litres}}</td>
                             <td>{{$data->amount}}</td>
                             <td>{{$data->previous_balance}}</td>
                             <td>{{$data->total_amount}}</td>
                             <td>{{$data->amount_paid ? $data->amount_paid : 0}}</td>
                             <td>{{($data->total_amount)-($data->amount_paid+$data->adjusted)}}</td>
                             <td>{{$data->adjusted ? $data->adjusted : 0}}</td>
                             <td>{{date('M j Y',strtotime($data->created_at))}}</td>
                             <td>{{$data->updated_at ? date('M j Y',strtotime($data->updated_at)) : '-'}}</td>                            
                          </tr>
                          <?php //$count++ ?>
                          @endforeach
                       </tbody>
                    </table>
                    @else
                    <p>No Data Found</p>
                    @endif
               </div>
            </div>
             <h4>Monthly</h4>
            <div class="card">
               <div class="card-body">
                    <?php //$count=1 ?>
                    @if(count($monthly_billings_all) > 0)
                    <table id="datatable1" class="table table-striped table-bordered" cellspacing="0" width="100%">
                       <thead>
                          <tr>
                             <th>Sr.No</th>
                             @can('all-access')
                                <th>Print</th>
                                @endcan
                             <th>From Date</th>
                             <th>To Date</th>
                             <th>Total litres</th>
                             <th>Amount</th>
                             <th>Previous Balance</th>
                             <th>Total Amount</th>
                             <th>Amount Paid</th>
                             <th>Remaining Balance</th>
                             <th>Adjusted</th>
                             <th>Created At</th>
                             <th>Updated At</th>
                          </tr>
                       </thead>
                       <tbody>
                          @foreach($monthly_billings_all as $data)
                          <tr>
                             <td>{{$count}}</td>
                             @can('all-access')
                                <td><a class="btn btn-sm btn-primary" main_count="{{$main_count++}}" wm-data="monthly" fdate="{{$data->from_date}}" tdate="{{$data->to_date}}" 
                                   id="open_print_modal1"><i class="fa fa-print"></i></a>
                                </td>
                             @endcan
                             <td>{{date('M j Y',strtotime($data->from_date))}}</td>
                             <td>{{date('M j Y',strtotime($data->to_date))}}</td>
                             <td>{{$data->total_litres}}</td>
                             <td>{{$data->amount}}</td>
                             <td>{{$data->previous_balance}}</td>
                             <td>{{$data->total_amount}}</td>
                             <td>{{$data->amount_paid ? $data->amount_paid : 0}}</td>
                             <td>{{($data->total_amount)-($data->amount_paid+$data->adjusted)}}</td>
                             <td>{{$data->adjusted ? $data->adjusted : 0}}</td>
                             <td>{{date('M j Y',strtotime($data->created_at))}}</td>
                             <td>{{$data->updated_at ? date('M j Y',strtotime($data->updated_at)) : '-'}}</td>                            
                          </tr>
                          <?php //$count++ ?>
                          @endforeach
                       </tbody>
                    </table>
                    @else
                    <p>No Data Found</p>
                    @endif
               </div>
            </div>                         
            <div class="modal fade" id="print_modal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
               <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
                  <div class="modal-content">
                     <div class="modal-header">
                        <button class="btn btn-success" id="invoice-print1"><i class="fa fa-print"></i> Print Invoice</button>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                     </div>
                     <div class="modal-body">
                        <div class="card" id="get_billing_detail">
                           <div class="card-body">
                              <div id="get_billing_table1">
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div> --}} -->
         </div>
         
        
         <div class="tab-pane" id="amount">
           <div class="card">
             <div class="card-header">
                 <a></a>
             </div>
             <div class="card-body">
               <?php $count=1 ?>
               <table id="datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                 <thead>
                   <tr>
                     <th>Sr.No</th>
                     <th>Customer Name</th>
                     <th>Bill No</th>
                     <th>Amount Paid</th>
                     <th>Bill Period</th>
                     <th>Date</th>
                     @can('all-access')
                     <th>Action</th>
                     @endcan
                   </tr>
                 </thead>
                 <tbody>
                   @foreach($amount_paid_data as $data)
                     <tr>
                       <td>{{$count}}</td>
                       <td>{{$data->customer_name}}</td>
                       <td>{{$data->bill_no}}</td>
                       <td>{{$data->amount}}</td>
                       <td>{{$data->from_to_date}}</td>
                       <td>{{$data->date ? date('M j Y',strtotime($data->date)) : '-'}}</td>                      
                       @can('all-access')
                           <td class="text-center">
                              <a id="{{$data->id}}" class="btn btn-sm text-white btn-danger delete_all" url="billing" tbname="wekkly_billing_pending_amount"><i class="fa fa-trash"></i></a>
                           </td>
                           @endcan
                     </tr>
                     <?php $count++ ?>
                   @endforeach
                 </tbody>
               </table>
             </div>
           </div>                
         </div>                
       </div>
   </div>
</div>

@endsection