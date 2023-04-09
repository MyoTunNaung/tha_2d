<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;

class AdminController extends Controller
{
    //
    public function addAdmin()
    {
    	return view('activate');
    }

    public function createAdmin(Request $request)
    {
    	$validator = validator(request()->all(),
    		[
    			"start_date"   		=>"required",   						
    			"user_name"   		=>"required", 
    			"company_name"   	=>"required", 
    			"machine_id"   		=>"required", 
               
    		]);

    	if($validator->fails())
    	{
    		return back()->with('info',"Data can not be Blank!!!");
    	}

       $admin = Admin::where([
                                            
                              ])                                                    
                                
                            ->orderBy('id','desc')  
                            ->first(); 

        if ($admin === null) 
        {
            $admin = new Admin();

            	$admin->start_date   	= request()->start_date;               
            	$admin->user_name   	= request()->user_name;
            	$admin->company_name   	= request()->company_name;
            	$admin->machine_id   	= request()->machine_id;
           
    		$admin->save();
        } 
        else
        {
        		$admin->start_date   	= request()->start_date;
            	$admin->user_name   	= request()->user_name;
            	$admin->company_name   	= request()->company_name;
            	$admin->machine_id   	= request()->machine_id;
           
    			$admin->save();
        }    

           	
        return redirect('/home');
    }
}
