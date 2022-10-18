@extends('layouts.app')


@section('content')

<div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">                 
        </div>
        <div class="card-body">
          <ul class="nav nav-pills nav-pills-primary nav-pills-icons justify-content-center" role="tablist">    
            <li class="nav-item">
              <a class="nav-link active" data-toggle="tab" href="#rent" role="tablist">
                <i class="now-ui-icons shopping_shop"></i>
                Rent Income 
              </a>
            </li>      
            <li class="nav-item">
              <a class="nav-link" data-toggle="tab" href="#general_income" role="tablist">
                <i class="now-ui-icons shopping_shop"></i>
                General Income
              </a>
            </li>
          </ul>
		      <p class="text-center mt-3">Total Income:- {{$total_income}}</p>
          <div class="tab-content tab-space tab-subcategories">
            <div class="tab-pane active" id="rent">
              <div class="card">
                <div class="card-header">       
                  @can('all-access')     
                    <a href="{{route('rent.create')}}" class="btn btn-primary">Add Rent Income</a>
                  @endcan
                </div>
                <div class="card-body">
                    <?php $count=1 ?>
                    <table id="footer_datatable2" class="table table-striped table-bordered" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th>Sr.No</th>
                          <th>Customer Name</th>
                          <th>Total Rent</th>
                          <th>Rent Paid</th>
                          <th>Depoist</th>
                          <th>Date</th>
                          @can('all-access')
                            <th class="disabled-sorting text-right">Actions</th>
                          @endcan
                          @can('no-access')
                          <th></th>
                          @endcan
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($rents as $rent)
                          <tr>
                            <td>{{$count}}</td>
                            <td>{{$rent->customer_name}}</td>
                            <td>{{$rent->rent}}</td>
                            <td>{{$rent->rent_paid}}</td>
                            <td>{{$rent->deposit}}</td>
                            <td>{{$rent->date}}</td>
                            @can('all-access')
                              <td class="text-right">                             
                                <a id="{{$rent->id}}" class="btn btn-sm btn-danger delete_all" url="rent"><i class="fa fa-times"></i></a>
                                <a href="{{route('rent.edit', $rent->id)}}" class="btn btn-sm btn-warning edit"><i class="fa fa-edit"></i></a>                    
                              </td>
                            @endcan
                            @can('no-access')
                            <td></td>
                            @endcan
                          </tr>
                          <?php $count++ ?>
                        @endforeach
                      </tbody>
					            <tfoot>
                          <tr>
                              <th></th>
                              <th></th>
                              <th>Total:</th>
                              <th></th>
                              <th></th>
                              <th></th>
                              <th></th>
                          </tr>
                      </tfoot>
                    </table>
                </div>
              </div>
            </div>

            <div class="tab-pane" id="general_income">
              <div class="card">
                <div class="card-header">
                    @can('all-access')
                      <a href="{{route('general_income.create')}}" class="btn btn-primary">Add General Income</a>
                    @endcan
                </div>
                <div class="card-body">           
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>From Date</label>
                          <input name="min" id="min" type="text" class="form-control">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>To Date</label>
                          <input name="max" id="max" type="text" class="form-control">
                        </div>
                      </div>
                    </div>                                        
                    <?php $count=1 ?>
                    <table id="footer_datatable3" class="table table-striped table-bordered" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th>Sr.No</th>
                          <th>Description</th>                          
                          <th>Date</th>
                          <th>Amount</th>
                          @can('all-access')
                          <th class="disabled-sorting text-right">Actions</th>
                          @endcan
                          @can('no-access')
                          <th></th>
                          @endcan
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($incomes as $income)
                          <tr>
                            <td>{{$count}}</td>
                            <td>{{$income->description}}</td>        
                            <td>{{$income->date}}</td>
                            <td>{{$income->amount}}</td>
                            @can('all-access')                      
                            <td>
                            <a id="{{$income->id}}" class="btn btn-sm btn-danger delete_all" url="general_income"><i class="fa fa-times"></i></a>                    
                              <a href="{{route('general_income.edit', $income->id)}}" class="btn btn-sm btn-warning edit"><i class="fa fa-edit"></i></a>                    
                            </td>
                            @endcan
                            @can('no-access')
                            <td></td>
                            @endcan
                          </tr>
                          <?php $count++ ?>
                        @endforeach
                      </tbody>
                      <tfoot>
                        <tr>
                            <th></th>
                            <th></th>
                            <th>Total:</th>
                            <th></th>
                            <th></th>
                            {{-- <th colspan="4"></th> --}}
                        </tr>
                      </tfoot>
                    </table>
                </div>
              </div>
            </div>
          </div>

            
        </div><!-- end content-->
      </div><!--  end card  -->
    
    </div> <!-- end col-md-12 -->
  </div> <!-- end row -->

@endsection