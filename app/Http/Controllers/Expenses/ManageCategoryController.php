<?php

namespace App\Http\Controllers\Expenses;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ManageCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        $category_manage = DB::table('category_management')->select('category_management.*')->get();
             
        $category_manage_amount = DB::table('category_management_amount')
            ->select('category_management_amount.*')
            ->orderBy('category_management_amount.date', 'desc')
            ->get();
        return view('expenses.category_manage.index')->with(['category_manage'=> $category_manage,'category_manage_amount'=>$category_manage_amount]);
    }

    public function create()
    {
        return view('expenses.category_manage.create');
    }

 
    public function store(Request $request)
    {

        // For Total Amount By Customer
        $get_amount = DB::table('category_management')
            ->where('party_name',$request->party_name)
            ->select('amount')
            ->get();
        
        $total_amount_sum = 0;
        foreach($get_amount as $t) {
            $total_amount_sum += $t->amount + $request->input('amount');
        }

        //For Total Amount By Month
        $get_month_amount = DB::table('category_management')
            ->where('party_name',$request->party_name)
            ->where('month',$request->month)
            ->select('amount')
            ->get();
        
        $total_month_amount_sum = 0;
        foreach($get_month_amount as $t) {
            $total_month_amount_sum += $t->amount + $request->input('amount');
        }

        $category_manage = DB::table('category_management')->insert([
            'category_name' => $request->category_name,
            'party_name' => $request->party_name,
            'amount' => $request->amount,
            'total_amount_by_customer' => $total_amount_sum,
            'total_amount_by_month' => $total_month_amount_sum,
            'quantity' => $request->quantity,
            'date' => $request->date,
            'month' => $request->month,
            'created_at' => date('Y-m-d h:i:s'),        
        ]);
        
        if($category_manage) {
            DB::table('category_management')
                ->where('party_name',$request->party_name)
                ->update([
                    'total_amount_by_customer' => $total_amount_sum ? $total_amount_sum : $request->amount
                ]);
            DB::table('category_management')
                ->where('month',$request->month)
                ->where('party_name',$request->party_name)
                ->update([
                    'total_amount_by_month' => $total_month_amount_sum ? $total_month_amount_sum : $request->amount
                ]);
        }
    
        return redirect('/category_management')->with('success','Record Created');
    }

    public function delete($id)
    {
        $categody_manage = DB::table('category_management')->where('id',$id)->delete();
        if($categody_manage) {
            return ['status' => 1 ];
        }        
    }

    // For Category Amount
    
    public function cat_manage_amount_api($id) {
                        
        $items = DB::table('category_management')->where('party_name', '=', $id)->groupBy('month')->get(); 
        return ['status' => 1 , 'data' => $items];    
    }

    public function cat_manage_amount_create(Request $request) {
                        
        $items = DB::table('category_management')->select('category_management.*')->get();
        return view('expenses.category_manage.amount.create')->with('items',$items);       
    }

    public function cat_manage_amount_store(Request $request) {
                               
        $input['party_name'] = $request->party_name;
        $input['description'] = $request->description;
        $input['amount_paid'] = $request->amount_paid;
        $input['month'] = $request->month;
        $input['date'] = $request->date;
        $input['created_at'] = date('Y-m-d h:i:s');
        $insert = DB::table('category_management_amount')->insert($input);
                
        $get_amount = DB::table('category_management')
            ->where(['party_name'=>$request->party_name,'month'=>$request->month])
            ->get();


        $total_amount_paid_sum_cus = 0;
        $total_amount_paid_sum_mon = 0;
        foreach($get_amount as $t) {
            $total_amount_paid_sum_cus = $t->total_amount_paid_by_customer + $request->amount_paid;
            $total_amount_paid_sum_mon = $t->total_amount_paid_by_month + $request->amount_paid;
        }
        if($insert) {
            DB::table('category_management')
            ->where(['party_name'=>$request->party_name])
            ->update([
                'total_amount_paid_by_customer' => $total_amount_paid_sum_cus
            ]);
            DB::table('category_management')
            ->where(['party_name'=>$request->party_name])
            ->where(['month'=>$request->month])
            ->update([
                'total_amount_paid_by_month' => $total_amount_paid_sum_mon
            ]);
        }

        return redirect('/category_management')->with('success','Data Added');    
    }
}
