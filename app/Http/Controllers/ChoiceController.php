<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Choice;
use App\Commission;

use DB;


class ChoiceController extends Controller
{
    //
	public function saveEntry(Request $request)
    {
            
        $entry          = request()->entry;

        $choice  = Choice::where('auth_id','=',auth()->user()->id)->orderBy('id','desc')->first();
                                        
            $choice->entry = $entry;
        
        $choice->save();

        
    }

    public function saveView(Request $request)
    {
               
        $view           = request()->view;

        $choice  = Choice::where('auth_id','=',auth()->user()->id)->orderBy('id','desc')->first();
                                        
            $choice->view = $view;
        
        $choice->save();

        
    }

     public function saveKeyboard(Request $request)
    {
       
        $keyboard       = request()->keyboard;

        $choice  = Choice::where('auth_id','=',auth()->user()->id)->orderBy('id','desc')->first();
                                        
            $choice->keyboard = $keyboard;
        
        $choice->save();

        
    }

    public function saveCustomer(Request $request)
    {
        
        $customer_id    = request()->customer_id;       

        $choice  = Choice::where('auth_id','=',auth()->user()->id)->orderBy('id','desc')->first();
                                        
            $choice->customer_id = $customer_id;
        
        $choice->save();

        
    }

     public function getCustomer(Request $request)
    {
       
        $in_out         = request()->in_out;
        
        $choice  = Choice::where('auth_id','=',auth()->user()->id)->orderBy('id','desc')->first();
        
            $choice->in_out = $in_out;
        
        $choice->save();
       

        $customers = DB::table('customers')->where([  
                                                        ["in_out", "=", "$in_out"],                                             
                                                       
                                                    ])->get();

        return response()->json($customers);
    }

   

    public function getUser(Request $request)
    {

        $in_out         = request()->in_out;
        
        $choice  = Choice::where('auth_id','=',auth()->user()->id)->orderBy('id','desc')->first();
        
            $choice->in_out = $in_out;
        
        $choice->save();
       

        $users = DB::table('users')->where([  
                                            ["in_out", "=", "$in_out"],                     
                                                       
                                            ])->get();

        return response()->json($users);
    }

    public function getUserInfo(Request $request)
    {

        $work_file_id   = request()->work_file_id;
        $user_id        = request()->user_id;

         $three_type = ThreeType::where([                                           
                                        
                                        ["work_file_id","=",$work_file_id],
                                        ["user_id","=",1],
                                      
                                    ])
                                ->orderBy('id','desc')
                                ->first();
                                

        if($three_type == null)
        {
            $slip_id = 1;
        }
        else
        {
            $slip_id = $three_type->slip_id + 1;
        }


         return response()->json([ 'slip_id' => "$slip_id", ]);


    }

    public function getUserThreeComm(Request $request)
    {
        $user_id     = request()->user_id; 

        $choice  = Choice::where('auth_id','=',auth()->user()->id)->orderBy('id','desc')->first();
                                        
            $choice->user_id = $user_id;
        
        $choice->save();


        $threed_comm = Commission::where([ 

                                 ['user_id','=',$user_id],
                                 
                                ])->get();


        return response()->json($threed_comm);


    }



     public function saveUser(Request $request)
    {
        $work_file_id        = request()->work_file_id;
        $user_id             = request()->user_id;        
       
        $choice  = Choice::where('auth_id','=',auth()->user()->id)->orderBy('id','desc')->first();
                                        
            $choice->user_id = $user_id;
        
        $choice->save();

        
        
    }

    public function saveSlip(Request $request)
    {
        $slip        = request()->slip;

        $choice  = Choice::where('auth_id','=',auth()->user()->id)->orderBy('id','desc')->first();
                                        
            $choice->slip = $slip;
        
        $choice->save();
    }

  

    public function saveWorkFile(Request $request)
    {
        $current_work_file_id        = request()->current_work_file_id;

        $choice  = Choice::where('auth_id','=',auth()->user()->id)->orderBy('id','desc')->first();
                                        
            $choice->work_file_id = $current_work_file_id;
        
        $choice->save();

    }

    public function saveMaxMinus(Request $request)
    {
        $max_minus        = request()->max_minus;

        $choice  = Choice::where('auth_id','=',auth()->user()->id)->orderBy('id','desc')->first();
                                        
            $choice->max_minus = $max_minus;
        
        $choice->save();
        
    }


    public function getWorkFile(Request $request)
    {
       
        $name         = request()->name;
        $duration     = request()->duration;

        
        if($name == "2D")
        {
            $work_files = DB::table('work_files')->where([  

                                                        ["name", "=", "$name"],  
                                                        ["duration", "=", "$duration"],                                            
                                                       
                                                    ])->get();
        }
        if($name == "3D")
        {
            $work_files = DB::table('work_files')->where([  

                                                        ["name", "=", "$name"], 
                                                        ["duration", "=", "PM"],                  
                                                       
                                                    ])->get();
        }
        

        return response()->json($work_files);
    }

    public function getBreakAmount(Request $request)
    {
       
        $work_file_id         = request()->work_file_id;
        

        $break_amount = DB::table('break_amounts')->where([  

                                                        ["work_file_id", "=", $work_file_id],                     
                                                       
                                                    ])->get();

        return response()->json($break_amount);
    }

}
