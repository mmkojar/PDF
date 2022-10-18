<?php

namespace App\Http\Controllers\Processing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Helper\Helper;

class MedicalCheckupcontroller extends Controller
{
    
    public function __construct()
    {
        $this->middleware(['auth'])->except(['show,create,edit,update,destroy']);
    }

    public function index()
    {

        $pending_checkup = DB::table('processing_data')
                ->Join('products', 'processing_data.product_id', '=', 'products.id')
                ->leftJoin('medical_checkup', 'processing_data.id', '=', 'medical_checkup.processing_id')
                ->where(['processing_data.is_processed_or_not'=>'yes'])
                ->Where(function($query) {
                    $query->where('medical_checkup.is_pregnant_or_not', 'no')
                          ->orwhere('medical_checkup.id');
                })         
                ->select('processing_data.*','products.product_name',
                'medical_checkup.id as mcid',
                'medical_checkup.is_pregnant_or_not as pnot',
                )
                ->orderBy('processing_data.created_at', 'desc')
                ->get();
                
                
        // $expired_checkup = DB::table('processing_data')        
        //         ->Join('products', 'processing_data.product_id', '=', 'products.id')
        //         ->leftJoin('medical_checkup', 'processing_data.id', '=', 'medical_checkup.processing_id')
        //         // ->where(['medical_checkup.is_processed_or_not'=>'yes'])            
        //         ->select('processing_data.*','products.product_name',
        //         'medical_checkup.id as mcid',
        //         'medical_checkup.is_processed_or_not as pnot','medical_checkup.delivery_date as afdate',
        //         'medical_checkup.note')
        //         ->orderBy('processing_data.created_at', 'desc')
        //         ->get();            
        
        // Helper::debug($pending_checkup);
                
                            
        $medical_days = DB::table('days')->select('medical_days1')->get();    
        
        return view('processing.medical1.index')->with(['pending_checkup' => $pending_checkup,'medical_days' => $medical_days]);
    }
    
    public function store(Request $request)
    {        
        $prid = [];
        $data = $request->all();
        $processing_days = DB::table('days')->select('processing_days')->get();
        $count = 2;
        foreach(request()->select_process as $selected) {
            if($data['is_pregnant_or_not'][$selected] == 'no') {

                $date1 = str_replace('-', '/', date('Y-m-d'));
                $newdate = date('Y-m-d',strtotime($date1 . +$processing_days[0]->processing_days."days"));
                
                DB::table('processing_data')
                ->where('id',$data['processing_id'][$selected])
                ->update(
                    [
                        'processing_date'      => $newdate,
                        'is_processed_or_not'    => 'no',
                        'actual_or_further_processing_date' => null,
                        'note' => null,
                        'no_of_process' => $count++,
                        'updated_at'       => date('Y-m-d h:i:s'),
                    ]
                );                
                // $count++;                 
            }
            else{
                DB::table('medical_checkup')
                ->insert(
                    [
                        'processing_id' => $data['processing_id'][$selected],
                        'product_id'       => $data['product_id'][$selected],
                        'product_stock_id' => $data['product_stock_id'][$selected],        
                        'product_no' => $data['product_no'][$selected],
                        'processing_date'      => $data['processing_date'][$selected],
                        'medical_date'      => $data['medical_date'][$selected],
                        'actual_medical_date'      => $data['actual_medical_date'][$selected],
                        'delivery_date'    => $data['delivery_date'][$selected],
                        'is_pregnant_or_not'    => $data['is_pregnant_or_not'][$selected],
                        'note'    => $data['note'][$selected],
                        'created_at'       => date('Y-m-d h:i:s'),
                    ]
                );
            }
            $check_audit_log = DB::table('audit_log')->get();
            if(count($check_audit_log) > 0) {
                $get_lastest_product_stock_id = DB::table('audit_log')->where('product_stock_id',$data['product_stock_id'][$selected])->latest('id')->first();
                if($get_lastest_product_stock_id) {
                    $input['medical_date'] = $data['medical_date'][$selected];
                    $input['actual_medical_date'] = $data['actual_medical_date'][$selected];
                    $input['delivery_date'] = $data['delivery_date'][$selected];
                    $input['is_pregnant_or_not'] = $data['is_pregnant_or_not'][$selected];
                    $input['medical_note'] = $data['note'][$selected];
                    DB::table('audit_log')->where('id',$get_lastest_product_stock_id->id)->update($input); 
                }
            }
            

            /* if($data['mcid'][$selected]) {
                DB::table('medical_checkup')
                ->where('id',$data['mcid'][$selected])
                ->update(
                    [
                        'processing_id' => $data['processing_id'][$selected],
                        'product_id'       => $data['product_id'][$selected],
                        'product_stock_id' => $data['product_stock_id'][$selected],                        
                        'medical_date'      => $data['medical_date'][$selected],
                        // 'delivery_date'    => $data['delivery_date'][$selected],
                        'is_pregnant_or_not'    => $data['is_pregnant_or_not'][$selected],
                        // 'note'    => $data['note'][$selected],
                        'updated_at'       => date('Y-m-d h:i:s'),
                    ]
                );                
            } 
            else{
                DB::table('medical_checkup')
                ->insert(
                    [
                        'processing_id' => $data['processing_id'][$selected],
                        'product_id'       => $data['product_id'][$selected],
                        'product_stock_id' => $data['product_stock_id'][$selected],                        
                        'medical_date'      => $data['medical_date'][$selected],
                        // 'delivery_date'    => $data['delivery_date'][$selected],
                        'is_pregnant_or_not'    => $data['is_pregnant_or_not'][$selected],
                        // 'note'    => $data['note'][$selected],
                        'created_at'       => date('Y-m-d h:i:s'),
                    ]
                );                
            } */            
        }    
        return redirect('/medical_checkup')->with('success','Data Added');              
    }
}
