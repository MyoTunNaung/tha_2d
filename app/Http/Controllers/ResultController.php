<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Carbon;
use DB;
use App\Admin;

use App\WorkFile;
use App\User;
use App\Customer;
use App\Commission;

use App\TwoSale;
use App\ThreeSale;

use App\Result;
use App\Choice;
use App\ThreePosition;



class ResultController extends Controller
{

    public function Type_to_Digits($type)
    {
        $type_array = str_split($type);

        $amount1 = "";

        $table_name = "";
        $range1 = "";
        $range2 = "";

        $digit_array = array();


        
        if(strlen($type) == 4)
        {
            $first      = $type_array[0];
            $second     = $type_array[1];
            $third      = $type_array[2];
            $fourth     = $type_array[3];

            if(     is_numeric($first)  && 
                    is_numeric($second) && 
                    is_numeric($third)  && 
                    ( $fourth =="R" || $fourth =="r" || $fourth =="+" )
                )
            {
                $table_name = "d3_types";
                $range1     = 1;
                $range2     = 6;

                $original = $first.$second.$third;
            }          


        }

        


        if($table_name != "")
        {
            $d3_types = DB::table("$table_name")
                                ->where([                                           
                                        ["id",">=",$range1],
                                        ["id","<=",$range2],
                                    ])
                                ->get();
        }
        else
        {
            $d3_types = DB::table("d3_types")
                                ->where([                                           
                                        ["id",">=",10],
                                        
                                    ])
                                ->get();
        }       

       

       
            foreach ($d3_types as $d3_type) 
            {
                $d1 = $d2 = $d3 = "";

                if( $d3_type->d1 == "first")        { $d1 = $first; }
                else if( $d3_type->d1 == "second")  { $d1 = $second; }
                else if( $d3_type->d1 == "third")   { $d1 = $third; }
                else                                { $d1 = $d3_type->d1; }

                if( $d3_type->d2 == "first")        { $d2 = $first; }
                else if( $d3_type->d2 == "second")  { $d2 = $second; }
                else if( $d3_type->d2 == "third")   { $d2 = $third; }
                else                                { $d2 = $d3_type->d2; }

                if( $d3_type->d3 == "first")        { $d3 = $first; }
                else if( $d3_type->d3 == "second")  { $d3 = $second; }
                else if( $d3_type->d3 == "third")   { $d3 = $third; }
                else                                { $d3 = $d3_type->d3; }

                $digit = $d1.$d2.$d3;

                if($digit != $original)
                {
                    array_push($digit_array, $digit); 
                }
                
            }
      
        $result_digits = array_unique($digit_array);

        return $result_digits;

        dd($result_digits);

    }


    public function listResult()
    {


        
        //get Current work_file_id
        $work_file_id   = Choice::where('auth_id','=',auth()->user()->id)->value('work_file_id');
        // dd($work_file_id);

        if($work_file_id == null)
        {
            return back();
        }


        $work_file     = WorkFile::find($work_file_id);       
        $result_digit  = $work_file->result_digit;



        $user_id        = 0; 

        $in_out         = 1;


        $name           = "2D";

        $now            = Carbon::now();

        $today          = Carbon::today()->toDateString();       
        
        $monday         = $now->startOfWeek()->toDateString();
        $friday         = $now->startOfWeek()->add(4,'day')->toDateString();

        
        $from_date    = $monday;
        $to_date      = $friday;

    	// $results 		= Result::where('work_file_id','=',$work_file_id)->get();

        //work_file_id = 0 / user_id = 0 / customer_id = 0

        $work_file_date = Workfile::where('id','=',$work_file_id)->value('date');


        if($work_file_id == 0)
        {
            // $results        = Result::where([
                                            
            //                                 ['user_id','=',$user_id],
            //                                 ['customer_id','=',$customer_id],

            //                             ])->get();

            $results = DB::table('results')
                                ->leftJoin('work_files', 'results.work_file_id', '=', 'work_files.id')
                                ->where([
                                           
                                            // ['results.user_id', '=', $user_id],
                                            // ['results.customer_id', '=', $customer_id],
                                            ['work_files.name', '=', $name],
                                            ["work_files.date",">=",$from_date],
                                            ["work_files.date","<=",$to_date],
                                            
                                        ])
                                ->select('results.*')
                                ->get();


        }
        else
        {
            if(auth()->user()->id ==1 || auth()->user()->id ==2)
            {
                

                $results        = Result::leftJoin('users', 'results.user_id', '=', 'users.id')
                                        ->where([

                                            ['results.work_file_id','=',$work_file_id],
                                            
                                            ['users.in_out','=',1],

                                            // ['results.user_id','=',$user_id],
                                            // ['customer_id','=',$customer_id],


                                        ])->get();
            }
            else
            {

                $results        = Result::leftJoin('users', 'results.user_id', '=', 'users.id')
                                        ->where([

                                            ['results.work_file_id','=',$work_file_id],
                                            
                                            ['users.in_out','=',1],

                                            ['results.user_id','=',auth()->user()->id],
                                            // ['customer_id','=',$customer_id],


                                        ])->get();
                                        
                

                // $results        = Result::where([
                //                             ['work_file_id','=',$work_file_id],
                //                             ['user_id','=',$user_id],
                //                             // ['customer_id','=',$customer_id],

                //                         ])->get();
                

            }
            
        }

        
        // dd($results);


        $work_files = WorkFile::all();
        
        $users      = User::where('in_out','=',$in_out)->get();

       

    	return view('result.listresult',[
                                            

                                            'work_file_id'          => $work_file_id,
                                            'user_id'               => $user_id,                                        
                                            'in_out'                => $in_out,


                                            'work_files'            => $work_files,
                                            'users'                 => $users,
                                    
                                            'results'               => $results,
                                            'result_digit'          => $result_digit,
                                           
                                        ]);
    }

