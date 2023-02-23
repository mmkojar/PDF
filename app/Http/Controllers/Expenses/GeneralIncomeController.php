<?php

namespace App\Http\Controllers\Expenses;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GeneralIncome;
use App\Models\Rent;
use App\Models\Expense;

class GeneralIncomeController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        // $rents = Rent::orderBY('created_at','desc')->get();
        $incomes = GeneralIncome::orderBY('created_at','desc')->get();
		
		//Helper::debug($rents);
		
		/* $rent_sum = 0;
		foreach($rents as $r) {
			$rent_sum+=$r->rent_paid;
		} */
		
		$income_sum = 0;
		foreach($incomes as $ic) {
			$income_sum+=$ic->amount;
		}
		
		// $display_total = $rent_sum+$income_sum;
        $expenses = Expense::orderBY('created_at','desc')->get();
		
        return view('expenses.index')->with([
            // 'rents'=> $rents,
            'incomes'=> $incomes, 
            // 'total_income'=>$display_total,
            'expenses'=> $expenses
        ]);
    }
    
    public function create()
    {
        return view('expenses.general_income.create');
    }

 
    public function store(Request $request)
    {
        $income = new GeneralIncome();
        $income->amount = $request->input('amount');
        $income->description = $request->input('description');
        $income->date = $request->input('date');
        $income->save();

        return redirect('/income_expense')->with('success','Record Created');
    }


    public function edit($id)
    {
        $income = GeneralIncome::find($id);
        return view('expenses.general_income.edit')->with('income', $income);
    }


    public function update(Request $request, $id)
    {
        $income = GeneralIncome::find($id);
        $income->amount = $request->input('amount');
        $income->description = $request->input('description');
        $income->date = $request->input('date');
        $income->save();

        return redirect('/income_expense')->with('success','Record Updated');
    }


    public function delete($id)
    {
        $income =  GeneralIncome::find($id);        
        $income->delete();
        return ['status' => 1 ];                    
    }
}
