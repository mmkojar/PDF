<?php

namespace App\Http\Controllers\Expenses;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Medical;

class MedicalController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }


    public function index()
    {
        $medicals = Medical::orderBY('created_at','desc')->get();
        return view('expenses.medical.index')->with('medicals', $medicals);
    }

    public function create()
    {
        return view('expenses.medical.create');
    }

 
    public function store(Request $request)
    {
        $medical = new Medical();
        $medical->description = $request->input('description');
        $medical->buy_from = $request->input('buy_from');
        $medical->units = $request->input('units');
        $medical->quantity = $request->input('quantity');
        $medical->price = $request->input('price');
        $medical->amount = $request->input('quantity')*$request->input('price');
        $medical->date = $request->input('date');
        $medical->save();

        return redirect('/medical')->with('success','Record Created');
    }

    public function edit($id)
    {
        $medical = Medical::find($id);
        return view('expenses.medical.edit')->with('medical', $medical);
    }


    public function update(Request $request, $id)
    {
        $medical = Medical::find($id);
        $medical->description = $request->input('description');
        $medical->buy_from = $request->input('buy_from');
        $medical->units = $request->input('units');
        $medical->quantity = $request->input('quantity');
        $medical->price = $request->input('price');
        $medical->amount = $request->input('quantity')*$request->input('price');
        $medical->date = $request->input('date');
        $medical->save();

        return redirect('/medical')->with('success','Record Updated');
    }


    public function delete($id)
    {
        $medical =  Medical::find($id);        
        $medical->delete();
        return ['status' => 1 ];
    }
}