    public function listResultShow()
    {
       
        $name                   = request()->name;
        $duration               = request()->duration;

        $work_file_id           = request()->work_file_id;
        $user_id                = request()->user_id;
        $customer_id            = request()->customer_id;
        $in_out                 = request()->in_out;
        
        $work_file          = WorkFile::find($work_file_id);
        $result_digit       = $work_file->result_digit;
      
        if($result_digit == null)
        {
            $result_digit = "";
        }

        // $from_date              = request()->from_date;
        // $to_date                = request()->to_date;


        $work_file_date = Workfile::where('id','=',$work_file_id)->value('date');


        if($work_file_id == 0)
        {
            // $results        = Result::where([
                                            
            //                                 ['user_id','=',$user_id],
            //                                 ['customer_id','=',$customer_id],

            //                             ])->get();

            $results = DB::table('results')
                                ->leftJoin('work_files', 'results.work_file_id', '=', 'work_files.id')
                                ->where([
                                           
                                            // ['results.user_id', '=', $user_id],
                                            // ['results.customer_id', '=', $customer_id],
                                            ['work_files.name', '=', $name],
                                            ["work_files.date",">=",$from_date],
                                            ["work_files.date","<=",$to_date],
                                            
                                        ])
                                ->select('results.*')
                                ->get();

        }
        else
        {
            if($user_id == 0)
            {
                $results        = Result::leftJoin('users', 'results.user_id', '=', 'users.id')
                                        ->where([

                                            ['results.work_file_id','=',$work_file_id],
                                            
                                            ['users.in_out','=',$in_out],

                                            // ['results.user_id','=',$user_id],
                                            // ['customer_id','=',$customer_id],


                                        ])->get();
            }
            else
            {
                $results        = Result::where([
                                            ['work_file_id','=',$work_file_id],
                                            ['user_id','=',$user_id],
                                            // ['customer_id','=',$customer_id],

                                        ])->get();
            }
        }      
        
    
       

        $work_files = WorkFile::all();
        
        $users      = User::where('in_out','=',$in_out)->get();
       


        return view('result.listresult',[
                                            
                                            'user_id'               => $user_id,
                                         
                                            'in_out'                => $in_out,
                                           
                                            'work_files'            => $work_files,
                                            'users'                 => $users,
                                        

                                            'work_file_id'          => $work_file_id,
                                            'work_file_date'        => $work_file_date,                                           

                                            'results'               => $results,
                                            'result_digit'         => $result_digit,
                                           
                                        ]);
    }

