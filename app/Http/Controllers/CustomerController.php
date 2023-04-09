<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Carbon;
use DB;
use App\Admin;
use App\Customer;
use App\User;
use App\Commission;

class CustomerController extends Controller
{

    public function listCustomer()
    {
    	
        $customers        = Customer::all();

        return view('customer.listcustomer',['customers'=>$customers]);
    }

    public function addCustomer()
    {
        $users          = User::all();
        $customers      = Customer::all();

        return view('customer.addcustomer',[ 'users' => $users, 'customers' => $customers ]);
    }

    public function createCustomer(Request $request)
    {
        $validator = validator(request()->all(),
            [
                'name'      => ['required', 'string', 'max:255'],
                'in_out'    => ['required', 'string', 'max:255'],

                'agent'             => ['required'],
                'agent_percent'     => ['required'],
                'refer_user_id'     => ['required'],

                'twod_comm'         => ['required'],
                'twod_times'        => ['required'],

                'threed_comm'       => ['required'],
                'threed_times'      => ['required'],

                'twod_hotpercent'   => ['required'],
                'threed_hotpercent' => ['required'],
                
            ]);

        if($validator->fails())
        {
            return back()->with('info',"Data can not be Blank!!!");
        }

        $customer = new Customer();

            $customer->name     = request()->name;
            $customer->in_out   = request()->in_out;
            
        $customer->save();

        $user_id            = auth()->user()->id;
        $customer_id        = $customer->id;
        
        $agent              = request()->agent;
        $agent_percent      = request()->agent_percent;
        $refer_user_id      = request()->refer_user_id;

        $twod_comm          = request()->twod_comm;
        $twod_times         = request()->twod_times;

        $threed_comm        = request()->threed_comm;
        $threed_times       = request()->threed_times;

        $twod_hotpercent    = request()->twod_hotpercent;
        $threed_hotpercent  = request()->threed_hotpercent;

 
        $commission         = new Commission();

            $commission->user_id            = $user_id;
            $commission->customer_id        = $customer_id;

            $commission->agent              = $agent;
            $commission->agent_percent      = $agent_percent;
            $commission->refer_user_id      = $refer_user_id;

            $commission->twod_comm          = $twod_comm;
            $commission->twod_times         = $twod_times;

            $commission->threed_comm        = $threed_comm;
            $commission->threed_times       = $threed_times;

            $commission->twod_hotpercent    = $twod_hotpercent;
            $commission->threed_hotpercent  = $threed_hotpercent;

   
        $commission->save();

        return redirect('/customer/add')->with('info',"New Customer & Commission Added Successfully!!!");

    }
    public function delCustomer($id)
    {
        DB::table('customers')->where('id', '=', "$id")->delete();
                
        return redirect('/customer/list')->with('info',"Customer delete Successfully!!!");
    }
    public function updCustomer($id)
    {
        $customer = Customer::find($id);

        return view('customer.updcustomer',['customer' => $customer]);
    }

    public function updateCustomer($id)
    {
        $validator = validator(request()->all(),
            [
                'name'      => ['required', 'string', 'max:255'],
                'in_out'    => ['required', 'string', 'max:255'],
                
            ]);

        if($validator->fails())
        {
            return back()->with('info',"Data can not be Blank!!!");
        }

        $customer = Customer::find($id);

            $customer->name     = request()->name;
            $customer->in_out   = request()->in_out;
            
        $customer->save();

        return redirect('/customer/list')->with('info',"Customer Updated Successfully!!!");
    }
}
