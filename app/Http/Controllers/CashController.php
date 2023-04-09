<?php

namespace App\Http\Controllers;

use Illuminate\Support\Carbon;
use DB;
use App\Admin;
use App\WorkFile;
use App\Cash;
use App\User;
use App\Choice;

use App\ThreeSale;
use App\Commission;
use App\Result;


use Illuminate\Http\Request;

class CashController extends Controller
{
    public function listCash()
    {
        // //check activation
        // $output = shell_exec("echo | C:\windows\System32\wbem\wmic.exe path win32_computersystemproduct get uuid");
        // $output = preg_replace("/[ \r\n]*/","",$output);
        // //dd($output);

        // $admin = Admin::where([
                                            
        //                       ])                                                    
                                
        //                     ->orderBy('id','desc')  
        //                     ->first(); 

        // if ($admin === null) 
        // {
        //     return redirect('/activate');
        // }                            

        // $date   = Carbon::parse($admin->start_date);
        // $now    = Carbon::now();
        // $diff   = $date->diffInDays($now);        

        

        // if($output != $admin->machine_id || $admin->user_name != "Myo Tun Naung" || $admin->company_name != "Classic") 
        // {  
        //   return redirect('/activate'); 
        // }

        // if($diff > 365)
        // { return redirect('/activate'); }
        // //end check activation
    
    	$cashes 		= Cash::all();

    	return view('cash.listcash',['cashes'=>$cashes]);
    }
    public function addCash()
    {
    	
    	
    	

        if(request()->action == "Show")
        {
            $work_file_id   =   request()->work_file_id;

            $user_id        =   request()->user_id;
            $user_name      =   User::where("id","=",$user_id)->value('name'); 

            if($user_name == null)
            { $user_name = "All"; }

            $type_sale      = 0;
        }
        else
        { 
            //Get Info
            $work_file_id   = Choice::where('auth_id','=',auth()->user()->id)->value('work_file_id');
                
            //End Get Info

            if($work_file_id == null)
            {
                return back();
            }
        

            $user_id        = 0;
            $user_name      = "All";            
            
        }





        $work_files     = WorkFile::all();

        $paid_users          = User::rightJoin('cashes', 'cashes.user_id', '=', 'users.id')
                                    ->where([ 
                                       
                                    ])->get();

        $users          = User::where([ 
                                        ['id','>',2],
                                        ['in_out','=',1],

                                    ])->get();

        $cashes         = Cash::where([ 
                                        ['work_file_id','=',$work_file_id],                                        

                                    ])->get();

    	return view('cash.addcash',[
                                        'work_files'    => $work_files, 

                                        'paid_users'    => $paid_users,   									
    									'users'			=> $users,

                                        'work_file_id'  => $work_file_id,
    									'user_id' 	 	=> $user_id,

                                        'cashes'        => $cashes,
    								]);

    }
    public function createCash(Request $request)
    {
    	$validator = validator(request()->all(),
    		[
    			"select_user_id"=> "required",
    			
    			"deposit"   	=> "required",
    			"bet_amount"   	=> "required",

    			"result_amount"   	=> "required",
                "balance"     => "required",
    			
    		]);

    	if($validator->fails())
    	{
    		return back()->with('info',"Data can not be Blank!!!");
    	}

        $work_file_id   = request()->w_id;
        $user_id        = request()->select_user_id;

        $deposit        = request()->deposit;
        $bet_amount     = request()->bet_amount;

        $result_amount  = request()->result_amount;
        $balance        = request()->balance;

       
       
        $cash = new Cash();

            $cash->work_file_id     = $work_file_id;         
        	$cash->user_id         	= $user_id;             
            
            $cash->deposit          = $deposit;             
            $cash->bet_amount     	= $bet_amount;

            $cash->result_amount    = $result_amount;
            $cash->balance          =  $balance;

                      
    	$cash->save();
    	
        return redirect('/cash/add');
    }

    public function delCash($id)
    {
    	DB::table('cashes')->where('id', '=', "$id")->delete();
                
        return redirect('/cash/add')->with('info',"Cash delete Successfully!!!");
    }
    public function updCash($id)
    {
    	$users         		= User::all();    	
    	$cash       		= Cash::find($id);
        
        return view('cash.updcash',[	'users' 	=> $users,
        								'cash'    	=> $cash,       								
        							    ]);
    }
    public function updateCash(Request $request, $id)
    {
    	$validator = validator(request()->all(),
            [
               "select_user_id"=> "required",
    			
    			"deposit"   	=> "required",
    			"withdraw"   	=> "required",
    			"balance"   	=> "required", 
            ]);

        if($validator->fails())
        {
            return back()->with('info',"Data can not be Blank!!!");
        }

        $cash = Cash::find($id);

        	$cash->user_id         	= request()->select_user_id;             
            
            $cash->deposit          = request()->deposit;             
            $cash->withdraw     	= request()->withdraw;
            $cash->balance          = request()->balance;   
           
    	$cash->save();

        return redirect('/cash/list')->with('info',"Cash was Successfully Updated !!!");
    }


    public function getCashInfo(Request $request)
    {
        //Test

            $deposit        = request()->deposit;

            $work_file_id   = request()->work_file_id;
            $user_id        = request()->user_id;



            $total_amount = ThreeSale::where([
                                             ['work_file_id','=',$work_file_id],
                                             ['user_id','=',$user_id],
                                             ['customer_id','=',1],

                                            ])->sum('amount');  

            $threed_comm = Commission::where([                                             
                                             ['user_id','=',$user_id],
                                             ['customer_id','=',1],

                                            ])->value('threed_comm');    
           
            $comm_amount = $total_amount * $threed_comm / 100;

            $net_total  = $total_amount-$comm_amount;




            $result_amount = Result::where([
                                             ['work_file_id','=',$work_file_id],
                                             ['user_id','=',$user_id ],
                                             ['customer_id','=',1], 

                                              ])->value('compensation_amount'); 


           $balance = ($deposit - $net_total) + $result_amount;
        //End Test


            return response()->json([
                                        'balance'       => "$balance",
                                        'deposit'       => "$deposit",                                        
                                        'total_amount'  => "$total_amount",
                                        'net_total'     => "$net_total",
                                        'result_amount' => "$result_amount",                                       
                                        
                                    ]);


    }


}
