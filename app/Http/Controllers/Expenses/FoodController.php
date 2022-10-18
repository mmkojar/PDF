<?php

namespace App\Http\Controllers\Expenses;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Food;

class FoodController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        $foods = Food::orderBY('created_at','DESC')->get();
        
        // // $foods = DB::table('food')                        
        // //     ->leftJoin('food_amount_paid', 'food_amount_paid.month', '=', 'food.month')
        // //     // ->orwhere('food_amount_paid.party_name','=','food.party_name')
        // //     ->select('food.*','food_amount_paid.amount_paid')
        // //     ->orderBy('food.date', 'desc')
        // //     ->get();
        
        // $foods = DB::table('food')
        //     ->join('food_amount_paid', function ($join) {
        //         $join->on('food_amount_paid.party_name', '=', 'food.party_name')
        //             ->On('food_amount_paid.month', '=', 'food.month');
        //     })->select('food.*','food_amount_paid.amount_paid')->get();

        // return $foods;
        
        $stock_use = DB::table('food_stock_use')
            ->select('food_stock_use.*')
            ->orderBy('food_stock_use.date', 'desc')
            ->get();
        $food_amount = DB::table('food_amount_paid')                        
            ->select('food_amount_paid.*')
            ->orderBy('food_amount_paid.date', 'desc')
            ->get();
        return view('expenses.food.index')->with(['foods'=> $foods,'stock_use'=> $stock_use,'food_amount'=>$food_amount]);
    }

    public function create()
    {
        return view('expenses.food.create');
    }

 
    public function store(Request $request)
    {
        // For Quantity
        $get_qty = DB::table('food')
            ->where('item_name',$request->item_name)
            ->oldest('quantity')
            ->first();
        
        /* return $get_qty->quantity;
        die(); */
        /* $total_sum = 0;
        foreach($get_qty as $x) {
            $total_sum += $x->quantity;
        } */

        // For Total Amount By Customer
        $get_amount = DB::table('food')
            ->where('party_name',$request->party_name)
            ->select('amount')
            ->get();
        
        $total_amount_sum = 0;
        foreach($get_amount as $t) {
            $total_amount_sum += $t->amount + $request->input('amount');
        }

        //For Total Amount By Month
        $get_month_amount = DB::table('food')
            ->where('party_name',$request->party_name)
            ->where('month',$request->month)
            ->select('amount')
            ->get();
        
        $total_month_amount_sum = 0;
        foreach($get_month_amount as $t) {
            $total_month_amount_sum += $t->amount + $request->input('amount');
        }

        $food = new Food();
        $food->item_name = strtolower($request->input('item_name'));
        $food->party_name = strtolower($request->input('party_name'));
        $food->amount = $request->input('amount');
        $food->total_amount_by_customer = $total_amount_sum;
        $food->total_amount_by_month = $total_month_amount_sum;
        if($get_qty) {
            $food->quantity = $request->input('quantity') + $get_qty->quantity;
            $food->total_quantity = $request->input('quantity') + $get_qty->quantity;
        }
        else {
            $food->total_quantity = $request->input('quantity');
            $food->quantity = $request->input('quantity');
        }
        $food->date = $request->input('date');
        $food->month = $request->input('month');
        if($food->save()) {
            DB::table('food')
                ->where('party_name',$request->party_name)
                ->update([
                    'total_amount_by_customer' => $total_amount_sum ? $total_amount_sum : $food->amount
                ]);
            DB::table('food')
                ->where('month',$request->month)
                ->where('party_name',$request->party_name)
                ->update([
                    'total_amount_by_month' => $total_month_amount_sum ? $total_month_amount_sum : $food->amount
                ]);
        }

        

        return redirect('/food')->with('success','Record Created');
    }

    public function edit($id)
    {
        $food = Food::find($id);
        return view('expenses.food.edit')->with('food', $food);
    }


    public function update(Request $request, $id)
    {
        $food = Food::find($id);
        $food->item_name = $request->input('item_name');
        $food->party_name = $request->input('party_name');
        $food->amount = $request->input('amount');
        $food->quantity = $request->input('quantity');
        $food->date = $request->input('date');
        $food->save();

        return redirect('/food')->with('success','Record Updated');
    }


    public function delete($id)
    {
        $food =  Food::find($id);        
        $food->delete();
        return ['status' => 1 ];
    }

    // For Stock Used

    public function food_use_create(Request $request) {
                        
        $items = Food::select('item_name')->get();
        return view('expenses.food.stockused.create')->with(['items'=>$items]);       
    }

    public function get_bal_qty($itm) {
        $qty = Food::select('quantity')->where('item_name',$itm)->latest('created_at')->first();
        print_r(json_encode($qty));
    }

    public function food_use_store(Request $request) {
                               
        $input['item_name'] = $request->item_name;
        $input['quantity'] = $request->quantity;
        $input['date'] = $request->date;
        $input['created_at'] = date('Y-m-d h:i:s');
        $insert = DB::table('food_stock_use')->insert($input);
        
        // $get_quantity =  DB::table('food')->where('item_name',$request->item_name)->get();
        $get_quantity = DB::table('food')->where('item_name',$request->item_name)->latest('created_at')->first();
        
        // return $get_quantity;
        // echo '<pre>';
        // print_r($get_quantity);
        // die();
        if($insert) { 
            if($get_quantity->quantity < 1  ) {
                DB::table('food')
                ->where('item_name',$request->item_name)
                ->where('id', $get_quantity->id)
                ->update([
                    'quantity' => $get_quantity->total_quantity - $request->quantity
                ]);
            }
            else {
                DB::table('food')
                ->where('item_name',$request->item_name)
                ->where('id', $get_quantity->id)
                ->update([
                    'quantity' => $get_quantity->quantity - $request->quantity
                ]);
            }
            
        }

        return redirect('/food')->with('success','Data Added');    
    }

    public function food_use_edit($id)
    {
        $food = DB::table('food_stock_use')->where('id',$id)->first();
        return view('expenses.food.stockused.edit')->with('food', $food);
    }


    public function food_use_update(Request $request, $id)
    {
        $input['item_name'] = $request->item_name;
        $input['quantity'] = $request->quantity;
        $input['date'] = $request->date;
        $input['updated_at'] = date('Y-m-d h:i:s');
        $insert = DB::table('food_stock_use')->where('id',$id)->update($input);

        return redirect('/food')->with('success','Record Updated');
    }

    public function delete_food_use($id)
    {   
        $delete = DB::table('food_stock_use')->where('id', '=', $id)->delete();         
        if($delete) {
            return ['status' => 1 ];
        }       
    }

    // For Amount Paid
    
    public function food_amount_create(Request $request) {
                        
        $items = Food::all();
        return view('expenses.food.amountpaid.create')->with('items',$items);       
    }

    public function food_amount_api($id) {
                        
        $items = DB::table('food')->where('party_name', '=', $id)->groupBy('month')->get(); 
        return ['status' => 1 , 'data' => $items];    
    }


    public function food_amount_store(Request $request) {
                               
        $input['party_name'] = $request->party_name;
        // $input['item_name'] = $request->item_name;
        $input['description'] = $request->description;
        $input['amount_paid'] = $request->amount_paid;
        // $input['taken_date'] = $request->taken_date;
        // $input['paid_date'] = $request->paid_date;
        $input['month'] = $request->month;
        $input['date'] = $request->date;
        $input['created_at'] = date('Y-m-d h:i:s');
        $insert = DB::table('food_amount_paid')->insert($input);
                
        $get_amount = DB::table('food')
            ->where(['party_name'=>$request->party_name,'month'=>$request->month])
            ->get();


        $total_amount_paid_sum_cus = 0;
        $total_amount_paid_sum_mon = 0;
        foreach($get_amount as $t) {
            $total_amount_paid_sum_cus = $t->total_amount_paid_by_customer + $request->amount_paid;
            $total_amount_paid_sum_mon = $t->total_amount_paid_by_month + $request->amount_paid;
        }
        if($insert) {
            DB::table('food')
            ->where(['party_name'=>$request->party_name])
            ->update([
                'total_amount_paid_by_customer' => $total_amount_paid_sum_cus
            ]);
            DB::table('food')
            ->where(['party_name'=>$request->party_name])
            ->where(['month'=>$request->month])
            ->update([
                'total_amount_paid_by_month' => $total_amount_paid_sum_mon
            ]);
        }

        /* $get_amount = DB::table('food')
            ->where(['party_name'=>$request->party_name,'item_name'=>$request->item_name,'date'=>$request->taken_date])
            ->get();        
        // return $get_amount;
        if($insert) { 
            DB::table('food')
            ->where(['party_name'=>$request->party_name,'item_name'=>$request->item_name,'date'=>$request->taken_date])
            ->update([
                'amount_paid' => $get_amount[0]->amount_paid + $request->amount_paid,
                // 'pending_amount' => $get_amount[0]->amount - $get_amount[0]->amount_paid,
            ]);
        } */

        return redirect('/food')->with('success','Data Added');    
    }
}


