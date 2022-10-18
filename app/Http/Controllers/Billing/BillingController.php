<?php

namespace App\Http\Controllers\Billing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\Models\Customer;
use App\Helper\Helper;
use Carbon\Carbon;
use DateTime;

class BillingController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index() {

        $total_billings = DB::table('weekly_billing')
            ->Join('customers', 'weekly_billing.customer_id', '=', 'customers.id')
            ->select('weekly_billing.*','customers.customer_name','customers.customer_type')
            ->orderBy('weekly_billing.bill_no', 'DESC')
            ->get();
        
        
        $amount_paid_data = DB::table('wekkly_billing_pending_amount')
            ->Join('customers', 'wekkly_billing_pending_amount.customer_id', '=', 'customers.id')
            ->select('wekkly_billing_pending_amount.*','customers.customer_name')
            ->orderBy('wekkly_billing_pending_amount.id', 'DESC')
            ->get();

       /*  $weekly_billings_all = DB::table('weekly_billing_all_customers')
            ->select('weekly_billing_all_customers.*')
            ->where('bill_period','weekly')
            ->get();
            
        $monthly_billings_all = DB::table('weekly_billing_all_customers')
            ->select('weekly_billing_all_customers.*')
            ->where('bill_period','monthly')
            ->get(); */

                
        // $weekly_billings_for_cash = DB::table('weekly_billing')
        //     ->Join('customers', 'weekly_billing.customer_id', '=', 'customers.id')
        //     ->select('weekly_billing.*','customers.customer_name','customers.customer_type')
        //     // ->where('weekly_billing.from_date', $get_first_row->from_date)
        //     // ->where('weekly_billing.to_date', $get_first_row->to_date)
        //     ->simplePaginate(14);
        
        // Helper::debug($weekly_billings_for_cash);
            
        return view('billings.index')->with([
            'total_billings' => $total_billings, 
            'amount_paid_data' => $amount_paid_data,
            // 'weekly_billings_all' => $weekly_billings_all,
            // 'monthly_billings_all' => $monthly_billings_all
            // 'weekly_billings_for_cash' => $weekly_billings_for_cash
        ]);
    }

    /*  public function pagination(Request $request) {

        if($request->ajax())
        {                       
            $page = $request->input('page', 1);

            $x = DB::table('weekly_billing')->first();
            $y = date('Y-m-d',strtotime($x->from_date . "-1 day"));
                       
            $from = Carbon::parse(new Datetime($x->from_date))->addWeeks($page - 1);
            $to = Carbon::parse(new Datetime($y))->addWeeks($page);
            $fromString = $from->format('Y-m-d'); 
            $toString = $to->format('Y-m-d');
            
            $weekly_billings_for_cash_1 = DB::table('weekly_billing')
                ->Join('customers', 'weekly_billing.customer_id', '=', 'customers.id')
                ->select('weekly_billing.*','customers.customer_name','customers.customer_type')        
                ->where('weekly_billing.from_date', $fromString)
                ->where('weekly_billing.to_date', $toString)
                ->get();

            $test = count($weekly_billings_for_cash_1);

            $weekly_billings_for_cash = DB::table('weekly_billing')
                ->Join('customers', 'weekly_billing.customer_id', '=', 'customers.id')
                ->select('weekly_billing.*','customers.customer_name','customers.customer_type')        
                ->where('weekly_billing.from_date', $fromString)
                ->where('weekly_billing.to_date', $toString)
                ->simplePaginate($test);
                // ->get();
               
            
            return view('billings.paginate', compact('weekly_billings_for_cash'))->render();                    

        }
        
    } */

    public function create() {

        $customers = Customer::where('status','active')->get();
        return view('billings.create')->with(['customers'=> $customers]);
    }

    public function store(Request $request) {

        $wid = $request->input('hidden_week_id');

        if($wid) {
            
            // foreach($request->hidden_week_id as $hidden_wid) {
            for($i = 0; $i < count($request->hidden_week_id); $i++) {
                $get_pd_amt = DB::table('weekly_billing')
                ->where('id',$request->hidden_week_id[$i])
                ->first();
                                                                  
                $billing = DB::table('weekly_billing')
                ->where('id', $request->hidden_week_id[$i])
                ->update([
                    // 'customer_id' => $request->customer_id,
                    // 'bill_no' => $request->bill_no,
                    // 'from_date' => $request->from_date,
                    // 'to_date' => $request->to_date,
                    // 'total_litres' => $request->total_litres,
                    'total_amount' => $request->total_amount[$i],
                    'amount_paid' => $get_pd_amt->amount_paid+$request->amount_paid[$i],
                    'pending_amount' => $request->total_amount[$i]-($get_pd_amt->amount_paid+$request->amount_paid[$i]+$request->adjusted[$i]+$get_pd_amt->adjusted),
                    'adjusted' => $get_pd_amt->adjusted+$request->adjusted[$i],
                    'updated_at' => date('Y-m-d h:i:s')
                ]);
                
                if($billing) {
                    if($request->amount_paid[$i] != 0) {
                        DB::table('wekkly_billing_pending_amount')
                        ->insert([
                            'customer_id' => $request->hidden_customer_id[$i],
                            'bill_no' => $request->hidden_bill_no[$i],
                            'amount' => $request->amount_paid[$i],
                            'from_to_date' => $request->from_date[$i].' to '.$request->to_date[$i],
                            'date' => $request->cash_date[$i],
                            'created_at' => date('Y-m-d h:i:s')
                        ]);
                    }
                    
                    
                    /*$get_pd_amt_week = DB::table('weekly_billing')
                    ->where(['from_date'=> $request->from_date[$i],'to_date'=> $request->to_date[$i]])
                    ->get();
                                        
                    $set_all_paid_amt = 0;
                    $set_all_adjusted = 0;
                    // $set_all_rem_bal = 0;
                    foreach($get_pd_amt_week as $x) {
                        $set_all_paid_amt += $x->amount_paid;
                        $set_all_adjusted += $x->adjusted;
                        // $set_all_rem_bal += $x->pending_amount;
                    }                   
                    DB::table('weekly_billing_all_customers')
                    ->where(['from_date'=> $request->from_date[$i],'to_date'=> $request->to_date[$i]])
                    ->update([
                        'amount_paid' => $set_all_paid_amt,
                        'adjusted' =>  $set_all_adjusted,
                        // 'remaining_balance' => $set_all_rem_bal,
                        'updated_at' => date('Y-m-d h:i:s')
                    ]);  
                    */
                }

            }
            return ['status' =>1, 'msg'=>'Entry Updated'];
            // return redirect('/billing')->with('success','Invoice Updated');

        }
        else {
            
            foreach($request->customer_id as $cid) {
                $diff_days = (strtotime($request->to_date) - strtotime($request->from_date)) / (60 * 60 * 24)+1;                
                if($diff_days <= 31) {
    
                    $soldsdata = DB::table('milksolds')
                    ->whereBetween('sold_date', [$request->from_date, $request->to_date])
                    ->where('customer_id', '=', $cid)
                    ->orderBy('milksolds.sold_date', 'ASC')
                    ->get();
    
                    if(count($soldsdata) > 0) {
                        
                        $checkGeneratedInvoice = DB::table('weekly_billing')
                        ->where(['customer_id' => $cid, 'from_date' => $request->from_date, 'to_date' => $request->to_date])
                        ->get();
                        
                        if(count($checkGeneratedInvoice) < 1) {
                                        
                            $set_total_amt = 0;
                            $set_total_lit = 0;
                            foreach($soldsdata as $t) {
                                $set_total_amt += $t->total_amount;
                                $set_total_lit += $t->total_litres;
                            }
                            
                            //$diff_days = (strtotime($request->to_date) - strtotime($request->from_date)) / (60 * 60 * 24)+1;
                            // echo $diff_days.'<br>';
                            // echo $request->from_date.'<br>';
                            // echo $request->to_date.'<br>';
                            // echo date('Y-m-d',strtotime($request->from_date .'-'.$diff_days." day"));
                            // echo date('Y-m-d',strtotime($request->to_date .'-'.$diff_days." day"));
                            
                            /* if($diff_days == 7) {
                                $get_pending_amount_for_week = DB::table('weekly_billing')
                                    ->where(['customer_id' => $cid])
                                    ->whereNotBetween('from_date', [$request->from_date, $request->to_date])
                                    ->whereNotBetween('to_date', [$request->from_date, $request->to_date])
                                    ->where('from_date','=',date('Y-m-d',strtotime($request->from_date .'-'.$diff_days." day")))
                                    ->where('to_date','=',date('Y-m-d',strtotime($request->to_date .'-'.$diff_days." day")))                                    
                                    ->get();
                            }
                            else if($diff_days == 31 || $diff_days == 30 || $diff_days == 29 || $diff_days == 28) {                                
                                $currentMonth = date('M Y',strtotime($request->from_date));
                                $last_month =  Date('M Y', strtotime($currentMonth . " last month"));
                                $get_pending_amount_for_week = DB::table('weekly_billing')
                                    ->where(['customer_id' => $cid])
                                    ->whereNotBetween('from_date', [$request->from_date, $request->to_date])
                                    ->whereNotBetween('to_date', [$request->from_date, $request->to_date])                                    
                                    ->where('month',$last_month)
                                    ->get();                                    
                            } */
                                $get_pending_amount_for_week = DB::table('weekly_billing')
                                    ->where('customer_id',$cid)
                                    ->orderBy('created_at', 'desc')
                                    ->take(1)
                                    ->get();
                            /* $get_pending_amount_for_week = DB::table('weekly_billing')
                                ->where(['customer_id' => $cid])
                                ->orderBy('created_at', 'desc')
                                ->skip(1)
                                ->take(1)
                                ->get();
                             */
                            // Helper::debug($get_pending_amount_for_week);
                            $set_pending_amount = 0;
                            foreach($get_pending_amount_for_week as $pw) {
                                $set_pending_amount += $pw->pending_amount;
                            }
                            
                            // Generate Bill No                            
                            $newbillno = 0;
                            $bill_no = DB::table('weekly_billing')->latest('bill_no')->first();
                            if($bill_no) {
                                $newbillno += $bill_no->bill_no+1;
                            }
                            else {
                                $newbillno += $bill_no+1;
                            }                          
                            /* if($diff_days == 7 || $diff_days == 8) {
                                $bill_period = 'weekly';
                            }
                            if($diff_days == 31 || $diff_days == 30 || $diff_days == 29 || $diff_days == 28) {
                                $bill_period = 'monthly';
                            } */
                            $w_billing = DB::table('weekly_billing')
                            ->insert([
                                'customer_id' => $cid,
                                'bill_no' => $newbillno,
                                'bill_period' => '',
                                'from_date' => $request->from_date,
                                'to_date' => $request->to_date,
                                'month' => date('M Y',strtotime($request->from_date)),
                                'total_litres' => $set_total_lit,
                                'amount' => $set_total_amt,
                                'previous_balance' => $set_pending_amount,
                                'total_amount' => $set_total_amt+$set_pending_amount,
                                'amount_paid' => 0,
                                'pending_amount' => $set_total_amt+$set_pending_amount,
                                'adjusted' => 0,
                                'created_at' => date('Y-m-d h:i:s')
                            ]);   

                            /* if($w_billing) {
                                $check_weekly_billing_all_customers = DB::table('weekly_billing_all_customers')
                                ->where(['from_date' => $request->from_date, 'to_date' => $request->to_date])
                                ->get();                                

                                // changes
                                // Fetch All Data From Sold
                                $mystring = implode(",",$request->customer_id);
                                $myarray = explode(",",$mystring);
                                $all_customer_data = DB::table('milksolds')
                                ->Join('customers', 'milksolds.customer_id', '=', 'customers.id')
                                ->whereBetween('sold_date', [$request->from_date, $request->to_date])
                                // ->whereIn('customer_id', $myarray)
                                ->where('customers.bill_period',$bill_period)
                                ->orderBy('milksolds.sold_date', 'ASC')
                                ->get();
                                // changes
                                
                                $set_all_total_amt = 0;
                                $set_all_total_lit = 0;
                                foreach($all_customer_data as $t) {
                                    $set_all_total_amt += $t->total_amount;
                                    $set_all_total_lit += $t->total_litres;
                                }
                                                    
                               $diff_days = (strtotime($request->to_date) - strtotime($request->from_date)) / (60 * 60 * 24)+1;
                                
                                // Get Pending Amount Of All Customer

                                if($diff_days == 7 || $diff_days == 8) {
                                    
                                    $all_week_pending_amount = DB::table('weekly_billing')
                                    ->whereNotBetween('from_date', [$request->from_date, $request->to_date])
                                    ->whereNotBetween('to_date', [$request->from_date, $request->to_date])
                                    ->where('from_date','=',date('Y-m-d',strtotime($request->from_date .'-'.$diff_days." day")))
                                    ->where('to_date','=',date('Y-m-d',strtotime($request->to_date .'-'.$diff_days." day")))                                    
                                    ->get();
                                }
                                else if($diff_days == 31 || $diff_days == 30 || $diff_days == 29 || $diff_days == 28) {
                                    
                                    $currentMonth = date('M Y',strtotime($request->from_date));
                                    $last_month =  Date('M Y', strtotime($currentMonth . " last month"));
                                    $all_week_pending_amount = DB::table('weekly_billing')
                                    ->whereNotBetween('from_date', [$request->from_date, $request->to_date])
                                    ->whereNotBetween('to_date', [$request->from_date, $request->to_date])
                                    ->where('month',$last_month)
                                    ->get();
                                }                        
                                $set_previous_bal = 0;
                                foreach($all_week_pending_amount as $wp) {
                                    $set_previous_bal += $wp->pending_amount;
                                }
                                
                                // Get Paid Amount Of Current Week
                                $current_week_paid_amount = DB::table('weekly_billing')
                                ->whereBetween('from_date',[$request->from_date, $request->to_date])
                                ->whereBetween('to_date',[$request->from_date, $request->to_date])
                                ->get();
                                                                        
                                $set_paid_amount = 0;
                                $set_adjusted = 0;
                                foreach($current_week_paid_amount as $w) {
                                    $set_paid_amount += $w->amount_paid;
                                    $set_adjusted += $w->adjusted;
                                }
                                // if($diff_days == 7) {
                                //     $bill_period = 'weekly';
                                // }
                                // if($diff_days == 10) {
                                //     $bill_period = 'ten_days';
                                // }
                                // if($diff_days == 31 || $diff_days == 30 || $diff_days == 29 || $diff_days == 28) {
                                //     $bill_period = 'monthly';
                                // }
                                if(count($check_weekly_billing_all_customers) < 1) {
                
                                    $billing = DB::table('weekly_billing_all_customers')
                                    ->insert([
                                        // 'bill_no' => $newbillno,
                                        'from_date' => $request->from_date,
                                        'to_date' => $request->to_date,
                                        'bill_period' => $bill_period,
                                        'total_litres' => $set_all_total_lit,
                                        'amount' => $set_all_total_amt,
                                        'previous_balance' => $set_previous_bal,
                                        'total_amount' => $set_all_total_amt+$set_previous_bal,
                                        'amount_paid' => $set_paid_amount,
                                        'adjusted' => $set_adjusted,
                                        'remaining_balance' => ($set_all_total_amt+$set_previous_bal)-($set_paid_amount+$set_adjusted),
                                        'created_at' => date('Y-m-d h:i:s')
                                    ]); 
                                }
                                if(count($check_weekly_billing_all_customers) > 0) {
                                    
                                    $billing = DB::table('weekly_billing_all_customers')
                                    ->where(['from_date'=> $request->from_date,'to_date'=> $request->to_date])
                                    ->update([
                                        'total_litres' => $set_all_total_lit,
                                        'amount' => $set_all_total_amt,
                                        'previous_balance' => $set_previous_bal,
                                        'total_amount' => $set_all_total_amt+$set_previous_bal,
                                        'amount_paid' => $set_paid_amount,
                                        'adjusted' => $set_adjusted,
                                        'remaining_balance' => ($set_all_total_amt+$set_previous_bal)-($set_paid_amount+$set_adjusted),
                                        'created_at' => date('Y-m-d h:i:s')
                                    ]); 
                                }
                            } */
                            
                        }
                        else {
                            return redirect('/billing/create')->with('error','The Invoice is Already Created For This Dates');  
                        }
                    }
                    else {
                        return redirect('/billing/create')->with('error','No Record Found');  
                    }                
                }
                else {
                    return redirect('/billing/create')->with('error','Difference Between Two Dates cannot be greater than 31');
                }
            }
            return redirect('/billing')->with('success','Invoice Created');
        }
                                        
        
    }

    public function edit($id) {
        
        $weekly_billing = DB::table('weekly_billing')        
            ->Join('customers', 'weekly_billing.customer_id', '=', 'customers.id')
            ->where('weekly_billing.id',$id)
            ->select('weekly_billing.*','customers.customer_name')            
            ->first();

        // return $weekly_billing;
        return view('billings.edit')->with('weekly_billing',$weekly_billing);
    }

    public function update(Request $request, $id) {

        $billing = DB::table('weekly_billing')
        ->where('id', $id)
        ->update([
            'customer_id' => $request->customer_id,
            'bill_no' => $request->bill_no,
            'from_date' => $request->from_date,
            'to_date' => $request->to_date,
            'total_litres' => $request->total_litres,
            'total_amount' => $request->total_amount,
            // 'amount_paid' => ($get_pd_amt->amount_paid ? $get_pd_amt->amount_paid : 0)+$request->amount_paid,
            'amount_paid' => $request->amount_paid,
            'pending_amount' => $request->total_amount-($request->amount_paid+($request->adjusted?$request->adjusted:0)),
            'adjusted' => $request->adjusted,
            'updated_at' => date('Y-m-d h:i:s')
        ]);
        
        if($billing) {
            $billing = DB::table('wekkly_billing_pending_amount')
            ->insert([
                'customer_id' => $request->customer_id,
                'bill_no' => $request->bill_no,
                'amount' => $request->amount_paid,
                'from_to_date' => $request->from_date.' to '.$request->to_date,
                'date' => date('Y-m-d'),
                'created_at' => date('Y-m-d h:i:s')
            ]);
            
            /*$get_pd_amt_week = DB::table('weekly_billing')
            ->where(['from_date'=> $request->from_date,'to_date'=> $request->to_date])           
            ->get();
            
            $set_all_paid_amt = 0;
            $set_all_adjusted = 0;
            foreach($get_pd_amt_week as $x) {
                $set_all_paid_amt += $x->amount_paid;
                $set_all_adjusted += $x->adjusted;
            }
            
             $billing = DB::table('weekly_billing_all_customers')
                ->where(['from_date'=> $request->from_date,'to_date'=> $request->to_date])
                ->update([                   
                    'amount_paid' => $set_all_paid_amt+$request->amount_paid,
                    'adjusted' =>  $set_all_adjusted+$request->adjusted,                    
                    'updated_at' => date('Y-m-d h:i:s')
                ]);  
            */
        }

        return redirect('/billing')->with('success','Invoice Updated');
                                  
    }

    public function delete($id,$tbname)
    {   
        $delete = DB::table($tbname)
                    ->where($tbname.'.id', '=', $id)
                    ->delete();
         
        if($delete) {
            return ['status' => 1 ];
        }       
    }
    
    public function get_data_api($id,$cid,$date1,$date2,$bill_id=FALSE) {

        //For Fetching All Sold Data
        if($id == 1) {
            $soldsdata = DB::table('milksolds')
            ->rightJoin('customers','milksolds.customer_id','=','customers.id')
            ->whereBetween('sold_date', [$date1, $date2])
            ->where('customer_id', '=', $cid)
            ->orderBy('milksolds.sold_date', 'ASC')
            ->select('milksolds.*','customers.customer_name','customers.bill_period')
            ->get();

            return ['status' => 1, 'data' => $soldsdata];
        }
        
        //For Checking Generated Invoice
        if($id == 2 ) {
            $week_data = DB::table('weekly_billing')
            ->where(['customer_id' => $cid, 'from_date' => $date1, 'to_date' => $date2])
            ->get();
            
            return ['status' => 1, 'data' => $week_data];
        }

        //For Fetching Pending Amount
        if($id == 3 ) {

            //$diff_days = (strtotime($date2) - strtotime($date1)) / (60 * 60 * 24)+1;
            
            // changes 05-09-21
            /* if($diff_days == 7) {

                $week_data = DB::table('weekly_billing')
                ->where(['customer_id' => $cid])
                ->whereNotBetween('from_date', [$date1, $date2])
                ->whereNotBetween('to_date', [$date1, $date2])
                ->where('from_date','=',date('Y-m-d',strtotime($date1 .'-'.$diff_days." day")))
                ->where('to_date','=',date('Y-m-d',strtotime($date2 .'-'.$diff_days." day")))
                ->get();

                return ['status' => 1, 'data' => $week_data];
            }
            else if($diff_days == 31 || $diff_days == 30 || $diff_days == 29 || $diff_days == 28) {
                
                
                $currentMonth = date('M Y',strtotime($date1));
                $last_month =  Date('M Y', strtotime($currentMonth . " last month"));
                $week_data = DB::table('weekly_billing')
                ->where(['customer_id' => $cid])
                ->whereNotBetween('from_date', [$date1, $date2])
                ->whereNotBetween('to_date', [$date1, $date2])
                ->where(['month'=>$last_month, 'bill_period'=>'monthly'])
                ->get();
                
                return ['status' => 1, 'data' => $week_data];
            } */
            $week_data = DB::table('weekly_billing')
                // ->Join('customers', 'weekly_billing.customer_id', '=', 'customers.id')
                ->Join('wekkly_billing_pending_amount', 'weekly_billing.bill_no', '=', 'wekkly_billing_pending_amount.bill_no')
                ->select('weekly_billing.*','wekkly_billing_pending_amount.amount as last_payment')
                ->where('weekly_billing.customer_id',$cid)
                ->where('weekly_billing.id','<',$bill_id)
                // ->orderBy('created_at', 'desc')
                ->latest()
                ->first();
                if($week_data) {
                    return ['status' => 1, 'data' => $week_data];
                }
                else {
                    return ['status' => 0, 'data' => []];                    
                }
        }   
        
        //For Fetching Adjusted Amount
        if($id == 4 ) {
            $adjust_amount = DB::table('weekly_billing')
                ->where(['customer_id' => $cid])
                ->whereBetween('from_date', [$date1, $date2])
                ->whereBetween('to_date', [$date1, $date2])
                ->first();
                        
            return response()->json($adjust_amount);            
        }           
    }

    public function get_cust_api($id,$param1=null,$param2=null) {
		
		//For Fetching All Sold Data 
        /* if($id == 0 ) {
            
            $all_customer_data = DB::table('milksolds')
                ->rightJoin('customers','milksolds.customer_id','=','customers.id')
                ->whereBetween('sold_date', [$date1, $date2])
                ->select('milksolds.*','customers.customer_name','customers.bill_period')
                ->get();
            
            return ['status' => 1, 'data' => $all_customer_data];
        }
		
		//For Fetching Pending Amount
        if($id == 1 ) {
            
            $diff_days = (strtotime($date2) - strtotime($date1)) / (60 * 60 * 24)+1;

            if($diff_days == 7 || $diff_days == 8) {
                                
                $week_data = DB::table('weekly_billing')
                    ->whereNotBetween('from_date', [$date1, $date2])
                    ->whereNotBetween('to_date', [$date1, $date2])
                    ->where('from_date','=',date('Y-m-d',strtotime($date1 .'-'.$diff_days." day")))
                    ->where('to_date','=',date('Y-m-d',strtotime($date2 .'-'.$diff_days." day")))                    
                    ->get();
                        
                return ['status' => 1, 'data' => $week_data];
            }
            else if($diff_days == 31 || $diff_days == 30 || $diff_days == 29 || $diff_days == 28) {
                
                $currentMonth = date('M Y',strtotime($date1));
                $last_month =  Date('M Y', strtotime($currentMonth . " last month"));
                $week_data = DB::table('weekly_billing')
                    ->whereNotBetween('from_date', [$date1, $date2])
                    ->whereNotBetween('to_date', [$date1, $date2])
                    ->where('month',$last_month)
                    ->get();
                        
                return ['status' => 1, 'data' => $week_data];
            }
            
        }
        
         // Get Paid Amount And Adjustable Of Current Week
         if($id == 2) {
            $current_week_paid_amount = DB::table('weekly_billing')
                ->whereBetween('from_date',[$date1, $date2])
                ->whereBetween('to_date',[$date1, $date2])
                ->get();
                return ['status' => 1, 'data' => $current_week_paid_amount];
        } */
        if($id==0) {
            $customers = DB::table('customers')->where('status','active')->get();
            return ['status' => 1, 'data' => $customers];
        }
        if($id==1) {
            $customer_last_entries = DB::table('weekly_billing')
                ->where('customer_id',$param1)
                ->orderBy('bill_no', 'DESC')
                ->latest()
                ->first();
            if($customer_last_entries) {
                return ['status' => 1, 'data' => $customer_last_entries];
            }
            else {
                return ['status' => 0, 'data' => []];
            }
        }
        if($id == 3) {
             $cash_entry_data = DB::table('weekly_billing')
                ->Join('customers', 'weekly_billing.customer_id', '=', 'customers.id')
                ->select('weekly_billing.*','customers.customer_name','customers.customer_type')
                ->where('weekly_billing.from_date', $param1)
                ->where('weekly_billing.to_date', $param2)
                ->orderBy('weekly_billing.bill_no', 'DESC')
                ->get();
            
            return ['status' => 1, 'data' => $cash_entry_data];
        }
        if($id == 4) {
            $all_week_data = DB::table('weekly_billing')->orderBy('from_date','DESC')->get();
            return response()->json($all_week_data);
        }

        // old cash entry 
        /*if($id == 5) {
             $cash_entry_data = DB::table('weekly_billing')
                ->Join('customers', 'weekly_billing.customer_id', '=', 'customers.id')
                ->select('weekly_billing.*','customers.customer_name','customers.id as cid','customers.customer_type')
                ->where('weekly_billing.from_date', $param1)
                ->where('weekly_billing.to_date', $param2)
                 ->orderBy('weekly_billing.bill_no', 'DESC')
                ->get();
            
            return ['status' => 1, 'data' => $cash_entry_data];
        }*/
        
		// For Fetching Auto Generated Bill NO
        /* if($id == 2) {
            $bill_no = DB::table('weekly_billing')->latest()->first();
            if($bill_no) {
                return response()->json($bill_no->bill_no);
            }
            else {
                return response()->json(0);
            }
            
        } */
            
    }
    
}
