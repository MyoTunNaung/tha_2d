<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Carbon;
use DB;
use App\Admin;
use App\WorkFile;
use App\Commission;
use App\User;
use App\Customer;
use App\FilePermission;
use App\Choice;


class CommissionController extends Controller
{
    //User Functions
    public function listUser()
    {
        $users        = User::all();

        return view('user.listuser',['users'=>$users]);
    }

    public function addUser()
    {
        $users = User::all();

        return view('user.adduser',[ 'users'=> $users ]);
    }

    public function createUser(Request $request)
    {
        $validator = validator(request()->all(),
            [
                'name'              => ['required', 'string', 'max:255'],              
                'in_out'            => ['required'],
           
                // 'threed_comm'       => ['required'],
                // 'threed_times'      => ['required'],


                // 'onebet_times'       => ['required'],
                // 'position_times'      => ['required'],
                // 'twobet_times'       => ['required'],
                // 'position_comm'      => ['required'],


                // 'threed_hotpercent' => ['required'],
                // 'threed_status' => ['required'],


                // 'agent'             => ['required'],
                // 'agent_percent'     => ['required'],
                // 'refer_user_id'     => ['required'],

                'twod_comm'         => ['required'],
                'twod_times'        => ['required'],
                'twod_hotpercent'   => ['required'],
                'twod_status'       => ['required'],
                

            ]);

        if($validator->fails())
        {
            return back()->with('info',"Data Error!");
        }

        // dd(request()->refer_user_id);



        if(User::where([ 
                            ["name", "=", request()->name], 
                            ["password","=",request()->password]

                        ])
                ->orWhere([
                             ["name", "=", request()->name], 

                            ])
                ->exists()) 
            { 
                return back()->with('info','Already Exist! Try Another Name!'); 
            }




        $user = User::create([

            'name'          => request()->name,
            'password'      => Hash::make(request()->password),

            'in_out'        => request()->in_out,
            'type'          => request()->type,
            'open_time'     => request()->open_time,
            'close_time'    => request()->close_time,
            'pass'          => request()->password,

            'refer_user_id' => request()->refer_user_id,

        ]);


        $user_id            = $user->id;
        $in_out             = request()->in_out;
        $twod_comm          = request()->twod_comm;
        $twod_times          = request()->twod_times;

        // $onebet_times        = request()->onebet_times;
        // $position_times      = request()->position_times;
        // $twobet_times        = request()->twobet_times;
        // $position_comm       = request()->position_comm;

        if(request()->password != "*")
        {
            $twod_hotpercent  = request()->twod_hotpercent;
            $twod_status      = request()->twod_status;
        }
        else
        {
            $twod_hotpercent  = 100;
            $twod_status      = 1;
        }
        
        
        $commission         = new Commission();

            $commission->user_id            = $user_id;
            $commission->in_out             = $in_out;

            // $commission->threed_comm        = $threed_comm;
            // $commission->threed_times       = $threed_times;
            // $commission->threed_hotpercent  = $threed_hotpercent;
            // $commission->threed_status      = $threed_status;

            // $commission->onebet_times       = $onebet_times;
            // $commission->position_times     = $position_times;
            // $commission->twobet_times       = $twobet_times;
            // $commission->position_comm      = $position_comm;

            // $commission->agent              = $agent;
            // $commission->agent_percent      = $agent_percent;
            // $commission->refer_user_id      = $refer_user_id;

            $commission->twod_comm          = $twod_comm;
            $commission->twod_times         = $twod_times;
            $commission->twod_hotpercent    = $twod_hotpercent;
            $commission->twod_status        = $twod_status;
            

        $commission->save();


        $file_permission = new FilePermission();

            $file_permission->user_id           = $user_id;
            // $file_permission->twod_status       = $twod_status;
            $file_permission->twod_status       = $twod_status;

        $file_permission->save();


        $choice = new Choice();

                // $choice->work_file_id   = 1;
                $choice->auth_id        = $user_id;
                $choice->user_id        = $user_id;
                // $choice->customer_id    = 1;               
                $choice->in_out         = 1;
                $choice->entry          = "Cash";
                $choice->view           = "Cash";
                $choice->keyboard       = "Off";

                $choice->max_minus      = "Max";
                $choice->max_minus      = "Max";
                
                $choice->slip           = "None";

        $choice->save();

        return redirect('/user/add')->with('info',"User->Commission->Permission Added Successfully!!!");

    }
    public function delUser($id)
    {
        $user_id = $id;


        DB::table('users')->where('id', '=', "$id")->delete();
        DB::table('commissions')->where('user_id', '=', "$user_id")->delete();       

        return redirect('/user/add')->with('info',"User & Commission delete Successfully!!!");
    }

