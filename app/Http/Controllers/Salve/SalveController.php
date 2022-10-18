<?php

namespace App\Http\Controllers\Salve;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Salves;

class SalveController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        $salves = Salves::orderBY('created_at','desc')->get();
        return view('salves.index')->with('salves',$salves);
    }

    public function create()
    {        
        return view('salves.create');
    }

    public function store(Request $request)
    {
        $salve = new Salves();
        $salve->location = $request->input('location');
        $salve->description = $request->input('description');
        $salve->salve_name = $request->input('salve_name');
        $salve->contact_person = $request->input('contact_person');
        $salve->mobile_no = $request->input('mobile_no');
        // $salve->no_of_days = $request->input('no_of_days');
        $salve->save();

        return redirect('/salves')->with('success','Data Added');    
    }

    public function edit($id)
    {
        $salve = Salves::find($id);              
        return view('salves.edit')->with(['salve' => $salve]);
    }

    
    public function update(Request $request, $id)
    {
        $salve = Salves::find($id);
        $salve->location = $request->input('location');
        $salve->description = $request->input('description');
        $salve->salve_name = $request->input('salve_name');
        $salve->contact_person = $request->input('contact_person');
        $salve->mobile_no = $request->input('mobile_no');
        // $salve->no_of_days = $request->input('no_of_days');
        $salve->save();

        return redirect('/salves')->with('success','Data Updated');    
    }

    
    public function delete($id)
    {
        $salve =  Salves::find($id);        
        $salve->delete();
        return ['status' => 1 ];
    }

    // Transfers
    public function transfer() {

        $transfers = DB::table('transfer_salve')        
                ->Join('products', 'transfer_salve.product_id', '=', 'products.id')
                ->Join('product_stock', 'transfer_salve.product_stock_id', '=', 'product_stock.id')
                ->where('product_stock.status','salve')
                ->select('transfer_salve.*','products.product_name')
                ->orderBy('transfer_salve.created_at', 'desc')
                ->get();
        return view('salves.transfer.index')->with('transfers',$transfers);
    }

    public function create_transfer()
    {
        $products = Product::where('status','active')->get();
        $locations = Salves::all('location');
        $snames = Salves::all('salve_name');
        return view('salves.transfer.create')->with(['products' => $products, 'locations' => $locations, 'snames' => $snames]);
    }

    public function store_transfer(Request $request)
    {
        $transfers = DB::table('transfer_salve')
                    ->insert([
                        'product_id' => $request->input('product_id'),
                        'product_stock_id' => $request->input('product_stock_id'),
                        'salve_name' => $request->input('salve_name'),
                        'location' => $request->input('location'),
                        'date' => $request->input('date'),
                        'created_at' => date('Y-m-d h:i:s')
                    ]);        

        if($transfers) {
            DB::table('product_stock')
            ->where('id',$request->input('product_stock_id'))
            ->update(['status'=>'salve']);
        }            

        return redirect('/salve/transfer')->with('success','Data Added');    
    }

    public function edit_transfer($id)
    {
        $products = Product::where('status','active')->get();
        $locations = Salves::all('location');
        $snames = Salves::all('salve_name');

        $transfer = DB::table('transfer_salve')        
                    ->Join('products', 'transfer_salve.product_id', '=', 'products.id')
                    ->Join('product_stock', 'transfer_salve.product_stock_id', '=', 'product_stock.id')
                    ->where('product_stock.status','salve')
                    ->select('transfer_salve.*','products.product_name','product_stock.id as stock_id','products.id as pid')    
                    ->first();

        // $transfer = DB::table('transfer_salve')        
        //         ->where('id',$id)
        //         ->first();          
        return view('salves.transfer.edit')->with(['transfer' => $transfer, 'products' => $products, 'locations' => $locations, 'snames' => $snames]);
    }

    
    public function update_transfer(Request $request, $id)
    {
        $transfer = DB::table('transfer_salve')
                    ->where('id',$id)
                    ->update([
                        'product_id' => $request->input('product_id'),
                        'product_stock_id' => $request->input('product_stock_id'),
                        'salve_name' => $request->input('salve_name'),
                        'location' => $request->input('location'),
                        'updated_at' => date('Y-m-d h:i:s')
                    ]); 
        
        if($transfer) {
            $x = DB::table('product_stock')
            ->where('id',$request->input('product_stock_id'))
            ->update(['status'=>'salve']);
            if($x) {
                $x = DB::table('product_stock')
                ->where('id',$request->input('old_stock_id'))
                ->update(['status'=>'active']);
            }
        }  
        return redirect('/salve/transfer')->with('success','Data Updated');    
    }

    
    public function delete_transfer($id)
    {
        $delete = DB::table('transfer_salve')->where('id', '=', $id)->delete();
        return ['status' => 1 ];
    }


    // Apis
    public function stock_api($id) {

        $data = DB::table('product_stock')        
                ->Join('products', 'product_stock.product_id', '=', 'products.id')
                ->select('product_stock.id as stock_id','products.product_name as stock_p_name','product_stock.product_id','product_stock.product_no')
                ->orderBy('product_stock.product_no', 'desc')
                ->where('product_stock.product_id',$id)
                ->get();

        return ['status' => 'success','message' => 'Stock Successfully Get', 'data' => $data];
    }

}
