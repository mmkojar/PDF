<?php

namespace App\Http\Controllers\Expenses;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Expense;

class ExpenseController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        $expenses = Expense::orderBY('created_at','desc')->get();
        return view('expenses.expense.index')->with('expenses', $expenses);
    }

    public function create()
    {
        return view('expenses.expense.create');
    }

 
    public function store(Request $request)
    {
        $expense = new Expense();
        $expense->amount = $request->input('amount');
        $expense->description = $request->input('description');
        $expense->date = $request->input('date');
        $expense->save();

        return redirect('/expense')->with('success','Record Created');
    }


    public function edit($id)
    {
        $expense = Expense::find($id);
        return view('expenses.expense.edit')->with('expense', $expense);
    }


    public function update(Request $request, $id)
    {
        $expense = Expense::find($id);
        $expense->amount = $request->input('amount');
        $expense->description = $request->input('description');
        $expense->date = $request->input('date');
        $expense->save();

        return redirect('/expense')->with('success','Record Updated');
    }


    public function delete($id)
    {
        $expense =  Expense::find($id);        
        $expense->delete();
        return ['status' => 1 ];                    
    }
}