    public function userListResult()
    {
              
      
        $today      = Carbon::today()->toDateString();
        
        $now        = Carbon::now();
        $monday     = $now->startOfWeek()->toDateString();
        $friday     = $now->startOfWeek()->add(4,'day')->toDateString();
        
        $from_date    = $monday;
        $to_date      = $friday;


        $choice =  Choice::where('auth_id','=',auth()->user()->id)
                                        ->orderBy('id','desc')
                                        ->first();
        $work_file_id = $choice->work_file_id;

        $name         = "2D";
        $from_date    = $today;
        $to_date      = $today;

        $action       = "Two_AM";

      
        $two_am_work_file_id     = $work_file_id;
        $two_pm_work_file_id     = $work_file_id;
        $three_work_file_id      = $work_file_id;

         
        $user_id        = auth()->user()->id;
        $customer_id    = 1;
        $in_out         = 1;
        $slip_id        = 0;



        $work_files = WorkFile::where([                                           
                                    
                                    ["name","=",$name],
                                    ["date",">=",$from_date],
                                    ["date","<=",$to_date],
                                    
                                ])
                            ->get();

        $users        = User::all();
        $customers    = Customer::where('in_out','=',$in_out)->get();
        $slips        = array();

        $twod_threed    = "2D";
        $main_two_three = "2D";



        if($work_file_id == 0)
        {
            
            $results = DB::table('results')
                                ->leftJoin('work_files', 'results.work_file_id', '=', 'work_files.id')
                                ->where([
                                           
                                            ['results.user_id', '=', $user_id],
                                            ['results.customer_id', '=', $customer_id],
                                            ['work_files.name', '=', $name],
                                            ["work_files.date",">=",$from_date],
                                            ["work_files.date","<=",$to_date],
                                            
                                        ])
                                ->select('results.*')
                                ->get();

        }
        else
        {
            $results        = Result::where([
                                            ['work_file_id','=',$work_file_id],
                                            ['user_id','=',$user_id],
                                            ['customer_id','=',$customer_id],

                                        ])->get();
        }


        $total_amount           = 0;
        $commission_amount      = 0;
        $net_total              = 0;

        $digit_amount           = 0;
        $other_amount           = 0;

        $compensation_amount    = 0;
        $balance                = 0;

        foreach ($results as $result) 
        {
            $total_amount           += $result->total_amount;
            $commission_amount      += $result->commission_amount;
            $net_total              += $result->net_total;

            $digit_amount           += $result->digit_amount;
            $other_amount           += $result->other_amount;

            $compensation_amount    += $result->compensation_amount;
            $balance                += $result->balance;

        }

     
        
        // dd($work_files);

        return view('result.userlistresult',[

                                             'two_am_work_file_id'    =>$two_am_work_file_id,
                                            'two_pm_work_file_id'    =>$two_pm_work_file_id,
                                            'three_work_file_id'  =>$three_work_file_id,

                                            'twod_threed'       => $twod_threed,
                                            'main_two_three'    => $main_two_three,


                                            'user_id'       =>$user_id,
                                            'customer_id'   =>$customer_id,
                                            'slip_id'       =>$slip_id,

                                            'in_out'         =>$in_out,
                                            'action'        => $action,

                                            'from_date'             => $from_date,
                                            'to_date'               => $to_date,
                                            
                                            'work_files'            => $work_files,
                                            'users'                 => $users,
                                            'customers'             => $customers,
                                            'slips'                 => $slips,

                                            'work_file_id'          => $work_file_id,
                                            'user_id'               => $user_id,
                                            'customer_id'           => $customer_id,

                                            'total_amount'          => $total_amount,
                                            'commission_amount'     => $commission_amount,
                                            'net_total'             => $net_total,

                                            'digit_amount'          => $digit_amount,
                                            'other_amount'          => $other_amount,

                                            'compensation_amount'   => $compensation_amount,
                                            'balance'               => $balance,

                                        ]);
    }
    public function userListResultShow()
    {
        
        $action       = request()->action;

        if( $action == "Two_AM")
        {
            $work_file_id  = request()->two_am_work_file_id;          
        }

        else if( $action == "Two_PM")
        {
            $work_file_id  = request()->two_pm_work_file_id;          
        }

        else if( $action == "Three")
        {
            $work_file_id  = request()->three_work_file_id;
        }

         else if( $action == "All")
        {
            $twod_threed = request()->twod_threed;  

            $choice =  Choice::where('auth_id','=',auth()->user()->id)
                                        ->orderBy('id','desc')
                                        ->first();
            $work_file_id = $choice->work_file_id;          

        }

        else if( $action == "Main")
        {
            $main_two_three = request()->main_two_three;

            $choice =  Choice::where('auth_id','=',auth()->user()->id)
                                        ->orderBy('id','desc')
                                        ->first();
            $work_file_id = $choice->work_file_id;
        }


        else
        {

              $choice =  Choice::where('auth_id','=',auth()->user()->id)
                                        ->orderBy('id','desc')
                                        ->first();
              $work_file_id = $choice->work_file_id;
        }
      
      
        $two_am_work_file_id     = request()->two_am_work_file_id;
        $two_pm_work_file_id     = request()->two_pm_work_file_id;
        $three_work_file_id     = request()->three_work_file_id;

        $user_id              = request()->user_id;
        $customer_id          = request()->customer_id;
        $in_out               = request()->in_out;
        $slip_id              = request()->slip_id;
      
       $slips = array();

       $twod_threed             = request()->twod_threed;
       $main_two_three          = request()->main_two_three;

        // $name         = request()->name;
        $from_date    = request()->from_date;
        $to_date      = request()->to_date;


         $work_files = WorkFile::where([                                           
                                    
                                    // ["name","=",$name],
                                    ["date",">=",$from_date],
                                    ["date","<=",$to_date],
                                    
                                ])
                            ->get();


        if($work_file_id == 0)
        {
            // $results        = Result::where([
                                            
            //                                 ['user_id','=',$user_id],
            //                                 ['customer_id','=',$customer_id],

            //                             ])->get();

            $results = DB::table('results')
                                ->leftJoin('work_files', 'results.work_file_id', '=', 'work_files.id')
                                ->where([
                                           
                                            ['results.user_id', '=', $user_id],
                                            ['results.customer_id', '=', $customer_id],
                                            // ['work_files.name', '=', "$name"],
                                            ["work_files.date",">=",$from_date],
                                            ["work_files.date","<=",$to_date],
                                        ])
                                ->select('results.*')
                                ->get();
        }
        else
        {
            $results        = Result::where([
                                            ['work_file_id','=',$work_file_id],
                                            ['user_id','=',$user_id],
                                            ['customer_id','=',$customer_id],

                                        ])->get();
        }

        $total_amount           = 0;
        $commission_amount      = 0;
        $net_total              = 0;

        $digit_amount           = 0;
        $other_amount           = 0;

        $compensation_amount    = 0;
        $balance = 0;

        foreach ($results as $result) 
        {
            $total_amount           += $result->total_amount;
            $commission_amount      += $result->commission_amount;
            $net_total              += $result->net_total;

            $digit_amount           += $result->digit_amount;
            $other_amount           += $result->other_amount;

            $compensation_amount    += $result->compensation_amount;
            $balance                += $result->balance;

        }

        //$results        = Result::all();
       
      
        $users          = User::all();
        $customers      = Customer::where('in_out','=',$in_out)->get();
        $slips          = array();



        return view('result.userlistresult',[
                                           
                                             'two_am_work_file_id'    =>$two_am_work_file_id,
                                            'two_pm_work_file_id'    =>$two_pm_work_file_id,
                                            'three_work_file_id'  =>$three_work_file_id,

                                            'twod_threed'       => $twod_threed,
                                            'main_two_three'    => $main_two_three,


                                            'user_id'       =>$user_id,
                                            'customer_id'   =>$customer_id,
                                            'slip_id'       =>$slip_id,

                                            'in_out'         =>$in_out,
                                            'action'        => $action,

                                            'from_date'             => $from_date,
                                            'to_date'               => $to_date,

                                            'work_files'            => $work_files,
                                            'users'                 => $users,
                                            'customers'             => $customers,
                                            'slips'                 => $slips,


                                            'work_file_id'          => $work_file_id,
                                            'user_id'               => $user_id,
                                            'customer_id'           => $customer_id,

                                            'total_amount'          => $total_amount,
                                            'commission_amount'     => $commission_amount,
                                            'net_total'             => $net_total,

                                            'digit_amount'          => $digit_amount,
                                            'other_amount'          => $other_amount,

                                            'compensation_amount'   => $compensation_amount,
                                            'balance'               => $balance,

                                        ]);
    }

