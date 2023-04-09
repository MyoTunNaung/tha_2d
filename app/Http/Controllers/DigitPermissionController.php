<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Carbon;
use DB;
use App\Admin;
use App\WorkFile;
use App\Hot;
use App\User;
use App\Customer;
use App\DigitPermission;
use App\Commission;
use App\Choice;

class DigitPermissionController extends Controller
{
    public function Three_Type_to_Digits($type)
    {
        $type_array = str_split($type);

        $amount1 = "";

        if(strlen($type) == 3)
        {
            $first      = $type_array[0];
            $second     = $type_array[1];
            $third      = $type_array[2];

            if( is_numeric($first) && is_numeric($second) && is_numeric($third) )
            {
                $table_name = "d3_types";
                $range1     = 1;
                $range2     = 1;                
            }
            if( is_numeric($first) && is_numeric($second) && ($third == "N" || $third == "n") )
            {
                $table_name = "n_s_e_types";
                $range1     = 1;
                $range2     = 10;                
            }
            if( is_numeric($first) && is_numeric($second) && ($third == "*") )
            {
                $table_name = "n_s_e_types";
                $range1     = 1;
                $range2     = 10;                
            }

            if( is_numeric($first) && is_numeric($second) && ($third == "L" || $third == "l") )
            {
                $table_name = "l_s_e_types";
                $range1     = 1;
                $range2     = 10;                
            }
            if( is_numeric($first) && ($second == "*") && is_numeric($third) )
            {
                $table_name = "l_s_e_types";
                $range1     = 11;
                $range2     = 20;                
            }
            
            if( is_numeric($first) && is_numeric($second) && ($third == "S" || $third == "s") )
            {
                $table_name = "s_s_e_types";
                $range1     = 1;
                $range2     = 10;                
            }

            if( ($first == "*") && is_numeric($second) && is_numeric($third) )
            {
                $table_name = "s_s_e_types";
                $range1     = 11;
                $range2     = 20;                
            }

            if( ($first     == "T" || $first    == "t")    && 
                ($second    == "R" || $second   == "r")  && 
                ($third     == "I" || $third    == "i") 
            )
            {
                $table_name = "t_r_i_types";
                $range1     = 1;
                $range2     = 10;                
            }

            if( ($first == "*") && ($second == "*") && ($third == "*") )
            {
                $table_name = "t_r_i_types";
                $range1     = 1;
                $range2     = 10;                
            }

            if( is_numeric($first) && 
                ($second    == "K" || $second   == "k")  && 
                ($third     == "P" || $third    == "p") 
            )
            {
                $table_name = "k_p_types";
                $range1     = 1;
                $range2     = 10;                
            }

            if( is_numeric($first) && ($second == "*")  && is_numeric($third) )
            {
                $table_name = "k_p_types";
                $range1     = 11;
                $range2     = 20;                
            }

            if( is_numeric($first) && ($second == "+")  && is_numeric($third) )
            {
                $table_name = "s_k_p_types";
                $range1     = 6;
                $range2     = 10;                
            }

            if( is_numeric($first) && ($second == "-")  && is_numeric($third) )
            {
                $table_name = "m_k_p_types";
                $range1     = 6;
                $range2     = 10;                
            }

            if( ($first == "*") && is_numeric($second)  && ($third == "*") )
            {
                $table_name = "k_s_types";
                $range1     = 11;
                $range2     = 20;                
            }

            if( ($first == "+") && is_numeric($second)  && ($third == "+") )
            {
                $table_name = "k_s_s_types";
                $range1     = 6;
                $range2     = 10;                
            }
            if( ($first == "-") && is_numeric($second)  && ($third == "-") )
            {
                $table_name = "k_s_m_types";
                $range1     = 6;
                $range2     = 10;                
            }

            if( is_numeric($first) && 
                ($second    == "K" || $second   == "k")  && 
                ($third     == "S" || $third    == "s") 
            )
            {
                $table_name = "k_s_types";
                $range1     = 1;
                $range2     = 10;                
            }


        }
        else if(strlen($type) == 4)
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
            }

            if(     is_numeric($first)  && 
                    ( $second =="S" || $second =="s"  ) && 
                    ( $third  =="K" || $third  =="k"  )  && 
                    ( $fourth =="P" || $fourth =="p"  )
                )
            {
                $table_name = "s_k_p_types";
                $range1     = 1;
                $range2     = 5;
            }

