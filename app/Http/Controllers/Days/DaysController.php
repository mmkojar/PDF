<?php

namespace App\Http\Controllers\Days;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Days;

class DaysController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }
    
    public function index()
    {
        $day =  Days::all();
        return view('days.processing')->with('day',$day);
        /* if($name == 'processing') {
            return view('days.processing')->with('day',$day);
        }        
        else if($name == 'medical1') {
            return view('days.medical1')->with('day',$day);
        }
        else if($name == 'medical2') {
            return view('days.medical2')->with('day',$day);
        }
        else if($name == 'salves') {
            return view('days.salves')->with('day',$day);
        } */
    }

    public function store(Request $request)
    {    
        // Processing Days
        if($request->input('processing_id')) {                                   
            $id = $request->input('hidden_id');
            $day = Days::find($id);
            $day->processing_days = $request->input('processing_days');
            $day->save();
            return redirect('days')->with('success','Processing Days Updated');                            
        }
        
        // Medical Dyas1
        if($request->input('medical_id1')) {                                        
            $id = $request->input('hidden_id');
            $day = Days::find($id);
            $day->medical_days1 = $request->input('medical_days1');
            $day->save();
            return redirect('days')->with('success','Medical Days Updated');
        }

        // Medical Dyas2
        /* if($request->input('medical_id2')) {
            $get_days = Days::all();            
            if($get_days->isEmpty()) {
                $days = new Days();
                $days->medical_days2 = $request->input('medical_days2');
                $days->save();
                $request->session()->put('id', $days->id);
                return redirect('days')->with('success','Days Added');

            }
            else {                        
                $id = $request->session()->get('id');
                $day = Days::find($id);
                $day->medical_days2 = $request->input('medical_days2');
                $day->save();
                return redirect('days')->with('success','Days Updated');
            }
        }*/

        // Salves
        if($request->input('salves_id')) {                                  
            $id = $request->input('hidden_id');
            $day = Days::find($id);
            $day->days_in_salves = $request->input('days_in_salves');
            $day->save();
            return redirect('days')->with('success','Salve Days Updated');            
        }

    }
}
