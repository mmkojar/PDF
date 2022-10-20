<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        $employee = Employee::orderBY('created_at','desc')->get();
        return view('employee.index')->with('employee', $employee);
    }


    public function create()
    {
        return view('employee.create');
    }

    public function store(Request $request)
    {
        $employee = new Employee();
        $employee->name = $request->input('name');
        $employee->mobile_no = $request->input('mobile_no');
        $employee->location = $request->input('location');
        $employee->salary = $request->input('salary');
        $employee->status = 'active';
        $employee->save();

        return redirect('/employee')->with('success','Employee Created');
    }

    public function edit($id)
    {
        $employee = Employee::find($id);
        return view('employee.edit')->with('employee', $employee);
    }


    public function update(Request $request, $id)
    {
        $employee = Employee::find($id);
        $employee->name = $request->input('name');
        $employee->mobile_no = $request->input('mobile_no');
        $employee->location = $request->input('location');
        $employee->salary = $request->input('salary');
        $employee->status = $request->input('status');
        $employee->save();

        return redirect('/employee')->with('success','Employee Updated');
    }

    public function delete($id)
    {
        $employee =  Employee::find($id);
        $del = $employee->delete();
        if($del) {
            DB::table('attendance_list')->where('eid',$id)->delete();
        }
        return ['status' => 1 ]; 
    }
}
