<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        $customers = Customer::orderBY('created_at','desc')->get();
        return view('customers.index')->with('customers', $customers);
    }

    public function store(Request $request)
    {
        $customer = new Customer();
        $customer->customer_name = $request->input('c_name');
        // $customer->customer_type = $request->input('c_type');
        // $customer->bill_period = $request->input('bill_period');
        $customer->customer_location = $request->input('c_location');
        $customer->description = $request->input('c_description');
        $customer->milk_rate = $request->input('milk_rate');
        $customer->morning = $request->input('morning');
        $customer->evening = $request->input('evening');
        $customer->mobile_no = $request->input('mobile_no');
        $customer->email = $request->input('c_email');
        $customer->status = 'active';
        $customer->save();

        return ['status' =>1, 'msg'=>'Customer Created'];
        // return redirect('/customer')->with('success','Customer Created');
    }

    public function edit($id)
    {
        $customer = Customer::find($id);
        return view('customers.edit')->with('customer', $customer);
    }


    public function update(Request $request, $id)
    {
        $customer = Customer::find($id);
        $customer->customer_name = $request->input('c_name');
        // $customer->customer_type = $request->input('c_type');
        // $customer->bill_period = $request->input('bill_period');
        $customer->customer_location = $request->input('c_location');
        $customer->description = $request->input('c_description');
        $customer->milk_rate = $request->input('milk_rate');
        $customer->morning = $request->input('morning');
        $customer->evening = $request->input('evening');
        $customer->mobile_no = $request->input('mobile_no');
        $customer->email = $request->input('c_email');
        $customer->status = $request->input('c_status');
        $customer->save();

        return redirect('/customer')->with('success','Customer Updated');
    }

    public function delete($id)
    {
        $customer =  Customer::find($id);                
        $customer->delete();
        return ['status' => 1 ]; 
    }
}