    public function addResult()
    {
    	$work_files = WorkFile::all();              
    	$work_file_id = 1;
    	
    	return view('result.addresult',[
    									'work_files'       => $work_files,
    									'work_file_id' 	   => $work_file_id,
    								]);
    }
    public function createResult(Request $request)
    {
    	$validator = validator(request()->all(),
    		[
    			
    			"w_id" 	         => "required",
                "result_digit"   => "required",
    			
    		]);

        $work_file_id = request()->w_id;

        //dd($work_file_id);


        switch (request()->action)
        {
            case 'Clear Result':

                    //dd("Clear");

                    $work_file = WorkFile::where('id','=',$work_file_id)->first();
                            $work_file->result_digits = "-";
                    $work_file->save();                   


                    DB::table('results')->where('work_file_id', '=', "$work_file_id")->delete();

                    return back()->with('info',"Result Clear Successfully!");
            break;
            
        }


    	if($validator->fails())
    	{
    		return back()->with('info',"Data can not be Blank!!!");
    	}
                
        $result_digit = request()->result_digit;

        if (Result::where('work_file_id', '=', $work_file_id)->exists()) 
        {
           DB::table('results')->where('work_file_id', '=', "$work_file_id")->delete();
        }

        //Add to WorkFile 
            $work_file = Workfile::find($work_file_id);
                $work_file->result_digit = $result_digit;
            $work_file->save();
        //End Add to Workfile


        //Add to Result Table for 2D

        //Admin1 ( user_id == 1 ) && ( customer_id == 1)
        //Admin2 ( user_id == 2 ) && ( customer_id == 1)

        $users = User::where('id','<=',2)->get();
        foreach ($users as $user) 
        {

            

            $total_amount = TwoSale::where([
                                             ['work_file_id','=',$work_file_id],
                                             ['user_id','=',$user->id],
                                             ['customer_id','=',1],

                                            ])->sum('amount');   

            $twod_comm = Commission::where([                                             
                                             ['user_id','=',$user->id],
                                             ['customer_id','=',1],

                                            ])->value('twod_comm');                                    

            $twod_times = Commission::where([                                             
                                             ['user_id','=',$user->id],
                                             ['customer_id','=',1],

                                            ])->value('twod_times');                                    

            $comm_amount = $total_amount * $twod_comm/100;

            $net_total  = $total_amount-$comm_amount;

            $digit_amount      = ThreeSale::where([
                                             ['work_file_id','=',$work_file_id],
                                             ['user_id','=',$user->id],
                                             ['customer_id','=',1],
                                             ['digit','=',$result_digit],
                                            ])
                                        ->sum('amount');

            $other_amount = 0;
            
            $compensation_amount = $digit_amount * $twod_times;

            $balance = $compensation_amount-$net_total;

            if($total_amount != 0)
            {
                $result = new Result();

                $result->work_file_id           = $work_file_id;
                $result->user_id                = $user->id;
                $result->customer_id            = 1;

                $result->total_amount           = $total_amount;
                $result->commission_amount      = $comm_amount;
                $result->net_total              = $net_total;

                $result->digit_amount           = $digit_amount;
                $result->other_amount           = 0;

                $result->compensation_amount    = $compensation_amount;
                $result->balance                = $balance;

                $result->save();
            }   
        
        }

        //IN Customer ( user_id == 1 || user_id == 2) && ( customer_id != 1) && ( customer->in_out == 1 )
        $users = User::where('id','<=',2)->get();
        foreach ($users as $user) 
        {
        
        
            $customers = Customer::where('id','>',1)->get();

            foreach ($customers as $customer) 
            {

                $total_amount   = DB::table('three_sales')
                                ->leftJoin('customers', 'three_sales.customer_id', '=', 'customers.id')
                                ->where([
                                            ["three_sales.work_file_id","=",$work_file_id],
                                            ['three_sales.user_id', '=', $user->id],
                                            ['three_sales.customer_id', '=', $customer->id],
                                            ['customers.in_out', '=', 1],
                                            
                                        ])
                                ->select('three_sales.*')
                                ->sum('three_sales.amount');

                $twod_comm = Commission::where([                                             
                                         ['user_id','=',$user->id],
                                         ['customer_id','=',$customer->id],

                                        ])->value('twod_comm');                                    

                $twod_times = Commission::where([                                             
                                                 ['user_id','=',$user->id],
                                                 ['customer_id','=',$customer->id],

                                                ])->value('twod_times');                                    

                $comm_amount = $total_amount * $twod_comm/100;

                $net_total  = $total_amount-$comm_amount;

                $digit_amount      = ThreeSale::where([
                                                 ['work_file_id','=',$work_file_id],
                                                 ['user_id','=',$user->id],
                                                 ['customer_id','=',$customer->id],
                                                 ['digit','=',$result_digit],
                                                ])
                                            ->sum('amount');
                $other_amount = 0;
                
                $compensation_amount = $digit_amount * $twod_times;

                
                $balance = $compensation_amount-$net_total;

                if($total_amount != 0)
                {
                    $result = new Result();

                    $result->work_file_id           = $work_file_id;
                    $result->user_id                = $user->id;
                    $result->customer_id            = $customer->id;

                    $result->total_amount           = $total_amount;
                    $result->commission_amount      = $comm_amount;
                    $result->net_total              = $net_total;

                    $result->digit_amount           = $digit_amount;
                    $result->other_amount           = 0;

                    $result->compensation_amount    = $compensation_amount;
                    $result->balance                = $balance;

                    $result->save();
                }   
               
                
            }
            
        }


        //User ( user_id != 1) && (user_id != 2 ) && ( customer_id == 1)
        $users = User::where('id','>',0)->get();
        foreach ($users as $user) 
        {
            
            $total_amount = ThreeSale::where([
                                         ['work_file_id','=',$work_file_id],
                                         ['user_id','=',$user->id],
                                         ['customer_id','=',1],

                                        ])->sum('amount');   

            $twod_comm = Commission::where([                                             
                                             ['user_id','=',$user->id],
                                             ['customer_id','=',1],

                                            ])->value('twod_comm');                                    

            $twod_times = Commission::where([                                             
                                             ['user_id','=',$user->id],
                                             ['customer_id','=',1],

                                            ])->value('twod_times');                                    

            $comm_amount = $total_amount * $twod_comm/100;

            $net_total  = $total_amount-$comm_amount;


            // dd("$total_amount /  $twod_comm / $twod_times");

            $digit_amount      = ThreeSale::where([
                                             ['work_file_id','=',$work_file_id],
                                             ['user_id','=',$user->id],
                                             ['customer_id','=',1],
                                             ['digit','=',$result_digit],
                                            ])
                                        ->sum('amount');
            $other_amount = 0;
            
            $compensation_amount = $digit_amount * $twod_times;

            
            $balance = $compensation_amount-$net_total;

            if($total_amount != 0)
            {
                $result = new Result();

                $result->work_file_id           = $work_file_id;
                $result->user_id                = $user->id;
                $result->customer_id            = 1;

                $result->total_amount           = $total_amount;
                $result->commission_amount      = $comm_amount;
                $result->net_total              = $net_total;

                $result->digit_amount           = $digit_amount;
                $result->other_amount           = 0;

                $result->compensation_amount    = $compensation_amount;
                $result->balance                = $balance;

                $result->save();
            }   
                        
            

            
        }

        

    	
        


        return redirect('/result/list')->with('info',"Result Added Successfully!!!");
    }

