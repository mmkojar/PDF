@extends('layouts.app')

@section('content')

<div class="alert alert-danger alert-dismissible fade d-none show" id="process_alert" role="alert">
  <strong></strong>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">×</span>
  </button>
</div>

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
                @if(count($pending_checkup) > 0)
                <div class="table-responsive">
                  <form action="{{route('medical_checkup.store')}}" accept="" role="form" method="post" id="checkup_form">
                  @csrf 
                    <table id="datatable" class="table table-striped table-bordered product_flow_table" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th>Select</th>
                          <th>Sr.No</th>
                          <th>Product Name</th>
                          <th>Product No.</th>
                          <th>Processing Date</th>
                          <th>Medical Date</th>
                          <th>Actual Medical Date</th>
                          <th>Pregnant Or Not</th>
                          <th>Delivery Date</th>
                          <th>Notes</th>
                        </tr>
                      </thead>
                      <tbody>
                            @foreach($pending_checkup as $checkup)             
                            <?php 
                              $date1 = str_replace('-', '/', $checkup->actual_or_further_processing_date);
                              $newdate = date('Y-m-d',strtotime($date1 . +$medical_days[0]->medical_days1."days"));
                              $medical_date = date('M j Y',strtotime($newdate));

                              $date2 = str_replace('-', '/', $checkup->actual_or_further_processing_date);
                              $newdate2 = date('Y-m-d',strtotime($date2 ."10 months"));
                              $delivery_date = date('M j Y',strtotime($newdate2));
                            ?>            
                            @if(strtotime(date('Y-m-d')) == strtotime($medical_date))
                              <tr>                                           
                                  <td><input type="checkbox" name="select_process[{{$checkup->id}}]" class="select_process" value="{{$checkup->id}}"></td>                           
                                  <td>{{$count}}</td>
                                  <td><input type="hidden" name="product_id[{{$checkup->id}}]" class="product_id" value="{{$checkup->product_id}}">{{$checkup->product_name}}</td>
                                  <td><input type="hidden" name="product_stock_id[{{$checkup->id}}]" class="product_stock_id" value="{{$checkup->product_stock_id}}">{{$checkup->product_name}} {{$checkup->product_no}}</td>
                                  <td><input type="hidden" name="processing_date[{{$checkup->id}}]" class="processing_date" value="{{$checkup->actual_or_further_processing_date}}">{{date('M j Y',strtotime($checkup->actual_or_further_processing_date))}}</td>
                                  <td>
                                    <?php   
                                    echo $medical_date;
                                    echo '<input type="hidden" name="medical_date['.$checkup->id.']" class="medical_date" value="'.$newdate.'">';
                                    ?>
                                  </td>
                                   <td><input type="text" name="actual_medical_date[{{$checkup->id}}]" class="form-control datepicker"></td>
                                   <td>
                                    <select name="is_pregnant_or_not[{{$checkup->id}}]" class="is_pregnant_or_not">                              
                                      <option value="yes">Yes</option>
                                      <option  value="no">No (Back to Process)</option>
                                    </select>
                                  </td>
                                  <td>
                                    <?php
                                      echo $delivery_date;
                                      echo '<input type="hidden" name="delivery_date['.$checkup->id.']" class="deliverydate form-control" value="'.$newdate2.'">';
                                    ?>
                                  </td>
                                  <td>
                                    <input type="text" name="note[{{$checkup->id}}]" class="note form-control">
                                  </td>
                                    <input type="hidden" name="mcid[{{$checkup->id}}]" value="{{$checkup->mcid}}">
                                    <input type="hidden" name="product_no[{{$checkup->id}}]" value="{{$checkup->product_no}}">
                                    <input type="hidden" name="processing_id[{{$checkup->id}}]" value="{{$checkup->id}}">
                              </tr>                              
                              <?php $count++ ?>    
                            @endif        
                            @endforeach                  
                      </tbody>                           
                    </table>
                    @if(strtotime(date('Y-m-d')) == strtotime($medical_date))
                      <button type="submit" class="btn btn-info btn-round m_submit">Submit</button> 
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
                @if(count($pending_checkup) > 0)
                <div class="table-responsive">
                  <form action="{{route('medical_checkup.store')}}" accept="" role="form" method="post" id="checkup_form">
                  @csrf 
                    <table id="datatable1" class="table table-striped table-bordered product_flow_table" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th>Select</th>
                          <th>Sr.No</th>
                          <th>Product Name</th>
                          <th>Product No.</th>
                          <th>Processing Date</th>
                          <th>Medical Date</th>
                          <th>Actual Medical Date</th>
                          <th>Pregnant Or Not</th>
                          <th>Delivery Date</th>
                          <th>Notes</th>
                        </tr>
                      </thead>
                      <tbody>
                            @foreach($pending_checkup as $checkup)             
                            <?php 
                              $date1 = str_replace('-', '/', $checkup->actual_or_further_processing_date);
                              $newdate = date('Y-m-d',strtotime($date1 . +$medical_days[0]->medical_days1."days"));
                              $medical_date = date('M j Y',strtotime($newdate));
                              
                              $date2 = str_replace('-', '/', $checkup->actual_or_further_processing_date);
                              $newdate2 = date('Y-m-d',strtotime($date2 ."10 months"));
                              $delivery_date = date('M j Y',strtotime($newdate2));
                            ?>            
                            @if(strtotime(date('Y-m-d')) < strtotime($medical_date))
                              <tr>                                           
                                  <td><input type="checkbox" name="select_process[{{$checkup->id}}]"  class="select_process" value="{{$checkup->id}}"></td>                           
                                  <td>{{$count}}</td>
                                  <td><input type="hidden" name="product_id[{{$checkup->id}}]" class="product_id" value="{{$checkup->product_id}}">{{$checkup->product_name}}</td>
                                  <td><input type="hidden" name="product_stock_id[{{$checkup->id}}]" class="product_stock_id" value="{{$checkup->product_stock_id}}">{{$checkup->product_name}} {{$checkup->product_no}}</td>
                                  <td><input type="hidden" name="processing_date[{{$checkup->id}}]" class="processing_date" value="{{$checkup->actual_or_further_processing_date}}">{{date('M j Y',strtotime($checkup->actual_or_further_processing_date))}}</td>                          
                                  <td>
                                    <?php   
                                    echo $medical_date;
                                    echo '<input type="hidden" name="medical_date['.$checkup->id.']" class="medical_date" value="'.$newdate.'">';
                                    ?>
                                  </td>
                                  <td><input type="text" name="actual_medical_date[{{$checkup->id}}]" class="form-control datepicker"></td>
                                   <td>
                                    <select name="is_pregnant_or_not[{{$checkup->id}}]" class="is_pregnant_or_not">                              
                                      <option value="yes" @if($checkup->pnot=='yes') selected @endif>Yes</option>
                                      <option  value="no" @if($checkup->pnot=='no') selected @endif>No (Back to Process)</option>
                                    </select>
                                  </td>
                                  <td>
                                    <?php
                                      echo $delivery_date;
                                      echo '<input type="hidden" name="delivery_date['.$checkup->id.']" class="deliverydate form-control" value="'.$newdate2.'">';
                                    ?>                                   
                                  </td>
                                  <td>
                                   <input type="text" name="note[{{$checkup->id}}]" class="note form-control">
                                  </td>
                                    <input type="hidden" name="mcid[{{$checkup->id}}]" value="{{$checkup->mcid}}">
                                    <input type="hidden" name="product_no[{{$checkup->id}}]" value="{{$checkup->product_no}}">
                                    <input type="hidden" name="processing_id[{{$checkup->id}}]" value="{{$checkup->id}}">
                              </tr>                              
                              <?php $count++ ?>    
                            @endif        
                            @endforeach                  
                      </tbody>                           
                    </table>
                    @if(strtotime(date('Y-m-d')) < strtotime($medical_date))
                    <button type="submit" class="btn btn-info btn-round m_submit">Submit</button> 
                    @endif
                  </form>
                </div>
                @endif
              </div><!-- end content-->
            </div><!--  end card  -->
          </div>
          <div class="tab-pane" id="expire">
            <div class="card">
              <div class="card-body">
                <?php $count=1 ?>
                @if(count($pending_checkup) > 0)
                <div class="table-responsive">
                  <form action="{{route('medical_checkup.store')}}" accept="" role="form" method="post" id="checkup_form">
                    @csrf  
                    <table id="datatable2" class="table table-striped table-bordered product_flow_table" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th>Select</th>
                          <th>Sr.No</th>
                          <th>Product Name</th>
                          <th>Product No.</th>
                          <th>Processing Date</th>
                          <th>Medical Date</th>
                          <th>Actual Medical Date</th>
                          <th>Pregnant Or Not</th>
                          <th>Delivery Date</th>
                          <th>Notes</th>
                        </tr>
                      </thead>
                      <tbody>
                            @foreach($pending_checkup as $checkup)              
                            <?php 
                              $date1 = str_replace('-', '/', $checkup->actual_or_further_processing_date);
                              $newdate = date('Y-m-d',strtotime($date1 . +$medical_days[0]->medical_days1."days"));
                              $medical_date = date('M j Y',strtotime($newdate));
                              
                              $date2 = str_replace('-', '/', $checkup->actual_or_further_processing_date);
                              $newdate2 = date('Y-m-d',strtotime($date2 ."10 months"));
                              $delivery_date = date('M j Y',strtotime($newdate2));
                            ?>            
                              @if(strtotime(date('Y-m-d')) > strtotime($medical_date))           
                              <tr>                                           
                                  <td><input type="checkbox" name="select_process[{{$checkup->id}}]"  class="select_process" value="{{$checkup->id}}"></td>                           
                                  <td>{{$count}}</td>
                                  <td><input type="hidden" name="product_id[{{$checkup->id}}]" class="product_id" value="{{$checkup->product_id}}">{{$checkup->product_name}}</td>
                                  <td><input type="hidden" name="product_stock_id[{{$checkup->id}}]" class="product_stock_id" value="{{$checkup->product_stock_id}}">{{$checkup->product_name}} {{$checkup->product_no}}</td>
                                  <td><input type="hidden" name="processing_date[{{$checkup->id}}]" class="processing_date" value="{{$checkup->actual_or_further_processing_date}}">{{date('M j Y',strtotime($checkup->actual_or_further_processing_date))}}</td>                          
                                  <td>
                                    <?php        
                                    echo $medical_date;            
                                    echo '<input type="hidden" name="medical_date['.$checkup->id.']" class="medical_date" value="'.$newdate.'">';
                                    ?>
                                  </td>
                                  <td><input type="text" name="actual_medical_date[{{$checkup->id}}]" class="form-control datepicker"></td>
                                   <td>
                                    <select name="is_pregnant_or_not[{{$checkup->id}}]" class="is_pregnant_or_not">                              
                                      <option value="yes">Yes</option>
                                      <option  value="no">No (Back to Process)</option>
                                    </select>
                                  </td>
                                  <td>
                                    <?php
                                      echo $delivery_date;
                                      echo '<input type="hidden" name="delivery_date['.$checkup->id.']" class="deliverydate form-control" value="'.$newdate2.'">';
                                    ?>
                                  </td>
                                  <td>
                                      <input type="text" name="note[{{$checkup->id}}]" class="note form-control">
                                  </td>
                                  <input type="hidden" name="mcid[{{$checkup->id}}]" value="{{$checkup->mcid}}">
                                  <input type="hidden" name="product_no[{{$checkup->id}}]" value="{{$checkup->product_no}}">
                                  <input type="hidden" name="processing_id[{{$checkup->id}}]" value="{{$checkup->id}}">
                              </tr>  
                              <?php $count++ ?>            
                            @endif
                            @endforeach                  
                      </tbody>                           
                    </table>
                    @if(strtotime(date('Y-m-d')) > strtotime($medical_date)) 
                      <button type="submit" class="btn btn-info btn-round m_submit">Submit</button> 
                    @endif
                  </form>
                </div>
                @endif
              </div><!-- end content-->
            </div><!--  end card  -->
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


@endsection