@extends('layouts.app')

@section('content')

<div class="row attendance">
    <div class="col-md-12">
      <div class="card">   
        <div class="card-body">
            
        <ul class="nav nav-pills nav-pills-primary nav-pills-icons mb-4" role="tablist">    
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#employee" role="tablist">
                <i class="now-ui-icons shopping_shop"></i>
                Employees
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#entry" role="tablist">
                <i class="now-ui-icons shopping_shop"></i>
                Entry
                </a>
            </li>      
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#attendance" role="tablist">
                <i class="now-ui-icons shopping_shop"></i>
                Attendance List
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#month" role="tablist">
                <i class="now-ui-icons ui-2_settings-90"></i>
                Month Wise
                </a>
            </li>
        </ul>
        
        <div class="tab-content">
            <div class="tab-pane active" id="employee">
                <div class="card">
                    <div class="card-header">
                        <form accept="" role="form" method="post" id="employee_form">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" name="name" class="form-control" required="true">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Mobile No.</label>
                                        <input type="text" name="mobile_no" class="form-control" maxlength="10" minlength="10">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Location</label>
                                        <input type="text" name="location" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Salary</label>
                                        <input type="number" name="salary" class="form-control" required="true">
                                    </div>
                                </div>
                            </div>          
                            <button type="submit" class="btn btn-info btn-round" id="emp_store_btn">Submit</button>                           
                        </form>
                    </div>
                    <div class="card-body">
                        <?php $count=1 ?>
                        <table id="datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                <th>Sr.No</th>
                                <th>Name</th>
                                <th>Mobile No.</th>
                                <th>Location</th>                
                                <th>Salary</th>
                                <th>Status</th>
                                @can('all-access')
                                    <th class="disabled-sorting text-right">Actions</th>
                                @endcan
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($emps as $row)
                                <tr>
                                    <td>{{$count}}</td>
                                    <td>{{ucfirst($row->name)}}</td>
                                    <td>{{ucfirst($row->mobile_no)}}</td>
                                    <td>{{$row->location ? $row->location : '-'}}</td>                  
                                    <td>{{$row->salary}}</td>
                                    <td class="{{($row->status === 'active' ? 'font-weight-bold text-success' : 'font-weight-bold text-danger') }}">{{ucfirst($row->status ? $row->status : '-')}}</td>
                                    @can('all-access')
                                    <td class="text-right">
                                        <a id="{{$row->id}}" class="btn btn-sm btn-danger delete_all" url="employee"><i class="fa fa-times"></i></a>                    
                                        <a href="{{route('employee.edit', $row->id)}}" class="btn btn-sm btn-warning edit"><i class="fa fa-edit"></i></a>
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
            <div class="tab-pane" id="entry">
                <form accept="" role="form" method="post" id="attendance_form">
                    {{-- action="{{route('attendance.store')}}" --}}
                    <div class="row">
                        <div class="col-md-4 mb-4">
                            <div class="form-group">
                                <label>Date</label>
                                <input type="text" name="date" class="form-control datepicker" placeholder="Date Picker Here" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @csrf
                        <?php $count1 = 1000; $count2 = 2000; $count3 = 3000 ?>
                        @foreach ($emps as $res)
                            <div class="col-md-2">
                                <h4 class="mt-0">{{$res->name}}</h4>
                                <input type="hidden" name="empid[{{$res->id}}]" value="{{$res->id}}">
                                <input type="hidden" name="salary[{{$res->id}}]" value="{{$res->salary}}">
                            </div>
                            <div class="col-md-10">
                                <div class="form-group radio mx-5 d-inline">
                                    <input type="radio" name="select_entry[{{$res->id}}]" id="{{$count1}}" class="select_entry  w-auto d-inline" value="1" required>
                                    <label for="{{$count1}}" class="text-success">Full Day</label>
                                </div>
                                <div class="form-group radio mx-5 d-inline">
                                    <input type="radio" name="select_entry[{{$res->id}}]" id="{{$count2}}" class="select_entry  w-auto d-inline" value="0.5" required>
                                    <label for="{{$count2}}" class="text-warning">Half Day</label>
                                </div>
                                <div class="form-group radio mx-5 d-inline">
                                    <input type="radio" name="select_entry[{{$res->id}}]" id="{{$count3}}" class="select_entry  w-auto d-inline" value="0" required>
                                    <label for="{{$count3}}" class="text-danger">Absent</label>
                                </div>
                            </div>
                            <?php $count1++;$count2++;$count3++ ?>
                        @endforeach
                    </div>
                    <button type="submit" class="btn btn-info btn-round">Submit</button>
                </form>
            </div>
            <div class="tab-pane" id="attendance">
                <?php $count=1 ?>
                <table id="datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>Sr.No</th>
                        <th>Employee Name</th>
                        <th>Entry</th>
                        <th>Monthly Salary</th>
                        <th>Per Day Salary</th>
                        <th>Month</th>
                        <th>Date</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($attendance as $row)
                        <?php $class = ($row->entry == '1' ? 'text-success' : ($row->entry == '0.5' ? 'text-warning' : 'text-danger')) ?>
                        <tr>
                        <td>{{$count}}</td>
                        <td>{{$row->ename}}</td>        
                        <td  class="font-weight-bold {{$class}}">{{$row->entry == '1' ? 'Full Day' : ($row->entry == '0.5' ? 'Half Day' : 'Absent')}}</td>
                        <td>{{$row->msalary}}</td>
                        <td>{{$row->per_day_salary}}</td>
                        <td>{{$row->month}}</td>
                        <td>{{date('M j Y',strtotime($row->date))}}</td>
                        </tr>
                        <?php $count++ ?>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="tab-pane " id="month">
                <table id="month_wise_dt" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    
                </table>
            </div>
        </div>
            
        </div><!-- end content-->
      </div><!--  end card  -->
    
    </div> <!-- end col-md-12 -->
  </div> <!-- end row -->

