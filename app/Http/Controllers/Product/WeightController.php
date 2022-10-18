<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\WeightImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Weight;

class WeightController extends Controller
{
    public function __construct()
    {        
        $this->middleware('auth');
    }

    public function index() {
              
        
        $weights = DB::table('weights')
            ->Join('products', 'weights.product_name', '=', 'products.id')
            ->select('weights.*','products.product_name')
            ->orderBy('weights.product_no', 'desc')
            ->get();

        $products = Product::orderBY('created_at','desc')->get();
        return view('products.weight.weight')->with(['weights'=> $weights,'products'=>$products]);
    }

    /* public function import_excel (Request $request) {
        
        $this->validate($request, [
            'select_file'  => 'required|mimes:xls,xlsx',
        ]);
           
        $path = $request->file('select_file')->store('temp');
        Excel::import(new WeightImport, $path);
        
        return redirect('/weight')->with('success','Excel Data Imported successfully.');
    } */

    public function edit($id) {
        
        $weights = DB::table('weights')
            ->Join('products', 'weights.product_name', '=', 'products.id')
            ->select('weights.*','products.product_name','products.id as pid')
            ->where('weights.id',$id)
            ->first();
        return ['status' => 1, 'weights' => $weights];
    }

    public function store(Request $request)
    {

        $id = $request->input('hidden_weight_id');
        if($id) {
            $Weight = Weight::find($id);
            $Weight->product_name = $request->product_name;
            $Weight->product_no = $request->product_no;
            $Weight->morning = $request->morning;
            $Weight->evening = $request->evening;
            $Weight->save();
            return redirect('/weight')->with('success','Data updated');
        }        
        else { 
            foreach($request->product_no as $pno) {
                if(!empty($pno))
                {                    
                    Weight::create([
                        'product_name' => $request->product_name,
                        'product_no' => $pno,
                        'morning' => 0,
                        'evening' => 0,
                        'date' => date('Y-m-d'),
                        'created_at' => date('Y-m-d h:i:s')
                    ]);
                }
            }                  
            return redirect('/weight')->with('success','Data Inserted');
        }
        
    }

    public function delete($id)
    {   
        $Weight =  Weight::find($id);        
        $delete = $Weight->delete();
        return ['status' => 1 ];                       
        // return redirect('/product')->with('error','Product Deleted');
    }
}
