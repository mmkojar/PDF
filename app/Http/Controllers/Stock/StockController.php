<?php

namespace App\Http\Controllers\Stock;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StockController extends Controller
{
    public function __construct()
    {        
        $this->middleware(['auth','verified']);
    }

    public function index() {
       
        $stockin =  DB::table('stock_in')
            ->leftJoin('stock_items',"stock_items.id", "=", "stock_in.item_id")
            ->select("stock_in.*","stock_items.name as item_name")
            ->get();

        $stockout =  DB::table('stock_out')
            ->leftJoin('stock_items',"stock_items.id", "=", "stock_out.item_id")
            ->select("stock_out.*","stock_items.name as item_name")
            ->get();
        
        $stocksavail =  DB::table('stock_available')
            ->leftJoin('stock_items',"stock_items.id", "=","stock_available.item_id")
            ->select("stock_available.*","stock_items.name as item_name")       
            ->get();

        return view('stock.index')->with([
            'stockin' => $stockin,
            'stockout' => $stockout,
            'stocksavail' => $stocksavail,
            
        ]);
    }

    public function stock_api(){
              
        $stockin =  DB::table('stock_items')
        ->leftJoin('stock_in',"stock_items.id", "=", "stock_in.item_id")
        ->select("stock_in.qty as pqty","stock_items.name as item_name","stock_items.id as item_id")
        ->get();

        
        $stockout =  DB::table('stock_items')
            ->leftJoin('stock_out',"stock_items.id", "=", "stock_out.item_id")
            ->select("stock_out.qty as uqty","stock_items.name as item_name","stock_items.id as item_id")
            ->get();
       
        /* $data =  DB::table('stock_items')
                    ->leftJoin('stock_in',"stock_items.id", "=", "stock_in.item_id")
                    ->leftJoin('stock_out',"stock_items.id", "=", "stock_out.item_id")
                    ->select("stock_items.name","stock_in.qty as pqty","stock_out.qty as uqty","stock_in.date as pdate","stock_out.date as udate")
                    ->get(); */
        
        print_r(json_encode(['purchase'=>$stockin, 'use'=>$stockout]));
    }

    // Items
    public function items() {

        $items = DB::table('stock_items')->select("*")->get();        
        return view('stock.items.index')->with(['items' => $items]);
    }

    public function items_form($id=FALSE) {
        
        if($id) {
            $item = DB::table('stock_items')->where('id',$id)->select("*")->first();
            return view('stock.items.form')->with(['item' => $item]);
        }
        else {
            return view('stock.items.form');
        }        
    }

    public function store_items(Request $req) {
        
        $req->validate([
            'name' => 'required|unique:stock_items,name,'.$req->hidden_id,
        ]);
        
        if($req->hidden_id) {
            DB::table('stock_items')->where('id',$req->hidden_id)->update(['name'=>$req->name]);
            return redirect('/stock/items')->with('success','Record updated Successfully');
        }
        else {
            DB::table('stock_items')->insert(['name'=>$req->name]);
            return redirect('/stock/items')->with('success','Record Added Successfully');
        }
    }

    // Stock In
    public function stock_in_create() {

        $items =  DB::table('stock_items')->select("stock_items.*")->get();

        return view('stock.in.create')->with([
            'items' => $items,
        ]);
    }

    public function store_stock(Request $req) {

        $input = $req->all();
        //For Purchase
        if($input['stock_option'] == 'purchase') {
            $insertstockIN = DB::table('stock_in')->insert([
                'item_id' =>  $req->item_id,
                'party_name' =>  $req->party_name,
                'unit' =>  $req->unit,
                'qty' =>  $req->qty,
                'rate' =>  $req->rate,
                'total_amount' =>  $req->qty * $req->rate,
                'date' => $req->date,
                'created_at' => date('Y-m-d h:i:s')
            ]);
            
            $getStockAvail = DB::table('stock_available')->select("*")->where('item_id',$req->item_id)->get();
            
            $getStockIn = DB::table('stock_in')->select("*")->where('item_id',$req->item_id)->get();

            $sum_qty = 0;
            $sum_totamont = 0;
            foreach ($getStockIn as $value) {
                $sum_qty += $value->qty;
                $sum_totamont += $value->total_amount;
            }

            if(count($getStockAvail) > 0) {
                DB::table('stock_available')
                    ->where('item_id', $req->item_id)
                    ->update([
                        'qty' => $getStockAvail[0]->qty + $req->qty,
                        'rate' => number_format(($sum_totamont / $sum_qty),2),
                        'updated_at' => date('Y-m-d h:i:s'),
                ]);           
            }
            else {
                DB::table('stock_available')
                ->insert([
                    'item_id' =>  $req->item_id,
                    'unit' =>  $req->unit,
                    'qty' =>  $req->qty,
                    'rate' => (( $req->qty *  $req->rate) /  $req->qty),
                    'date' =>  $req->date,
                    'created_at' => date('Y-m-d h:i:s'),
                ]);
            }
        }
        else {
           
            $insert = DB::table('stock_out')->insert([
                'item_id' =>  $req->item_id,
                'unit' =>  $req->unit,
                'qty' =>  $req->qty,
                'date' => $req->date,
                'created_at' => date('Y-m-d h:i:s')
            ]);            

            if($insert) {
                DB::table('stock_available')
                    ->where('item_id', $req->item_id)
                    ->update([
                        'qty' => $req->hidden_qty - $req->qty,
                        'updated_at' => date('Y-m-d h:i:s'),
                ]);           
            }
        }
        
        return ['status' =>1, 'msg'=>'Stock Added Successfully'];
        // return redirect('/stock')->with('success','Record Added Successfully');
    }
    