    public function delResult($id)
    {
    	DB::table('results')->where('id', '=', "$id")->delete();
                
        return redirect('/result/list')->with('info',"Result delete Successfully!!!");
    }
    public function updResult($id)
    {
    	$users         		= User::all();
    	$work_files         = WorkFile::all();
    	$result       		= Result::find($id);
        
        return view('result.updresult',[	'users' 		=> $users,
        								 	'work_files' 	=> $work_files,
        									'result'    	=> $result,       								
        							    ]);
    }
    public function updateResult(Request $request, $id)
    {
    	$validator = validator(request()->all(),
            [
                "select_user_id" 	 	 => "required",
    			"select_work_file_id" 	 => "required",

    			"total_amount"   		 => "required",
    			"commission_amount"   	 => "required",

    			"digit_amount"   		 => "required",
    			"other_amount"   		 => "required",

    			"compensation_amount" 	 => "required",

    			"cash_plus"   		     => "required",
    			"cash_minus"   		     => "required",

    			"cash_balance"   		 => "required",      
            ]);

        if($validator->fails())
        {
            return back()->with('info',"Data can not be Blank!!!");
        }

        $result = Result::find($id);

        	$result->user_id         		= request()->select_user_id;             
            $result->work_file_id    		= request()->select_work_file_id;  

            $result->total_amount          	= request()->total_amount;             
            $result->commission_amount     	= request()->commission_amount;

            $result->digit_amount          	= request()->digit_amount; 
            $result->other_amount     		= request()->other_amount;

            $result->compensation_amount    = request()->compensation_amount;

            $result->cash_plus     			= request()->cash_plus;
            $result->cash_minus          	= request()->cash_minus; 

            $result->cash_balance     		= request()->cash_balance;     
           
    	$result->save();

        return redirect('/result/list')->with('info',"Result was Successfully Updated !!!");
    }
}
