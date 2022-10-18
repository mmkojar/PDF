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
    <div class="card">
      <div class="card-body ">
        <ul class="nav nav-pills nav-pills-primary nav-pills-icons justify-content-center" role="tablist">                 
          <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#pending" role="tablist">
              <i class="now-ui-icons shopping_shop"></i>
              Pending
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#salves" role="tablist">
              <i class="now-ui-icons ui-2_settings-90"></i>
              Salves
            </a>
          </li>
        </ul>
        <div class="tab-content tab-space tab-subcategories">                
          <div class="tab-pane active" id="pending">
            <div class="card">
              <div class="card-body">
                    <?php $count=1 ?>
                    @if(count($pregnants) > 0)
                        <table id="datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                <th>Sr.No</th>                
                                <th>Product Name</th>
                                <th>Product No.</th>
                                <th>Processing Date</th>
                                <th>Medical Date</th>
                                <th>Delivery Date</th>                              
                                <th class="disabled-sorting text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pregnants as $pregnant)
                                <tr>
                                    <td>{{$count}}</td>                  
                                    <td>{{ucfirst($pregnant->product_name)}}</td>
                                    <td>{{ucfirst($pregnant->product_name)}} {{$pregnant->product_no}}</td>
                                    <td>{{date('M j Y',strtotime($pregnant->processing_date))}}</td>
                                    <td>{{date('M j Y',strtotime($pregnant->actual_medical_date))}}</td>
                                    <td>{{date('M j Y',strtotime($pregnant->delivery_date))}}</td>
                                    <td class="text-center">
                                        <a href="{{route('ghabhan.edit', $pregnant->id)}}" class="btn btn-sm btn-warning edit"><i class="fa fa-edit"></i></a>                    
                                    </td>
                                </tr>  
                                <?php $count++ ?>            
                                @endforeach
                                
                            </tbody>
                        </table>
                    @endif
              </div>
            </div>
          </div>          
          <div class="tab-pane" id="salves">
            <div class="card">
              <div class="card-body">
                <?php $count=1 ?>
                @if(count($salves) > 0)
                    <table id="datatable1" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                            <th>Sr.No</th>                
                            <th>Product Name</th>
                            <th>Product No.</th>
                            <th>Processing Date</th>
                            <th>Medical Date</th>
                            <th>Salves Date</th>                            
                            <th>Delivery Date</th>
                            <th>Salves Name</th>
                            <th>Salves Location</th>                            
                            <th class="disabled-sorting text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($salves as $salve)
                            <tr>
                                <td>{{$count}}</td>
                                <td>{{ucfirst($salve->product_name)}}</td>
                                <td>{{ucfirst($salve->product_name)}} {{$salve->product_no}}</td>
                                <td>{{date('M j Y',strtotime($salve->processing_date))}}</td>
                                <td>{{date('M j Y',strtotime($salve->medical_date))}}</td>                              
                                <td>{{date('M j Y',strtotime($salve->salves_date))}}</td>                                
                                <td>{{date('M j Y',strtotime($salve->delivery_date))}}</td>  
                                <td>{{ucfirst($salve->salve_name)}}</td>
                                <td>{{ucfirst($salve->salve_location)}}</td>
                                <td class="text-center">                  
                                    <a href="{{route('ghabhan.salve.edit', $salve->id)}}" class="btn btn-sm btn-warning edit"><i class="fa fa-edit"></i></a>                    
                                </td>
                            </tr>  
                            <?php $count++ ?>            
                            @endforeach
                            
                        </tbody>
                    </table>
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