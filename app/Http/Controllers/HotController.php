<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Carbon;
use DB;
use App\Admin;
use App\WorkFile;
use App\Hot;
use App\User;
use App\Commission;
use App\Choice;

class HotController extends Controller
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
   
    public function listHot()
    { 

        //Get Info
            $work_file_id   = Choice::where('auth_id','=',auth()->user()->id)->value('work_file_id');
            $slip           = Choice::where('auth_id','=',auth()->user()->id)->value('slip');

            $user_id        = Choice::where('auth_id','=',auth()->user()->id)->value('user_id');
            $choice         = Choice::where('auth_id','=',$user_id)->first();
          
            $user_id        = $choice->user_id;
            $customer_id    = $choice->customer_id;
            $in_out         = $choice->in_out;
            $entry          = $choice->entry;
            $view           = $choice->view;
            $keyboard       = $choice->keyboard;
            $max_minus      = $choice->max_minus;           
            //End Get Info 

     
        if($work_file_id == null)
        {
            return back();
        }

        return redirect("/hot/add/$work_file_id");       

    }  

    public function addMoreHotDigit(Request $request)
    {
        $work_file       = WorkFile::find(request()->w_id);

        $workfile_name  = $work_file->show;

        $name           = $work_file->name;
        $duration       = $work_file->duration;
        $work_file_id   = $work_file->id;


        $slip_id        = request()->s_id;

        if($slip_id == null)
        {
            $slip_id        = 0;
        }

     
       


       //Get Info
            // $work_file_id   = Choice::where('auth_id','=',auth()->user()->id)->value('work_file_id');
            $slip           = Choice::where('auth_id','=',auth()->user()->id)->value('slip');

            $user_id        = Choice::where('auth_id','=',auth()->user()->id)->value('user_id');
            $choice         = Choice::where('auth_id','=',$user_id)->first();
          
            $user_id        = $choice->user_id;
            $customer_id    = $choice->customer_id;
            $in_out         = $choice->in_out;
            $entry          = $choice->entry;
            $view           = $choice->view;
            $keyboard       = $choice->keyboard;
            $max_minus      = $choice->max_minus;           
            //End Get Info


        $old_hots = Hot::where([
                                ["work_file_id","=",$work_file_id],
                                ["status","=",1],
                                ["confirm","=",1],
                            ])                            
                        ->get();


         $new_hots = Hot::where([
                                ["work_file_id","=",$work_file_id],
                                ["slip_id","=",$slip_id],
                                ["confirm","=",0],
                            ])                            
                        ->get();


        if($name == "2D")
        {
            
            $work_files = WorkFile::where([ 
                                            ['name','=',"$name"],
                                            ['duration','=',"$duration"],

                                        ])->get();

            return view('hot.addtwohot',[ 
                                            'work_file_id'  => $work_file_id,
                                            'workfile_name' => $workfile_name,

                                            'name'          => $name,
                                            'duration'      => $duration,
                                            'work_file_id'  => $work_file_id,

                                            'slip_id'       => $slip_id,
                                          
                                            'old_hots'          => $old_hots, 
                                            'new_hots'          => $new_hots, 

                                            'work_files'    => $work_files, 
                                            'keyboard'      => $keyboard,

                                        ]);
        }
        if($name == "3D")
        {
            
            $work_files = WorkFile::where([ 
                                            ['name','=',"$name"],
                                           
                                        ])->get();

            return view('hot.addthreehot',[ 
                                            'work_file_id'  => $work_file_id,
                                            'workfile_name' => $workfile_name,

                                            'name'          => $name,
                                            'duration'      => $duration,
                                            'work_file_id'  => $work_file_id,

                                            'slip_id'       => $slip_id,

                                            'old_hots'          => $old_hots, 
                                            'new_hots'          => $new_hots, 

                                            'work_files'    => $work_files,  
                                            'keyboard'      => $keyboard,

                                        ]);
        }

    }

   
    public function addHotDigit(Request $request)
    {
        
        $work_file      = WorkFile::find(request()->w_id);
        $workfile_name  = $work_file->show;

        $name           = $work_file->name;
        $duration       = $work_file->duration;
        $work_file_id   = $work_file->id;
        

        

        //Get Info
            // $work_file_id   = Choice::where('auth_id','=',auth()->user()->id)->value('work_file_id');
            $slip           = Choice::where('auth_id','=',auth()->user()->id)->value('slip');

            $user_id        = Choice::where('auth_id','=',auth()->user()->id)->value('user_id');

            $keyboard        = Choice::where('auth_id','=',auth()->user()->id)->value('keyboard');

            $choice         = Choice::where('auth_id','=',$user_id)->first();
          
            $user_id        = $choice->user_id;
            $customer_id    = $choice->customer_id;
            $in_out         = $choice->in_out;
            $entry          = $choice->entry;
            $view           = $choice->view;
            // $keyboard       = $choice->keyboard;
            $max_minus      = $choice->max_minus;           
            //End Get Info


        $slip_id        = request()->s_id;
        if($slip_id == null)
        {
            $slip_id        = 0;
        }

        // dd($slip_id);


        


        

        // dd($work_file_id);


        $old_hots = Hot::where([
                                ["work_file_id","=",$work_file_id],
                                ["status","=",1],
                                ["confirm","=",1],
                            ])                            
                        ->get();


         $new_hots = Hot::where([
                                ["work_file_id","=",$work_file_id],
                                ["slip_id","=",$slip_id],
                                ["confirm","=",0],
                            ])                            
                        ->get();


        if($name == "2D")
        {
            
            $work_files = WorkFile::where([ 
                                            ['name','=',"$name"],
                                            ['duration','=',"$duration"],

                                        ])->get();

            return view('hot.addtwohot',[ 
                                            'work_file_id'  => $work_file_id,
                                            'workfile_name' => $workfile_name,

                                            'name'          => $name,
                                            'duration'      => $duration,
                                            'work_file_id'  => $work_file_id,

                                            'slip_id'       => $slip_id,
                                          
                                            'old_hots'          => $old_hots, 
                                            'new_hots'          => $new_hots, 

                                            'work_files'    => $work_files, 

                                            'keyboard'      => $keyboard,
                                        ]);
        }
        if($name == "3D")
        {
            
            $work_files = WorkFile::where([ 
                                            ['name','=',"$name"],
                                           
                                        ])->get();

            return view('hot.addthreehot',[ 
                                            'work_file_id'  => $work_file_id,
                                            'workfile_name' => $workfile_name,

                                            'name'          => $name,
                                            'duration'      => $duration,
                                            'work_file_id'  => $work_file_id,

                                            'slip_id'       => $slip_id,

                                            'old_hots'          => $old_hots, 
                                            'new_hots'          => $new_hots, 

                                            'work_files'    => $work_files,  
                                            'keyboard'      => $keyboard,
                                        ]);
        }
        
    }

    public function listShowHot()
    {
     
        // $name           = request()->name;
        // $duration       = request()->duration;
        $work_file_id   = request()->work_file_id;

        $slip_id        = 0;

        $work_file      = WorkFile::find($work_file_id);
        $workfile_name  = $work_file->show;

        $name           = $work_file->name;
        $duration       = $work_file->duration;
        $work_file_id   = $work_file->id;
        

        $workfile_name  = $work_file->show;

        //Get Info
            // $work_file_id   = Choice::where('auth_id','=',auth()->user()->id)->value('work_file_id');
            $slip           = Choice::where('auth_id','=',auth()->user()->id)->value('slip');

            $user_id        = Choice::where('auth_id','=',auth()->user()->id)->value('user_id');
            $keyboard        = Choice::where('auth_id','=',auth()->user()->id)->value('keyboard');

            $choice         = Choice::where('auth_id','=',$user_id)->first();
          
            $user_id        = $choice->user_id;
            $customer_id    = $choice->customer_id;
            $in_out         = $choice->in_out;
            $entry          = $choice->entry;
            $view           = $choice->view;
            // $keyboard       = $choice->keyboard;
            $max_minus      = $choice->max_minus;           
            //End Get Info

        $old_hots = Hot::where([
                                ["work_file_id","=",$work_file_id],
                                ["status","=",1],
                                ["confirm","=",1],
                            ])                            
                        ->get();


         $new_hots = Hot::where([
                                ["work_file_id","=",$work_file_id],
                                ["slip_id","=",$slip_id],
                                ["confirm","=",0],
                            ])                            
                        ->get();


        if($name == "2D")
        {
            
            $work_files = WorkFile::where([ 
                                            ['name','=',"$name"],
                                            ['duration','=',"$duration"],

                                        ])->get();

            return view('hot.addtwohot',[ 
                                            'work_file_id'  => $work_file_id,
                                            'workfile_name' => $workfile_name,

                                            'name'          => $name,
                                            'duration'      => $duration,
                                            'work_file_id'  => $work_file_id,

                                            'slip_id'       => $slip_id,

                                            'old_hots'          => $old_hots, 
                                            'new_hots'          => $new_hots, 

                                            'work_files'    => $work_files, 
                                            'keyboard'      => $keyboard,

                                        ]);
        }
        if($name == "3D")
        {
            
            $work_files = WorkFile::where([ 
                                            ['name','=',"$name"],
                                           
                                        ])->get();

            return view('hot.addthreehot',[ 
                                            'work_file_id'  => $work_file_id,
                                            'workfile_name' => $workfile_name,

                                            'name'          => $name,
                                            'duration'      => $duration,
                                            'work_file_id'  => $work_file_id,

                                            'slip_id'       => $slip_id,

                                            'old_hots'          => $old_hots, 
                                            'new_hots'          => $new_hots, 

                                            'work_files'    => $work_files, 
                                            'keyboard'      => $keyboard,

                                        ]);
        }
    }

    public function createHotDigit()
    {

        $validator = validator(request()->all(),
            [
                "select_work_file_id"    => "required",
                "type"                   => "required",
                               
            ]);

        if($validator->fails())
        {
            return back()->with('info',"Data can not be Blank!!!");
        }


        $work_file_id   =  request()->select_work_file_id;
        $slip_id        =  request()->select_slip_id;
        $type           =  request()->type;

        //dd($work_file_id);

        if($slip_id == "0")
        {
            //Slip
            $hot = Hot::where([   
                                        ["work_file_id","=",$work_file_id],
                                    ])
                                ->orderBy('id','desc')
                                ->first();

            if($hot != null)
            {
                $slip_id = $hot->slip_id +1;
            }
            else
            {
                $slip_id = 1;
            }
            //End Slip
        }

        $work_file       = WorkFile::find($work_file_id);

        $workfile_name  = $work_file->show;

        $name           = $work_file->name;
        $duration       = $work_file->duration;


        if($work_file->name == "2D")
        {
            //Type to Digits                 
            $result_digits  = $this->Two_Type_to_Digits($type);
            //Type to Digits
        }
        if($work_file->name == "3D")
        {
            //Type to Digits                
            $result_digits  = $this->Three_Type_to_Digits($type);
            //Type to Digits
        }
        

        foreach ($result_digits as $result_digit) 
        {
            if (Hot::where([    ['work_file_id', '=', $work_file_id],
                                ['digit', '=', "$result_digit"],
                            ])->exists()) 
            {
               $status = 0;               
            }
            else
            {
                $status = 1;

                $hot = new Hot();
                          
                    $hot->work_file_id     = $work_file_id;
                    $hot->slip_id          = $slip_id;

                    $hot->type             = $type;
                    $hot->digit            = $result_digit;

                    $hot->status           = $status;
                    $hot->confirm          = 1;

                $hot->save();
            }

        }

        //Get Info
            // $work_file_id   = Choice::where('auth_id','=',auth()->user()->id)->value('work_file_id');
            $slip           = Choice::where('auth_id','=',auth()->user()->id)->value('slip');

            $user_id        = Choice::where('auth_id','=',auth()->user()->id)->value('user_id');

            $keyboard        = Choice::where('auth_id','=',auth()->user()->id)->value('keyboard');

            $choice         = Choice::where('auth_id','=',$user_id)->first();
          
            $user_id        = $choice->user_id;
            $customer_id    = $choice->customer_id;
            $in_out         = $choice->in_out;
            $entry          = $choice->entry;
            $view           = $choice->view;
            // $keyboard       = $choice->keyboard;
            $max_minus      = $choice->max_minus;           
            //End Get Info
        

        $old_hots = Hot::where([
                                ["work_file_id","=",$work_file_id],
                                ["status","=",1],
                                ["confirm","=",1],
                            ])                            
                        ->get();


         $new_hots = Hot::where([
                                ["work_file_id","=",$work_file_id],
                                ["slip_id","=",$slip_id],
                                ["confirm","=",0],
                            ])                            
                        ->get();


        if($name == "2D")
        {
            
            $work_files = WorkFile::where([ 
                                            ['name','=',"$name"],
                                            ['duration','=',"$duration"],

                                        ])->get();

            return view('hot.addtwohot',[ 
                                            'work_file_id'  => $work_file_id,
                                            'workfile_name' => $workfile_name,

                                            'name'          => $name,
                                            'duration'      => $duration,
                                            'work_file_id'  => $work_file_id,

                                            'slip_id'       => $slip_id,

                                            'old_hots'          => $old_hots, 
                                            'new_hots'          => $new_hots, 

                                            'work_files'    => $work_files, 
                                            'keyboard'      => $keyboard,

                                        ]);
        }
        if($name == "3D")
        {
            
            $work_files = WorkFile::where([ 
                                            ['name','=',"$name"],
                                           
                                        ])->get();

            return view('hot.addthreehot',[ 
                                            'work_file_id'  => $work_file_id,
                                            'workfile_name' => $workfile_name,

                                            'name'          => $name,
                                            'duration'      => $duration,
                                            'work_file_id'  => $work_file_id,

                                            'slip_id'       => $slip_id,

                                            'old_hots'          => $old_hots, 
                                            'new_hots'          => $new_hots, 

                                            'work_files'    => $work_files, 
                                            'keyboard'      => $keyboard,

                                        ]);
        }


    }

    public function saveHotDigit()
    {
       
       $work_file_id = request()->id;


        $hots = Hot::where([
                                ["work_file_id","=",$work_file_id],
                                ["status","=",1]
                            ])                            
                        ->get();

        foreach ($hots as $hot) 
        {
            $hot->confirm = 1;
            $hot->save();
        }

        DB::table('hots')->where('status', '=', 0)->delete();

       return redirect("/hot/add/$work_file_id");

    }

   
    public function delHot($id)
    {    	
        $hot               = Hot::find($id);

        $work_file_id      = $hot->work_file_id;
        $slip_id           = $hot->slip_id;

        $confirm            = $hot->confirm;

        if($confirm == 1)
        {
           DB::table('hots')->where('id', '=', "$id")->delete();
            // return back();
           return redirect("/hot/add/$work_file_id");
        }
        if($confirm == 0)
        {
            DB::table('hots')->where('id', '=', "$id")->delete();
           // return redirect("/hot/add/{$work_file_id}/{$slip_id}");
            return redirect("/hot/add/$work_file_id");
        }

       
    }

    public function typedelHot($id)
    {
                
        $hot            = Hot::find($id);

        $work_file_id   = $hot->work_file_id;
        $slip_id        = $hot->slip_id;
        $type           = $hot->type;

        //dd($work_file_id."/".$type);

        DB::table('hots')->where([ 
                                    ['work_file_id', '=', "$work_file_id"], 
                                    ['slip_id', '=', "$slip_id"],
                                    ['type', '=', "$type"], 
                                ])->delete();
                
        return redirect("/hot/add/{$work_file_id}/{$slip_id}");

    }

     public function alldelHot($id)
    {
      
        $work_file_id   = $id;
        
        DB::table('hots')->where([ 
                                    ['work_file_id', '=', "$work_file_id"], 
                                    
                                ])->delete();
        
        return back();
      

     
    }


}