    public function updUser($id)
    {
        $user = User::find($id);

        $commission = Commission::where('user_id','=',$id)->first();       

        return view('user.upduser',[ 
                                        'user'          => $user,
                                        'commission'    => $commission,
                                     ]);
    }
    public function updateUser($id)
    {

        // dd("Here");

        $validator = validator(request()->all(),
            [
                    
                // 'password'          => ['required', 'string', 'min:4'],
                
                // 'close_time'        => ['required'],

                'twod_comm'         => ['required'],
                'twod_times'        => ['required'],

                // 'twod_hotpercent'   => ['required'],
                // 'twod_status'       => ['required'],                

            ]);

        if($validator->fails())
        {
            return back()->with('info',"Data is Blank!");
        }
       

        $user_id            = $id;
        // $in_out             = request()->in_out;
        // $close_time         = request()->close_time;

        $twod_comm          = request()->twod_comm;
        $twod_times         = request()->twod_times;

        $twod_hotpercent    = request()->twod_hotpercent;
        $twod_status        = request()->twod_status;


        $user = User::find($id);

            $user->password     = Hash::make(request()->password);
        
            $user->pass         = request()->password;
            $user->in_out       = request()->in_out;
            $user->close_time   = request()->close_time;

        
        $user->save();



        $commission         = Commission::where('user_id','=',$id)->first();

            $commission->user_id            = $user_id;
            // $commission->in_out             = $in_out;

            $commission->twod_comm        = $twod_comm;
            $commission->twod_times       = $twod_times;

            $commission->twod_hotpercent  = $twod_hotpercent;
            $commission->twod_status      = $twod_status;            

        $commission->save();

        return redirect('/user/add');


    }
    //End User Functions

   

    public function listCommission()
    {

        //get Current work_file_id
        $work_file_id   = Choice::where('auth_id','=',auth()->user()->id)->value('work_file_id');
        // dd($work_file_id);

        if($work_file_id == null)
        {
            return back();
        }
        
       
        $in_out         = 1;
      
        $commissions      = Commission::where([ 
                                       
                                        ['in_out','=',$in_out],
                                    ])
                                ->get();


       
     
    	return view('commission.listcommission',[
                                                    'commissions'   =>$commissions,                          
                                                 
                                                    'in_out'        =>$in_out,

                                                ]);
    }

    public function detailCommission($id)
    {
        $commissions        = Commission::where('id','=',$id)->get();

       
        return view('commission.detailcommission',[
                                                    'commissions'   =>$commissions,
                                                   
                                                ]);
    }

    public function listCommissionShow()
    {
        
        $in_out         = request()->in_out;


        $commissions      = Commission::where([ 
                                       
                                        ['in_out','=',$in_out],
                                    ])
                                ->get();

        
        return view('commission.listcommission',[
                                                'commissions'   =>$commissions,  
                                                'in_out'        =>$in_out,                      

                                                ]);



    }