    public function stock_in_edit($id) {

        $editIn =  DB::table('stock_in')
                ->Join('stock_items',"stock_items.id", "=", "stock_in.item_id")
                ->where('stock_in.id',$id)
                ->select("stock_in.*","stock_items.name as item_name")
                ->first();
        
        $items =  DB::table('stock_items')->select("stock_items.*")->get();
        
        return view('stock.in.edit')->with([
            'data'=> $editIn,
            'items' => $items,
            'hidden_id' => $id,
        ]);
    }

    public function stock_in_update(Request $req) {
        
        $input = $req->all();
        $input['updated_at'] = date('Y-m-d h:i:s');

        $update = DB::table('stock_in')->where('id', $req->hidden_id)->update([            
            'party_name' =>  $req->party_name,
            'unit' =>  $req->unit,
            'qty' =>  $req->qty,
            'rate' => $req->rate,
            'total_amount' => $req->rate * $req->qty,
            'date' =>  $req->date,
            'updated_at' => date('Y-m-d h:i:s'),
        ]);

        if($update) {
            $getStockIn = DB::table('stock_in')->select("*")->where('item_id',$req->item_id)->get();
            
            $sum_qty = 0;
            $sum_totamont = 0;
            foreach ($getStockIn as $value) {
                $sum_qty += $value->qty;
                $sum_totamont += $value->total_amount;
            }

            DB::table('stock_available')
                ->where('item_id', $req->item_id)
                ->update([
                    'unit' => $req->unit,
                    'rate' => number_format(($sum_totamont / $sum_qty),2),
                    'updated_at' => date('Y-m-d h:i:s'),
             ]);
        }

        return redirect('/stock')->with('success','Record Updated Successfully');
    }

    public function stock_in_delete($id,$itmid) {

        $data = DB::table('stock_out')->select("*")->where('item_id',$itmid)->get();

        if(count($data) > 0) {            
            return ['status' => 0 , 'msg' => 'Items Already sold Cannot be Deleted' ];
		}
		else {
            DB::table('stock_in')->where('id',$id)->delete();
            DB::table('stock_available')->where('item_id',$itmid)->delete();			
			return ['status' => 1 ];
		}
    }

    // Stock out
    public function stock_out_create() {

        $items =  DB::table('stock_available')
            ->leftJoin('stock_items',"stock_items.id", "=","stock_available.item_id")
            ->where('stock_available.qty', '!=', '0')
            ->select("stock_available.*","stock_items.name as item_name")
            ->get();

        return view('stock.out.create')->with([
            'items' => $items,
        ]);
    }

    public function stock_out_store(Request $req) {

        $input = $req->all();
        $input['total_amount'] = $req->qty * $req->rate;
        $input['created_at'] = date('Y-m-d h:i:s');
        unset($input['purchase_rate']);
        unset($input['hidden_qty']);
        unset($input['_token']);

        $insert = DB::table('stock_out')->insert($input);            

        if($insert) {
            DB::table('stock_available')
                ->where('item_id', $req->item_id)
                ->update([
                    'qty' => $req->hidden_qty - $req->qty,
                    'updated_at' => date('Y-m-d h:i:s'),
             ]);           
        }
        
        return redirect('/stock')->with('success','Record Added Successfully');
    }

    public function stock_out_edit($id) {

        $editOut =  DB::table('stock_out')
                ->Join('stock_items',"stock_items.id", "=", "stock_out.item_id")
                ->where('stock_out.id',$id)
                ->select("stock_out.*","stock_items.name as item_name")
                ->first();
        
        return view('stock.out.edit')->with([
            'data'=> $editOut,
            'hidden_id' => $id,
        ]);
    }

    public function stock_out_update(Request $req) {
        
        $input = $req->all();
        $input['updated_at'] = date('Y-m-d h:i:s');

        $update = DB::table('stock_out')->where('id', $req->hidden_id)->update([            
            'item_id' =>  $req->item_id,
            'unit' =>  $req->unit,
            'qty' =>  $req->qty,
            'rate' => $req->rate,
            'total_amount' => $req->rate * $req->qty,
            'date' =>  $req->date,
            'updated_at' => date('Y-m-d h:i:s'),
        ]);

        if($update) {
            $getStockIn = DB::table('stock_in')->select("*")->where('item_id',$req->item_id)->get();
            
            $sum_qty = 0;
            $sum_totamont = 0;
            foreach ($getStockIn as $value) {
                $sum_qty += $value->qty;
                $sum_totamont += $value->total_amount;
            }

            DB::table('stock_available')
                ->where('item_id', $req->item_id)
                ->update([
                    'rate' => number_format(($sum_totamont / $sum_qty),2),
                    'updated_at' => date('Y-m-d h:i:s'),
             ]);
        }

        return redirect('/stock')->with('success','Record Updated Successfully');
    }

    public function stock_out_delete($id,$itmid,$qty) {

        $delele =  DB::table('stock_out')->where('id',$id)->delete();

        if($delele) {            
            
            $stkoutqty = DB::table('stock_available')->where('item_id',$itmid)->select("*")->first();

            DB::table('stock_available')
                ->where('item_id', $itmid)
                ->update([
                    'qty' => $stkoutqty->qty + $qty,
                    'updated_at' => date('Y-m-d h:i:s'),
             ]);
			return ['status' => 1 ];
		}
    }

    public function stock_out_api($id){
        
        $data =  DB::table('stock_available')
            ->leftJoin('stock_items',"stock_items.id", "=","stock_available.item_id")
            ->where('stock_available.item_id',$id)
		    ->where('stock_available.qty', '!=','0')
            ->select("stock_available.*","stock_items.name as item_name")       
            ->get();
                   
        print_r(json_encode($data));
    }
}
