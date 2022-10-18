<?php

namespace App\Http\Controllers\Expenses;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GeneralIncome;

class GeneralIncomeController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
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

        return redirect('/rent')->with('success','Record Created');
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

        return redirect('/rent')->with('success','Record Updated');
    }


    public function delete($id)
    {
        $income =  GeneralIncome::find($id);        
        $income->delete();
        return ['status' => 1 ];                    
    }
}