            if(     is_numeric($first)  && 
                    ( $second =="M" || $second =="m"  ) && 
                    ( $third  =="K" || $third  =="k"  )  && 
                    ( $fourth =="P" || $fourth =="p"  )
                )
            {
                $table_name = "m_k_p_types";
                $range1     = 1;
                $range2     = 5;
            }

            if(     is_numeric($first)  && 
                    ( $second =="K" || $second =="k"  ) && 
                    ( $third  =="S" || $third  =="s"  )  && 
                    ( $fourth =="S" || $fourth =="s"  )
                )
            {
                $table_name = "k_s_s_types";
                $range1     = 1;
                $range2     = 5;
            }

            if(     is_numeric($first)  && 
                    ( $second =="K" || $second =="k"  ) && 
                    ( $third  =="S" || $third  =="s"  )  && 
                    ( $fourth =="M" || $fourth =="m"  )
                )
            {
                $table_name = "k_s_m_types";
                $range1     = 1;
                $range2     = 5;
            }


        }
        else if(strlen($type) == 5)
        {
            $first      = $type_array[0];
            $second     = $type_array[1];
            $third      = $type_array[2];
            $fourth     = $type_array[3];
            $fifth      = $type_array[4];

            if(     is_numeric($first)  && 
                    is_numeric($second) && 
                    is_numeric($third)  && 
                    ( $fourth =="R" || $fourth =="r" || $fourth =="+" ) &&
                    ( $fifth  =="R" || $fifth  =="r" || $fifth  =="+" )
                )
            {
                $table_name = "d3_types";
                $range1     = 1;
                $range2     = 6; 

                $amount1 = 0;               
            }

        }
        else if( (strlen($type) == 2) && 
                 ($type == "R5" || $type == "R4" || $type == "R3" || $type == "R2" || $type == "R1") 
                ) // R5 R4 R3 R2 R1
        {
            $hot = Hot::where([    
                                ["work_file_id","=",$work_file_id],

                            ])
                            ->orderBy('id','desc')                            
                            ->first();
            
            $last_digit = $hot->digit;
            $last_digit_array = str_split($last_digit);

            $first      = $last_digit_array[0];
            $second     = $last_digit_array[1];
            $third      = $last_digit_array[2];

            $type       = request()->type;
            $type_array = str_split($type);

            $fourth     = $type_array[0];
            $fifth      = $type_array[1];

            if(     is_numeric($first)  && 
                    is_numeric($second) && 
                    is_numeric($third)  && 
                    ( $fourth =="R" || $fourth =="r" || $fourth =="+" ) &&
                    ( $fifth  ==5 )
                )
            {
                $table_name = "d3_types";
                $range1     = 2;
                $range2     = 6;                
            }

            if(     is_numeric($first)  && 
                    is_numeric($second) && 
                    is_numeric($third)  && 
                    ( $fourth =="R" || $fourth =="r" || $fourth =="+" ) &&
                    ( $fifth  ==4 )
                )
            {
                $table_name = "d3_types";
                $range1     = 3;
                $range2     = 6;                
            }

            if(     is_numeric($first)  && 
                    is_numeric($second) && 
                    is_numeric($third)  && 
                    ( $fourth =="R" || $fourth =="r" || $fourth =="+" ) &&
                    ( $fifth  ==3 )
                )
            {
                $table_name = "d3_types";
                $range1     = 4;
                $range2     = 6;                
            }


            if(     is_numeric($first)  && 
                    is_numeric($second) && 
                    is_numeric($third)  && 
                    ( $fourth =="R" || $fourth =="r" || $fourth =="+" ) &&
                    ( $fifth  ==2 )
                )
            {
                $table_name = "d3_types";
                $range1     = 5;
                $range2     = 6;                
            }

            if(     is_numeric($first)  && 
                    is_numeric($second) && 
                    is_numeric($third)  && 
                    ( $fourth =="R" || $fourth =="r" || $fourth =="+" ) &&
                    ( $fifth  ==1 )
                )
            {
                $table_name = "d3_types";
                $range1     = 6;
                $range2     = 6;                
            }




        }
        
        $d3_types = DB::table("$table_name")
                            ->where([                                           
                                    ["id",">=",$range1],
                                    ["id","<=",$range2],
                                ])
                            ->get();

        $digit_array = array();

        if($table_name == "t_r_i_types")
        {
            foreach ($d3_types as $d3_type) 
            {
                              
                $digit = $d3_type->d1.$d3_type->d2.$d3_type->d3;

                array_push($digit_array, $digit); 
            }
        }
        else
        {
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

                array_push($digit_array, $digit); 
            }
        }        

        $result_digits = array_unique($digit_array);

        return $result_digits;
    }

    public function Two_Type_to_Digits($type)
    {
        $type_array = str_split($type);

        $amount1 = "";

        if(strlen($type) == 1)
        {
            $first      = $type_array[0];

            if( $first == "+" )
            {
                $table_name = "p_w_types";
                $range1     = 1;
                $range2     = 10;                
            }
            if( $first == "-" )
            {
                $table_name = "n_k_types";
                $range1     = 1;
                $range2     = 10;                
            }
            if( $first == "D" || $first == "d" || $first == "/" )
            {
                $table_name = "d_types";
                $range1     = 1;
                $range2     = 10;                
            }

        }

        else if(strlen($type) == 2)
        {
            $first      = $type_array[0];
            $second     = $type_array[1];

            if( is_numeric($first) && is_numeric($second) )
            {
                $table_name = "d2_types";
                $range1     = 1;
                $range2     = 1;                
            }
            if( is_numeric($first) && ($second == "T" || $second == "t" || $second == "*") )
            {
                $table_name = "t_types";
                $range1     = 1;
                $range2     = 10;                
            }
            if( is_numeric($first) && ($second == "N" || $second == "n") )
            {
                $table_name = "n_types";
                $range1     = 1;
                $range2     = 10;                
            }
            if( ($first == "*") && is_numeric($second) )
            {
                $table_name = "n_types";
                $range1     = 11;
                $range2     = 20;                
            }
            if( is_numeric($first) && ($second == "R" || $second == "r" || $second == "-") )
            {
                $table_name = "r_types";
                $range1     = 1;
                $range2     = 20;                
            }
            if( is_numeric($first) && ($second == "S" || $second == "s") )
            {
                $table_name = "n_s_types";
                $range1     = 1;
                $range2     = 5;                
            }
            if( ($first == "S" || $first == "s") && is_numeric($second) )
            {
                $table_name = "s_n_types";
                $range1     = 1;
                $range2     = 5;                
            }
            if( is_numeric($first) && ($second == "M" || $second == "m") )
            {
                $table_name = "n_m_types";
                $range1     = 1;
                $range2     = 5;                
            }
            if( ($first == "M" || $first == "m") && is_numeric($second) )
            {
                $table_name = "m_n_types";
                $range1     = 1;
                $range2     = 5;                
            }
            if( ($first  == "S" || $first  == "s" || $first  == "+") && 
                ($second == "S" || $second =="s"  || $second == "+") 
            )
            {
                $table_name = "s_s_types";
                $range1     = 1;
                $range2     = 25;                
            }
            if( ($first  == "M" || $first  == "m" || $first  == "-") && 
                ($second == "M" || $second =="m"  || $second == "-") 
            )
            {
                $table_name = "m_m_types";
                $range1     = 1;
                $range2     = 25;                
            }
            if( ($first  == "S" || $first  == "s" || $first  == "+") && 
                ($second == "M" || $second =="m"  || $second == "-") 
            )
            {
                $table_name = "s_m_types";
                $range1     = 1;
                $range2     = 25;                
            }
            if( ($first  == "M" || $first  == "m" || $first  == "-") && 
                ($second == "S" || $second =="s"  || $second == "+") 
            )
            {
                $table_name = "m_s_types";
                $range1     = 1;
                $range2     = 25;                
            }
            if( ($first  == "S" || $first  == "s" || $first  == "+") && 
                ($second == "P" || $second =="p"  || $second == "*") 
            )
            {
                $table_name = "s_p_types";
                $range1     = 1;
                $range2     = 5;                
            }
            if( ($first  == "M" || $first  == "m" || $first  == "-") && 
                ($second == "P" || $second =="p"  || $second == "*") 
            )
            {
                $table_name = "m_p_types";
                $range1     = 1;
                $range2     = 5;                
            }
            if( ($first  == "P" || $first  == "p" || $first  == "*") && 
                ($second == "P" || $second =="p"  || $second == "*") 
            )
            {
                $table_name = "p_p_types";
                $range1     = 1;
                $range2     = 10;                
            }
            if( ($first  == "P" || $first  == "p" ) && ($second == "W" || $second == "w" ) )
            {
                $table_name = "p_w_types";
                $range1     = 1;
                $range2     = 10;                
            }
            if( ($first  == "N" || $first  == "n" ) && ($second == "K" || $second == "k" ) )
            {
                $table_name = "n_k_types";
                $range1     = 1;
                $range2     = 10;                
            }
            if( ($first  == "D" || $first  == "d" || $first  == "/") && 
                ($second == "S" || $second =="s"  || $second == "+") 
            )
            {
                $table_name = "d_s_types";
                $range1     = 1;
                $range2     = 5;                
            }
            if( ($first  == "D" || $first  == "d" || $first  == "/") && 
                ($second == "M" || $second =="m"  || $second == "-") 
            )
            {
                $table_name = "d_m_types";
                $range1     = 1;
                $range2     = 5;                
            }
            if( ($first  == "T" || $first  == "t" || $first  == "+") && 
                ($second == "K" || $second =="k"  || $second == "/") 
            )
            {
                $table_name = "t_k_types";
                $range1     = 1;
                $range2     = 10;                
            }
            if( ($first  == "K" || $first  == "k" || $first  == "-") && 
                ($second == "T" || $second =="t"  || $second == "/") 
            )
            {
                $table_name = "k_t_types";
                $range1     = 1;
                $range2     = 10;                
            }
            if( ($first  == "B" || $first  == "b" || $first  == "/") && 
                ($second == "R" || $second =="r"  || $second == "/") 
            )
            {
                $table_name = "b_r_types";
                $range1     = 1;
                $range2     = 20;                
            }


        }

        else if(strlen($type) == 3)
        {
            $first      = $type_array[0];
            $second     = $type_array[1];
            $third      = $type_array[2];

            if( is_numeric($first) && is_numeric($second) && ($third == "R" || $third == "r" || $third == "+") )
            {
                $table_name = "d2_types";
                $range1     = 1;
                $range2     = 2;                
            }
            if( is_numeric($first) && ($second == "*") && ($third == "+") )
            {
                $table_name = "n_s_types";
                $range1     = 1;
                $range2     = 5;                
            }
            if( ($first == "*") && is_numeric($second) && ($third == "+") )
            {
                $table_name = "s_n_types";
                $range1     = 1;
                $range2     = 5;                
            }
            if( is_numeric($first) && 
                ($second == "S" || $second == "s" || $second == "+") && 
                ($third  == "R" || $third  == "r" || $third  == "+") 
              )
            {
                $table_name = "n_s_r_types";
                $range1     = 1;
                $range2     = 10;                
            }
            if( is_numeric($first) && ($second == "*") && ($third == "-") )
            {
                $table_name = "n_m_types";
                $range1     = 1;
                $range2     = 5;                
            }
            if( ($first == "*") && is_numeric($second) && ($third == "-") )
            {
                $table_name = "m_n_types";
                $range1     = 1;
                $range2     = 5;                
            }
            if( is_numeric($first) && 
                ($second == "M" || $second == "m" || $second == "-") && 
                ($third  == "R" || $third  == "r" || $third  == "-") 
              )
            {
                $table_name = "n_m_r_types";
                $range1     = 1;
                $range2     = 10;                
            }



        }




        $d2_types = DB::table("$table_name")
                            ->where([                                           
                                    ["id",">=",$range1],
                                    ["id","<=",$range2],
                                ])
                            ->get();

        $digit_array = array();

        if($table_name == "s_s_types")
        {
            foreach ($d2_types as $d2_type) 
            {
                              
                $digit = $d2_type->d1.$d2_type->d2;

                array_push($digit_array, $digit); 
            }
        }
        else
        {
            foreach ($d2_types as $d2_type) 
            {
                $d1 = $d2 = $d3 = "";

                if( $d2_type->d1 == "first")        { $d1 = $first; }
                else if( $d2_type->d1 == "second")  { $d1 = $second; }                
                else                                { $d1 = $d2_type->d1; }

                if( $d2_type->d2 == "first")        { $d2 = $first; }
                else if( $d2_type->d2 == "second")  { $d2 = $second; }                
                else                                { $d2 = $d2_type->d2; }

                $digit = $d1.$d2.$d3;

                array_push($digit_array, $digit); 
            }
        }        

        $result_digits = array_unique($digit_array);

        return $result_digits;

    }
   
    public function listDigitPermission()
    {    	
            //Get Info
            $work_file_id   = Choice::where('auth_id','=',auth()->user()->id)->value('work_file_id');
            // $slip           = Choice::where('auth_id','=',auth()->user()->id)->value('slip');

            // $user_id        = Choice::where('auth_id','=',auth()->user()->id)->value('user_id');
            // $choice         = Choice::where('auth_id','=',$user_id)->first();
          
            // $user_id        = $choice->user_id;
            // $customer_id    = $choice->customer_id;
            // $in_out         = $choice->in_out;
            // $entry          = $choice->entry;
            // $view           = $choice->view;
            // $keyboard       = $choice->keyboard;
            // $max_minus      = $choice->max_minus;           
            //End Get Info

        if($work_file_id == null)
        {
            return back();
        }


        return redirect("/digitpermission/add/$work_file_id");

    } 

    public function addDigitPermission(Request $request)
    {
        if(request()->action == "Show")
        {
            $work_file_id   =   request()->work_file_id;

            $user_id        =   request()->user_id;
            $user_name      =   User::where("id","=",$user_id)->value('name'); 

            if($user_name == null)
            { 
                $user_name = "All"; 

                 $old_permissions = DigitPermission::where([

                                ["work_file_id","=",$work_file_id],
                                // ["user_id","=",$user_id],
                            
                                ["status","=",1],
                                ["confirm","=",1],
                            ])                            
                        ->get();
            }
            else
            {
                 $old_permissions = DigitPermission::where([

                                ["work_file_id","=",$work_file_id],
                                ["user_id","=",$user_id],
                            
                                ["status","=",1],
                                ["confirm","=",1],
                            ])                            
                        ->get();
            }

            $type_sale      = 0;

            
        }
        else
        {  
            $work_file_id   = request()->id;

            $user_id        = 0;
            $user_name      = "All";

            
            $type_sale      = 0;

            $old_permissions = DigitPermission::where([

                                ["work_file_id","=",$work_file_id],
                                // ["user_id","=",$user_id],
                            
                                ["status","=",1],
                                ["confirm","=",1],
                            ])                            
                        ->get();
        }
           
        

        $users 			= User::where([ 
                                        ['id','>',2], 
                                        ['in_out','=',1], 

                                    ])->get();     


         $new_permissions = DigitPermission::where([
                                ["work_file_id","=",$work_file_id],
                                ["user_id","=",$user_id],                              

                                ["status","=",1],
                                ["confirm","=",0],
                            ])                            
                        ->get();


      
       $work_files = WorkFile::all();
    

    return view('digitpermission.addthreedigitpermission',[ 

                                  
                                    'work_file_id'       => $work_file_id,
                                    'user_id'            => $user_id,

                                    'work_files'         => $work_files, 
                                    'users'              => $users,                                    
                                    
                                    'user_name'          => $user_name,

                                    'type_sale'          => $type_sale,

                                    
                                    'old_permissions'    => $old_permissions, 
                                    'new_permissions'    => $new_permissions, 

                                ]);
     
        
    }

    public function createDigitPermission()
    {
        $validator = validator(request()->all(),
            [
               
                "type"              => "required",
                "digit_percent"     => "required",
                // "type_sale"         => "required",

                               
            ]);

        if($validator->fails())
        {
            return back()->with('info',"Data can not be Blank!!!");
        }

       
        $work_file_id   = request()->w_id;
        $user_id        = request()->u_id;

        $type           = request()->type;
        $digit_percent  = request()->digit_percent;
        $type_sale      = request()->type_sale;


        //Type to Digits
        $type           = request()->type;        
        $result_digits  = $this->Two_Type_to_Digits($type);
        //Type to Digits
    

        foreach ($result_digits as $result_digit) 
        {
            if (DigitPermission::where([    ['work_file_id', '=',$work_file_id],
            								['user_id', '=', $user_id],
                                			['digit', '=', "$result_digit"],
                            ])->exists()) 
            {
               $status = 0;
            }
            else
            {
                $status = 1;
            }

            $digit_permission = new DigitPermission();

                          
                $digit_permission->work_file_id     = $work_file_id;
                $digit_permission->user_id     		= $user_id;
               
                $digit_permission->type             = $type;
                $digit_permission->digit            = $result_digit;

                $digit_permission->digit_percent    = $digit_percent;
                $digit_permission->type_sale        = $type_sale;
               
                $digit_permission->status           = $status;
                $digit_permission->confirm          = 1;

            $digit_permission->save();

        }


        $work_files     = WorkFile::all();

        $users          = User::where([ 
                                        ['id','>',2], 
                                        ['in_out','=',1], 

                                    ])->get();    

        $user_name      = User::where("id","=",$user_id)->value('name'); 
        

        $old_permissions = DigitPermission::where([
                                ["work_file_id","=",$work_file_id],
                                ["user_id","=",$user_id],
                              
                                ["status","=",1],
                                ["confirm","=",1],
                            ])                            
                        ->get();


         $new_permissions = DigitPermission::where([
                                ["work_file_id","=",$work_file_id],
                                ["user_id","=",$user_id],
                           
                                ["status","=",1],
                                ["confirm","=",0],
                            ])                            
                        ->get();

      return view('digitpermission.addthreedigitpermission',[ 

                                  
                                    'work_file_id'       => $work_file_id,
                                    'user_id'            => $user_id,

                                    'work_files'         => $work_files, 
                                    'users'              => $users,                                    
                                    
                                    'user_name'          => $user_name,

                                    'type_sale'          => $type_sale,

                                    
                                    'old_permissions'    => $old_permissions, 
                                    'new_permissions'    => $new_permissions, 

                                ]);
      

    }

    public function confirmDigitPermission()
    {
       
        $digit_permissions = DigitPermission::where([
                                ["work_file_id","=",request()->id],
                                ["status","=",1]
                            ])                            
                        ->get();

        foreach ($digit_permissions as $digit_permission) 
        {
            $digit_permission->confirm = 1;
            $digit_permission->save();
        }

        DB::table('digit_permissions')->where('status', '=', 0)->delete();

        // return redirect('/digitpermission/list');

        return back();
    }

    public function delDigitPermission($id)
    {
    	$digit_permission = DigitPermission::find($id);
        
        $work_file_id = $digit_permission->work_file_id;

        $confirm      = $digit_permission->confirm;

        if($confirm == 0)
        {
            DB::table('digit_permissions')->where('id', '=', "$id")->delete();

            return redirect("/digitpermission/add/{$work_file_id}");
        }
        if($confirm == 1)
        {
            DB::table('digit_permissions')->where('id', '=', "$id")->delete();

            return back();
        }

      
    }

    public function delAllDigitPermission($id)
    {
       
        $digit_permission   = DigitPermission::find($id);
        $work_file_id = $digit_permission->work_file_id;
        $confirm      = $digit_permission->confirm;

        if($confirm == 0)
        {
           
            DB::table('digit_permissions')->where([ 
                                                    ['work_file_id', '=', "$work_file_id"], 
                                                    ['confirm', '=', 0], 
                                                ])->delete();

            return redirect("/digitpermission/add/{$work_file_id}");
        }
        if($confirm == 1)
        {
           
            DB::table('digit_permissions')->where([ 
                                                    ['work_file_id', '=', "$work_file_id"], 
                                                    ['confirm', '=', 1], 
                                                ])->delete();
            return back();
        }


    }

    public function delTypeDigitPermission($id)
    {

        $digit_permission   = DigitPermission::find($id);

        $work_file_id   = $digit_permission->work_file_id;
        $type           = $digit_permission->type;
        $confirm        = $digit_permission->confirm;

       

        if($confirm == 0)
        {
           
            DB::table('digit_permissions')->where([ 
                                    ['work_file_id', '=', "$work_file_id"], 
                                    ['type', '=', "$type"], 
                                   
                                ])->delete();

            return redirect("/digitpermission/add/{$work_file_id}");
        }
        if($confirm == 1)
        {
           
            DB::table('digit_permissions')->where([ 
                                    ['work_file_id', '=', "$work_file_id"], 
                                    ['type', '=', "$type"], 
                                   
                                ])->delete();
            return back();
        }

        
    }
}
