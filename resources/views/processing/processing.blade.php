@extends('layouts.app')

@section('content')

<div class="alert alert-danger alert-dismissible fade d-none show" id="process_alert" role="alert">
  <strong></strong>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">×</span>
  </button>
</div>
<?php $process_datetd = '';$process_datepd = '';$process_dateex = ''; ?>
<div class="row">
  <div class="col-md-12 mx-auto">
    <div class="card card-plain card-subcategories">
      <div class="card-body ">
        <ul class="nav nav-pills nav-pills-primary nav-pills-icons justify-content-center" role="tablist">    
          <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#today" role="tablist">
              <i class="now-ui-icons shopping_shop"></i>
              Today's
            </a>
          </li>      
          <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#pending" role="tablist">
              <i class="now-ui-icons shopping_shop"></i>
              Pending
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#expire" role="tablist">
              <i class="now-ui-icons ui-2_settings-90"></i>
              Expire
            </a>
          </li>
        </ul>
        <div class="tab-content tab-space tab-subcategories">      
          
          <div class="tab-pane active" id="today">
            <div class="card">
              <div class="card-body">
                <?php $count=1 ?>
                @if(count($pending_processess) > 0)
                <div class="table-responsive">
                  <form action="{{route('processing.store')}}" accept="" role="form" method="post" id="processing_form">
                  @csrf 
                    <table id="datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th>Select</th>
                          <th>Sr.No</th>
                          <th>Product Name</th>
                          <th>Product No.</th>
                          <th>Purchase Date</th>
                          <th>Processing Date</th>
                          <th>Processed Or Not</th>
                          <th>Actual/Further Processing Date</th>
                          <th>Note</th>
                        </tr>
                      </thead>
                      <tbody>
                          @foreach($pending_processess as $process)
                            <?php 
                            if($process->no_of_process <= 1) {
                              $date1 = str_replace('-', '/', $process->purchase_date);
                              $newdate = date('Y-m-d',strtotime($date1 . +$process_days[0]->processing_days."days"));
                              $process_date = date('M j Y',strtotime($newdate));
                            }
                            else {
                              $process_date = $process->newpdate;
                            }
                            ?>            
                            @if(strtotime(date('Y-m-d')) == strtotime($process_date))
                            <?php $process_datetd = $process_date ?>
                              <tr class="{{$process->status == 'inactive' ? 'red-bgcolor' : ''}}">
                                  <td><input type="checkbox" name="select_process[{{$process->id}}]" class="select_process" value="{{$process->id}}" {{$process->status == 'inactive' ? 'disabled' : ''}}></td>
                                  <td>{{$count}}</td>
                                  <td><input type="hidden" name="product_id[{{$process->id}}]" class="product_id" value="{{$process->product_id}}">{{$process->product_name}}</td>
                                  <td><input type="hidden" name="product_stock_id[{{$process->id}}]" class="product_stock_id" value="{{$process->id}}">{{$process->product_name}} {{$process->product_no}}</td>
                                  <td><input type="hidden" name="purchase_date[{{$process->id}}]" class="purchase_date" value="{{$process->purchase_date}}">{{date('M j Y',strtotime($process->purchase_date))}}</td>
                                  <td>
                                    <?php   
                                    if($process->no_of_process <= 1) {
                                      echo $process_date;
                                      echo '<input type="hidden" name="processing_date['.$process->id.']" class="processing_date" value="'.$newdate.'">';
                                    } 
                                    else {
                                      $newprocess_date = date('M j Y',strtotime($process->newpdate)); 
                                      echo $newprocess_date;                                                    
                                      echo '<input type="hidden" name="processing_date['.$process->id.']" class="processing_date" value="'.$process->newpdate.'">';
                                    }                                   
                                    ?>
                                  </td>
                                  <td>
                                    <select name="is_processed_or_not[{{$process->id}}]" class="is_processed_or_not" {{$process->status == 'inactive' ? 'disabled' : ''}}>                              
                                      <option value="yes">Want to process</option>
                                      <option  value="no">Not</option>
                                    </select>
                                  </td>
                                  <td>
                                    <input type="text" name="actual_or_further_processing_date[{{$process->id}}]" value="{{$process->afdate ? $process->afdate : ''}}" class="afdate form-control datepicker" {{$process->status == 'inactive' ? 'disabled' : ''}}></td>
                                  <td>
                                    <input type="text" name="note[{{$process->id}}]" value="{{$process->note ? $process->note : ''}}" class="note form-control" {{$process->status == 'inactive' ? 'disabled' : ''}}>
                                  </td>
                                  <input type="hidden" name="product_no[{{$process->id}}]" value="{{$process->product_no}}">
                                  <input type="hidden" name="prid[{{$process->id}}]" value="{{$process->prrid}}">
                              </tr>                              
                              <?php $count++ ?>    
                            @endif        
                          @endforeach                  
                      </tbody>                           
                    </table>
                    @if(strtotime(date('Y-m-d')) == strtotime($process_datetd))
                      <button type="submit" class="btn btn-info btn-round p_submit">Submit</button> 
                    @endif
                  </form>
                </div>
                @endif
              </div>
            </div>
          </div>
          
          <div class="tab-pane" id="pending">
            <div class="card">
              <div class="card-body">
                <?php $count=1 ?>
                @if(count($pending_processess) > 0)
                <div class="table-responsive">
                  <form action="{{route('processing.store')}}" accept="" role="form" method="post" id="processing_form">
                  @csrf 
                    <table id="datatable1" class="table table-striped table-bordered" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th>Select</th>
                          <th>Sr.No</th>
                          <th>Product Name</th>
                          <th>Product No.</th>
                          <th>Purchase Date</th>
                          <th>Processing Date</th>
                          <th>Processed Or Not</th>
                          <th>Actual/Further Processing Date</th>
                          <th>Note</th>
                        </tr>
                      </thead>
                      <tbody>
                          @foreach($pending_processess as $process)
                            <?php 
                            if($process->no_of_process <= 1) {
                              $date1 = str_replace('-', '/', $process->purchase_date);
                              $newdate = date('Y-m-d',strtotime($date1 . +$process_days[0]->processing_days."days"));
                              $process_date = date('M j Y',strtotime($newdate));
                            }
                            else {
                              $process_date = $process->newpdate;
                            }
                            ?>            
                            @if(strtotime(date('Y-m-d')) < strtotime($process_date))
                              <?php $process_datepd = $process_date ?>
                              <tr class="{{$process->status == 'inactive' ? 'red-bgcolor' : ''}}">
                                  <td><input type="checkbox" name="select_process[{{$process->id}}]" class="select_process" value="{{$process->id}}" {{$process->status == 'inactive' ? 'disabled' : ''}}></td>
                                  <td>{{$count}}</td>
                                  <td><input type="hidden" name="product_id[{{$process->id}}]" class="product_id" value="{{$process->product_id}}">{{$process->product_name}}</td>
                                  <td><input type="hidden" name="product_stock_id[{{$process->id}}]" class="product_stock_id" value="{{$process->id}}">{{$process->product_name}} {{$process->product_no}}</td>
                                  <td><input type="hidden" name="purchase_date[{{$process->id}}]" class="purchase_date" value="{{$process->purchase_date}}">{{date('M j Y',strtotime($process->purchase_date))}}</td>
                                  <td>
                                    <?php   
                                    if($process->no_of_process <= 1) {
                                      echo $process_date;
                                      echo '<input type="hidden" name="processing_date['.$process->id.']" class="processing_date" value="'.$newdate.'">';
                                    } 
                                    else {
                                      $newprocess_date = date('M j Y',strtotime($process->newpdate)); 
                                      echo $newprocess_date;                                                    
                                      echo '<input type="hidden" name="processing_date['.$process->id.']" class="processing_date" value="'.$process->newpdate.'">';
                                    }                                   
                                    ?>
                                  </td>
                                  <td>
                                    <select name="is_processed_or_not[{{$process->id}}]" class="is_processed_or_not" {{$process->status == 'inactive' ? 'disabled' : ''}}>                              
                                      <option value="yes">Want to process</option>
                                      <option  value="no">Not</option>
                                    </select>
                                  </td>
                                  <td>
                                    <input type="text" name="actual_or_further_processing_date[{{$process->id}}]" value="{{$process->afdate ? $process->afdate : ''}}" class="afdate form-control datepicker" {{$process->status == 'inactive' ? 'disabled' : ''}}></td>
                                  <td>
                                    <input type="text" name="note[{{$process->id}}]" value="{{$process->note ? $process->note : ''}}" class="note form-control" {{$process->status == 'inactive' ? 'disabled' : ''}}>
                                  </td>
                                  <input type="hidden" name="product_no[{{$process->id}}]" value="{{$process->product_no}}">
                                  <input type="hidden" name="prid[{{$process->id}}]" value="{{$process->prrid}}">
                              </tr>                              
                              <?php $count++ ?>    
                            @endif        
                          @endforeach                  
                      </tbody>                           
                    </table>
                    @if(strtotime(date('Y-m-d')) < strtotime($process_datepd))
                    <button type="submit" class="btn btn-info btn-round p_submit">Submit</button> 
                    @endif
                  </form>
                </div>
                @endif
              </div>
            </div>
          </div>
          <div class="tab-pane" id="expire">
            <div class="card">
              <div class="card-body">
                <?php $count=1 ?>
                @if(count($pending_processess) > 0)
                <div class="table-responsive">
                  <form action="{{route('processing.store')}}" accept="" role="form" method="post" id="processing_form">
                    @csrf  
                    <table id="datatable2" class="table table-striped table-bordered" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th>Select</th>
                          <th>Sr.No</th>
                          <th>Product Name</th>
                          <th>Product No.</th>
                          <th>Purchase Date</th>
                          <th>Processing Date</th>
                          <th>Processed Or Not</th>
                          <th>Actual/Further Processing Date</th>
                          <th>Note</th>
                        </tr>
                      </thead>
                      <tbody>
                          @foreach($pending_processess as $process)              
                            <?php 
                              if($process->no_of_process <= 1) {
                                $date1 = str_replace('-', '/', $process->purchase_date);
                                $newdate = date('Y-m-d',strtotime($date1 . +$process_days[0]->processing_days."days"));
                                $process_date = date('M j Y',strtotime($newdate));                              
                              }
                              else {
                                $process_date = $process->newpdate;
                              }              
                            ?>            
                              @if(strtotime(date('Y-m-d')) > strtotime($process_date))          
                              <?php $process_dateex = $process_date ?>
                              <tr class="{{$process->status == 'inactive' ? 'red-bgcolor' : ''}}">                                  
                                  <td><input type="checkbox" name="select_process[{{$process->id}}]" class="select_process" value="{{$process->id}}" {{$process->status == 'inactive' ? 'disabled' : ''}}></td>
                                  <td>{{$count}}</td>
                                  <td><input type="hidden" name="product_id[{{$process->id}}]" class="product_id" value="{{$process->product_id}}">{{$process->product_name}}</td>
                                  <td><input type="hidden" name="product_stock_id[{{$process->id}}]" class="product_stock_id" value="{{$process->id}}">{{$process->product_name}} {{$process->product_no}}</td>
                                  <td><input type="hidden" name="purchase_date[{{$process->id}}]" class="purchase_date" value="{{$process->purchase_date}}">{{date('M j Y',strtotime($process->purchase_date))}}</td>
                                  <td>
                                    <?php   
                                    if($process->no_of_process <= 1) {
                                      echo $process_date;
                                      echo '<input type="hidden" name="processing_date['.$process->id.']" class="processing_date" value="'.$newdate.'">';
                                    } 
                                    else {
                                      $newprocess_date = date('M j Y',strtotime($process->newpdate)); 
                                      echo $newprocess_date;                                                    
                                      echo '<input type="hidden" name="processing_date['.$process->id.']" class="processing_date" value="'.$process->newpdate.'">';
                                    }
                                    ?>
                                  </td>
                                  <td>
                                    <select name="is_processed_or_not[{{$process->id}}]" class="is_processed_or_not" {{$process->status == 'inactive' ? 'disabled' : ''}}>                              
                                      <option value="yes">Want to process</option>
                                      <option  value="no">Not</option>
                                    </select>
                                  </td>
                                  <td>
                                    <input type="text" name="actual_or_further_processing_date[{{$process->id}}]" value="{{$process->afdate ? $process->afdate : ''}}" class="afdate form-control datepicker" {{$process->status == 'inactive' ? 'disabled' : ''}}></td>
                                  <td>
                                    <input type="text" name="note[{{$process->id}}]" value="{{$process->note ? $process->note : ''}}" class="note form-control" {{$process->status == 'inactive' ? 'disabled' : ''}}>
                                  </td>
                                  <input type="hidden" name="product_no[{{$process->id}}]" value="{{$process->product_no}}">
                                  <input type="hidden" name="prid[{{$process->id}}]" value="{{$process->prrid}}">
                              </tr>  
                              <?php $count++ ?>            
                            @endif
                          @endforeach
                      </tbody>
                    </table>
                    @if(strtotime(date('Y-m-d')) > strtotime($process_dateex)) 
                      <button type="submit" class="btn btn-info btn-round p_submit">Submit</button> 
                    @endif
                  </form>
                </div>
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection