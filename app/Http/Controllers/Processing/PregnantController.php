<?php

namespace App\Http\Controllers\Processing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Salves;
use App\Models\Location;
use App\Helper\Helper;

class PregnantController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index() {
        
        $pregnants = DB::table('medical_checkup')
                ->Join('products', 'medical_checkup.product_id', '=', 'products.id')
                ->leftJoin('ghabhan_detail', 'ghabhan_detail.medical_id', '=', 'medical_checkup.id')
                ->where(['medical_checkup.is_pregnant_or_not'=>'yes'])
                ->Where(function($query) {
                    $query->where(['ghabhan_detail.status'=>'pending'])
                          ->orwhere('ghabhan_detail.id');
                })
                // 'ghabhan_detail.send_to_salves_or_not'=>'no',
                ->select('medical_checkup.*','products.product_name')
                ->orderBy('medical_checkup.created_at', 'desc')
                ->get();                
                
        $salves = DB::table('ghabhan_detail')
            ->Join('products', 'ghabhan_detail.product_id', '=', 'products.id')
            ->where(['ghabhan_detail.status' => 'salves'])
            // 'ghabhan_detail.send_to_salves_or_not' => 'yes' , 
            ->select('ghabhan_detail.*','products.product_name')
            ->orderBy('ghabhan_detail.created_at', 'desc')
            ->get();
            
        // Helper::debug($salves);        
        return view('processing.pregnant.index2')->with(['pregnants'=> $pregnants , 'salves' => $salves]);
    }

    public function edit($id) {

        $salves_name = Salves::select('salve_name')->get();
        $salves_location = Salves::select('location')->get();        

        $pregnant = DB::table('medical_checkup')
                ->Join('products', 'medical_checkup.product_id', '=', 'products.id')
                ->where('medical_checkup.id',$id)
                ->select('medical_checkup.*','products.product_name')
                ->orderBy('medical_checkup.created_at', 'desc')
                ->first();

        // Helper::debug($pregnant);
        return view('processing.pregnant.edit')->with(['pregnant' => $pregnant, 'salves_name' => $salves_name , 'salves_location' => $salves_location]);
    }

    public function store(Request $request)
    {
        if($request->status == 'send_salves') {
            
            $check_g_count = DB::table('ghabhan_detail')
            ->where(['ghabhan_detail.product_no' => $request->product_no])
            ->get();

            if(count($check_g_count) > 0) {
                $send_salves = DB::table('ghabhan_detail')
                ->where('product_no',$request->product_no)
                ->update([
                        'processing_id'       => $request->processing_id,
                        'medical_id' => $request->medical_id,
                        'product_id' => $request->product_id,
                        'product_stock_id'      => $request->product_stock_id,
                        'product_no'    => $request->product_no,
                        'processing_date'    => $request->processing_date,
                        'medical_date'    => $request->medical_date,
                        'delivery_date' => $request->delivery_date,
                        // 'send_to_salves_or_not' => $request->salve_check,
                        'salve_name' => $request->salve_name,
                        'salve_location' => $request->salve_location,
                        'salves_date' => $request->salves_date,
                        'status' => 'salves',
                        'created_at'       => date('Y-m-d h:i:s'),
                    ]);
            }
            else {
                $send_salves = DB::table('ghabhan_detail')
                ->insert([
                        'processing_id'       => $request->processing_id,
                        'medical_id' => $request->medical_id,
                        'product_id' => $request->product_id,
                        'product_stock_id'      => $request->product_stock_id,
                        'product_no'    => $request->product_no,
                        'processing_date'    => $request->processing_date,
                        'medical_date'    => $request->medical_date,
                        'delivery_date' => $request->delivery_date,
                        // 'send_to_salves_or_not' => $request->salve_check,
                        'salve_name' => $request->salve_name,
                        'salve_location' => $request->salve_location,
                        'salves_date' => $request->salves_date,
                        'status' => 'salves',
                        'created_at'       => date('Y-m-d h:i:s'),
                    ]);
            }

           
            
            /* if($send_salves) {
                $getpsid = DB::table('product_stock')->where('id',$request->product_stock_id)->get();		
                DB::table('khilla')
                    ->where('location_id', $getpsid[0]->location_id)
                    ->where('khilla_no', $getpsid[0]->khilla_no)
                    ->update([
                        'status2' => 'free',
                        'updated_at' => date('Y-m-d h:i:s')
                ]);
                DB::table('product_stock')
                    ->where('id', $request->product_stock_id)
                    ->update([
                        'location_id' => null,
                        'khilla_no' => null
                ]);
            } */
            $check_audit_log = DB::table('audit_log')->get();
            if(count($check_audit_log) > 0) {
                $get_lastest_product_stock_id = DB::table('audit_log')->where('product_stock_id',$request->product_stock_id)->latest('id')->first();
                if($get_lastest_product_stock_id) {
                    $input['salve_name'] = $request->salve_name;
                    $input['salve_location'] = $request->salve_location;
                    $input['salves_date'] = $request->salves_date;
                    $input['status'] = 'salves';
                    DB::table('audit_log')->where('id',$get_lastest_product_stock_id->id)->update($input);
                }
            }
            
            return redirect('/ghabhan')->with('success','Sucessfully Transfered To Salves');
        } 	

        if($request->status == 'back_process') {
            
            // $update_medical = DB::table('medical_checkup')
            // ->where('id',$request->medical_id)
            // ->update(
            //     [
            //         'is_pregnant_or_not'      => 'no',
            //         // 'status'    => 'mumbai',
            //         'updated_at'       => date('Y-m-d h:i:s'),
            //     ]
            // );
            DB::table('medical_checkup')
            ->where('id',$request->medical_id)
            ->delete();

            $processing_days = DB::table('days')->select('processing_days')->get();
            // $date1 = str_replace('-', '/', date('Y-m-d'));
            $date1 = $request->back_to_process_date;
            $newdate = date('Y-m-d',strtotime($date1 . +$processing_days[0]->processing_days."days"));

            $update_processing = DB::table('processing_data')
                ->where('id',$request->processing_id)
                ->update(
                    [
                        'processing_date'      => $newdate,
                        'is_processed_or_not'    => 'no',
                        'actual_or_further_processing_date' => null,
                        'note' => null,
                        'no_of_process' => 2,
                        'updated_at'       => date('Y-m-d h:i:s'),
                    ]
                );
            
            $check_audit_log = DB::table('audit_log')->get();
            if(count($check_audit_log) > 0) {
                $get_lastest_product_stock_id = DB::table('audit_log')->where('product_stock_id',$request->product_stock_id)->latest('id')->first();
                if($get_lastest_product_stock_id) {
                    $input['back_to_process_note'] = $request->note;
                    $input['back_to_process_date'] = $request->back_to_process_date;
                    $input['status'] = 'process-from-ghaban';
                    DB::table('audit_log')->where('id',$get_lastest_product_stock_id->id)->update($input);
                }
            }
            return redirect('/ghabhan')->with('success','Sucessfully Transfered To Process');
        }			                                             
    }

    public function edit_salves($id) {
		
        $salves = DB::table('ghabhan_detail')
            ->Join('products', 'ghabhan_detail.product_id', '=', 'products.id')
            ->where('ghabhan_detail.id',$id)
            ->select('ghabhan_detail.*','products.product_name')
            ->orderBy('ghabhan_detail.created_at', 'desc')
            ->first();
        
        $locations = Location::all();

        return view('processing.pregnant.salves.edit')->with(['g_salves' => $salves, 'locations' => $locations ]);
    }

    public function update_salves(Request $request, $id) {
        
        if($request->status == 'mumbai') {
                            
            $update_ghabhan = DB::table('ghabhan_detail')
            ->where('id',$id)
            ->update(
                [
                    'back_to_mumbai_date' => $request->back_to_mumbai_date,
                    'status'  => 'mumbai',
                    'updated_at' => date('Y-m-d h:i:s'),
                ]
            );
            if($update_ghabhan) {
                $processing_days = DB::table('days')->select('processing_days')->get();
                // $date1 = str_replace('-', '/', date('Y-m-d'));
                $date1 = $request->back_to_mumbai_date;
                $newdate = date('Y-m-d',strtotime($date1 . +$processing_days[0]->processing_days."days"));

                $update_processing = DB::table('processing_data')
                    ->where('id',$request->processing_id)
                    ->update(
                        [
                            'processing_date'      => $newdate,
                            'is_processed_or_not'    => 'no',
                            'actual_or_further_processing_date' => null,
                            'note' => null,
                            'no_of_process' => 2,
                            'updated_at'       => date('Y-m-d h:i:s'),
                        ]
                    );
                    
                    if($update_processing) {
                            
                            DB::table('medical_checkup')
                            ->where('id',$request->medical_id)
                            ->delete();                        
                                                        
                            /* DB::table('khilla')
                                ->where('location_id', $request->location_id)
                                ->where('khilla_no', $request->khilla_no)
                                ->update([
                                    'status2' => 'booked',
                                    'updated_at' => date('Y-m-d h:i:s')
                            ]);
                            DB::table('product_stock')
                                ->where('id', $request->product_stock_id)
                                ->update([
                                    'location_id' => $request->location_id,
                                    'khilla_no' => $request->khilla_no
                            ]); */	
                    }
            }
            $check_audit_log = DB::table('audit_log')->get();
            if(count($check_audit_log) > 0) {
                $get_lastest_product_stock_id = DB::table('audit_log')->where('product_stock_id',$request->product_stock_id)->latest('id')->first();
                if($get_lastest_product_stock_id) {
                    $input['back_to_mumbai_date'] = $request->back_to_mumbai_date;
                    $input['status'] = 'completed';
                    DB::table('audit_log')->where('id',$get_lastest_product_stock_id->id)->update($input);
                }
            }
            return redirect('/ghabhan')->with('success','Sucessfully Transfered To Mumbai Stock');   
        }

        if($request->status == 'inactive') {
            $update_ghabhan1 = DB::table('ghabhan_detail')
                ->where('id',$id)
                ->update(
                    [
                        'status'    => 'inactive',
                        'updated_at'       => date('Y-m-d h:i:s'),
                    ]
                );
            if($update_ghabhan1) {

                $update_processing = DB::table('product_stock')
                    ->where('id',$request->product_stock_id)
                    ->update(
                        [                      
                            'status'=>'inactive',
                        ]
                    );
            }
            return redirect('/ghabhan')->with('success','Stock Inactive Sucessfully');   
        }
    }

}
