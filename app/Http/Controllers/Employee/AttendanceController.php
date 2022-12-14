<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use Illuminate\Support\Facades\DB;

class AttendanceController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {        
        $employees = Employee::orderBY('created_at','desc')->get();
        $employees1 = Employee::orderBY('created_at','desc')->where('status','active')->get();
        $attendance = DB::table('attendance_list')
                    ->Join('employees', 'employees.id', '=', 'attendance_list.eid')
                    ->select('attendance_list.*','employees.name as ename','employees.salary as msalary')
                    ->orderBy('attendance_list.month', 'ASC')
                    ->orderBy('attendance_list.date', 'DESC')
                    // ->where('date',$data['date'])
                    ->get();
       
        return view('employee.attendance')->with(['emps'=>$employees,'empsatt'=>$employees1,'attendance'=>$attendance]);
    }

    public function store(Request $req) {
        
        $data = $req->all();
        $checkData = DB::table('attendance_list')->where('date',$data['date'])->get();
        
        if(count($checkData) == 0) {
            foreach(request()->empid as $eid) {
                if($data['empid'][$eid]) {
                    $salary = '';
                    if($data['select_entry'][$eid] == '1') {
                        $salary = number_format($data['salary'][$eid]/30,0);
                    }
                    else if($data['select_entry'][$eid] == '0.5') {
                        $salary = number_format($data['salary'][$eid]/60,0);
                    }
                    else {
                        $salary = 0;
                    }
                    DB::table('attendance_list')
                    ->insert(
                        [
                            'eid'   => $data['empid'][$eid],
                            'entry' => $data['select_entry'][$eid],
                            'per_day_salary' => $salary,
                            'month' => date('M',strtotime($data['date'])),
                            'date' => $data['date'],
                            'created_at' => date('Y-m-d h:i:s'),
                        ]
                    );
                }
            }
            // return redirect('/attendance')->with('success','Data Added');
            return ['status' => 1, 'msg'=>'Attendace Added'];
        }
        else {
            return ['status' => 0, 'msg'=>'Entry Already Exist of Date '.$data['date']];
            // return redirect('/attendance')->with('error','Entry Already Exist of Date '.$data['date']);  
        }                
    }

    public function month_wise_data() {

        $responce = DB::table('attendance_list')
                    ->Join('employees', 'employees.id', '=', 'attendance_list.eid')
                    ->select('attendance_list.*','employees.name as ename','employees.salary as msalary')
                    ->orderBy('attendance_list.month', 'DESC')
                    ->get();
        return ['data' => $responce];
    }
}