@endsection
@section('attendance_script')
    <script src="{{ asset('js/api.js') }}"></script>
    <script type="text/javascript">

            // Employee Submit
            $('body').delegate('#employee_form', 'submit', function(e) {

                e.preventDefault();
                var dataSerialize = new FormData($("#employee_form")[0]);
                $("#preloader").show();
                $.ajax({
                    url: base_url+'/employee',
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
                        $(".attendance .nav-pills li:first-child a,.attendance .tab-content .tab-pane:first-child").removeClass('active');
                        $(".attendance .nav-pills li:nth-child(2) a,.attendance .tab-content .tab-pane:nth-child(2)").addClass('active');
                        window.location.href = window.location.pathname;
                    }, 
                    error:function(err) {
                        console.log(err);
                        $("#preloader").hide();
                    }
                })
            });

            // Attendance Submit
            $('body').delegate('#attendance_form', 'submit', function(e) {

                e.preventDefault();
                var dataSerialize = new FormData($("#attendance_form")[0]);
                $("#preloader").show();
                $.ajax({
                    url: base_url+'/attendance/store',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    method: "POST",
                    data : dataSerialize,
                    contentType: false,
                    processData: false,
                    success: function(res) {
                        $("#preloader").hide();
                        if(res.status == 1) {
                            Swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: res.msg,
                                showConfirmButton: true,
                                timer: 1500
                            })                                                    
                            window.location.href = window.location.pathname;
                        }
                        else {
                            Swal.fire({
                                position: 'center',
                                icon: 'error',
                                title: res.msg,
                                showConfirmButton: true,
                                timer: 2000
                            })
                        }
                    }, 
                    error:function(err) {
                        console.log(err);
                        $("#preloader").hide();
                    }
                })
            });

            // For Month wise Data
            ajaxGetApi("/attendance/api", function(result) {
                    const res = result.data;
                    var attendance_responce = [];
                    for(var i in res) {
                        res[i].per_day_salary = Number(res[i].per_day_salary);
                        attendance_responce[i] = res[i];
                    }
                    
                    // Reduce data according to id and month
                    var result = attendance_responce.reduce((a2, c2) => {
						let filteredP = a2.filter(el => (el.month === c2.month && el.eid === c2
							.eid))
						if (filteredP.length > 0) {
							a2[a2.indexOf(filteredP[0])].per_day_salary += +c2.per_day_salary;
						} else {
							a2.push(c2);
						}
						return a2;
					}, []);
                   
                    console.log(result);                    
                    var html = '';
                    var sr_no = 1;
                    html += `
                        <thead>
                            <tr>
                                <th>Sr.No</th>
                                <th>Employee Name</th>
                                <th>Actual Salary</th>
                                <th>Salary After Attendance</th>
                                <th>Month</th>
                            </tr>
                        </thead>
                        <tbody>
                    `;
                    for(var i in result) {
                        // ${moment(result[i].date).format('MMM D YYYY')}
                        html += `
                            <tr>
                                <td>${sr_no}</td>
                                <td>${result[i].ename}</td>
                                <td>${result[i].msalary}</td>
                                <td>${result[i].per_day_salary.toFixed(2)}</td>
                                <td>${result[i].month}</td>
                            </tr>
                        `;
                        sr_no++;
                    }
                    html += `</tbody>`;
                    $("#month_wise_dt").html(html);
                    $("#month_wise_dt").DataTable({
                        order: [[4, 'asc']],
                        dom: 'lBfrtip',
                        buttons: [
                            'pdf'
                        ],
                        responsive: true,
                    })
            },
            function (data) {
                console.log(data);
            });            
    </script>
@endsection