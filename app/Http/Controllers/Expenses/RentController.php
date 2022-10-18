<?php

namespace App\Http\Controllers\Expenses;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rent;
use App\Models\GeneralIncome;
use App\Helper\Helper;

class RentController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }


    public function index()
    {
        $rents = Rent::orderBY('created_at','desc')->get();
        $incomes = GeneralIncome::orderBY('created_at','desc')->get();
		
		//Helper::debug($rents);
		
		$rent_sum = 0;
		foreach($rents as $r) {
			$rent_sum+=$r->rent_paid;
		}
		
		$income_sum = 0;
		foreach($incomes as $ic) {
			$income_sum+=$ic->amount;
		}
		
		$display_total = $rent_sum+$income_sum;
		
        return view('expenses.rent.index')->with(['rents'=> $rents,'incomes'=> $incomes, 'total_income'=>$display_total]);
    }

    public function create()
    {
        return view('expenses.rent.create');
    }

 
    public function store(Request $request)
    {
        $rent = new Rent();
        $rent->customer_name = $request->input('customer_name');
        $rent->rent = $request->input('rent');
        $rent->rent_paid = $request->input('rent_paid');
        $rent->deposit = $request->input('deposit');
        $rent->date = $request->input('date');
        $rent->save();

        return redirect('/rent')->with('success','Record Created');
    }


    public function edit($id)
    {
        $rent = Rent::find($id);
        return view('expenses.rent.edit')->with('rent', $rent);
    }


    public function update(Request $request, $id)
    {
        $rent = Rent::find($id);
        $rent->customer_name = $request->input('customer_name');
        $rent->rent = $request->input('rent');
        $rent->rent_paid = $request->input('rent_paid');
        $rent->deposit = $request->input('deposit');
        $rent->date = $request->input('date');
        $rent->save();

        return redirect('/rent')->with('success','Record Updated');
    }


    public function delete($id)
    {
        $rent =  Rent::find($id);        
        $rent->delete();
        return ['status' => 1 ];                    
    }
}
