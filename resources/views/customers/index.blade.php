@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">        
            <form  accept="" role="form" method="post" id="customer_form">
              @csrf        
              <div class="row">
                  <div class="col-md-4">
                      <div class="form-group">
                          <label>Customer Name</label>
                          <input type="text" name="c_name" class="form-control" required>
                      </div>
                  </div>
                  {{-- <div class="col-md-4">
                      <div class="form-group">
                          <label>Customer Type</label>
                          <select class="form-control" name="c_type" id="c_type">                         
                              <option value="Regular Customer" selected>Regular Customer</option>
                              <option value="Home Customer">Home Customer</option>
                          </select>
                      </div> 
                  </div>
                  <div class="col-md-4">
                      <div class="form-group">
                          <label>Bill Period</label>
                          <select class="form-control" name="bill_period" id="bill_period">                         
                              <option value="weekly" selected>Weekly</option>
                              <option value="monthly">Monthly</option>                                    
                          </select>
                      </div>
                  </div> --}}
                  <div class="col-md-4">
                      <div class="form-group">
                          <label>Customer Location</label>
                          <input type="text" name="c_location" class="form-control">
                      </div>
                  </div>
                  <div class="col-md-4">
                      <div class="form-group">
                          <label>Description</label>
                          <input type="text" class="form-control" name="c_description">
                      </div>
                  </div>
                  <div class="col-md-4">
                      <div class="form-group">
                          <label>Milk Rate</label>
                          <input type="number" name="milk_rate" class="form-control" step=".01" required>
                      </div>
                  </div>
                  <div class="col-md-4">
                      <div class="form-group">
                          <label>Morning</label>
                          <input type="number" name="morning" class="form-control" step=".01" min="0" required>
                      </div>
                  </div>
                  <div class="col-md-4">
                      <div class="form-group">
                          <label>Evening</label>
                          <input type="number" name="evening" class="form-control" step=".01" min="0" required>
                      </div>
                  </div>
                  <div class="col-md-4">
                      <div class="form-group">
                          <label>Mobile No.</label>
                          <input type="text" name="mobile_no" class="form-control" maxlength="10" minlength="10">
                      </div>
                  </div>
                  <div class="col-md-4">
                      <div class="form-group">
                          <label>Email Id</label>
                          <input type="email" name="c_email" class="form-control">
                      </div>
                  </div>
              </div>
              <button type="submit" class="btn btn-info btn-round">Submit</button>              
            </form>
        </div>
        <div class="card-body">
          <?php $count=1 ?>
          <table id="datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th>Sr.No</th>
                <th>Customer Name</th>
                {{-- <th>Customer Type</th> --}}
                {{-- <th>Bill Period</th> --}}
                <th>Customer Location</th>
                <th>Description</th>
                <th>Milk Rate</th>
                <th>Morning</th>
                <th>Evening</th>
                <th>Mobile No.</th>
                <th>Email</th>
                <th>Status</th>
                @can('all-access')
                  <th class="disabled-sorting text-right">Actions</th>
                @endcan
              </tr>
            </thead>
            <tbody>
              @foreach($customers as $customer)
                <tr>
                  <td>{{$count}}</td>
                  <td>{{ucfirst($customer->customer_name)}}</td>
                  {{-- <td>{{ucfirst($customer->customer_type)}}</td> --}}
                  {{-- <td>{{ucfirst($customer->bill_period)}}</td> --}}
                  <td>{{ucfirst($customer->customer_location ? $customer->customer_location : '-')}}</td>
                  <td>{{$customer->description ? $customer->description : '-'}}</td>
                  <td>{{$customer->milk_rate}}</td>
                  <td>{{$customer->morning}}</td>
                  <td>{{$customer->evening}}</td>
                  <td>{{$customer->mobile_no}}</td>
                  <td>{{$customer->email ? $customer->email : '-'}}</td>
                  <td class="{{($customer->status === 'active' ? 'font-weight-bold text-success' : 'font-weight-bold text-danger') }}">{{ucfirst($customer->status ? $customer->status : '-')}}</td>
                  @can('all-access')
                  <td class="text-right">
                    {{-- {!! Form::open(['action' => ['App\Http\Controllers\Customer\CustomerController@destroy', $customer->id] , 'method' => 'POST', 'style' => 'display:inline']) !!}
                      {{Form::hidden ('_method','DELETE')}}
                      {{Form::submit('X', ['class' => 'btn btn-sm btn-danger'])}}
                    {!! Form::close() !!} --}}
                      <a id="{{$customer->id}}" class="btn btn-sm btn-danger delete_all" url="customer"><i class="fa fa-times"></i></a>                    
                      <a href="{{route('customer.edit', $customer->id)}}" class="btn btn-sm btn-warning edit"><i class="fa fa-edit"></i></a>
                  </td>
                  @endcan
                </tr>
                <?php $count++ ?>
              @endforeach
            </tbody>
          </table>
        </div><!-- end content-->
      </div><!--  end card  -->
    
    </div> <!-- end col-md-12 -->
  </div> <!-- end row -->

@endsection

@section('customer_script')
    <script type="text/javascript">

        $('body').delegate('#customer_form', 'submit', function(e) {
            
            e.preventDefault();
            var dataSerialize = new FormData($("#customer_form")[0]);
            $("#preloader").show();
            $.ajax({
                url: base_url+'/customer',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method: "POST",
                data : dataSerialize,
                contentType: false,
                processData: false,
                success: function(res) {
                    $("#preloader").hide();
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: res.msg,
                        showConfirmButton: true,
                        timer: 1500
                    })
                    window.location.href = window.location.pathname;
                }, 
                error:function(err) {
                    console.log(err);
                    $("#preloader").hide();
                }
            })
        });
    </script>

@endsection