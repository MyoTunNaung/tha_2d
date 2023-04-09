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
        $duration       = "AM_PM";

        $now            = Carbon::now();

        $today          = Carbon::today()->toDateString();       
        
        $monday         = $now->startOfWeek()->toDateString();
        $friday         = $now->startOfWeek()->add(4,'day')->toDateString();

        
        $from_date    = $today;
        $to_date      = $today;

    	// $results 		= Result::where('work_file_id','=',$work_file_id)->get();

        //work_file_id = 0 / user_id = 0 / customer_id = 0

        $work_file_date = Workfile::where('id','=',$work_file_id)->value('date');


        $work_file_id = 0;

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

        


        $work_files = WorkFile::all();
        
        $users      = User::where('in_out','=',$in_out)->get();

        $action = "";

    	return view('list.listresult',[
                                            

                                            'work_file_id'          => $work_file_id,
                                            'user_id'               => $user_id,                                        
                                            'in_out'                => $in_out,


                                            'work_files'            => $work_files,
                                            'users'                 => $users,
                                    
                                            'results'               => $results,
                                            'result_digit'          => $result_digit,
                                            'action'                => $action,

                                            'duration'                => $duration,
                                            'from_date'                => $from_date,
                                            'to_date'                => $to_date,
                                           
                                        ]);
    }
    public function showList()
    {
        

        $action                 = request()->action;
    	// $name                   = request()->name;

        $duration               = request()->duration;
        $from_date               = request()->from_date;
        $to_date               = request()->to_date;

        $work_file_id           = request()->work_file_id;
        $user_id                = request()->user_id;
        $customer_id            = request()->customer_id;
        $in_out                 = request()->in_out;
        
        // $work_file          = WorkFile::find($work_file_id);
        // $result_digit       = $work_file->result_digit;        
      
        // if($result_digit == null)
        // {
        //     $result_digit = "";
        // }


        $work_file_date = Workfile::where('id','=',$work_file_id)->value('date');


        if($work_file_id == 0)
        {            

            if($duration == "AM" || $duration == "PM")
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

                                            ['work_files.duration', '=', $duration],
                                            ["work_files.date",">=",$from_date],
                                            ["work_files.date","<=",$to_date],
                                            
                                        ])
                                ->select('results.*')
                                ->get();


                $work_files = WorkFile::where([
                                           
                                            ['work_files.duration', '=', $duration],
                                            ["work_files.date",">=",$from_date],
                                            ["work_files.date","<=",$to_date],
                                            
                                        ])

                                ->get();
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

                                            // ['results.customer_id', '=', $customer_id],
                                            // ['work_files.name', '=', $name],

                                            // ['work_files.duration', '=', $duration],
                                            ["work_files.date",">=",$from_date],
                                            ["work_files.date","<=",$to_date],
                                            
                                        ])
                                ->select('results.*')
                                ->get();

                $work_files = WorkFile::where([
                                           
                                            
                                            ["work_files.date",">=",$from_date],
                                            ["work_files.date","<=",$to_date],
                                            
                                        ])

                                ->get();
            }                               

            

        }
        else
        {
            $work_files = WorkFile::all();


            if($user_id == 0){ $user_op = ">="; }   else { $user_op = "="; } 

            if($user_id == 0)
            {
                 $results        = Result::leftJoin('users', 'results.user_id', '=', 'users.id')
                                        ->where([

                                            ['results.work_file_id','=',$work_file_id],
                                            ["results.user_id","$user_op",$user_id],
                                            ['users.in_out', '=', $in_out],

                                            // ['user_id','=',$user_id],
                                            // ['customer_id','=',$customer_id],

                                        ])->get();
            }
            else
            {
                // $results        = Result::where([
                //                             ['work_file_id','=',$work_file_id],
                //                             ['user_id','=',$user_id],
                //                             // ['customer_id','=',$customer_id],

                //                         ])->get();

                $results        = Result::leftJoin('users', 'results.user_id', '=', 'users.id')
                                        ->where([

                                            ['results.work_file_id','=',$work_file_id],
                                            ["results.user_id","=",$user_id],
                                            ['users.in_out', '=', $in_out],
                                            

                                            // ['user_id','=',$user_id],
                                            // ['customer_id','=',$customer_id],

                                        ])
                                        ->orWhere([

                                                  ['users.refer_user_id', '=', $user_id],
                                            ])
                                        ->get();
            }
            
        }

    
        

        

        
        // $users      = User::all();
      
        $users      = User::where([  
                                    ["in_out", "=", "$in_out"],                     
                                                       
                                ])->get();


        if($action == "3D")
        {
            // Calculate ThreeSale
            $w_comm             = $work_file->w_comm;
            $w_times            = $work_file->w_times;
            $wother_times       = $work_file->wother_times;
         
            $total_sale         =   DB::table('threes')->sum('sale_amount');
            $total_purchase     =   DB::table('threes')->sum('purchase_amount');
            $total_balance      =   $total_sale - $total_purchase;

            $total_digit_amount     =   DB::table('results')->sum('digit_amount');
            $total_other_amount     =   DB::table('results')->sum('other_amount');
            $total_compensation     = ($total_digit_amount * $w_times) + ($total_other_amount + $wother_times);
            $net_total              = $total_balance-($total_balance * $w_comm/100);

           
            //Calculate Position Bet
                $p_total_sale  =    DB::table('three_positions')
                                        ->leftJoin('users', 'three_positions.user_id', '=', 'users.id')
                                        ->where([
                                                    ["three_positions.work_file_id","=",$work_file_id],
                                                    ['users.in_out', '=', 1],
                                                ])
                                        ->sum('amount');

                $p_total_purchase  =    DB::table('three_positions')
                                        ->leftJoin('users', 'three_positions.user_id', '=', 'users.id')
                                        ->where([
                                                    ["three_positions.work_file_id","=",$work_file_id],
                                                    ['users.in_out', '=', 2],
                                                ])
                                        ->sum('amount');

                $p_total_balance        =   $p_total_sale - $p_total_purchase;

                $p_total_one_amount     =   DB::table('results')->sum('one_amount');
                $p_total_pos_amount     =   DB::table('results')->sum('pos_amount');
                $p_total_two_amount     =   DB::table('results')->sum('two_amount');
                  
                $p_total_compensation   = DB::table('results')->sum('p_compensation_amount');                      

                $p_net_total            = $p_total_balance-($p_total_balance * 10/100);
            //End Position Bet

             return view('list.listresult-main',[
                                           
                                         
                                            'user_id'               => $user_id,                                     
                                            'in_out'                => $in_out,                                           
                                            'work_files'            => $work_files,
                                            'users'                 => $users,                                        

                                            'work_file_id'          => $work_file_id,
                                            'work_file_date'        => $work_file_date,                                           

                                            'results'               => $results,
                                            // 'result_digit'         => $result_digit,

                                            'action'                => $action,

                                            'total_balance'         => $total_balance,
                                            'net_total'             => $net_total,
                                            'total_digit_amount'    => $total_digit_amount,
                                            'total_other_amount'    => $total_other_amount,
                                            'total_compensation'    => $total_compensation,

                                            'p_total_balance'       => $p_total_balance,
                                            'p_net_total'           => $p_net_total,
                                            'p_total_one_amount'    => $p_total_one_amount,
                                            'p_total_pos_amount'    => $p_total_pos_amount,
                                            'p_total_two_amount'    => $p_total_two_amount,
                                            'p_total_compensation'  => $p_total_compensation,
                                          


                                           
                                        ]);

        }


        return view('list.listresult',[
                                           
                                         
                                            'user_id'               => $user_id,                                     
                                            'in_out'                => $in_out,                                           
                                            'work_files'            => $work_files,
                                            'users'                 => $users,                                        

                                            'work_file_id'          => $work_file_id,
                                            'work_file_date'        => $work_file_date,                                           

                                            'results'               => $results,
                                            // 'result_digit'         => $result_digit,

                                            'action'                => $action,
                                            'duration'                => $duration,
                                            'from_date'                => $from_date,
                                            'to_date'                => $to_date,


                                           
                                        ]);
    }
}
