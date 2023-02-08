<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Location;
use App\Helper\Helper;
use Gate;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }
    
    public function index()
    {
        $products = Product::orderBY('created_at','desc')->get();        
        return view('products.product')->with('products', $products);
    }

    public function store(Request $request)
    {

        $id = $request->input('hidden_prod_id');
        
        if($id) {
            $product = Product::find($id);
            $product->product_name = $request->p_name;
            $product->status = $request->status;
            $product->save();

            return redirect('/categories')->with('success','Category updated');
        }
        else {
            $product = new Product();
            $product->product_name = $request->input('p_name');
            // $product->product_description = $request->input('p_description');
            $product->status = 'active';
            $product->save();

            return redirect('/categories')->with('success','Category Created');
        }
        
    }

    public function edit($id)
    {
        if(Gate::denies('all-access')){
            return redirect('/dashboard');
        }
        $product = Product::find($id);
        return ['status' => 1, 'product' => $product];
    }

    public function delete($id)
    {   
        $product =  Product::find($id);        
        $delete = $product->delete();
		
        if($delete) {
            DB::table('product_stock')->where('product_id', '=', $id)->delete();
            DB::table('processing_data')->where('product_id', '=', $id)->delete();
            DB::table('medical_checkup')->where('product_id', '=', $id)->delete();
            DB::table('ghabhan_detail')->where('product_id', '=', $id)->delete();
            return ['status' => 1 ];
        }                           
        // return redirect('/product')->with('error','Product Deleted');
    }

    // For Stock Products

    public function stock() {
        
        $stocks = DB::table('product_stock')        
                ->Join('products', 'product_stock.product_id', '=', 'products.id')
                ->leftJoin('locations', 'product_stock.location_id', '=', 'locations.id')
                // ->where('product_stock.status','active')
                ->select('product_stock.*','products.product_name','locations.name as lname')
                ->orderBy('product_stock.product_no', 'asc')
                ->get();

        return view('products.stock.index')->with('stocks', $stocks);
    }

    public function create_stock() {        
        
        $products = Product::where('status','active')->get();        
        return view('products.stock.create')->with(['products'=> $products]);
    }
    
    public function store_stock(Request $request) {
        
        if($request->product_no > 0) {
            for($i = 0; $i < count($request->product_no); $i++) {
                $input['quantity'] = 1;
                $input['product_id'] = $request->product_listing;
				$input['product_no'] = $request->product_no[$i];
				// $input['location_id'] = $request->location_id[$i];
				// $input['khilla_no'] = $request->khilla_no[$i];
                $input['gender'] = $request->gender;
                $input['purchase_from'] = $request->ps_purchase_from;
                $input['purchase_date'] = $request->ps_purchase_date;
                $input['party_name'] = $request->ps_party_name;
                $input['status'] = 'active';
                $input['created_at'] = date('Y-m-d h:i:s');
                $id = DB::table('product_stock')->insertGetId($input);
				
				// DB::table('khilla')
                //     ->where('location_id', $request->location_id[$i])
                //     ->where('khilla_no', $request->khilla_no[$i])
                //     ->update([
                //         'status2' => 'booked',
                //         'updated_at' => date('Y-m-d h:i:s')
                // ]);
                // $input2['product_id'] = $request->product_listing;
                // $input2['product_no'] = $request->product_no[$i];
                // $input2['product_stock_id'] = $id;                
                // $d =  DB::table('days')->select('processing_days')->get(); 
                // $date1 = str_replace('-', '/', $request->ps_purchase_date);
                // $newdate = date('Y-m-d',strtotime($request->ps_purchase_date . +$d[0]->processing_days."days"));                
                // $input2['processing_date'] = $newdate;
                // DB::table('audit_log')->insert($input2);
            }
        }
        return redirect('/product_stock')->with('success','Product Stock Added');    
    }

    public function edit_stock($id)
    {
        if(Gate::denies('all-access')){
            return redirect('/dashboard');
        }
        
        $products = Product::where('status','active')->get();
        $locations = Location::all();
        
        $stock = DB::table('product_stock')
        ->rightJoin('products', 'product_stock.product_id', '=', 'products.id')
        ->leftJoin('locations', 'product_stock.location_id', '=', 'locations.id')
        ->where('product_stock.id', '=', $id)
        ->select('product_stock.*','products.product_name','locations.name as lname')
        ->first();
		
        $khillas = DB::table('khilla')
        ->select('khilla.*')        
        ->where('khilla.location_id',$stock->location_id)        
		->orderBy('khilla.khilla_no', 'asc')
        ->get();
        
        // Helper::debug($stock);
        return view('products.stock.edit')->with([ 'stock' => $stock , 'products' => $products, 'locations' => $locations, 'khillas' => $khillas]);
    }

    public function delete_stock($id)
    {   
		$stock = DB::table('product_stock')->where('id',$id)->get();		
		/* DB::table('khilla')
			->where('location_id', $stock[0]->location_id)
			->where('khilla_no', $stock[0]->khilla_no)
			->update([
				'status2' => 'free',
				'updated_at' => date('Y-m-d h:i:s')
		]); */
        $delete = DB::table('product_stock')->where('id', '=', $id)->delete();		
        if($delete) {
            DB::table('processing_data')->where('product_stock_id', '=', $id)->delete();
            DB::table('medical_checkup')->where('product_stock_id', '=', $id)->delete();
            DB::table('ghabhan_detail')->where('product_id', '=', $id)->delete();
            return ['status' => 1 ];
        }			            
    }

    public function update_stock(Request $request, $id) {
        
        // $get_old_khill = DB::table('product_stock')->where('id',$id)->get();
        $product_stock = DB::table('product_stock')
                ->where('id', $id)
                ->update([
                    'product_id' => $request->product_id,
                    'product_no' => $request->product_no,
                    // 'location_id' => $request->location_id,
                    // 'khilla_no' => $request->khilla_no,
                    // 'extra_khilla_no' => $request->extra_khilla_no,
                    'gender' => $request->gender,
                    'quantity' => 1,
                    'purchase_from' => $request->ps_purchase_from,
                    'purchase_date' => $request->purchase_date,
                    'party_name' => $request->ps_party_name,
                    'status' => $request->ps_purchase_status,
                    'updated_at' => date('Y-m-d h:i:s')
                ]);
                $input2['product_no'] = $request->product_no;
                DB::table('audit_log')->where('product_stock_id', $id)->update($input2);
         
        /* if($product_stock) {
            if($request->extra_khilla_no !== null) {
                DB::table('khilla')
                    ->where('location_id', $get_old_khill[0]->location_id)
                    ->where('khilla_no', $get_old_khill[0]->khilla_no)
                    ->update([
                        'status2' => 'free',
                        'updated_at' => date('Y-m-d h:i:s')
                ]);
            }
            else {
                DB::table('khilla')
                ->where('location_id', $request->location_id)
                ->where('khilla_no', $request->khilla_no)
                ->update([
                    'status2' => 'booked',
                    'updated_at' => date('Y-m-d h:i:s')
                ]);
            }
            
        } */       
        return redirect('/product_stock')->with('success','Product Stock Updated');
    }

    public function khilla_api ($id) {
        	
		$data = DB::table('khilla')
		->select('khilla.*')
		->orderBy('khilla.khilla_no', 'asc')
		->where('khilla.location_id',$id)
		->get();

		$data2 = DB::table('product_stock')
		->select('product_stock.khilla_no')
		->where('product_stock.location_id',$id)
		->get();

		return ['status' => 'success','message' => 'Data Successfully Get', 'data' => $data, 'data2' => $data2];
			
	}
	
	public function pkl_api () {
        		
		$locations = Location::all();       
		return response()->json($locations);		
		
	}

    public function unique_prod_no($no) {

        $data = DB::table('product_stock')
        ->select('product_stock.*')
        ->where([ 'product_stock.product_no' => $no, 'status'=>'active'])
        ->get();
        
        if(count($data) > 0) {
            return ['status' => 0 , 'msg' => 'This No. is Already taken'];
        }
        else {
            return ['status' => 1, 'msg' => 'Available'];
        } 
        
    }

}
