<?php

namespace App\Http\Controllers\Location;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Location;
use App\Helper\Helper;
use Gate;

class Khilla_location extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index() {
        
        $locations = Location::orderBY('created_at','desc')->get();
        
        return view('locations.index')->with('locations',$locations);
    }

    public function store(Request $request)
    {   
        $id = $request->input('hidden_loc_id');
        
        if($id) {
            $location = Location::find($id);
            $location->name = $request->name;
            $location->status = $request->status;
            $location->save();
            return redirect('location')->with('success','Location Updated');
        }
        else {
            $location = new Location();
            $location->name = $request->input('name');
            $location->status = 'active';
            $location->save();
            return redirect('location')->with('success','Location Created');
        }
            
        // return ['status' => 1];
    }

    public function edit($id) 
    {
        if(Gate::denies('all-access')){
            return redirect('/dashboard');
        }
        $location = Location::find($id);
        return ['status' => 1, 'location' => $location];
    }

    public function delete($id)
    {
        $Location =  Location::find($id);        
        $Location->delete();
        return ['status' => 1 ];

    }

    public function khilla() {

        $locations = Location::where('status','active')->get();
		
        $khillas = DB::table('khilla')
        ->Join('locations', 'khilla.location_id', '=', 'locations.id')
        ->where(['locations.status'=>'active'])
        ->select('khilla.*','locations.name as lname','locations.status as lstatus')
		->orderBy('khilla.location_id', 'ASC')
        ->orderBy('khilla.khilla_no', 'ASC')		
        ->get();           

        return view('locations.khilla.index')->with(['khillas' => $khillas, 'locations' => $locations]);
    }

    public function store_khilla(Request $request) {

        $id = $request->input('hidden_khilla_id');

        if($id) {
            $khillas = DB::table('khilla')
                ->where('id', $id)
                ->update([
                    'location_id' => $request->location_id,
                    'khilla_no' => $request->khilla_no,
                    'status' => $request->status,
                    'status2' => 'free',
                    'updated_at' => date('Y-m-d h:i:s')
                ]);
            return redirect('/khilla')->with('success', 'Khilla Updated');         
        }
        else {            
            if($request->khilla_no > 0) {
                // for($i = 0; $i < $request->khilla_no; $i++) {
					foreach($request->khilla_no as $kno) {
						if(!empty($kno))
						{
							$input['location_id'] = $request->location_id;
							$input['khilla_no'] = $kno;
							$input['status'] = 'active';
							$input['status2'] = 'free';
							$input['created_at'] = date('Y-m-d h:i:s');
							DB::table('khilla')->insert($input);           
						}
					}                          
                // }
            }
            return redirect('/khilla')->with('success', 'Khilla Added');
        }
    }

    public function edit_khilla($id) {
        
        if(Gate::denies('all-access')){
            return redirect('/dashboard');
        }
        $khillas = DB::table('khilla')        
            ->Join('locations', 'khilla.location_id', '=', 'locations.id')
            ->where('khilla.id',$id)
            ->select('khilla.*','locations.name as lname')
            ->first();

        return ['status' => 1, 'khillas' => $khillas];
    }
    

    public function delete_khilla($id)
    {   
        $delete = DB::table('khilla')->where('id', '=', $id)->delete();         
        if($delete) {
            return ['status' => 1 ];
        }       
    }

    public function unique_khilla_no($id, $no) {

        $data = DB::table('khilla')
        ->select('khilla.*')
        ->where([ 'location_id' => $id , 'khilla_no' => $no, 'khilla.status'=>'active'])
        ->get();
        
        if(count($data) > 0) {
            return ['status' => -1 , 'msg' => 'This No. is Already taken'];
        }
        else {
            return ['status' => 1, 'msg' => 'Available'];
        } 
        
    }
}
