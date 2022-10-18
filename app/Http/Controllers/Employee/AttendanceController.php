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
        $attendance = DB::table('attendance_list')
                    ->Join('employees', 'employees.id', '=', 'attendance_list.eid')
                    ->select('attendance_list.*','employees.name as ename','employees.salary as msalary')
                    ->orderBy('attendance_list.month', 'ASC')
                    ->orderBy('attendance_list.date', 'DESC')
                    // ->where('date',$data['date'])
                    ->get();
       
        return view('employees.attendance')->with(['emps'=>$employees,'attendance'=>$attendance]);
    }

    public function store(Request $req) {
        
        $data = $req->all();        
        $checkData = DB::table('attendance_list')->where('date',$data['date'])->get();
        
        if(count($checkData) == 0) {        
            foreach(request()->empid as $eid) {
                if($data['empid'][$eid]) {
                    $salary = '';
                    if($data['select_entry'][$eid] == '1') {
                        $salary = number_format($data['salary'][$eid]/30,2);
                    }
                    else if($data['select_entry'][$eid] == '0.5') {
                        $salary = number_format($data['salary'][$eid]/60,2);
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
            return redirect('/attendance')->with('success','Data Added');  
        }
        else {
            return redirect('/attendance')->with('error','Entry Already Exist of Date '.$data['date']);  
        }                
    }

    public function getattendanceapi() {

        $responce = DB::table('attendance_list')
                    ->Join('employees', 'employees.id', '=', 'attendance_list.eid')
                    ->select('attendance_list.*','employees.name as ename','employees.salary as msalary')
                    ->orderBy('attendance_list.month', 'DESC')
                    ->get();
        return ['data' => $responce];
    }
}
