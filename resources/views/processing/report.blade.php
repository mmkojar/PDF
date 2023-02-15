@extends('layouts.app')

@section('content')

<div class="row">
  <div class="col-md-12 mx-auto">
    <div class="card">
      <div class="card-body ">       
          <?php $count=1 ?>
          {{-- @if(count($reports) > 0) --}}
              <table id="datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                  <thead>
                      <tr>
                        <th>Sr.No</th>
                        <th>Status</th>
                        <th>Product Name</th>
                        <th>Product No.</th>
                        <th>Processing Date</th>
                        <th>Actual Or Further Processing Date</th>
                        {{-- <th>Is Processed Or Not</th> --}}
                        <th>Process Note</th>
                        <th>Medical Date</th>
                        <th>Acutal Medical Date</th>                      
                        <th>Delivery Date</th>
                        <th>Is Pregnant Or Not</th>
                        <th>Back to Process From Medical Date</th>
                        <th>Medical Note</th>
                        <th>Salve Name</th>
                        <th>Salve Location</th>
                        <th>Salve Date</th>
                        <th>Back to Process Note</th>
                        <th>Back to Process Date</th>
                        <th>Back to Mumbai Date</th>
                      </tr>
                  </thead>
                  <tbody>
                      @foreach($reports as $report)
                      <tr>
                        <td>{{$count}}</td>
                        <td class="badge m-3 {{$report->status == 'completed' ? 'badge-success' : 'badge-info'}}">{{$report->status ? $report->status : '-'}}</td>
                        <td>{{ucfirst($report->product_name)}}</td>
                        <td>{{ucfirst($report->product_name)}} {{$report->product_no}}</td>
                        <td>{{$report->processing_date ?  date('M j Y',strtotime($report->processing_date)) : ''}}</td>
                        <td>{{$report->actual_or_further_processing_date ?  date('M j Y',strtotime($report->actual_or_further_processing_date)) : ''}}</td>
                        {{-- <td>{{$report->is_processed_or_not}}</td> --}}
                        <td>{{$report->process_note}}</td>
                        <td>{{$report->medical_date ?  date('M j Y',strtotime($report->medical_date)) : ''}}</td>
                        <td>{{$report->actual_medical_date ?  date('M j Y',strtotime($report->actual_medical_date)) : ''}}</td>
                        <td>{{$report->delivery_date ?  date('M j Y',strtotime($report->delivery_date)) : ''}}</td>
                        <td>{{$report->is_pregnant_or_not}}</td>
                        <td>{{$report->back_to_process_date_from_medical ?  date('M j Y',strtotime($report->back_to_process_date_from_medical)) : ''}}</td>
                        <td>{{$report->medical_note}}</td>
                        <td>{{$report->salve_name}}</td>
                        <td>{{$report->salve_location}}</td>
                        <td>{{$report->salves_date ?  date('M j Y',strtotime($report->salves_date)) : ''}}</td>
                        <td>{{$report->back_to_process_note}}</td>
                        <td>{{$report->back_to_process_date ? date('M j Y',strtotime($report->back_to_process_date)) : ''}}</td>
                        <td>{{$report->back_to_mumbai_date ? date('M j Y',strtotime($report->back_to_mumbai_date)) : ''}}</td>
                      </tr>  
                      <?php $count++ ?>            
                      @endforeach                      
                  </tbody>
              </table>
          {{-- @endif               --}}
      </div>
    </div>
  </div>
</div>


@endsection