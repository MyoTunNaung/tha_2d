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


class ListController extends Controller
{
    public function viewList()
    {
    	//get Current work_file_id
        $work_file_id   = Choice::where('auth_id','=',auth()->user()->id)->value('work_file_id');

        if($work_file_id == null)
        {
            return back();
        }

        
        $work_file      = WorkFile::find($work_file_id);

        $from_date      = $work_file->from_date;
        $to_date        = $work_file->date;
        $name           = $work_file->name;
        $duration       = $work_file->duration;
        $result_digit   = $work_file->result_digit;

        $user_id        = 0;       
        $in_out         = 1;


        $now            = Carbon::now();

        $today          = Carbon::today()->toDateString();       
        
        $monday         = $now->startOfWeek()->toDateString();
        $friday         = $now->startOfWeek()->add(4,'day')->toDateString();

        
        // $from_date    = $today;
        // $to_date      = $today;

    	// $results 		= Result::where('work_file_id','=',$work_file_id)->get();

        //work_file_id = 0 / user_id = 0 / customer_id = 0

        // $work_file_date = Workfile::where('id','=',$work_file_id)->value('date');


        // $work_file_id = 0;

        if($work_file_id == 0)
        {
            

            $results = DB::table('results')
                                ->leftJoin('work_files', 'results.work_file_id', '=', 'work_files.id')
                                ->leftJoin('users', 'results.user_id', '=', 'users.id')
                                ->where([
                                           
                                            ['users.in_out', '=', $in_out],
                                            
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
            if(auth()->user()->id == 1 || auth()->user()->id ==2)
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
                $user_id = auth()->user()->id;
                
                $results        = Result::where([
                                            ['work_file_id','=',$work_file_id],
                                            ['user_id','=',$user_id],
                                           

                                        ])->get();
            }
            
        }

        


        $work_files = WorkFile::where([
                                           
                                            ['name', '=', $name],
                                            ['duration', '=', $duration],

                                            ["date",">=",$from_date],
                                            ["date","<=",$to_date],
                                                
                                        ])

                                ->get();

        
        $users      = User::where('in_out','=',$in_out)->get();

        $action = "";

        // $name = "2D";


        // dd($work_file_id);

      


    	return view('list.listresult',[
                                            

                                            'work_file_id'          => $work_file_id,
                                            'user_id'               => $user_id,                                        
                                            'in_out'                => $in_out,


                                            'work_files'            => $work_files,
                                            'users'                 => $users,
                                    
                                            'results'               => $results,
                                            'result_digit'          => $result_digit,
                                            'action'                => $action,

                                            'name'                => $name,
                                            'duration'                => $duration,
                                            'from_date'                => $from_date,
                                            'to_date'                => $to_date,
                                           
                                        ]);
    }
    public function showList()
    {
        

        $action                 = request()->action;
    	
        $name                   = request()->name;
        $duration               = request()->duration;
        
        $from_date              = request()->from_date;
        $to_date                = request()->to_date;

        $work_file_id           = request()->work_file_id;
        $user_id                = request()->user_id;
        $customer_id            = request()->customer_id;
        $in_out                 = request()->in_out;

                
        $work_files             = WorkFile::where([
                                                ['name','=',$name],
                                                ['duration','=',$duration],
                                                ['date','>=',$from_date],
                                                ['date','<=',$to_date],
                                            ])->get();


        $work_file_date = Workfile::where('id','=',$work_file_id)->value('date');


        if($work_file_id == 0)
        {            

            if($name == "2D_3D" && $duration == "AM_PM")
            {
                if($user_id == 0){ $user_op = ">="; }   else { $user_op = "="; } 

                $results = DB::table('results')
                                ->leftJoin('work_files', 'results.work_file_id', '=', 'work_files.id')
                                ->leftJoin('users', 'results.user_id', '=', 'users.id')
                                ->where([
                                           
                                            ["results.user_id","$user_op",$user_id],
                                            ['users.in_out', '=', $in_out],

                                            // ['results.customer_id', '=', $customer_id],
                                            // ['work_files.name', '=', $name],
                                            // ['work_files.duration', '=', $duration],

                                            ["work_files.date",">=",$from_date],
                                            ["work_files.date","<=",$to_date],
                                            
                                        ])
                                ->select('results.*')
                                ->get();


                $work_files = WorkFile::where([
                                           
                                            // ['work_files.duration', '=', $duration],
                                            ["work_files.date",">=",$from_date],
                                            ["work_files.date","<=",$to_date],
                                            
                                        ])

                                ->get();

            }
            else if($name == "2D" && $duration == "AM_PM")
            {
                if($user_id == 0){ $user_op = ">="; }   else { $user_op = "="; } 

                $results = DB::table('results')
                                ->leftJoin('work_files', 'results.work_file_id', '=', 'work_files.id')
                                ->leftJoin('users', 'results.user_id', '=', 'users.id')
                                ->where([
                                           
                                            ["results.user_id","$user_op",$user_id],
                                            ['users.in_out', '=', $in_out],

                                            // ['results.customer_id', '=', $customer_id],
                                            ['work_files.name', '=', $name],
                                            // ['work_files.duration', '=', $duration],

                                            ["work_files.date",">=",$from_date],
                                            ["work_files.date","<=",$to_date],
                                            
                                        ])
                                ->select('results.*')
                                ->get();


                $work_files = WorkFile::where([

                                            ['work_files.name', '=', $name],
                                           
                                            // ['work_files.duration', '=', $duration],
                                            ["work_files.date",">=",$from_date],
                                            ["work_files.date","<=",$to_date],
                                            
                                        ])

                                ->get();

            }

            else if($name == "2D" && ($duration == "AM" || $duration == "PM") )
            {
                if($user_id == 0){ $user_op = ">="; }   else { $user_op = "="; } 

                $results = DB::table('results')
                                ->leftJoin('work_files', 'results.work_file_id', '=', 'work_files.id')
                                ->leftJoin('users', 'results.user_id', '=', 'users.id')
                                ->where([
                                           
                                            ["results.user_id","$user_op",$user_id],
                                            ['users.in_out', '=', $in_out],

                                            // ['results.customer_id', '=', $customer_id],
                                            ['work_files.name', '=', $name],
                                            ['work_files.duration', '=', $duration],

                                            ["work_files.date",">=",$from_date],
                                            ["work_files.date","<=",$to_date],
                                            
                                        ])
                                ->select('results.*')
                                ->get();


                $work_files = WorkFile::where([

                                            ['work_files.name', '=', $name],                                           
                                            ['work_files.duration', '=', $duration],

                                            ["work_files.date",">=",$from_date],
                                            ["work_files.date","<=",$to_date],
                                            
                                        ])

                                ->get();

            }

            else if($name == "3D")
            {
                if($user_id == 0){ $user_op = ">="; }   else { $user_op = "="; } 

                $results = DB::table('results')
                                ->leftJoin('work_files', 'results.work_file_id', '=', 'work_files.id')
                                ->leftJoin('users', 'results.user_id', '=', 'users.id')
                                ->where([
                                           
                                            ["results.user_id","$user_op",$user_id],
                                            ['users.in_out', '=', $in_out],

                                            // ['results.customer_id', '=', $customer_id],
                                            ['work_files.name', '=', $name],
                                            // ['work_files.duration', '=', $duration],

                                            ["work_files.date",">=",$from_date],
                                            ["work_files.date","<=",$to_date],
                                            
                                        ])
                                ->select('results.*')
                                ->get();


                $work_files = WorkFile::where([

                                            ['work_files.name', '=', $name],                                           
                                            // ['work_files.duration', '=', $duration],
                                            
                                            ["work_files.date",">=",$from_date],
                                            ["work_files.date","<=",$to_date],
                                            
                                        ])

                                ->get();

            }


        }
        else
        {

            if($user_id == 0){ $user_op = ">="; }   else { $user_op = "="; } 

            $results = DB::table('results')
                            ->leftJoin('work_files', 'results.work_file_id', '=', 'work_files.id')
                            ->leftJoin('users', 'results.user_id', '=', 'users.id')
                            ->where([
                                       
                                        ["results.user_id","$user_op",$user_id],
                                        ['users.in_out', '=', $in_out],

                                        ["results.work_file_id","=",$work_file_id],

                                        // ['results.customer_id', '=', $customer_id],
                                        // ['work_files.name', '=', $name],
                                        // ['work_files.duration', '=', $duration],

                                        // ["work_files.date",">=",$from_date],
                                        // ["work_files.date","<=",$to_date],
                                        
                                    ])
                            ->select('results.*')
                            ->get();


            if($name == "2D" && $duration == "AM_PM")
            {
                $work_files = WorkFile::where([
                                           
                                            ['work_files.name', '=', $name],
                                            // ['work_files.duration', '=', $duration],

                                            ["work_files.date",">=",$from_date],
                                            ["work_files.date","<=",$to_date],
                                                
                                        ])

                                ->get();
            }
            else if($name == "3D" && $duration == "AM_PM")
            {
                $work_files = WorkFile::where([
                                           
                                            ['work_files.name', '=', $name],
                                            // ['work_files.duration', '=', $duration],

                                            ["work_files.date",">=",$from_date],
                                            ["work_files.date","<=",$to_date],
                                                
                                        ])

                                ->get();
            }
            else
            {
                 $work_files = WorkFile::where([
                                           
                                            ['work_files.name', '=', $name],
                                            ['work_files.duration', '=', $duration],

                                            ["work_files.date",">=",$from_date],
                                            ["work_files.date","<=",$to_date],
                                                
                                        ])

                                ->get();
            }
           

        }


       
      
        $users      = User::where([  
                                    ["in_out", "=", "$in_out"],                     
                                                       
                                ])->get();


        if($action == "2D")
        {
            

            $name                  = "2D";
            $duration              = $duration;
            $from_date             = $from_date;
            $to_date               = $to_date;

            $user_id               = 0;       
            $in_out                = $in_out;

            if($user_id == 0)
                { $user_op = ">="; }   
            else 
                { $user_op = "="; } 


            if($name =="2D")
            {
                if($duration == "AM_PM")
                { $duration_op = "!="; $duration = "";}   
                else 
                { $duration_op = "="; }
            }

            if($name =="3D")
            {
                $duration = "PM";
                $duration_op = "=";
            }
            

        
            $work_files = WorkFile::where([
                                            ["name","=",$name],
                                            ["duration","$duration_op", $duration],
                                            ["date",">=",$from_date],
                                            ["date","<=",$to_date],
                                            ["result_digit","!=","-"],

                                        ])->get();        

            $users      = User::where('in_out','=',$in_out)->get();




            return view('list.listresult-main',[
                                           
                                         
                                            'work_files'            => $work_files,
                                            'users'                 => $users,
                                            'user_id'               => $user_id,                                     
                                            'in_out'                => $in_out,  
                                         
                                            'action'                => $action,
                                            'name'                  => $name,
                                            'duration'              => $duration,
                                            'from_date'             => $from_date,
                                            'to_date'               => $to_date,     
                                           
                                        ]);

        }


       if($action == "3D")
        {   
            $name                  = "3D";
            $duration              = "PM";
            $from_date             = $from_date;
            $to_date               = $to_date;

            $user_id               = 0;       
            $in_out                = $in_out;

            if($user_id == 0)
                { $user_op = ">="; }   
            else 
                { $user_op = "="; } 


            if($name =="2D")
            {
                if($duration == "AM_PM")
                { $duration_op = "!="; $duration = "";}   
                else 
                { $duration_op = "="; }
            }

            if($name =="3D")
            {
                $duration = "PM";
                $duration_op = "=";
            }
            

        
            $work_files = WorkFile::where([
                                            ["name","=",$name],
                                            ["duration","$duration_op", $duration],
                                            ["date",">=",$from_date],
                                            ["date","<=",$to_date],
                                            ["result_digit","!=","-"],

                                        ])->get();        

            $users      = User::where('in_out','=',$in_out)->get();




            return view('list.listresult-main',[
                                           
                                         
                                            'work_files'            => $work_files,
                                            'users'                 => $users,
                                            'user_id'               => $user_id,                                     
                                            'in_out'                => $in_out,  
                                         
                                            'action'                => $action,
                                            'name'                  => $name,
                                            'duration'              => $duration,
                                            'from_date'             => $from_date,
                                            'to_date'               => $to_date,     
                                           
                                        ]);

        }


        $name                   = request()->name;
        $duration               = request()->duration;
        
        $from_date               = request()->from_date;
        $to_date               = request()->to_date;

        $work_file_id           = request()->work_file_id;
        $user_id                = request()->user_id;
        $customer_id            = request()->customer_id;
        $in_out                 = request()->in_out;



         $work_files = WorkFile::where([
                                           
                                            ['name', '=', $name],
                                            ['duration', '=', $duration],

                                            ["date",">=",$from_date],
                                            ["date","<=",$to_date],
                                            
                                            ["result_digit","!=","-"],
                                        ])

                                ->get();


        


        return view('list.listresult',[
                                           
                                            'work_file_id'          => $work_file_id,
                                            'user_id'               => $user_id,  
                                            'customer_id'          => $customer_id,                                   
                                            'in_out'                => $in_out,     

                                            'work_files'            => $work_files,
                                            'users'                 => $users,                                        

                                            
                                            'work_file_date'        => $work_file_date,                                           

                                            'results'               => $results,
                                            // 'result_digit'         => $result_digit,

                                            'action'                => $action,
                                            'name'                => $name,
                                            'duration'                => $duration,
                                            'from_date'                => $from_date,
                                            'to_date'                => $to_date,


                                           
                                        ]);
    }

    public function viewMain()
    {



    }
    public function showMain()
    {
       
        $action                = request()->action;
        $name                  = request()->name;
        $duration              = request()->duration;
        $from_date             = request()->from_date;
        $to_date               = request()->to_date;

        $user_id               = 0;       
        $in_out                = request()->in_out;

        if($user_id == 0)
            { $user_op = ">="; }   
        else 
            { $user_op = "="; } 


        if($name =="2D")
        {
            if($duration == "AM_PM")
            { $duration_op = "!="; $duration = "";}   
            else 
            { $duration_op = "="; }
        }

        if($name =="3D")
        {
            $duration = "PM";
            $duration_op = "=";
        }
        

    
        $work_files = WorkFile::where([
                                        ["name","=",$name],
                                        ["duration","$duration_op", $duration],
                                        ["date",">=",$from_date],
                                        ["date","<=",$to_date],
                                        ["result_digit","!=","-"],

                                    ])->get();        

        $users      = User::where('in_out','=',$in_out)->get();




        return view('list.listresult-main',[
                                       
                                     
                                        'work_files'            => $work_files,
                                        'users'                 => $users,
                                        'user_id'               => $user_id,                                     
                                        'in_out'                => $in_out,  
                                     
                                        'action'                => $action,
                                        'name'                  => $name,
                                        'duration'              => $duration,
                                        'from_date'             => $from_date,
                                        'to_date'               => $to_date,     
                                       
                                    ]);


}

}

