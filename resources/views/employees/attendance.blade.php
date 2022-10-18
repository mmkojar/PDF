@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-md-12">
      <div class="card">   
        <div class="card-body">
            
        <ul class="nav nav-pills nav-pills-primary nav-pills-icons" role="tablist">    
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#entry" role="tablist">
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
        
        <div class="tab-content tab-space tab-subcategories">      
            <div class="tab-pane active" id="entry">
                <form action="{{route('attendance.store')}}" accept="" role="form" method="post" id="processing_form">
                    <div class="row">
                        <div class="col-md-4 mb-4">
                            <div class="form-group">
                                <label>Date</label>
                                <input type="text" name="date" class="form-control datepicker" placeholder="Date Picker Here">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @csrf
                        @foreach ($emps as $res)
                            <div class="col-md-2">
                                <h4 class="mt-0">{{$res->name}}</h4>
                                <input type="hidden" name="empid[{{$res->id}}]" value="{{$res->id}}">
                                <input type="hidden" name="salary[{{$res->id}}]" value="{{$res->salary}}">
                            </div>
                            <div class="col-md-10">
                                <div class="form-group radio mx-5 d-inline">
                                    <input type="radio" name="select_entry[{{$res->id}}]" class="select_entry  w-auto d-inline" value="1">
                                    <label class="text-success">Full Day</label>
                                </div>
                                <div class="form-group radio mx-5 d-inline">
                                    <input type="radio" name="select_entry[{{$res->id}}]" class="select_entry  w-auto d-inline" value="0.5">
                                    <label class="text-warning">Half Day</label>
                                </div>
                                <div class="form-group radio mx-5 d-inline">
                                    <input type="radio" name="select_entry[{{$res->id}}]" class="select_entry  w-auto d-inline" value="0">
                                    <label class="text-danger">Absent</label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <input type="submit" class="btn btn-info btn-round" value="Submit"> 
                </form>
            </div>
            <div class="tab-pane" id="attendance">
                <?php $count=1 ?>
                <table id="attendance_dt" class="table table-striped table-bordered" cellspacing="0" width="100%">
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
    <script type="text/javascript">

            $("#attendance_dt").DataTable({                        
                dom: 'lBfrtip',
                buttons: [
                    'pdf'
                ],
                // "order": [],
                responsive: true,
                // "pagingType": "simple"
            })
            $.ajax({
                url: base_url+"/attendance/api",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method: "GET",
                contentType: false,
                processData: false,
                success: function(result) {
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
                        // order: [[2,'desc']],
                        // rowGroup: {
                        //     dataSrc: [2]
                        // },
                        // columnDefs: [{
                        //     targets: [2],
                        //     visible: false
                        // }],
                        dom: 'lBfrtip',
                        buttons: [
                            'pdf'
                        ],
                        // "order": [],
                        responsive: true,
                        // "pagingType": "simple"
                    })
                }
            });
    </script>
@endsection