    public function addCommission()
    {
    	$users = User::all();        
    	$select_user_id = 1;

        $customers = Customer::all();


    	return view('commission.addcommission',[
    									'users'			     => $users,
    									'select_user_id' 	 => $select_user_id,
                                        'customers'          => $customers,
    								]);
    }
    public function createCommission(Request $request)
    {
    	$validator = validator(request()->all(),
    		[
    			"select_user_id" 	     => "required",
                "customer_id"            => "required",
    			"agent"   		         => "required",
    			"agent_percent"          => "required", 
                "refer_user_id"          => "required",

                "twod_comm"              => "required",
                "twod_times"             => "required",

                "threed_comm"            => "required",
                "threed_times"           => "required",

                "twod_hotpercent"        => "required",
                "threed_hotpercent"      => "required",
               
    		]);

    	if($validator->fails())
    	{
    		return back()->with('info',"Data can not be Blank!!!");
    	}

       
       
        $commission = new Commission();

        	$commission->user_id           = request()->select_user_id; 
            $commission->customer_id       = request()->customer_id; 
            
            $commission->agent             = request()->agent;            
            $commission->agent_percent     = request()->agent_percent;              
            $commission->refer_user_id     = request()->refer_user_id;

            $commission->twod_comm          = request()->twod_comm;
            $commission->twod_times         = request()->twod_times;

            $commission->threed_comm        = request()->threed_comm;
            $commission->threed_times       = request()->threed_times;

            $commission->twod_hotpercent    = request()->twod_hotpercent;
            $commission->threed_hotpercent  = request()->threed_hotpercent;

          

    	$commission->save();
    	
        return redirect('/commission/list')->with('info',"Commission Added Successfully!!!");
    }

    public function delCommission($id)
    {

    	DB::table('commissions')->where('id', '=', "$id")->delete();
                
        return redirect('/commission/list')->with('info',"Commission delete Successfully!!!");
    }
    public function updCommission($id)
    {
    	
    	$commission    = Commission::find($id);

        $user_id = $commission->user_id;        
        $user         = User::find($user_id);

     

        return view('commission.updcommission',[ 	'user' 	    => $user,
                                                    'commission'    => $commission,
        							         ]);
    }
    public function updateCommission(Request $request, $id)
    {
       
    	$validator = validator(request()->all(),
            [
                "user_id"         => "required",
                // 'close_time'      => "required",

                "twod_comm"     => "required",
                "twod_times"    => "required",


                              
            ]);

        if($validator->fails())
        {
            return back()->with('info',"Data can not be Blank!!!");
        }

        $user = User::find(request()->user_id);
            
        //     $user->close_time   = request()->close_time;

        // $user->save();


        $commission = Commission::find($id);

        	$commission->user_id           = request()->user_id; 
            
         

            $commission->twod_comm        = request()->twod_comm;
            $commission->twod_times       = request()->twod_times;

            if($user->type == "User")
            {
                $commission->twod_hotpercent  = request()->twod_hotpercent; 
                $commission->twod_status      = request()->twod_status; 
            }

            // $commission->onebet_times       = request()->onebet_times;
            // $commission->position_times       = request()->position_times;
            // $commission->twobet_times       = request()->twobet_times;
            // $commission->position_comm       = request()->position_comm;

           
    	$commission->save();

        $user_name = User::where('id','=',request()->user_id)->value('name');

        $msg =  "\n အမည် = ".$user_name.
                "\n ကော် = ".request()->twod_comm.
                "\n အလျော်အဆ =".request()->twod_times.
                "\n 3D ဂဏန်းခွဲတမ်း = ".request()->twod_hotpercent.
                "\n 3D ကစားခွင့် =".request()->twod_status;
                
                // "\n ဖိုင်ပိတ်ချိန် =".request()->close_time;

        // dd($msg);

        return redirect('/commission/list')->with('info',"$msg");
    }
    public function addFileCommission(Request $request)
    {
        $w_file     = request()->w_file;
        $w_comm     = request()->w_comm;
        $w_times    = request()->w_times;

        $work_files = WorkFile::where('name','=',$w_file)->get();

        foreach ($work_files as  $work_file) 
        {
            $work_file->w_comm          = $w_comm;
            $work_file->w_times         = $w_times;
            $work_file->wother_times    = 10;

            $work_file->save();
        }

        return redirect('/commission/list')->with('info','WorkFile Commission added Successfully!');

    }
    
    public function changePassword()
    {
        $user = User::find(auth()->user()->id);
   
        return view('user.chuser',[ 
                                        'user'          => $user,
                                 
                                     ]);
    }
    public function changedPassword(Request $request)
    {
        $user = User::find(auth()->user()->id);

        $user->password = Hash::make(request()->password);
        $user->pass     = request()->password;

        $user->save();

        return redirect('/')->with('info',"Password Changed Successfully!");
    }

}
