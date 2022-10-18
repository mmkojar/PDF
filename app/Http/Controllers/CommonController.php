<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CommonController extends Controller
{
    public function unique_name($name,$table,$column) {

        $data = DB::table($table)     
        ->select($table.'.*')
        ->where($column,$name)
        ->get();
        
        if(count($data) > 0) {
            return ['status' => -1 , 'msg' => 'This Name is Already Stored'];
        }
        else {
            return ['status' => 1, 'msg' => 'Available'];
        } 
        
    }
}
